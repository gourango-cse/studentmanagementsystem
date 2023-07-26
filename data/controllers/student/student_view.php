
<?php
/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
//Visit "codeastro.com" for more projects!

if (!defined('BASEPATH'))
    show_404();

class Student_view extends CI_Controller {
    

    public function __construct() {
        parent::__construct();
        $this->load->model('sms_class');
        if(!$this->sms->is_loggedin()){
            redirect("login");
        }
    }
    
    public function index(){
        
        $data['page_title'] = "View Student";
        $data['page_slogan'] = "SMS";
       $data['main_content']= "pages/student/view";
        $data['list_sessions'] = $this->sms->list_session();
                $data['running_session'] = $this->sms->get_running_session_by_id($this->session->userdata('running_session_id'));
               $data['list_class'] = $this->sms_class->list_class();
      $data['list_student'] = $this->student->list_student($session = TRUE, $class=FALSE, $section=FALSE, $roll = FALSE, $parent = FALSE, $transport = FALSE, $hostel = FALSE, $limit = FALSE, $offset = FALSE, $include_banneds = TRUE);
          $data['total_student']  = $this->student->count();
               $this->load->view("layout/form",$data );
        
    }
    
     public function list_section(){
         if(!$this->input->is_ajax_request()){
             redirect("home");
        }
         
     $class_id = $this->input->post('class_id');
     if($class_id!=0){
         $lists = $this->sms_class->list_section($class_id);
       echo '<option value="0">Select Section</option>';
          
         foreach ($lists as $list){
             
             echo '<option  value="'.$list->id.'">'.$list->name.'</option>';
         }
     }
    }
    //Visit "codeastro.com" for more projects!
    public function count(){
          if(!$this->input->is_ajax_request()){
          redirect(base_url()."student/view");
      }
       $class= $this->input->post('class_id');
      $section = $this->input->post('section_id');
      if($class==NULL OR $section==NULL){
          echo 0;
      }
   echo   $this->student->count($class && $section);
    }
   
    public function list_student(){
      if(!$this->input->is_ajax_request()){
          redirect(base_url()."student/view");
      }
      
      $class= $this->input->post('class_id');
      $section = $this->input->post('section_id');
     // echo $class.' '.$section;
      if($section!=0){
         $lists = $this->student->list_student($session = TRUE, $class, $section, $roll = FALSE, $parent = FALSE, $transport = FALSE, $hostel = FALSE, $limit = FALSE, $offset = FALSE, $include_banneds = TRUE);
                   
                if($lists){
                 foreach ($lists as $list){
                      echo '<tr>';
                        echo '<td> ';
                           echo '<img style="width:100px;" src="'.base_url('uploads/pro_pic/').'/'.$list->pro_pic.'"/> ';
                       
                           echo'</td>';
                     echo '<td>'.$list->full_name.'</td>';  
                      echo '<td>'.$list->email.'</td>';
                       echo '<td>'.$this->sms_class->get_class_name_by_id($list->class_id).'</td>';
                        echo '<td>'.$this->sms_class->get_section_name_by_id($list->section_id).'</td>';
                         echo '<td>'.$list->roll.'</td>';
                          echo '<td>'.$list->address.'</td>';
                          echo '<td>'.$list->gender.'</td>';
                          echo '<td>';
                          
                          echo '<div class="btn-group">
                  <button type="button" class="btn btn-default">Action</button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                      <li><a href="'.base_url('student/'.$list->name).'">View</a></li>';
                                             
                         if($this->session->userdata('id')!=$list->id){
                  echo '  <li><a href="'. base_url('mail/compose/'.$list->id).'"> Send Mail</a></li>'; }
                   if($this->sms->is_allowed('Teacher')){ 
                  echo '  <li class="divider"></li>
                    <li><a href="#">Banned Student</a></li>';}
                 echo ' </ul>
                </div>';
                         echo '</td>';
                         
                 echo '</tr>';
                }}else{
                   echo '<tr>';
                     echo ' <td>No record found.<td>';  
                     echo '</tr>';
                }
                   
        
         
      }
   
    }
}//Visit "codeastro.com" for more projects!