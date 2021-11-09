<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class product_gallery_image extends CI_Controller
{
 function __construct() { 
    parent::__construct();
		if(!$this->session->userdata('is_admin_login')) {
    	redirect('controll_admin');
			exit();
    }
		$this->load->library('form_validation');
		$this->load->library('XLSXWriter');
     $this->load->library('image_lib');
		$this->load->model('product_model');
		$this->load->model('category_model');
		
		$this->load->model('gst_model');

		$this->load->model('common_my_model');

  }
 
  public function list_view() {   

  $product_id=$this->uri->segment(4); 
		
	
		$data['data_list'] = $this->common_my_model->common($table_name ='product_gallery_image', $field = array(), $where = array('product_id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	//	$data['category_list'] = $this->common_my_model->common($table_name ='product', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		// print_r($data['products']);exit;
 
		$this->load->view('controll_admin/product/product_gallery_image/product_gallery_image_list', $data);
	}

	 public function add_view() {    
		
		
		// $data['products'] = $this->common_my_model->common($table_name ='product', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

   // $data['category_list'] = $this->common_my_model->common($table_name ='category', $field = array(), $where = array('status'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
 
   

	//	$data['brand_list'] = $this->common_my_model->common($table_name ='brand', $field = array(), $where = array('status'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
 
		$this->load->view('controll_admin/product/product_gallery_image/product_gallery_image_add_view');
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



	function add_submit()
	{
		 
           
             $product_id=$this->input->post('hidden_product_id');

            $attribute_id = $this->input->post('attribute_id');
            $variation_id = $this->input->post('variation_id');
             $product_price = $this->input->post('product_price');

  

           
            $added_date=date('Y-m-d H:i:s');

              $image=NULL;

         if(@$_FILES['product_image']['name']!="")
        {
            $new_name1 = str_replace(".", "", microtime());
            $new_name = str_replace(" ", "_", $new_name1);
            $file_tmp = $_FILES['product_image']['tmp_name'];
            $file = $_FILES['product_image']['name'];
            $ext = substr(strrchr($file, '.'), 1);
            if ($ext == "png" || $ext == "jpg" || $ext == "jpeg" || $ext == "webp")
            {
                move_uploaded_file($file_tmp, "./uploads/product/" . $new_name . "." . $ext);
                
                $image = $new_name . "." . $ext;


                  $img_config_4['image_library'] = 'gd2';
                $img_config_4['source_image'] = './uploads/product/' . $image;
                $img_config_4['create_thumb'] = FALSE;
                $img_config_4['maintain_ratio'] = FALSE;
                $img_config_4['width']  = 600;
                $img_config_4['height'] = 600;
                $img_config_4['new_image'] ='./uploads/product/large/' . $image; 
                $this->image_lib->initialize($img_config_4);
                $this->image_lib->resize();
                
                $this->image_lib->clear();

                $img_config_4['image_library'] = 'gd2';
                $img_config_4['source_image'] = './uploads/product/' . $image;
                $img_config_4['create_thumb'] = FALSE;
                $img_config_4['maintain_ratio'] = FALSE;
                $img_config_4['width']  = 300;
                $img_config_4['height'] = 300;
                $img_config_4['new_image'] ='./uploads/product/small/' . $image; 
                $this->image_lib->initialize($img_config_4);
                $this->image_lib->resize();
                
                $this->image_lib->clear();


             



            
            }
        }

            
      

                	$product_variable_attribute = array(

                                             'product_id'=>$product_id,
                                            'product_image'=>$image

                                                                                                
                                            );

               // $this->db->where('blog_id',$edit_id);
               // $this->db->update('product_variable_attribute',$product_variable_attribute);
                $this->db->insert('product_gallery_image',$product_variable_attribute);


                


                 






		    $this->session->set_flashdata('succ_add','Successfully added');
		    redirect(base_url().BaseAdminURl.'/product_gallery_image/list_view/'.$product_id);
	}


   public function edit_view() {
   $product_image_id=$this->uri->segment(4); 

    $product_id=$this->uri->segment(5);   
    
    
    // $data['products'] = $this->common_my_model->common($table_name ='product', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
   //$data['category_list'] = $this->common_my_model->common($table_name ='category', $field = array(), $where = array('status'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

  //  $data['brand_list'] = $this->common_my_model->common($table_name ='brand', $field = array(), $where = array('status'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

     $data['edited_details'] = $this->common_my_model->common($table_name ='product_gallery_image', $field = array(), $where = array('product_image_id'=>$product_image_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
 
    $this->load->view('controll_admin/product/product_gallery_image/product_gallery_image_edit_view',$data);
  }

  function edit_submit()
  {
     
         //  $product_id= $this->input->post('edited_product_id');

         //  echo $product_id;exit;

        $product_image_id=$this->input->post('hidden_product_image_id'); 

           
           
             $product_id=$this->input->post('hidden_product_id');

            
               $old_pic=$this->input->post('old_pic');

         $image=NULL;

         if(@$_FILES['product_image']['name']!="")
        {
            $new_name1 = str_replace(".", "", microtime());
            $new_name = str_replace(" ", "_", $new_name1);
            $file_tmp = $_FILES['product_image']['tmp_name'];
            $file = $_FILES['product_image']['name'];
            $ext = substr(strrchr($file, '.'), 1);
            if ($ext == "png" || $ext == "jpg" || $ext == "jpeg" || $ext == "webp")
            {
                move_uploaded_file($file_tmp, "./uploads/product/" . $new_name . "." . $ext);
                
                $image = $new_name . "." . $ext;


                 $img_config_4['image_library'] = 'gd2';
                $img_config_4['source_image'] = './uploads/product/' . $image;
                $img_config_4['create_thumb'] = FALSE;
                $img_config_4['maintain_ratio'] = FALSE;
                $img_config_4['width']  = 600;
                $img_config_4['height'] = 600;
                $img_config_4['new_image'] ='./uploads/product/large/' . $image; 
                $this->image_lib->initialize($img_config_4);
                $this->image_lib->resize();
                
                $this->image_lib->clear();

                $img_config_4['image_library'] = 'gd2';
                $img_config_4['source_image'] = './uploads/product/' . $image;
                $img_config_4['create_thumb'] = FALSE;
                $img_config_4['maintain_ratio'] = FALSE;
                $img_config_4['width']  = 300;
                $img_config_4['height'] = 300;
                $img_config_4['new_image'] ='./uploads/product/small/' . $image; 
                $this->image_lib->initialize($img_config_4);
                $this->image_lib->resize();
                
                $this->image_lib->clear();


             



            
            }
              @unlink('./uploads/product/'.@$old_pic);
              @unlink('./uploads/product/large/'.@$old_pic);
              @unlink('./uploads/product/small/'.@$old_pic);

        }else{
          $image=$old_pic;
        }



  

           
            $added_date=date('Y-m-d H:i:s');
            
      

                  $product_variable_attribute = array(

                                             'product_id'=>$product_id,
                                            'product_image'=>$image

                                                                                                
                                            );

                $this->db->where('product_image_id',$product_image_id);
                $this->db->update('product_gallery_image',$product_variable_attribute);
                


                


                 






        $this->session->set_flashdata('succ_add','Successfully Edited');
        redirect(base_url().BaseAdminURl.'/product_gallery_image/list_view/'.$product_id);
  }

  public function change_status($id, $status){

  //  echo $id;exit;

    $data = array(
               'status' => $status
            );
    
    $this->db->where('product_id', $id);
    $query = $this->db->update('product', $data); 
    if($query){
       $this->session->set_flashdata('succ_msg', 'Status changed successfully !!!!');
      redirect(base_url().'controll_admin/product');
      exit();
    }
    
  }

  public function delete($product_image_id,$product_id){

  //  echo $id;exit;

    $product_image_details = $this->common_my_model->common($table_name ='product_gallery_image', $field = array(), $where = array('product_image_id'=>$product_image_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
    @unlink('./uploads/product/'.@$product_image_details[0]->product_image);
     @unlink('./uploads/product/large/'.@$product_image_details[0]->product_image);
    @unlink('./uploads/product/small/'.@$product_image_details[0]->product_image);

     $this->db->where('product_image_id',$product_image_id);
       $this->db->delete('product_gallery_image');
      $this->session->set_flashdata('succ_msg', 'Product Image deleted successfully !!!!');
     redirect(base_url().BaseAdminURl.'/product_gallery_image/list_view/'.$product_id);
      exit();
    
    
  }



	
	
}