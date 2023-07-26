
<?php
/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
//Visit "codeastro.com" for more projects!

if (!defined('BASEPATH'))
    show_404();

class Session extends CI_Controller {

   
    public function __construct() {
        parent::__construct();
//          if (!$this->input->is_ajax_request()) {
//            show_404();
//        }
   
    }

    public function msg_log() {
        echo ''
        . '<div class="callout callout-danger">';
        $this->sms->print_errors();
        echo '</div>';
    }

    public function login() {
     
         
        
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $rem = $this->input->post('remember');

        if ($email != NULL && $password != NULL) {
            if ($this->sms->login($email, $password, $rem)) {
                 
               echo 1;
            } else {
                $this->sms->print_errors();
            }
        } else {
            echo "Please enter your E-mail and Password!";
        }
    }
    
    public function verification(){
        if($this->sms->is_loggedin()){
            redirect(base_url("home"));
        }
          $user_id = $this->uri->segment(3);
          $ver_code = $this->uri->segment(4);
          $ver = $this->sms->verify_user($user_id, $ver_code);
      if($ver==TRUE){
         if($this->sms->login_fast($user_id)){
             redirect(base_url("home"));
         }
      }else{
           echo "<h1 style='color:red'>Verification Failed!</h1>";
      }
    }

    public function view_session(){
        if(!$this->sms->is_loggedin()){
            redirect("login");
        }
      
         $id = $this->input->post('session_id');
         
      //  $this->sms_session->set_view($id);
        
        $this->session->set_userdata('running_session_id',$id);
    }
    
 public function count_unread(){
   if(!$this->sms->is_loggedin()){
            redirect("login");
        }
       
     echo   $unread = $this->sms->count_unread_pms();
 }
    
}

