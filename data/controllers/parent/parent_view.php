
<?php
/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
//Visit "codeastro.com" for more projects!

if (!defined('BASEPATH'))
    show_404();

class Parent_view extends CI_Controller {
    

    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        
        $data['page_title'] = "View Parent";
        $data['page_slogan'] = "SMS";
       $data['main_content']= "pages/parent/view";
       $data['list_parents']= $this->sms->list_users('Parent', $limit = FALSE, $offset = FALSE, $include_banneds = TRUE);
        $this->load->view("layout/data",$data );
    }
}