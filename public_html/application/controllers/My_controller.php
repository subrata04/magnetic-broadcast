<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Main controller for extending into other controllers.
* @author: Arnab Chattopadhyay
*/

class My_controller extends CI_Controller {
    public $m_data = array();

    public $s_title = "";
    public $s_title_be = "Administrative Console | Ripoff Report";
    public $s_title_fe = "Alt Fatale";
    public $s_page_name= "";

    public $b_stop_back_button = FALSE;  // Set this variable as FALSE to stopping browser back button

    public $b_show_left_pannel = TRUE;  // Set this variable as FALSE to hide left panel
    public $b_show_right_pannel = TRUE; // Set this variable as FALSE to hide right panel
    public $b_show_lower_top_pannel = FALSE; // Set this variable as FALSE to hide lower top panel

    // layout variable [start] theme canbe implemented by changing these variables
    //public $s_header_top = "layouts/header_top.tpl.php";
    //public $s_lower_top = "layouts/lower_top.tpl.php";    
    public $s_header = "layouts/header.tpl.php";
    public $s_left_panel = "layouts/left_panel.tpl.php";
    public $s_right_panel = "layouts/right_panel.tpl.php";
    public $s_footer = "layouts/footer.tpl.php";
    // layout variable [end]

    public $s_menu_id = "";
    public $s_sub_menu_id = "";
    public $s_cat_menu_id = "";
    public $uname="";
    public $password="";
    public $remember="";

    public $i_item_perpage = 10;
    public $m_d_fetured_model = array();

    // default js and css loading
    public $s_js = "";
    public $s_css = "";

    /** user data store purpose after user login **/
    public $m_user_data = array(
    "i_user_id"=>0,
    "b_is_logged"=>FALSE, 
    "s_user_email"=>"", 
    "i_roles"=>"",
    "s_roles"=>"",
    "s_username"=>""
    );

    public $s_cur_page = "";
    // referrer name store purpose
    public $s_referrer_name = "";

    public function __construct() {
        parent::__construct();       
        $this->m_data['i_item_perpage'] = $this->i_item_perpage;
        $this->m_data['s_redirct_url'] = $this->uri->uri_string();
         
        if($this->router->fetch_directory()==ADMIN_FOLDER.'/') {
            $this->s_header = ADMIN_FOLDER."/layouts/header.tpl.php";
            $this->s_left_panel = ADMIN_FOLDER."/layouts/left_panel.tpl.php";
            $this->s_right_panel = ADMIN_FOLDER."/layouts/right_panel.tpl.php";
            $this->s_footer = ADMIN_FOLDER."/layouts/footer.tpl.php";

            // settings css and js file for admin specific design
            $this->add_css(array('site_admin', 'jquery-ui','menu', 'facebox', 'tipsy', 'custom'));
            $this->add_js(array(ADMIN_FOLDER.'/jquery-ui-1.10.3.custom.min', ADMIN_FOLDER.'/facebox', ADMIN_FOLDER.'/tipsy',ADMIN_FOLDER.'/jquery.blockUI', 'accounting',ADMIN_FOLDER.'/custom', ADMIN_FOLDER.'/common'));
        } else {
            // loading default js and css file for front end
            $this->add_js(array('jquery172','jquery.lightbox-0.5','jquery.tabify','jquery-ui-block','contentslider','json','facebox','jquery.fancybox-1.3.4.pack','common'));
            $this->add_css(array('style','custom-style','jquery.lightbox-0.5','car-skin','facebox','jquery.fancybox-1.3.4'));
        }
        
        $this->m_data['m_d_fetured_model'] = $this->_get_d_featured_model();

    }

    public function index() {
        redirect(base_url());
    }

    /**
    * Function for loading the default features
    */
    public function load_default(){
        // echo $this->router->fetch_directory();
        // echo $this->session->userdata('current_url');      
        $this->load->helper('cookie');          

        $ses_get_user_data = $this->session->userdata('ses_user_data');
        if(!is_null($ses_get_user_data) && count($ses_get_user_data)>0){
            $this->m_user_data = $ses_get_user_data;
        }
        // pr($ses_get_user_data);
        $this->m_data['m_user_data'] = $this->m_user_data;
        $this->m_data['s_menu_id'] = $this->s_menu_id;
        $this->m_data['s_sub_menu_id'] = $this->s_sub_menu_id;
        $this->m_data['s_cat_menu_id'] = $this->s_cat_menu_id;

        // loading css and js
        $this->m_data['s_js'] = $this->s_js;
        $this->m_data['s_css'] = $this->s_css;

        // setting title
        if($this->router->fetch_directory()=="") {
            $this->m_data['s_title'] = $this->s_title." | ".$this->s_title_fe;
            $this->m_data['s_page_name'] = $this->s_page_name;
        } else {
            $this->m_data['s_title'] = $this->s_title." | ".$this->s_title_be;
        }
     //   $this->uname=strDecode(get_cookie("itpl_".strEncode('username')));
     //   $this->password=strDecode(strDecode(get_cookie("itpl_".strEncode('password'))));
     //   $this->remember=strDecode(get_cookie("itpl_".strEncode('remember')));

        $this->m_data['uname']=strDecode(get_cookie("itpl_".strEncode('username')));
        $this->m_data['pwd']=strDecode(strDecode(get_cookie("itpl_".strEncode('password')))); 
        $this->m_data['remember']=strDecode(get_cookie("itpl_".strEncode('remember'))); 
        
        $this->m_data['s_header'] = $this->load->view($this->s_header, $this->m_data, TRUE);
        $this->m_data['s_left_panel'] = ($this->b_show_left_pannel)?$this->load->view($this->s_left_panel, $this->m_data, TRUE):"";
        $this->m_data['s_right_panel'] = ($this->b_show_right_pannel)?$this->load->view($this->s_right_panel, $this->m_data, TRUE):"";
        $this->m_data['s_footer'] = $this->load->view($this->s_footer, $this->m_data, TRUE);
        $this->m_data['b_stop_back_button'] = $this->b_stop_back_button;
        
       
      
        //Remember me informantion[Start]
        
        //Remember me informantion[End]

    }

    /**
    * Function for loading default layout into pages
    * 
    * @param mixed $m_load_tpl
    * @param mixed $s_main_tpl
    */
    public function render($m_load_tpl=array(), $s_main_tpl="main.tpl.php") {
        // echo $this->router->fetch_class() ."/". $this->router->fetch_method().".tpl.php";

        // Setting main.tpl [start]
       
        if(empty($s_main_tpl)){
            $s_main_tpl = "main.tpl.php";
            if($this->router->fetch_directory()==ADMIN_FOLDER.'/')
                $s_main_tpl = ADMIN_FOLDER."/main.tpl.php";
            //    echo $s_main_tpl;
        }
        // Setting main.tpl [end]

        $s_view = '';
        if(is_array($m_load_tpl) && count($m_load_tpl)>0) { 
   //   echo   $m_load_tpl;  
          // If array of string is given
            foreach($m_load_tpl as $s_tpl){
                $s_view .= $this->load->view($s_tpl.".tpl.php", $this->m_data, TRUE);
            }
        }else{  // If string given
            if(!empty($m_load_tpl)){
              // echo $m_load_tpl;
                $s_view .= $this->load->view($m_load_tpl, $this->m_data, TRUE);                
            }else if(count($m_load_tpl)==0){ // If no string is given
                    if(file_exists(APPPATH."views/".$this->router->fetch_directory().$this->router->fetch_class() ."/". $this->router->fetch_method().".tpl.php"))
                        $s_view .= $this->load->view($this->router->fetch_directory().$this->router->fetch_class() ."/". $this->router->fetch_method().".tpl.php", $this->m_data, TRUE);   
            }
        }

        $this->load_default();
        // Default data and View file loading [start]


        $this->m_data['s_tpl_data'] = $s_view;
        // Default data and View file loading [end]

        if($this->router->fetch_directory()==ADMIN_FOLDER.'/'){
            $s_main_tpl = ADMIN_FOLDER.'/'.$s_main_tpl;
        }


        $this->load->view($s_main_tpl, $this->m_data);
    }

    /**
    * Function for checking the access for particular user
    * 
    * @param mixed $s_user_access   
    * access levels are : registered, non-registered, admin, customer_service, super_affiliate, affiliate, customer
    */
    public function chk_user_access($s_user_access = array('registered')) {
        if(!is_logged() && $s_user_access=='registered') {
            add_msg("Please login as adminstrator to access Admin Panel", "info");
            $this->session->set_userdata('current_url', current_url());
            redirect(base_url().'home.html');
        }
        if(is_logged() && $s_user_access=='non-registered') {
            //echo current_url();exit;
            $this->session->set_userdata('current_url', current_url());
            $this->_redirect_home_page();
        }
        if(!is_admin() && $s_user_access=='admin'){
            add_msg("You do not have the access to the page. Please login as administrator.", "info");
            $this->session->set_userdata('current_url', current_url());
            redirect(base_url());
        }
    }

    /**
    * function to check the user access to a particular page
    * 
    * @param mixed $s_tab_id
    * @param mixed $i_roles
    */
    public function check_user_access($s_tab_id="", $i_roles=array()) {
        $arr_menu_access = config_item('menu_access'); 
        $i_roles = (!is_array($i_roles))?array():$i_roles; // pr($i_roles, true);
        if(array_intersect($arr_menu_access[$s_tab_id], $i_roles)){

        }else{
            add_msg("You don't have the permission to access the page.", 'err');
            redirect(base_url()."login.html");
        }
    }

    /**
    * function for checking if the referrer is present or not
    */
    protected function check_referer(){
        if(REFERRER_NAME!='') {
            $this->s_referrer_name = REFERRER_NAME;
        } else {
            add_msg("You are not eligible to login as customer as you have no referral url!!", 'info');
            redirect(base_url());
        }
    }

    /**
    * Function for redirecting after login
    * @author Arnab Chattopadhyay
    * @param mixed $s_back_url
    */
    public function _redirect_home_page($s_back_url=""){
      // print_r(get_ses_data('i_roles'));exit;
        // checking for user type and back url, where to redirect
        $role = get_ses_data('i_roles');
         if($role[0] == 4){
             redirect(base_url());
         }
        if(in_array(USER_ROLE, get_ses_data('i_roles'))){
            !empty($s_back_url)?redirect(base_url().$s_back_url.'.html'):redirect(base_url().'model/profile.html');
        }
        // echo 1; exit;
        redirect(admin_url().'home.html');
    }

    /**
    * Function for adding specific js to a page
    * @author Arnab Chattopadhyay
    * @param mixed $s_js_files maybe array or string
    */
    public function add_js($s_js_files=array()){
        $s_href = "";
        if(is_array($s_js_files) && count($s_js_files)>0){
            foreach($s_js_files as $s_js_file){
                $s_js_file = trim($s_js_file);
                $s_href = $this->_check_file_path($s_js_file);
                if(!empty($s_href)) {
                    $this->s_js .= '<script type="text/javascript" src="'.$s_href.'"></script>';
                }
            }
        } else {
            $s_js_file = trim($s_js_files);
            $s_href = $this->_check_file_path($s_js_files);
            if(!empty($s_href)) {
                $this->s_js .= '<script type="text/javascript" src="'.$s_href.'"></script>';
            }
        }         
    }

    /**
    * Function for checking file existance into predefined path
    * 
    * @param mixed $s_file_name
    * @param mixed $s_file_ext
    */
    public function _check_file_path($s_file_name='', $s_file_ext = 'js') {
        $s_path = "";
        if(empty($s_file_name)){
            if(file_exists(FCPATH.$s_file_ext.'/'.$this->router->fetch_directory().$this->router->fetch_class() ."/".$this->router->fetch_method().'.'.$s_file_ext)){
                $s_path = base_url().$s_file_ext.'/'.$this->router->fetch_directory().$this->router->fetch_class() ."/".$this->router->fetch_method().'.'.$s_file_ext;
            }
        } else {
            if(file_exists(FCPATH.$s_file_ext.'/'.$s_file_name.'.'.$s_file_ext)){
                $s_path = base_url().$s_file_ext.'/'.$s_file_name.'.'.$s_file_ext;
            }
            if(file_exists(FCPATH.$s_file_ext.'/'.$this->router->fetch_directory().$this->router->fetch_class() ."/".$s_file_name.'.'.$s_file_ext)){
                $s_path = base_url().$s_file_ext.'/'.$this->router->fetch_directory().$this->router->fetch_class() ."/".$s_file_name.'.'.$s_file_ext;
            }
        }
        return $s_path;
    }

    /**
    * Function for adding specific css to a page
    * 
    * @param mixed $s_css_files maybe array or string
    */
    public function add_css($s_css_files=array()){
        if(is_array($s_css_files) && count($s_css_files)>0){
            foreach($s_css_files as $s_css_file){
                if($this->router->fetch_directory()==ADMIN_FOLDER.'/'){
                    $this->s_css .= '<link rel="stylesheet" href="'.base_url().'css/'.ADMIN_FOLDER.'/'.$s_css_file.'.css" type="text/css" />';
                }else{
                    $this->s_css .= '<link rel="stylesheet" href="'.base_url().'css/'.$s_css_file.'.css" type="text/css" />';
                }                
            }
        } else {
            if($this->router->fetch_directory()==ADMIN_FOLDER.'/'){
                $this->s_css .= '<link rel="stylesheet" href="'.base_url().'css/'.ADMIN_FOLDER.'/'.$s_css_files.'.css" type="text/css" />';
            }else{
                $this->s_css .= '<link rel="stylesheet" href="'.base_url().'css/'.$s_css_files.'.css" type="text/css" />';
            } 
        }
    }

    /**
    * Function for login the user
    * @author Arnab Chattopadhyay
    * @param mixed $s_username
    * @param mixed $s_password
    */
    public function login_user($s_email,$s_password) {
        // fetch data after login for session [start]
         ////  echo $s_email ;
           // echo $s_password ;      
        $m_arr = $this->mod->fetchSingleUser($s_email, $s_password);
      //   pr($m_arr, true);
        if($m_arr['error']==0){
            $m_user_data['i_user_id'] = $m_arr['id'];
            $m_user_data['b_is_logged'] = TRUE;
            $m_user_data['s_user_email'] = $m_arr['s_email'];
            $m_user_data['s_name'] = $m_arr['s_firstname']." ".$m_arr['s_lastname'];   
            $m_user_data['s_username'] = $m_arr['s_username'];   
            $m_user_data['i_roles'] = explode(",",$m_arr['i_roles']);
            $m_user_data['s_roles'] = explode(",",$m_arr['s_roles']);
            $this->session->set_userdata('ses_user_data',$m_user_data);
            return TRUE;
        } else {
            return FALSE;
        }        
        // fetch data after login for session [end]
    }

    /**
    * function for get child data array
    * @author Arnab Chattopadhyay
    * @param mixed $m_dataset
    */
    function _child_user($m_dataset=array(), $i_user_id=1){
        $m_dataset_bkp = $m_dataset;
        $i_indx = 0;
        foreach($m_dataset as $m_data) {
            $m_allData = array();
            $s_tab_name='vw_user_details as vwud';
            $s_select='LPAD(vwud.`id`,"8","#MPI00000") as shid, (IF(id='.$i_user_id.',TRUE, FALSE) OR IF("'.$m_data['b_show_tooltip'].'"=1, TRUE, FALSE)) as b_show_tooltip, group_concat(`s_role_name` separator ", ") AS `s_roles`, vwud.*';
            $m_where=$m_where='i_parent_id = '.$m_data['id']. ' AND i_is_member = 1 AND i_user_role IN('.PROMOTER_PRO_ROLE.', '.PROMOTER_ROLE.', '.CUSTOMER_ROLE.', '.ADMIN_ROLE.', '.FREE_AFFILIATE_ROLE.')';
            $s_group_by = 'id';
            $s_order_by_name = "id";
            $s_order_by = "DESC";
            $m_allData  = $this->mod->fetchMultiData($s_tab_name, $s_select, $m_where, $s_group_by, $s_order_by_name, $s_order_by);

            if(count($m_allData)) {
                $m_dataset_bkp[$i_indx++]['m_child_array'] = $this->_child_user($m_allData, $i_user_id);
            } else {
                $m_dataset_bkp[$i_indx++]['m_child_array'] = array();
            }
        }
        return  $m_dataset_bkp; 
    }

    /**
    * Function for checking the user login for checkout
    * @author Arnab Chattopadhyay
    */
    function back_to_cart() {
        if(!is_logged()){
            redirect(base_url().'shopping-cart.html');
        }            
    }


    /**
    * Function for redirecting to previous url
    */
    public function back_to_prev_url() {
        $s_prev_url = $this->session->userdata('current_url');
        if(empty($s_prev_url)){
            redirect(base_url());
        } else {
            redirect($s_prev_url);
        }
    }


    /**
    * Function for setting the paginition html
    */
    function get_paginition_config_(){
        $config = array();
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<div class="Pagenation">';
        $config['full_tag_close'] = '</div>';
        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';        
        $config['cur_tag_open'] = '<span>';
        $config['cur_tag_close'] = '</span>';
        return $config;
    }

    /**
    * Function for setting the paginition html
    */
    function get_fe_paginition_config_(){
        $config = array();
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<div class="pagenation"><div class="pages">';
        $config['full_tag_close'] = '</div><div class="clear"></div></div>';
        $config['next_link'] = 'Next &raquo;';
        $config['prev_link'] = '&laquo; Previous';        
        $config['cur_tag_open'] = '<span class="current">';
        $config['cur_tag_close'] = '</span>';
        return $config;
    }

       function get_fe_paginition_config_new(){
        $config = array();
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<div class="pagenation"><div class="pages">';
        $config['full_tag_close'] = '</div></div></div>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';        
        $config['cur_tag_open'] = '<span class="current">';
        $config['cur_tag_close'] = '</span>';
        return $config;
    }
    
    function _get_d_featured_model(){
       
        $this->db->limit(5, 0);
         $this->db->group_by('id');
          $this->db->order_by('id', 'DESC');
        
         $o_res = $this->db->select('*', FALSE)->from('vw_user_details')->where(array('i_user_role '=>3,'i_is_member'=>1,'i_is_featured'=>1))->get();
         
         if($o_res->num_rows()>0) {
            return $o_res->result_array();
        } else{
            return array();
        }
    }

}  

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
