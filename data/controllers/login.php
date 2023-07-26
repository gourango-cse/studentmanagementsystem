<?php
//Visit "codeastro.com" for more projects!

class Login extends CI_Controller{
    
    public function index(){
        
        if ($this->sms->is_loggedin()){
            redirect("welcome");
       }else{
        $this->load->view("public/login");
       }
    }
    
}

