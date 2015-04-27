<?php

class Aunthentication extends CI_Model
{
    
    
    public function __construct() {
        parent::__construct();
        
    }
    
    public function processLogin($username, $password)
    {
        $this->db->where('EMAIL', $username)->get('users_tb');
        if($this->db->affected_rows() < 1) 
            return 'noemail';
        else
        {
            $this->db->where('EMAIL', $username)->where('PASSWORD', md5($password))->get('users_tb');
        if($this->db->affected_rows() < 1) 
            return 'wrongpass';
        
        else
        {
             $this->db->where('EMAIL', $username)->where('PASSWORD', md5($password))->where('STATUS',1)->get('users_tb');
             if($this->db->affected_rows() < 1) 
            return 'status';
        else {
            
        return true;
        
        }
        }
        
        }
    }
    
    
    public function getUserID($username){
        $query = $this->db->get_where('users_tb', array('EMAIL'=>$username));
        $rows = $query->result_array();       
        return $rows;
    }
    
    
    public function checkPassword($email){
        $this->db->where('EMAIL', $email)->get('users_tb');
        if($this->db->affected_rows() > 0) return TRUE; else return FALSE;
    }
    
    
    public function updatePassword($random_password, $user_id){
        $data = array('PASSWORD' => $random_password);
        $this->db->where('USER_ID', $user_id)->update('users_tb', $data);
        if($this->db->affected_rows() > 0) return TRUE; else return FALSE;
    }
    
    
}

?>
