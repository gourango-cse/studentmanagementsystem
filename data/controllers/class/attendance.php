<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
//Visit "codeastro.com" for more projects!
class Attendance extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
       $this->sms->control("Teacher");
      $this->load->model('attendance_model', 'am');
 
    }
    

    public function index(){
         if ($this->sms_class->is_section_teacher($this->sms->get_user()->id) OR $this->sms->is_admin()) {
 
   
     $students= $this->input->post('attendance');
        $class= $this->input->post('class_id');
           $section = $this->input->post('section_id');
                 $data['total'] = count($students);
     
             $session = $this->sms->running_session()->id;
   
             if($students!=NULL){
             foreach ($students as $std){
             $this->am->check($std,$class, $section, date('Y/n/d'), $session);
                 $data['success'] = TRUE;
     
             
             
             }
             
             }
        
 //Visit "codeastro.com" for more projects!
  echo json_encode($data);
 }else{
     show_404();
 }
      
    }
    
    }