<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* An abstruct model for extending into other controllers.
* Here we will write the common functions
* 
* @author: Arnab Chattopadhyay
*/

require_once APPPATH.'models/my_model.php';
class Nmi_payment_model extends My_model {

    public $s_nmi_user = 'MPULSEINTERNATIONAL';
    public $s_nmi_pass = 'MPulse220';

    public function __construct() {
        parent::__construct();
        $this->load->file(FCPATH.'nmi/nmiDirectPost.class.php');
    }

    /**
    * Function for sale type transaction
    * 
    * @param mixed $m_data_arr
    */
    public function sale($m_data_arr = array()) {
        if(count($m_data_arr)>0){
            $order_description = (isset($m_data_arr['order_description']) && !empty($m_data_arr['order_description']))?$m_data_arr['order_description']:'';
            $company = (isset($m_data_arr['company']) && !empty($m_data_arr['company']))?$m_data_arr['company']:'';

            // mandatory fields [start]            
            $transaction = new nmiDirectPost(array('nmi_user'=>$this->s_nmi_user,'nmi_password'=>$this->s_nmi_pass));
            
            $address = (isset($m_data_arr['address']) && !empty($m_data_arr['address']))?$m_data_arr['address']:'';
            $city = (isset($m_data_arr['city']) && !empty($m_data_arr['city']))?$m_data_arr['city']:'';
            $zip = (isset($m_data_arr['zip']) && !empty($m_data_arr['zip']))?$m_data_arr['zip']:'';
            $fName = (isset($m_data_arr['fName']) && !empty($m_data_arr['fName']))?$m_data_arr['fName']:'';
            $lName = (isset($m_data_arr['lName']) && !empty($m_data_arr['lName']))?$m_data_arr['lName']:'';
            $state = (isset($m_data_arr['state']) && !empty($m_data_arr['state']))?$m_data_arr['state']:'';
            $phone = (isset($m_data_arr['phone']) && !empty($m_data_arr['phone']))?$m_data_arr['phone']:'';
            $email = (isset($m_data_arr['email']) && !empty($m_data_arr['email']))?$m_data_arr['email']:'';
            
            $transaction->setCcNumber($m_data_arr['ccNo']);
            $transaction->setCcExp($m_data_arr['ccExp']);
            $transaction->setCvv($m_data_arr['ccCvv']);
            $transaction->setAmount($m_data_arr['amount']);
            
            $transaction->setFirstName($fName);
            $transaction->setLastName($lName);
            $transaction->setAddress1($address);
            $transaction->setCity($city);
            $transaction->setState($state);
            $transaction->setZip($zip);
            $transaction->setPhone($phone);
            $transaction->setEmail($email);
            // mandatory fields [end]
            
            // Optional fields [start]
            $transaction->setOrderDescription($order_description);
            $transaction->setCompany($company);
            // Optional fields [end]
            // $transaction->setTax($m_data_arr['tax']); Not Needed
            // $transaction->setShipping($m_data_arr['shipping_cost']); Not Needed
            $transaction->sale();
            $result = $transaction->execute();
            return $result;
        } else {
            return array();
        }
    }

    /**
    * Function for refund type transaction
    * 
    * @param mixed $m_data_arr
    */
    public function refund($m_data_arr = array()){
        if(count($m_data_arr)>0){
            $transaction = new nmiDirectPost(array('nmi_user'=>$this->s_nmi_user,'nmi_password'=>$this->s_nmi_pass));
            $transaction->refund($m_data_arr['transaction_id'], $m_data_arr['amount']);
            $result = $transaction->execute();
            return $result;
        } else {
            return array();
        }

    }



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
