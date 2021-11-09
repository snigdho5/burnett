<?php
class Product_model extends CI_Model
{

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}


	public function add_product($data)
	{

		/*$data_arr = array(
									'category_id' => $data['category_id'],
									'product_title' => $data['product_title'],
									'product_details' => $data['product_details'],
									'date_added' => $data['date_added'],
									'status' => $data['status'],
									'featured' => $data['featured']
								);*/

		if ($this->db->insert('product', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
	public function edit_product($id, $data)
	{
		//echo '<pre>';print_r($data);die;
		$this->db->where('product_id', $id);
		if ($this->db->update('product', $data)) {
			return $id;
		} else {
			return false;
		}
	}
	public function product_list()
	{

		$this->db->select('p.*');
		$this->db->from('product p');
		//$this->db->join('gallery_category p', 'c.parent_id = p.id', 'left');
		$this->db->order_by("product_id", "ASC");
		$query = $this->db->get();
		$result = $query->result();
		if (!empty($result)) {
			return $result;
		} else {
			return false;
		}
	}





	public function product_list_selected_category($category_id)
	{



		$query = $this->db->get_where('product', array('status' => '1', 'category_id' => $category_id));

		$this->db->order_by("product_id", "desc");
		$result = $query->result();
		$this->db->flush_cache();
		if (!empty($result)) {

			foreach ($result as $R) {
				$query1 = $this->db->get_where('product_link_management', array('product_id' => $R->product_id));
				$result1 = $query1->result();

				$product['details'] = $R;

				$product['link'] = $result1;
				$allproduct[] = $product;
			}

			return $allproduct;
		} else {
			return false;
		}
	}

	public function product_list_by_cateory($category_id)
	{

		$this->db->select('p.*');
		$this->db->from('product p');
		//$this->db->join('gallery_category p', 'c.parent_id = p.id', 'left');
		$this->db->order_by("p.product_id", "DESC");
		$this->db->where(array('p.category_id' => $category_id));
		$this->db->limit(4, 0);
		$query = $this->db->get();
		$result = $query->result();
		if (!empty($result)) {
			return $result;
		} else {
			return false;
		}
	}
	public function product_list_search($key)
	{

		$this->db->select('p.*');
		$this->db->from('product p');
		//$this->db->join('gallery_category p', 'c.parent_id = p.id', 'left');
		$this->db->order_by("p.product_id", "DESC");
		//$this->db->where(array('p.category_id'=>$category_id));	
		$this->db->like('p.product_title_eng', $key);
		$this->db->or_like('p.product_title_ben', $key);
		$this->db->or_like('p.product_title_hin', $key);
		//$this->db->limit(4, 0);
		$query = $this->db->get();
		$result = $query->result();
		if (!empty($result)) {
			return $result;
		} else {
			return false;
		}
	}

	public function product_details_by_id($id)
	{

		$this->db->select('pm.*');
		$this->db->from('product pm');

		$this->db->where(array('pm.product_id' => $id));
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

	public function get_variable_product_price($variable_attribute_id)
	{

		$this->db->select('pv.*');
		$this->db->from('product_variable_attribute pv');

		$this->db->where(array('pv.variable_attribute_id' => $variable_attribute_id));
		$query = $this->db->get();
		$result = $query->result();
		if (!empty($result)) {
			return $result;
		} else {
			return false;
		}
	}

	public function product_details_by_unique($id)
	{

		$this->db->select('pm.*');
		$this->db->from('product_management pm');

		$this->db->where(array('pm.unique_key' => $id));
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

	public function get_product_section($id)
	{

		$query = $this->db->get_where('product_link_management', array('product_id' => $id));
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

		$this->db->where('product_id', $id);
		$query = $this->db->update('product_management', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function modify_product_link($data)
	{
		$trnID = $data['product_link_id'];
		unset($data['product_link_id']);
		$this->db->where('product_link_id', $trnID);
		$this->db->update('product_link_management', $data);
	}
	public function delete_link($link_id)
	{


		$this->db->where('product_link_id', $link_id);
		$query = $this->db->delete('product_link_management');
		if ($query) {
			return true;
		} else {
			return false;
		}
	}


	public function update_product_link($pid, $section = array())
	{

		foreach ($section as $S) {
			$section_data  = array();
			$section_data['product_link_title'] = $S['link_title'];
			$section_data['product_link_subtitle'] = $S['link_subtitle'];
			$section_data['product_link_href'] = $S['link_link'];

			$section_data['product_id'] = $pid;

			// var_dump($not);
			$this->db->insert('product_link_management', $section_data);
		}
	}

	public function is_product($id)
	{


		$query = $this->db->get_where('product_management', array('product_id' => $id));
		return $query->num_rows();
	}

	public function product_list_latest()
	{

		$query = $this->db->get_where('product_management', array('status' => '1'));
		$this->db->order_by("product_id", "desc");
		$result = $query->result();

		if (!empty($result)) {

			foreach ($result as $R) {
				$query1 = $this->db->get_where('product_link_management', array('product_id' => $R->product_id));
				$result1 = $query1->result();

				$product['details'] = $R;

				$product['link'] = $result1;
				$allproduct[] = $product;
			}

			return $allproduct;
		} else {
			return false;
		}
	}

	public function get_product_converted_value($product_id, $key)
	{

		if (!$this->session->userdata('is_language')) {

			$title_key_val = 'product_title_eng';
			$des_key_val = 'product_des_eng';
		} else {
			$language = $this->session->userdata('is_language');
			$title_key_val = 'product_title_' . $language['language'];
			$des_key_val = 'product_des_' . $language['language'];
		}

		$query = $this->db->get_where('product_management', array('product_id' => $product_id));

		$result = $query->result();

		if (!empty($result)) {

			$R = $result[0];
			$query1 = $this->db->get_where('product_link_management', array('product_id' => $R->product_id));
			$result1 = $query1->result();
			/* title & des */
			if ($R->{$title_key_val} == '') {
				$R->converted_title	 = $R->product_title_eng;
				$R->converted_des	 = $R->product_des_eng;
			} else {
				$R->converted_title	=  $R->{$title_key_val};
				$R->converted_des	 = $R->{$des_key_val};
			}

			//$R->converted_price =  $R->product_price_inr;


			/* Price Calculation */
			if ($this->session->userdata('login') == true) {
				$user_details = $this->session->userdata('user_profile');
				//var_dump($user_details);
				if ($user_details['is_subscriber'] == '1') {
					$R->converted_prev_price = $R->{'product_price_' . strtolower($_SESSION['currency'])};
					$R->converted_price =  $R->{'product_price_' . strtolower($_SESSION['currency'])} - ($R->{'product_price_' . strtolower($_SESSION['currency'])} * 10 / 100);
				} else {
					$R->converted_prev_price = 0;
					$R->converted_price =  $R->{'product_price_' . strtolower($_SESSION['currency'])};;
				}
			} else {
				$R->converted_prev_price = 0;
				$R->converted_price = $R->{'product_price_' . strtolower($_SESSION['currency'])};
			}


			/* GST Calculation */
			$gstquery = $this->db->get_where('gst', array('gst_id' => $R->gst_id));

			$gstresult = $gstquery->result();

			if (!empty($gstresult)) {
				//var_dump($gstresult);
				$GST = $gstresult[0];
				$R->converted_cgst_title = $GST->cgst;
				$R->converted_sgst_title = $GST->sgst;

				$R->converted_cgst =  $R->converted_price * $GST->cgst / 100;
				$R->converted_sgst = $R->converted_price * $GST->sgst / 100;
			} else {
				$R->converted_cgst_title = 0;
				$R->converted_sgst_title = 0;
				$R->converted_cgst =  $R->converted_price * 0 / 100;
				$R->converted_sgst = $R->converted_price * 0 / 100;
			}



			return $R->{'converted_' . $key};
		} else {
			return false;
		}
	}



	public function active_category_list()
	{


		/*$query = $this->db->order_by("cat_priority","asc")->get_where('category', array('status' =>'1'));
		
		//$this->db->order_by("cat_priority","desc");
		$result = $query->result();
		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
*/
		$query = $this->db->get_where('category', array('parent_id' => '0', 'status' => '1'));
		//$query = $this->db->get_where('category',array('parent_id' => '0','cat_id'=>'parent_id' ,'status' =>'1'));
		$return = array();

		foreach ($query->result() as $category) {
			$return[$category->cat_id] = $category;
			//$return[$category->cat_id]->chk = $this->chk_sub_categories($category->cat_id); // Get the categories sub categories
			$return[$category->cat_id]->subs = $this->get_sub_categories($category->cat_id); // Get the categories sub categories        

		}

		return $return;
	}


	public function get_sub_categories($category_id)
	{
		$this->db->where('parent_id', $category_id);
		$query = $this->db->get('category');
		return $query->result();
	}


	//where catid 
	public function chk_sub_categories($subcategory_id)
	{
		/*$this->db->where('parent_id!=', $subcategory_id);
		    $query = $this->db->get('category');*/
		$query = $this->db->get_where('category', array('parent_id!=' => $subcategory_id));

		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	//snigdho
	public function pickup_details($param = null, $many = FALSE)
	{

		$this->db->select('*');
		$this->db->from('pickup_details');
		if ($param != null) {
			$this->db->where($param);
		}
		$this->db->order_by("id", "ASC");
		$query = $this->db->get();

		if ($many == FALSE) {
			$result = $query->row();
		} else {
			$result = $query->result();
		}

		if (!empty($result)) {
			return $result;
		} else {
			return false;
		}
	}

	public function modify_pickup_details($param, $data)
	{
		if ($param != null && $data != null) {
			$this->db->where($param);
			$this->db->update('pickup_details', $data);
			return true;
		} else {
			return false;
		}
	}


	public function get_product_category($param = null, $many = FALSE, $order = 'DESC', $order_by = '')
	{

		$this->db->select('category.*');
		$this->db->join('category', 'product_category.category_id = category.cat_id', 'left');

		if ($param != null) {
			$this->db->where($param);
		}


		//$this->db->order_by($order_by, $order);


		$query = $this->db->get('product_category');
		// echo $this->db->last_query();die;

		if ($many != TRUE) {
			return $query->row_array();
		} else {
			return $query->result_array();
		}
	}

	public function get_category($param = null, $many = FALSE, $order = 'DESC', $order_by = '')
	{
		$this->db->select('category.*');

		if ($param != null) {
			$this->db->where($param);
		}
		//$this->db->order_by($order_by, $order);

		$query = $this->db->get('category');
		// echo $this->db->last_query();die;

		if ($many != TRUE) {
			return $query->row_array();
		} else {
			return $query->result_array();
		}
	}
}
