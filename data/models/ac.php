<?php

/* 
 *  @package		Kodstack
 *  Author:         Ronash Dhakal
 */
//Visit "codeastro.com" for more projects!
Class Ac extends CI_Model{
    
    
    public function __construct() {
        parent::__construct();
    }

    
    public function create_ac_type($name){
         $this->db->set(array(
           
            'name' =>$name,
             'session_id'=>$this->sms->running_session()->id
        ));
        $query = $this->db->insert('sms_account_type');
    }

     public function update_ac_type($id,$name){
           $this->db->where('id',$id);
       $this->db->where('session_id',$this->sms->running_session()->id);
         $this->db->set(array(
           
            'name' =>$name
        ));
        $query = $this->db->update('sms_account_type');
         if($query){
           return True;
       }
       return false;
    }
     
    public function delete_ac_type($id){
       $query =  $this->db->delete('sms_account_type',array('id'=>$id,'session_id'=>$this->sms->running_session()->id));
       
       if($query){
           return True;
       }
       return false;
    }
    
     public function list_type(){
         
        $query = $this->db->get('sms_account_type');
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }
     public function list_month(){
        
        $query = $this->db->get('sms_account_month');
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }
    
    
    
    public function check_fee_status($student, $month){
         $query = $this->db->where(array(
             'student_id'=>$student,
             'month'=>$month,
             'session_id'=>$this->sms->running_session()->id
         ));
         $query = $this->db->get('sms_account_monthly_payment');
        if($query->num_rows() > 0){
            return $query->row();
        }
        return false;
    }
    
    
    public function monthly_payment($student, $month,$amount){
         $query = $this->db->set(array(
             'amount'=>$amount,
             'student_id'=>$student,
             'month'=>$month,
             'session_id'=>$this->sms->running_session()->id
         ));
          if($this->db->insert('sms_account_monthly_payment')){
              return true;
          }else{
              return false;
          }
          
    }
     public function remove_monthly_payment($student,$month){
         $query = $this->db->where(array(
             'student_id'=>$student,
             'month'=>$month,
             'session_id'=>$this->sms->running_session()->id
         ));
        
          if($this->db->delete('sms_account_monthly_payment')){
              return true;
          }else{
              return false;
          }
          
    }
    
   
    //Visit "codeastro.com" for more projects!
    
    
    
    public function get_ac_type_name($id){
         $this->db->where('id',$id);
           $this->db->where('session_id',$this->sms->running_session()->id);
        $query = $this->db->get('sms_account_type');
        if($query->num_rows() > 0){
            return $query->row()->name;
        }
        return false;
    }

    public function list_fees($class, $type=NULL){
        
           $class_id =  $this->sms_class->get_class($class)->id;
        if($type!=NULL){
        $this->db->where('class_id',$class_id);
         $this->db->where('ac_type',$type);
         $this->db->where('session_id',$this->sms->running_session()->id);
        $query = $this->db->get('sms_account_fees');
        if($query->num_rows() > 0){
            return $query->row();
        }
        return false;
        }else{
            $this->db->where('class_id',$class_id);
       
         $this->db->where('session_id',$this->sms->running_session()->id);
        $query = $this->db->get('sms_account_fees');
        if($query->num_rows() > 0){
            return $query->result(); 
        }
        
        return false;
    }}
    
    public function create_fees($id, $class_id , $amount){
        $this->db->set(array(
            'ac_type' =>$id,
            'class_id' => $class_id,
            'amount' =>$amount,
            'session_id' =>$this->sms->running_session()->id
        ));
        $query = $this->db->insert('sms_account_fees');
        
        if($query){
            return TRUE;
        }
        return False;
    }
    
    
    public function update_ac_fees($id, $amount){
        $this->db->set(array(
            
            'amount' =>$amount
        ));
          $query = $this->db->where('id',$id);
         $query =   $this->db->where('session_id',$this->sms->running_session()->id);
        $query = $this->db->update('sms_account_fees');
        
        if($query){
            return TRUE;
        }
        return False;
    }
   
    
    public function delete_ac_fees($id){
       $query =  $this->db->delete('sms_account_fees', array('id'=>$id,'session_id'=>$this->sms->running_session()->id));
       
       if($query){
           return True;
       }
       return false;
    }
    
    
    }
