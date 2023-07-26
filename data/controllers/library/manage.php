<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Visit "codeastro.com" for more projects!
class Manage extends CI_Controller {



public function __construct() {
        parent::__construct();
        if(!$this->sms->is_allowed('Admin')){
        		show_404();
        }
    }


public function index(){
    $this->load->model('library');
                        $lib = new Library();
	
  $data['page_title'] = "Manage Library";
        $data['page_slogan'] = "SMS";
        $data['main_content'] = "pages/library/manage";
      	$data['class_lists'] = $this->sms_class->list_class();
         $data['listall'] = $lib::all();
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

    //Visit "codeastro.com" for more projects!
             
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


            public function listBooks(){
            	$this->load->model('library');
            			$lib = new Library();
            	echo $lib::all();
            }



            	public function add_book(){
            		$this->load->model('library');
            			$lib = new Library();






                  $data1 = array('success' => FALSE, 'msg' => array(), 'server_msg'=>False, 'data' =>false);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("name", "Book Name", "trim|required|min_length[2]");
        $this->form_validation->set_rules("publication", "Book Publication", "trim|required|min_length[2]");
        $this->form_validation->set_rules("author", "Author Name", "trim|min_length[2]");
        $this->form_validation->set_rules("class_id", "Class", "trim|select");
        $this->form_validation->set_rules("subject_id", "Subject", "trim|select");
        //$this->form_validation->set_message('is_unique',"Already Exists!");
       // $this->input->post('');
       //Visit "codeastro.com" for more projects!
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else {
           	
           	 $class = $this->input->post("class_id");
                	 $subject = $this->input->post("subject_id");
                	  $name = $this->input->post("name");
                	 $publication = $this->input->post("publication");

                	 $lib->name = $name;
                	 $lib->publication = $publication;
                	 	 $lib->author = $this->input->post("author");;
                	 $lib->class_id = $class;
                	 $lib->subject_id = $subject;
                	 if($lib->save()){
                	 	 $data1['success'] = TRUE;

                	 	 

                	 	 $data1['data'] = $lib->id; ;
                	 }


             
          
        }
        echo json_encode($data1);






            			

            	}


            	public function delete_book(){
            			$this->load->model('library');
            			$lib = new Library();

            			 $id = $this->input->post("id");

                
                	 if($lib::where('id', '=', $id)->delete()){
                	 	 $data1['success'] = TRUE;
                	 }

                	 echo 	json_encode($data1);
            	}



                //Visit "codeastro.com" for more projects!
}