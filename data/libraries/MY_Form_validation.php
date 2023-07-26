<?php

/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 * 
 */

class MY_Form_validation extends CI_Form_validation
{
  var $config_var;
    public function __construct($rules = array())
    {
        parent::__construct($rules);
        $this->CI->load->library('encrypt');
         $this->CI->load->library('sms');
          $this->config_vars = $this->CI->config->item('sms');
    }
    
     public function unique_roll_number($v)
    {
         
       $class_id = $this->CI->input->post('class_id');
       $section_id = $this->CI->input->post('section_id');
       $roll = $v;
      
        $check = $this->CI->db->get_where('sms_student', array('class_id' => $class_id,'section_id' =>$section_id, 'roll' =>$roll), 1);
       if($check->num_rows()!=0){
         $this->set_message('unique_roll_number', 'This roll number is already exists in this section');
        return false;
       }else{
           return true;
       }
    }
    public function unique_section($v)
    {
         
       $class_id = $this->CI->input->post('class_id');
       
       $section = $v;
       
        $check = $this->CI->db->get_where('sms_class_section', array('class_id' => $class_id, 'name' =>$section), 1);
       if($check->num_rows()!=0){
         $this->set_message('unique_section', 'This section is already exists in this class');
        return false;
       }else{
           return true;
       }
    }
    public function unique_subject($v)
    {
       
       $class_id = $this->CI->input->post('subject_class_id');
     
       $subject = $v;
       
        $check = $this->CI->db->get_where('sms_subject', array('class_id' => $class_id, 'name' =>$subject), 1);
       if($check->num_rows()!=0){
         $this->set_message('unique_subject', 'This Subject is already exists in this class');
        return false;
       }else{
           return true;
       }
    }
    
    public function unique_ac_type($v)
    {
       
       $session_id = $this->CI->sms->running_session()->id;
     
      
       
        $check = $this->CI->db->get_where('sms_account_type', array('session_id' => $session_id, 'name' =>$v), 1);
       if($check->num_rows()!=0){
         $this->set_message('unique_ac_type', 'Already exists!');
        return false;
       }else{
           return true;
       }
    }
     public function unique_ac_fees($v)
    {
       
       $session_id = $this->CI->sms->running_session()->id;
     
      $class = $this->CI->input->post('class_id');
       
        $check = $this->CI->db->get_where('sms_account_fees', array('session_id' => $session_id, 'ac_type' =>$v,'class_id'=>$class), 1);
       if($check->num_rows()!=0){
         $this->set_message('unique_ac_fees', 'Already exists!');
        return false;
       }else{
           return true;
       }
    }
     public function is_subject_id($v)
    {
        
     //  $class_id = $this->CI->input->post('subject_class_id');
     
       $subject = $v;
       
        $check = $this->CI->db->get_where('sms_subject', array('id' => $subject), 1);
       if($check->num_rows()==0){
         $this->set_message('is_subject_id', 'This Subject is not valid!');
        return false;
       }else{
           return true;
       }
    }
    public function is_class_id($v)
    {
        
     //  $class_id = $this->CI->input->post('subject_class_id');
     
       $class = $v;
       
        $check = $this->CI->db->get_where('sms_class', array('id' => $class), 1);
       if($check->num_rows()==0){
         $this->set_message('is_class_id', 'This class is not valid!');
        return false;
       }else{
           return true;
       }
    }
     public function has_student_in_class($v)
    {
        
     //  $class_id = $this->CI->input->post('subject_class_id');
     
       $class = $v;
       
        $check = $this->CI->db->get_where('sms_student', array('class_id' => $class), 1);
       if($check->num_rows()>0){
         $this->set_message('has_student_in_class', 'You cannot delete the class where student exists!');
        return false;
       }else{
           return true;
       }
    }
    public function check_password($v)
    {
         
       $password = $this->CI->input->post('password');
       $user_id =  $this->CI->input->post('user_id');
       $id =   $this->CI->encrypt->decode($user_id);
       $pass = $this->CI->sms->hash_password($password,$id);
              
        $check = $this->CI->db->get_where('sms_users', array('pass' => $pass), 1);
       if($check->num_rows()==0){
         $this->set_message('check_password', 'Invalid Password');
        return false;
       }else{
           return true;
       }
    }
    public function recent_password($v)
    {
         
       $password = $this->CI->input->post('rpassword');
       $user_id =  $this->CI->input->post('user_id');
       $id =   $this->CI->encrypt->decode($user_id);
       $pass = $this->CI->sms->hash_password($password,$id);
              
        $check = $this->CI->db->get_where('sms_users', array('pass' => $pass), 1);
       if($check->num_rows()==0){
         $this->set_message('recent_password', 'Invalid Password');
        return false;
       }else{
           return true;
       }
    }
    
   public function select($v)
    {
                   
       
       if($v==0){
         $this->set_message('select', 'You did not select any %s');
        return false;
       }else{
           return true;
       }
    }
    
 
}
