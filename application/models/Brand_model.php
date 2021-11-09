<?php 
class Brand_model extends CI_Model {

	public function __construct() {
	// Call the CI_Model constructor
		parent::__construct();
			}		


	public function add_brand($data) {
		
		if($this->db->insert('brand', $data)){		
			return $this->db->insert_id();
		} else {
			return false;	
		}
	}
	public function edit_brand($id, $data) {
		//echo '<pre>';print_r($data);die;
		$this->db->where('brand_id', $id);
		if($this->db->update('brand', $data)){			
			return $id;
		} else {
			return false;	
		}
	}
	public function brand_list() {	
			$this->db->select('*');
		$this->db->from('brand');
		$query = $this->db->get();
		// $result = $query->result();

   // $query = $this->db->get_where('brand',array('brand_id =' => '0'));
    $return = array();

    foreach ($query->result() as $brand)
    {
        $return[$brand->brand_id] = $brand;
       // $return[$brand->brand_id]->subs = $this->get_sub_categories($brand->brand_id); // Get the categories sub categories
    }

    return $return;
	}



 /*public function get_sub_categories($category_id)
		{
		    $this->db->where('parent_id', $category_id);
		    $query = $this->db->get('category');
		    return $query->result();
		}*/



         public function duplicate_brand_name_chk($name) {	
			$this->db->select('*');
		$this->db->from('brand');
		$this->db->where('name',$name);
		$query = $this->db->get();
       return $query->result();
	   }


	public function brand_details_by_id($id){
		
		$this->db->select('*');
		$this->db->from('brand');
		
		$this->db->where(array('brand_id'=>$id));
		$query = $this->db->get();
		$result = $query->result();
		if(!empty($result)){			
			
			
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
	public function active_brand_list() {		
		$query = $this->db->order_by("brand_priority","asc")->get_where('brand', array('status' =>'1'));
		
		$this->db->order_by("brand_priority","desc");
		$result = $query->result();
		if(!empty($result)){			
			return $result;
		} else {
			return false;	
		}
	}





	public function product_details_by_unique($id){
	
		$this->db->select('pm.*');
		$this->db->from('product_management pm');
		
		$this->db->where(array('pm.unique_key'=>$id));
		$query = $this->db->get();
		$result = $query->result();
		if(!empty($result)){			
			
			
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
	
	public function get_product_section($id){
		
		$query = $this->db->get_where('product_link_management', array('product_id' => $id));
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
		
		$this->db->where('brand_id', $id);
		$query = $this->db->update('brand', $data); 
		if($query){
			return true;	
		}else{
			return false;	
		}	

	}
	
	public function modify_product_link($data) {
	$trnID = $data['product_link_id'];
			unset($data['product_link_id']);
			$this->db->where('product_link_id', $trnID);
			$this->db->update('product_link_management',$data);
	}
 	 public function delete_link($link_id){
		
	
		$this->db->where('product_link_id', $link_id);
						$query = $this->db->delete('product_link_management');		
						if($query){
							return true;	
						}else{
							return false;	
						}	
	
		
	}
public function delete_category($id) {
	$this->db->where('brand_id', $id);
	$query = $this->db->delete('brand');		
						if($query){
							return true;	
						}else{
							return false;	
						}	
		
	}
	
	public function update_product_link($pid,$section=array())
		{	
			
			 foreach($section as $S)
			 {
				 $section_data  =array();
				 $section_data['product_link_title'] = $S['link_title'];
				 $section_data['product_link_subtitle'] = $S['link_subtitle'];
				 $section_data['product_link_href'] = $S['link_link'];
				 
				 $section_data['product_id'] = $pid;
				 
				// var_dump($not);
			$this->db->insert('product_link_management',$section_data);
			 
			 }
		}
		
	public function is_product($id){
		
		
		$query = $this->db->get_where('product_management', array('product_id' => $id));
		return $query->num_rows();

	}
	
	public function product_list_latest(){
		
		$query = $this->db->get_where('product_management', array('status' => '1'));
		$this->db->order_by("product_id", "desc");
		$result = $query->result();
		
		if(!empty($result)){
			
			foreach($result as $R)
			{
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
	
	public function get_product_converted_value($product_id,$key){
		
		 if (!$this->session->userdata('is_language')) {
		 
		 $title_key_val = 'product_title_eng';
		 $des_key_val = 'product_des_eng';
	 }
	 else
	 {
		 $language = $this->session->userdata('is_language');  
		 $title_key_val = 'product_title_'.$language['language'];
		 $des_key_val = 'product_des_'.$language['language'];
		      
	 }
	
		$query = $this->db->get_where('product_management', array('product_id' => $product_id));
		
		$result = $query->result();
		
		if(!empty($result)){
			
			$R = $result[0];
			$query1 = $this->db->get_where('product_link_management', array('product_id' => $R->product_id));
			$result1 = $query1->result();	
			if($R->{$title_key_val}=='')
							{
							$R->converted_title	 = $R->product_title_eng;
							$R->converted_des	 = $R->product_des_eng;
							}
							else
							{
							$R->converted_title	=  $R->{$title_key_val};
							$R->converted_des	 = $R->{$des_key_val};
							}
							
							$R->converted_price =  $R->product_price_inr;
		
			return $R->{'converted_'.$key};
		} else {
			return false;	
		}
	}	
}