<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
          if( !$this->session->userdata('username') )
              redirect ('home');
    }

    public function index() {
        $img = date('Y');
         $image_year = $this->config->item('images')."bg/$img.png";
                         
          
        $data = array(
            "title" => "Dashboard:: Summary Reports" ,
            "dashboard_css" => $this->config->item('dashboard'),
            "images" => $this->config->item('images'),
            "css" => $this->config->item('css'),
            "js" => $this->config->item('js'),
            "username" => $this->session->userdata('username'),
            'image_year'=>$image_year,
            "fancybox" => $this->config->item('fancybox'),
            "page" => "dashboard",
        );
        
        $this->load->view('layout/main', $data);
    }
    public function changepassword()
    {
        
        
         $this->load->view('password');
    }
    public function confirm($userid)
            {
            
            $oldpwd = md5($this->input->post('oldpass'));
            $this->form_validation->set_rules('oldpass', 'Old Password', 'required');
            $this->form_validation->set_rules('newpass', 'New Password', 'required');
            $this->form_validation->set_rules('confpass', 'Confirm password', 'required|matches[newpass]');
            //$this->form_validation->set_rules($oldpwd, 'Old password', 'required|matches[users_tb.PASSWORD]');
            if ($this->form_validation->run() == TRUE) {
                if($this->user->compareoldpwd($oldpwd,$userid) == TRUE)
                {
            $this->user->changepwd($this->input->post('newpass'),$userid);
            redirect('dashboard/index');
                }
                else
                {
                    $this->session->set_flashdata("passerror", "You have entered wrong old password");
                    redirect('dashboard/index');
                }
                    
            }
            else
                {
                    
                    redirect('dashboard/index');
                }
        }
        
        
}