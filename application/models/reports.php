<?php

class Reports extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Assessment
   
    public function getAssessmentReports($field) {

        $insti = explode( ',' ,$this->loadAss() );
        
        return $this->db->select($field . " As label")
                        ->where_in('id', $insti)
                        ->order_by('disp_order', 'ASC')
                        ->get('assessments');
    }
   
    public function personalAssData()
    {
        $assesements  = $this->getAssessmentReports('id')->result();
        $dat = array();
        foreach($assesements As $data):
           $avg = $this->db->select("AVG(R.SCORE) AS value")
                ->where("A.id" , $data->label)
                ->where('R.USER_ID', $this->session->userdata('user_id'))
                ->join('skills S' , "S.id = R.SKILL_ID")
                ->join('category C' , "C.CATEGORY_ID = S.category_id")
                ->join('assessments A' , "A.id = C.ASSESSMENT_ID")
                ->get('scores R')->row();
        $num = $avg == "NULL" ? 0: $avg;
        array_push($dat , $num);
        endforeach;
        return $dat;
    }
    public function populationAssData()
    {
        $assesements  = $this->getAssessmentReports('id')->result();
        $dat = array();
        foreach($assesements As $data):
           $avg = $this->db->select("AVG(R.SCORE) AS value")
                ->where("A.id" , $data->label)
               // ->where('R.USER_ID', $this->session->userdata('user_id'))
                ->join('skills S' , "S.id = R.SKILL_ID")
                ->join('category C' , "C.CATEGORY_ID = S.category_id")
                ->join('assessments A' , "A.id = C.ASSESSMENT_ID")
                ->get('scores R')->row();
        $num = $avg == "NULL" ? 0: $avg;
        array_push($dat , $num);
        endforeach;
        return $dat;
    }

    private function loadAss() {
        //session_start();
        $id = $this->session->userdata('institution_id');
        //return $query = $this->db->query("SELECT assessment_id FROM institutions WHER id = $id");
        $query = $this->db->select('assessment_id')
                        ->where('InstitutionID', $id)
                        ->get('institutions')->result_array();
        if (@$query[0]['assessment_id'] === "")
            return "2000";
        return @$query[0]['assessment_id'];
    }
    
    // Category
    
     public function getCategoriesReports($field) {

        $insti = explode( ',' ,$this->loadAss() );
        
        return $this->db->select($field . " As label")
                        ->where_in('A.id', $insti)
                        ->join('assessments A' ,"A.id = C.ASSESSMENT_ID")
                        ->order_by('CATEGORY_NAME', 'ASC')
                        ->get('category C');
    }
    
    public function personalCatData()
    {
        $categories  = $this->getCategoriesReports('CATEGORY_ID')->result();
        //var_dump($categories);die;
        $dat = array();
        foreach($categories As $data):
           $avg = $this->db->select("AVG(R.SCORE) AS value")
                ->where("C.CATEGORY_ID" , $data->label)
                ->where('R.USER_ID', $this->session->userdata('user_id'))
                ->join('skills S' , "S.id = R.SKILL_ID")
                ->join('category C' , "C.CATEGORY_ID = S.category_id")
                //->join('assessments A' , "A.id = C.ASSESSMENT_ID")
                ->get('scores R')->row();
        $num = $avg == "NULL" ? 0: $avg;
        array_push($dat , $num);
        endforeach;
        return $dat;
    }
    public function populationCatData()
    {
        $categories  = $this->getCategoriesReports('CATEGORY_ID')->result();
        //var_dump($categories);die;
        $dat = array();
        foreach($categories As $data):
           $avg = $this->db->select("AVG(R.SCORE) AS value")
                ->where("C.CATEGORY_ID" , $data->label)
                //->where('R.USER_ID', $this->session->userdata('user_id'))
                ->join('skills S' , "S.id = R.SKILL_ID")
                ->join('category C' , "C.CATEGORY_ID = S.category_id")
                //->join('assessments A' , "A.id = C.ASSESSMENT_ID")
                ->get('scores R')->row();
        $num = $avg == "NULL" ? 0: $avg;
        array_push($dat , $num);
        endforeach;
        return $dat;
    }
    
    // Skills
    
     public function getSkillsReports($field) {

        $insti = explode( ',' ,$this->loadAss() );
        
        return $this->db->select($field . " As label")
                        ->where_in('A.id', $insti)
                        ->join('category C' ,"C.CATEGORY_ID = S.category_id")
                        ->join('assessments A' ,"A.id = C.ASSESSMENT_ID")
                        ->order_by($field, 'ASC')
                        ->get('skills S');
    }
    
    public function personalSkillsData()
    {
        $skills  = $this->getSkillsReports('S.id')->result();
        //var_dump($categories);die;
        $dat = array();
        foreach($skills As $data):
           $avg = $this->db->select("AVG(R.SCORE) AS value")
                ->where("S.id" , $data->label)
                ->where('R.USER_ID', $this->session->userdata('user_id'))
                ->join('skills S' , "S.id = R.SKILL_ID")
                ->join('category C' , "C.CATEGORY_ID = S.category_id")
                ->get('scores R')->row();
        $num = $avg == "NULL" ? 0: $avg;
        array_push($dat , $num);
        endforeach;
        return $dat;
    }
    public function populationSkillsData()
    {
        $skills  = $this->getSkillsReports('S.id')->result();
        //var_dump($categories);die;
        $dat = array();
        foreach($skills As $data):
           $avg = $this->db->select("AVG(R.SCORE) AS value")
                ->where("S.id" , $data->label)
                ->join('skills S' , "S.id = R.SKILL_ID")
                ->join('category C' , "C.CATEGORY_ID = S.category_id")
                ->get('scores R')->row();
        $num = $avg == "NULL" ? 0: $avg;
        array_push($dat , $num);
        endforeach;
        return $dat;
    }
    

}

?>
