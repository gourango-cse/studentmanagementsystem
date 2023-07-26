<?php

/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
//Visit "codeastro.com" for more projects!

class Manage_subject extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if (!$this->sms->is_loggedin()) {
            redirect("login");
        }
        $this->sms->control("Admin");
             $this->load->model('subject');

        }
        public function add_subject(){
            
          if(!$this->input->is_ajax_request()){
             redirect("home");
        }

        $data = array('success' => FALSE, 'msg' => array(), 'server_msg'=>NULL);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("subject_class_id", "Class Name", "select");
       
        
                $this->form_validation->set_rules("name", "Subject Name", "trim|required|unique_subject");

     
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        } else {
    
            if($this->subject->add_subject($this->input->post('subject_class_id'), $this->input->post('name'))!=FALSE){
                $data['success'] = TRUE;  
            }else{
                $data['server_msg']  = "Sorry System Failed!";
            }
          
        }
        echo json_encode($data);
        }
        
        public function assign_subject_teacher(){
             if(!$this->input->is_ajax_request()){
             redirect("home");
        }

        $data = array('success' => FALSE, 'msg' => array(), 'server_msg'=>NULL);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("subject_id", "Subject Name", "select");
         $this->form_validation->set_rules("class_id", "Class Name", "select");
        //$this->form_validation->set_rules("teacher_id", "Teacher", "select");
        
               
     
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        } else {
    
             
            if($this->subject->assign_subject_teacher($this->input->post('subject_id'), $this->input->post('teacher_id'))!=FALSE){
                $data['success'] = TRUE;  
            }else{
                $data['server_msg']  = "Sorry System Failed!";
            }
          
        }
        echo json_encode($data);
        }
        
        public function edit(){
             if(!$this->input->is_ajax_request()){
                 show_404();
        }
        //Visit "codeastro.com" for more projects!
        $data = array('success' => FALSE, 'msg' => array(), 'server_msg'=>NULL);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("edit_subject_name", "Subject Name", "trim|required");
        $this->form_validation->set_rules("subject_id", "Subject ID", "trim|required|is_subject_id");
           $this->form_validation->set_message("is_unique", "You do not make any change");
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        } else {
             $id = $this->input->post('subject_id');
             $name = $this->input->post('edit_subject_name');
             
          
            if($this->subject->update_subject($id,$name)){
                $data['success'] = TRUE;  
            }else{
                $data['server_msg']  = "Sorry System Failed!";
            }
          
        }
        echo json_encode($data);
       
        }
        
        public function delete(){
             if(!$this->input->is_ajax_request()){
                 show_404();
        }
        $data = array('success' => FALSE, 'msg' => array());
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("edit_subject_name", "Sibject ID", "trim|required|is_subject_id");
     
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        } else {
            
             $id = $this->input->post('edit_subject_name');
            
            
                if($this->subject->delete_subject($id)!=FALSE){
                $data['success'] = TRUE;  
            }  
             
          
           
          
        }
        echo json_encode($data);
        }
}//Visit "codeastro.com" for more projects!