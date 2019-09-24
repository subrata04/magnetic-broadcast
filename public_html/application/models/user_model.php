<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* user model for writing user functions
* @author: Arnab Chattopadhyay
*/

require_once APPPATH.'models/my_model.php';
class User_model extends My_model {
    /**
    * constructor method
    */
    public function __construct() {
        parent::__construct();
    }
        /**
    * function for login user
    * 
    * @param mixed $s_uname
    * @param mixed $s_pass
    */
    public function fetchSingleUser($s_uname, $s_pass){
        $s_user_data_sql = "call itpl_sp_authenticate_user('".$s_uname."','".$s_pass."')";
        $ret_ = $this->db->query($s_user_data_sql);
        return $ret_->row_array();
    }

    /**
    * method to fetch multiple data by where clause
    * 
    * @param string $s_tab_name
    * @param mixed $m_where
    */
    public function fetchMultiData($s_tab_name='', $s_select='*', $m_where=array(), $s_group_by='', $m_order_by_name='id', $m_order_by='DESC', $i_perpage='', $i_page='') {
        // select clause insertion
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
        //echo $this->db->last_query();
        if($o_res->num_rows()>0) {
            return $o_res->result_array();
        } else{
            return array();
        }   
    }
    
    
    /*
    *Function for calculate Commission Weekly by Samsuj[start] 
    */
    
    public function ins_commision($data)
    {
         //  $data['i_start_date']=$t1;
         
         $this->db->select('i_user_id');
         $this->db->group_by('i_user_id');
         $res=$this->db->get('itpl_comp_plan'); 
         
         foreach($res->result() as $row)
         {
             $userId=$row->i_user_id;
             $sql="SELECT SUM( `f_commission` ) AS `total_com` FROM `itpl_vw_commission_details` WHERE `i_user_id` =".$userId." AND `i_date` BETWEEN ".$data['i_start_date']." AND " .$data['i_end_date'];
             $result=$this->db->query($sql);
             $total=$result->result_array();
             if($total[0]['total_com'])
             {
             $data['f_total_commission'] =   $total[0]['total_com'];
             $data['i_user_id'] =  $userId;
             $this->db->insert('commission',$data); 
             }
         }
    }

    /*
    *Function for calculate Commission Weekly by Samsuj[end] 
    */

    /*
    *Function for Get Last Week by Samsuj[start] 
    */
    
    public function lastdate()
    {
        $sql="SELECT MAX(`i_end_date`) AS lastdate FROM `itpl_commission`";
        $res=$this->db->query($sql);
        
        $lastDate=$res->result_array();
        return @$lastDate[0]['lastdate'];
    }

    /*
    *Function for  Get Last Week by Samsuj[start] 
    */
    
    public function updateData1()
    {
                $query = "UPDATE `itpl_configuration` SET `is_show_in_signup` =0 WHERE 1";
                $this->db->query($query);
    }
      public function updateData($table,$data,$where)
    {
     return  $this->db->update($table,$data,$where);
    }
  
 
   
}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */
