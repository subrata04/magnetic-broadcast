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
        $this->s_menu_id = 'menu_home';
    }

    /**
    * Function for showing the home page of model site
    */
    public function index(){
        // echo $page=$page;exit;
        $this->s_title = "Home";
        $this->s_menu_id = 'menu_home';
        $this->s_page_name = 'index';

        //$this->m_data['industry'] = $this->config->item('industry_array');

        $this->render();
    }
                                  
        public function packages(){
        // echo $page=$page;exit;
        $this->s_title = "Package";
        $this->s_menu_id = 'menu_packagse';
        $this->s_page_name = 'packages';

        //$this->m_data['industry'] = $this->config->item('industry_array');

        $this->render();
    }
    
    
            public function about(){
        // echo $page=$page;exit;
        $this->s_title = "About";
        $this->s_menu_id = 'menu_about';
        $this->s_page_name = 'about';

        //$this->m_data['industry'] = $this->config->item('industry_array');

        $this->render();
    }
    
                public function contactus(){
        // echo $page=$page;exit;
        $this->s_title = "Contact Us";
        $this->s_menu_id = 'menu_contactus';
        $this->s_page_name = 'contactus';

        //$this->m_data['industry'] = $this->config->item('industry_array');

        $this->render();
    }
    public function contact()
    {
        
       // $industry = $this->config->item('industry_array');
        
/*        $s_online1 = $this->input->post('online1');
        $s_online2 = $this->input->post('online2');

        if($s_online1 == ''  &&  $s_online2 == ''){
            $s_online = '';
        }else{
            if($s_online1 != ''){
                $arr[] = $s_online1;
            }
            if($s_online2 != ''){
                $arr[] = $s_online2;
            }

            $s_online = serialize($arr);

        }  */



        $m_send_data['s_fname'] = $this->input->post('s_fname');
        $m_send_data['s_lname'] = $this->input->post('s_lname');
        $m_send_data['s_email'] = $this->input->post('s_email');
        $m_send_data['s_phone'] = $this->input->post('s_phone');
        $m_send_data['s_city'] = $this->input->post('s_city');
        $m_send_data['state'] = $this->input->post('state');
        $m_send_data['s_address'] = $this->input->post('s_address');
        $m_send_data['s_zip'] = $this->input->post('s_zip');;
        $m_send_data['s_country'] = $this->input->post('s_country');
        
        $m_send_data['i_added_time'] = time();
       
      
      $i_inserted_id = $this->mod->insertData('contact_details', $m_send_data);
      // exit;
        if($i_inserted_id>0 && strlen($m_send_data['s_fname']) > 2 && strlen($m_send_data['s_lname']) > 2 && strlen($m_send_data['s_email']) > 2 && strlen($this->input->post('s_message')) > 2) {
            $m_send_data['s_message'] = $this->input->post('s_message');
            //echo 23;

            // Multiple data fetching [start]
            $s_tab_name = 'admin_mail';
            $s_select = "*";
            $s_where = 'i_type != 1';
            $s_group_by = 'id';
            $s_order_by_name = 'id';
            $s_order_by = 'DESC';
            $m_email_dataset = $this->mod->fetchMultiData($s_tab_name, $s_select,$s_where, $s_group_by, $s_order_by_name, $s_order_by);
            //var_dump($m_email_dataset);                                                                                                                             
            // Multiple data fetching [end]


            // Multiple data fetching [start]
            $s_tab_name = 'admin_mail';
            $s_select = "*";
            $s_where = 'i_type = 1';
            $s_group_by = 'id';
            $s_order_by_name = 'id';
            $s_order_by = 'DESC';
            $m_sender_dataset = $this->mod->fetchMultiData($s_tab_name, $s_select,$s_where, $s_group_by, $s_order_by_name, $s_order_by);
            //var_dump($m_sender_dataset);
            //exit;
            // Multiple data fetching [end]



            // After registration login the user


            $send_email= $m_sender_dataset[0]['s_email'];

            foreach($m_email_dataset as $row){
                $rec_email[] = $row['s_email'];
            }


            // Setting message

            //print_r($m_send_data);

            $s_msg = "Name : " . get_safe($m_send_data['s_fname'])." ". get_safe($m_send_data['s_lname']);
            $s_msg .= " \r\n Email : " . get_safe($m_send_data['s_email']);
            $s_msg .= "\r\n Phone No : " . get_safe($m_send_data['s_phone']);
            //$s_msg .= "\r\n City : " . get_safe($m_send_data['s_city']);
            $s_msg .= "\r\n Message : " . get_safe($m_send_data['s_message']);
            //$s_msg .= "\r\n Zip : " . get_safe($m_send_data['s_zip']);
            //$s_msg .= "\r\n State : " . get_safe($m_send_data['state']);
            
            //echo 4;


                                $config = Array(
                               'protocol' => 'smtp',
                                'smtp_host' => 'ssl://smtp.googlemail.com',
                                'smtp_port' => 465,
                                'smtp_user' => 'anurag.influxiq3@gmail.com',
                                'smtp_pass' => '@bc123()',
                                'mailtype' => 'html',
                                'charset'   => 'iso-8859-1'
                                );
                                


                                $this->load->library('email',$config);
            //                    $this->email->set_newline("\r\n");

                                
                               $this->email->from('anurag.influxiq3@gmail.com');


                                $this->email->to('debasiskar007@gmail.com');

                                $this->email->subject("Magnatic Broadcasting : Lead Information");
                                //echo 5;

            //  $this->email->message('Hello Worldâ€¦');
                                $this->email->message($s_msg);
             $x= $this->email->send();
             print_r($x);

          $x =mail("debasiskar007@gmail.com,lannah@betoparedes.com,beto@betoparedes.com","Magnatic Broadcasting : Lead Information",$s_msg,"From:support@magneticbroadcast.com \n");
            
            echo 1;
            //exit;
        } 
        else
        {
            echo 2;
        }

    }

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
        $this->m_data['s_redirct_url'] = (!empty($s_redirect_url))?strDecode($s_redirect_url):'';
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
    
        public function get_state_dd_ajax($s_country_id="", $i_sel_id=""){

        $i_country_id = intval($s_country_id);
        echo '<option  value="">Select State</option>'.get_state_dd($i_country_id,$i_sel_id);
    }
    
    
    public function forgot_password() {

        //  $this->s_menu_id = 'menu_login';
        //$this->chk_user_access('non-registered');
        $m_send_data = array();
        $this->m_data['s_title'] = 'Forgot Password';
        $this->m_data['s_msg_login'] = "";
        $this->m_data['s_msg'] ="";

        if(count($_POST)>0) {

            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');   
            //  $this->form_validation->set_rules('usernmae', 'User name', 'required');   

            if ($this->form_validation->run() !== FALSE)
            {
                $email=get_safe($this->input->post('email'));


                //  echo $username;
                $m_ret=$this->mod->fetchSingleData('vw_user_details',array('s_email'=>$email));

                // pr($m_ret);
                // echo  $m_ret1;exit;
                if (count($m_ret)>0 )
                {

                    // $to= $email['s_email'];
                    //                $subject = 'Bio-Source: Password Recovery Mail';
                    //                $message = "Dear ".$name."\n\nYour Password Recovered successfully.\nThe New Password Is Listed Below.\n\nNew Password: ".strDecode($m_ret['s_password'])."\n\nFrom\nBio-Source";
                    //                $headers = 'From: abhranil.involutiontech@gmail.com' . "\r\n" .
                    //                'Reply-To: abhranil.involutiontech@gmail.com';

                    //                mail($to, $subject, $message, $headers);



                    $m_data['name'] = $m_ret['s_firstname'].' '.$m_ret['s_lastname'];
                    $m_data['form'] = config_item('site_admin_email');
                    $m_data['cc'] = config_item('site_cc_email');
                    $m_data['bcc'] = config_item('site_bcc_email');
                    $m_data['subject'] = "Gina:: Password Recovery Mail";
                    $m_data['to'] = get_safe($m_ret['s_email']);

                    // Setting message
                    $s_msg = "Name : " . get_safe($m_ret['s_firstname']) . "  " . get_safe($m_ret['s_lastname']);
                    $s_msg .= "<br />E-Mail : " . get_safe($m_ret['s_email']);
                    $s_msg .= "<br />Password : " . get_safe(strDecode($m_ret['s_password'])) . '<br /><br />';
                    //  $s_msg .= "Login to access your account.";
                    //   $s_msg .= get_email_footer();

                    $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'itplsmtp@gmail.com',
                    'smtp_pass' => '@#pass@#',
                    'mailtype' => 'html',
                    );

                    $this->load->library('email',$config);
                    $this->email->set_newline("\r\n");

                    $this->email->from('itplsmtp@gmail.com', 'Mr. Sam');


                    $this->email->to($m_data['to']);

                    $this->email->subject($m_data['subject']);

                    //  $this->email->message('Hello Worldâ€¦');
                    $this->email->message($s_msg);


                    if (!$this->email->send())
                    {

                        add_msg("Email sending error!!", "err");
                    }
                    else {
                        add_msg("Email send successfully! We will contact you shortly", "ok");

                        redirect(base_url());
                    }

                    //                    $m_data['name'] = $m_ret['s_firstname'].' '.$m_ret['s_lastname'];
                    //                    $m_data['form'] = config_item('site_admin_email');
                    //                    $m_data['to'] = get_safe($m_ret['s_email']);
                    //                    $m_data['cc'] = config_item('site_cc_email');
                    //                    $m_data['bcc'] = config_item('site_bcc_email');
                    //                    $m_data['subject'] = "Gina:: Password Recovery Mail";

                    // Setting message
                    //                    $s_msg = get_email_header() . "Name : " . get_safe($m_ret['s_firstname']) . "  " . get_safe($m_ret['s_lastname']);
                    //                    $s_msg .= "<br />E-Mail : " . get_safe($m_ret['s_email']);
                    //                    $s_msg .= "<br />Password : " . get_safe(strDecode($m_ret['s_password'])) . '<br /><br />';
                    //                    $s_msg .= "Login to access your account.";
                    //                    $s_msg .= get_email_footer();

                    //                    $m_data['message'] = $s_msg;


                    //                    if (ENVIRONMENT == 'development') {
                    // for localmachine
                    //                        do_mail($m_data, TRUE);
                    //                    } else {
                    //                        if (do_mail($m_data)) {
                    //                            add_msg("Email send successfully! We will contact you shortly", "ok");
                    //                            redirect(admin_url());
                    //                        } else {
                    //                            add_msg("Email sending error!!", "err");
                    //                        }
                    //                    } 
                    //                    



                }
                else
                {
                    // $this->m_data['s_msg_login']="This email doesnot exist in our database.";   
                    $this->m_data['s_msg_login']="<div class='errortext'>This email does not exist in our database. </div>";  


                }
            }
            else
            {
                $this->m_data['s_msg'] .= validation_errors('<div class="errortext">', '</div>');
            }

        }

        // $this->load->view(ADMIN_FOLDER.'/home/forgot_password.tpl.php', $this->m_data);
        $this->m_data['s_msg_login']="Enter Email.";   
        //         $this->m_data['s_msg_login'] .= ('<div class="errortext">Enter User name or Email Id</div>');
        $this->m_data['page_name1'] = 'forgot_password';
        $this->load->view('home/forgot_password.tpl.php');
    }
    /**
    * Function for showing feed for twitter
    */


    /**
    * Function for logout the user
    */
    public function logout() {
        $this->session->unset_userdata('ses_user_data',array());
        $this->session->unset_userdata('current_url',"");
        $this->session->sess_destroy();
        add_msg("You have logout successfully.", "ok");
        redirect(admin_url().'login.html');
    }

    /**
    * function for registering an user
    */
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
                $i_inserted_id = $this->mod->insertData('user', $m_send_data);
                if($i_inserted_id>0) {
                    // After registration login the user
                    $this->login_user($m_send_data['s_username'], $m_send_data['s_password']);
                    // Adding message
                    add_msg("You have successfully Registered and Logged in..", "ok");
                    // redirecting the user to home page
                    redirect(pure_base_url().'home.html');
                } 

                else {
                    $this->m_data['s_msg'] = "Error occured!! Please try again..";
                }
            }

        }
        $this->render();
    }

    public function email_check($s_email) {

        $ret_ = $this->mod->fetchSingleData('user_details', array('s_email' => $s_email));
        if (count($ret_) > 0) {
            $this->form_validation->set_message('email_check', '%s already exists in database. Please select other.');
            return FALSE;
        } else {
            return TRUE;
        }
    }





}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

//User “influxho_itpl” was added to the database “influxho_model_v1-1”.