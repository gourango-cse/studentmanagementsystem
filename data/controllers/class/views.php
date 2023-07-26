<?php

/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
//Visit "codeastro.com" for more projects!
class Views extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        if(!$this->sms->is_loggedin()){
            redirect("login");
        }
        $this->load->model('sms_class');
        if(!$this->input->is_ajax_request()){
            show_404();
        }
    }
    
    public function index(){
        
        $data['list_teachers']= $this->sms->list_users('Teacher', $limit = FALSE, $offset = FALSE, $include_banneds = FALSE);
       $this->load->view('pages/class/list', $data);
       
    }
   
    public function assign_class_teacher_box(){
        $data['type'] = "class";
       // $data['list_class'] = $this->sms_class->list_class();
        $data['list_teachers']= $this->sms->list_users('Teacher', $limit = FALSE, $offset = FALSE, $include_banneds = FALSE);
       $this->load->view('pages/class/assign_class_teacher', $data);
        
    }
   public function assign_section_teacher_box(){
       $data['profile1'] = $this->sms_class->get_class($this->input->post('class_id'));
        $data['type'] = "section";
       // $data['list_class'] = $this->sms_class->list_class();
        $data['list_teachers']= $this->sms->list_users('Teacher', $limit = FALSE, $offset = FALSE, $include_banneds = FALSE);
       $this->load->view('pages/class/assign_class_teacher', $data);
        
    }
     public function add_class_box(){
        //$data['list_class'] = $this->sms_class->list_class();
        $data['list_teachers']= $this->sms->list_users('Teacher', $limit = FALSE, $offset = FALSE, $include_banneds = FALSE);
       $this->load->view('pages/class/add_class', $data);
        
    }//Visit "codeastro.com" for more projects!
      public function add_section_box(){
           $data['profile'] = $this->sms_class->get_class($this->input->post('class_id')); 
        $data['list_class'] = $this->sms_class->list_class();
        $data['list_teachers']= $this->sms->list_users('Teacher', $limit = FALSE, $offset = FALSE, $include_banneds = FALSE);
       $this->load->view('pages/class/add_section', $data);
        
    }
    public function view_class_summary_box(){
        
         $data['profile'] = $this->sms_class->get_class($this->input->post('id')); 
         $this->load->view('pages/class/view_class_summary',$data);
    }
   
}

