<?php

/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
//Visit "codeastro.com" for more projects!

class Subject extends CI_Model{
    
    
    var $config_vars;

    public function __construct() {
        parent::__construct();

        $this->config_vars = $this->config->item('sms');
    }

    public function add_subject($class, $subject){
              $query = $this->db->set('class_id', $class);    
         $query = $this->db->set('name', ucfirst($subject));
        
         
      
         if($this->db->insert('sms_subject')!=FALSE){
             return true;
         }else{
             return false;
         }
    }
    public function list_subject($class_id=NULL){
        $query = $this->db->where('class_id', $class_id);
        $query = $this->db->get('sms_subject');
        if($query->num_rows()<=0){
            return false;
        }else{
            return $query->result();
        }
    }


 public function get_subject($id=NULL){
        $query = $this->db->where('id', $id);
        $query = $this->db->get('sms_subject');
        if($query->num_rows()<=0){
            return false;
        }else{
            return $query->row();
        }
    }
    //Visit "codeastro.com" for more projects!
    public function assign_subject_teacher($subject_id, $teacher_id){
        $query = $this->db->set('teacher_id', $teacher_id); 
        $query = $this->db->where('id', $subject_id);  
        if($this->db->update('sms_subject')!=FALSE){
            return TRUE;
        }  
        return FALSE;
    }
     public function update_subject($id,$name){
          $query = $this->db->set('name', $name); 
         $query = $this->db->where('id', $id);
          if($this->db->update('sms_subject')!=FALSE){
              return TRUE;
          } 
           return FALSE;
    }
    public function delete_subject($id){
         $query = $this->db->where('id', $id);
          if($this->db->delete('sms_subject')!=FALSE){
              return TRUE;
          } 
            return FALSE;
    }
    
    public function is_subject_teacher($teacher){
        $query = $this->db->where('teacher_id', $teacher);
        $query = $this->db->get('sms_subject');
        if($query->num_rows()<=0){
            return false;
        }else{
            return true;
        } 
    }
    //Visit "codeastro.com" for more projects!
    }