<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* An abstruct model for extending into other controllers.
* Here we will write the common functions
* 
* @author: Arnab Chattopadhyay
*/
//require APPPATH.'interfaces/inf_model.php';
class My_model extends CI_Model {
    public $m_tran_status = array('1'=>'pending', '2'=> 'Inprocess', '3'=> 'Delivered', '4'=>'Cancelled');
    
    /**
    * constructor method
    */
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
        return intval($this->db->insert_id());
    }

    /**
    * method to update data into database according to a where clause
    * 
    * @param string $s_tab_name
    * @param mixed $m_data_arr
    * @param mixed $m_where
    */
    public function updateData($s_tab_name='', $m_data_arr=array(), $m_where=array()){
        $s_sql = $this->db->update_string($s_tab_name, $m_data_arr, $m_where);
        return $this->db->simple_query($s_sql);
    }


    /**
    * method to fetch single data by where clause
    * 
    * @param string $s_tab_name
    * @param mixed $m_where
    */
    public function fetchSingleData($s_tab_name="", $m_where=array()){
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
    public function fetchMultiData($s_tab_name='', $s_select='*', $m_where=array(), $s_group_by='', $m_order_by_name='id', $m_order_by='DESC', $i_perpage='', $i_page='') {
        // select clause insertion
        $m_where = (empty($m_where))?array():$m_where;
        $s_select = (empty($s_select))?'*':$s_select;
       
        // Limit inclution
        if(!empty($i_perpage))
            $this->db->limit($i_perpage, $i_page);
        // Group by clause add
        if(!empty($s_group_by))
            $this->db->group_by($s_group_by);
        // Orderby clause add
        $this->db->order_by($m_order_by_name, $m_order_by);
        
            $o_res = $this->db->select($s_select, FALSE)->from($s_tab_name)->where($m_where)->get();        
        
      
        if($o_res->num_rows()>0) {
            return $o_res->result_array();
        } else{
            return array();
        }   
    }

    /**
    * method to fetch multiple data by where clause
    * 
    * @param string $s_tab_name
    * @param mixed $m_where
    */
    public function fetchMultiDataCount($s_tab_name='', $m_where=array(), $s_group_by=''){
        // Group by clause add
        $m_where = (empty($m_where))?array():$m_where;
        if(!empty($s_group_by))
            $this->db->group_by($s_group_by);
        else
            $this->db->group_by('id');
        if(!empty($i_perpage))
            $this->db->limit($i_perpage, $i_page);
        $o_res = $this->db->select('*')->from($s_tab_name)->where($m_where)->get();        
        //echo $this->db->last_query();
        return $o_res->num_rows();
    }

    /**
    * method to delete data depending on where clause
    * 
    * @param mixed $s_tab_name
    * @param mixed $m_where
    */
    public function delData($s_tab_name='', $m_where=array()){
        if(count($m_where)>0){
            $this->db->where($m_where);
        }
        $this->db->delete($s_tab_name);
        return $this->db->affected_rows();
    }
    
    
    /**
    * function for tracking the userhit
    * @author Arnab Chattopadhyay
    * @param int $m_data
    */
    public function track_user_hit($m_data=array()){
        $m_data['i_user_id'] = intval($m_data['i_user_id']);
        if($m_data['i_user_id']>0) {
            $i_rehit_time = (60*1);
            $m_data['i_websiteid'] = intval($m_data['i_websiteid']);
            $m_data['i_count'] = 1;
            $m_data['i_last_update'] = strtotime(date('Y-m-d',time()));
            $m_data['i_last_update_time'] = time();
            $m_data['i_page_no'] = intval($m_data['i_page_no']);
            // The IP address from which the user is viewing the current page. 
            $m_data['s_ip'] = $_SERVER['REMOTE_ADDR'];
            $i_count = $this->mod->fetchMultiDataCount('conversion_details', "`i_user_id` = '".$m_data['i_user_id']."' AND `i_websiteid` ='".$m_data['i_websiteid']."' AND `s_ip` = '".$m_data['s_ip']."' AND `i_page_no` = '".$m_data['i_page_no']."' AND (".time()."-`i_last_update_time`)<(".$i_rehit_time.")");
            if($i_count==0){
                $this->mod->insertData('conversion_details', $m_data);
            }
        }
    }

    public function eventFetchMultiData($year_val="",$month_val){
    // echo  $year_val;
   //  echo  $month_val;exit;
        if($year_val!="" && $month_val!=""){
            $sql="SELECT * FROM `itpl_event_details` HAVING substring( `event_date1` , 1, 2 )='".$month_val."' AND substring( `event_date1` , 7, 10 )='".$year_val."' AND `is_publish`=1";
        }
        else{
             $month_val=date('m');
             $year_val=date('Y');
             $sql="SELECT * FROM `itpl_event_details` HAVING substring( `event_date1` , 1, 2 )='".$month_val."' AND substring( `event_date1` , 7, 10 )='".$year_val."' AND `is_publish`=1";
        }
        
        $o_res=$this->db->query($sql);
        $m_res=$o_res->result_array();
       // print_r($m_res);exit;
        return($m_res);
    }
    public function fetchMultiDataCountEvent($s_tab_name='', $m_where="", $s_group_by=''){
        // Group by clause add
        if(!empty($s_group_by))
            $this->db->group_by($s_group_by);
        else
            $this->db->group_by('event_id');
        if(!empty($i_perpage))
            $this->db->limit($i_perpage, $i_page);
        // Where clause add
        if(!empty($m_where) && count($m_where)>0)
            $this->db->like('event_date1',$m_where,'both');
        $o_res = $this->db->select('*')->from($s_tab_name)->where(array('is_publish'=>1))->get();        
        // echo $this->db->last_query();
        return $o_res->num_rows();
    }
    
    
     public function fetchMultiDataEvent($s_tab_name='', $m_where="", $s_group_by=''){
        // Group by clause add
       // echo  $m_where;exit;
        if(!empty($s_group_by))
            $this->db->group_by($s_group_by);
        else
            $this->db->group_by('event_id');
        if(!empty($i_perpage))
            $this->db->limit($i_perpage, $i_page);
        // Where clause add
        if(!empty($m_where) && count($m_where)>0)
            $this->db->like('event_date1',$m_where,'both');
        $o_res = $this->db->select('*')->from($s_tab_name)->where(array('is_publish'=>1))->order_by('event_date')->get();        
        // echo $this->db->last_query();
       // return $o_res->num_rows();
        
         if($o_res->num_rows()>0) {
            return $o_res->result_array();
        } else{
            return array();
        }   
    }



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
