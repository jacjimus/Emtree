<?php

class Assessments extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /*
      public function checkRoot($category_id){
      $this->db->get_where('scores', array("USER_ID" => $_SESSION['user_id'], "CATEGORY_ID" => $category_id));
      if($this->db->affected_rows() > 0) return TRUE; else return FALSE;
      }
     */

    public function getLevelsPerCategory($categoryID) {
        $query = $this->db
                ->where('category_id', $categoryID)
                ->get('skills');
        return $query->result();
    }

    public function loadCategories($id = null) {
        return $query = $this->db->query('SELECT * FROM category WHERE ASSESSMENT_ID = ' . $id . ' ORDER BY DISP_ORDER ASC');
    }
   public function getAssessmentName($id)
   {
       return $this->db->select('assessment')->where('id' , $id)->get('assessments')->row();
   }
    public function loadAssessments() {

        $insti = explode( ',' ,$this->loadAss() );
        
        return $this->db->where_in('id', $insti)
                        ->order_by('disp_order', 'ASC')
                        ->get('assessments');
    }
    public function getAssessmentReports() {

        $insti = explode( ',' ,$this->loadAss() );
        
        return $this->db->select("assessment As label")
                        ->where_in('id', $insti)
                        ->order_by('disp_order', 'ASC')
                        ->get('assessments');
    }

    public function getAssessments() {

        $insti = $this->loadAss();
        return $this->db->where_in('A.id', "$insti")
                        ->join('category C', 'A.id = C.ASSESSMENT_ID ')
                        ->join('subskills B', 'C.CATEGORY_ID = B.categoryID')
                        ->join('subscoregs O', 'B.subID = O.subskillID')
                        ->order_by('A.disp_order', 'ASC')
                        ->get('assessments A ');
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

    function checkSubSkill($skillID) {
        return $this->db->get_where('subskills', array('skillID' => $skillID))->result_array();
    }

    public function getAllCategoryData($category_id) {
        $query = $this->db->select('*')
                ->from('skills')
                ->where('category_id', $category_id)
                ->group_by('skill_title', 'asc')
                ->get();
        return $query->result();
    }

    public function getAllSubskillData($id) {
        $query = $this->db->select('*')
                        ->from('subskills')
                        ->where('skillID', $id)->get();
        return $query->result();
    }

    public function getCategoryName($category_id) {
        $query = $this->db->where('CATEGORY_ID', $category_id)->get('category');
        foreach ($query->result() as $row) {
            return $row->CATEGORY_NAME;
        }
    }

    public function getCategoryBackground($category_id) {
        $query = $this->db->where('CATEGORY_ID', $category_id)->get('category');
        return $query->result();
    }

    public function getMedia($id, $type, $path) {
        if ($type == 'category')
            $field = 'CATEGORY_ID';
        elseif ($type == 'skills')
            $field = 'id';
        else
            $field = 'subID';

        $query = $this->db->select($path)->where($field, $id)->get($type)->result();
        if ($query)
            return $query;
        else
            return '';
    }

    public function getSkillDetails($id) {
        $query = $this->db->where('subID', $id)->get('subskills');
        return $query->result();
    }

    public function percentageScore($subid) {
        $quer = $this->db->query("SELECT AVG(score) as av FROM scores WHERE SUBSKILL_ID  = '$subid'")->result_array();

        if ($quer) {
            foreach ($quer as $q) {
                $avg = round($q['av'], 2);
            }
        } else
            $avg = 0;
        return $avg;
    }

    public function getDetails($id) {
        $query = $this->db->where('id', $id)->get('skills');
        foreach ($query->result_array() as $r)
            return $r['skill_title'];
    }

    public function getSubSkillDetails($id) {
        $query = $this->db->where('subID', $id)->get('subskills');
        return $query->result();
    }

    //Compare level count
    public function checkroot($category_id) {

        $status = true;
        $query1 = $this->db->select('id')
                        ->where('category_id', $category_id)
                        ->get('skills')->result_array();



        // Loop through all skills of that category to see if they have ben done

        foreach ($query1 As $s) {
            $scores = $this->db->select('SKILL_ID')
                            ->where('USER_ID', $this->session->userdata('user_id'))
                            ->where('SKILL_ID', $s['id'])
                            ->get('scores')->num_rows();

            if ($scores < 1)
                $status = false;
        }
        return $status;
    }

    public function skillHasSubs($skill_id) {
        $user = $this->session->userdata('user_id');
        //echo $skill_id;
        $subs = $this->db->query("SELECT skillID  FROM subskills WHERE skillID = '$skill_id'")->num_rows();
        if ($subs > 0) 
            return true;
            return false;  
    }

    public function checkSkills($skill_id) {
        $user = $this->session->userdata('user_id');
        //echo $skill_id;
        $subs = $this->db->query("SELECT *  FROM subskills WHERE skillID = '$skill_id'")->num_rows();


        $skills = $this->db->query("SELECT *  FROM scores WHERE USER_ID = '$user' AND SKILL_ID = '$skill_id' GROUP BY SUBSKILL_ID")->num_rows();


        if ($subs > $skills) 
            return true;
            return false;        
    }

    public function checkSubSkills($id) {
        $user = $this->session->userdata('user_id');
        $this->db->query("SELECT * FROM scores WHERE SUBSKILL_ID = '$id' AND user_id = '$user'");
        // @$this->db->where_in('SKILL_ID', $skill_id)->where('USER_ID', $_SESSION['user_id'])->get('scores');
        if ($this->db->affected_rows() > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}

?>
