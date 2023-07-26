<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Visit "codeastro.com" for more projects!
class Routine extends CI_Controller{
public function __construct() {
        parent::__construct();
     
if (!$this->sms->is_loggedin()) {
            redirect("login");
        }
  
                      
    }

  
    public function index(){
         $this->load->model('exam/exam_type');
        
        $data['page_title'] = "View Routine";
       $data['class_lists'] = $this->sms_class->list_class();
        $data['page_slogan'] = "SMS";
        $data['main_content'] = "pages/exam/routine";
         $exam_type = new Exam_type();
               
        $data['examTypes'] = $exam_type->all();  
         $this->load->view("layout/data", $data); 
         

       
    }
    
 
    
    
    public function add(){
//               $this->load->model('exam/exam_type');
                    $this->load->model('exam/examRoutine');
                  $data1 = array('success' => FALSE, 'msg' => array());
                  $routine = new ExamRoutine();



  $config['upload_path'] = './uploads/routine/';
        $config['allowed_types'] = 'jpg|png|zip|rar|pdf|doc';
        $config['max_size'] = '5024';
        $config['encrypt_name'] = TRUE;
        


        $this->load->library('upload', $config);
                  
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("exam_id", "Exam", "select");

   //Visit "codeastro.com" for more projects!
       // $this->input->post('');
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'] = "All field are required!";
            }
        } else {
       
                     $data['class'] = $this->input->post('class_id');
                  $data['exam'] = $this->input->post('exam_id');                
                              
                if (!$this->upload->do_upload('file')) {

                $data1['server_msg'] = $this->upload->display_errors('<p class="text-danger">', '</p>');
            } else {


                $file = $this->upload->data();
//                    $data1['success'] = TRUE;
                    
                    $routine->class_id = $data['class'];
                     $routine->exam_id = $data['exam'];
                     $routine->name = $file['orig_name'];
                     $routine->routine = $file['file_name'];
                          $routine->session_id = $this->sms->running_session()->id;
                      if($routine->save()){
                	 	 $data1['success'] = TRUE;

                	                	 }
 

               
            }
                echo json_encode($data1);

          
        }
    }
     public function view(){
               $this->load->model('exam/examRoutine');

                    
                  $data['exams'] = ExamRoutine::where('exam_id', '=', $this->input->post('exam_id'))->get();
              
                   
                  $data1['view'] =   $this->load->view("pages/exam/part/routine", $data); 
              
                

          
        }
        
        public function download ($id,  $file){
             $this->load->helper('download');
                $this->load->model('exam/examRoutine');
                
            if($id!=NULL AND $file!=NULL){
               
         $data = file_get_contents(base_url()."uploads/routine/".$file); // Read the file's contents
$name = $file;

force_download($name, $data); 

}
  
   
   
         }
    }
             

