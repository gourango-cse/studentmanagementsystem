<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Debug extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // $this->load->model('sms_session');
    }

    public function index() {
        echo '<html><head><title>Debug | SMS</title><style type="text/css"> body{ background-color: #21272d;color: #bfb5b5;}.center{text-align: center;}
            .heading{color: #D9D9D9;}
            .box{padding-left: 9%;margin-top: 3%;width: 80%;background-color: #e6e6e6;height: 70%; margin-left: 5%; margin-right: 5%;padding-top: 2%;border: white;border-left-style: inset;color: black;z-index: -1111;overflow-y: scroll;}
            .footer{padding-top: 5%;margin-left: 5%;width: 50%;color: #777b7b;font-style: oblique;font-family: monospace;font-size: medium;font-weight: normal;position: fixed;}
             </style></head><body> <h2 class="center heading">School Management System Debugging Mode</h2><div class="box"><code>';
       
     //  $this->sms_class->update_class_teacher(37, 1);
    // print_r($this->student->list_student(FALSE, FALSE, 1, $roll = FALSE, $parent = FALSE, $transport = FALSE, $hostel = FALSE, $limit = FALSE, $offset = FALSE, $include_banneds = TRUE));
     //$student = $this->student->list_student($session = FALSE, $class = 1, $section = FALSE, $roll = FALSE, $parent = FALSE, $transport = FALSE, $hostel = FALSE, $limit = FALSE, $offset = FALSE, $include_banneds = TRUE);        
    // print_r($student); 
                 
      // $class= $this->sms_class->list_class();
       
//       foreach ($class as $value) {
//          $section =  $this->sms_class->list_section($value->id);
//          
//            echo "Class : ".$value->name."<br/>";
//            
//            foreach ($section as $v) {
//                echo "Has Section : ";
//                echo $v->name."|"; 
//            }
//          if($this->sms->get_user($value->teacher_id, "Teacher") !=FALSE){
//              echo "<br/>Class Teacher is: ". $this->sms->get_user($value->teacher_id, "Teacher")->full_name."<br>";
//          }
//       }
//    var_dump($this->sms_class->is_class_teacher(37));
        
        echo date('Y/n/d');
      // print_r($this->sms->list_users('Parent', $limit = FALSE, $offset = FALSE, $include_banneds = FALSE));
        
        // print_r( $this->sms->list_pms(30,0,0,1));

//var_export($this->student->list_student($session = TRUE, $class = FALSE, $section = FALSE, $roll = FALSE, $parent = FALSE, $transport = FALSE, $hostel = FALSE, $limit = FALSE, $offset = FALSE, $include_banneds = FALSE));
      // var_dump($this->sms->send_verification(31, NULL, "Whcxir0P"));
 
      echo '</code></div><i class="footer">Dubugging Mode | SMS | NBPI | APRS</i></html>';

        // $this->load->view('debug',$data);
        // var_dump($this->student->list_student($session = TRUE, $class = FALSE, $section = FALSE, $roll = FALSE, $parent = FALSE, $transport = FALSE, $hostel = FALSE, $limit = FALSE, $offset = FALSE, $include_banneds = FALSE));
        //  $register = $this->student->register(100, 1, 2, 1, 4, 1, 1);
    }

    function debug() {

        echo "<pre>";

        print_r(
                //$this->sms->is_admin()
                //$this->sms->get_user()
                //$this->sms->control_group("Mod")
                //$this->sms->control_perm(1)
                //$this->sms->list_groups()
                //$this->sms->list_users()
                //$this->sms->is_allowed(1)
                //$this->sms->is_admin()
                //$this->sms->create_perm("deneme",'defff')
                //$this->sms->update_perm(3,'dess','asd')
                //$this->sms->allow(1,1)
                //$this->sms->add_member(1,1)
                //$this->sms->deny(1,1)
                //$this->sms->mail()
                //$this->sms->create_user('seass@asds.com','asdasdsdsdasd','asd')
                //$this->sms->verify_user(11, 'MLUguBbXpd9Eeu5B')
                //$this->sms->remind_password('seass@asds.com')
                //$this->sms->reset_password(11,'0ghUM3oIC95p7uMa')
                //$this->sms->is_allowed(1)
                //$this->sms->control(1)
                //$this->sms->send_pm(1,2,'asd')
                //$this->session->flashdata('d')
                //$this->sms->add_member(1,1)
                //$this->sms->create_user('asd@asd.co','d')
                //$this->sms->send_pm(1,2,'asd','sad')
                //$this->sms->list_pms(1,0,3,1)
                //$this->sms->get_pm(6, false)
                //$this->sms->delete_pm(6)
                //$this->sms->set_as_read_pm(13)
                //$this->sms->create_group('aa')
                //$this->sms->create_perm('asdda')
                //''
        );

        echo '<br>---- error --- <br>';
        echo $this->sms->get_errors();

        echo '<br>---- info --- <br>';
        echo $this->sms->get_infos();

        echo "</pre>";
    }

    function flash() {
        $d['a'] = 'asd';
        $d['3'] = 'asdasd';

        $this->session->set_flashdata('d', $d);

        $d['4'] = 'tttt';

        $this->session->set_flashdata('d', $d);
    }

    function settings() {

        //echo $this->sms->_get_login_attempts(4);
        //echo $this->sms->get_user_id('emre@emreakay.com');
        //$this->sms->_increase_login_attempts('emre@emreakay.com');
        //$this->sms->_reset_login_attempts(1);
    }

    public function login_fast() {
        $this->sms->login_fast(1);
    }

    public function is_loggedin() {

        if ($this->sms->is_loggedin())
            echo 'girdin';

        print_r($this->sms->get_user());
    }

    public function logout() {

        $this->sms->logout();
    }

    public function is_member() {

        if ($this->sms->is_member('deneme', 9))
            echo 'uye';
    }

    public function is_admin() {

        if ($this->sms->is_member('Admin'))
            echo 'adminovic';
    }

    function get_user_groups() {
        //print_r( $this->sms->get_user_groups());

        foreach ($this->sms->get_user_groups() as $a) {

            echo $a->id . " " . $a->name . "<br>";
        }
    }

    public function get_group_name() {

        echo $this->sms->get_group_name(1);
    }

    public function get_group_id() {

        echo $this->sms->get_group_id("Admin");
    }

    public function list_users() {
        echo '<pre>';
        print_r($this->sms->list_users());
        echo '</pre>';
    }

    public function list_groups() {
        echo '<pre>';
        print_r($this->sms->list_groups());
        echo '</pre>';
    }

    public function check_email() {

        if ($this->sms->check_email("aa@a.com"))
            echo 'uygun ';
        else
            echo 'alindi ';

        $this->sms->print_errors();
    }

    public function get_user() {
        print_r($this->sms->get_user());
    }

    function create_user() {

        $a = $this->sms->create_user("admin@admin.com", "12345", "Admin");

        if ($a)
            echo "tmm   ";
        else
            echo "hyr  ";


        print_r($this->sms->get_user($a));

        $this->sms->print_errors();
    }

    public function is_banned() {
        print_r($this->sms->is_banned(6));
    }

    function ban_user() {

        $a = $this->sms->ban_user(6);

        print_r($a);
    }

    function delete_user() {

        $a = $this->sms->delete_user(7);

        print_r($a);
    }

    function unban_user() {

        $a = $this->sms->unban_user(6);

        print_r($a);
    }

    function update_user() {
        $a = $this->sms->update_user(6, "a@a.com", "12345", "tested");

        print_r($a);
    }

    function update_activity() {
        $a = $this->sms->update_activity();

        print_r($a);
    }

    function update_login_attempt() {
        $a = $this->sms->update_login_attempts("a@a.com");

        print_r($a);
    }

    function create_group() {

        $a = $this->sms->create_group("deneme");
    }

    function delete_group() {

        $a = $this->sms->delete_group("deneme");
    }

    function update_group() {

        $a = $this->sms->update_group("deneme", "zxxx");
    }

    function add_member() {

        $a = $this->sms->add_member(8, "deneme");
    }

    function fire_member() {

        $a = $this->sms->fire_member(8, "deneme");
    }

    function create_perm() {

        $a = $this->sms->create_perm("deneme", "def");
    }

    function update_perm() {

        $a = $this->sms->update_perm("deneme", "deneme", "xxx");
    }

    function delete_perm() {

        $a = $this->sms->update_perm("deneme", "deneme", "xxx");
    }

    function allow_user() {

        $a = $this->sms->allow_user(9, "deneme");
    }

    function deny_user() {

        $a = $this->sms->deny_user(9, "deneme");
    }

    function allow_group() {

        $a = $this->sms->allow_group("deneme", "deneme");
    }

    function deny_group() {

        $a = $this->sms->deny_group("deneme", "deneme");
    }

    function list_perms() {

        $a = $this->sms->list_perms();
        print_r($a);
    }

    function get_perm_id() {

        $a = $this->sms->get_perm_id("deneme");
        print_r($a);
    }

    function send_pm() {

        $a = $this->sms->send_pm(1, 8, 's', "w");
        $this->sms->print_errors();
    }

    function list_pms() {

        print_r($this->sms->list_pms());
    }

    function get_pm() {

        print_r($this->sms->get_pm(39, false));
    }

    function delete_pm() {

        $this->sms->delete_pm(41);
    }

    function count_unread_pms() {

        echo $this->sms->count_unread_pms(8);
    }

    function error() {

        $this->sms->error("asd");
        $this->sms->error("xasd");
        $this->sms->keep_errors();
        $this->sms->print_errors();
    }

    function keep_errors() {

        $this->sms->print_errors();
        //$this->sms->keep_errors();
    }

    function set_user_var() {
        $this->sms->set_user_var("emre", "akasy");
    }

    function unset_user_var() {
        $this->sms->unset_user_var("emre");
    }

    function get_user_var() {
        echo $this->sms->get_user_var("emre");
    }

    function set_system_var() {
        $this->sms->set_system_var("emre", "akay");
    }

    function unset_system_var() {
        $this->sms->unset_system_var("emre");
    }

    function get_system_var() {
        echo $this->sms->get_system_var("emre");
    }

}

//end

/* End of file debug.php */
