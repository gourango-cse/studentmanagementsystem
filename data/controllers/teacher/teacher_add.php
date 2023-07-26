<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
//Visit "codeastro.com" for more projects!
class Teacher_add extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->sms->is_loggedin()) {
            redirect("login");
        }
        $this->sms->control('Admin');
    }

    public function index() {


        $data['page_title'] = "Teacher Registration";
        $data['page_slogan'] = "SMS";
        $data['main_content'] = "pages/teacher/add";
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
        $this->upload->initialize($config);
        $email = $this->input->post('email');
        $password = random_string('alnum', 8);
        $username = $this->input->post('username');
        $gender = $this->input->post('gender');
        $full_name = $this->input->post('full_name');
        $address = $this->input->post('address');
        $contact = $this->input->post('contact');
        $dob = $this->input->post('dob');
        $role = "Teacher";


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
                'rules' => 'required|trim|'
            ),
            array(
                'field' => 'contact',
                'label' => 'Contact',
                'rules' => 'required|trim|min_length[9]|max_length[18]'
            ),
            array(
                'field' => 'dob',
                'label' => 'Date of Birth',
                'rules' => 'required'
            ),
            array(
                'field' => 'gender',
                'label' => 'Gender',
                'rules' => 'callback_radio_button'
            )
        );
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules($config);
        $this->form_validation->set_message('is_unique', 'Not available!');

        if ($this->form_validation->run() == FALSE) {

            foreach ($_POST as $key => $value) {
                $data1['msg'][$key] = form_error($key);
            }
        } else {



            if (!$this->upload->do_upload('picture')) {

                $data1['server_msg'] = $this->upload->display_errors('<p class="text-danger">', '</p>');
            } else {
                $image = $this->upload->data();

                $register = $this->sms->create_user($email, $password, $username, $full_name, $gender, $role, $dob, $address, $contact, $image['file_name']);
                if ($register != NULL) {
                    $data1['success'] = TRUE;
                    $data1['server_msg'] = " Successfully Registered";
                } else {
                     delete_files('./uploads/pro_pic/'.$image['file_name']);
                    $data1['success'] = FALSE;
                    $data1['server_msg'] = $this->print_errors();
                    ;
                }
            }
        }
        echo json_encode($data1);
    }

    function radio_button($val) {
        if (!$val) {
            $this->form_validation->set_message('gender', 'Please select gender!');
            return FALSE;
        } else {
            return true;
        }
    }
    //Visit "codeastro.com" for more projects!
}
