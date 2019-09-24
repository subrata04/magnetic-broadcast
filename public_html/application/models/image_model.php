<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* An abstruct model for extending into other controllers.
* Here we will write the common functions
* 
* @author: Arnab Chattopadhyay
*/

require_once APPPATH.'models/my_model.php';
class Image_model extends My_model {

    public function __construct() {
        parent::__construct();
    }

    public function fetchMultiPackageData($i_product_id=""){
        $s_sql = "SELECT REPLACE(GROUP_CONCAT(CONCAT( tab1.s_product_title, ' X ',tab1.i_quantity, ' Blisters')), ' Blisters,', ' Blisters, <br />')AS s_product_details, 
        tab1.* FROM `itpl_vw_package_details` AS tab1
        WHERE id IN( SELECT id FROM itpl_vw_package_details WHERE 
        `i_product_id` = '".intval($i_product_id)."' ) GROUP BY id ";
        $ret_  = $this->db->query($s_sql);
        if($ret_->num_rows()){
            return $ret_->result_array();
        } else {
            return array();
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
