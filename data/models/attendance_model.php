<?php

/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
//Visit "codeastro.com" for more projects!

class Attendance_model extends CI_Model{
    
    
    var $config_vars;

    public function __construct() {
        parent::__construct();

        $this->config_vars = $this->config->item('sms');
    }

    private function attend($student,$class, $section,  $date, $session){
        
        
              $query = $this->db->set('student_id', $student); 
                    $query = $this->db->set('class_id', $class);  
                          $query = $this->db->set('section_id', $section);    
         $query = $this->db->set('dt', $date);
       
            $query = $this->db->set('session_id', $session);
        
         
      
         if($this->db->insert('sms_attendance')!=FALSE){
             return true;
         }else{
             return false;
         }
    }
    
    public function check($student,$class, $section,  $date, $session){
        $data  = array(
       'student_id' => $student,
            'class_id' =>$class,
            'section_id' => $section,
            'dt' => $date,
            
            'session_id' => $session
        );
          $query = $this->db->where($data);
           $query = $this->db->get('sms_attendance');
           if($query->num_rows()>0){
            return false;
        }else{
            $this->attend($student,$class, $section,  $date, $session);
        }
          
    }
    
    public function total_student($class, $section, $date, $session){
         $data  = array(
         
            'class_id' =>$class,
             'section_id' => $section,
             'dt' => $date,
            'session_id' => $session
        );
          $query = $this->db->where($data);
           $query = $this->db->get('sms_attendance');
           return $query->num_rows();
           
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
   
    }//Visit "codeastro.com" for more projects!