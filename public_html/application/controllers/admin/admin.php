<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
* Controller to maintain user
* @author: Arnab Chattopadhyay
*/
require APPPATH . 'controllers/My_controller.php';

class Admin extends My_Controller {

    public $item_per_page = 5;   
    private $i_edit_id = 0;
    private $m_user_dataset = array();

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user_model', 'mod');
        $this->s_menu_id = 'menu_admin';
    }
  public function index() {
        redirect(admin_url()."admin/listing.html");
    }

    /**
    * function for registering an user
    */
    public function add() {
        $this->s_title .= "Admin Addition";
        // setting sub-menu items
       $this->s_sub_menu_id = 'add_admin';
        $this->check_user_access('add_admin', get_ses_data('i_roles'));

        $m_send_data = array();
        $this->m_data['m_user_role'] = array();
        $i_state_id="";
        // If registration data posted        
        if (count($_POST) > 0) { //pr($_POST, true);
            $this->form_validation->set_rules('fname', 'First Name', 'required');
            $this->form_validation->set_rules('lname', 'Last Name', 'required');
            //$this->form_validation->set_rules('gender', 'Gender', 'required');

            // $this->form_validation->set_rules('user_role[]', 'User Role', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user_details.s_email]');
            $this->form_validation->set_rules('phone', 'Phone Number', 'required');
            $this->form_validation->set_rules('address', 'Address', '');
            $this->form_validation->set_rules('country', 'Country', '');   
            $this->form_validation->set_rules('state', 'State', '');   
            $this->form_validation->set_rules('city', 'City', '');   
            $this->form_validation->set_rules('zip', 'Zip Code','');   
            // $this->form_validation->set_rules('address', 'Address', 'required'); //Not a required field
            $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[20]|is_unique[user_details.s_username]');
            $this->form_validation->set_rules('password', 'Password', 'required|matches[repassword]');
            $this->form_validation->set_rules('repassword', 'Confirm Password', 'required');

            $this->form_validation->set_message('is_unique', '%s already exists in database. Please select other.');

            $i_state_id=get_safe($this->input->post("state")); 
            // role management
            // $m_user_role = $this->input->post("user_role"); //pr($m_user_role, true);
            //  $this->m_data['m_user_role'] = (!empty($m_user_role)) ? $m_user_role : array();

            if ($this->form_validation->run() !== FALSE) {    // If data is valid then insert into database


                $img_fld_name = 'imgfile';
                $m_arr_image = $_FILES[$img_fld_name];
                // loading upload library
                $this->load->library('upload');    
                // array making [start]
                // pr($m_arr_image);

                if(!empty($m_arr_image)){
                    $m_arr_img_name = $m_arr_image['name'];
                    $m_arr_img_type = $m_arr_image['type'];
                    $m_arr_img_tmp_name = $m_arr_image['tmp_name'];
                    $m_arr_img_error = $m_arr_image['error'];
                    $m_arr_img_size = $m_arr_image['size'];   

                    $config['upload_path'] = $this->config->item('user_image_path');  // resizing will be done
                    $config['allowed_types'] = $this->config->item('main_image_types');
                    $config['max_width']  = "2000";
                    $config['max_height']  = "2000";
                    $config['file_name']  = time();
                    // pr($config,TRUE);
                    // uploading image file settings [end]
                    $this->upload->initialize($config);

                    if($this->upload->do_upload($img_fld_name)){
                        $m_upload_data=$this->upload->data();
                        $i_ch_h = $this->config->item('thumb_user_image_height');
                        $i_ch_w = $this->config->item('thumb_user_image_width');
                        $image_name=$m_upload_data['file_name'];
                        create_full_thumb($m_upload_data['full_path'], $this->config->item('thumb_user_image_path'), $i_ch_h, $i_ch_w);
                    }
                    else{
                        $image_name="";
                        //add_msg($this->upload->display_errors());
                    }


                } 



                $m_send_data['s_username'] = get_safe($this->input->post("username"));
                $m_send_data['s_email'] = get_safe($this->input->post("email"));
                $password = get_safe($this->input->post("password"));
                $m_send_data['s_password'] = strEncode($password);
                $m_send_data['s_firstname'] = get_safe($this->input->post("fname"));
                $m_send_data['s_lastname'] = get_safe($this->input->post("lname"));
                $m_send_data['s_phone'] = get_safe($this->input->post("phone"));
                $m_send_data['s_address'] = get_safe($this->input->post("address"));
                $m_send_data['i_country'] = get_safe($this->input->post("country"));
                $m_send_data['i_state'] = $i_state_id;
                $m_send_data['s_city'] = get_safe($this->input->post("city"));
                $m_send_data['s_zip'] = get_safe($this->input->post("zip"));
                $m_send_data['s_gender'] = get_safe($this->input->post("gender"));
                $m_send_data['s_image_name'] = $image_name;
                //$m_send_data['i_parent_id'] = intval($this->input->post("parent_id"));
                $i_user_role=intval($this->input->post("user_type"));
                $m_send_data['i_parent_id'] = 0;
                $m_send_data['i_user_role'] = $i_user_role;
                $m_send_data['i_is_member'] = 1;
                $m_send_data['i_join_date'] = time();

                // Inserting user data into database
                $i_inserted_id = $this->mod->insertData('user_details', $m_send_data);
                // pr($m_user_role, TRUE);
                if ($i_inserted_id > 0) {

                    if ($this->input->post("reminder") == 'on') {
                        // Sending reminder

                        $m_data['name'] = "";
                        $m_data['form'] = config_item('site_admin_email');
                        $m_data['to'] = get_safe($this->input->post("email"));
                        $m_data['cc'] = config_item('site_cc_email');
                        $m_data['bcc'] = config_item('site_bcc_email');
                        $m_data['subject'] = "M Pulse International: Reminder";

                        // Setting message
                        $s_msg = get_email_header() . "Name : " . get_safe($this->input->post("fname")) . "  " . get_safe($this->input->post("fname"));
                        $s_msg .= "<br />User Name : " . get_safe($this->input->post("username"));
                        $s_msg .= "<br />Email Id : " . get_safe($this->input->post("email"));
                        $s_msg .= "<br />Password : " . get_safe($this->input->post("password")) . '<br /><br />';
                        $s_msg .= "You are now Member Of M Pulse.";
                        $s_msg .= get_email_footer();

                        $m_data['message'] = $s_msg;


                        if (ENVIRONMENT == 'development') {
                            // for localmachine
                            do_mail($m_data, TRUE);
                        } else {
                            if (do_mail($m_data)) {
                                add_msg("Email send successfully! We will contact you shortly", "ok");
                            } else {
                                add_msg("Email sending error!!", "err");
                            }
                        }
                    }

                    // Adding user multiple role [start]

                    $m_send_data1['i_user_id'] = intval($i_inserted_id);
                    $m_send_data1['i_user_role_id'] = intval($i_user_role);
                    $i_inserted_id2 = $this->mod->insertData('user_role_relation', $m_send_data1);

                    // Adding user multiple role [end]
                    // Adding message
                    add_msg("Admin added successfully.", "ok");
                    // redirecting the user to home page
                    redirect(admin_url() . 'admin/listing.html');
                } else {
                    $this->m_data['s_msg'] = "Error occured!! Please try again..";
                }
            }
        }
        $this->m_data['state_id']=$i_state_id;
        $this->render();
    }

    /**
    * function for user listing
    */
    public function listing($i_page=1) {

        //pr(get_ses_data(),true);

        $this->s_title .= "Admin Listing";
        // User role settings
        // $i_user_role = intval(($i_user_role));
        $this->s_sub_menu_id = 'list_admin';

        // Access specifiying
        $this->check_user_access('list_admin', get_ses_data('i_roles'));
        $this->m_data['searchval'] = "";
        //  $ret_ = $this->mod->fetchSingleData('user_role', array('id' => $i_user_role));
        /*  if (count($ret_) > 0) {
        $this->m_data['i_user_role_name'] = $ret_['s_role_name'];
        } else {
        $this->m_data['i_user_role_name'] = "All";
        }
        */
        //$this->m_data['i_user_role'] = $i_user_role;
        $s_where = "";
        if (count($_POST) > 0) {
            $this->form_validation->set_rules('searchval', '', 'required');

            if ($this->form_validation->run() !== FALSE) {    // If data is valid then insert into database
                 $s_search_val = trim(get_safe($this->input->post("searchval")));  
                $this->m_data['searchval'] = $s_search_val; 
                $s_where = "i_is_member = 1 AND (`s_firstname` LIKE '%" . $s_search_val . "%' OR `s_lastname` LIKE '%" . $s_search_val . "%' OR `s_username` LIKE '%" . $s_search_val . "%' OR CONCAT( `s_firstname` , ' ', `s_lastname` ) LIKE '%" . $s_search_val . "%')";
               // $s_where = "`s_firstname` LIKE '%" . $s_search_val . "%' OR `s_lastname` LIKE '%" . $s_search_val . "%' OR `s_username` LIKE '%" . $s_search_val . "%'";
            }
        }

        // Multiple data fetching [start]
        $s_tab_name = 'vw_user_details';
        $s_select = "*, group_concat(`s_role_name` separator ', ') AS `s_roles`,group_concat(`i_user_role` separator ',') AS `i_roles`";
        //pr(get_ses_data('i_roles'),true);
        if (in_array(ADMIN_ROLE, get_ses_data('i_roles'))) {
            // // if the user role is admin
            $m_where = (!empty($s_where)) ? $s_where . "AND `i_is_member` =1 " : "`i_is_member` =1 ";
            /*if ($i_user_role > 0)       */   
            // $m_where = $m_where . " AND i_user_role=2";
            $m_where = $m_where . " AND id!=".get_ses_data('i_user_id')." AND i_user_role=2";    
            $s_group_by = 'id';
            $s_order_by_name = 'id';
            $s_order_by = 'DESC';
            $m_user_dataset = $this->mod->fetchMultiData($s_tab_name, $s_select, $m_where, $s_group_by, $s_order_by_name, $s_order_by,$this->item_per_page,intval(($i_page-1)*$this->item_per_page));
            $i_total_rows = $this->mod->fetchMultiDataCount($s_tab_name, $m_where, $s_group_by);

            if($i_total_rows>0){
                $i_last_page = (($i_total_rows/$this->item_per_page)>intval($i_total_rows/$this->item_per_page))?(intval($i_total_rows/$this->item_per_page)+1):($i_total_rows/$this->item_per_page);
                if($i_last_page<$i_page){   // If no data found            
                    redirect(admin_url().'admin/listing/'.$i_last_page);
                }
            }
        }else {


            // For user other than admin will see the users below them
            $i_user_id = get_ses_data("i_user_id");
            $m_where = (!empty($s_where)) ? $s_where . " AND `i_is_member` =1 " : "`i_is_member` =1 ";
            $m_where = $m_where . " AND id!=".get_ses_data('i_user_id')." AND i_user_role=2"; 
            $s_group_by = 'id';
            $s_order_by_name = 'id';
            $s_order_by = 'DESC';
            $m_user_dataset = $this->mod->fetchMultiData($s_tab_name, $s_select, $m_where, $s_group_by, $s_order_by_name, $s_order_by,$this->item_per_page,intval(($i_page-1)*$this->item_per_page));
            $i_total_rows = $this->mod->fetchMultiDataCount($s_tab_name, $m_where, $s_group_by);
            if($i_total_rows>0){
                $i_last_page = (($i_total_rows/$this->item_per_page)>intval($i_total_rows/$this->item_per_page))?(intval($i_total_rows/$this->item_per_page)+1):($i_total_rows/$this->item_per_page);
                if($i_last_page<$i_page){   // If no data found            
                    redirect(admin_url().'admin/listing/'.$i_last_page);
                }
            }

            // $this->_child_list($m_user_dataset, $i_user_role);
            // $m_user_dataset = $this->m_user_dataset;
        }
        // Multiple data fetching [end]

        $this->load->library('pagination');
        $m_conf['base_url'] = admin_url().'admin/listing/';
        $m_conf['total_rows'] = $i_total_rows;
        $m_conf['per_page'] = $this->item_per_page;        
        $m_conf['uri_segment'] = 4;
        $m_conf['num_links'] = 2;                
        $m_conf1 = $this->get_paginition_config_();
        $m_conf = array_merge($m_conf, $m_conf1);
        $this->pagination->initialize($m_conf);
        $this->m_data['user_page_link'] = $this->pagination->create_links(); 

        $this->m_data['m_dataset'] = $m_user_dataset;
        $this->add_js('add_edit_list');
        $this->render();
    }

    /**
    * 
    */

    public function manage_user($i_page=1){
        $this->s_title .= "User Listing";
        // User role settings
        // $i_user_role = intval(($i_user_role));
        $this->s_sub_menu_id = 'list_user';

        // Access specifiying
        $this->check_user_access('list_user', get_ses_data('i_roles'));
        $this->m_data['searchval'] = "";
        //  $ret_ = $this->mod->fetchSingleData('user_role', array('id' => $i_user_role));
        /*  if (count($ret_) > 0) {
        $this->m_data['i_user_role_name'] = $ret_['s_role_name'];
        } else {
        $this->m_data['i_user_role_name'] = "All";
        }
        */
        //$this->m_data['i_user_role'] = $i_user_role;

        $m_where="`i_user_role` =3";
        $s_search_name=$this->session->userdata('s_search_name');   
        $s_start_date=$this->session->userdata('s_start_date');
        $s_finish_date=$this->session->userdata('s_finish_date');
        $s_verify_stat=$this->session->userdata('s_verfy_stat');
        $s_payment_opt=$this->session->userdata('s_payment_opt');
        $s_gender=$this->session->userdata('s_gender'); 
        //   $i_finish_date = intval(strtotime($s_finish_date)+24*60*60);

        if(!empty($s_search_name)){
            $m_where = $m_where." AND (`s_firstname` LIKE '%" . $s_search_name . "%' OR `s_lastname` LIKE '%" . $s_search_name . "%' OR `s_username` LIKE '%" . $s_search_name . "%')";
        }

        $i_finish_date = intval(strtotime($s_finish_date)+24*60*60);
        $i_start_date = intval(strtotime($s_start_date));

        if($i_finish_date>0 && $i_start_date>0) {
            //  $m_where.=(!empty($s_where))? $s_where." AND `i_join_date` between ".$i_start_date." and ".$i_finish_date."":"`i_join_date` between ".$i_start_date." and ".$i_finish_date."";     
            $m_where=$m_where." AND `i_join_date` between ".$i_start_date." and ".$i_finish_date."";
        }

        if(!empty($s_verify_stat)){
            if($s_verify_stat==1){
                // $s_where.=(!empty($s_where))? $s_where." AND `s_verification_id` = '' ":"`s_verification_id` = ' ' "; 
                $m_where=$m_where." AND `s_verification_id` = '' ";  

            } 
            else{
                // $s_where.=(!empty($s_where))? $s_where." AND `s_verification_id` != '' ":"`s_verification_id` != ' ' ";     
                $m_where=$m_where." AND `s_verification_id` != '' "; 
            } 
        }




        if(!empty($s_payment_opt)){
            // $s_where.=(!empty($s_where))? $s_where." AND `i_payment_option` = ".$s_payment_opt." ":"`i_payment_option` =".$s_payment_opt." ";    
            $m_where=$m_where." AND `i_payment_option` = ".$s_payment_opt." "; 
        }        

        if(!empty($s_gender)){
            $m_where=$m_where." AND `s_gender` = '".$s_gender."' "; 
        }

        $this->m_data['s_search_name']=$s_search_name;
        $this->m_data['s_start_date']=$s_start_date;   
        $this->m_data['s_finish_date']=$s_finish_date;   
        $this->m_data['s_verify_stat']=$s_verify_stat;   
        $this->m_data['s_payment_opt']=$s_payment_opt;   
        $this->m_data['s_gender']=$s_gender; 

        // Multiple data fetching [start]
        $s_tab_name = 'vw_user_details';
        $s_select = "*, group_concat(`s_role_name` separator ', ') AS `s_roles`,group_concat(`i_user_role` separator ',') AS `i_roles`";
        //pr(get_ses_data('i_roles'),true);

        // $m_where = (!empty($s_where)) ? $s_where . " AND `i_user_role` =3 " : "`i_user_role` =3 ";
        // // if the user role is admin
        // $m_where = (!empty($s_where)) ? $s_where . "AND `i_is_member` =1 " : "`i_is_member` =1 ";
        /*if ($i_user_role > 0)       */   
        // $m_where = $m_where . " AND i_user_role=2";

        $s_group_by = 'id';
        $s_order_by_name = 'id';
        $s_order_by = 'DESC';
        $m_user_dataset = $this->mod->fetchMultiData($s_tab_name, $s_select, $m_where, $s_group_by, $s_order_by_name, $s_order_by,$this->item_per_page,intval(($i_page-1)*$this->item_per_page));

        $i_total_rows = $this->mod->fetchMultiDataCount($s_tab_name, $m_where, $s_group_by);
        if($i_total_rows>0){
            $i_last_page = (($i_total_rows/$this->item_per_page)>intval($i_total_rows/$this->item_per_page))?(intval($i_total_rows/$this->item_per_page)+1):($i_total_rows/$this->item_per_page);
            if($i_last_page<$i_page){   // If no data found            
                redirect(admin_url().'user/manage-user/'.$i_last_page);
            }
        }

        $this->load->library('pagination');
        $m_conf['base_url'] = admin_url().'user/manage-user/';
        $m_conf['total_rows'] = $i_total_rows;
        $m_conf['per_page'] = $this->item_per_page;        
        $m_conf['uri_segment'] = 4;
        $m_conf['num_links'] = 2;                
        $m_conf1 = $this->get_paginition_config_();
        $m_conf = array_merge($m_conf, $m_conf1);
        $this->pagination->initialize($m_conf);
        $this->m_data['user_page_link'] = $this->pagination->create_links(); 


        // Multiple data fetching [end]

        $this->m_data['m_dataset'] = $m_user_dataset;
        $this->add_js('add_edit_list');
        $this->render();
    }

    /**
    * function of seraching of user portion
    * @author Abirlal Mukherjee
    */

    public function search_user_all($s_action=""){
        if($s_action=="all"){
            $this->session->set_userdata('s_search_name','');
            $this->session->set_userdata('s_start_date','');
            $this->session->set_userdata('s_finish_date','');
            $this->session->set_userdata('s_verfy_stat','');
            $this->session->set_userdata('s_payment_opt','');
            $this->session->set_userdata('s_gender','');
            redirect(admin_url()."user/manage-user.html");
        }
        if(count($_POST)>0){
            $s_serach_name=$this->input->post('search_name');
            $s_start_date=$this->input->post('start_date');
            $s_finish_date=$this->input->post('finish_date');
            $s_verify_stat=$this->input->post('verify_stat');
            $s_payment_opt=$this->input->post('payment_opt');
            $s_gender=$this->input->post('gender');     

            $this->session->set_userdata('s_search_name',$s_serach_name);
            $this->session->set_userdata('s_start_date',$s_start_date);
            $this->session->set_userdata('s_finish_date',$s_finish_date);
            $this->session->set_userdata('s_verfy_stat',$s_verify_stat);
            $this->session->set_userdata('s_payment_opt',$s_payment_opt);
            $this->session->set_userdata('s_gender',$s_gender);  
            redirect(admin_url()."user/manage-user.html");
        }
    }


    /**
    * functoion for sign up configuration
    * @author Abirlal Mukherjee
    *
    */

    public function signupconfig($s_edit_id=""){
        $this->s_title .= "User Listing";
        // User role settings
        // $i_user_role = intval(($i_user_role));



        $this->s_sub_menu_id = 'sign_up_conf';

        $this->check_user_access('sign_up_conf', get_ses_data('i_roles'));
        $m_send_data = array();
        $i_edit_id = intval(strDecode($s_edit_id));

        $retset=array();
        // Multiple data fetching for listing [start]        
        $retsetall = $this->mod->fetchMultiData("configuration", "*");  
        // Multiple data fetching for listing [end]

        // Multiple data fetching for edit [start]

        if($i_edit_id>0){
            $retset = $this->mod->fetchSingleData("configuration", array('id'=>$i_edit_id));
            $this->m_data['s_action']="edit";
        }   
        else{
            $this->m_data['s_action']="add"; 
        }
        // Multiple data fetching for edit [end]
        if(count($_POST)>0){
            $this->form_validation->set_rules('ammount','Ammount','required|decimal');
            $this->form_validation->set_rules('dayofsub','Day of Subscribssion','required|numeric|greater_than[0]');
            $this->form_validation->set_rules('texttoshow','Text to Show','required'); 
            if($this->form_validation->run()!=FALSE){
                $m_send_data['d_ammount']=$this->input->post('ammount');
                $m_send_data['i_day_of_sub']=$this->input->post('dayofsub');  
                $m_send_data['s_text_to_show']=$this->input->post('texttoshow');     

                if($this->m_data['s_action']=="edit"){
                    $ret_=$this->mod->updateData('configuration',$m_send_data,array('id'=>$i_edit_id));
                }
                else{
                    $ret_=$this->mod->insertData('configuration',$m_send_data);
                } 
                if($ret_>0){
                    add_msg("The Sign Up Configuration is setup","ok");
                    redirect(admin_url()."user/signupconfig.html");
                }
                else{
                    add_msg("Error occured..Pls Try Again","err");
                    redirect(admin_url()."user/signupconfig.html");
                }

            }
        }   
$is_free = 0;
if(count($retsetall)){
    foreach($retsetall as $m_row){
        if($m_row['is_show_in_signup'] == 1){
            $is_free = 1;
            break;
        }
    }
}


        // Access specifiying

        $this->m_data['m_all_dataset']=$retsetall;
        $this->m_data['m_dataset']=$retset;
        $this->m_data['is_free']=$is_free;

        $this->check_user_access('sign_up_conf', get_ses_data('i_roles'));
        $this->add_js(array(ADMIN_FOLDER."/accounting",'add_edit_list'));

        $this->render();
    }
    
    public function changeConfigure()
    {
           
               $chk_signup=$this->input->post('chk_signup');
              // print_r($chk_signup);exit;  
              
               if($chk_signup =='')
               
               {
$this->mod->updateData1();                 }
               else
               {
          $this->mod->updateData1();                
                foreach($chk_signup as $val){
                    $this->mod->updateData('configuration',array('is_show_in_signup' => 1),array('id' => $val));
                }
                
               }

               redirect('admin/user/signupconfig/');
               
              // print_r($chk_signup);exit;
                  
                
    
        
    }


    /**
    * Delete the signup configuration
    * @author Abirlal Mukherjee  
    */

    public function del_signupconfig($s_edit_id=""){
        $this->s_sub_menu_id = 'sign_up_conf';

        $this->check_user_access('sign_up_conf', get_ses_data('i_roles'));
        $m_send_data = array();
        $i_edit_id = intval(strDecode($s_edit_id));
        $ret_=$this->mod->delData('configuration',array('id'=>$i_edit_id));   
        if($ret_>0){
            add_msg("Sign Up Configuration is deleted","ok");
            redirect(admin_url()."user/signupconfig.html");
        }  
        else{
            add_msg("Error Occured......Please Try Again","err");
            redirect(admin_url()."user/signupconfig.html");
        }
    }

    /**
    * User Banning with reason
    * 
    * @param mixed $m_user_dataset
    * @author Abirlal Mukherjee
    */


    public function statChange()
    {
        
        $id=$_POST['id'];
        $check_type=$_POST['check_type'];
                        $m_send_data['is_show_in_signup ']=$_POST['value'];   

   //     $is_show_in_signup =$_POST['value'];
                        if($check_type=="single"){
                    $ret_=$this->mod->updateData('configuration',$m_send_data,array('id'=>$id));
                }
                else{
                    $ret_=$this->mod->updateData('configuration',$m_send_data);
                } 
echo 1;
    }
    
    public function ban_user(){
        if(count($_POST)>0){
            $m_data['s_block_reason']=get_safe($this->input->post('reason'));
            $m_data['i_is_active']=get_safe($this->input->post('stat'));
            $m_where['uid']=get_safe(strDecode($this->input->post('uid')));
            $m_data['i_block_date']=time();
            $ret_ = $this->mod->updateData('user_details',$m_data,$m_where);
            if($ret_){
                add_msg("Admin blocked successfully.", 'ok');
                // redirect(admin_url().'user/listing.html');
            }else{
                add_msg("Admin status change not done");
                // redirect(admin_url().'user/listing.html');
            }
        }
    }


    /**
    * User Unbanning
    * 
    * @param mixed $m_user_dataset
    * @author Abirlal Mukherjee
    */


    public function change_state($s_state='', $s_enc_id='',$s_back_url=""){
        //    echo $s_state; exit;
        $i_is_allow =($s_state=='allow')?1:2;
        $i_id = intval(strDecode($s_enc_id));

        $ret_ = $this->mod->updateData('user_details',array('i_is_active'=>$i_is_allow), array('uid'=>$i_id));
        if($ret_){
            ($i_is_allow==1)?add_msg("Admin unblocked successfully.", 'ok'):add_msg("Admin blocked successfully.", 'ok');
        }else{
            add_msg("Admin status change not done");
        }
        redirect(base_url().strDecode($s_back_url));
    }


    /**
    * Change State of User
    * @author: Abirlal Mukherjee
    */

    public function change_state_user($s_state='', $s_enc_id='',$s_back_url=""){
        //    echo $s_state; exit;
        $i_is_allow =($s_state=='allow')?1:2;
        $i_id = intval(strDecode($s_enc_id));

        $ret_ = $this->mod->updateData('user_details',array('i_is_active'=>$i_is_allow), array('uid'=>$i_id));
        if($ret_){
            ($i_is_allow==1)?add_msg("Admin unblocked successfully.", 'ok'):add_msg("Admin blocked successfully.", 'ok');
        }else{
            add_msg("Admin status change not done");
        }
        redirect(base_url().strDecode($s_back_url));
    }


    /**
    * Change Multiple user data(Multiple Delete And Update)..
    * 
    * @author Abirlal Mukherjee
    */



    public function change_multi() {
        $s_msg_type = "err";
        $s_msg = "";
        $m_ids = $this->input->post('ids');
        $s_action = $this->input->post('action');
        $i_role=$this->input->post('role');   

        switch($s_action){
            case 0: // CASE NO ACTION
                $s_msg_type = "err";
                $s_msg = "Please choose an action.";
                break;
            case 1: // CASE DELETE
                foreach($m_ids as $s_id){
                    $i_id = strDecode($s_id);
                    $m_where = array('uid'=>$i_id);
                    $dataset = $this->mod->fetchSingleData('user_details',$m_where);

                    $ret_ = $this->mod->delData('user_details',$m_where);
                    if($ret_>0){
                        if($dataset['s_image_name']!=""){
                            @unlink(config_item('thumb_user_image_path').$dataset['s_image_name']);
                            @unlink(config_item('user_image_path').$dataset['s_image_name']);
                        }
                        $ret1_=$this->mod->delData('user_role_relation',array('i_user_id'=>$i_id));
                    }

                }
                $s_msg_type = "ok";
                if($i_role==ADMIN_ROLE){
                    add_msg("Selected Admin deleted successfully.", "ok");
                }
                else if($i_role==USER_ROLE){
                        add_msg("Selected User deleted successfully.", "ok");
                    }
                    break;

            case 2: // CASE INACTIVE 
                foreach($m_ids as $s_id){
                    $i_id = strDecode($s_id);
                    $m_where = array('uid'=>$i_id);
                    $d_where=array('i_is_active'=>2);
                    $ret_ = $this->mod->updateData('user_details',$d_where,$m_where);                                  
                }
                $s_msg_type = "ok";
                if($i_role==ADMIN_ROLE){
                    add_msg("Selected Admin Blocked successfully.", "ok");
                }
                else if($i_role==USER_ROLE){
                        add_msg("Selected User Blocked successfully.", "ok");
                    }
                    break;   

            case 3: // CASE ACTIVE
                foreach($m_ids as $s_id){
                    $i_id = strDecode($s_id);
                    $m_where = array('uid'=>$i_id);
                    $d_where=array('i_is_active'=>1);
                    $ret_ = $this->mod->updateData('user_details',$d_where,$m_where);                                  
                }
                $s_msg_type = "ok";
                if($i_role==ADMIN_ROLE){
                    add_msg("Selected Admin Unblocked successfully.", "ok");
                }
                else if($i_role==USER_ROLE){
                    add_msg("Selected User Unblocked successfully.", "ok");   
                }
                break;    

            default:
                $s_msg = "Error occured!!";
                $s_msg_type = "err";
                break;
        }        

        echo json_encode(array("msg"=>$s_msg_type, "data"=>$s_msg));
    }



    /**
    * Change Multiple config data(Multiple Delete And Update)..
    * 
    * @author Abirlal Mukherjee
    */



    public function change_multi_config() {
        $s_msg_type = "err";
        $s_msg = "";
        $m_ids = $this->input->post('ids');
        $s_action = $this->input->post('action');
        switch($s_action){
            case 0: // CASE NO ACTION
                $s_msg_type = "err";
                $s_msg = "Please choose an action.";
                break;
            case 1: // CASE DELETE
                foreach($m_ids as $s_id){
                    $i_id = strDecode($s_id);
                    $m_where = array('id'=>$i_id);                                        
                    $ret_ = $this->mod->delData('configuration',$m_where);                    
                }
                $s_msg_type = "ok";
                add_msg("Selected Sign up Configuration deleted successfully.", "ok");
                break;

            default:
                $s_msg = "Error occured!!";
                $s_msg_type = "err";
                break;
        }        

        echo json_encode(array("msg"=>$s_msg_type, "data"=>$s_msg));
    }

    function _child_list($m_user_dataset=array(), $i_user_role="") {
        if (count($m_user_dataset)) {
            foreach ($m_user_dataset as $m_row_data) {
                if ((intval($i_user_role) > 0) && ($m_row_data['i_user_role'] == $i_user_role))
                    $this->m_user_dataset[] = $m_row_data;
                elseif (intval($i_user_role) == 0)
                    $this->m_user_dataset[] = $m_row_data;
                $s_tab_name = 'vw_user_details';
                $s_select = "*, group_concat(`s_role_name` separator ', ') AS `s_roles`,group_concat(`i_user_role` separator ',') AS `i_roles`";
                $i_user_id = $m_row_data["id"];
                $m_where = (!empty($s_where)) ? $s_where . " AND `i_parent_id` =" . $i_user_id . " AND `i_is_member` =1 " : "`i_parent_id` =" . $i_user_id . " AND `i_is_member` =1 ";
                $s_group_by = 'id';
                $s_order_by_name = 'id';
                $s_order_by = 'DESC';
                $m_user_dataset = $this->mod->fetchMultiData($s_tab_name, $s_select, $m_where, $s_group_by, $s_order_by_name, $s_order_by);
                $this->_child_list($m_user_dataset, $i_user_role);
            }
        }
    }

    /**
    * function for unassigned member listing
    */
    public function unassigned_members_listing($i_user_role="") {

        $this->s_title .= " :: Unassigned Member Listing";
        // User role settings
        $i_user_role = intval(($i_user_role));
        $this->s_sub_menu_id = 'list_user';

        // Access specifiying
        $this->check_user_access('list_unass_user', get_ses_data('i_roles'));
        $this->m_data['searchval'] = "";
        $ret_ = $this->mod->fetchSingleData('user_role', array('id' => $i_user_role));
        if (count($ret_) > 0) {
            $this->m_data['i_user_role_name'] = $ret_['s_role_name'];
        } else {
            $this->m_data['i_user_role_name'] = "All";
        }
        $this->m_data['i_user_role'] = $i_user_role;
        $s_where = "";
        if (count($_POST) > 0) {
            $this->form_validation->set_rules('searchval', 'Search By Name/User Name', 'required');

            if ($this->form_validation->run() !== FALSE) {    // If data is valid then insert into database
                $s_search_val = get_safe($this->input->post("searchval"));
                $this->m_data['searchval'] = $s_search_val;
                $s_where = "i_is_member = 2 AND `i_parent_id` = 0 AND (`s_firstname` LIKE '%" . $s_search_val . "%' OR `s_lastname` LIKE '%" . $s_search_val . "%' OR `s_username` LIKE '%" . $s_search_val . "%')";
            }
        }

        // Multiple data fetching [start]
        $s_tab_name = 'vw_user_details';
        $s_select = "*, group_concat(`s_role_name` separator ', ') AS `s_roles`,group_concat(`i_user_role` separator ',') AS `i_roles`";
        $m_where = (!empty($s_where)) ? $s_where . "AND `i_is_member` = 2 AND `i_parent_id` = 0 " : "`i_is_member` = 2 AND `i_parent_id` = 0 ";
        if ($i_user_role > 0)
            $m_where = $m_where . " AND i_user_role=$i_user_role";
        $s_group_by = 'id';
        $s_order_by_name = 'id';
        $s_order_by = 'DESC';
        $m_user_dataset = $this->mod->fetchMultiData($s_tab_name, $s_select, $m_where, $s_group_by, $s_order_by_name, $s_order_by);
        // Multiple data fetching [end]

        $this->m_data['m_dataset'] = $m_user_dataset;
        $this->add_js('add_edit_list');
        $this->render();
    }

    /**
    * function for userdetails edit
    */
    public function edit($s_edit_id='',$s_back_url='') {
        $this->s_title .= "User Edit";
        $s_back_url=(!empty($s_back_url))?strDecode($s_back_url):admin_url()."admin/listing.html";
        $i_edit_id = intval(strDecode($s_edit_id));
        if($i_edit_id < 1)redirect(base_url() . 'admin/listing.html');
        // setting sub-menu items
        $this->s_sub_menu_id = 'add_admin';
        // Access specifiying
        if(get_ses_data('i_user_id')!=$i_edit_id)   // For My personal information edit
            $this->check_user_access('add_admin', get_ses_data('i_roles'));

        $m_send_data = array();
        $this->i_edit_id = $i_edit_id;
        // Multiple data fetching [start]
        $s_tab_name = 'vw_user_details';
        $s_select = "*, group_concat(`s_role_name` separator ', ') AS `s_roles`, group_concat(`i_user_role`) AS `i_roles`";
        $m_where = array('id' => $i_edit_id);
        /* if($i_user_role>0)
        $m_where=array('i_user_role'=>$i_user_role); */
        $s_group_by = 'id';
        $s_order_by_name = 'id';
        $s_order_by = 'DESC';
        $retset = $this->mod->fetchMultiData($s_tab_name, $s_select, $m_where, $s_group_by, $s_order_by_name, $s_order_by);
        $retset = (count($retset)) ? $retset[0] : $retset;
        // Multiple data fetching [end]
        $i_state_id=$retset['i_state'];
        if (count($retset) == 0) {
            add_msg("No User details found to edit", "info");
            redirect(admin_url() . 'admin/listing.html');
        }

        if (count($_POST) > 0) {
            //pr($_FILES);
            //pr($_POST,true);
            try {
                /// Validation rule setting [start]
                $this->form_validation->set_rules('fname', 'First Name', 'required');
                $this->form_validation->set_rules('lname', 'Last Name', 'required');
                $this->form_validation->set_rules('gender', 'Gender', 'required');
                //$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_is_unique_email');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
                $this->form_validation->set_rules('phone', 'Phone Number', 'required');
                $this->form_validation->set_rules('address', 'Address', '');
                $this->form_validation->set_rules('country', 'Country', '');   
                $this->form_validation->set_rules('state', 'State', '');   
                $this->form_validation->set_rules('city', 'City', '');   
                $this->form_validation->set_rules('zip', 'Zip Code','');  

                // $this->form_validation->set_rules('address', 'Address', 'required');
                /// Validation rule setting [end]
                // New role management                
                //$this->form_validation->set_rules('user_role[]', 'User Role', 'required');

                $i_state_id=get_safe($this->input->post("state"));     

                $this->form_validation->set_message('is_unique', '%s already exists in database. Please select other.');

                // data validation check
                if ($this->form_validation->run() !== FALSE) {

                    if($_FILES['imgfile']['size']>0){
                        $img_fld_name = 'imgfile';
                        $m_arr_image = $_FILES[$img_fld_name];
                        // loading upload library
                        $this->load->library('upload');  

                        // array making [start]
                        if(count($m_arr_image)>0){
                            $m_arr_img_name = $m_arr_image['name'];
                            $m_arr_img_type = $m_arr_image['type'];
                            $m_arr_img_tmp_name = $m_arr_image['tmp_name'];
                            $m_arr_img_error = $m_arr_image['error'];
                            $m_arr_img_size = $m_arr_image['size'];   

                            $config['upload_path'] = $this->config->item('user_image_path');  // resizing will be done
                            $config['allowed_types'] = $this->config->item('main_image_types');
                            $config['max_width']  = "5000";
                            $config['max_height']  = "5000";
                            $config['file_name'] =time();
                            // pr($config,TRUE);
                            // uploading image file settings [end]
                            $this->upload->initialize($config);

                            if($this->upload->do_upload($img_fld_name)){
                                $m_upload_data=$this->upload->data();
                                $i_ch_h = $this->config->item('thumb_user_image_height');
                                $i_ch_w = $this->config->item('thumb_user_image_width');
                                $image_name=$m_upload_data['file_name'];

                                create_full_thumb($m_upload_data['full_path'], $this->config->item('thumb_user_image_path'), $i_ch_h, $i_ch_w);
                                if($retset['s_image_name']!="") {
                                    @unlink($this->config->item('thumb_user_image_path').$retset['s_image_name']);
                                    @unlink($this->config->item('user_image_path').$retset['s_image_name']);
                                }

                                $m_send_data['s_image_name'] = $image_name;

                            } else {                                                
                                $this->m_data['s_msg']=$this->upload->display_errors("","");
                            }
                        } 
                    }

                    $m_send_data['s_firstname'] = get_safe($this->input->post("fname"));
                    $m_send_data['s_lastname'] = get_safe($this->input->post("lname"));
                    $m_send_data['s_email'] = get_safe($this->input->post("email"));
                    $m_send_data['s_phone'] = get_safe($this->input->post("phone"));
                    $m_send_data['s_address'] = get_safe($this->input->post("address"));
                    $m_send_data['i_country'] = get_safe($this->input->post("country"));
                    $m_send_data['i_state'] = $i_state_id;
                    $m_send_data['s_city'] = get_safe($this->input->post("city"));
                    $m_send_data['s_zip'] = get_safe($this->input->post("zip"));
                    $m_send_data['s_gender'] = get_safe($this->input->post("gender"));
                    $m_send_data['i_parent_id'] = 0;
                    $i_user_role=intval($this->input->post("user_type"));
                    $m_send_data['i_user_role'] = $i_user_role;

                    // New user management
                    //$m_user_role = $this->input->post("user_role");


                    // data update into Database [start]
                    $s_tab_name = 'user_details';
                    $m_data_arr = $m_send_data;
                    $m_where = array('uid' => $i_edit_id);
                    $b_ret_ = $this->mod->updateData($s_tab_name, $m_data_arr, $m_where);
                    unset($s_tab_name, $m_data_arr, $m_where);
                    // data update into Database [end]

                    if ($b_ret_) {
                        // Updating user multiple role [start]

                        if ($this->input->post("reminder") == 'on') {
                            // Sending reminder

                            $m_data['name'] = "";
                            $m_data['form'] = config_item('site_admin_email');
                            $m_data['to'] = get_safe($this->input->post("email"));
                            $m_data['cc'] = config_item('site_cc_email');
                            $m_data['bcc'] = config_item('site_bcc_email');
                            $m_data['subject'] = "M Pulse International: Reminder";

                            // Setting message
                            $s_msg = get_email_header() . "Name : " . get_safe($this->input->post("fname")) . "  " . get_safe($this->input->post("fname"));
                            $s_msg .= "<br />User Name : " . get_safe($this->input->post("username"));
                            $s_msg .= "<br />Password : " . get_safe($this->input->post("password")) . '<br /><br />';
                            $s_msg .= "You are now Member Of M Pulse.";
                            $s_msg .= get_email_footer();

                            $m_data['message'] = $s_msg;


                            if (ENVIRONMENT == 'development') {
                                // for localmachine
                                do_mail($m_data, TRUE);
                            } else {
                                if (do_mail($m_data)) {
                                    add_msg("Email send successfully! We will contact you shortly", "ok");
                                } else {
                                    add_msg("Email sending error!!", "err");
                                }
                            }
                        }



                        // deleting data from role table
                        /*   $this->mod->delData('user_role_relation', array('i_user_id' => $i_edit_id));

                        $m_send_data1['i_user_id'] = intval($i_edit_id);
                        foreach ($m_user_role as $s_role) {
                        $m_send_data1['i_user_role_id'] = intval(strDecode($s_role));
                        $i_inserted_id2 = $this->mod->insertData('user_role_relation', $m_send_data1);
                        }

                        */
                        // Updating user multiple role [end]
                        add_msg('User data updated successfully!!', "ok");
                        redirect($s_back_url);
                    } else {
                        $this->m_data['s_msg'] = "Error occured!! Please try again..";
                    }
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        if ($i_edit_id > 0) {
            $m_send_data = $retset;
        }

        $this->m_data['state_id']=$i_state_id;  
        $this->m_data['m_send_data'] = $m_send_data;
        $this->add_js('add_edit_list');
        $this->render();
    }

    /**
    * function to test unique email
    *
    * @param mixed $s_email
    */
    public function is_unique_email($s_email) {
        $this->i_edit_id;
        if ($str == 'test') {
            $this->form_validation->set_message('is_unique_email', '%s already exists in database. Please select other.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
    * function for deleting user
    *
    * @param mixed $s_id
    */
    public function del($s_id='',$s_back_url='') {
        // Access specifiying

        $s_back_url=strDecode($s_back_url);
        $this->check_user_access('delt_user', get_ses_data('i_roles'));
        // user data delete
        $i_id = intval(strDecode($s_id));
        $m_where = array('uid' => $i_id);

        $retset=$this->mod->fetchSingleData('user_details',$m_where);

        $ret_ = $this->mod->delData('user_details', $m_where);
        // Message setting
        if ($ret_ > 0) {
            @unlink(config_item('thumb_user_image_path').$retset['s_image_name']);
            @unlink(config_item('user_image_path').$retset['s_image_name']);     
            $ret_ = $this->mod->delData('user_role_relation',array('i_user_id'=>$i_id));                           
            $ret_ = $this->mod->delData('user_offer',array('i_user_id'=>$i_id));                           
            add_msg('Admin deleted successfully!!', "ok");
        } else {
            add_msg('Admin not deleted!!', "err");
        }
        redirect($s_back_url);
    }

    /**
    * Function for edit account
    * @param type $i_user_id
    */
    /*   public function edit_account($i_user_id=0) {
    if (count($_POST) > 0) {
    //pr($_POST, TRUE);
    $i_edit_id = intval(strDecode($this->input->post("uid")));
    if (!$i_edit_id) {
    echo "";
    exit;
    }
    $this->i_edit_id = $i_edit_id;
    $password = trim($this->input->post("pass"));

    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
    $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[12]|callback_username_check');
    if (!empty($password)) {
    $this->form_validation->set_rules('pass', 'Password', 'required|matches[repass]');
    $this->form_validation->set_rules('repass', 'Confirm Password', 'required');
    }

    $this->form_validation->set_message('is_unique', '%s already exists in database. Please select other.');

    if ($this->form_validation->run() !== FALSE) {    // If data is valid then insert into database
    $m_send_data['s_email'] = get_safe($this->input->post("email"));
    $m_send_data['s_username'] = get_safe($this->input->post("username"));
    $m_send_data['s_password'] = strEncode(get_safe($password));
    // data update into Database [start]
    $s_tab_name = 'user_details';
    $m_data_arr = $m_send_data;
    $m_where = array('uid' => $i_edit_id);
    $b_ret_ = $this->mod->updateData($s_tab_name, $m_data_arr, $m_where);
    if(get_ses_data('i_user_id')==$i_edit_id){
    set_ses_data('s_username', $m_send_data['s_username']);
    }
    unset($s_tab_name, $m_data_arr, $m_where);
    // data update into Database [end]

    if ($b_ret_) {
    add_msg('User data updated successfully!!', "ok");
    echo show_msg();
    } else {
    echo '<div id="error">' . "Error occured!! Please try again.." . '</div>';
    }
    } else {
    echo validation_errors('<div id="error">', '</div>');
    }
    }
    } */
    /**
    * Function for edit account(Modification)
    * @author Abirlal Mukherjee
    */
    public function edit_account($i_user_id=0) {
        if (count($_POST) > 0) {
            //pr($_POST, TRUE);
            $i_edit_id = intval(strDecode($this->input->post("uid")));
            if (!$i_edit_id) {
                echo "";
                exit;
            }
            $this->i_edit_id = $i_edit_id;
            $password = trim($this->input->post("password"));

            $newpass=trim($this->input->post("pass"));

            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Old Password', 'required');

            if (!empty($newpass)) {
                $this->form_validation->set_rules('pass', 'New Password', 'required|min_length[5]|matches[repass]');
                $this->form_validation->set_rules('repass', 'New Confirm Password', 'required');
            }

            $this->form_validation->set_message('is_unique', '%s already exists in database. Please select other.');

            if ($this->form_validation->run() !== FALSE) {    // If data is valid then insert into database
                // $m_send_data['s_email'] = get_safe($this->input->post("email"));

                $m_send_data['s_password'] = get_safe(strEncode($this->input->post("password")));
                $m_send_data['id']=intval($i_edit_id);
                //  $m_send_data['i_user_role']=2;
                $m_send_data['i_is_member']=1;

                $resultset=$this->mod->fetchSingleData("itpl_vw_user_details",$m_send_data);
                if(!empty($resultset)){
                    if($newpass!=""){
                        $m_send_data1['s_password'] = strEncode(get_safe($this->input->post('pass')));
                    }
                    $m_send_data1['s_email'] = get_safe($this->input->post("email"));
                    $m_send_data1['s_username'] = get_safe($this->input->post("username"));
                    // data update into Database [start]
                    $s_tab_name = 'user_details';
                    //$m_data_arr = $m_send_data;
                    $m_where = array('uid' => $i_edit_id);
                    $b_ret_ = $this->mod->updateData($s_tab_name, $m_send_data1, $m_where);
                    /*  if(get_ses_data('i_user_id')==$i_edit_id){
                    set_ses_data('s_username', $m_send_data['s_username']);
                    } */
                    unset($s_tab_name, $m_send_data1, $m_where);
                    // data update into Database [end]

                    if ($b_ret_) {
                        //add_msg('User data updated successfully!!', "ok");
                        // echo show_msg();
                        echo '<div class="ok closeable">' . "User data updated successfully!!" . '<div class="click_to_close" onclick="abc(this);"></div></div>';
                    } else {
                        echo '<div class="error closeable">' . "Error occured!! Please try again.." . '<div class="click_to_close" onclick="abc(this);"></div></div>';
                        // add_msg('Error occured!! Please try again..', "err");
                        //  echo show_msg();
                    } 
                }
                else{
                    echo '<div class="error closeable">Old Password did not match..></div>';
                    //  add_msg('Old Password did not match..', "err");
                    //echo show_msg();
                }


            } else {
                echo validation_errors('<div class="error closeable">','</div>');
                // add_msg('Old Password is required.', "err");
                //echo show_msg();
            }
        }
    }

    /**
    * Function for email checking validation
    * @param type $s_email
    * @return boolean
    */
    public function email_check($s_email) {
        $ret_ = $this->mod->fetchSingleData('user_details', array('uid !=' => $this->i_edit_id, 's_email' => $s_email));
        if (count($ret_) > 0) {
            $this->form_validation->set_message('email_check', '%s already exists in database. Please select other.');
            return FALSE;
        } else {
            return TRUE;
        }
    }



    /**
    * Function for username Validation
    * @param type $s_username
    * @return boolean
    */
    public function username_check($s_username) {
        $ret_ = $this->mod->fetchSingleData('user_details', array('uid !=' => $this->i_edit_id, 's_username' => $s_username));
        if (count($ret_) > 0) {
            $this->form_validation->set_message('username_check', '%s already exists in database. Please select other.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
    * function for showing popup for user info account
    *
    * @param mixed $s_id
    */
    public function user_info_ajax($s_id="") {
        $i_id = intval(strDecode($s_id));
        if ($i_id == 0) {
            echo "No User information found!";
            exit;
        } else {
            // Multiple data fetching [start]
            $s_tab_name = 'vw_user_details';
            $s_select = "*, group_concat(`s_role_name` separator ', ') AS `s_roles`, group_concat(`i_user_role`) AS `i_roles`";
            $m_where = array('id' => $i_id);
            $s_group_by = 'id';
            $s_order_by_name = 'id';
            $s_order_by = 'DESC';
            $retset = $this->mod->fetchMultiData($s_tab_name, $s_select, $m_where, $s_group_by, $s_order_by_name, $s_order_by);
            $retset = (count($retset)) ? $retset[0] : $retset;
            // Multiple data fetching [end]
            // data setting to array
            $m_data['m_send_data'] = $retset;

            $this->load->view(ADMIN_FOLDER . "/admin/user_info_ajax.tpl.php", $m_data);
        }
    }

    /**
    * function for showing popup for user info account
    *
    * @param mixed $s_id
    */
    public function personal_info_ajax($s_id="") {
        $i_id = intval(strDecode($s_id));
        if ($i_id == 0) {
            echo "No User information found!";
            exit;
        } else {
            // Multiple data fetching [start]
            $s_tab_name = 'vw_user_details';
            $s_select = "*, group_concat(`s_role_name` separator ', ') AS `s_roles`, group_concat(`i_user_role`) AS `i_roles`";
            $m_where = array('id' => $i_id);
            $s_group_by = 'id';
            $s_order_by_name = 'id';
            $s_order_by = 'DESC';
            $retset = $this->mod->fetchMultiData($s_tab_name, $s_select, $m_where, $s_group_by, $s_order_by_name, $s_order_by);
            $retset = (count($retset)) ? $retset[0] : $retset;
            // Multiple data fetching [end]
            // data setting to array
            $m_data['m_send_data'] = $retset;

            $this->load->view(ADMIN_FOLDER . "/admin/personal_info_ajax.tpl.php", $m_data);
        }
    }

    /**
    * function for showing popup for user info account
    *
    * @param mixed $s_id
    */
    public function user_accn_ajax($s_id="") {
        $i_id = intval(strDecode($s_id));
        if ($i_id == 0) {
            echo "No User information found!";
            exit;
        } else {
            // Single data fetching [start]
            $s_tab_name = 'vw_user_details';
            $m_where = array('id' => $i_id);
            $retset = $this->mod->fetchSingleData($s_tab_name, $m_where);
            unset($s_tab_name, $m_where);
            // Single data fetching [end]
            // data setting to array
            $m_data['m_send_data'] = $retset;

            $this->load->view(ADMIN_FOLDER . "/admin/user_accn_ajax.tpl.php", $m_data);
        }
    }
    /**
    * function for showing popup for user info account
    *
    * @param mixed $s_id
    */
    public function my_accn_ajax($s_id="") {
        $i_id = intval(strDecode($s_id));
        if ($i_id == 0) {
            echo "No User information found!";
            exit;
        } else {
            // Single data fetching [start]
            $s_tab_name = 'vw_user_details';
            $m_where = array('id' => $i_id);
            $retset = $this->mod->fetchSingleData($s_tab_name, $m_where);
            unset($s_tab_name, $m_where);
            // Single data fetching [end]
            // data setting to array
            $m_data['m_send_data'] = $retset;
            $this->load->view(ADMIN_FOLDER . "/admin/my_accn_ajax.tpl.php", $m_data);
        }
    }

    /**  
    * Added By Samsuj[start]
    * function for user listing
    */
    public function lead_listing() {
        $this->s_title .= " :: Lead Listing";
        // User role settings
        $this->s_sub_menu_id = 'list_lead';

        // Access specifiying
        $this->check_user_access('list_lead', get_ses_data('i_roles'));



        // Multiple data fetching [start]
        $s_tab_name = 'vw_lead_details';
        $s_select = "*, group_concat('s_role_name' separator ', ') AS `s_roles`,group_concat('i_user_role' separator ',') AS `i_roles`";
        $m_where = array('i_is_member' => 2);
        $s_group_by = 'id';
        $s_order_by_name = 'id';
        $s_order_by = 'DESC';
        $m_data = $this->mod->fetchMultiData($s_tab_name, $s_select, $m_where, $s_group_by, $s_order_by_name, $s_order_by);
        // Multiple data fetching [end]

        if (count($_POST) > 0) {
            $this->form_validation->set_rules('searchval', '', 'required');

            if ($this->form_validation->run() !== FALSE) {    // If data is valid then insert into database
                $s_search_val = get_safe($this->input->post("searchval"));

                $s_tab_name = 'vw_user_details';
                $s_select = "*, group_concat('s_role_name' separator ', ') AS `s_roles`,group_concat('i_user_role' separator ',') AS `i_roles`";

                $str = "i_is_member = 2 AND (`s_firstname` LIKE '%" . $s_search_val . "%' OR `s_lastname` LIKE '%" . $s_search_val . "%' OR `s_username` LIKE '%" . $s_search_val . "%')";

                $m_where = $str;
                $s_group_by = 'id';
                $s_order_by_name = 'id';
                $s_order_by = 'DESC';
                $m_data = $this->mod->fetchMultiData($s_tab_name, $s_select, $m_where, $s_group_by, $s_order_by_name, $s_order_by);
            }
        }



        $this->m_data['m_dataset'] = $m_data;
        $this->add_js('add_edit_list');
        $this->render();
    }

    /**
    * Function for add LEAD
    */
    public function add_lead() {
        $this->s_title .= " :: Lead Addition";
        // setting sub-menu items
        $this->s_sub_menu_id = 'add_lead';
        $this->check_user_access('add_lead', get_ses_data('i_roles'));

        $m_send_data = array();
        $this->m_data['m_user_role'] = array();
        // If registration data posted        
        if (count($_POST) > 0) {
            $this->form_validation->set_rules('fname', 'First Name', 'required');
            $this->form_validation->set_rules('lname', 'Last Name', 'required');
            $this->form_validation->set_rules('gender', 'Gender', 'required');
            $this->form_validation->set_rules('access_ids', 'Access to user (Promoters List)', 'required');

            $m_send_data['s_username'] = get_safe($this->input->post("username"));
            $password = get_safe($this->input->post("password"));
            $m_send_data['s_password'] = strEncode($password);

            //$this->form_validation->set_rules('user_role[]', 'User Role', 'required');
            //$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user_details.s_email]');
            //$this->form_validation->set_rules('phone', 'Phone Number', 'required|numeric');
            //$this->form_validation->set_rules('address', 'Address', 'required');

            if (!empty($m_send_data['s_username'])) {
                $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[12]|is_unique[user_details.s_username]');
                $this->form_validation->set_message('is_unique', '%s already exists in database. Please select other.');
            }
            if (!empty($password)) {
                $this->form_validation->set_rules('password', 'Password', 'required|matches[repassword]');
                $this->form_validation->set_rules('repassword', 'Confirm Password', 'required');
            }

            //
            // role management
            $m_user_role = $this->input->post("user_role"); //pr($m_user_role, true);
            $this->m_data['m_user_role'] = (!empty($m_user_role)) ? $m_user_role : array();

            if ($this->form_validation->run() !== FALSE) {    // If data is valid then insert into database
                $m_send_data['s_email'] = get_safe($this->input->post("email"));
                $m_send_data['s_firstname'] = get_safe($this->input->post("fname"));
                $m_send_data['s_lastname'] = get_safe($this->input->post("lname"));
                $m_send_data['s_phone'] = get_safe($this->input->post("phone"));
                $m_send_data['s_address'] = get_safe($this->input->post("address"));
                $m_send_data['s_gender'] = get_safe($this->input->post("gender"));
                $m_send_data['i_parent_id'] = intval($this->input->post("parent_id"));
                $m_send_data['i_is_member'] = intval($this->input->post("user_type"));

                // Inserting user data into database
                $i_inserted_id = $this->mod->insertData('user_details', $m_send_data);
                // pr($m_user_role, TRUE);
                if ($i_inserted_id > 0) {

                    if ($this->input->post("reminder") == 'on') {
                        // Sending reminder

                        $m_data['name'] = "";
                        $m_data['form'] = config_item('site_admin_email');
                        $m_data['to'] = get_safe($this->input->post("email"));
                        $m_data['cc'] = config_item('site_cc_email');
                        $m_data['bcc'] = config_item('site_bcc_email');
                        $m_data['subject'] = "M Pulse International: Reminder";

                        // Setting message
                        $s_msg = get_email_header() . "Name : " . get_safe($this->input->post("fname")) . "  " . get_safe($this->input->post("fname"));
                        $s_msg .= "<br />User Name : " . get_safe($this->input->post("username"));
                        $s_msg .= "<br />Password : " . get_safe($this->input->post("password")) . '<br /><br />';
                        $s_msg .= "You are now Lead Of M Pulse.";
                        $s_msg .= get_email_footer();

                        $m_data['message'] = $s_msg;


                        if (ENVIRONMENT == 'development') {
                            // for localmachine
                            do_mail($m_data, TRUE);
                        } else {
                            if (do_mail($m_data)) {
                                add_msg("Email send successfully! We will contact you shortly", "ok");
                            } else {
                                add_msg("Email sending error!!", "err");
                            }
                        }
                    }



                    // Adding user multiple role [start]
                    $m_send_data1['i_user_id'] = intval($i_inserted_id);
                    foreach ($m_user_role as $s_role) {
                        $m_send_data1['i_user_role_id'] = intval(strDecode($s_role));
                        $i_dummy = $this->mod->insertData('user_role_relation', $m_send_data1);
                    }
                    unset($i_dummy, $m_send_data1);
                    // Adding user multiple role [end]
                    // Adding user access[start]
                    $m_lead_access = array();
                    $m_send_data1['i_lead_id'] = intval($i_inserted_id);
                    $m_lead_access = $this->input->post("access_ids");
                    foreach ($m_lead_access as $i_access) {
                        $m_send_data1['i_user_id'] = intval($i_access);
                        $i_dummy = $this->mod->insertData('lead_access', $m_send_data1);
                    }
                    unset($i_dummy, $m_send_data1);
                    // Adding user access[end]
                    // Adding message
                    add_msg("User added successfully.", "ok");
                    // redirecting the user to home page
                    redirect(admin_url() . 'user/lead-listing.html');
                } else {
                    $this->m_data['s_msg'] = "Error occured!! Please try again..";
                }
            }
        }
        $this->render();
    }

    /**
    * Function for edit LEAD
    * @param type $s_edit_id
    */
    public function edit_lead($s_edit_id='') {
        $this->s_title .= " :: User Edit";
        // setting sub-menu items
        $this->s_sub_menu_id = 'add_lead';
        // Access specifiying
        $this->check_user_access('add_user', get_ses_data('i_roles'));

        $m_send_data = array();

        $i_edit_id = intval(strDecode($s_edit_id));
        if ($i_edit_id < 1

        )redirect(base_url() . 'user/lead-listing.html');

        $this->i_edit_id = $i_edit_id;

        // Multiple data fetching [start]
        $s_tab_name = 'vw_lead_details';
        $s_select = "*, group_concat(`s_role_name` separator ', ') AS `s_roles`, group_concat(`i_user_role`) AS `i_roles`, group_concat(`i_access_id`) AS `s_access_ids`";
        $m_where = array('id' => $i_edit_id);
        /* if($i_user_role>0)
        $m_where=array('i_user_role'=>$i_user_role); */
        $s_group_by = 'id';
        $s_order_by_name = 'id';
        $s_order_by = 'DESC';
        $retset = $this->mod->fetchMultiData($s_tab_name, $s_select, $m_where, $s_group_by, $s_order_by_name, $s_order_by);
        $retset = (count($retset)) ? $retset[0] : $retset;
        // Multiple data fetching [end]

        if (count($retset) == 0) {
            add_msg("No User details found to edit", "info");
            redirect(admin_url() . 'user/listing.html');
        }

        if (count($_POST) > 0) {
            //pr($_FILES);
            //pr($_POST,true);
            try {
                /// Validation rule setting [start]
                $this->form_validation->set_rules('fname', 'First Name', 'required');
                $this->form_validation->set_rules('lname', 'Last Name', 'required');
                $this->form_validation->set_rules('gender', 'Gender', 'required');
                //$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_is_unique_email');
                //$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
                //$this->form_validation->set_rules('phone', 'Phone Number', 'required|numeric');
                //$this->form_validation->set_rules('address', 'Address', 'required');
                $this->form_validation->set_rules('access_ids', 'Access to user (Promoters List)', 'required');

                /// Validation rule setting [end]
                // New role management                
                $this->form_validation->set_rules('user_role[]', 'User Role', 'required');

                $this->form_validation->set_message('is_unique', '%s already exists in database. Please select other.');

                // data validation check
                if ($this->form_validation->run() !== FALSE) {

                    $m_send_data['s_firstname'] = get_safe($this->input->post("fname"));
                    $m_send_data['s_lastname'] = get_safe($this->input->post("lname"));
                    $m_send_data['s_email'] = get_safe($this->input->post("email"));
                    $m_send_data['s_phone'] = get_safe($this->input->post("phone"));
                    $m_send_data['s_address'] = get_safe($this->input->post("address"));
                    $m_send_data['s_gender'] = get_safe($this->input->post("gender"));
                    $m_send_data['i_parent_id'] = intval($this->input->post("parent_id"));
                    $m_send_data['i_is_member'] = intval($this->input->post("user_type"));

                    // New user management
                    $m_user_role = $this->input->post("user_role");


                    // data update into Database [start]
                    $s_tab_name = 'user_details';
                    $m_data_arr = $m_send_data;
                    $m_where = array('uid' => $i_edit_id);
                    $b_ret_ = $this->mod->updateData($s_tab_name, $m_data_arr, $m_where);
                    unset($s_tab_name, $m_data_arr, $m_where);
                    // data update into Database [end]

                    if ($b_ret_) {
                        // Updating user multiple role [start]


                        if ($this->input->post("reminder") == 'on') {
                            // Sending reminder

                            $m_data['name'] = "";
                            $m_data['form'] = config_item('site_admin_email');
                            $m_data['to'] = get_safe($this->input->post("email"));
                            $m_data['cc'] = config_item('site_cc_email');
                            $m_data['bcc'] = config_item('site_bcc_email');
                            $m_data['subject'] = "M Pulse International: Reminder";

                            // Setting message
                            $s_msg = get_email_header() . "Name : " . get_safe($this->input->post("fname")) . "  " . get_safe($this->input->post("fname"));
                            $s_msg .= "<br />User Name : " . get_safe($this->input->post("username"));
                            $s_msg .= "<br />Password : " . get_safe($this->input->post("password")) . '<br /><br />';
                            $s_msg .= "You are now Lead Of M Pulse.";
                            $s_msg .= get_email_footer();

                            $m_data['message'] = $s_msg;


                            if (ENVIRONMENT == 'development') {
                                // for localmachine
                                do_mail($m_data, TRUE);
                            } else {
                                if (do_mail($m_data)) {
                                    add_msg("Email send successfully! We will contact you shortly", "ok");
                                } else {
                                    add_msg("Email sending error!!", "err");
                                }
                            }
                        }





                        // deleting data from role table
                        $this->mod->delData('user_role_relation', array('i_user_id' => $i_edit_id));

                        $m_send_data1['i_user_id'] = intval($i_edit_id);
                        foreach ($m_user_role as $s_role) {
                            $m_send_data1['i_user_role_id'] = intval(strDecode($s_role));
                            $i_inserted_id2 = $this->mod->insertData('user_role_relation', $m_send_data1);
                        }
                        unset($m_send_data1, $i_inserted_id2);
                        // Updating user multiple role [end]
                        // Adding user access[start]
                        $m_send_data1['i_lead_id'] = intval($i_edit_id);
                        // deleting previous data
                        $this->mod->delData('lead_access', array('i_lead_id' => intval($i_edit_id)));
                        $m_lead_access = $this->input->post("access_ids");
                        foreach ($m_lead_access as $i_access) {
                            $m_send_data1['i_user_id'] = intval($i_access);
                            $i_dummy = $this->mod->insertData('lead_access', $m_send_data1);
                        }
                        unset($i_dummy, $m_send_data1);
                        // Adding user access[end]

                        add_msg('User data updated successfully!!', "ok");
                        redirect(admin_url() . 'user/lead-listing.html');
                    } else {
                        $this->m_data['s_msg'] = "Error occured!! Please try again..";
                    }
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        if ($i_edit_id > 0) {
            $m_send_data = $retset;
        }


        $this->m_data['m_send_data'] = $m_send_data;
        $this->add_js('add_edit_list');
        $this->render();
    }

    /**
    * Function for send Notification
    * @param type $s_edit_id
    */
    function send_notification($s_edit_id='') {
        $i_edit_id = intval(strDecode($s_edit_id));
        if ($i_edit_id < 1

        )redirect(base_url() . 'user/lead-listing.html');

        $s_tab_name = 'vw_user_details';
        $m_where = array('id' => $i_edit_id);
        $retset = $this->mod->fetchSingleData($s_tab_name, $m_where);

        // Sending reminder

        $m_data['name'] = "";
        $m_data['form'] = config_item('site_admin_email');
        $m_data['to'] = get_safe($retset['s_email']);
        $m_data['cc'] = config_item('site_cc_email');
        $m_data['bcc'] = config_item('site_bcc_email');
        $m_data['subject'] = "M Pulse International: Reminder";

        // Setting message
        $s_msg = get_email_header() . "Name : " . get_safe($retset['s_firstname']) . "  " . get_safe($retset['s_lastname']);
        $s_msg .= "<br />User Name : " . get_safe($retset['s_username']);
        $s_msg .= "<br />Password : " . get_safe(strDecode($retset['s_password'])) . '<br /><br />';
        $s_msg .= "You are now Lead Of M Pulse.";
        $s_msg .= get_email_footer();

        $m_data['message'] = $s_msg;


        if (ENVIRONMENT == 'development') {
            // for localmachine
            do_mail($m_data, TRUE);
        } else {
            if (do_mail($m_data)) {
                add_msg("Email send successfully! We will contact you shortly", "ok");
            } else {
                add_msg("Email sending error!!", "err");
            }
        }


        if ($retset['i_is_member'] == 1) {
            redirect(admin_url() . 'user/listing.html');
        }

        if ($retset['i_is_member'] == 2) {
            redirect(admin_url() . 'user/lead-listing.html');
        }
    }

    /**
    * function for specific url of site
    */
    function my_refferer_url() {
        // User id fetching
        $i_end_user_id = get_ses_data("i_user_id");
        $this->s_sub_menu_id = "my_ref_url";
        // Single data fetch
        $ret_ = $this->mod->fetchSingleData("vw_user_details", "`id` =" . $i_end_user_id . " AND (`i_user_role`=" . PROMOTER_PRO_ROLE . " OR `i_user_role`=" . PROMOTER_ROLE . ')');

        if (count($ret_)) {
            // user name setting
            $this->m_data['s_username'] = $ret_['s_username'];
            // Multiple data fetching [start]
            $s_tab_name = 'vw_product_details';
            $s_select = '*';
            $m_where = array();
            $s_group_by = 'id';
            $s_order_by_name = "i_is_main";
            $s_order_by = "ASC";
            $this->m_data['m_dataset'] = $this->mod->fetchMultiData($s_tab_name, $s_select, $m_where, $s_group_by, $s_order_by_name, $s_order_by);
            // Multiple data fetching [end]
        } else {
            // echo admin_url().'user.html'; exit;
            redirect(admin_url());
        }
        $this->render();
    }

    /**
    * function for Compensation Plan by Samsuj[start]
    */
    public function compensation_plan($i_time_interval="") {


        $this->s_title .= " :: Compensation Plan";
        $this->s_sub_menu_id = 'comp_plan';
        $this->m_data['searchval'] = "";

        // Access specifiying
        $this->check_user_access('list_user', get_ses_data('i_roles'));


        $this->load->model('user_model');
        $last = $this->user_model->lastdate();


        // Multiple data fetching [start]
        $s_where = "i_end_date = " . $last;
        $s_order_by_name = "";
        $s_order_by = "";
        $s_tab_name = 'itpl_vw_user_commission';
        $s_select = '*';
        $this->m_data['m_dataset'] = $this->mod->fetchMultiData($s_tab_name, $s_select, $s_where);
        // Multiple data fetching [end]


        if (count($_POST) > 0) {
            $this->form_validation->set_rules('searchval', '', 'required');

            if ($this->form_validation->run() !== FALSE) {    // If data is valid then insert into database
                $s_search_val = get_safe($this->input->post("searchval"));
                $this->m_data['searchval'] = $s_search_val;
                $s_where = "(`s_firstname` LIKE '%" . $s_search_val . "%' OR `s_lastname` LIKE '%" . $s_search_val . "%')";
                $s_group_by = 'id';
                $s_order_by_name = "i_end_date";
                $s_order_by = "DESC";
                $s_tab_name = 'itpl_vw_user_commission';
                $s_select = '*';
                $this->m_data['m_dataset'] = $this->mod->fetchMultiData($s_tab_name, $s_select, $s_where, $s_group_by, $s_order_by_name, $s_order_by);
                // Multiple data fetching [end]
            }
        }



        $this->add_js('add_edit_list');
        $this->render();
    }




}

