<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//Visit "codeastro.com" for more projects!
/*
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */

class Student extends CI_Model {

    var $config_vars;

    public function __construct() {
        parent::__construct();

        $this->config_vars = $this->config->item('sms');
    }

    public function list_student($session = TRUE, $class = FALSE, $section = FALSE, $roll = FALSE, $parent = FALSE, $transport = FALSE, $hostel = FALSE, $limit = FALSE, $offset = FALSE, $include_banneds = FALSE) {

        $this->db->select('*');
        $this->db->from($this->config_vars['users']);
        $this->db->join($this->config_vars['tbl_student'], $this->config_vars['users'] . ".id = " . $this->config_vars['tbl_student'] . ".student_id");


        $this->db->where("role", "Student");

        if ($session != FALSE) {
            $this->db->where("session_id", $this->sms->running_session()->id);
        }
        if ($class != FALSE) {
            $this->db->where("class_id", $class);
        }
        if ($section != FALSE) {
            $this->db->where("section_id", $section);
        }
        
        if ($roll != FALSE) {
            $this->db->where("roll", $roll);
        }
        if ($parent != FALSE) {
            $this->db->where("parent_id", $parent);
        }
        if ($transport != FALSE) {
            $this->db->where("transport_id", $transport);
        }
        if ($hostel != NULL) {
            $this->db->where("hostel_id", $hostel);
        }

        //Visit "codeastro.com" for more projects!
        // banneds
        if (!$include_banneds) {
            $this->db->where('banned != ', 1);
        }

        // limit
        if ($limit) {

            if ($offset == FALSE)
                $this->db->limit($limit);
            else
                $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        if($query->num_rows()<0){
            return NULL;
        }
       
            return $query->result();
        
    }

    public function get_student($parm=NULL) {
  
      
        $this->db->select('*');
                $this->db->from($this->config_vars['users']);
                $this->db->join($this->config_vars['tbl_student'], $this->config_vars['users'] . ".id = " . $this->config_vars['tbl_student'] . ".student_id");
       $this->db->where("role", "Student");
       

        if($parm!=NULL){
            if(is_numeric($parm)){
                 $this->db->where("id", $parm); 
            }else{
             $this->db->where("name", $parm);
            }
        }else{
            $id = $this->session->userdata('id');
              $this->db->where("id", $id);
        }    
             
        
      

        $query = $this->db->get();
            if($query->num_rows()<=0){
                return FALSE;
            }else{
                return $query->row(); 
            }
       
    }

        //Visit "codeastro.com" for more projects!

    public function count($class=NULL, $section=NULL) {
        if ($class!=NULL AND $section==NULL) {
            $query = $this->db->where('class_id', $class);
            $query = $this->db->where('session_id', $this->session->userdata('running_session_id'));
        $query = $this->db->count_all_results($this->config_vars['tbl_student']);
       
       
        return $query;
        }
//        
        if ($class!= NULL AND $section!=NULL) {
            $query = $this->db->where('class_id', $class);
            $query = $this->db->where('section_id', $section);
            $query = $this->db->where('session_id', $this->session->userdata('running_session_id'));
        $query = $this->db->count_all_results($this->config_vars['tbl_student']);
       
       
        return $query;
        }
        if($class==NULL AND $section==NULL){
         $query = $this->db->where('session_id', $this->session->userdata('running_session_id'));
        $query = $this->db->count_all_results($this->config_vars['tbl_student']);
       
       
        return $query;
        }
    }

    
    
    function register($student_id = NULL, $class = NULL, $section = NULL, $parent = NULL, $roll = NULL, $transport = NULL, $hostel = NULL) {

        if ($student_id != NULL AND $class != NULL AND $section != NULL AND $parent != NULL AND $roll != NULL) {
            $data = array(
                'student_id' => $student_id,
                'class_id' => $class, // Password cannot be blank but user_id required for salt, setting bad password for now
                'section_id' => $section,
                'parent_id' => $parent,
                'roll' => $roll,
                'transport_id' => $transport,
                'hostel_id' => $hostel,
                'session_id' => $this->sms->running_session()->id
            );

            if ($this->db->insert($this->config_vars['tbl_student'], $data)) {
                 
                   
                return TRUE;
            }
        }
        return False;
    }

    //Visit "codeastro.com" for more projects!

}
