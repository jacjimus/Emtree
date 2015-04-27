<?php


class Dropdown extends CI_Model
{
    
    
    public function __construct() {
        parent::__construct();
    }
    
    
    private function getRows($table_name){
        $query = $this->db->get($table_name);
        return $query->result_array();
    }
    
    
    public function generateDropDown($table_name) {
        return $rows = $this->getRows($table_name);
      
    }

}
?>
