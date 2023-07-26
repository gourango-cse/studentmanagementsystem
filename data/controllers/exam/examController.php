<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Visit "codeastro.com" for more projects!
class ExamController extends CI_Controller{
    
    public function index(){
          // $data['list_class'] = $this->sms_class->list_class();
         //Visit "codeastro.com" for more projects!

       
    }

    public function manage_exam() // Manage exam index
    {
        $this->load->model('exam/exam_type');
    	
    	$data['page_title'] = "Manage Examination";
       
        $data['page_slogan'] = "SMS";
        $data['main_content'] = "pages/exam/exam_view";
         $this->load->view("layout/form", $data); 
    	

    // 	$this->blade
				// ->render('exam_view', array('page_title' => 'Manage Exam','page_slogan'=>'SMS'));
    }

    public function get_exam_type()
    {
    	if(!$this->sms->is_admin()){
    		show_404();
    	}
     $this->load->model('exam/exam_type');
     $data['types'] = Exam_type::orderBy('name', 'ASC')->get();
            $this->load->view("pages/exam/list_types", $data); 

    }
    
     public function type_operation($type)  // exam type curd operation
    {

        if(!$this->sms->is_admin()){
            show_404();
        }
        if(is_numeric($type)){
             show_404();
        }

          $this->load->model('exam/exam_type');
        switch ($type) {
            case 'add':
               
            $data1 = array('success' => FALSE, 'msg' => array(), 'insertid'=>FALSE, 'name'=>FALSE);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("exam_name", "Exam Type", "trim|required|is_unique[sms_exam_type.name]");
        
        $this->form_validation->set_message('is_unique',"Exam Already Exists!");
       // $this->input->post('');
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else {

               
               $type = new Exam_type();
               $type->name = $this->input->post('exam_name');
               $type->save();
                $data1['success'] = TRUE; 
                $data1['insertid'] = $type->id;
                $data1['name']= $type->name;
                

          
        }//Visit "codeastro.com" for more projects!
        echo json_encode($data1);





                break;
             case 'update':
           

             $data1 = array('success' => FALSE, 'msg' => array());
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("edit_type", "Exam Name", "trim|required|is_unique[sms_exam_type.name]");
        
        $this->form_validation->set_message('is_unique',"Exam Already Exists!");
       // $this->input->post('');
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else {

               
               $type = new Exam_type();
              
               $type = Exam_type::find($this->input->post('id'));

    

                   

                 $type->name = $this->input->post('edit_type');
                   $type->save();
                $data1['success'] = TRUE; 
               

          
        }
        echo json_encode($data1);

                break;

                 case 'delete':
              
                 
                  $data1 = array('success' => FALSE, 'msg' => array());
                     $this->load->model('exam/exam_type');
               $type = new Exam_type();
               $type = Exam_type::find($this->input->post('id'));
              $type->delete();
                  $data1['success'] = TRUE;
                
           
                    echo json_encode($data1);


                break;
            default:
               show_404();
                break;
        }
    }
//Visit "codeastro.com" for more projects!
}