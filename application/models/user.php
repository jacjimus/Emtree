<?php

class User extends CI_Model
{
    
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function getFullUserDetail($userid){
        $query = $this->db->where('USER_ID', $userid)
                  
                  ->join('institutions','users_tb.InstitutionID = institutions.InstitutionID')
                ->get('users_tb');
        return $query->result();
    }
    
    function exists($email)
    {
        $this->db->from('users_tb')
                ->where('email',$email);
                $query = $this->db->get();
		
		return ($query->num_rows()==1);
    }
    
    public function createAccount($fname, $access, $sname, $email, $password, $sex,$race, $institution,$tree){
        $data = array(
            "FIRST_NAME"    => $fname,
            "ACCESS"    => $access,
            "SURNAME"       => $sname,
            "SEX"           => $sex,
            "InstitutionID"   => $institution,
            "EMAIL"         => $email,
            "RACE"      => $race,
            "STATUS"      => 1,
            "FAVTREE"      => $tree,
            "PASSWORD"      => md5($password),
        );
        if(!$this->exists($email))
        {
        $this->db->insert('users_tb', $data);
        if($this->db->affected_rows() > 0)
            return TRUE;
        }
        else {
             return false;
        }
    }
    public function accessCode($code)
    {
        $row = $this->db->select("access")
                ->from('access_codes')
                ->where('access',$code)
                ->where('validity',true)
                ->limit(1)
                ->get()
                ;
                
        if($row->num_rows() > 0)
            return true;
    }
    public function compareoldpwd($oldpwd, $user)
    {
        $query = $this->db->where('USER_ID',$user)
                 ->get('users_tb');
        foreach($query->result() as $row)
            if($row->PASSWORD == $oldpwd)
         return TRUE; 
         else 
             return FALSE;
    }
     public function changepwd($password,$userid){
        $data = array(
                     "PASSWORD"      => md5($password),
        );
        $this->db->where('USER_ID',$userid)
                 ->update('users_tb', $data);
        if($this->db->affected_rows() > 0) return TRUE; else return FALSE;
    }
    
    
    
    
}

?>
