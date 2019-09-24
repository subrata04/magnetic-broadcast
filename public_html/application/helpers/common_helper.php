<?php
/**
* Common Helper File
* Helper Functions for commonly used into the website
* @author Arnab Chattopadhyay
* @path application/helpers/common_helper.php
*/

/**
* function for encoding password
* @author Arnab Chattopadhyay
* @param string $s_str
* @return string
*/
function strEncode($s_str) {
    $s_str = base64_encode("@####@".base64_encode("##pmetro##".$s_str));     /// Salt are hard coded here for security reason
    $s_str = str_replace("==", "-EEQL-", $s_str);
    return str_replace("=", "-EQL-", $s_str);
}

/**
* function for decoding password
* @author Arnab Chattopadhyay
* @param string $s_str
* @return string
*/
function strDecode($s_str='') {
    $s_str = str_replace("-EQL-", "=", $s_str);
    $s_str = str_replace("-EEQL-", "==", $s_str);
    $s_str = base64_decode($s_str);
    $s_str = str_replace("@####@", "", $s_str);
    $s_str = base64_decode($s_str);
    $s_str = str_replace("##pmetro##", "", $s_str);
    return $s_str;
}

/**
* function for generating random password
* @author Arnab Chattopadhyay
* @return string
*/
function generate_random_password() {
    return base64_encode(rand(999,99999)."gina");
}

/**
* function for preview data in formatted way
* @author Arnab Chattopadhyay
* @param mixed $s_str
* @param mixed $b_is_exit
*/
function pr($s_str='', $b_is_exit=FALSE) {
    echo "<pre>";
    print_r($s_str);
    echo "</pre>";
    if($b_is_exit){
        exit();
    }
}

/**
* function for getting safe input data
* @author Arnab Chattopadhyay
* @param mixed $s_str
* @return string
*/
function get_safe($s_str){
    return htmlentities($s_str, ENT_QUOTES, 'utf-8');
}
/**
* function for putting safe input data
* @author Arnab Chattopadhyay
* @param mixed $s_str
* @return string
*/
function put_safe($s_str){
    return html_entity_decode($s_str, ENT_QUOTES, 'utf-8');
}

/**
* function for making the video name as url
* uses 2 helper 1. text_helper, 2. url_helper
* @author Arnab Chattopadhyay
* @param mixed $s_title
*/
function make_title_url($s_title=''){
    $s_title = convert_accented_characters($s_title);
    $s_title = str_replace("/", "-", $s_title);
    $s_title = character_limiter($s_title, 50);
    return strtolower(url_title(strip_quotes($s_title)));
}

/**
* Function for checking an user is logged in or not
* @author Arnab Chattopadhyay
* @return true iff user is logged in
*/
function is_logged(){
    $CI = & get_instance();
    $m_login_info = $CI->session->userdata('ses_user_data');
    return (!empty($m_login_info) && $m_login_info['i_user_id']>0 && $m_login_info['b_is_logged']==TRUE )?TRUE:FALSE;
}

/**
* Function for checking the logged in user is admin or not 
* @author Arnab Chattopadhyay
* @return true iff user is admin
*/
function is_admin(){
    $CI = & get_instance();
    $m_login_info = $CI->session->userdata('ses_user_data');// pr($m_login_info);
    if(!empty($m_login_info) && in_array(ADMIN_ROLE, $m_login_info['i_roles'])){
        return TRUE;
    }else{
        return FALSE;
    }
    return FALSE;    
}

/**
* function for getting admin url
* @author Arnab Chattopadhyay
*/
function admin_url(){
    return BASE_URL.ADMIN_FOLDER.'/';
}

/**
* function for storing messages
* @author Arnab Chattopadhyay
* @param mixed $s_str_msg
* @param mixed $s_msg_type => 'err', 'ok', 'info'
*/
function add_msg($s_str_msg='', $s_msg_type='err'){
    $CI = & get_instance();
    // getting session message    
    $m_ses_msg = $CI->session->userdata('ses_msg');
    switch($s_msg_type){
        case 'err':
        {
            $s_str_msg = "<div class='error closeable'>" . $s_str_msg . "</div>";
            if(is_array($m_ses_msg)) {
                $s_err_msg = !empty($m_ses_msg['s_err_msg'])?$m_ses_msg['s_err_msg']:"";
            }else{
                $s_err_msg = '';
            }
            $m_ses_msg['s_err_msg'] = $s_err_msg.$s_str_msg;
            $CI->session->set_userdata('ses_msg', $m_ses_msg);
            break;
        }
        case 'info':
        {
            $s_str_msg = "<div class='info closeable'>" . $s_str_msg . "</div>";
            if(is_array($m_ses_msg)) {
                $s_info_msg = !empty($m_ses_msg['s_info_msg'])?$m_ses_msg['s_info_msg']:"";
            }else{
                $s_info_msg = '';
            }
            $m_ses_msg['s_info_msg'] = $s_info_msg.$s_str_msg;
            $CI->session->set_userdata('ses_msg', $m_ses_msg);
            break;
        }
        case 'ok':
        {
            $s_str_msg = "<div class='ok closeable'>" . $s_str_msg . "</div>";
            if(is_array($m_ses_msg)) {
                $s_ok_msg = !empty($m_ses_msg['s_ok_msg'])?$m_ses_msg['s_ok_msg']:"";
            }else{
                $s_ok_msg = '';
            }
            $m_ses_msg['s_ok_msg'] = $s_ok_msg.$s_str_msg;
            $CI->session->set_userdata('ses_msg', $m_ses_msg);
            break;
        }
    }
}

/**
* function for getting the messages
* @author Arnab Chattopadhyay
* @param mixed $s_type
*/
function show_msg($s_type=''){
    $CI = & get_instance();
    // getting session message    
    $m_ses_msg = $CI->session->userdata('ses_msg');
    if(empty($m_ses_msg))
        return FALSE;

    switch($s_type){
        case 'err':
        {
            $s_msg = !empty($m_ses_msg['s_err_msg'])?$m_ses_msg['s_err_msg']:"";
            $m_ses_msg['s_err_msg'] = '';
            $CI->session->set_userdata('ses_msg', $m_ses_msg);
            return $s_msg;
            break;
        }
        case 'info':
        {
            $s_msg = !empty($m_ses_msg['s_info_msg'])?$m_ses_msg['s_info_msg']:"";
            $m_ses_msg['s_info_msg'] = '';
            $CI->session->set_userdata('ses_msg', $m_ses_msg);
            return $s_msg;
            break;
        }
        case 'ok':
        {
            $s_msg = !empty($m_ses_msg['s_ok_msg'])?$m_ses_msg['s_ok_msg']:"";
            $m_ses_msg['s_ok_msg'] = '';
            $CI->session->set_userdata('ses_msg', $m_ses_msg);
            return $s_msg;
            break;
        }
        default:
        {
            $s_msg = !empty($m_ses_msg['s_err_msg'])?$m_ses_msg['s_err_msg']:"";
            $s_msg .= !empty($m_ses_msg['s_info_msg'])?$m_ses_msg['s_info_msg']:"";
            $s_msg .= !empty($m_ses_msg['s_ok_msg'])?$m_ses_msg['s_ok_msg']:"";
            $m_ses_msg = '';
            $CI->session->set_userdata('ses_msg', $m_ses_msg);
            return $s_msg;
        }
    }
}

/**
* function for getting extension from filename
* @author Arnab Chattopadhyay
* @param mixed $s_imgname
* @return mixed
*/
function getExt($s_imgname=''){
    $m_det_ = explode(".", $s_imgname);
    return $m_det_[count($m_det_)-1];
}
/**
* function for getting name from filename
* @author Arnab Chattopadhyay
* @param mixed $s_imgname
* @return string
*/
function getName($s_imgname=''){
    $m_det_ = explode(".", $s_imgname);
    unset($m_det_[count($m_det_)-1]);
    return implode('.',$m_det_);
}

/**
* function for fetching the site default values
* @author Arnab Chattopadhyay
* @param mixed $s_field_name
* @param mixed $m_where
*/
function get_site_settings($s_field_name="all", $m_where=array()){
    $CI = & get_instance();
    $o_res = $CI->db->select('*')->from('site_settings')->where($m_where)->get();
    if($o_res->num_rows()){
        $m_res_ = $o_res->row_array();
        if($s_field_name=='all'){
            return $m_res_;
        }else{
            return (!empty($s_field_name))?$m_res_[$s_field_name]:"";
        }
    } else {
        return "";
    }
}

/**
* Function for getting user data from session
* @author Arnab Chattopadhyay
* @param mixed $s_var
*/
function get_ses_data($s_var = ''){
    $CI = & get_instance();
    $m_login_info = $CI->session->userdata('ses_user_data');
    if(!empty($s_var)){
        return $m_login_info[$s_var];
    }else{
        return $m_login_info;
    }
}

/**
* Function for setting user data into session
* @author Arnab Chattopadhyay
* @param mixed $s_var
* @param mixed $s_val
*/
function set_ses_data($s_var = '', $s_val = ""){
    $CI = & get_instance();
    $m_login_info = $CI->session->userdata('ses_user_data');
    if(!empty($s_var)){
        $m_login_info[$s_var] = $s_val;
        $CI->session->set_userdata('ses_user_data', $m_login_info);
    }
}

/**
* Function for spliting a string into array
* @author Arnab Chattopadhyay
* @param mixed $s_str
* @param mixed $s_separator
* @return array
*/
function strtoarray($s_str =array(), $s_separator=","){
    return array_unique(explode($s_separator, $s_str));   
}



// ---------------------------------------------------------------------------------------------------------
// -------------------------------------- Model-website Project Specific --------------------------------------
// ---------------------------------------------------------------------------------------------------------

/**
* Function for getting country name by country id
* @author Arnab Chattopadhyay
* @param mixed $id
*/
function getCountPrice() {
    $name = "";
    $CI = & get_instance();
    $sql="SELECT * FROM `itpl_configuration` WHERE `is_show_in_signup`=1";
    $res=$CI->db->query($sql);
    return $res->num_rows();
}


/**
* Function for getting state name by state id
* @author Arnab Chattopadhyay
* @param mixed $id
*/
function getState($id=0) {
    $name = "";
    $CI = & get_instance();
    $sql="SELECT `st_name` FROM `itpl_state` WHERE `id`=".$id;
    $res=$CI->db->query($sql);
    foreach($res->result() as $row) {
        $name=$row->st_name;
    }
    return $name;
}
function get_configure1() {
    $name = "";
    $CI = & get_instance();
    $sql="SELECT `s_text_to_show` FROM `itpl_configuration` WHERE `is_show_in_signup`=1";
    $res=$CI->db->query($sql);
    foreach($res->result() as $row1) {
        $name=$row1->s_text_to_show;
    }
    return $name;
}


/**
* Function for sendign mail
* @author Arnab Chattopadhyay
* @param mixed $m_mail_data
*/
function do_mail($m_mail_data=array()) {
    
    
    
    $s_from_email = (!empty($m_mail_data['from']))?$m_mail_data['from']:"";
    $s_from_name = (!empty($m_mail_data['name']))?$m_mail_data['name']:"";
    $s_to_email = (!empty($m_mail_data['to']))?$m_mail_data['to']:"";
    $s_bcc_email = (!empty($m_mail_data['bcc']))?$m_mail_data['bcc']:"";
    $s_cc_email = (!empty($m_mail_data['cc']))?$m_mail_data['cc']:"";
    $s_subject  = (!empty($m_mail_data['subject']))?$m_mail_data['subject']:"";
    $s_msg  = (!empty($m_mail_data['message']))?$m_mail_data['message']:"";

    // getting CI instance
    $CI = & get_instance();
    // loading email library
    $CI->load->library('email');
    // email configuration [start]
    $config['charset'] = 'utf-8';
    $config['mailtype'] = 'html';
    $CI->email->initialize($config);
    // email configuration [end]

    // email parameter set [start]
    $CI->email->from($s_from_email, $s_from_name);
    $CI->email->to($s_to_email);   
    (!empty($s_bcc_email))?$CI->email->bcc($s_bcc_email):"";
    (!empty($s_cc_email))?$CI->email->cc($s_cc_email):"";
    $CI->email->subject($s_subject);
    $CI->email->message($s_msg);
    // email parameter set [end]

    // email sending [start]
    switch (ENVIRONMENT) {
        case 'development':
            echo $s_msg;
            //  echo $CI->email->print_debugger(); exit;
            break;
        case 'testing':
            return $CI->email->send();            
            break;

        case 'production':
            return $CI->email->send();            
            break;
    }
    // email sending [end]
}

/**
* Function for getting email header
* @author Arnab Chattopadhyay
*/
function get_email_header(){
    return '<html>
    <head>
    </head>
    <body>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td>
    <table width="800" border="0" cellspacing="0" cellpadding="0" align="center" style="font: 14px/20px Arial,Helvetica,sans-serif; color:#000; background:#c7cddf; ">
    <tr>
    <td width="275" style="padding:20px; border-right:dashed 1px #FFFFFF; border-bottom:solid 2px #f1f6fa;">
    <img src="'.base_url().'images/logo.png" width="234" height="58" alt="M Pulse International" /></td>
    <td width="525" style="padding:0 5px 0 30px; border-bottom:solid 2px #f1f6fa;">
    <span style="color:#4f5f8c; font-size:18px; text-align:justify;">
    Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
    </span></td>
    </tr>
    <tr>
    <td colspan="2"><div style="padding:20px">';
}

/**
* Function for getting email footer
* @author Arnab Chattopadhyay
*/

function get_download_url($id)
{
    $name = "";
    $CI = & get_instance();
    $sql="SELECT `product_image_name`,`product_upload_file_name` FROM `itpl_product_details` WHERE `id`=".$id;
    $res=$CI->db->query($sql);
    foreach($res->result() as $row) {
        $name['image']=$row->product_image_name;
        $name['download']=$row->product_upload_file_name;
    }
    if($name['image']!='')
    {
        $image_url=config_item('product_thumb_image_upload_url').$name['image'] ;
    }

    else
    {
        if($file_name= $name['download']=='')
        {
            $image_url=base_url().'images/admin/no-thumbnail.jpg';

        }
        else
        {
            $file_name= $name['download'] ;
            $image_ext=getExt($file_name);
            if($image_ext=='zip')
            {
                $image_url=base_url().'images/admin/icons/1370862419_zip.png';
            }
            if($image_ext=='pdf')
            {
                $image_url=base_url().'images/admin/icons/1370862326_pdf.png';
            }
            if($image_ext=='docx'|| $image_ext=='doc')
            {
                $image_url=base_url().'images/admin/icons/1370862386_Files-Word.png';
            }
    } }
    return $image_url;
}

function get_email_footer(){
    return '</div></td>
    </tr>
    <tr>
    <td colspan="2" style="border-top:solid 2px #f1f6fa; padding:0 5px 0 5px;" >
    <span style="width:500px; float:left; border-right:solid 2px #f1f6fa; text-align:justify; padding:10px; font-size:12px;">
    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.
    </span>
    <span style="width:auto; float:left; padding:15px 0 0 30px; text-align:right;">
    <a href="'.base_url().'" style="color:#43527a; text-decoration:none;">Cilk Here</a>
    </span></td>
    </tr>
    </table></td>
    </tr>
    </table>
    </body>
    </html>';
}


function get_profile_image($id="",$type=""){
    //echo $id;
    $uid = intval($id);
    $CI = & get_instance();
    $sql="SELECT `s_image_name`,`s_gender` FROM `itpl_user_details` WHERE `uid`=".$uid;
    $res=$CI->db->query($sql);
    if($res->num_rows()){
        foreach($res->result() as $row) {
            if(!empty($row->s_image_name)){
                $image_url = config_item('user_profile_image_path').$row->s_image_name;
                if($type == 'thumb'){
                    $image_url = config_item('user_profile_thumb_image_path').$row->s_image_name;
                }
                if (file_exists($image_url)) {
                    $image_url =  config_item('user_profile_image_url').$row->s_image_name;
                    if($type == 'thumb'){
                        $image_url = config_item('user_profile_thumb_image_url').$row->s_image_name;
                    }
                }else{
                    if($row->s_gender == 'Female'){
                        $image_url = config_item('user_noimage_url').'noimagefemale.png';
                    }else{
                        $image_url = config_item('user_noimage_url').'noimagemale.png';
                    }
                }
            }else{
                if($row->s_gender == 'Female'){
                    $image_url = config_item('user_noimage_url').'noimagefemale.png';
                }else{
                    $image_url = config_item('user_noimage_url').'noimagemale.png';
                }
            }
        }
    }else{
        $image_url = config_item('user_noimage_url').'noimagemale.png';
    }
    return $image_url;

}
function getEmail() {

    $CI = & get_instance();
    $sql="SELECT `s_email` FROM `itpl_admin_mail`";
    $res=$CI->db->query($sql);
    foreach($res->result() as $row) {
        $email=$row->s_email;
    }
    return $email;
}

function getCountry($id=0) {

    $name='';
    $CI = & get_instance();
    $sql="SELECT `name` FROM `itpl_country` where `id`=".$id;
    $res=$CI->db->query($sql);
    foreach($res->result() as $row) {
        $name=$row->name;
    }
    return $name;
}

function getCommission() {

    $CI = & get_instance();
    $sql="SELECT `commission` FROM `itpl_commission_setting_details`";
    $res=$CI->db->query($sql);
    foreach($res->result() as $row) {
        $commission=$row->commission;
    }
    return $commission;
}

/* End of file common_helper.php */
/* Location: ./application/helpers/common_helper.php */