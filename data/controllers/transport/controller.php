<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Visit "codeastro.com" for more projects!
class Controller extends CI_Controller{
    
    
    
public function __construct() {
        parent::__construct();
       if(!$this->sms->is_allowed('Admin')){
           show_404();
        }
//            $this->load->model('study');
    }

    
    
    
}