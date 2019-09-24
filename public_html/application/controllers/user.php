<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* @purpose: Controller to maintain user
* @author: Arnab Chattopadhyay
*/
require APPPATH . 'controllers/My_controller.php';
class User extends My_Controller {
    private $i_edit_id = 0;
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user_model', 'mod');
        $this->load->model('my_model');
        $this->load->library('cart');
        $this->load->model('cart_model');
    }


    
 

 


  
    /**
    * @purpose: Function authenticating an user
    * @author: Arnab Chattopadhyay
    * @param string $s_redirect_url
    */
    public function login($s_redirect_url="") {

        //echo strDecode($s_redirect_url); exit;  
        //  pr($_POST);exit;
        $this->load->helper('cookie');    
        $this->s_menu_id = 'menu_login';
        $this->s_title = 'Login';
        //   $this->chk_user_access('non-registered');
        $m_send_data = array(); 
        $this->m_data['s_title'] = 'Login';
        $this->m_data['s_msg_login'] = "";
     //   $this->m_data['s_redirct_url'] = (!empty($s_redirect_url))?strDecode($s_redirect_url):'';
        if(count($_POST)>0) {

            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required'); 

            if ($this->form_validation->run() !== FALSE) {
                $m_send_data['s_email'] = $email=get_safe($this->input->post("email"));
                $password = get_safe($this->input->post("password"));
                $m_send_data['s_password'] = strEncode($password);

                // After registration login the user
                $ret_ = $this->login_user($m_send_data['s_email'], $m_send_data['s_password']);
//pr($ret_,1);
                if($ret_){
                    

                    /** Remember me portion[Start] **/
                    if($this->input->post('remember')=='yes') {
                        $m_cookie_uname = array(
                        'name'   => strEncode('email'),
                        'value'  => strEncode($m_send_data['s_email']),
                        'expire' => 172800,                      
                        'prefix' => 'itpl_'
                        );
                        set_cookie($m_cookie_uname);  
                        $m_cookie_pass = array(
                        'name'   => strEncode('password'),
                        'value'  => strEncode($m_send_data['s_password']),
                        'expire' => 172800,
                        'prefix' => 'itpl_'
                        );
                        set_cookie($m_cookie_pass);                        
                        $m_cookie_remember = array(
                        'name'   => strEncode('remember'),
                        'value'  => strEncode("yes"),
                        'expire' => 172800,
                        'prefix' => 'itpl_'
                        );
                        set_cookie($m_cookie_remember);

                    }else{
                        delete_cookie('itpl_'.strEncode('username'));
                        delete_cookie('itpl_'.strEncode('password')); 
                        delete_cookie('itpl_'.strEncode('remember'));   
                    }

                    /** Remember me portion[Start] **/
                    //pr(get_ses_data(),1);
                    //echo $s_redirect_url;exit;
                    add_msg('You have successfully login. Welcome '.ucwords(get_ses_data('s_name')), 'ok');
                    //  echo strDecode($s_redirect_url);
                    $this->_redirect_home_page(strDecode($s_redirect_url));
                }else{
                    

                    $this->m_data['s_msg_login'] .= ('<div class="errortext">Your email or password did not match</div>');
                    // redirect(strDecode($s_redirect_url));
                }                
            } else {

                $this->m_data['s_msg_login'] .= validation_errors('<div class="errortext">', '</div>');
            }
        }

        //echo 'vhdsvf';exit;

        //Remember me informantion[Start]

        /* $this->m_data['uname']=strDecode(get_cookie("itpl_".strEncode('username')));
        $this->m_data['pwd']=strDecode(strDecode(get_cookie("itpl_".strEncode('password')))); 
        $this->m_data['remember']=strDecode(get_cookie("itpl_".strEncode('remember'))); 
        */
        //Remember me informantion[End]
        //redirect(base_url().$this->m_data['s_redirct_url'] );
        $this->render();
    }
    /**
    * Function for logout the user
    */
    public function logout($s_enc_back_url='') {

        $this->mod->updateData('user_details',array('t_logout_time' => time()), array('uid' => get_ses_data('i_user_id')));

        $this->session->unset_userdata('ses_user_data',array());
        $this->session->unset_userdata('current_url',"");
        $this->session->sess_destroy();
        add_msg("You have logout successfully.", "ok");
        redirect(strDecode($s_enc_back_url));
    }



 }

/* End of file user.php */
/* Location: ./application/controllers/user.php */
