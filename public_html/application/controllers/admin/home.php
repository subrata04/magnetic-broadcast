<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Controller to maintain home page 
* @author: Arnab Chattopadhyay
*/
require APPPATH.'controllers/My_controller.php';

class Home extends My_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user_model' , 'mod');
    }

    public function index(){
        //$this->load->helper('cookie');  
        // echo $arr=get_cookie('itpl_'.strEncode('username'));

        $this->s_title = 'Dashboard';
        $this->s_menu_id = 'menu_home';
        $this->check_user_access('add_admin', get_ses_data('i_roles'));
        // Access specifiying
        // pr(get_ses_data('i_roles'));exit;
     //   $this->check_user_access('home_menu', get_ses_data('i_roles'));    
        
      //  $s_tab_name='user_details';
//        $user_id=get_ses_data('i_user_id');
//        $m_where=array('uid'=>$user_id);
//        $retset = $this->mod->fetchSingleData($s_tab_name, $m_where);  
//        
//        $s_tab_name='comment_manager';
//        $i_logout_time=$retset['t_logout_time'];
//        $m_where='`i_add_time` > '.$i_logout_time;

//        $retset1 = $this->mod->fetchMultiDataCount($s_tab_name, $m_where);  
//        if($retset1)
//        {
//            $t=time();
//            if($retset['t_login_time']==$t)
//            {
//            add_msg("You have ".$retset1." new comments to view.", "ok");
//            }
//        }
       $this->render();
    }
    function changeEmail()
    {
       
        $m_send_data['s_email']=$_POST['email'];
     //   $m_send_data['s_email']=$email;
        $a=$this->mod->updateData('admin_mail',$m_send_data,array('id'=>1)) ;
        echo 1;
    }
    function changeCommission()
    {
       
        $m_send_data['commission']=$_POST['commission'];
     //   $m_send_data['s_email']=$email;
        $a=$this->mod->updateData('commission_setting_details',$m_send_data,array('id'=>1)) ;
        echo $m_send_data['commission'];
    }


    /**
    * function for registering an user
    * /
    public function register() {
    $this->chk_user_access('non-registered');
    $m_send_data = array();
    $m_send_data1 = array();

    // If registration data posted        
    if(count($_POST)>0)
    {
    $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[12]');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|matches[repassword]');
    $this->form_validation->set_rules('repassword', 'Password Confirmation', 'required');
    $this->form_validation->set_rules('fname', 'First Name', 'required');
    $this->form_validation->set_rules('lname', 'Last Name', 'required');
    $this->form_validation->set_rules('phone', 'Phone Number', 'required');

    if ($this->form_validation->run() !== FALSE)    // If data is valid then insert into database
    {
    $m_send_data['s_username'] = get_safe($this->input->post("username"));
    $m_send_data['s_email'] = get_safe($this->input->post("email"));
    $password = get_safe($this->input->post("password"));
    $m_send_data['s_password'] = strEncode($password);
    $m_send_data['s_firstname'] = get_safe($this->input->post("fname"));
    $m_send_data['s_lastname'] = get_safe($this->input->post("lname"));
    $m_send_data['s_phone'] = get_safe($this->input->post("phone"));
    $m_send_data['s_gender'] = get_safe($this->input->post("gender"));
    $m_send_data['i_user_role'] = 2;
    // Inserting user data into database
    $i_inserted_id = $this->mod_pm->insertData('user', $m_send_data);
    if($i_inserted_id>0) {
    // After registration login the user
    $this->login_user($m_send_data['s_username'], $m_send_data['s_password']);
    // Adding message
    add_msg("You have successfully Registered and Logged in..", "ok");
    // redirecting the user to home page
    redirect(base_url().'home.html');
    } else {
    $this->m_data['s_msg'] = "Error occured!! Please try again..";
    }
    }

    }
    $this->render();
    }


    /**
    * Function for showing login user page
    * /
    public function login() {
    $this->chk_user_access('non-registered');
    $m_send_data = array(); 
    $this->b_show_left_pannel = FALSE;
    $this->m_data['s_title'] = 'Login';
    if(count($_POST)>0)
    {
    //pr($_POST, true);
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');   

    if ($this->form_validation->run() !== FALSE)
    {
    $m_send_data['s_username'] = get_safe($this->input->post("username"));
    $password = get_safe($this->input->post("password"));
    $m_send_data['s_password'] = strEncode($password);
    // After registration login the user
    $ret_ = $this->login_user($m_send_data['s_username'], $m_send_data['s_password']);
    // pr($ret_, true);
    //redirecting the user to home page
    //redirect(base_url().'home.html');
    if($ret_){
    add_msg("You have successfully Logged in..", "ok");
    redirect(admin_url().'home.html');
    }else{
    add_msg("Your username or password did not match");
    redirect(admin_url().'login.html', $this->m_data);
    }                
    }
    else
    {
    //$this->m_data['s_msg'] = "Error occured!! Please try again..";
    }
    }
    //        $this->render();
    $this->load->view('admin/home/login.tpl.php', $this->m_data);
    }


    /**
    * Function for login the user
    * 
    * @param mixed $s_username
    * @param mixed $s_password
    * /
    public function login_user($s_username, $s_password) {
    //echo "$s_username, $s_password";exit;
    // fetch data after login for session [start]
    $m_arr = $this->mod_pm->fetchSingleUser($s_username, $s_password);
    // pr($m_arr, true);
    if($m_arr['error']==0){
    $m_user_data['i_user_id'] = $m_arr['id'];
    $m_user_data['b_is_logged'] = TRUE;
    $m_user_data['s_user_email'] = $m_arr['s_email'];
    $m_user_data['s_username'] = $m_arr['s_firstname']." ".$m_arr['s_lastname'];   
    $m_user_data['s_user_role'] = $m_arr['s_role_name'];   
    $this->session->set_userdata('ses_user_data',$m_user_data);
    return TRUE;
    } else {
    return FALSE;
    }        
    // fetch data after login for session [end]
    }
    */




    /**
    * Function for logout the user
    */
    public function logout($s_enc_back_url='') {
        $this->mod->updateData('user_details',array('t_logout_time' => time()), array('uid' => get_ses_data('i_user_id')));
        $this->session->unset_userdata('ses_user_data',array());
        $this->session->unset_userdata('current_url',"");
        $this->session->sess_destroy();
        add_msg("You have logout successfully.", "ok");
        empty($s_enc_back_url)?redirect():redirect(strDecode($s_enc_back_url));
    }


}

/* End of file home.php */
/* Location: ./application/controllers/home.php */


// D:\\xampp\\htdocs\\pornmetro\\php\\extensions\\ffmpeg -i D:\\xampp\\htdocs\\pornmetro\\php\\uploads\\temp\\bb5.avi -f flv D:\\xampp\\htdocs\\pornmetro\\php\\uploads\\user_videos\\bb5.flv
