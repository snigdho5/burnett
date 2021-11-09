<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Seo_module extends CI_Controller
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
		
	
		$data['seo_module_list'] = $this->common_my_model->common($table_name ='seo_module', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	//	$data['category_list'] = $this->common_my_model->common($table_name ='product', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		// print_r($data['products']);exit;
 
		$this->load->view('controll_admin/seo_module/seo_module_list', $data);
	}

	 public function add_view() {    
		
	
 
		$this->load->view('controll_admin/seo_module/seo_module_add_view');
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
		           
             $title = $this->input->post('title');
            
            $description = $this->input->post('description');
            $meta_title  = $this->input->post('meta_title');
            $meta_keyword = $this->input->post('meta_keyword');
            $meta_description = $this->input->post('meta_description');
            $status = $this->input->post('status');
            $date_added=date('Y-m-d H:i:s');

            

            
                       $insert_data= array( 

                                'title'=>$title,
                                'description'=>$description,
                                'meta_title '=>$meta_title,
                                'meta_keyword'=>$meta_keyword,
                                'meta_description'=>$meta_description,
                                'status'=>$status,
                                'added_by'=>$this->session->userdata('is_admin_login'),
                                
                                'added_date'=>$date_added
                                
                               
                               );

		  
		    $this->db->insert('seo_module', $insert_data);


		    $this->session->set_flashdata('succ_add','Successfully added');
		    redirect(base_url().BaseAdminURl.'/seo_module');
	}


   public function edit_view() {
   $seo_module_id=$this->uri->segment(4);    
    
 

     $data['edited_details'] = $this->common_my_model->common($table_name ='seo_module', $field = array(), $where = array('seo_module_id'=>$seo_module_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
     
 
    $this->load->view('controll_admin/seo_module/seo_module_edit_view',$data);
  }

  function data_edit_submit()
  {
            $seo_module_id = $this->input->post('seo_module_id');
            $title = $this->input->post('title');
            
            $description = $this->input->post('description');
            $meta_title  = $this->input->post('meta_title');
            $meta_keyword = $this->input->post('meta_keyword');
            $meta_description = $this->input->post('meta_description');
            $status = $this->input->post('status');
            $date_added=date('Y-m-d H:i:s');

            

            
                       $insert_data= array( 

                                'title'=>$title,
                                'description'=>$description,
                                'meta_title '=>$meta_title,
                                'meta_keyword'=>$meta_keyword,
                                'meta_description'=>$meta_description,
                                'status'=>$status,
                                'added_by'=>$this->session->userdata('is_admin_login'),
                                
                                'added_date'=>$date_added
                                
                               
                               );

        $this->db->where('seo_module_id',$seo_module_id);
        $this->db->update('seo_module',$insert_data);
     


        $this->session->set_flashdata('succ_add','Successfully edited');
        redirect(base_url().BaseAdminURl.'/seo_module');
  }

  public function change_status($id, $status){

  //  echo $id;exit;

    $data = array(
               'status' => $status
            );
    
    $this->db->where('seo_module_id', $id);
    $query = $this->db->update('seo_module', $data); 
    if($query){
       $this->session->set_flashdata('succ_msg', 'Status changed successfully !!!!');
      redirect(base_url().'controll_admin/seo_module');
      exit();
    }
    
  }

  public function delete($id){



$product_image_details = $this->common_my_model->common($table_name ='blog', $field = array(), $where = array('blog_id'=>$id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    @unlink('./uploads/blog/'.@$product_image_details[0]->image);
    @unlink('./uploads/blog/large/'.@$product_image_details[0]->image);
    @unlink('./uploads/blog/small/'.@$product_image_details[0]->image);
 
       
        $this->db->where('seo_module_id',$id);
        $this->db->delete('seo_module');


      $this->session->set_flashdata('succ_msg', 'seo deleted successfully !!!!');
      redirect(base_url().'controll_admin/seo_module');
      exit();
    
    
  }



	
	
}