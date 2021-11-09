<?php
class Product_attribute_model extends CI_Model
{

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}


	public function add_product_attribute($data)
	{

		if ($this->db->insert('product_attribute', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
	public function edit_product_attribute($id, $data)
	{
		//echo '<pre>';print_r($data);die;
		$this->db->where('product_attribute_id', $id);
		if ($this->db->update('product_attribute', $data)) {
			return $id;
		} else {
			return false;
		}
	}
	public function product_attribute_list()
	{
		/*$this->db->select('*');
			$this->db->from('category');
			//$this->db->join('gallery_category p', 'c.parent_id = p.id', 'left');
			$this->db->order_by("cat_id", "ASC");		
			$query = $this->db->get();
			$result = $query->result();
			if(!empty($result)){			
			return $result;
			} else {
			return false;	
			}*/

		$query = $this->db->get_where('product_attribute', array('variation =' => '0'));
		$return = array();

		foreach ($query->result() as $product_attribute) {
			$return[$product_attribute->product_attribute_id] = $product_attribute;
			$return[$product_attribute->product_attribute_id]->subs = $this->get_sub_product_attribute($product_attribute->product_attribute_id); // Get the categories sub categories
		}

		return $return;
	}

	public function product_units_list($param = null)
	{
		$this->db->select('*');
		$this->db->from('units');
		if($param != null){
			$this->db->where($param);
		}
		$this->db->order_by("name", "ASC");		
		$query = $this->db->get();
		$result = $query->result();
		if(!empty($result)){			
		return $result;
		} else {
		return false;	
		}
	}

	public function delete_unit($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->delete('units');
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function add_unit($data)
	{

		if ($this->db->insert('units', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
	
	public function edit_unit($id, $data)
	{
		//echo '<pre>';print_r($data);die;
		$this->db->where('id', $id);
		if ($this->db->update('units', $data)) {
			return $id;
		} else {
			return false;
		}
	}



	public function get_sub_product_attribute($category_id)
	{
		$this->db->where('variation', $category_id);
		$query = $this->db->get('product_attribute');
		return $query->result();
	}



	public function product_attribute_details_by_id($id)
	{

		$this->db->select('*');
		$this->db->from('product_attribute');

		$this->db->where(array('product_attribute_id' => $id));
		$query = $this->db->get();
		$result = $query->result();
		if (!empty($result)) {


			/*  	$front_userloged = $this->session->userdata('is_frontuser_login');          
          	
	$array = array('product_id' => $result[0]->id, 'user_id' => $front_userloged['user_id']);
	$this->db->where($array);
   $q = $this->db->get('wishlist');

   if ( $q->num_rows() > 0 ) 
   {
     $result['wishlist_status'] = 1;
   } 
   else
   {
	   $result['wishlist_status'] = 0;
   }*/

			return $result;
		} else {
			return false;
		}
	}
	public function active_product_attribute_list()
	{
		$query = $this->db->order_by("cat_priority", "asc")->get_where('product_attribute', array('status' => '1'));

		$this->db->order_by("cat_priority", "desc");
		$result = $query->result();
		if (!empty($result)) {
			return $result;
		} else {
			return false;
		}
	}







	public function change_status($id, $status)
	{

		$data = array(
			'status' => $status
		);

		$this->db->where('product_attribute_id', $id);
		$query = $this->db->update('product_attribute', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}



	public function delete_product_attribute($id)
	{
		$this->db->where('product_attribute_id', $id);
		$query = $this->db->delete('product_attribute');
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
}
