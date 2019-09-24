<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* An abstruct model for extending into other controllers.
* Here we will write the common functions
* 
* @author: Arnab Chattopadhyay
*/

require_once APPPATH.'models/my_model.php';
class Cart_model extends My_model {
    public function __construct() {
        parent::__construct();
    }

    public function tblCreate()
    {
        $sql='CREATE TEMPORARY TABLE IF NOT EXISTS `itpl_temp_table` (
        `id` int NOT NULL AUTO_INCREMENT,
        `i_user_id` int,
        `s_b_fname` varchar(255),
        `s_b_lname` varchar(255),
        `s_b_addr` varchar(255),
        `i_b_country` int,
        `i_b_state` int, 
        `s_b_city` varchar(255), 
        `s_b_zip` varchar(255),
        `s_b_tele` varchar(255),
        `s_s_fname` varchar(255),
        `s_s_lname` varchar(255),
        `s_s_addr` varchar(255),
        `i_s_country` int, 
        `i_s_state` int,  
        `s_s_city` varchar(255), 
        `s_s_zip` varchar(255),
        `s_s_tele` varchar(255),
        `s_cart_details` text,
        `s_user_comment` text,
        `f_enrolement_fee` decimal(11,2),
        PRIMARY KEY (`id`)
        )';
        $this->db->query($sql);
    }         
    
  
    

    /**
    * function for inserting data into tables after transaction success
    * 
    * @param int $i_temp_id
    * @return mixed
    */
    public function tran_success($i_temp_id=0) {
        $total_amount=0;  
        //Fetch from temp table
        $res=$this->db->get_where('temp_table',array('id'=>$i_temp_id));
        $arr = $res->row_array();
        if(count($arr)>0){
            $this->db->trans_begin();
            
            $cart=unserialize($arr['s_cart_details']);
            foreach($cart as $row) {
                $total_amount +=  $row['qty'] * $row['price'];
            }
            
            // Billing information [start]
            $m_send_data_trading['s_b_fname'] = get_safe($arr['s_b_fname']);
            $m_send_data_trading['s_b_lname'] = get_safe($arr['s_b_lname']);
            $m_send_data_trading['s_b_addr'] = get_safe($arr['s_b_addr']);
            $m_send_data_trading['i_b_country'] = intval(get_safe($arr['i_b_country']));
            $m_send_data_trading['i_b_state'] = intval(get_safe($arr['i_b_state']));
            $m_send_data_trading['s_b_city'] = get_safe(get_safe($arr['s_b_city']));
            $m_send_data_trading['s_b_zip'] = get_safe($arr['s_b_zip']);
            $m_send_data_trading['s_b_tele'] = get_safe($arr['s_b_tele']);
            // Billing information [end]                
            // Shipping information [start]
            $m_send_data_trading['s_s_fname'] = get_safe($arr['s_s_fname']);
            $m_send_data_trading['s_s_lname'] = get_safe($arr['s_s_lname']);
            $m_send_data_trading['s_s_addr'] = get_safe($arr['s_s_addr']);
            $m_send_data_trading['i_s_country'] = intval(get_safe($arr['i_s_country']));
            $m_send_data_trading['i_s_state'] = intval(get_safe($arr['i_s_state']));
            $m_send_data_trading['s_s_city'] = get_safe(get_safe($arr['s_s_city']));
            $m_send_data_trading['s_s_zip'] = get_safe($arr['s_s_zip']);
            $m_send_data_trading['s_s_tele'] = get_safe($arr['s_s_tele']);
            // Shipping information [end]
            $m_send_data_trading['s_user_comment'] = get_safe($arr['s_user_comment']);
            $m_send_data_trading['s_transaction_id'] = uniqid('MIT');
            $m_send_data_trading['f_total_trans_price'] = $total_amount;
            $m_send_data_trading['f_enrolement_fee'] = floatval($arr['f_enrolement_fee']);
            // setting user id
            $m_send_data_trading['i_user_id'] = $m_send_data_trade['i_user_id'] = get_safe($arr['i_user_id']);
            // Insert into trading user table
            $this->db->insert('user_trading_details',$m_send_data_trading);            

            //get insert id
            $i_trade_id=$this->db->insert_id();
            

            // Data for package trade details
            $m_send_data_trade['i_trade_id']=  $i_trade_id;
            $m_send_data_trade['i_date']=  time();

            // Cart data insert into table
            foreach($cart as $row) {
                $m_send_data_trade['i_zip_id']=  $row['id'];
                $m_send_data_trade['s_zip_name']=  $row['name'];
                $m_send_data_trade['s_zip_details']=  $row['options']['s_description'];
                $m_send_data_trade['s_zip_quantity']=  $row['qty'];
                $m_send_data_trade['s_price']=  $row['price'];

                // Insert into package trading user table
                $this->db->insert('zip_trade_details',$m_send_data_trade);
            }
            //Delete row from temporary ID
            $this->db->delete('temp_table',array('id'=>$i_temp_id));
            // Checking transaction status
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return 0;
            } else {
                $this->db->trans_commit();
                return 1;
            }
        } else {
            return 0;
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
