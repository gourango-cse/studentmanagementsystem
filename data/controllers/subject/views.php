<?php

/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
//Visit "codeastro.com" for more projects!

class Views extends CI_Controller{
    var $config_vars;
    public function __construct() {
        parent::__construct();
        if (!$this->sms->is_loggedin()) {
            redirect("login");
        }
        $this->sms->control("Admin");
        $this->load->model('subject');
        $this->config_vars = $this->config->item('sms');
   
        }
        public function index(){
                         $data['class_lists'] = $this->sms_class->list_class();

             $data['page_title'] = "Manage Subject";
        $data['page_slogan'] = "SMS";
        $data['main_content'] = "pages/subject/manage";
      
        $this->load->view("layout/form", $data);
        }
        
        public function add_subject_box(){
            if(!$this->input->is_ajax_request()){
                redirect('home');
            }
             $data['class_lists'] = $this->sms_class->list_class();
             $data['teacher_list'] = $this->sms->list_users('Teacher', $limit = FALSE, $offset = FALSE, $include_banneds = True);
             $this->load->view("pages/subject/add_subject", $data);
        }
         public function assign_subject_teacher_box(){
              if(!$this->input->is_ajax_request()){
                redirect('home');
            }          
              $data['class_list'] = $this->sms_class->list_class();
           
             $data['teacher_list'] = $this->sms->list_users('Teacher', $limit = FALSE, $offset = FALSE, $include_banneds = True);
             $this->load->view("pages/subject/assign_subject_teacher", $data);
        }
        public function list_subject(){
             if(!$this->input->is_ajax_request()){
                redirect('home');
            } 
            $class = $this->input->post('class_id');
            if($class!=0){
           echo ' <option value="0" selected="selected">Select Subject</option>';
            foreach ($this->subject->list_subject($class) as $subject){
                if($subject->teacher_id!=0 ){
                   $name=  " (Teacher => ".$this->sms->get_user($subject->teacher_id)->full_name.")";
                }else{
                    $name= NULL;
                }
                  echo '<option  value="'.$subject->id.'">'.$subject->name.$name.'</option>';
            }
        }
        
            }
            
            public function viewSubject(){
          
                 if(!$this->input->is_ajax_request()){
                redirect('home');
            } 
            if($this->input->post('class_id')!=NULL){
                if($this->sms_class->is_class_exists($this->input->post('class_id'))){
                 $view = $this->subject->list_subject($this->input->post('class_id'));
               
                    $data['list_subject'] = $view;
                    $this->load->view('pages/subject/view_subject',$data);
             
            }}
           
            }
           
}//Visit "codeastro.com" for more projects!