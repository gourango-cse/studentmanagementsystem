<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
//Visit "codeastro.com" for more projects!
class Student_add extends CI_Controller {

    var $role = "Student";

    public function __construct() {
        parent::__construct();
        if (!$this->sms->is_loggedin()) {
            redirect("login");
        }
        $this->sms->control("Admin");


        $this->load->model('sms_class');
    }

    public function index() {


        $data['page_title'] = "Student Registration";
        $data['page_slogan'] = "SMS";
        $data['main_content'] = "pages/student/add";
        $data['list_class'] = $this->sms_class->list_class();
        //  $data['list_section'] = $this->sms_class->list_class();
        $this->load->view("layout/form", $data);
    }

    public function add() {

        $data1 = array('success' => FALSE, 'msg' => array(), 'server_msg' => NULL);


        $config['upload_path'] = './uploads/pro_pic/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '5024';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';


        $this->load->library('upload', $config);
        $email = $this->input->post('email');
        $password = random_string('alnum',8);
        $username = $this->input->post('username');
        $gender = $this->input->post('gender');
        $full_name = $this->input->post('full_name');
        $address = $this->input->post('address');
        $contact = $this->input->post('contact');
        $dob = $this->input->post('dob');
        $class = $this->input->post('class_id');
        $section = $this->input->post('section_id');
        $parent = $this->input->post('parent_id');
        $roll = $this->input->post('roll');
        $transport = $this->input->post('transport_id');
        $hostel = $this->input->post('hostel_id');
        $this->upload->initialize($config);


        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'full_name',
                'label' => 'Full Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required|is_unique[sms_users.name]'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|trim|valid_email|is_unique[sms_users.email]'
            ),
            array(
                'field' => 'address',
                'label' => 'Address',
                'rules' => 'required|trim'
            ),
            array(
                'field' => 'contact',
                'label' => 'Contact',
                'rules' => 'required|trim|min_length[9]|max_length[18]'
            ),
            array(
                'field' => 'dob',
                'label' => 'Date of Birth',
                'rules' => 'required|trim'
            ),
            array(
                'field' => 'class_id',
                'label' => 'Class',
                'rules' => 'callback_class_select'
            ),
            array(
                'field' => 'section_id',
                'label' => 'Section',
                'rules' => 'callback_section_select'
            ),
            array(
                'field' => 'parent_id',
                'label' => 'Parent',
                'rules' => 'callback_parent_select'
            ),
            array(
                'field' => 'roll',
                'label' => 'Roll Number',
                'rules' => 'required|is_natural|unique_roll_number'
            )
            
        );
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules($config);
        $this->form_validation->set_message('is_unique', 'Already exists!');

        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else {
            
            if (!$this->upload->do_upload('picture')) {

                $data1['server_msg'] = $this->upload->display_errors('<p class="text-danger">', '</p>');
            } else {


                $image = $this->upload->data();

                $user_id = $this->sms->create_user($email, $password, $username, $full_name, $gender, $this->role, $dob, $address, $contact, $image['file_name']);
                if ($user_id != NULL) {
                    $register = $this->student->register($user_id, $class, $section, $parent, $roll, $transport, $hostel, $this->sms->running_session()->id);
                 if($register==TRUE){
                      $data1['success'] = TRUE;
                    $data1['server_msg'] = 'Successfully Registered!';
                     
                     
                 
                     
                 }
                    
                   
                    //Visit "codeastro.com" for more projects!
                }else{
                     delete_files('./uploads/pro_pic/'.$image['file_name']);
                    $data1['success'] = FALSE;
                }

               
            }
        }
        echo json_encode($data1);
    }

  

    function class_select($val) {
        if ($val == 0) {
            $this->form_validation->set_message('class_select', 'Please select  the class!');
            return FALSE;
        } else {
            return true;
        }
    }

    function section_select($valu) {
        if ($valu == 0) {
            $this->form_validation->set_message('section_select', 'Please select the Section!');
            return FALSE;
        } else {
            return true;
        }
    }

    function parent_select($valu) {
        if ($valu == 0) {
            $this->form_validation->set_message('parent_select', 'Please select the Parent!');
            return FALSE;
        } else {
            return true;
        }
    }

}
//Visit "codeastro.com" for more projects!