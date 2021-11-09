<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Brand extends CI_Controller
{
 function __construct() { 
    parent::__construct();
		if(!$this->session->userdata('is_admin_login')) {
    	redirect('controll_admin');
			exit();
    }
		$this->load->library('form_validation');
		//$this->load->model('product_model');
		$this->load->model('brand_model');
		//$this->load->model('product_category_model');

  }
 
  public function index() {   

		$data = array();
		$data['brand'] = $this->brand_model->brand_list();		

		$this->load->view('controll_admin/brand_list', $data);
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
		
			$this->form_validation->set_rules('brand_name', 'Brand Name', 'required|min_length[2]');
			
			$this->form_validation->set_rules('brand_description', 'Brand Description', 'required');
			
				

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
				
				$data['name'] = $this->input->post('brand_name');
				$data['description'] = $this->input->post('brand_description');
				$data['status'] = $this->input->post('brand_status');
				$data['unique_name'] = $this->input->post('unique_name');
				//$data['image'] = $_FILES['category_image']['name'];
				// $data['parent_id'] = $this->input->post('brand_level');


				
         

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
					$data['brand_image'] = $image;
				}	





				if($id > 0){

						if($last_id = $this->brand_model->edit_brand($id, $data)){
							$this->session->set_flashdata('succ_msg', 'Brand updated successfully !!!!');
						}else{
							$this->session->set_flashdata('error_msg', $this->db->_error_message());
						}
				}else{
					/*echo 'here';
					var_dump($data);exit;*/
					$duplicate_brand_name_chk= $this->brand_model->duplicate_brand_name_chk($this->input->post('brand_name'));
				if(count($duplicate_brand_name_chk)==0){


						if($last_id = $this->brand_model->add_brand($data)){

							$this->session->set_flashdata('succ_msg', 'Brand added successfully !!!!');
						}else{
							$this->session->set_flashdata('error_msg', $this->db->_error_message());
						}


						}else{	
				          $this->session->set_flashdata('error_msg', 'Duplicate Brand Name');	
			             }



				}

				
        redirect(base_url().'controll_admin/brand');



			}

		}
	
			if($id > 0){
					$data['brand_details'] = $this->brand_model->brand_details_by_id($id);
				}
					

    $data['brand'] = $this->brand_model->brand_list();

    
		$this->load->view('controll_admin/brand_list',$data);
		
	}

	

	
	public function change_status($id, $status){
		
		if($this->brand_model->change_status($id, $status)){
			$this->session->set_flashdata('succ_msg', 'Status changed successfully !!!!');
			redirect(base_url().'controll_admin/brand');
			exit();
		}
		
	}
	
	public function ajax_change() {}
	
	public function delete($id){
		
		if($this->brand_model->delete_category($id)){
			$this->session->set_flashdata('succ_msg', 'Brand deleted successfully !!!!');
			redirect(base_url().'controll_admin/brand');
			exit();
		}
		
	}


	
	
}