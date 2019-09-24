<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
* Controller to maintain user
* @author: Arnab Chattopadhyay
*/
require APPPATH . 'controllers/My_controller.php';

class Email extends My_Controller {

    public $item_per_page = 5;   
    private $i_edit_id = 0;
    private $m_user_dataset = array();

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user_model', 'mod');
        $this->s_menu_id = 'menu_email';
    }

    public function index(){
        redirect(admin_url().'email/listing');
    }

    /**
    * function for user listing
    */
    public function listing($i_page=1) {

        $this->s_sub_menu_id = 'list_email';

        // Multiple data fetching [start]
        $s_tab_name = 'admin_mail';
        $s_select = "*";
        $s_where = 'i_type != 1';
        $s_group_by = 'id';
        $s_order_by_name = 'id';
        $s_order_by = 'DESC';
        $m_email_dataset = $this->mod->fetchMultiData($s_tab_name, $s_select,$s_where, $s_group_by, $s_order_by_name, $s_order_by);

        // Multiple data fetching [end]


        // Multiple data fetching [start]
        $s_tab_name = 'admin_mail';
        $s_select = "*";
        $s_where = 'i_type = 1';
        $s_group_by = 'id';
        $s_order_by_name = 'id';
        $s_order_by = 'DESC';
        $m_sender_dataset = $this->mod->fetchMultiData($s_tab_name, $s_select,$s_where, $s_group_by, $s_order_by_name, $s_order_by);

        // Multiple data fetching [end]


        $this->m_data['m_email_dataset'] = $m_email_dataset;
        $this->m_data['m_sender_dataset'] = $m_sender_dataset;
        $this->add_js('add_edit_list');
        //pr($m_user_dataset,1);
        $this->m_data['industry'] = $this->config->item('industry_array');

        $this->render();
    }

    public function add_mail(){

        if(count($_POST) > 0){
            $m_arr['i_type'] = $this->input->post('i_type');
            $m_arr['s_email'] = $this->input->post('s_email');

            $this->db->insert('admin_mail',$m_arr);

        }
        redirect(admin_url().'email');


    }

    public function del($s_id='',$s_back_url='') {
        // Access specifiying

        $s_back_url=strDecode($s_back_url);
        //  $this->check_user_access('delt_user', get_ses_data('i_roles'));
        // user data delete
        $i_id = intval(strDecode($s_id));
        $m_where = array('id' => $i_id);

        $ret_ = $this->mod->delData('admin_mail', $m_where);
        // Message setting
        if ($ret_ > 0) {
            add_msg('Email deleted successfully!!', "ok");
        } else {
            add_msg('Email deleted!!', "err");
        }
        redirect($s_back_url);
    }


}

