<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {


public function __construct() {
        parent::__construct();
        if (!$this->sms->is_loggedin()) {
            redirect("login");
        }
    }

//Visit "codeastro.com" for more projects!
public function index(){
		$this->load->model('library');
            			$lib = new Library();
            	
	  $data['page_title'] = "Library";
        $data['page_slogan'] = "SMS";
        $data['main_content'] = "pages/library/home";
        $data['listall'] = $lib::all();
      	$data['class_lists'] = $this->sms_class->list_class();
        $this->load->view("layout/form", $data);
}



 public function list_subject(){
          
                 if(!$this->input->is_ajax_request()){

               show_404();
            } 
            if($this->input->post('class_id')!=NULL){
                if($this->sms_class->is_class_exists($this->input->post('class_id'))){


                	 $class = $this->input->post("class_id");
        
       					
         
              $data['subjects'] =  $this->subject->list_subject($class); 
              $data['class']  = $class; 
  $this->load->view("pages/library/part/list_subject", $data);


             
            }}
           
            }

             public function viewBook(){

            	     $class = $this->input->post("class_id");
                	 $subject = $this->input->post("subject_id");
        		
                	 		$this->load->model('library');
            			$lib = new Library();
            				$data['books']=$lib::where([
 						   ['class_id', '=', $class],
								    ['subject_id', '=', $subject],
								])->get();
        			   $this->load->view("pages/library/part/list", $data);
       				 
       			

            }

//Visit "codeastro.com" for more projects!
}