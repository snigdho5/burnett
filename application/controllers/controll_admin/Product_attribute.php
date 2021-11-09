<?php defined('BASEPATH') or exit('No direct script access allowed');

class Product_attribute extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('is_admin_login')) {
			redirect('controll_admin');
			exit();
		}
		$this->load->library('form_validation');
		//$this->load->model('product_model');
		$this->load->model('product_attribute_model');
		//$this->load->model('product_category_model');

	}

	public function index()
	{

		$data = array();
		$data['product_attribute'] = $this->product_attribute_model->product_attribute_list();

		$param_unit = array('status' => 1);
		$data['product_units'] = $this->product_attribute_model->product_units_list($param_unit);

		$this->load->view('controll_admin/product_attribute_list', $data);
	}





	public function filemain_image_check()
	{


		$number_of_files = sizeof($_FILES['main_image']['tmp_name']);

		$files = $_FILES['main_image'];


		for ($i = 0; $i < $number_of_files; $i++) {
			if ($_FILES['main_image']['error'][$i] != 0) {
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
		for ($i = 0; $i < $number_of_files; $i++) {
			$_FILES['main_image']['name'] = time() . rand(1000, 9999999999) . $files['name'][$i];
			$_FILES['main_image']['type'] = $files['type'][$i];
			$_FILES['main_image']['tmp_name'] = $files['tmp_name'][$i];
			$_FILES['main_image']['error'] = $files['error'][$i];
			$_FILES['main_image']['size'] = $files['size'][$i];

			//now we initialize the upload library
			$this->upload->initialize($config);
			if ($this->upload->do_upload('main_image')) {
				$this->_uploaded_main_image[$i] = $this->upload->data();
			} else {
				$this->form_validation->set_message('filemain_image_check', $this->upload->display_errors());
				return FALSE;
			}
		}
		return TRUE;
	}





	public function add_edit()
	{

		$id = $this->uri->segment(4);

		$data = array();

		if ($this->input->post()) {

			$this->form_validation->set_rules('product_attribute_name', 'Attribute Name', 'required|min_length[2]');

			$this->form_validation->set_rules('product_attribute_description', 'Attribute Description', 'required');
			$this->form_validation->set_rules('product_attribute_status', 'Attribute Status', 'required');
			$this->form_validation->set_rules('variation', 'Unit', 'required');



			//suman start

			// if($_FILES['main_image']['name'][0] =='' && $id > 0){

			// 		}else{

			// 			$this->form_validation->set_rules('main_image[]','Upload images','callback_filemain_image_check');	
			// 		}	

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




			if ($this->form_validation->run() == TRUE) {

				$data['name'] = $this->input->post('product_attribute_name');
				$data['description'] = $this->input->post('product_attribute_description');
				$data['status'] = $this->input->post('product_attribute_status');
				$data['unique_name'] = $this->input->post('unique_name');
				//$data['image'] = $_FILES['category_image']['name'];
				$data['variation'] = $this->input->post('variation');


				if ($data['unique_name'] == '') {
					$data['unique_name'] = strtolower(str_replace(' ', '-', $data['name']));
				}
				/*if($id == ''){			
					$data['date_added'] = date('Y-m-d H:i:s');
					$data['uploadedimages'] = $this->_uploaded;
					
				}*/

				//snigdho

				if(isset($_FILES['main_image']['name'][0])){
				   
					$mainimages = $this->_uploaded_main_image;
						   $image = $mainimages[0]['file_name'];	
						   
						   if($image != ''){
							   $data['product_attribute_image'] = $image;
						   }	
			
				   }





				if ($id > 0) {

					if ($last_id = $this->product_attribute_model->edit_product_attribute($id, $data)) {
						$this->session->set_flashdata('succ_msg', 'Attribute updated successfully !!!!');
					} else {
						$this->session->set_flashdata('error_msg', $this->db->_error_message());
					}
				} else {
					/*echo 'here';
					var_dump($data);exit;*/
					if ($last_id = $this->product_attribute_model->add_product_attribute($data)) {

						$this->session->set_flashdata('succ_msg', 'Attribute added successfully !!!!');
					} else {
						$this->session->set_flashdata('error_msg', $this->db->_error_message());
					}
				}
				redirect(base_url() . 'controll_admin/product_attribute');
			}
		}

		if ($id > 0) {
			$data['product_attribute_details'] = $this->product_attribute_model->product_attribute_details_by_id($id);
		}


		$data['product_attribute'] = $this->product_attribute_model->product_attribute_list();

		$param_unit = array('status' => 1);
		$data['product_units'] = $this->product_attribute_model->product_units_list($param_unit);


		$this->load->view('controll_admin/product_attribute_list', $data);
	}




	public function change_status($id, $status)
	{

		if ($this->product_attribute_model->change_status($id, $status)) {
			$this->session->set_flashdata('succ_msg', 'Status changed successfully !!!!');
			redirect(base_url() . 'controll_admin/product_attribute');
			exit();
		}
	}

	public function ajax_change()
	{
	}

	public function delete($id)
	{

		if ($this->product_attribute_model->delete_product_attribute($id)) {
			$this->session->set_flashdata('succ_msg', 'Attribute deleted successfully !!!!');
			redirect(base_url() . 'controll_admin/product_attribute');
			exit();
		}
	}

	public function unit_add_edit()
	{

				//snigdho
		$id = $this->uri->segment(4);

		$data = array();

		if ($this->input->post()) {

			$this->form_validation->set_rules('unit_name', 'Unit Name', 'required|min_length[2]');

			$this->form_validation->set_rules('unit_status', 'Unit Status', 'required');

			if ($this->form_validation->run() == TRUE) {

				$data['name'] = $this->input->post('unit_name');
				$data['status'] = $this->input->post('unit_status');
				$data['created_dtime'] = DTIME;

				// $param_unit = array('name' => $data['name']);
				// $unit_exists = $this->product_attribute_model->product_units_list($param_unit);


				if ($id > 0) {

					if ($last_id = $this->product_attribute_model->edit_unit($id, $data)) {
						$this->session->set_flashdata('succ_msg', 'Unit updated successfully !!!!');
					} else {
						$this->session->set_flashdata('error_msg', $this->db->_error_message());
					}
				} else {
					/*echo 'here';
					var_dump($data);exit;*/
					if ($last_id = $this->product_attribute_model->add_unit($data)) {

						$this->session->set_flashdata('succ_msg', 'Unit added successfully !!!!');
					} else {
						$this->session->set_flashdata('error_msg', $this->db->_error_message());
					}
				}
				redirect(base_url() . BaseAdminURl . '/product_attribute/unit_add_edit/');
			}
		}

		if ($id > 0) {
			$data['product_unit_details'] = $this->product_attribute_model->product_units_list(array('id' => $id));
		}


		$param_unit = array('status' => 1);
		$data['product_units'] = $this->product_attribute_model->product_units_list($param_unit);


		$this->load->view('controll_admin/unit_list', $data);
	}

	public function delete_unit($id)
	{

		if ($this->product_attribute_model->delete_unit($id)) {
			$this->session->set_flashdata('succ_msg', 'Unit deleted successfully !!!!');
			redirect(base_url() . 'controll_admin/product_attribute/unit_add_edit');
			exit();
		}
	}
}
