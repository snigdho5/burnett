<?php 
class Auth_model extends CI_Model {

		public function __construct() {
		// Call the CI_Model constructor
			parent::__construct();
        }		
		public function authentification($username, $password) {
			
			$query = $this->db->get_where('users', array('username' => $username, 'password' => $password));
			if($query->num_rows()>0) {
				$result = $query->row();
				return $result;
			} else {
				return false;	
			}
		}
		public function site_settings($id){
			
			$query = $this->db->get_where('settings', array('id' => $id));
			if($query->num_rows()>0) {
				$result = $query->row();
				return $result;
			} else {
				return false;	
			}
		}
		
		public function change_password($id,$data){
			
			$this->db->where(array('id' => $id, 'password' => md5($data['old_password'])));
			$data_new['password'] = md5($data['new_password']);
			$this->db->update('users', $data_new);
			if($this->db->affected_rows()>0){		
				return true;
			} else {
				return false;	
			}
		}
		
		public function edit_settings($id, $data) {
		
		$this->db->where('id', $id);
		if($this->db->update('settings', $data)){			
			return true;
		} else {
			return false;	
		}
	}
		
		
}