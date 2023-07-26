<?php

/* 
 *  @package		Kodstack
 *  Author:         Ronash Dhakal
 */
//Visit "codeastro.com" for more projects!
class View extends CI_Controller{
    
    
   public function __construct() {
     parent::__construct();
     $this->load->model('noticeModel');
 }

 public function index(){
     $data['list_class'] = $this->sms_class->list_class();
     $notice = new NoticeModel();
     $data['notice'] = $notice::all();
       $data['page_title'] = "Noticeboard";
        $data['page_slogan'] = "SMS";
        $data['main_content'] = "pages/notice/view";

        $this->load->view("layout/form", $data);
 }
 
public function add(){
    
        $data1 = array('success' => FALSE, 'msg' => array(), 'server_msg' => NULL);



      
        $title = $this->input->post('title');
        $body = $this->input->post('description');
      

        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'title',
                'label' => 'Subject',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'description',
                'label' => 'Message',
                'rules' => 'trim|required'
            ),
           
        );
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules($config);
        $this->form_validation->set_message('is_unique', 'Already exists!');

        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else {
            
          $notice = new NoticeModel();
          $notice->title = $title;
          $notice->body = $body;
          $notice->save();
          $data1['success']= TRUE;


               
             //Visit "codeastro.com" for more projects!  
            
        }
        echo json_encode($data1);
}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
}