<?php

/*
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
//Visit "codeastro.com" for more projects!
class Sms_Class extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->config_vars = $this->config->item('sms');
    }
    public function add_class($class_name,$class_num){
        
          $query =  $this->db->set('name',$class_name);
          $query =  $this->db->set('num',$class_num);
            $query = $this->db->insert($this->config_vars['tbl_class']);
            
                              if($query!=FALSE){
                                  $id = $this->db->insert_id();
                                if($this->add_section($id, "A")){
                                    
                        return true;
                              }}else{
                        return FALSE;
                    }
                  
    }
      public function update_class($id,$class_name){
          $this->db->where('id',$id);
            $this->db->set('name',$class_name);
                              if($this->db->update($this->config_vars['tbl_class'])!=FALSE){
                        
                        return true;
                    }else{
                        return FALSE;
                    }
                  
    }
    public function add_section($class_id,$section_name, $teacher_id =NULL){
                  $this->db->set('class_id',$class_id);
             $this->db->set('name',$section_name);
            
                  
                    if($teacher_id!=NULL){
            $this->db->set('teacher_id',$teacher_id);
                    }
                    if($this->db->insert($this->config_vars['tbl_class_section'])!=FALSE){
                        return true;
                    }else{
                        return FALSE;
                    }
    }
   

    public function get_class($parm) {
        if (is_numeric($parm)) {
            $query = $this->db->where("id", $parm);
            $query = $this->db->get($this->config_vars['tbl_class']);
            if ($query->num_rows() > 0) {

                return $query->row();
            }
        } else {
            $query = $this->db->where("name", $parm);
            $query = $this->db->get($this->config_vars['tbl_class']);

            if ($query->num_rows() > 0) {

                return $query->row();
            }
        }
        return FALSE;
    }
    //Visit "codeastro.com" for more projects!
    public function is_class_exists($parm) {
        if (is_numeric($parm)) {
            $query = $this->db->where("id", $parm);
            $query = $this->db->get($this->config_vars['tbl_class']);
            if ($query->num_rows() > 0) {

                return True;
            }
        } else {
            $query = $this->db->where("name", $parm);
            $query = $this->db->get($this->config_vars['tbl_class']);

            if ($query->num_rows() > 0) {

                return True;
            }
        }
        return FALSE;
    }
    public function is_student_on_section($section_id){
         $check_std  = $this->student->list_student(FALSE, $class = FALSE, $section_id, $roll = FALSE, $parent = FALSE, $transport = FALSE, $hostel = FALSE, $limit = FALSE, $offset = FALSE, $include_banneds = TRUE);
    
    if($check_std==NULL){
        return FALSE;
    }else{
        return TRUE;
    }}
public function delete_section($section_id){
    $check_std  = $this->student->list_student(FALSE, $class = FALSE, $section_id, $roll = FALSE, $parent = FALSE, $transport = FALSE, $hostel = FALSE, $limit = FALSE, $offset = FALSE, $include_banneds = TRUE);
    
    if($check_std==NULL){
         $query = $this->db->where("id", $section_id);
       if( $query = $this->db->delete($this->config_vars['tbl_class_section'])){
           return True;
           
       }else{
           return False;
       }
        
    }
    return false;
    //Visit "codeastro.com" for more projects!
    
   
}
public function delete_class($class_id){
   
              $query = $this->db->where("class_id", $class_id);
              $query = $this->db->delete($this->config_vars['tbl_subject']);
              $query=NULL;
         $query = $this->db->where("id", $class_id);
       if( $query = $this->db->delete($this->config_vars['tbl_class'])){
           return True;
           
       }else{
           return False;
       }
   
       //Visit "codeastro.com" for more projects!
    
    
   
}
    public function get_class_id($parm) {
        $query = $this->db->select("id");
        $query = $this->db->where("name", $parm);
        $query = $this->db->get($this->config_vars['tbl_class']);
        if ($query->num_rows() > 0) {

            return $query->row()->id;
        }
    }
    public function get_section($parm) {
        $query = $this->db->select("id");
        $query = $this->db->where("name", $parm);
        $query = $this->db->get($this->config_vars['tbl_class']);
        if ($query->num_rows() > 0) {

            return $query->row()->id;
        }
    }

    public function get_class_section_id($parm) {
         $query = $this->db->select("id");
        $query = $this->db->where("name", $parm);
        $query = $this->db->get($this->config_vars['tbl_class_section']);
        if ($query->num_rows() > 0) {

            return $query->row()->id;
        }
    }

    public function get_class_section($class, $parm) {
        $class_id = $this->get_class_id($class);
        if (is_numeric($parm)) {
            $query = $this->db->where("id", $parm);
            $query = $this->db->where("class_id", $class_id);
            $query = $this->db->get($this->config_vars['tbl_class_section']);
            if ($query->num_rows() > 0) {

                return $query->row();
            }
        } else if (is_numeric($parm) AND is_numeric($class)) {
            $query = $this->db->where("id", $parm);
            $query = $this->db->where("class_id", $class);
            $query = $this->db->get($this->config_vars['tbl_class_section']);
            if ($query->num_rows() > 0) {

                return $query->row();
            }
        } else {

            $query = $this->db->where("class_id", $class_id);
            $query = $this->db->where("name", $parm);
            $query = $this->db->get($this->config_vars['tbl_class_section']);

            if ($query->num_rows() > 0) {

                return $query->row();
            }
        }
        return FALSE;
    }

    public function is_class_section_exists($class, $parm) {
        $class_id = $this->get_class_id($class);
        if (is_numeric($parm)) {
            $query = $this->db->where("id", $parm);
            $query = $this->db->where("class_id", $class_id);
            $query = $this->db->get($this->config_vars['tbl_class_section']);
            if ($query->num_rows() > 0) {

                return True;
            }
        } else if (is_numeric($parm) AND is_numeric($class)) {
            $query = $this->db->where("id", $parm);
            $query = $this->db->where("class_id", $class);
            $query = $this->db->get($this->config_vars['tbl_class_section']);
            if ($query->num_rows() > 0) {

                return True;
            }
        } else {

            $query = $this->db->where("class_id", $class_id);
            $query = $this->db->where("name", $parm);
            $query = $this->db->get($this->config_vars['tbl_class_section']);

            if ($query->num_rows() > 0) {

                return True;
            }
        }
        return FALSE;
    }

    public function list_class() {
         $query =  $this->db->order_by("num", "ASC"); 
        $query = $this->db->get($this->config_vars['tbl_class']);
        if ($query->num_rows() <= 0) {
            //$this->error($this->CI->lang->line('sms_error_no_user'));
            return FALSE;
        }
        //Visit "codeastro.com" for more projects!
        return $query->result();
    }

    public function update_class_teacher($teacher = FALSE, $class = FALSE) {
        if ($teacher != FALSE AND $class != FALSE) {
            $data = array(
                'teacher_id' => 0,
            );
                 $this->db->where('teacher_id', $teacher);
            if ($this->db->update($this->config_vars['tbl_class'], $data)) {
                    $data = NULL; 
                $data = array(
                'teacher_id' => $teacher,
            );
            $this->db->where('id', $class);
             if ($this->db->update($this->config_vars['tbl_class'], $data)) {
                 return TRUE;
             }
                
            }else{
                return FALSE;
            }
        }
        return False;
    }

    public function update_section_teacher($teacher = FALSE, $class = FALSE) {
        if ($teacher != FALSE AND $class != FALSE) {
            $data = array(
                'teacher_id' => 0,
            );
                 $this->db->where('teacher_id', $teacher);
            if ($this->db->update($this->config_vars['tbl_class_section'], $data)) {
                    $data = NULL; 
                $data = array(
                'teacher_id' => $teacher,
            );
            $this->db->where('id', $class);
             if ($this->db->update($this->config_vars['tbl_class_section'], $data)) {
                 return TRUE;
             }
                
            }else{
                return FALSE;
            }
        }
        return False;
    } //Visit "codeastro.com" for more projects!
    public function get_class_teacher($teacher_id) {
        if ($teacher_id != NULL AND $teacher_id!=0) {
            $query = $this->db->where('id', $teacher_id);
            $query = $this->db->where('role', "Teacher");
            $query = $this->db->get($this->config_vars['users']);
            if ($query->num_rows > 0) {
                return $query->row();
            }
        } else {
            return "N/A";
        }
    }
    //Visit "codeastro.com" for more projects!
    public function get_section_teacher($section_id) {
        if ($class_id != NULL) {
            $query = $this->db->where('id', $class_id);
            $query = $this->db->where('role', "Teacher");
            $query = $this->db->get($this->config_vars['users']);
            if ($query->num_rows > 0) {
                return $query->row()->full_name;
            }
        } else {
            return "N/A";
        }
    }

    public function get_class_name_by_id($id = NULL) {
        $query = $this->db->select('name');
        $query = $this->db->where('id', $id);
        $query = $this->db->get($this->config_vars['tbl_class']);
        return $query->row()->name;
    }

    public function is_class_teacher($id, $data = FALSE) {
        $query = $this->db->where('teacher_id', $id);

        $query = $this->db->get($this->config_vars['tbl_class']);
        if ($query->num_rows() > 0) {
                if($data==TRUE){
              return     $query->row()->name;
                }else{
            return TRUE;
                }
        }
        else{
            return FALSE;
                }

      return false;
    }

   //Visit "codeastro.com" for more projects!
    public function list_section($class_id, $count=FALSE) {

        $query = $this->db->where('class_id', $class_id);
        $query = $this->db->order_by("id", "asc");
        $query = $this->db->get($this->config_vars['tbl_class_section']);
        if ($query->num_rows() <= 0) {
            //$this->error($this->CI->lang->line('sms_error_no_user'));
            return FALSE;
        }
IF($count!=FALSE){
    return $query->num_rows();
}
        return $query->result();
    }

    public function is_section_teacher($id, $data=FALSE) {

        $query = $this->db->where('teacher_id', $id);
        $query = $this->db->get($this->config_vars['tbl_class_section']);
        if ($query->num_rows() > 0) {
if($data==TRUE){
    return $query->row()->name;
}else{
            return TRUE;
}
        }else{

        return FALSE;
    }}

    public function get_section_name_by_id($id = NULL) {
        $query = $this->db->select('name');
        $query = $this->db->where('id', $id);
        $query = $this->db->get($this->config_vars['tbl_class_section']);
        return $query->row()->name;
    }

}
//Visit "codeastro.com" for more projects!