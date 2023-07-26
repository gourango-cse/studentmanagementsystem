<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Visit "codeastro.com" for more projects!
class Download extends CI_Controller{
    
public function __construct() {
        parent::__construct();
        if (!$this->sms->is_loggedin()) {
            redirect("login");
        }
        $this->load->model('Syllabus');
        $this->load->helper('download');
    }


public function index($id=NULL, $file= NULL){
    
                        
	
 if($id!=NULL AND $file!= NULL){
     $syllabus = new Syllabus();
 $data =  $syllabus::where([
 						   ['id', '=', $id]
								   
								])->get();
                                                        
if(!empty($data)){
       foreach ($data as $da){

     
     $data = array(
               'count' => $da->count+1,
               
            );

$this->db->where('id', $id);
$this->db->update('sms_syllabus', $data); 
           
          
 
       }


  //Visit "codeastro.com" for more projects!
               
         $data = file_get_contents(base_url()."uploads/syllabus/".$file); // Read the file's contents
$name = $file;

force_download($name, $data); 

}
  
   
   
 }
 else{
     echo "hi";
 }
 
 
 
 
}

    //Visit "codeastro.com" for more projects!
    
}