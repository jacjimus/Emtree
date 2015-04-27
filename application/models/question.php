<?php

class Question extends CI_Model{
    
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function getQuestions($category){
        $query = $this->db->where('SKILL_ID', $category)->get('questions');
        return $query->result();
    }
    public function remaining($id){
        $query = $this->db->select("count(B.skillID) As num ")
                ->where('A.id', $id)
                ->join('category C' , "C.CATEGORY_ID = B.categoryID")
                ->join('assessments A' , "A.id = C.ASSESSMENT_ID")
                ->get('subskills B');
        $total =  $query->row();
        
         $done = $this->db->select("count(R.ID) As num")
                ->where('A.id', $id)
                ->where('R.USER_ID', $this->session->userdata('user_id'))
                ->join('skills S' , "S.id = R.SKILL_ID")
                ->join('category C' , "C.CATEGORY_ID = S.category_id")
                //->join('users')
                ->join('assessments A' , "A.id = C.ASSESSMENT_ID")
                //->group_by("B.skillID")
                ->get('scores R')->row();
        
        //$bal = $total->num - $done->num();
        
        return ($done->num / $total->num) * 100 ;
    }
    public function getSubQuestions($subskill){
        $query = $this->db->where('SUBSKILL_ID', $subskill)->get('subquestions');
        return $query->result();
    }
    
    
    public function getQuestionMax(){
        $result = $this->db->query("SELECT MAX(QUESTION_ID) AS returnVal FROM subquestions")->row_array();
        return $result['returnVal'];
    }
    
    
    public function getAnswers($question_id){
        $query = $this->db->get_where('answers', array('QUESTION_ID'=>$question_id));
        return $query->result();
    }
    
    
    public function getQuestionThreshold(){
        $query = $this->db->select_max('QUESTION_ID')->get('questions');
        foreach($query->result() as $row){
            return $row->QUESTION_ID;
        }
    }
    public function getUserMatrix($skill_id)
    {
          $this->db->group_by('SKILL_ID');
         // $this->db->order_by('SKILL_ID','asc');
        $query = $this->db->get_where('scores', array("USER_ID" => $this->session->userdata('user_id'),'SKILL_ID'=>$skill_id));
       // if($this->db->affected_rows() > 0)
        return $query;
        
    }

        public function getScoresByUserId($id){
        $query = $this->db->query("SELECT DISTINCT S.category_id, C.category_name,S.DATE ,C.disp_order FROM scores S RIGHT JOIN category C ON S.category_id = C.category_id  RIGHT JOIN assessments A ON C.ASSESSMENT_ID = A.id WHERE A.id = $id GROUP BY C.category_name ORDER BY C.disp_order asc ") ;               
        //"SELECT DISTINCT category.CATEGORY_ID, category.CATEGORY_NAME, scores.DATE FROM scores, category WHERE USER_ID = '$_SESSION[user_id]' AND category.CATEGORY_ID = scores.CATEGORY_ID"
        return $query->result();
    }
    public function getSubskillAverage($id)
    {
        $avg = $this->db->query("SELECT avg(SCORE) as avg FROM scores WHERE SUBSKILL_ID = '$id' AND SCORE != 0")->result_array();
    
        foreach($avg as $a)
        
          return  $av = round($a['avg'],2).' %';
        
    }
    public function getaverage($id)
    {
        $query = $this->db->query("SELECT AVG(SCORE) as avg FROM scores WHERE CATEGORY_ID = '$id' AND SCORE != 0")->result_array();
        if($query)
        {
        foreach ($query as $q)
            return round($q['avg'],2).' %';
        }
        else
            return 0 .' %';
            
    }
    public function getPeraverage($id)
    {
        $user = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT AVG(SCORE) as avg FROM scores WHERE CATEGORY_ID = '$id' AND USER_ID = '$user' AND SCORE != 0")->result_array();
        if($query)
        {
        foreach ($query as $q)
            return round($q['avg'],2);
        }
        else
            return 0 .' %';
            
    }
public function getAverageScore()
    {
    $user = $this->session->userdata('user_id');
        $avg = $this->db->query("SELECT  avg(SCORE) as avg FROM scores WHERE USER_ID = '$user'")->result_array();
    
        foreach($avg as $a)
        
          return  $av = round($a['avg'],2).' %';
     
    }
    public function getPopulationAverageScore()
    {
    //$user = $_SESSION['user_id'];
        $avg = $this->db->query("SELECT  avg(SCORE) as avg FROM scores")->result_array();
    
        foreach($avg as $a)
        
          return  $av = round($a['avg'],2).' %';
     
    }
    public function showAverage($cat)
    {
        $id = $this->session->userdata('user_id');
       $query =  $this->db->select('avg(score) as avr')
                ->where('S.USER_ID',$id)
                ->where('S.CATEGORY_ID',$cat)
                ->join('users_tb U','S.USER_ID = U.USER_ID')
                ->join('institutions I','U.InstitutionID = I.InstitutionID')
                ->get('scores S')
                ->result_array();
       // Group Average
        
       $query_avg =  $this->db->select('avg(score) as avr')
                ->where('CATEGORY_ID',$cat)
               ->get('scores ')
                ->result_array();
       if(empty($query))
       {
       $own = 'Not Attempted';
       $grp = '0%';
       }
       else {
      foreach ($query as $v){
       $own = $v['avr'];
      }
      foreach($query_avg as $g)
          $grp = $g['avr'];

       }
       return '<strong class="ui-accordion-header ui-helper-reset ui-state-default ui-accordion-header-active ui-state-active ui-corner-top ui-accordion-icons">Population Average Category % Score: '. round($grp,2). ' <br />Your Average % Score: '. round($own,2).'</strong>';
    }
    
    
    public function getSubSkills($id){
        //$this->db->group_by('subskills');
        $query = $this->db->get_where('subskills', array("skillID" => $id));
        return $query->result_array();
    }
    public function Skills($id){
        $query = $this->db->get_where('skills', array('category_id'=>$id));
       return $rows = $query->result_array();
       
        
    }
    public function getScore($id)
    {
         $arr = $this->db->group_by('SUBSKILL_ID')
                 ->get_where('scores',array('SUBSKILL_ID'=>$id,'user_id'=>$this->session->userdata('user_id')))->result_array();
         
         if(!empty($arr))
         {
             foreach($arr as $r)
         {
             $score = $r['SCORE'];
         }
         return $score;
    }
    else
        return 0;
    }
    
    public function SkillTitle($subid){
        $query = $this->db->get_where('subskills', array('subID'=>$subid));
        $rows = $query->result();
        foreach ($rows as $val){
            $title = $val->subskill;
        }
        return $title;
    }

    public function categoryDone(){
        $this->db->get_where('scores', array("CATEGORY_ID" => $this->session->userdata('category_id'), "USER_ID" => $this->session->userdata('user_id')));
        if($this->db->affected_rows() > 0) return TRUE; else return FALSE;
    }
    
    
    public function saveScores($data){
        $user = $data['USER_ID'];
        $subID = $data['SUBSKILL_ID'];
        $count = $this->db->query("SELECT * FROM scores WHERE USER_ID = '$user' AND SUBSKILL_ID = '$subID'")->num_rows();
        if($count > 0)
        {
        $this->db->where('USER_ID',$user)->where('SUBSKILL_ID',$subID)->update('scores',$data);
                
        }
            else
            {
            $this->db->insert('scores',$data);
            }
       // if($this->db->affected_rows() == 0) echo 'Technical error[scores]';        
    }
}

?>
