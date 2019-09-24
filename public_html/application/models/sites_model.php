<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* An abstruct model for extending into other controllers.
* Here we will write the common functions
* 
* @author: Arnab Chattopadhyay
*/

require_once APPPATH.'models/my_model.php';
class Sites_model extends My_model {

    public function __construct() {
        parent::__construct();
    }

    /**
    * method to insert data into database
    * 
    * @param string $s_tab_name
    * @param mixed $m_data_arr
    */
    public function insertData($s_tab_name='', $m_data_arr=array()){
        $this->db->insert($s_tab_name, $m_data_arr);
        // echo $this->db->last_query();
        return intval($this->db->insert_id());
    }

    /**
    * method to update data into database according to a where clause
    * 
    * @param string $s_tab_name
    * @param mixed $m_data_arr
    * @param mixed $m_where
    */
    public function updateData($s_tab_name, $m_data_arr, $m_where){
        $s_sql = $this->db->update_string($s_tab_name, $m_data_arr, $m_where);
        return $this->db->simple_query($s_sql);
    }

    /**
    * method to fetch single data by where clause
    * 
    * @param string $s_tab_name
    * @param mixed $m_where
    */
    public function fetchSingle($s_tab_name, $m_where){
        $o_res = $this->db->get_where($s_tab_name, $m_where);
        //echo $this->db->last_query();
        if($o_res->num_rows > 0) {
            return $o_res->row_array();
        } else {
            return array();
        }
    }

    /**
    * method to fetch multiple data by where clause
    * 
    * @param string $s_tab_name
    * @param mixed $m_where
    */
    public function fetchMulti($s_tab_name, $m_where, $i_perpage='', $i_page=''){
        if(!empty($i_perpage))
            $this->db->limit($i_perpage, $i_page);
        $o_res = $this->db->select('*')->from($s_tab_name)->where($m_where)->order_by('s_sites_name')->get();        
        // echo $this->db->last_query();
        if($o_res->num_rows()>0) {
            return $o_res->result_array();
        } else{
            return array();
        }   
    }
    
    /**
    * function for deleting data from table
    * 
    * @param mixed $s_tab_name
    * @param mixed $m_where
    */
    public function deleteData($s_tab_name, $m_where){
        $this->db->where($m_where);
        $this->db->delete($s_tab_name);
        return $this->db->affected_rows();
    }
    
    //******************* previous code ****************************//

    /**
    * method to fetch multiple data count by where clause
    * 
    * @param string $s_tab_name
    * @param mixed $m_where
    */
    public function fetchMultiCount($s_tab_name, $m_where){
        $this->db->select('COUNT(DISTINCT id)', FALSE);
        $this->db->where($m_where);
        $this->db->from("pm_vw_video_details");
        $ret_ = $this->db->get();
        $res_ = $ret_->row_array();
        return $res_['COUNT(DISTINCT id)'];
    }

    /**
    * function for fetching category picture and category name
    * 
    * @param string $s_tab_name
    * @param mixed $m_where
    */
    public function fetchMultiCategoryDetails($s_where="1"){
        $s_cat_det_sql = "SELECT
        cd.id,
        cd.s_category_name,
        COUNT(vd.id) AS i_vid_count,
        cd.s_cat_image_url,
        vd.i_is_internal_link
        FROM
        pm_cat_video AS vc
        INNER JOIN pm_vcategory_details AS cd ON cd.id = vc.i_cat_id
        INNER JOIN pm_video_details AS vd ON vd.id = vc.i_vid_id
        WHERE cd.i_is_active = 1 
        AND ".$s_where." GROUP BY cd.id 
        ORDER BY cd.s_category_name";
        $o_res = $this->db->query($s_cat_det_sql);
        // echo $this->db->last_query();
        if($o_res->num_rows()>0) {
            return $o_res->result_array();
        } else{
            return array();
        }   
    }



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
