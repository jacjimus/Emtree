<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login extends CI_Controller{
    
    
    public function __contruct(){
        parent::__construct();
        if(!$this->session->userdata('username')){
            redirect('home');
        }
    }
    
    
    public function index(){
        $this->load->view('login');
    }
    
    
}


