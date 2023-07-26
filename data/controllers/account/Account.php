<?php

/* 
 *  @package		Kodstack
 *  Author:         Ronash Dhakal
 */

class Account extends CI_Controller{
    
    
   public function __construct() {
     parent::__construct();
     $this->load->model('ac');
 }

 public function index(){
     $data['list_class'] = $this->sms_class->list_class();
       $data['page_title'] = "Manage Accounting";
        $data['page_slogan'] = "SMS";
        $data['main_content'] = "pages/account/account_view";

        $this->load->view("layout/form", $data);
 }
 
 public function fees(){
     
      $data['list_class'] = $this->sms_class->list_class();
      
       $data['page_title'] = "Fees Payment";
        $data['page_slogan'] = "SMS";
        $data['main_content'] = "pages/account/payment_form";

        $this->load->view("layout/form", $data);
 }
 
 
 public function list_student(){
     if(!$this->input->is_ajax_request()){
         show_404();
        }
        
        $class = $this->input->post("class_id");
        
        $students = $this->student->list_student($session = TRUE, $class = $class, $section = FALSE, $roll = FALSE, $parent = FALSE, $transport = FALSE, $hostel = FALSE, $limit = FALSE, $offset = FALSE, $include_banneds = FALSE);        
          if($students){
        
              
              
              
              echo ''
        . ' <div class="form-group">
                            <label>Student</label>
                            <select   name="student_id" class="form-control list_student" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="0" selected="selected">Select Student</option>';
     
        foreach ($students as $student){
           
            echo '<option value="' . $student->id . '">' . $student->full_name . '</option>';
            
       
            
        }
        
        echo ''
        . ' </select>
                            <div id="class_id"></div>
                        </div>';
       echo ''
        . ' <div class="form-group">
                             <button type="submit" class="btn btn-success">Get Status</button>
                        </div>'
               . '';
       
 }else{
     echo "Student does not exists!";
 }
 
        }
 
 
 //Visit "codeastro.com" for more projects!

 public function get_status(){
     
       if(!$this->input->is_ajax_request()){
         show_404();
        }
        
        
             $type = $this->input->post("type");
            
             $class = $this->input->post("class_id");
              
           $student = $this->input->post("student_id");
//              $month = $this->input->post("month_id");
           
           if($student!=0){
               $data['class_id'] = $class;               
               $data['total_amount'] = $this->ac->list_fees($class, $type);
             $data['list_month'] = $this->ac->list_month();
             $data['student'] = $this->student->get_student($student);
              $this->load->view("pages/account/get_status", $data);
           }else{
               echo "Please select the student";
           }
//            if($this->ac->check_fee_status($student, $month)){
//                echo "paid";
//            }
 //Visit "codeastro.com" for more projects!       
     
 }
 
 public function operation($action){
      if(!$this->input->is_ajax_request()){
         show_404();
        }
        
       switch($action){
           case "add":
               
                  $data1 = array('success' => FALSE, 'msg' => array(), 'server_msg'=>False);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("fees", "Amount", "trim|required|is_numeric");
        //$this->form_validation->set_message('is_unique',"Already Exists!");
       // $this->input->post('');
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else {
           if($this->ac->monthly_payment($this->input->post('student'), $this->input->post('month'),$this->input->post('fees'))){
             $data1['success'] = TRUE;   
           }else{
             $data1['server_msg'] = "Somthing went wrong!";    
           }
             
          
        }
        echo json_encode($data1);
               break;
               
           case "unpay":
               if($this->ac->remove_monthly_payment($this->input->post('student'),$this->input->post('month'))){
                   echo "Successfully Removed!";
               }else{
                 echo "Student or month was not decleared!";  
               }
               break;
       }
        
 }
 //Visit "codeastro.com" for more projects!
 
 public function create_ac_type(){
     if(!$this->input->is_ajax_request()){
         show_404();
        }

        $data1 = array('success' => FALSE, 'msg' => array(), 'server_msg'=>False);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("name", "Account Type", "trim|required|max_length[20]|unique_ac_type");
        //$this->form_validation->set_message('is_unique',"Already Exists!");
       // $this->input->post('');
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else {
            
            if($this->ac->create_ac_type($this->input->post('name'))){
                $data1['success'] = TRUE;  
            }else{
                $data1['server_msg']  = "Sorry System Failed!";
            }
          
        }
        echo json_encode($data1);
 }

 public function update_ac_type(){
     if(!$this->input->is_ajax_request()){
         show_404();
        }

        $data1 = array('success' => FALSE, 'msg' => array(), 'server_msg'=>False);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("e_name", "Account Type", "trim|required|max_length[20]|is_unique[sms_account_type.name]");
        $this->form_validation->set_message('is_unique',"Already Exists!");
       // $this->input->post('');
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else {
            
            if($this->ac->update_ac_type($this->input->post('id'),$this->input->post('e_name'))){
                $data1['success'] = TRUE;  
            }else{
                $data1['server_msg']  = "Sorry System Failed!";
            }
          
        }
        echo json_encode($data1);
     
 }
  public function delete_ac_type(){
       if(!$this->input->is_ajax_request()){
         show_404();
        }

        $data1 = array('success' => FALSE, 'msg' => array(), 'server_msg'=>False);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("e_name", "Account Type", "trim|required");
       
       // $this->input->post('');
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else {
            if($this->input->post('e_name')!=1 AND $this->input->post('e_name')!=2 AND $this->input->post('e_name')!=3){
            if($this->ac->delete_ac_type($this->input->post('e_name'))){
                $data1['success'] = TRUE;  
            }else{
                $data1['server_msg']  = "Sorry System Failed!";
        }}else{
            $data['server_msg'] = "Can't Delete core Account type";
        }
          
        }
        echo json_encode($data1);
 }
 
 //Visit "codeastro.com" for more projects!
  public function list_type(){
    
     $data['account_type'] = $this->ac->list_type();
     
      $this->load->view("pages/account/list_type", $data);
 }
 
 public function list_fees(){
    
     $data['account_fees'] = $this->ac->list_fees($this->input->post('class_id'));
     
      $this->load->view("pages/account/list_fees", $data);
 }
 
 public function create_fees(){
     if(!$this->input->is_ajax_request()){
         show_404();
        }

        $data1 = array('success' => FALSE, 'msg' => array(), 'server_msg'=>FALSE);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("class_id", "Class", "select");
        $this->form_validation->set_rules("amount", "Amount", "required|is_numeric");
        $this->form_validation->set_rules("ac_type", "Account Type", "trim|required|select|unique_ac_fees");
        $this->form_validation->set_message('is_unique',"Account Already Exists!");
       // $this->input->post('');
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else {
            
            if($this->ac->create_fees($this->input->post('ac_type'),$this->input->post('class_id'),$this->input->post('amount'))){
                $data1['success'] = TRUE;  
            }else{
                $data1['server_msg']  = "Sorry System Failed!";
            }
          
        }
        echo json_encode($data1);
 //  $this->ac->add_account_type('Admission',1,2000);
  
 }
  public function update_ac_fees(){
 if(!$this->input->is_ajax_request()){
         show_404();
        }

        $data1 = array('success' => FALSE, 'msg' => array(), 'server_msg'=>False);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("e_amount", "Amount", "trim|required|max_length[20]|is_natural_no_zero");
        $this->form_validation->set_message('is_unique',"You do not make any change");
       // $this->input->post('');
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else {
            
            if($this->ac->update_ac_fees($this->input->post('id'),$this->input->post('e_amount'))){
                $data1['success'] = TRUE;  
            }else{
                $data1['server_msg']  = "Sorry System Failed!";
            }
          
        }
        echo json_encode($data1);
  
 }
 
  public function delete_ac_fees(){
if(!$this->input->is_ajax_request()){
         show_404();
        }

        $data1 = array('success' => FALSE, 'msg' => array(), 'server_msg'=>False);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules("e_amount", "Amount", "trim|required");
       
       // $this->input->post('');
        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else {
            
            if($this->ac->delete_ac_fees($this->input->post('e_amount'))){
                $data1['success'] = TRUE;  
            }else{
                $data1['server_msg']  = "Sorry System Failed!";
            }
          
        }
        echo json_encode($data1);
  
 }
 //Visit "codeastro.com" for more projects!
 
}