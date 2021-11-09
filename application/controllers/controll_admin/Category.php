<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Category extends CI_Controller
{
 function __construct() { 
    parent::__construct();
		if(!$this->session->userdata('is_admin_login')) {
    	redirect('controll_admin');
			exit();
    }
		$this->load->library('form_validation');
		//$this->load->model('product_model');
		$this->load->model('category_model');
		//$this->load->model('product_category_model');

  }
 
  public function index() {   

		$data = array();
		$data['category'] = $this->category_model->category_list();		

		$this->load->view('controll_admin/category_list', $data);
	}





public function filemain_image_check() {
    
    
    $number_of_files = sizeof($_FILES['main_image']['tmp_name']);
    
    $files = $_FILES['main_image'];

   
    for($i=0;$i<$number_of_files;$i++)
    {
      if($_FILES['main_image']['error'][$i] != 0)
      {
        // save the error message and return false, the validation of uploaded files failed
        $this->form_validation->set_message('filemain_image_check', 'Couldn\'t upload the file(s)');
        return FALSE;
      }
    }
    
    // we first load the upload library
    $this->load->library('upload');
    // next we pass the upload path for the images
    $config['upload_path'] = 'uploads/';
		
    // also, we make sure we allow only certain type of images
    $config['allowed_types'] = 'gif|jpg|png';

    // now, taking into account that there can be more than one file, for each file we will have to do the upload
    for ($i = 0; $i < $number_of_files; $i++)
    {
      $_FILES['main_image']['name'] = time().rand(1000,9999999999).$files['name'][$i];
      $_FILES['main_image']['type'] = $files['type'][$i];
      $_FILES['main_image']['tmp_name'] = $files['tmp_name'][$i];
      $_FILES['main_image']['error'] = $files['error'][$i];
      $_FILES['main_image']['size'] = $files['size'][$i];
      
      //now we initialize the upload library
      $this->upload->initialize($config);
      if ($this->upload->do_upload('main_image'))
      {
        $this->_uploaded_main_image[$i] = $this->upload->data();
      }
      else
      {
        $this->form_validation->set_message('filemain_image_check', $this->upload->display_errors());
        return FALSE;
      }
    }
    return TRUE;
  }




	
	public function add_edit() {
		
	 $id = $this->uri->segment(4);

	  $data = array();

		if($this->input->post()){
		
			$this->form_validation->set_rules('category_name', 'Category Name', 'required|min_length[2]');
			
			$this->form_validation->set_rules('category_description', 'Category Description', 'required');
			
				

//suman start

    if($_FILES['main_image']['name'][0] =='' && $id > 0){
						
			}else{
				
				$this->form_validation->set_rules('main_image[]','Upload images','callback_filemain_image_check');	
			}	

//suman end

				/*
Array
(
    [entry_value] => addnew_val
    [category_name] => test
    [unique_name] => test21212
    [category_level] => 1
    [category_description] => fdfdsfsfsdfsfdsfsdfsfdsdfs
    [category_status] => 1
)

Array ( [category_image] => Array ( [name] => facebook_icon.png [type] => image/png [tmp_name] => D:\wamp64\tmp\php4E7C.tmp [error] => 0 [size] => 1153 ) ) 
				*/




			if($this->form_validation->run() == TRUE){
				
				$data['name'] = $this->input->post('category_name');
				$data['description'] = $this->input->post('category_description');
				$data['status'] = $this->input->post('category_status');
				$data['unique_name'] = $this->input->post('unique_name');
				//$data['image'] = $_FILES['category_image']['name'];
				$data['parent_id'] = $this->input->post('category_level');

				$data['meta_title'] = $this->input->post('meta_title');
				$data['meta_keyword'] = $this->input->post('meta_keyword');
				$data['meta_description'] = $this->input->post('meta_description');
         

				if($data['unique_name'] == ''){
					$data['unique_name'] = strtolower(str_replace(' ','-',$data['name']));
				}
				/*if($id == ''){			
					$data['date_added'] = date('Y-m-d H:i:s');
					$data['uploadedimages'] = $this->_uploaded;
					
				}*/

	     $mainimages = $this->_uploaded_main_image;
				$image = $mainimages[0]['file_name'];	
				
				if($image != ''){
					$data['category_image'] = $image;
				}	





				if($id > 0){

						if($last_id = $this->category_model->edit_category($id, $data)){
							$this->session->set_flashdata('succ_msg', 'Category updated successfully !!!!');
						}else{
							$this->session->set_flashdata('error_msg', $this->db->_error_message());
						}
				}else{
					/*echo 'here';
					var_dump($data);exit;*/
						if($last_id = $this->category_model->add_category($data)){

							$this->session->set_flashdata('succ_msg', 'Category added successfully !!!!');
						}else{
							$this->session->set_flashdata('error_msg', $this->db->_error_message());
						}
				}			
        redirect(base_url().'controll_admin/category');

			}

		}
	
			if($id > 0){
					$data['category_details'] = $this->category_model->category_details_by_id($id);
				}
					

    $data['category'] = $this->category_model->category_list();

    
		$this->load->view('controll_admin/category_list',$data);
		
	}

	

	
	public function change_status($id, $status){
		
		if($this->category_model->change_status($id, $status)){
			$this->session->set_flashdata('succ_msg', 'Status changed successfully !!!!');
			redirect(base_url().'controll_admin/category');
			exit();
		}
		
	}
	
	public function ajax_change() {}
	
	public function delete($id){
		
		if($this->category_model->delete_category($id)){
			$this->session->set_flashdata('succ_msg', 'Category deleted successfully !!!!');
			redirect(base_url().'controll_admin/category');
			exit();
		}
		
	}


	
	
}