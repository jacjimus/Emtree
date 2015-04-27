<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
    }

    public function createAccount() {
        $this->load->library('user_agent');
            $num1 = random_string('numeric', 1);
            $num2 = random_string('numeric', 1);
            $sum = $num1 + $num2;
            $this->session->set_userdata("sum" , $sum);
        $data = array(
            "images" => $this->config->item('images'),
            "assessment_css" => $this->config->item('assessment'),
            "title" => "Create Account",
            "js" => $this->config->item('js'),
            "fancybox" => $this->config->item('fancybox'),
            "fonts" => $this->config->item('fonts'),
            "num1" => $num1,
            "num2" => $num2,
            "sum" => $sum,
        );
        $this->load->view('register', $data);
    }

    public function add() {

        if($this->input->post('sum_confirmation') == @$this->session->userdata('sum')){
            if($this->user->accessCode($this->input->post('access')))
            {      
            $this->form_validation->set_rules('firstname', 'First name', 'required');
            $this->form_validation->set_rules('access', 'Access Code', 'required');
            $this->form_validation->set_rules('sex', 'Sex', 'required');
            $this->form_validation->set_rules('race', 'Race', 'required');
            $this->form_validation->set_rules('lastname', 'Last name', 'required');
            $this->form_validation->set_rules('institution', 'Institution', 'required');
            $this->form_validation->set_rules('treechoice', 'Favourite tree', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('confirm_password', 'Confirm password', 'required|matches[password]');
            $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|is_unique[users_tb.EMAIL]');

            if ($this->form_validation->run() == TRUE) {
                if ($this->user->createAccount($this->input->post('firstname'),
                        $this->input->post('access'),
                        $this->input->post('lastname'),
                        $this->input->post('email'), 
                        $this->input->post('password'),
                        $this->input->post('sex'), 
                        $this->input->post('race'),
                        $this->input->post('institution'),
                        $this->input->post('treechoice')
                        )) {
                    $this->session->set_flashdata("success", "<div class='alert alert-block alert-success'>Registration Successful! Account has been verified and activated!</div>");
                     redirect('users/createaccount','refresh');
                } else {
                    $this->session->set_flashdata("signup", "<div class='alert alert-block alert-danger'>Failed creating an account. Please try later</div>");
                    redirect('users/createaccount', 'refresh');
                }
            } else {
                $this->createAccount();
            }
            }
            else
            {
                $this->session->set_flashdata("signup", "<div class='alert alert-block alert-danger'>You have specified a wrong ACCESS CODE. Confirm again from your book or Contact admin - info@emtree.co.za </div>");
            redirect('users/createaccount', 'refresh');
            }
        }else{
            $this->session->set_flashdata("signup", "<div class='alert alert-block alert-danger'>Sorry you failed the human confirmation test</div>");
            redirect('users/createaccount', 'refresh');
        }
    }

}