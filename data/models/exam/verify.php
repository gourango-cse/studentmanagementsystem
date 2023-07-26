<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Visit "codeastro.com" for more projects!
class Verify extends CI_Model{
    
    
    public function check($student,  $class, $exam, $subject){
         $data  = array(
       'student_id' => $student,
          
            'class_id' =>$class,
            'session_id' => $this->sms->running_session()->id,
            'subject_id' => $subject,
            
            'exam_id' => $exam
        );
          $query = $this->db->where($data);
           $query = $this->db->get('sms_exam_marks');
           if($query->num_rows()>0){
            return false;
        }else{
            return true;
        }
    }
    
}