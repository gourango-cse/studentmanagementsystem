<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
//Visit "codeastro.com" for more projects!
class Manage_class extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
        $this->sms->control("Admin");
    }

    public function index() {


        $data['page_title'] = "Manage Class";
        $data['page_slogan'] = "SMS";
        $data['main_content'] = "pages/class/manage";
       // $data['list_teachers'] = $this->sms->list_users('Teacher');
        //$data['list_class'] = $this->sms_class->list_class();
        //Visit "codeastro.com" for more projects!
        $this->load->view("layout/form", $data);
    }

    

    public function add_class() {
        if(!$this->input->is_ajax_request()){
             redirect("home");
        }

        $data1 = array('success' => FALSE, 'msg' => array(), 'server_msg'=>NULL);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("class_name", "Class Name", "trim|required|alpha|is_unique[sms_class.name]");
        
        $this->form_validation->set_rules("class_number", "Class Numeric", "trim|required|is_natural_no_zero|is_unique[sms_class.num]");
        $this->form_validation->set_message('is_unique',"Class Already Exists!");
       // $this->input->post('');
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else {
            
            if($this->sms_class->add_class($this->input->post('class_name'),$this->input->post('class_number'))){
                $data1['success'] = TRUE;  
            }else{
                $data1['server_msg']  = "Sorry System Failed!";
            }
          
        }
        echo json_encode($data1);
    }
   

    public function add_section() {
        
if(!$this->input->is_ajax_request()){
             redirect("home");
        }
        $data1 = array('success' => FALSE, 'msg' => array());
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("section_name", "Section Name", "trim|required|max_length[1]|alpha|unique_section");
         // $this->form_validation->set_rules("section_nick_name", "Nick Name", "trim|required|alpha|is_unique[sms_class_section.nick_name]");
        $this->form_validation->set_rules("class_id", "Class", "select");

        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else {
            if($this->input->post('teacher_id')!=0 AND $this->sms->is_member('Teacher',$this->input->post('teacher_id'))==TRUE ){
                $teacher_id = $this->input->post('teacher_id');
            }else{
                $teacher_id = 0;
            }
            if($this->sms_class->is_class_exists($this->input->post('class_id'))==TRUE){
                $class_id = $this->input->post('class_id');
              if($this->sms_class->add_section($class_id, $this->input->post('section_name'), $teacher_id)){
                   $data1['success'] = TRUE;
              }
                }else{
                    $data1['server_msg'] = "Illigel Process!";
                }

           
        }
        echo json_encode($data1);
    }
    //Visit "codeastro.com" for more projects!
    public function assign_class_teacher() {
        if(!$this->input->is_ajax_request()){
             redirect("home");
        }

        $data1 = array('success' => FALSE, 'msg' => array(), 'server_msg'=>NULL);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("class_id", "Class", "select");
        
        $this->form_validation->set_rules('teacher_id',"Teacher","select");
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else {
        if($this->sms_class->update_class_teacher($this->input->post('teacher_id'), $this->input->post('class_id'))){
             $data1['success'] = TRUE;
        }
           $data1['server_msg']= "Sorry System Failed!";
        }
        echo json_encode($data1);
    }
     public function assign_section_teacher() {
if(!$this->input->is_ajax_request()){
             redirect("home");
        }
        $data1 = array('success' => FALSE, 'msg' => array(), 'server_msg'=>NULL);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("section_id", "Section", "select");
        $this->form_validation->set_rules('teacher_id',"Teacher","select");
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else {
        if($this->sms_class->update_section_teacher($this->input->post('teacher_id'), $this->input->post('section_id'))){
             $data1['success'] = TRUE;
        }
           $data1['server_msg']= "Sorry System Failed!";
        }
        echo json_encode($data1);
    }
    
public function delete_section(){
    if(!$this->input->is_ajax_request()){
        show_404();
        }
            $seccess= FALSE;
            if($this->sms_class->delete_section($this->input->post('id'))){
                $seccess= TRUE;
            }            
          
          echo $seccess;
}

  public function edit_class() {
        
if(!$this->input->is_ajax_request()){
    show_404();
    }
        $data = array('success' => FALSE, 'msg' => array());
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("edit_class_name", "Class Name", "required|trim|min_length[1]|alpha|is_unique[sms_class.name]");
     $this->form_validation->set_rules("list_class_id", "Class ID", "trim|required|is_class_id");
         $this->form_validation->set_message("is_unique", "You do not make any change");

        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        } else {
            $id = $this->input->post('list_class_id');
             $name = $this->input->post('edit_class_name');
             
          
            if($this->sms_class->update_class($id,$name)){
                $data['success'] = TRUE;  
            }         
        }
        echo json_encode($data);
    }
      public function delete_class(){
             if(!$this->input->is_ajax_request()){
                 show_404();
        }
        $data = array('success' => FALSE, 'msg' => array());
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("edit_class_name", "Class ID", "trim|required|is_class_id|has_student_in_class");
     
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data['msg'][$key] = form_error($key);
            }
        } else {
            
             $id = $this->input->post('edit_class_name');
            
            
                if($this->sms_class->delete_class($id)!=FALSE){
                $data['success'] = TRUE;  
            }  
             
          
           
          
        }
        echo json_encode($data);
        }
}
