<?php 
//Visit "codeastro.com" for more projects!

class Home extends CI_Controller {



public function __construct() {
        parent::__construct();
//        if(!$this->sms->is_allowed('Admin')){
//        		show_404();
//        }
            $this->load->model('study');
    }


public function index(){

//                        $lib = new Study();
	
  $data['page_title'] = "Studying Material";
        $data['page_slogan'] = "SMS";
        $data['main_content'] = "pages/study/manage";
      	$data['class_lists'] = $this->sms_class->list_class();
//         $data['listall'] = $lib::all();
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
  $this->load->view("pages/study/part/list_subject", $data);


             
            }}
           
            }


            public function viewMaterial(){
  if(!$this->input->is_ajax_request()){
            show_404();
        }
            	     $class = $this->input->post("class_id");
                	 $subject = $this->input->post("subject_id");
        		
                	 		$study = new Study();
            				$data['materials']=$study::where([
 						   ['class_id', '=', $class],
								    ['subject_id', '=', $subject],
								])->get();
        			   $this->load->view("pages/study/part/list", $data);
       				 
       			

            }
             public function view(){
  if(!$this->input->is_ajax_request()){
            show_404();
        }
            	    $class = $this->input->post("clas");
                        $section = $this->input->post("profile");
                	 $subject = $this->input->post("id");
        		
                	 		$study = new Study();
            				$data['feeds']=$study::where([
 						   ['class_id', '=', $class],
								    ['subject_id', '=', $subject],
                                         
								])->get();
                                      
       			   $this->load->view("pages/class/materials", $data);
//       				
       			

            }//Visit "codeastro.com" for more projects!


            public function listSyllabus(){
              if(!$this->input->is_ajax_request()){
            show_404();
        }
            			$study = new Study();
            	echo $study::all();
            }



            	public function add(){
  if(!$this->input->is_ajax_request()){
            show_404();
        }
           		$study = new Study();


    //Visit "codeastro.com" for more projects!
  $config['upload_path'] = './uploads/materials/';
        $config['allowed_types'] = 'jpg|png|zip|rar|pdf|doc';
        $config['max_size'] = '5024';
        $config['encrypt_name'] = TRUE;
        


        $this->load->library('upload', $config);


                  $data1 = array('success' => FALSE, 'msg' => array(), 'server_msg'=>False, 'data' =>false);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
     

        $this->form_validation->set_rules("detail", "Material Detail", "required|min_length[5]| max_length[255]");
                $this->form_validation->set_rules("subject_id", "Subject", "select");

        //$this->form_validation->set_message('is_unique',"Already Exists!");
       // $this->input->post('');
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else {
           	
           	         $class =  $this->encrypt->decode($this->input->post("class_id"));
                          $section =  $this->encrypt->decode($this->input->post("section_id"));
                	 $subject = $this->input->post("subject_id");
                	  $detail = $this->input->post("detail");
                         $user_id =  $this->encrypt->decode($this->input->post("user_id"))  ; 
                         if (!$this->upload->do_upload('file')) {

                $data1['server_msg'] = $this->upload->display_errors('<p class="text-danger">', '</p>');
            } else {


                $file = $this->upload->data();
//                    $data1['success'] = TRUE; //Visit "codeastro.com" for more projects!
                $study->section_id = $section;
                    $study->user_id = $user_id;
                    $study->class_id = $class;
                     $study->subject_id = $subject;
                     $study->detail= $detail;
                     $study->name = $file['orig_name'];
                     $study->file = $file['file_name'];
                     $study->session_id = $this->sms->running_session()->id;
                      if($study->save()){
                	 	 $data1['success'] = TRUE;

                	 	 

                	 	 $data1['data'] = $study->id; ;
                	 }
 

               
            }
             
          
        }
        echo json_encode($data1);


            //Visit "codeastro.com" for more projects!



            			

            	}


            	public function delete(){
                      if(!$this->input->is_ajax_request()){
            show_404();
        }
                     $id = $this->input->post("id");
                   $file = $this->input->post("file");
                     if($id!=NULL){
                        	
     $study = new Study();
     
            		$data1 = [];	
                                 
                $path_to_file = "./uploads/materials/".$file;
                   delete_files($path_to_file);
                              if($study::where('id', '=', $id)->delete()){
                                  $data1['success'] = TRUE;
                         }
               
                	 
                	
                	 echo 	json_encode($data1);
                 

                }}




}

	//Visit "codeastro.com" for more projects!