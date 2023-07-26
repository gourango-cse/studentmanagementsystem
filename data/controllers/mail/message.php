<?php


/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
//Visit "codeastro.com" for more projects!

class Message extends CI_Controller{
    
    
    public function __construct() {
        parent::__construct();
        if(!$this->sms->is_loggedin()){
            redirect("login");
        }
    }

    Public function index() {
        $data['page_title']= "Mail";
        $data['page_slogan']= "SMS Communication";
        $data['list_inbox'] = $this->sms->list_pms(30,0,$this->session->userdata('id'));
        $data['count_unread'] = $this->sms->count_unread_pms();
               $data['main_content'] = "pages/mail/inbox";
		$this->load->view('layout/form', $data);
    }
    
    public function compose(){
  $data['list_user'] = $this->sms->list_users();
		$this->load->view('pages/mail/compose', $data); 
    }
    public function read(){
    $id = $this->input->post('id');
       $data['message'] = $this->sms->get_pm($id);
         
		$this->load->view('pages/mail/read', $data);
    }
    
   public function send(){
       
        $data1 = array('success' => FALSE, 'msg' => array(),'server_msg'=>NULL);



        $this->load->library('form_validation');
       $this->form_validation->set_rules("user_id", "Receiver", "select");
        $this->form_validation->set_rules("subject", "Subject", "required");
         $this->form_validation->set_rules("message", "Message", "required|min_lenght[2]");
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
       
      

        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else {
 
  
       $receiver = $this->input->post('user_id');
       $title = $this->input->post('subject');
       $message= $this->input->post('message');

  if($this->sms->send_pm($this->sms->get_user()->id, $receiver, $title, $message)){
       $data1['success'] = TRUE; 
  }
       //Visit "codeastro.com" for more projects!       
                  
                
            
          
        }
          echo json_encode($data1);
    
      
   }
}
