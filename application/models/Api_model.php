<?php 
class Api_model extends CI_Model {
	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}
	
	//============================== Function to fetch Table Data ==============================
    public function fetchData($tableName, $fieldsAdmin, $mWhere, $groupBy="", $orderBy="", $asc_desc=""){
        $returnedArray	=	array();
        if($groupBy !=""){
                $this->db->group_by($groupBy); 
        }
        if($orderBy !="" && $asc_desc !="" ){
                $this->db->order_by($orderBy, $asc_desc); 
        }
        if(!empty($mWhere))
            $this->db->where($mWhere);

        $this->db->select($fieldsAdmin); 
        $this->db->from($tableName);
        if($query = $this->db->get()){
            //echo $this->db->last_query();
            $returnedArray 	=	$query->result();
            //print_r($returnedArray);die;
        }
        return $returnedArray;

    }
	
	//============================== Function to fetch Table Data ==============================
    public  function  fetchDataAsArray($tableName, $fieldsAdmin, $mWhere, $groupBy="", $orderBy="", $asc_desc=""){
        $returnedArray	=	array();
        if($groupBy !=""){
                $this->db->group_by($groupBy); 
        }
        if($orderBy !="" && $asc_desc !="" ){
                $this->db->order_by($orderBy, $asc_desc); 
        }
        if(!empty($mWhere))
            $this->db->where($mWhere);

        $this->db->select($fieldsAdmin); 
        $this->db->from($tableName);
        if($query = $this->db->get()){
            //echo $this->db->last_query();
            $returnedArray 	=	$query->result_array();
            //print_r($returnedArray);die;
        }
        return $returnedArray;

    }
	
	//================= Function to update data into Table =================
    public function updateData($tableName, $mWhere, $dataArray){
         $returnedRows	=0;
        $this->db->where($mWhere);
        if($this->db->update($tableName, $dataArray)){
           $returnedRows 	=	$this->db->affected_rows();
        }
		//echo $this->db->last_query();
        return $returnedRows;
    }
	
	//================= Function to insert data into Table =================
    public  function  insertData($tableName, $dataArray){
        $returnedValue	=	0;
        
        if($this->db->insert($tableName, $dataArray)){
            $returnedValue	=	 $this->db->insert_id();
        }
        return $returnedValue;
    }
	
	public function validate_login($username, $password, $login_ip, $login_time) {
		$this->db->select('*');
		$this->db->from('register_users');
		$this->db->where('email', $username);
		$query = $this->db->get();
		$result = $query->row();
		if(!empty($result)) {
			$this->db->select('*');
			$this->db->from('register_users');
			$this->db->where(array('email' => $username, 'password' => md5($password)));
			$query = $this->db->get();
			$result = $query->row();
			if(!empty($result)) {
				if($result->activate == 1) {
					return $result;
				} else {
					return 'inactive';
				}
			} else {
				return 'password_incorrect';
			}
		} else {
			return 'not_found';
		}
	}
	
	public function common($table_name='',$field=array(),$where=array(),$where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='',$where_in_array=array())
	{
		if(trim($table_name))
		{
			if(count($field)>0)
			{
				 $field=implode(',',$field);
			}
			else
			{
				$field='*';
			}
			
			$this->db->select($field);  
			$this->db->from($table_name); 
			
			if(count($where)>0)
			{
				foreach($where as $key=>$val)
				{
					if(trim($val))
					{
						$this->db->where($key,$val);
					} 
				}
			}
			
			
			if(count($where_or)>0)
			{
				foreach($where_or as $key=>$val)
				{
					if(trim($val))
					{
						$this->db->or_where($key,$val);
					} 
				}
			}
			
			if(count($order)>0)
			{
				foreach($order as $key=>$val)
				{
					if(trim($val))
					{
						$this->db->order_by($key,$val);
					} 
				}
			
			}
			
			if(count($like)>0)
			{
				foreach($like as $key=>$val)
				{
					if(trim($val))
					{
					   $this->db->like($key,$val);
					 
					} 
				}
			}
			
			
			if($end)
			{
				$this->db->limit($end,$start);
			}
			
			if(count($where_in_array)>0)
			{
				$this->db->where_in('user_id', $where_in_array);
			}
			 
			$query = $this->db->get();
			$resultResponse=$query->result();
			return $resultResponse;
			}
			else
			{
					 echo 'Table name should not be empty';exit;
			}
	
	   }
	   
	public function getcategories(){
		$this->db->select('*');
		$this->db->from('category');
		$this->db->where('status', '1');
		$query = $this->db->get();
		$result = $query->result_array();	
		foreach($result as $key=>$results){
			$catid = $results['parent_id'];
			if($catid > 0){
				$this->db->select('*');
				$this->db->from('category');
			 	$this->db->where('cat_id',$catid);
			    $res = $this->db->get();
			    $re = $res->row();
	            $parentcatname = (!empty($re))?$re->name:'';
			}else{
				$parentcatname = $results["name"];
			}
			$result[$key]['parentcatname'] = $parentcatname;
			$result[$key]['categoryimgstat'] = $this->config->item('base_url')."uploads/".$results['category_image'];    
		}

		if(!empty($result)) {
			return $result;
		} else {
			return 'no data found';
		}	
	}
	
	public function getproducts(){
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('status', '1');
		$query = $this->db->get();
		$result = $query->result_array();	
		foreach($result as $key=>$results){
			$productid = $results['product_id'];
			if($productid > 0){
				$this->db->select('pc.category_id, c.name as cat_name, c.description as cat_description');
				$this->db->from('product_category pc');
				$this->db->join('category c', 'pc.category_id = c.cat_id');
			 	$this->db->where('pc.product_id',$productid );
			    $res = $this->db->get();
			    $re = $res->result_array();
	            $parentcatid = $re;
			}else{
				$parentcatid = '';
			}
			if($results['brand_id'] > 0){
				$this->db->select('b.brand_id, b.name as brand_name, b.description as brand_description');
				$this->db->from('brand b');
				//$this->db->join('category c', 'b.category_id = c.cat_id');
			 	$this->db->where('b.brand_id',$results['brand_id'] );
				$res_brand = $this->db->get();
			    $re_brand = $res_brand->result_array();
				
				$brandDetails = $re_brand;
			} else {
				$brandDetails = '';
			}
			
			$this->db->select('*');
			$this->db->from('product_gallery_image');
			$this->db->where('product_id', $productid);
			$query = $this->db->get();
			$result_gallery = $query->result_array();
			
			$arrGalleryImages = array();
			if(!empty($result_gallery)) {
			foreach($result_gallery as $k => $res) {
				array_push($arrGalleryImages, $this->config->item('base_url')."uploads/product/" . $res['product_image']);
				}
			}
			
			if($results['product_type'] == 'variable'){
				$this->db->select('pv.*, pa.name');
				$this->db->from('product_variable_attribute pv');
				$this->db->join('product_attribute pa', 'pv.variation_id = pa.product_attribute_id');
			 	$this->db->where('pv.product_id',$productid );
				$res_attribute = $this->db->get();
			    $re_attribute = $res_attribute->result_array();
				
				$attributeDetails = $re_attribute;
			} else {
				$attributeDetails = '';
			}
			
			
			$result[$key]['brand_details'] = $brandDetails;
			$result[$key]['cat_details'] = $parentcatid;
			$result[$key]['productcatimg'] = $this->config->item('base_url')."uploads/product/".$results['product_image'];
			$result[$key]['gallery_images'] = $arrGalleryImages; 
			$result[$key]['product_attribute'] = $attributeDetails; 
  
		}

		if(!empty($result)) {
			return $result;
		} else {
			return 'no data found';
		}	
	}
	
	public function getproducts_by_keyword($keyword){
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('status', '1');
		if($keyword != 'all'){
			$this->db->where("product_title LIKE '$keyword%'");
		}
		$query = $this->db->get();
		$result = $query->result_array();	
		foreach($result as $key=>$results){
			$productid = $results['product_id'];
			if($productid > 0){
				$this->db->select('pc.category_id, c.name as cat_name, c.description as cat_description');
				$this->db->from('product_category pc');
				$this->db->join('category c', 'pc.category_id = c.cat_id');
			 	$this->db->where('pc.product_id',$productid );
			    $res = $this->db->get();
			    $re = $res->result_array();
	            $parentcatid = $re;
			}else{
				$parentcatid = array();
			}
			if($results['brand_id'] > 0){
				$this->db->select('b.brand_id, b.name as brand_name, b.description as brand_description');
				$this->db->from('brand b');
				//$this->db->join('category c', 'b.category_id = c.cat_id');
			 	$this->db->where('b.brand_id',$results['brand_id'] );
				$res_brand = $this->db->get();
			    $re_brand = $res_brand->result_array();
				
				$brandDetails = $re_brand;
			} else {
				$brandDetails = array();
			}
			
			$this->db->select('*');
			$this->db->from('product_gallery_image');
			$this->db->where('product_id', $productid);
			$query = $this->db->get();
			$result_gallery = $query->result_array();
			
			$arrGalleryImages = array();
			if(!empty($result_gallery)) {
			foreach($result_gallery as $k => $res) {
				array_push($arrGalleryImages, $this->config->item('base_url')."uploads/product/" . $res['product_image']);
				}
			}
			
			if($results['product_type'] == 'variable'){
				$this->db->select('pv.*, pa.name');
				$this->db->from('product_variable_attribute pv');
				$this->db->join('product_attribute pa', 'pv.variation_id = pa.product_attribute_id');
			 	$this->db->where('pv.product_id',$productid );
				$res_attribute = $this->db->get();
			    $re_attribute = $res_attribute->result_array();
				
				$attributeDetails = $re_attribute;
			} else {
				$attributeDetails = array();
			}
			
			
			$result[$key]['brand_details'] = $brandDetails;
			$result[$key]['cat_details'] = $parentcatid;
			$result[$key]['productcatimg'] = $this->config->item('base_url')."uploads/product/".$results['product_image'];
			$result[$key]['gallery_images'] = $arrGalleryImages; 
			$result[$key]['product_attribute'] = $attributeDetails; 
  
		}

		if(!empty($result)) {
			return $result;
		} else {
			return 'no data found';
		}	
	}
	
	public function search_productlist_by_keyword($keyword){
		$this->db->select('*');
		$this->db->from('product');
		$this->db->like('product_title', $keyword);
		$this->db->or_like('product_description', $keyword);
		$this->db->where('status', '1');
		$query = $this->db->get();
		$result = $query->result_array();	
		foreach($result as $key=>$results){
			$productid = $results['product_id'];
			if($productid > 0){
				$this->db->select('pc.category_id, c.name as cat_name, c.description as cat_description');
				$this->db->from('product_category pc');
				$this->db->join('category c', 'pc.category_id = c.cat_id');
			 	$this->db->where('pc.product_id',$productid );
			    $res = $this->db->get();
			    $re = $res->result_array();
	            $parentcatid = $re;
			}else{
				$parentcatid = array();
			}
			if($results['brand_id'] > 0){
				$this->db->select('b.brand_id, b.name as brand_name, b.description as brand_description');
				$this->db->from('brand b');
				//$this->db->join('category c', 'b.category_id = c.cat_id');
			 	$this->db->where('b.brand_id',$results['brand_id'] );
				$res_brand = $this->db->get();
			    $re_brand = $res_brand->result_array();
				
				$brandDetails = $re_brand;
			} else {
				$brandDetails = array();
			}
			
			$this->db->select('*');
			$this->db->from('product_gallery_image');
			$this->db->where('product_id', $productid);
			$query = $this->db->get();
			$result_gallery = $query->result_array();
			
			$arrGalleryImages = array();
			if(!empty($result_gallery)) {
			foreach($result_gallery as $k => $res) {
				array_push($arrGalleryImages, $this->config->item('base_url')."uploads/product/" . $res['product_image']);
				}
			}
			
			if($results['product_type'] == 'variable'){
				$this->db->select('pv.*, pa.name');
				$this->db->from('product_variable_attribute pv');
				$this->db->join('product_attribute pa', 'pv.variation_id = pa.product_attribute_id');
			 	$this->db->where('pv.product_id',$productid );
				$res_attribute = $this->db->get();
			    $re_attribute = $res_attribute->result_array();
				
				$attributeDetails = $re_attribute;
			} else {
				$attributeDetails = array();
			}
			
			
			$result[$key]['brand_details'] = $brandDetails;
			$result[$key]['cat_details'] = $parentcatid;
			$result[$key]['productcatimg'] = $this->config->item('base_url')."uploads/product/".$results['product_image'];
			$result[$key]['gallery_images'] = $arrGalleryImages; 
			$result[$key]['product_attribute'] = $attributeDetails; 
			$result[$key]['base_url'] = base_url() . 'uploads/product/';
  
		}

		if(!empty($result)) {
			return $result;
		} else {
			return 'no data found';
		}	
	}
	
	public function getproducts_by_cat($catId)
	{

		$this->db->select('pc.category_id, pc.product_id, c.name as cat_name, p.*');
		$this->db->from('product_category pc');
		$this->db->join('category c', 'pc.category_id = c.cat_id');
		$this->db->join('product p', 'pc.product_id = p.product_id');
		$this->db->where('pc.category_id', $catId);
		$query = $this->db->get();
		$result = $query->result_array();

		foreach ($result as $key => $results) {
			$productid = $results['product_id'];
			if ($productid > 0) {
				$this->db->select('*');
				$this->db->from('product');
				//$this->db->join('category c', 'pc.category_id = c.cat_id');
				$this->db->where('product_id', $productid);
				$res = $this->db->get();
				$re = $res->row();
				$productDetails = $re;
			} else {
				$productDetails = array();
			}
			if ($productDetails->brand_id > 0) {
				$this->db->select('b.brand_id, b.name as brand_name, b.description as brand_description');
				$this->db->from('brand b');
				$this->db->where('b.brand_id', $productDetails->brand_id);
				$res_brand = $this->db->get();
				$re_brand = $res_brand->row();

				$brandDetails = $re_brand;
			} else {
				$brandDetails = array();
			}

			$this->db->select('*');
			$this->db->from('product_gallery_image');
			$this->db->where('product_id', $productid);
			$query = $this->db->get();
			$result_gallery = $query->result_array();

			$arrGalleryImages = array();
			if (!empty($result_gallery)) {
				foreach ($result_gallery as $k => $res) {
					array_push($arrGalleryImages, $this->config->item('base_url') . "uploads/product/" . $res['product_image']);
				}
			}
			
			if($productDetails->product_type == 'variable'){
				$this->db->select('pv.*, pa.name');
				$this->db->from('product_variable_attribute pv');
				$this->db->join('product_attribute pa', 'pv.variation_id = pa.product_attribute_id');
			 	$this->db->where('pv.product_id',$productid );
				$res_attribute = $this->db->get();
			    $re_attribute = $res_attribute->result_array();
				
				$attributeDetails = $re_attribute;
			} else {
				$attributeDetails = array();
			}

			$result[$key]['brand_details'] = $brandDetails;
			//$result[$key]['productDetails'] = $productDetails;
			$result[$key]['productcatimg'] = $this->config->item('base_url') . "uploads/product/" . $productDetails->product_image;
			$result[$key]['gallery_images'] = $arrGalleryImages;
			$result[$key]['product_attribute'] = $attributeDetails;
		}


		if (!empty($result)) {
			return $result;
		} else {
			return 'no data found';
		}
	}
	
	public function getproducts_details_by_id($product_id){
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get();
		$result = $query->result_array();	
		foreach($result as $key=>$results){
			$productid = $results['product_id'];
			if($productid > 0){
				$this->db->select('pc.category_id, c.name as cat_name, c.description as cat_description');
				$this->db->from('product_category pc');
				$this->db->join('category c', 'pc.category_id = c.cat_id');
			 	$this->db->where('pc.product_id',$productid );
			    $res = $this->db->get();
			    $re = $res->result_array();
	            $parentcatid = $re;
			}else{
				$parentcatid = '';
			}
			if($results['brand_id'] > 0){
				$this->db->select('b.brand_id, b.name as brand_name, b.description as brand_description');
				$this->db->from('brand b');
				//$this->db->join('category c', 'b.category_id = c.cat_id');
			 	$this->db->where('b.brand_id',$results['brand_id'] );
				$res_brand = $this->db->get();
			    $re_brand = $res_brand->result_array();
				
				$brandDetails = $re_brand;
			} else {
				$brandDetails = '';
			}
			
			$this->db->select('*');
			$this->db->from('product_gallery_image');
			$this->db->where('product_id', $productid);
			$query = $this->db->get();
			$result_gallery = $query->result_array();
			
			$arrGalleryImages = array();
			if(!empty($result_gallery)) {
			foreach($result_gallery as $k => $res) {
				array_push($arrGalleryImages, $this->config->item('base_url')."uploads/product/" . $res['product_image']);
				}
			}
			$attributeDetails = array();
			if($results['product_type'] == 'variable'){
				$this->db->select('pv.*, pa.name');
				$this->db->from('product_variable_attribute pv');
				$this->db->join('product_attribute pa', 'pv.variation_id = pa.product_attribute_id');
			 	$this->db->where('pv.product_id',$productid );
				$res_attribute = $this->db->get();
			    $re_attribute = $res_attribute->result_array();
				
				$attributeDetails = $re_attribute;
			}
			
			
			$result[$key]['brand_details'] = $brandDetails;
			$result[$key]['cat_details'] = $parentcatid;
			$result[$key]['productcatimg'] = $this->config->item('base_url')."uploads/product/".$results['product_image'];
			$result[$key]['gallery_images'] = $arrGalleryImages;   
			$result[$key]['product_attribute'] = $attributeDetails;   
		}

		if(!empty($result)) {
			return $result;
		} else {
			return 'no data found';
		}	
	}
	
	public function update_cart_info($row_id, $quantity) {
		$this->db->select('*');
		$this->db->from('users_cart');
		$this->db->where('row_id', $row_id);
		$query = $this->db->get();
		$result = $query->row();
		if(!empty($result)) {
			if(!empty($quantity))
				$data['qty'] = $quantity;
			$this->db->where('row_id', $row_id);
			if($this->db->update('users_cart', $data)) {
				return 'ok';
			} else {
				return 'cannot_update';
			}
			
		} else {
			return 'record_not_found';
		}
	}
	
	public function remove_cart_info_by_row($row_id) {
		$this->db->select('*');
		$this->db->from('users_cart');
		$this->db->where('row_id', $row_id);
		$query = $this->db->get();
		$result = $query->row();
		if(!empty($result)) {
			$this->db->where('row_id', $row_id);
			if($this->db->delete('users_cart')) {
				return 'ok';
			} else {
				return 'cannot_update';
			}
			
		} else {
			return 'record_not_found';
		}
	}
	
	public function getcartdata_by_userid($user_id){
		$this->db->select('uc.*,p.product_image');
		$this->db->from('users_cart uc');
		$this->db->join('product p', 'uc.product_id = p.product_id');
		$this->db->where('uc.user_id', $user_id);
		$query = $this->db->get();
		//$result = $query->result_array();
		$result = $query->result();
		/*foreach($result as $key=>$results){
			$productid = $results['product_id'];
			
			$this->db->select('product_image');
			$this->db->from('product');
			$this->db->where('product_id', $productid);
			$querycheck = $this->db->get();
			$resultrow = $querycheck->row();
			$result[$key]->product_image = $this->config->item('base_url') . 'uploads/product/' . $resultrow->product_image;
		}*/
		if(!empty($result)) {
			foreach($result as $key => $res) {
				$result[$key]->product_image = base_url() . 'uploads/product/' . $res->product_image;
			}
		}
		if(!empty($result)) {
			return $result;
		} else {
			return 'no data found';
		}	
	}
	
	public function remove_wishlist($user_id, $product_id) {
		$this->db->select('*');
		$this->db->from('wishlist');
		$this->db->where('user_id', $user_id);
		$this->db->where('product_id', $product_id);
		$query = $this->db->get();
		$result = $query->row();
		if(!empty($result)) {
			$this->db->where('user_id', $user_id);
			$this->db->where('product_id', $product_id);
			if($this->db->delete('wishlist')) {
				return 'ok';
			} else {
				return 'cannot_update';
			}
			
		} else {
			return 'record_not_found';
		}
	}
	
	public function get_wishlist_products_by_uid($user_id){
		
		$this->db->select('w.product_id');
		$this->db->from('wishlist w');
		//$this->db->join('category c', 'pc.category_id = c.cat_id');
		$this->db->where('w.user_id', $user_id);
		$query = $this->db->get();
		$result = $query->result_array();
		
		foreach($result as $key=>$results){
			$productid = $results['product_id'];
			if($productid > 0){
				$this->db->select('*');
				$this->db->from('product');
				//$this->db->join('category c', 'pc.category_id = c.cat_id');
				$this->db->where('product_id',$productid );
				$res = $this->db->get();
				$re = $res->row();
				$productDetails = $re;
			} else {
				$productDetails = '';
			}
			if($productDetails->brand_id > 0){
				$this->db->select('b.brand_id, b.name as brand_name, b.description as brand_description');
				$this->db->from('brand b');
			 	$this->db->where('b.brand_id',$productDetails->brand_id );
				$res_brand = $this->db->get();
			    $re_brand = $res_brand->row();
				
				$brandDetails = $re_brand;
			} else {
				$brandDetails = '';
			}
			
			$this->db->select('*');
			$this->db->from('product_gallery_image');
			$this->db->where('product_id', $productid);
			$query = $this->db->get();
			$result_gallery = $query->result_array();
			
			$arrGalleryImages = array();
			if(!empty($result_gallery)) {
			foreach($result_gallery as $k => $res) {
				array_push($arrGalleryImages, $this->config->item('base_url')."uploads/product/" . $res['product_image']);
				}
			}
			
			$attributeDetails = array();
			if($productDetails->product_type == 'variable'){
				$this->db->select('pv.*, pa.name');
				$this->db->from('product_variable_attribute pv');
				$this->db->join('product_attribute pa', 'pv.variation_id = pa.product_attribute_id');
			 	$this->db->where('pv.product_id',$productid );
				$res_attribute = $this->db->get();
			    $re_attribute = $res_attribute->result_array();
				
				$attributeDetails = $re_attribute;
			}
			
			$result[$key]['brand_details'] = $brandDetails;
			$result[$key]['productDetails'] = $productDetails;
			$result[$key]['productcatimg'] = $this->config->item('base_url')."uploads/product/".$productDetails->product_image;
			$result[$key]['gallery_images'] = $arrGalleryImages;  
			$result[$key]['product_attribute'] = $attributeDetails;
		}
		
		
		if(!empty($result)) {
			return $result;
		} else {
			return 'no data found';
		}
	}
	
	public function getaddress_by_userid($user_id)
	{
		$this->db->select('*');
		$this->db->from('user_billing_address');
		$this->db->where('user_id', $user_id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$result = $query->result();
		if (!empty($result)) {
			return $result;
		} else {
			return 'record_not_found';
		}
	}
	
	public function deleteAddress($addressId, $userId)
	{
		$returnedRows    = 0;
		$this->db->where('id', $addressId);
		$this->db->where('user_id', $userId);



		if ($this->db->delete("user_billing_address")) {
			$returnedRows     =    $this->db->affected_rows();
		}
		return $returnedRows;
	}

	public function getReviewData($param = null, $many = FALSE, $order = 'DESC', $order_by = 'review_id')
	{

		$this->db->select('*');

		if ($param != null) {
			$this->db->where($param);
		}

		$this->db->order_by($order_by, $order);

		$query = $this->db->get('product_review');
		//echo $this->db->last_query();die;

		if ($many != TRUE) {
			return $query->row_array();
		} else {
			return $query->result_array();
		}
	}
}