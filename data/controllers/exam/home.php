<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Visit "codeastro.com" for more projects!
class Home extends CI_Controller{
public function __construct() {
        parent::__construct();
     
if (!$this->sms->is_loggedin()) {
            redirect("login");
        }
  
                      
    }

  
    public function index(){
         $this->load->model('exam/exam_type');
        
        $data['page_title'] = "View Marks";
       $data['class_lists'] = $this->sms_class->list_class();
        $data['page_slogan'] = "SMS";
        $data['main_content'] = "pages/exam/home";
         $this->load->view("layout/data", $data); 
         

       
    }
    
    public function form(){
        $this->load->model('exam/exam_type');
         if($this->sms_class->is_class_exists($this->input->post('class_id'))){
                 $subjects = $this->subject->list_subject($this->input->post('class_id'));
                $exam_type = new Exam_type();
                $exams = $exam_type->all();
                 $students = $this->student->list_student($session = TRUE, $class = $this->input->post('class_id'), $section = FALSE, $roll = FALSE, $parent = FALSE, $transport = FALSE, $hostel = FALSE, $limit = FALSE, $offset = FALSE, $include_banneds = FALSE);   

                // exam type

                 echo ' <div class="form-group has-feedback">
                            <label>Select Exam</label>
                            <select id="exam_id" name ="exam_id" class="form-control select_class" style="width: 100%;" tabindex="-1" aria-hidden="true">

                                <option value="0">Null</option>';
             foreach($exams as $exam){
                      
                   echo '<option  value="'.$exam->id.'">'.$exam->name.'</option>';
       }
                                        echo '       
                            </select>
                        </div>';




               // subject

                echo ' <div class="form-group has-feedback">
                            <label>Select Subject</label>
                            <select id="subject_id" name ="subject_id" class="form-control select_class" style="width: 100%;" tabindex="-1" aria-hidden="true">

                                <option value="0">Null</option>';
                
             foreach($subjects as $subject){
                     
                   echo '<option  value="'.$subject->id.'">'.$subject->name.'</option>';
             }
                                        echo '       
                            </select>
                        </div>';
                                        echo '  <div class="form-group has-feedback">
                            <button class="btn btn-success" type="submit" name="insert_marks" >View Marks </button>
                        </div>   ';
            }
                            
    
    }
    public function search(){
               $this->load->model('exam/exam_type');
                    $this->load->model('exam/examMarks');
                  $data1 = array('success' => FALSE, 'msg' => array());
                  
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("exam_id", "Exam", "select");
        $this->form_validation->set_rules("subject_id", "Subject", "select");
   
       // $this->input->post('');
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data['msg'] = "All field are required!";
            }
        } else {
              $this->load->model('exam/exam_type');
                     $data['class'] = $this->input->post('class_id');
                  $data['exam'] = Exam_type::where('id', '=', $this->input->post('exam_id'))->get();
                  
                  $data['subject'] = $this->subject->get_subject($this->input->post('subject_id'));
                 
                   $data['marks'] = ExamMarks::where([
                           ['class_id', '=', $this->input->post('class_id')],
                           ['subject_id', '=', $this->input->post('subject_id')],
                           ['exam_id', '=', $this->input->post('exam_id')],
                           ['session_id', '=', $this->sms->running_session()->id]
                           ])->get();
                   
                  $data1['view'] =   $this->load->view("pages/exam/part/result", $data); 
              
                

          
        }
    }
             

  //Visit "codeastro.com" for more projects!
}