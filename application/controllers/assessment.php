<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class assessment extends CI_Controller {

    public $fpdf;

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('username')) {
            redirect('home');
        }
        require_once APPPATH . 'third_party/fpdf/fpdf.php';

        $this->fpdf = new FPDF();

        $CI = & get_instance();
    }

    public function loadCategory($assessment_category) {

        //if(!$this->session->userdata('category_id'))
        $this->session->set_userdata('category_id', $assessment_category);
        $cat_name = $this->assessments->getCategoryName($assessment_category);
        $data = array(
            "breadcrumb" => '<ol class="breadcrumb">
                                        <li><a href="#">Home</a></li>
                                        <li><a href="../../home/assessment">Assessments</a></li>
                                        <li><a href="../../home/categories/'.$this->session->userdata('assessment_id').'">Categories</a></li>
                                        <li class="active">'.$cat_name.'</li>
                                    </ol>',
            "images" => $this->config->item('images'),
            "assessment_css" => $this->config->item('assessment'),
            "title" => "Assessment",
            "js" => $this->config->item('js'),
            "fancybox" => $this->config->item('fancybox'),
            "assessment_category" => $assessment_category,
            "heading" => 'Roots',
            "fonts" => $this->config->item('fonts'),
            "page" => "category_view",
            "category" => $assessment_category
        );

        //$this->session->set_userdata('category_id')  = $assessment_category;
        $this->load->view('layout/main', $data);
    }

    public function Notes($id) {
        $data = array(
            "images" => $this->config->item('images'),
            "fonts" => $this->config->item('fonts'),
            "skill_id" => $id
        );
        $this->load->view("notes_holder", $data);
    }

    public function subskill($id) {
        $data = array(
            
            "images" => $this->config->item('images'),
            "fonts" => $this->config->item('fonts'),
            "assessment_css" => $this->config->item('assessment'),
            "title" => "Sub Skills",
            "js" => $this->config->item('js'),
            "fancybox" => $this->config->item('fancybox'),
            "subskill" => $id,
            "heading" => 'Subskill',
            'background' => $bg,
            "fonts" => $this->config->item('fonts'),
            "id" => $id
        );
        $this->load->view("subkills_holder", $data);
    }

    public function subskills($id, $bg) {
        $this->session->set_userdata('skill', $id);
        $root_name = $this->assessments->getDetails($id);
        $data = array(
             "breadcrumb" => '<ol class="breadcrumb">
                                        <li><a href="#">Home</a></li>
                                        <li><a href="../../home/assessment">Assessments</a></li>
                                        <li><a href="../../home/categories/'.$this->session->userdata('assessment_id').'">Categories</a></li>
                                        <li><a href="../../home/assessment">Skills</a></li>
                                        <li class="active">'.$root_name.'</li>
                                    </ol>',
            "images" => $this->config->item('images'),
            "assessment_css" => $this->config->item('assessment'),
            "title" => "Assessment",
            "js" => $this->config->item('js'),
            "fancybox" => $this->config->item('fancybox'),
            "subskill" => $id,
            "heading" => 'Subskill',
            'background' => $bg,
            "fonts" => $this->config->item('fonts'),
            "skill" => $id,
            "page" => "subskills"
        );
        $this->load->view("layout/main", $data);
    }

    public function categ_video($id, $type, $path) {

        $data = array(
            'type' => $type,
            'path' => $path,
            "images" => $this->config->item('images'),
            "fonts" => $this->config->item('fonts'),
            "id" => base64_decode($id)
        );
        $this->load->view("video_holder", $data);
    }

    public function categ_audio($id, $type, $path) {
        $data = array(
            'type' => $type,
            'path' => $path,
            "images" => $this->config->item('images'),
            "fonts" => $this->config->item('fonts'),
            "id" => $id);

        $this->load->view("audio_holder", $data);
    }

    public function report() {
        //Getting Username From Session Data
        ob_start();
        $session_data = $this->session->all_userdata();
        //$images =  $this->config->item('images');
        $username = $session_data['username'];
        $institution_id = $session_data['institution_id'];

        $userrecord = $this->user->getFullUserDetail($this->session->userdata('user_id'));
        foreach ($userrecord AS $user) {
            $data['userrecord'] = $user;
        }

        $username = $data['userrecord']->FIRST_NAME . " " . $data['userrecord']->SURNAME;
        $sex = $data['userrecord']->SEX;
        $colle = $data['userrecord']->Institution;
        $title = "Employabilitree Skills Assessment";
        $date = date("F, D d - Y");


        $this->fpdf->AliasNbPages();
        $this->fpdf->AddPage();
        $this->fpdf->Ln(8);
        // $this->fpdf->Image( $images . 'logo_inner.png', 10, 10, 20 ,20);
        $this->fpdf->Ln(10);
        $this->fpdf->SetFont('Arial', 'BU', 12);
        $this->fpdf->Cell(190, -25, 'EMTREE ASSESSMENTS REPORT', '0', 0, 'C');
        $this->fpdf->SetFont('Arial', 'BUI', 9);
        $this->fpdf->Cell(-30, -30, 'S/NO: ' . $session_data['secret'], '0', 0, 'C');
        //$this->fpdf->Ln(10);
        // $this->fpdf->SetFont('Arial', 'BU', 10);
        // $this->fpdf->Cell(20, 25, 'PART A', '0', 0, 'L');
        //$this->fpdf->Cell(170, 25, 'TO BE COMPLETED BY THE STAFF', '0', 0, 'L');
        $this->fpdf->Ln(2);
        $this->fpdf->SetFont('Arial', '', 7);
        $this->fpdf->Cell(64, -15, 'NAME:', '0', 0, 'R');
        $this->fpdf->Cell(10, -15, $username, '0', 0, 'L');
        $this->fpdf->Cell(61, -15, 'INSTITUTION:', '0', 0, 'R');
        $this->fpdf->Cell(10, -15, $colle, '0', 0, 'L');
        $this->fpdf->Ln(2);
        $this->fpdf->Cell(65, -12, 'SUBJECT: ', '0', 0, 'R');
        $this->fpdf->Cell(10, -12, $title, '0', 0, 'L');
        $this->fpdf->Cell(52, -12, 'DATE:', '0', 0, 'R');
        $this->fpdf->Cell(10, -12, $date, '0', 0, 'L');
        $this->fpdf->Ln(3);
        //$this->fpdf->Cell(1000, -10, "___", '0', 0, 'L');
        $this->fpdf->Line(10, 30, 210 - 10, 30);
        /*         * **********Load user assessments***** */



        $i = 1;
        $assessments = $this->assessments->loadAssessments()->result();
        //var_dump($assessments);die;
        foreach ($assessments As $ass):
            $headers_assesment = array(array("Assessment $i: " . $ass->assessment, 180));
            $data_a = array();
            $this->CreateTable($headers_assesment, $data_a, 0);
            $categories = $this->assessments->loadCategories($ass->id)->result();
            $data_c = array();
            if (empty($categories)) {
                $header = array(array("No records for  the Assessment", 180));
                $this->CreateTable($header, $data_c, 2);
            } else {
                foreach ($categories AS $cat) {
                    $headers = array(array("", 10), array("Category", 30), array("Skills", 20), array('Sub-skills', 30), array('Population % Score', 40), array('User % Score', 50));
                    $this->CreateTable($headers, array(), -1);

                    $header_categories = array(array("", 10), array($cat->CATEGORY_NAME, 80), array($this->question->getaverage($cat->CATEGORY_ID), 40), array($this->question->getPeraverage($cat->CATEGORY_ID), 50));
                    $this->CreateTable($header_categories, $data_c, 1);

                    $skills = $this->assessments->getAllCategoryData($cat->CATEGORY_ID);
                    $data_s = array();
                    foreach ($skills As $ski):
                        $header_skills = array(array("", 40), array($ski->skill_title, 50), array('-', 40), array('-', 50));
                        $this->CreateTable($header_skills, $data_s, 2);
                        $subskills = $this->assessments->getAllSubskillData($ski->id);
                        //var_dump($subskills);die;
                        foreach ($subskills As $s):
                            //var_dump($s->subskill);die;
                            $header_subskills = array(array("", 60), array($s->subskill, 30), array($this->question->getSubskillAverage($s->subID), 40), array($this->question->getScore($s->subID), 50));
                            $this->CreateTable($header_subskills, $data_s, 2);
                            //$subskills = $this->question->getSubSkills($sub->id);
                        endforeach;
                    endforeach;
                }


                $i++;
            }
        endforeach;

        $this->fpdf->Output($session_data['firstname'] . "_" . $session_data['surname']."_$session_data[secret]_.pdf", 'I');
        ob_end_flush();
    }

    public function CreateTable($header, $data, $hea = false) {
        // Header
        if ($hea == -1) {
            $this->fpdf->SetFillColor(160);
            $this->fpdf->SetTextColor(240);
            $this->fpdf->SetFont('', 'B');
            foreach ($header as $col) {
                //Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
                $this->fpdf->Cell($col[1], 4, $col[0], 1, 0, 'L', true);
            }
        }
        if ($hea == 0) {
            $this->fpdf->SetFillColor(0);
            $this->fpdf->SetTextColor(255);
            $this->fpdf->SetFont('', 'B');
            foreach ($header as $col) {
                //Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
                $this->fpdf->Cell($col[1], 4, $col[0], 1, 0, 'L', true);
            }
        } else if ($hea == 1) {
            $this->fpdf->SetFillColor(100);
            $this->fpdf->SetTextColor(230);
            $this->fpdf->SetFont('', '');
            foreach ($header as $col) {
                //Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
                $this->fpdf->Cell($col[1], 4, $col[0], 1, 0, 'L', true);
            }
        } else if ($hea == 2) {
            $this->fpdf->SetFillColor(255);
            $this->fpdf->SetTextColor(0);
            $this->fpdf->SetFont('', '');
            foreach ($header as $col) {
                //Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
                $this->fpdf->Cell($col[1], 4, $col[0], 1, 0, 'L', true);
            }
        }

        $this->fpdf->Ln();
        // Data
        $this->fpdf->SetFillColor(255);
        $this->fpdf->SetTextColor(0);
        $this->fpdf->SetFont('');
        foreach ($data as $row) {
            $i = 0;
            foreach ($row as $field) {
                $this->fpdf->Cell($header[$i][1], 2, $field, 1, 0, 'L', true);
                $i++;
            }
            $this->fpdf->Ln();
        }
    }
    
    

}
