<?php
/**
* Image Helper File
* Helper Functions for resizing, cropping images
* @author Arnab Chattopadhyay
* @path application/helpers/image_helper.php
*/

//---------------------------------------- Image manupulation functions [start] ----------------------------------------

/**
* Function for resizing by height and width
* @author Arnab Chattopadhyay
* @param mixed $s_source_path
* @param mixed $s_dest_path
* @param int $i_req_H
* @param int $i_req_W
* @param mixed $b_del_source
*/
function resize_exact($s_source_path="", $s_dest_path="", $i_req_H="100", $i_req_W="100", $b_del_source=FALSE){
    //echo intval($b_del_source); exit;
    $i_req_H = intval($i_req_H);
    $i_req_W = intval($i_req_W);

    $m_arr = explode("/", $s_source_path);
    // pr($m_arr);
    $s_img_name = $m_arr[count($m_arr)-1];

    $o_CI = &get_instance();
    $o_CI->load->library('image_lib');
    // reseting the config
    unset($config);
    $o_CI->image_lib->clear();
    // setting master dimension
    list($width, $height, $type, $attr) = getimagesize($s_source_path);

    if($width>$height) {
        if($i_req_H>$i_req_W)
            $config['master_dim'] = 'height';
        else
            $config['master_dim'] = 'width';
    } else {
        if($i_req_H>$i_req_W)
            $config['master_dim'] = 'height';
        else
            $config['master_dim'] = 'width';
    }

    /// image resizing [start]
    $config['image_library'] = 'gd2';
    $config['quality'] = '100%';
    $config['source_image'] = $s_source_path;
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    $config['thumb_marker'] = "";
    if(!empty($s_dest_path)){
        $config['new_image'] = $s_dest_path.$s_img_name;
    }
    $config['width'] = $i_req_W;
    $config['height'] = $i_req_H;
    //     pr($config, TRUE);
    $o_CI->image_lib->initialize($config); 
    $o_CI->image_lib->resize();
    /// image resizing [end]

    // reseting the config
    unset($config);
    if(!empty($s_dest_path)){
        $s_source_path_new = $s_dest_path.$s_img_name;
    }else{
        $s_source_path_new = $s_source_path;
    }

    /// image cropping [start]
    list($width, $height, $type, $attr) = getimagesize($s_source_path_new);
    $x_axis = intval(($width-$i_req_W)/2);
    $y_axis = intval(($height-$i_req_H)/2);

    $o_CI->load->library('image_lib');

    $o_CI->image_lib->clear();
    $config['image_library'] = 'gd2';
    $config['quality'] = '100%';
    $config['source_image'] = $s_source_path_new;
    $config['maintain_ratio'] = FALSE;
    $config['width'] = $i_req_W;
    $config['height'] = $i_req_H;
    $config['x_axis'] = "$x_axis";
    $config['y_axis'] = "$y_axis";
    //     pr($config, true);
    $o_CI->image_lib->initialize($config); 
    if($o_CI->image_lib->crop()){
        if(intval($b_del_source)==1)
            unlink($s_source_path);
    }else{
        echo $o_CI->image_lib->display_errors('<p>', '</p>');exit;
    }
    /// image cropping [end]

}

/**
* Function for resizing the image keeping maximum filling the height width
* @author Arnab Chattopadhyay
* @param mixed $s_source_path
* @param mixed $s_dest_path
* @param int $i_req_H
* @param int $i_req_W
* @param mixed $b_del_source
*/
function create_full_thumb($s_source_path="", $s_dest_path="", $i_req_H="100", $i_req_W="100", $b_del_source=FALSE){
    $i_req_H = intval($i_req_H);
    $i_req_W = intval($i_req_W);

    $m_arr = explode("/", $s_source_path);
    $s_img_name = $m_arr[count($m_arr)-1];

    $o_CI = &get_instance();
    $o_CI->load->library('image_lib');
    // reseting the config
    unset($config);
    $o_CI->image_lib->clear();

    // setting master dimension
    list($width, $height, $type, $attr) = getimagesize($s_source_path);
    $f_image_aspect_ratio = $width/$height;
    $f_req_aspect_ratio = $i_req_W/$i_req_H;
    if($f_image_aspect_ratio>$f_req_aspect_ratio){
        $config['master_dim'] = 'height';
    } else {
        $config['master_dim'] = 'width';
    }

    /// image resizing [start]
    $config['image_library'] = 'gd2';
    $config['quality'] = '100%';
    $config['source_image'] = $s_source_path;
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    $config['thumb_marker'] = "";
    if(!empty($s_dest_path)){
        $config['new_image'] = $s_dest_path.$s_img_name;
    }
    $config['width'] = $i_req_W;
    $config['height'] = $i_req_H;
    //     pr($config, TRUE);
    $o_CI->image_lib->initialize($config); 
    $o_CI->image_lib->resize();
    /// image resizing [end]

    // reseting the config
    unset($config);
    if(!empty($s_dest_path)){
        $s_source_path_new = $s_dest_path.$s_img_name;
    }else{
        $s_source_path_new = $s_source_path;
    }

    /// image cropping [start]
    //list($width, $height, $type, $attr) = getimagesize($s_source_path_new);
    //$x_axis = intval(($width-$i_req_W)/2);
    // $y_axis = intval(($height-$i_req_H)/2);
    $y_axis = $x_axis=0;

    $o_CI->load->library('image_lib');

    $o_CI->image_lib->clear();
    $config['image_library'] = 'gd2';
    $config['quality'] = '100%';
    $config['source_image'] = $s_source_path_new;
    $config['maintain_ratio'] = FALSE;
    $config['width'] = $i_req_W;
    $config['height'] = $i_req_H;
    $config['x_axis'] = "$x_axis";
    $config['y_axis'] = "$y_axis";
    //     pr($config, true);
    $o_CI->image_lib->initialize($config); 
    if($o_CI->image_lib->crop()){
        if(intval($b_del_source)==1)
            unlink($s_source_path);
    }else{
        return $o_CI->image_lib->display_errors('<p>', '</p>');
    }
    /// image cropping [end]

}

/**
* Function to resize image by its aspect ratio.
* @author Arnab Chattopadhyay
* @param mixed $s_source_path
* @param mixed $s_dest_path
* @param int $i_req_H
* @param int $i_req_W
* @param mixed $b_del_source
*/
function resize_by_ratio($s_source_path="", $s_dest_path="", $i_req_H="100", $i_req_W="100", $b_del_source=FALSE){
    $i_req_H = intval($i_req_H);
    $i_req_W = intval($i_req_W);

    $m_arr = explode("/", $s_source_path);
    $s_img_name = $m_arr[count($m_arr)-1];

    $o_CI = &get_instance();
    $o_CI->load->library('image_lib');
    // reseting the config
    unset($config);
    $o_CI->image_lib->clear();

    // setting master dimension
    list($width, $height, $type, $attr) = getimagesize($s_source_path);
    $f_image_aspect_ratio = $width/$height;
    $f_req_aspect_ratio = $i_req_W/$i_req_H;
    if($f_image_aspect_ratio>$f_req_aspect_ratio){
        $config['master_dim'] = 'width';
    } else {
        $config['master_dim'] = 'height';
    }
    $config['width'] = $i_req_W;
    $config['height'] = $i_req_H;
    
    if($i_req_H > $height){
        $config['height'] = $height;
    }
    if($i_req_W > $width){
        $config['width'] = $width;
    }
    

    /// image resizing [start]
    $config['image_library'] = 'gd2';
    $config['quality'] = '100%';
    $config['source_image'] = $s_source_path;
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    $config['thumb_marker'] = "";
    if(!empty($s_dest_path)){
        $config['new_image'] = $s_dest_path.$s_img_name;
    }
    //     pr($config, TRUE);
    $o_CI->image_lib->initialize($config); 
    if($o_CI->image_lib->resize()){
        if(intval($b_del_source)==1)
            unlink($s_source_path);
    }else{
        return $o_CI->image_lib->display_errors('<p>', '</p>');
    }
    /// image resizing [end]
}

/**
* Function for resizing the image after selected portion crop
* @author Arnab Chattopadhyay
* @param mixed $s_source_path
* @param mixed $s_dest_path
* @param int $i_req_H
* @param int $i_req_W
* @param mixed $b_del_source
*/
function make_selected_crop($s_source_path="", $s_dest_path="",$i_req_H="100", $i_req_W="100", $m_crop_data=array(), $s_resize_type='crop', $b_del_source=FALSE) {
    if($m_crop_data['w1']>0){   // If the cropping is actually done
        $i_req_H = intval($i_req_H);
        $i_req_W = intval($i_req_W);

        $m_arr = explode("/", $s_source_path);
        $s_img_name = $m_arr[count($m_arr)-1];

        $o_CI = &get_instance();
        $o_CI->load->library('image_lib');
        // reseting the config
        unset($config);
        $o_CI->image_lib->clear();
        $config['image_library'] = 'gd2';
        $config['quality'] = '100%';
        $config['source_image'] = $s_source_path;
        $config['new_image'] = $s_dest_path;
        $config['maintain_ratio'] = FALSE;
        $config['width'] = $m_crop_data['w1'];
        $config['height'] = $m_crop_data['h1'];
        $x_axis = $m_crop_data['x1'];
        $y_axis = $m_crop_data['y1'];
        $config['x_axis'] = "$x_axis";
        $config['y_axis'] = "$y_axis";
           //  pr($config, true);
        $o_CI->image_lib->initialize($config); 
        if($o_CI->image_lib->crop()){
            if(intval($b_del_source)==1)
                unlink($s_source_path);
        }else{
            return $o_CI->image_lib->display_errors('<p>', '</p>');
        }
        /// image cropping [end]

        switch($s_resize_type){
            case 'crop':
                return true;
                break;
            case 'exact':
                unset($config);
                $o_CI->image_lib->clear();
                // image resizing [start]
                $config['image_library'] = 'gd2';
                $config['quality'] = '100%';
                $config['source_image'] = $s_dest_path.$s_img_name;
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = FALSE;
                $config['thumb_marker'] = "";
                if(!empty($s_dest_path)){
                    $config['new_image'] = $s_dest_path.$s_img_name;
                }
                $config['width'] = $i_req_W;
                $config['height'] = $i_req_H;
                $o_CI->image_lib->initialize($config); 
                $o_CI->image_lib->resize();
                break;
            case 'resize':
                unset($config);
                $o_CI->image_lib->clear();
                // image resizing [start]
                $config['image_library'] = 'gd2';
                $config['quality'] = '100%';
                $config['source_image'] = $s_dest_path.$s_img_name;
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['thumb_marker'] = "";
                if(!empty($s_dest_path)){
                    $config['new_image'] = $s_dest_path.$s_img_name;
                }
                $config['width'] = $i_req_W;
                $config['height'] = $i_req_H;
                $o_CI->image_lib->initialize($config); 
                $o_CI->image_lib->resize();
                break;
            case 'resize-exact':

                break;        
        }

    }
}

function make_selected_crop1($s_source_path="", $s_dest_path="",$i_req_H="100", $i_req_W="100", $m_crop_data=array(), $s_resize_type='crop', $b_del_source=FALSE) {
    if($m_crop_data['w1']>0){   // If the cropping is actually done
        $i_req_H = intval($i_req_H);
        $i_req_W = intval($i_req_W);

        $m_arr = explode("/", $s_source_path);
        $s_img_name = $m_arr[count($m_arr)-1];

        $o_CI = &get_instance();
        $o_CI->load->library('image_lib');
        // reseting the config
        unset($config);
        $o_CI->image_lib->clear();

        $config['width'] = $m_crop_data['w1'];
        $config['height'] = $m_crop_data['h1'];

        list($width, $height, $type, $attr) = getimagesize($s_source_path);
        if($m_crop_data['h1'] > $height){
            $config['height'] = $height;
        }
        if($m_crop_data['w1'] > $width){
            $config['width'] = $width;
        }


        $config['image_library'] = 'gd2';
        $config['quality'] = '100%';
        $config['source_image'] = $s_source_path;
        $config['new_image'] = $s_dest_path;
        $config['maintain_ratio'] = FALSE;
        $x_axis = $m_crop_data['x1'];
        $y_axis = $m_crop_data['y1'];
        $config['x_axis'] = "$x_axis";
        $config['y_axis'] = "$y_axis";
           //  pr($config, true);
        $o_CI->image_lib->initialize($config); 
        if($o_CI->image_lib->crop()){
            if(intval($b_del_source)==1)
                unlink($s_source_path);
        }else{
            return $o_CI->image_lib->display_errors('<p>', '</p>');
        }
        /// image cropping [end]

        switch($s_resize_type){
            case 'crop':
                return true;
                break;
            case 'exact':
                unset($config);
                $o_CI->image_lib->clear();
                // image resizing [start]
                $config['image_library'] = 'gd2';
                $config['quality'] = '100%';
                $config['source_image'] = $s_dest_path.$s_img_name;
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = FALSE;
                $config['thumb_marker'] = "";
                if(!empty($s_dest_path)){
                    $config['new_image'] = $s_dest_path.$s_img_name;
                }
                $config['width'] = $i_req_W;
                $config['height'] = $i_req_H;
                $o_CI->image_lib->initialize($config); 
                $o_CI->image_lib->resize();
                break;
            case 'resize':
                unset($config);
                $o_CI->image_lib->clear();
                // image resizing [start]
                $config['image_library'] = 'gd2';
                $config['quality'] = '100%';
                $config['source_image'] = $s_dest_path.$s_img_name;
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['thumb_marker'] = "";
                if(!empty($s_dest_path)){
                    $config['new_image'] = $s_dest_path.$s_img_name;
                }
                $config['width'] = $i_req_W;
                $config['height'] = $i_req_H;
                $o_CI->image_lib->initialize($config); 
                $o_CI->image_lib->resize();
                break;
            case 'resize-exact':

                break;        
        }

    }
}

function resize_width_exact($s_source_path="", $s_dest_path="", $i_req_W="100", $b_del_source=FALSE){
    //echo intval($b_del_source); exit;
    $i_req_W = intval($i_req_W);
    
    $i_req_W = ($i_req_W >980) ? 980 : $i_req_W;

    $m_arr = explode("/", $s_source_path);
    // pr($m_arr);
    $s_img_name = $m_arr[count($m_arr)-1];

    $o_CI = &get_instance();
    $o_CI->load->library('image_lib');
    // reseting the config
    unset($config);
    $o_CI->image_lib->clear();
    // setting master dimension
    list($width, $height, $type, $attr) = getimagesize($s_source_path);

    /// image resizing [start]
    $config['master_dim'] = 'width';
    $config['image_library'] = 'gd2';
    $config['quality'] = '100%';
    $config['source_image'] = $s_source_path;
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    $config['thumb_marker'] = "";
    if(!empty($s_dest_path)){
        $config['new_image'] = $s_dest_path.$s_img_name;
    }
    $config['width'] = $i_req_W;
    $config['height'] = $i_req_W * ($height/$width);
    //     pr($config, TRUE);
    $o_CI->image_lib->initialize($config); 
    $o_CI->image_lib->resize();
    /// image resizing [end]


}


//---------------------------------------- Image manupulation functions [end] ----------------------------------------

//---------------------------------------- Image require data fetch functios [start] ----------------------------------------
/**
* function for making unique image name from its name
* @author Arnab Chattopadhyay
* @param mixed $s_title
*/
function get_image_name($s_title=''){
    $s_title = convert_accented_characters($s_title);
    $s_title = str_replace("/", "-", $s_title);
    $s_title = character_limiter($s_title, 30);
    return strtolower(url_title(strip_quotes($s_title))).time();
}

/**
* Function to get image information
* @author Arnab Chattopadhyay
* @param mixed $s_source_path
* @return mixed
*/
function get_image_info($s_source_path=''){
    $m_image_info = getimagesize($s_source_path);
    return array('width'=>$m_image_info[0], 'height'=>$m_image_info[1], 'type'=>$m_image_info[2], 'mime'=>$m_image_info['mime']);
}

/**
* function for getting Mime Type
* @author Arnab Chattopadhyay
* @param mixed $s_file_path
* @return string
*/
function get_file_mime_type($s_file_path='') {
    // echo intval(function_exists('finfo_file')).'lll';
    // Use if the Fileinfo extension, if available (only versions above 5.3 support the FILEINFO_MIME_TYPE flag)
    if ( (float) substr(phpversion(), 0, 3) >= 5.3 && function_exists('finfo_file'))
    {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        if ($finfo !== FALSE) {// This is possible, if there is no magic MIME database file found on the system
            $s_mime = finfo_file($finfo, $s_file_path);
            return $s_mime;
        }
    }

    // Fall back to the deprecated mime_content_type(), if available
    if (function_exists('mime_content_type')) {
        $s_mime = @mime_content_type($s_file_path);
        return $s_mime;
    }

    /* This is an ugly hack, but UNIX-type systems provide a native way to detect the file type,
    * which is still more secure than depending on the value of $_FILES[$field]['type'].
    *
    * Notes:
    *    - a 'W' in the substr() expression bellow, would mean that we're using Windows
    *    - many system admins would disable the exec() function due to security concerns, hence the function_exists() check
    */
    if (DIRECTORY_SEPARATOR !== '\\' && function_exists('exec')) {
        $output = array();
        @exec('file --brief --mime-type ' . escapeshellarg($file['tmp_path']), $output, $return_code);
        if ($return_code === 0 && strlen($output[0]) > 0) {// A return status code != 0 would mean failed execution        
            $s_mime = rtrim($output[0]);
            return $s_mime;
        }
    }
}




//---------------------------------------- Image require data fetch functios [end] ----------------------------------------


/* End of file image_helper.php */
/* Location: ./application/helpers/image_helper.php */
