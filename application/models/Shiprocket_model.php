<?php
class Shiprocket_model extends CI_Model {

    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function addPincodeLog($data) {
		
        if(!empty($data)){
            if($this->db->insert('pincode_checker_log', $data)){		
                return $this->db->insert_id();
            } else {
                return false;	
            }
        }else {
            return false;	
        }
		
	}

}