<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Wishlist extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();
           $this->load->model('common_my_model');

	}
	
	

public function add_to_wishlist()
  {



    $product_id=$this->input->post('product_id');

    $user_id = $this->input->post('user_id');

   
    $date=date('Y-m-d H:i:s');

    $product_details=$this->common_my_model->common($table_name = 'product', $field = array(), $where = array('product_id'=>$product_id,'status'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


   // echo $blog_id; exit;

if($user_id){

  



    $data=array(
                
                'user_id'=>$user_id,
                'date_added'=>$date,
                'product_id'=>$product_id,

                );



$count_wishlist = $this->common_my_model->common($table_name = 'wishlist', $field = array(), $where = array('user_id'=>$user_id,'product_id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

if(count($count_wishlist)==0)
{

//echo '<pre>';print_r($data);exit;
	 $this->db->insert('wishlist',$data);
  

 }
 else{
$this->db->where('product_id',$product_id);
$this->db->where('user_id',$user_id);
 $this->db->update('wishlist',$data);
   

 }
}




  echo json_encode(array('status'=>'success','message'=>'Product added to wishlist.'));

	
}

	


	
}
?>