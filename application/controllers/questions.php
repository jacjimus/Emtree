<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Questions extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('home');
        }
    }

    public function index($skill_id) {
        $skill_name = $this->assessments->getDetails($id);
        $data = array(
            "title" => "Test",
             "breadcrumb" => '<ol class="breadcrumb">
                                        <li><a href="#">Home</a></li>
                                        <li><a href="../../home/assessment">Assessments</a></li>
                                        <li><a href="../../home/categories/'.$this->session->userdata('assessment_id').'">Categories</a></li>
                                        <li><a href="../../home/assessment">Skills</a></li>
                                        <li class="active">'.$skill_name.'</li>
                                    </ol>',
            "skill_id" => $skill_id,
            "images" => $this->config->item('images'),
            "assessment_css" => $this->config->item('assessment'),
            "js" => $this->config->item('js'),
            "fancybox" => $this->config->item('fancybox'),
            "page" => "test"
        );
        $this->load->view('layout/main', $data);
    }

    public function subskills($id) {
         $skill_name = $this->assessments->getSubSkillDetails($id)->subskill;
        $data = array(
             "breadcrumb" => '<ol class="breadcrumb">
                                        <li><a href="#">Home</a></li>
                                        <li><a href="../../home/assessment">Assessments</a></li>
                                        <li><a href="../../home/categories/'.$this->session->userdata('assessment_id').'">Categories</a></li>
                                        <li><a href="../../home/assessment">Skills</a></li>
                                        <li class="active">'.$skill_name.'</li>
                                    </ol>',
            "title" => "Test",
            "id" => $id,
            "images" => $this->config->item('images'),
            "assessment_css" => $this->config->item('assessment'),
            "js" => $this->config->item('js'),
            "fancybox" => $this->config->item('fancybox'),
            "page" => "subtest"
            
        );
        $this->load->view('layout/main', $data);
    }

    public function processQuestions($subID) {


        $qns = $this->input->post('qns');
        $max = $this->question->getQuestionMax();
        $total = 0;
        // $qns = $_POST['qns'];
        for ($i = 0; $i <= $max; $i++) {
            if (isset($_POST["quest_$i"])) {
                $total += $_POST["quest_$i"];
            }
        }


        $percentage_score = ($total / $qns) * 10.0;

        $view_data = array(
            "total_questions_asked" => $qns,
            "total_score" => $total,
            "percentage_score" => round($percentage_score, 0),
            "title" => "Score sheet",
            "dashboard_css" => $this->config->item('dashboard'),
            "images" => $this->config->item('images'),
            "css" => $this->config->item('css'),
            "js" => $this->config->item('js'),
            "username" => $this->session->userdata('username'),
            'subid' => $subID,
            'skill' => $this->session->userdata('skill'),
            'page' => "score_sheet"
        );


        $data = array(
            'USER_ID' => $this->session->userdata('user_id'),
            'DATE' => date('Y-m-d'),
            'SCORE' => round($percentage_score, 0),
            'CATEGORY_ID' => $this->session->userdata('catergory_id'),
            'SUBSKILL_ID' => $subID,
            'SKILL_ID' => $this->session->userdata('skill'),
            
        );

        //if(!$this->question->categoryDone()){
        $this->question->saveScores($data);
        //}

        $this->load->view('layout/main', $view_data);
    }

}
