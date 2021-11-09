<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Coupon extends CI_Controller
{
 function __construct() { 
    parent::__construct();
		if(!$this->session->userdata('is_admin_login')) {
    	redirect('controll_admin');
			exit();
    }
		$this->load->library('form_validation');
		$this->load->library('XLSXWriter');
		$this->load->model('product_model');
		$this->load->model('category_model');
    $this->load->library('image_lib');
		
		$this->load->model('gst_model');

		$this->load->model('common_my_model');

  }
 
  public function index() {    
		
	
		$data['coupons'] = $this->common_my_model->common($table_name ='coupon', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	//	$data['category_list'] = $this->common_my_model->common($table_name ='product', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		// print_r($data['products']);exit;
 
		$this->load->view('controll_admin/coupon/coupon_list', $data);
	}

	 public function add_view() {    
		
	
 
		$this->load->view('controll_admin/coupon/coupon_add_view');
	}

	


    function create_slug($string)
    {     
          $replace = '-';         
          $string = strtolower($string);     
 
          //replace / and . with white space     
          $string = preg_replace("/[\/\.]/", " ", $string);     
          $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);     
 
          //remove multiple dashes or whitespaces     
          $string = preg_replace("/[\s-]+/", " ", $string);     
 
          //convert whitespaces and underscore to $replace     
          $string = preg_replace("/[\s_]/", $replace, $string);     
 
          //limit the slug size     
          $string = substr($string, 0, 100);     
 
          //slug is generated     
          return $string; 
    }



	function data_add_submit()
	{
		           
            $coupon_headline = $this->input->post('coupon_headline');
            $coupon_code = $this->input->post('coupon_code');
            $coupon_amount = $this->input->post('coupon_amount');
            $coupon_discount_type = $this->input->post('coupon_discount_type');
            $coupon_discount = $this->input->post('coupon_discount');
            $coupon_end  = $this->input->post('coupon_end');
            $total_use = $this->input->post('total_use');
            $status = $this->input->post('status');
            $date_added=date('Y-m-d H:i:s');

          //  echo $coupon_end;exit;
            


            
		    $insert_data= array( 

		    					             'coupon_headline'=>$coupon_headline,
                                'coupon_code' =>$coupon_code,
                                'coupon_amount'=>$coupon_amount,
                                'coupon_discount_type'=>$coupon_discount_type,
                                'coupon_discount'=>$coupon_discount,
                                'coupon_end '=>$coupon_end,
                                'total_use'=>$total_use,
                                'status'=>$status,
                                
                                'date_added'=>$date_added
                                
                               
                               );

		  
		    $this->db->insert('coupon', $insert_data);


		    $this->session->set_flashdata('succ_add','Successfully added');
		    redirect(base_url().BaseAdminURl.'/coupon');
	}


   public function edit_view() {
   $coupon_id=$this->uri->segment(4);    
    
 

     $data['edited_details'] = $this->common_my_model->common($table_name ='coupon', $field = array(), $where = array('coupon_id'=>$coupon_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
 
    $this->load->view('controll_admin/coupon/coupon_edit_view',$data);
  }

  function data_edit_submit()
  {
     
           $coupon_id= $this->input->post('edited_coupon_id');

         



            
          $coupon_headline = $this->input->post('coupon_headline');
            $coupon_code = $this->input->post('coupon_code');
            $coupon_amount = $this->input->post('coupon_amount');
            $coupon_discount_type = $this->input->post('coupon_discount_type');
            $coupon_discount = $this->input->post('coupon_discount');
            $coupon_end  = $this->input->post('coupon_end');
            $total_use = $this->input->post('total_use');
            $status = $this->input->post('status');
            $date_added=date('Y-m-d H:i:s');
            


            
        $insert_data= array( 

                               'coupon_headline'=>$coupon_headline,
                                'coupon_code' =>$coupon_code,
                                'coupon_amount'=>$coupon_amount,
                                'coupon_discount_type'=>$coupon_discount_type,
                                'coupon_discount'=>$coupon_discount,
                                'coupon_end '=>$coupon_end,
                                'total_use'=>$total_use,
                                'status'=>$status,
                                
                                'date_added'=>$date_added
                                
                               
                               );
      
       // $this->db->insert('product', $insert_data);

        $this->db->where('coupon_id',$coupon_id);
        $this->db->update('coupon',$insert_data);
     


        $this->session->set_flashdata('succ_add','Successfully edited');
        redirect(base_url().BaseAdminURl.'/coupon');
  }

  public function change_status($id, $status){

  //  echo $id;exit;

    $data = array(
               'status' => $status
            );
    
    $this->db->where('coupon_id', $id);
    $query = $this->db->update('coupon', $data); 
    if($query){
       $this->session->set_flashdata('succ_msg', 'Status changed successfully !!!!');
      redirect(base_url().'controll_admin/coupon');
      exit();
    }
    
  }

  public function delete($id){

 
       
        $this->db->where('coupon_id',$id);
        $this->db->delete('coupon');


      $this->session->set_flashdata('succ_msg', 'coupon deleted successfully !!!!');
      redirect(base_url().'controll_admin/coupon');
      exit();
    
    
  }



	
	
}