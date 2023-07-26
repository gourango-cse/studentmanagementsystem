<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Visit "codeastro.com" for more projects!
class Markscontroller extends CI_Controller{
public function __construct() {
        parent::__construct();
     
if (!$this->sms->is_allowed('Teacher')) {
    show_404();
        }
        
         $this->load->model('syllabus');
                      
    }

  
    public function index(){
         $this->load->model('exam/exam_type');
        
        $data['page_title'] = "Insert Marks";
       $data['class_lists'] = $this->sms_class->list_class();
        $data['page_slogan'] = "SMS";
        $data['main_content'] = "pages/exam/insert_marks";
         $this->load->view("layout/form", $data); 
         

       
    }
//Visit "codeastro.com" for more projects!
    // public function manage_exam() // Manage exam index
    // {
    //     $this->load->model('exam/exam_type');
    	
    // 	$data['page_title'] = "Manage Exam";
       
    //     $data['page_slogan'] = "SMS";
    //     $data['main_content'] = "pages/exam/exam_view";
    //      $this->load->view("layout/form", $data); 
    	

    // // 	$this->blade
				// // ->render('exam_view', array('page_title' => 'Manage Exam','page_slogan'=>'SMS'));
    // }

        
     public function operation($type)  // exam type curd operation
    {

        if(!$this->sms->is_allowed('Teacher')){
            show_404();
        }
        if(is_numeric($type)){
             show_404();
        }

          $this->load->model('exam/exam_type');
         
          


          switch ($type) {
              case 'form':
                
                            
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
                 if($this->subject->is_subject_teacher($this->sms->get_user()->id) OR $this->sms->is_allowed('Admin')){
             foreach($subjects as $subject){
                     
                   echo '<option  value="'.$subject->id.'">'.$subject->name.'</option>';
             }}else{
                  echo '<option selected  value="0">Only respective subject teacher can insert marks</option>';
             }
                                        echo '       
                            </select>
                        </div>';
                                        echo '  <div class="form-group has-feedback">
                            <button class="btn btn-success" type="submit" name="insert_marks" >Insert Marks </button>
                        </div>   ';
            }
                            
                  
              
                  break;
                  
              case 'view':
                  
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
                  $data['list_student'] = $this->student->list_student($session = TRUE, $data['class'], FALSE, $roll = FALSE, $parent = FALSE, $transport = FALSE, $hostel = FALSE, $limit = FALSE, $offset = FALSE, $include_banneds = FALSE);
                 $data1['view'] =   $this->load->view("pages/exam/get_student", $data); 
              
                

          
        }
       
                 
                  break;
                  
              case 'insert':
                    $data1 = ['success'=>false];
             $this->load->model('exam/examMarks');
                     $this->load->model('exam/verify');
                  $attendance = $this->input->post('attendance');
                       $marks = $this->input->post('marks');
                  
                       if(count($attendance)== count($marks)){
                      $t = array_combine($attendance, $marks);
                      $n=0;
                       foreach ($t as $k => $v) {
                           $n++;
                           
                           if($this->verify->check($k, $this->input->post('class_id'), $this->input->post('exam_id'), $this->input->post('subject_id'))){
                              $n = new ExamMarks();
               $n->student_id = $k;
               $n->marks = $v;
               $n->class_id = $this->input->post('class_id');
                $n->exam_id = $this->input->post('exam_id');
                 $n->subject_id = $this->input->post('subject_id');
                  $n->session_id = $this->sms->running_session()->id;
              $n->save();  
                           
              $data1['success'] = true;
                           }else{
                              $data1['msg'] =  "Students Marks is Already Regitered!";
                           }
              
//                           echo $k."Obtain".$v."Marks"."<br/>";
                          
                       }
                       }else{
                              $data1['msg'] =  "All field are required!";
                       }
                    
                            echo json_encode($data1);
                  break;
              
              default:
                  show_404();
                  break;
          }
    }

}