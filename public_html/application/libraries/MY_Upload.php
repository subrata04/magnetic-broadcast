<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* CodeIgniter
*
* An open source application development framework for PHP 5.1.6 or newer
*
* @package		CodeIgniter
* @author		ExpressionEngine Dev Team
* @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
* @license		http://codeigniter.com/user_guide/license.html
* @link		http://codeigniter.com
* @since		Version 1.0
* @filesource
*/

// ------------------------------------------------------------------------

/**
* File Uploading Class
*
* @package		CodeIgniter
* @subpackage	Libraries
* @category	Uploads
* @author		ExpressionEngine Dev Team
* @link		http://codeigniter.com/user_guide/libraries/file_uploading.html
*/
class MY_Upload extends CI_Upload {

    /**
    * Perform the file upload
    *
    * @return	bool
    */
    public function do_upload_multi($field = 'userfile', $indx=0)
    {
       
        // Is $_FILES[$field] set? If not, no reason to continue.
        if ( ! isset($_FILES[$field]))
        {
            $this->set_error('upload_no_file_selected');
            return FALSE;
        }

        // Is the upload path valid?
        if ( ! $this->validate_upload_path())
        {
            // errors will already be set by validate_upload_path() so just return FALSE
            return FALSE;
        }

        // Was the file able to be uploaded? If not, determine the reason why.
        if ( ! is_uploaded_file($_FILES[$field]['tmp_name'][$indx]))
        {
            $error = ( ! isset($_FILES[$field]['error'][$indx])) ? 4 : $_FILES[$field]['error'][$indx];

            switch($error)
            {
                case 1:	// UPLOAD_ERR_INI_SIZE
                    $this->set_error('upload_file_exceeds_limit');
                    break;
                case 2: // UPLOAD_ERR_FORM_SIZE
                    $this->set_error('upload_file_exceeds_form_limit');
                    break;
                case 3: // UPLOAD_ERR_PARTIAL
                    $this->set_error('upload_file_partial');
                    break;
                case 4: // UPLOAD_ERR_NO_FILE
                    $this->set_error('upload_no_file_selected');
                    break;
                case 6: // UPLOAD_ERR_NO_TMP_DIR
                    $this->set_error('upload_no_temp_directory');
                    break;
                case 7: // UPLOAD_ERR_CANT_WRITE
                    $this->set_error('upload_unable_to_write_file');
                    break;
                case 8: // UPLOAD_ERR_EXTENSION
                    $this->set_error('upload_stopped_by_extension');
                    break;
                default :   $this->set_error('upload_no_file_selected');
                    break;
            }

            return FALSE;
        }


        // Set the uploaded data as class variables
        $this->file_temp = $_FILES[$field]['tmp_name'][$indx];
        $this->file_size = $_FILES[$field]['size'][$indx];
        $this->_file_mime_type_multi($_FILES[$field], $indx);
        $this->file_type = preg_replace("/^(.+?);.*$/", "\\1", $this->file_type);
        $this->file_type = strtolower(trim(stripslashes($this->file_type), '"'));
        $this->file_name = $this->_prep_filename($_FILES[$field]['name'][$indx]);
        $this->file_ext	 = $this->get_extension($this->file_name);
        $this->client_name = $this->file_name;

        // Is the file type allowed to be uploaded?
        if ( ! $this->is_allowed_filetype())
        {
            $this->set_error('upload_invalid_filetype');
            return FALSE;
        }

        // if we're overriding, let's now make sure the new name and type is allowed
        if ($this->_file_name_override != '')
        {
            $this->file_name = $this->_prep_filename($this->_file_name_override);

            // If no extension was provided in the file_name config item, use the uploaded one
            if (strpos($this->_file_name_override, '.') === FALSE)
            {
                $this->file_name .= $this->file_ext;
            }

            // An extension was provided, lets have it!
            else
            {
                $this->file_ext	 = $this->get_extension($this->_file_name_override);
            }

            if ( ! $this->is_allowed_filetype(TRUE))
            {
                $this->set_error('upload_invalid_filetype');
                return FALSE;
            }
        }

        // Convert the file size to kilobytes
        if ($this->file_size > 0)
        {
            $this->file_size = round($this->file_size/1024, 2);
        }

        // Is the file size within the allowed maximum?
        if ( ! $this->is_allowed_filesize())
        {
            $this->set_error('upload_invalid_filesize');
            return FALSE;
        }

        // Are the image dimensions within the allowed size?
        // Note: This can fail if the server has an open_basdir restriction.
        if ( ! $this->is_allowed_dimensions())
        {
            $this->set_error('upload_invalid_dimensions');
            return FALSE;
        }

        // Sanitize the file name for security
        $this->file_name = $this->clean_file_name($this->file_name);

        // Truncate the file name if it's too long
        if ($this->max_filename > 0)
        {
            $this->file_name = $this->limit_filename_length($this->file_name, $this->max_filename);
        }

        // Remove white spaces in the name
        if ($this->remove_spaces == TRUE)
        {
            $this->file_name = preg_replace("/\s+/", "_", $this->file_name);
        }

        /*
        * Validate the file name
        * This function appends an number onto the end of
        * the file if one with the same name already exists.
        * If it returns false there was a problem.
        */
        $this->orig_name = $this->file_name;

        if ($this->overwrite == FALSE)
        {
            $this->file_name = $this->set_filename($this->upload_path, $this->file_name);

            if ($this->file_name === FALSE)
            {
                return FALSE;
            }
        }

        /*
        * Run the file through the XSS hacking filter
        * This helps prevent malicious code from being
        * embedded within a file.  Scripts can easily
        * be disguised as images or other file types.
        */
        if ($this->xss_clean)
        {
            if ($this->do_xss_clean() === FALSE)
            {
                $this->set_error('upload_unable_to_write_file');
                return FALSE;
            }
        }

        /*
        * Move the file to the final destination
        * To deal with different server configurations
        * we'll attempt to use copy() first.  If that fails
        * we'll use move_uploaded_file().  One of the two should
        * reliably work in most environments
        */
        if ( ! @copy($this->file_temp, $this->upload_path.$this->file_name))
        {
            if ( ! @move_uploaded_file($this->file_temp, $this->upload_path.$this->file_name))
            {
                $this->set_error('upload_destination_error');
                return FALSE;
            }
        }

        /*
        * Set the finalized image dimensions
        * This sets the image width/height (assuming the
        * file was an image).  We use this information
        * in the "data" function.
        */
        $this->set_image_properties($this->upload_path.$this->file_name);

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
    * File MIME type
    *
    * Detects the (actual) MIME type of the uploaded file, if possible.
    * The input array is expected to be $_FILES[$field]
    *
    * @param	array
    * @return	void
    */
    protected function _file_mime_type_multi($file, $indx)
    {
        // echo phpversion();
        // Use if the Fileinfo extension, if available (only versions above 5.3 support the FILEINFO_MIME_TYPE flag)
        if ( (float) substr(phpversion(), 0, 3) >= 5.3 && function_exists('finfo_file'))
        {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if ($finfo !== FALSE) // This is possible, if there is no magic MIME database file found on the system
            {
                $file_type = $finfo->file($file['tmp_name'][$indx]);

                /* According to the comments section of the PHP manual page,
                * it is possible that this function returns an empty string
                * for some files (e.g. if they don't exist in the magic MIME database)
                */
                if (strlen($file_type) > 1)
                {
                    $this->file_type = $file_type;
                    return;
                }
            }
        }

        // Fall back to the deprecated mime_content_type(), if available
        if (function_exists('mime_content_type'))
        {
            $this->file_type = @mime_content_type($file['tmp_name'][$indx]);
            if(!empty($this->file_type))
                return;
        }

        /* This is an ugly hack, but UNIX-type systems provide a native way to detect the file type,
        * which is still more secure than depending on the value of $_FILES[$field]['type'].
        *
        * Notes:
        *	- a 'W' in the substr() expression bellow, would mean that we're using Windows
        *	- many system admins would disable the exec() function due to security concerns, hence the function_exists() check
        */
        if (DIRECTORY_SEPARATOR !== '\\' && function_exists('exec'))
        {
            $output = array();
            @exec('file --brief --mime-type ' . escapeshellarg($file['tmp_path'][$indx]), $output, $return_code);
            if ($return_code === 0 && strlen($output[0]) > 0) // A return status code != 0 would mean failed execution
            {
                $this->file_type = rtrim($output[0]);
                return;
            }
        }

        $this->file_type = $file['type'][$indx];
    }

}
// END Upload Class

/* End of file Upload.php */
/* Location: ./system/libraries/Upload.php */
