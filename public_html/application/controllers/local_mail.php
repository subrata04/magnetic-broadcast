<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Controller to maintain videos
* @author: Arnab Chattopadhyay
*/
require APPPATH.'controllers/My_controller.php';

class Local_mail extends My_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('video_model' , 'mod');
         // Here mod is initiated because it is used in My_controller class
    }

    function index(){
        $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => 'itplsmtp@gmail.com',
        'smtp_pass' => '@#pass@#',
        );
        $this->load->library('email',$config);
        $this->email->set_newline("\r\n");

        $this->email->from('itplsmtp@gmail.com', 'Mr. Sam');
        $this->email->to('samsujj@gmail.com');

        $this->email->subject(' My mail through codeigniter from localhost ');
        $this->email->message('Hello World…');


        if (!$this->email->send())
            show_error($this->email->print_debugger());
        else
            echo 'Your e-mail has been sent!';
    }
}




/* End of file videos.php */
/* Location: ./application/controllers/videos.php */