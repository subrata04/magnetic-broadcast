<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* An abstruct model for extending into other controllers.
* Here we will write the common functions
* 
* @author: Arnab Chattopadhyay
*/

require_once APPPATH.'models/my_model.php';
class Blog_model extends My_model {

    public function __construct() {
        parent::__construct();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
