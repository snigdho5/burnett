<?php 
class User_model extends CI_Model {

	public function __construct() {
	// Call the CI_Model constructor
		parent::__construct();
			}		
	public function add_user($data) {
		
	/*$salt = '5&JDDlwz%Rwh!t2Yg-Igae@QxPzFTSId';
	if($data['password']=='')
	{
		$password = md5($salt.'123456');
	}
	else
	{
		$password = md5($salt.$data['password']);
		unset($data['password']);
	}
	$data['actual_password']=$password;*/
		if($this->db->insert('register_users', $data)){		
			return $this->db->insert_id();
		} else {
			return false;	
		}
	}
	public function check_user($data) {
		
		$this->db->select('*');
		$this->db->from('register_users');
		$this->db->where('username',$data['username']);
		$query = $this->db->get();
		$result = $query->num_rows();
return $result;
	
	
	}
	public function edit_user($id, $data) {
	/*if($data['password']=='')
	{
	unset($data['password']);	
	}
	else
	{
		$salt = '5&JDDlwz%Rwh!t2Yg-Igae@QxPzFTSId';
		$password = md5($salt.$data['password']);
		unset($data['password']);
		$data['actual_password']=$password;
	}
	*/
		//echo '<pre>';print_r($data);die;
		if(isset($data) && $data!=false)
		{
		$this->db->where('user_id', $id);
		if($this->db->update('register_users', $data)){	
		echo $this->db->last_query();		
			return $id;
		} else {
			return false;	
		}
		}
		else {
			return false;	
		}
		
	}
	
	
	public function user_list() {	
		
		$this->db->select('*');
		$this->db->from('register_users');

		//$this->db->join('product_images ib', 'gp.id = ib.gallery_photos_id');
		//$this->db->join('category gc', 'gp.category_id = gc.id');			
		$query = $this->db->get();
		$result = $query->result();
		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
	}
	
	public function customer_list() {	
		$this->db->select('*');
		$this->db->from('register_users');
		$this->db->where('user_type', 'CU');
		$query = $this->db->get();
		$result = $query->result();
		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
	}
	
	public function user_discount_list_by_id($uid) {	
		$this->db->select('*');
		$this->db->from('user_discount');
		$this->db->where('user_id', $uid);
		$query = $this->db->get();
		$result = $query->result();
		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
	}
	
	public function doctor_list() {	
		$this->db->select('*');
		$this->db->from('register_users');
		$this->db->where('user_type', 'DR');
		$query = $this->db->get();
		$result = $query->result();
		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
	}
	
	public function dealer_list() {	
		$this->db->select('*');
		$this->db->from('register_users');
		$this->db->where('user_type', 'DI');
		$query = $this->db->get();
		$result = $query->result();
		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
	}
	
	public function stockist_list() {	
		$this->db->select('*');
		$this->db->from('register_users');
		$this->db->where('user_type', 'ST');
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
               'activate' => $status
            );
		
		$this->db->where('user_id', $id);
		$query = $this->db->update('register_users', $data); 
		if($query){
			return true;	
		}else{
			return false;	
		}	

	}
	
	
	public function delete_user($id) {	

		
			$this->db->where('user_id', $id);
					$query2 = $this->db->delete('register_users');		
					if($query2){
						return true;	
					}else{
						return false;	
					}		
	
		

	}
	
	
	public function user_details_by_id($id){
		$query = $this->db->get_where('register_users', array('user_id' => $id));

		
		$result = $query->result();
		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
	}
	public function get_product_section($id){
		
		$query = $this->db->get_where('product_section', array('product_id' => $id));
		$result = $query->result();
		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
	}
	
	
	public function active_product_list() {		
		$query = $this->db->get_where('product', array('status' => 1));
		$result = $query->result();
		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
	}
	
	
	public function delete_image_only($image_id){
		
		$query = $this->db->get_where('product_images', array('id' => $image_id));
		$result = $query->row();
		
		if(!empty($result)){
				$filename = 'uploads/'.$result->images;				
				if(file_exists($filename)){ 
						unlink($filename);					
						$this->db->where('id', $image_id);
						$query = $this->db->delete('product_images');		
						if($query){
							return true;	
						}else{
							return false;	
						}		
				}else{
					echo "Error in file deleting";
					return false;
				}
			
		}
		
	}
	public function delete_section($section_id){
		
		$query = $this->db->get_where('product_section', array('product_section_id' => $section_id));
		$result = $query->row();
		
		if(!empty($result)){
				$filename = 'uploads/content/'.$result->product_section_image;				
				if(file_exists($filename)){ 
						unlink($filename);					
						$this->db->where('product_section_id', $section_id);
						$query = $this->db->delete('product_section');		
						if($query){
							return true;	
						}else{
							return false;	
						}		
				}else{
					echo "Error in file deleting";
					return false;
				}
			
		}
		
	}
	
	public function product_list_by_category_id($id){
		
		$this->db->select('gp.*, ib.images, ib.id as image_id');
		$this->db->from('product gp');
	//	$this->db->join('gallery_category gc', 'gc.id = gp.category_id', 'left');
		$this->db->join('product_images ib', 'gp.id = ib.product_id', 'left');	
		$this->db->where('gp.category_id', $id);
		$query = $this->db->get();
		$result = $query->result();
		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
	}
	
	
	public function active_products_with_order_and_limit($order, $limit) {		
	
		$this->db->select('p.*, pi.images');
		$this->db->from('product p');
		$this->db->join('product_images pi', 'p.id = pi.product_id');
		$this->db->where('p.status', 1);
		$this->db->limit($limit);
		$this->db->order_by('p.date_added', $order);
		$query = $this->db->get();
		$result = $query->result();
		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
	}
	
	
	public function active_featured_products_with_limit($featured, $limit) {		
	
		$this->db->distinct('p.*, pi.images');
		$this->db->from('product p');
		$this->db->join('product_images pi', 'p.id = pi.product_id');
		$this->db->where('p.status', 1);
		$this->db->where('p.featured', $featured);
		$this->db->limit($limit);
		$query = $this->db->get();
		$result = $query->result();
		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
	}
	
	
	public function get_user_modules_item_byusername($username)
	{
		
			$gal_query = $this->db->get_where('register_users',array('username'=>$username,'status'=>'1'));
			if($gal_query->num_rows()>0)
			{
				$result = $gal_query->result();	
				return $result;
			}
			else
			{
				return false;	
			}	
		
	}
	public function get_user_modules_item_byuactivationno($username)
	{
		
			$gal_query = $this->db->get_where('register_users',array('activation_random_no'=>$username));
			if($gal_query->num_rows()>0)
			{
				$result = $gal_query->result();	
				return $result;
			}
			else
			{
				return false;	
			}	
		
	}
		
}