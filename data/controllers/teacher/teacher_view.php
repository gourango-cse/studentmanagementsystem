
<?php
/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
//Visit "codeastro.com" for more projects!

if (!defined('BASEPATH'))
    show_404();

class Teacher_view extends CI_Controller {
    

    public function __construct() {
        parent::__construct();
         if (!$this->sms->is_loggedin()) {
            redirect("login");
        }
    }
    
    public function index(){
        
        $data['page_title'] = "View Teacher";
        $data['page_slogan'] = "SMS";
       $data['main_content']= "pages/teacher/view";
       $data['list_teachers']= $this->sms->list_users('Teacher', $limit = FALSE, $offset = FALSE, $include_banneds = FALSE);
        $this->load->view("layout/data",$data );
    }
}