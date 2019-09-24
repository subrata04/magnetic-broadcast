<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------

/**
 * MY_Router Class overrides CI_Router class
 *
 * Parses URIs and determines routing
 *
 * @package        CodeIgniter
 * @subpackage    Libraries
 * @author        Arnab Chattopadhyay
 * @category    Libraries
 */
 

class MY_Router extends CI_Router {
    
    /**
    * change done for url '-' character into class and method name
    * 
    * @param array $segments
    * @return void
    */
    function _set_request($segments = array())
    {
        $segments = $this->_validate_request($segments);
        if (count($segments) == 0)
        {
            return $this->_set_default_controller();
        }

        $this->set_class(str_replace("-", "_", $segments[0]));

        if (isset($segments[1]))
        {
            // A standard method request
            $this->set_method(str_replace("-", "_", $segments[1]));
        }
        else
        {
            // This lets the "routed" segment array identify that the default
            // index method is being used.
            $segments[1] = 'index';
        }

        // Update our "routed" segment array to contain the segments.
        // Note: If there is no custom routing, this array will be
        // identical to $this->uri->segments
        $this->uri->rsegments = $segments;
    }    
    
    /**
     * Validates the supplied segments.  Attempts to determine the path to
     * the controller.
     *
     * @access    private
     * @param    array
     * @return    array
     */
    function _validate_request($segments)
    {
        // echo "_validate_request";exit;
        if (count($segments) == 0)
        {
            return $segments;
        }

        // Does the requested controller exist in the root folder?
        if (file_exists(APPPATH.'controllers/'.str_replace("-", "_", $segments[0]).'.php'))
        {
            return $segments;
        }

        // Is the controller in a sub-folder?
        if (is_dir(APPPATH.'controllers/'.str_replace("-", "_", $segments[0])))
        {
            // Set the directory and remove it from the segment array
            $this->set_directory($segments[0]);
            $segments = array_slice($segments, 1);

            if (count($segments) > 0)
            {
                // Does the requested controller exist in the sub-folder?
                if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().str_replace("-", "_", $segments[0]).'.php'))
                {
                    if ( ! empty($this->routes['404_override']))
                    {
                        $x = explode('/', $this->routes['404_override']);

                        $this->set_directory('');
                        $this->set_class($x[0]);
                        $this->set_method(isset($x[1]) ? $x[1] : 'index');

                        return $x;
                    }
                    else
                    {
                        show_404($this->fetch_directory().str_replace("-", "_", $segments[0]));
                    }
                }
            }
            else
            {
                // Is the method being specified in the route?
                if (strpos($this->default_controller, '/') !== FALSE)
                {
                    $x = explode('/', $this->default_controller);

                    $this->set_class($x[0]);
                    $this->set_method($x[1]);
                }
                else
                {
                    $this->set_class($this->default_controller);
                    $this->set_method('index');
                }

                // Does the default controller exist in the sub-folder?
                if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().$this->default_controller.'.php'))
                {
                    $this->directory = '';
                    return array();
                }

            }

            return $segments;
        }


        // If we've gotten this far it means that the URI does not correlate to a valid
        // controller class.  We will now see if there is an override
        if ( ! empty($this->routes['404_override']))
        {
            $x = explode('/', $this->routes['404_override']);

            $this->set_class($x[0]);
            $this->set_method(isset($x[1]) ? $x[1] : 'index');

            return $x;
        }


        // Nothing else to do at this point but show a 404
        show_404($segments[0]);
    }

}
// END Router Class

/* End of file Router.php */
/* Location: ./application/libraries/PM_Router.php */
