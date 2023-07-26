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
       if(!$this->sms->is_loggedin()){
            redirect("login");
        }
//            $this->load->model('study');
    }

    public function index() {
        
    }
    
    
}