<?php 
class Product_category_model extends CI_Model {

	public function __construct() {
	// Call the CI_Model constructor
		parent::__construct();
			}		
	public function add_category($data) {		
		if($this->db->insert('category', $data)){			
			return true;
		} else {
			return false;	
		}
	}
	
	public function edit_category($id, $data) {
		
		$this->db->where('id', $id);
		if($this->db->update('category', $data)){			
			return true;
		} else {
			return false;	
		}
	}
	
	public function category_list() {	
		
		$this->db->select('c.*, p.name as parent_name');
		$this->db->from('category c');
		$this->db->join('category p', 'c.parent_id = p.id', 'left');		
		//$this->db->order_by("c.cat_priority","desc");	
		$query = $this->db->get();
		$result = $query->result();
		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
	}
	
	public function change_status($id, $status) {	
	
		$data = array(
               'status' => $status
            );
		
		$this->db->where('id', $id);
		$query = $this->db->update('category', $data); 
		if($query){
			return true;	
		}else{
			return false;	
		}	

	}
	
	
	public function delete_category($id) {	
	
		$this->db->where('id', $id);
		$query = $this->db->delete('category');		
		if($query){
			return true;	
		}else{
			return false;	
		}		

	}
	
	
	public function category_details_by_id($id){
		
		$this->db->select('c.*');
		$this->db->from('category c');
	
		$this->db->where('c.cat_id', $id);
		$query = $this->db->get();
		$result = $query->row();
		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
	}
	

	
	public function active_category_list() {

/*			
	$this->db->select('*');
		$this->db->from('category');
	
		$this->db->where('status', '1');
		//$this->db->order_by("cat_priority","desc");
		$query = $this->db->get();
		//$query1 = $this->db->order_by("cat_priority","asc")->get_where('category', array('status' =>'1'));
		
		//$this->db->order_by("cat_priority","desc");
		$result = $query->result();
	*/

		$query = $this->db->get_where('category',array('parent_id =' => '0','status', '1'));
		//$query = $this->db->order_by("cat_priority","desc");
		$result = $query->result();

		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
	}
	
	
	public function active_parent_category_list() {		
		$query = $this->db->order_by("cat_priority","asc")->get_where('category', array('status' => 1, 'parent_id' => 0));
		$result = $query->result();
		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
	}
	
	public function parent_category_list() {		
		$query = $this->db->order_by("cat_priority","asc")->get_where('category', array('parent_id' => 0));
		$result = $query->result();
		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
	}
	
	public function active_chiild_categories_by_parent_id($id) {		
		$query = $this->db->order_by("cat_priority","asc")->get_where('category', array('status' => 1, 'parent_id' => $id));
		$result = $query->result();
		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
	}
	
	public function chiild_categories_by_parent_id($id) {		
		$query = $this->db->order_by("cat_priority","asc")->get_where('category', array('parent_id' => $id));
		$result = $query->result();
		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
	}
	
	
	public function category_details_by_unique_name($unique_name){
				
		$query = $this->db->get_where('category', array('unique_name' => $unique_name));
		$result = $query->row();
		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
	}
	


	public function check_sub_cat($chk_subcat_id){
				
		$query = $this->db->get_where('category', array('parent_id' => $chk_subcat_id));
		$result = $query->result_array();
		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
	}

	

		
}