<?php

/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
//Visit "codeastro.com" for more projects!
class Student_profile extends CI_Controller{
    
    
    public function __construct() {
        parent::__construct();
   if (!$this->sms->is_loggedin()) {
            redirect("login");
        }
        $this->load->library('encrypt');
    }
    public function index(){

        
    }
    
    public function edit( ){
       $user = $this->uri->segment(3);
       $action = $this->uri->segment(4);
       //decode user
      
       if(!$this->sms->is_member('Student', $user) OR $action==NULL){
           redirect('student/'.$user);
         }
          $data1 = array('success' => FALSE, 'msg' => array(), 'server_msg' => NULL);
          $this->load->library('form_validation');
          
         switch ($action){
             case "change_password":
                    
        $config = array(
            array(
                'field' => 'new_password',
                'label' => 'New Password',
                'rules' => 'trim|required|min_length[6]'
            ),
            array(
                'field' => 'confirm_password',
                'label' => 'Confirm Password',
                'rules' => 'trim|required|matches[new_password]'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|trim|check_password'
            )
            
            
        );
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules($config);
        
          if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else{
            if($this->sms->update_user($user, NULL, $this->input->post('new_password'), NULL, NULL, NULL)){
                $data1['success'] = TRUE;
            }
        }
                 break;
             
             case "update":
                             
        $config = array(
            array(
                'field' => 'name',
                'label' => 'User Name',
                'rules' => 'trim|is_unique[sms_users.name]|min_length[3]'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|is_unique[sms_users.email]'
            ),
             array(
                'field' => 'address',
                'label' => 'Address',
                'rules' => 'required|trim'
            ),
            array(
                'field' => 'rpassword',
                'label' => 'Password',
                'rules' => 'required|trim|recent_password'
            )
            
             
            
            
        );
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules($config);
           $this->form_validation->set_message('is_unique', 'Already exists!');
          if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else{
            
            if($this->sms->update_user($user, $this->input->post('email'), NULL, $this->input->post('username'), $this->input->post('contact'), $this->input->post('address'))){
                $data1['success'] = TRUE;
            }
        }
                 break;
             default :
                  redirect('student/'.$user);
                 break;
                 
         }
          echo json_encode($data1);
       
        
      
         
       //Visit "codeastro.com" for more projects!
      
       //var_dump($this->student->get_student($parm));
    }
    public function view(){
       $parm = $this->uri->segment(2);
       $profile = $this->student->get_student($parm);
       
       if($profile!=FALSE){
    $data['profile'] = $profile; 
    $data['page_title'] = "Student Profile";
        $data['page_slogan'] = "SMS";
       $data['main_content']= "pages/student/profile";
       $this->load->view("layout/form",$data );
       }
       else{
             $data['page_title'] = "Student Not Found";
               $data['type'] = "Student";
          $data['main_content']= "404";
       $this->load->view("layout/data",$data );
       }
         
         
       
    }
}
//Visit "codeastro.com" for more projects!