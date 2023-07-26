<?php

/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
//Visit "codeastro.com" for more projects!

class Error extends CI_Controller{
  
    private $_warning = 1;
    public function __construct() {
        parent::__construct();
        
        if (!$this->sms->is_loggedin()) {
            redirect("login");
        }
    }
    
    public function index() {
        
         $data['page_title'] = "Construction";
          $data['main_content']= "construction";
       $this->load->view("layout/data",$data );
    }
    public function not_found(){
         $data['page_title'] = "Not Found";
          $data['main_content']= "404";
       $this->load->view("layout/data",$data );
    }
    
    public function no_permission(){
     $this->db->where('user_id',$this->session->userdata('id'));
    $this->db->set('warning', 'warning+1',FALSE);
    $this->db->update('sms_security');
        
    if($this->warning()>10){
        $this->sms->ban_user($this->session->userdata('id'));
        $data['msg'] = "You visited this page more than 10 times! Your account is now suspended!"
                . "Contact to administration to reactive your account.";
        $this->reset_warning();
        
    }
      
           $data['warning']= $this->warning();
         $data['page_title'] = "No Permission";
          $data['main_content']= "no_permission";
       $this->load->view("layout/data",$data );
    }
    
    function warning(){
        $this->db->select('warning');
        $this->db->where('user_id',$this->session->userdata('id'));
       $query =  $this->db->get('sms_security');
        return $query->row()->warning;
    }
    function reset_warning(){
        $this->db->select('warning');
        $this->db->set('warning', 0,FALSE);
         $this->db->where('user_id',$this->session->userdata('id'));
          $this->db->update('sms_security');
    }
    
    //Visit "codeastro.com" for more projects!
}