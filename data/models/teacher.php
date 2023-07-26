<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
//Visit "codeastro.com" for more projects!

class Teacher extends CI_Model{
    
    var $config_vars;
    
    public function __construct() {
        parent::__construct();
      
        $this->config_vars= $this->config->item('sms');
    }
    
    public function count($male=FALSE, $female= FALSE) {
        if( $male!=FALSE){
			$query = $this->db->where('gender', $male);
		} 
                if($female!=FALSE)
                    {
			$query = $this->db->where('gender', $female);
		}
                $query = $this->db->where('role', 'Teacher');
		$query = $this->db->count_all_results($this->config_vars['users']);
                    
		return $query;
        
    }
   
}