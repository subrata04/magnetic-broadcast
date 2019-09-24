<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Model extending my model for zip controller
* @author: Arnab Chattopadhyay
*/

require_once APPPATH.'models/my_model.php';
class Zip_model extends My_model {

    public function __construct() {
        parent::__construct();
    }
}

/* End of file zip_model.php */
/* Location: ./application/models/zip_model.php */
