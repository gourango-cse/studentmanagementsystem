<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Visit "codeastro.com" for more projects!
class Manage extends CI_Controller {



public function __construct() {
        parent::__construct();
     
if (!$this->sms->is_loggedin()) {
            redirect("login");
        }
        
         $this->load->model('syllabus');
                      
    }

//Visit "codeastro.com" for more projects!
public function index(){

                        $syllabus = new Syllabus();
	
  $data['page_title'] = "Syllabus";
        $data['page_slogan'] = "SMS";
        $data['main_content'] = "pages/syllabus/manage";
      	$data['class_lists'] = $this->sms_class->list_class();
         $data['listall'] = $syllabus::all();
        $this->load->view("layout/form", $data);
}


//Visit "codeastro.com" for more projects!

 public function list_subject(){
    
          
                 if(!$this->input->is_ajax_request()){

               show_404();
            } 
            if($this->input->post('class_id')!=NULL){
                if($this->sms_class->is_class_exists($this->input->post('class_id'))){


                	 $class = $this->input->post("class_id");
        
       					
         
              $data['subjects'] =  $this->subject->list_subject($class); 
              $data['class']  = $class; 
  $this->load->view("pages/syllabus/part/list_subject", $data);


             
            }}
           
            }


            public function viewSyllabus(){
  if(!$this->input->is_ajax_request()){
            show_404();
        }
            	     $class = $this->input->post("class_id");
                	 $subject = $this->input->post("subject_id");
        		
                	 		$syllabus = new Syllabus();
            				$data['syllabus']=$syllabus::where([
 						   ['class_id', '=', $class],
								    ['subject_id', '=', $subject],
								])->get();
        			   $this->load->view("pages/syllabus/part/list", $data);
       				 
       			

            }


            public function listSyllabus(){
              if(!$this->input->is_ajax_request()){
            show_404();
        }
            			$syllabus = new Syllabus();
            	echo $syllabus::all();
            }



            	public function add_syllabus(){
  if(!$this->input->is_ajax_request()){
            show_404();
        }
           			$syllabus = new Syllabus();



  $config['upload_path'] = './uploads/syllabus/';
        $config['allowed_types'] = 'jpg|png|zip|rar|pdf|doc';
        $config['max_size'] = '5024';
        $config['encrypt_name'] = TRUE;
        


        $this->load->library('upload', $config);


                  $data1 = array('success' => FALSE, 'msg' => array(), 'server_msg'=>False, 'data' =>false);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
     

        $this->form_validation->set_rules("class_id", "Class", "trim|select");
        $this->form_validation->set_rules("subject_id", "Subject", "trim|select");
        //$this->form_validation->set_message('is_unique',"Already Exists!");
       // $this->input->post('');
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else {
           	
           	 $class = $this->input->post("class_id");
                	 $subject = $this->input->post("subject_id");
                	 
                            
                         if (!$this->upload->do_upload('file')) {

                $data1['server_msg'] = $this->upload->display_errors('<p class="text-danger">', '</p>');
            } else {


                $file = $this->upload->data();
//                    $data1['success'] = TRUE;
                    
                    $syllabus->class_id = $class;
                     $syllabus->subject_id = $subject;
                     $syllabus->name = $file['orig_name'];
                     $syllabus->file = $file['file_name'];
                      if($syllabus->save()){
                	 	 $data1['success'] = TRUE;

                	 	 

                	 	 $data1['data'] = $syllabus->id; ;
                	 }
 

               
            }
             
          
        }
        echo json_encode($data1);


        //Visit "codeastro.com" for more projects!



            			

            	}


            	public function delete_syllabus(){
                      if(!$this->input->is_ajax_request()){
            show_404();
        }
                     $id = $this->input->post("id");
                      $file = $this->input->post("file");
                     if($id!=NULL){
                        	
     $syllabus = new Syllabus();
     
            		$data1 = [];	
                                 
                $path_to_file = "./uploads/syllabus/".$file;
                   delete_files($path_to_file);
                              if($syllabus::where('id', '=', $id)->delete()){
                                  $data1['success'] = TRUE;
                         }
               
                	 
                	
                	 echo 	json_encode($data1);
                 

                }}


                //Visit "codeastro.com" for more projects!

}