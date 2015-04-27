<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    private $email_config;

    public function __construct() {
        parent::__construct();
        $this->load->library('parser');


        $this->email_config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.emtree.co.za',
            'smtp_port' => '25',
            'smtp_user' => 'no-reply@emtree.co.za',
            'smtp_pass' => '@Emtree2014*$',
            'smtp_timeout' => '30',
            'charset' => 'utf-8',
            'newline' => '\r\n',
            'mailtype' => 'html'
        );
    }

    public function ask() {
        if (!$this->session->userdata('username'))
            redirect($this->index());
        $data = array(
            "images" => $this->config->item('images'),
            "assessment_css" => $this->config->item('assessment'),
            "title" => "Ask",
            "js" => $this->config->item('js'),
            "fancybox" => $this->config->item('fancybox'),
            "fonts" => $this->config->item('fonts'),
            "css" => $this->config->item(''),
            "page" => "ask",
        );
        $this->load->view('layout/main', $data);
    }

    public function employabilitree() {

        $data = array(
            "images" => $this->config->item('images'),
            "assessment_css" => $this->config->item('assessment'),
            "title" => "Employabilitree",
            "js" => $this->config->item('js'),
            "fancybox" => $this->config->item('fancybox'),
            "fonts" => $this->config->item('fonts'),
            "page" => "employabilitytree",
        );
        $this->load->view('layout/main', $data);
    }

    public function index() {
        
            $data = array(
                "title" => 'Emtree360',
                "style" => $this->config->item('style'),
                "animate" => $this->config->item('animate'),
                "demo" => $this->config->item('demo'),
                "login" => $this->config->item('login')
            );
            $this->load->view('index', $data);
        
    }

    public function verifyUser() {
        $login = $this->aunthentication->processLogin($this->input->post('username'), $this->input->post('password'));

        if ($login === true) {
            $query = $this->aunthentication->getUserID($this->input->post('username'));

            foreach ($query as $row):
                $this->session->set_userdata('username', $row['SURNAME']);
                $this->session->set_userdata('firstname', $row['FIRST_NAME']);
                $this->session->set_userdata('surname', $row['SURNAME']);
                $this->session->set_userdata('user_id', $row['USER_ID']);
                $this->session->set_userdata('institution_id', $row['InstitutionID']);
                $this->session->set_userdata('secret', $row['ACCESS']);
            endforeach;
            //var_dump($this->session->userdata('username'));die;
            redirect('home/assessment');
        }
        elseif ($login == 'noemail') {
            $this->session->set_flashdata('login', 'Login failed! Email does not Exist');
            redirect('home', 'refresh');
        } elseif ($login == 'status') {
            $this->session->set_flashdata('login', 'Login failed! Your account has not been activated. Please contact admin at info@emtree.co.za');
            redirect('home', 'refresh');
        } elseif ($login == 'wrongpass') {
            $this->session->set_flashdata('login', 'Login failed! Wrong password');
            redirect('home', 'refresh');
        }
    }
    
    public function newpassword() {
        
            $data = array(
                "title" => 'Emtree360',
                "style" => $this->config->item('style'),
                
                "login" => $this->config->item('login')
            );
            $this->load->view('recover_password', $data);
        
    }

    public function recoverPassword() {

        if ($this->aunthentication->checkPassword($this->input->post('email'))) {
            $this->load->library('email', $this->email_config);
            $this->email->set_newline("\r\n");

            //Generates a random password of 8 character long
            $random_password = random_string('alnum', 10);

            $query = $this->aunthentication->getUserID($this->input->post('emailsignup'));

            foreach ($query as $row):
                $firstname = $row['FIRST_NAME'];
                $user_id = $row['USER_ID'];
            endforeach;

            $question = "Dear " . $firstname . ", <br /><br />
                        Thank you for contacting Emtree360 from Employabilitree Skills Assessment website<br /><br />
                        Your new password is: <b>" . $random_password . " </b><br />
                        Kindly, consider changing your password after the first login <br /><br />
                        From: Emtree360 Admin <info@emtree.co.za>";

            $this->email->from('no-reply@emtree.co.za', "Emtree360 Assessment");
            $this->email->to($this->input->post('emailsignup'));
            //$this->email->cc('');
            $this->email->subject("Emtree360 Account : Password recovery");
            $this->email->message($question);

            /*
             * If the email does exist
             */
            if ($this->aunthentication->updatePassword(md5($random_password), $user_id)) {
                /*
                 * If the email fails to be sent
                 */
                if (!$this->email->send()) {
                    echo $this->email->print_debugger();
                    //$this->session->set_flashdata('login', 'Sorry password could not be recovered! Try again!');
                    //redirect('home', 'refresh');
                }
                /*
                 * If all goes well then...
                 */ else {
                    $this->session->set_flashdata('login', 'Your password has been successfully reset! Please check your email');
                    redirect('home', 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata('login', 'Password recovery failed! Email provided does not exist!');
            redirect('home', 'refresh');
        }
    }

    public function Categories($id) {

        if (!$this->session->userdata('username'))
            redirect($this->index(), 'refresh');
        $name = $this->assessments->getAssessmentName($id)->assessment;
        $this->session->set_userdata('assessment_id', $id);
        $categories = $this->assessments->loadCategories($id);

        $data = array(
            "breadcrumb" => '<ol class="breadcrumb">
                                        <li><a href="#">Home</a></li>
                                        <li><a href="../assessment">Assessments</a></li>
                                        <li><a href="../../home/categories/'.$this->session->userdata('assessment_id').'">Categories</a></li>
                                        <li class="active">'.$name.'</li>
                                    </ol>',
            "images" => $this->config->item('images'),
            "assessment_css" => $this->config->item('assessment'),
            "title" => "List of Categories for $name Assessment",
            "js" => $this->config->item('js'),
            'fetch' => $categories->result(),
            'page' => 'assement',
        );

        $this->load->view('layout/main', $data);
    }
    
   

    public function Assessment() {
        if (!$this->session->userdata('username'))
            redirect($this->index());

        $categories = $this->assessments->loadAssessments();
        $data = array(
            "images" => $this->config->item('images'),
            "assessment_css" => $this->config->item('assessment'),
            "title" => "Welcome to Emtree360, Employabilitree Skill Assessment Portal",
            "js" => $this->config->item('js'),
            "fancybox" => $this->config->item('fancybox'),
            'fetch' => $categories->result(),
            'page' => 'landing'
        );
        //var_dump($_SESSION);
        $this->load->view('layout/main', $data);
    }

    public function logOut() {
        $this->session->sess_destroy(); // Destroy all active sessions
        redirect('home', 'refresh'); // Redirect the user to the login page
    }

    public function sendQuestion() {
        if (!$this->session->userdata('username'))
            redirect($this->index());

        $this->load->library('email', $this->email_config);
        $this->email->set_newline("\r\n");
        $names = $this->input->post('firstname') . ' ' . $this->input->post('lastname');

        $question = "Dear Emtree admin,  <br /><br />" . $this->input->post('question') . "  <br /><br /> From: $names";

        $this->email->from($this->input->post('email'), $names);
        $this->email->reply_to($this->input->post('email'), $names);
        $this->email->bcc($this->input->post('email'));
        $this->email->to('christopher.beukes@gmail.com');
        //$this->email->cc('info@emtree.co.za');
        $this->email->subject($this->input->post('questionCategory'));
        $this->email->message($question);
        if ($this->email->send()) {
            $this->session->set_flashdata('send_question', "<div class='alert alert-success'>Your question was successfully sent!<br /> We hope to reply sooner!'</div>");
            redirect('home/ask', 'refresh');
        } else {
            $this->session->set_flashdata('send_question', "<div class='alert alert-error'>Oops! failed sending question, kindly send again later!'</div>");
            redirect('home/ask', 'refresh');
        }
        //echo //$this->email->print_debugger();
    }

}
