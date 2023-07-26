<?php

/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */

//Visit "codeastro.com" for more projects!
class View_class extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        if(!$this->sms->is_loggedin()){
            redirect("login");
        }
        $this->load->model('study');
    }

    public function class_profile() {

       $class = $this->uri->segment(2);
    // $section = $this->uri->segment(3);
     //Visit "codeastro.com" for more projects!
     
     if($this->sms_class->is_class_exists($class)){
       
          $data['profile'] = $this->sms_class->get_class($class); 
           $data['list_teachers']= $this->sms->list_users('Teacher', $limit = FALSE, $offset = FALSE, $include_banneds = FALSE);
           $data['list_class'] = $this->sms_class->list_class();
    $data['page_title'] = ucwords("Class ".$class);
        $data['page_slogan'] = "Class ".$class."Information";
       $data['main_content']= "pages/class/profile";
       $this->load->view("layout/form",$data );
     }else{
        $data['page_title'] = "Class Not Found";
               $data['type'] = "Class";
          $data['main_content']= "404";
       $this->load->view("layout/data",$data );
     }
     
  
        

}
public function section_profile(){
     $class = $this->uri->segment(2);
     $section = $this->uri->segment(3);
    
         if($this->sms_class->is_class_section_exists($class, $section)){
              $this->load->model('attendance_model', 'am');
      
             $data['class'] = $this->sms_class->get_class($class);
             
             $data['profile'] = $this->sms_class->get_class_section($class,$section); 
             
  $data['totalStudents'] = $this->am->total_student($data['class']->id,$data['profile']->id, date('Y/n/d'), $this->sms->running_session()->id);
   
            $data['list_month'] = $this->sms->list_month();
           $data['list_teachers']= $this->sms->list_users('Teacher', $limit = FALSE, $offset = FALSE, $include_banneds = FALSE);
           $data['list_class'] = $this->sms_class->list_class();
    $data['page_title'] = ucwords("Class ".$class." Section ".$section);
        $data['page_slogan'] = "Class ".$class." Section ".$section." Information";
       $data['main_content']= "pages/class/section_profile";
       $this->load->view("layout/form",$data );
     }else{
         $data['page_title'] = "Section Not Found";
               $data['type'] = "Section";
          $data['main_content']= "404";
       $this->load->view("layout/data",$data );
     }
 
}

//Visit "codeastro.com" for more projects!
}