<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Gst extends CI_Controller
{
 function __construct() { 
    parent::__construct();
		if(!$this->session->userdata('is_admin_login')) {
    	redirect('controll_admin');
			exit();
    }
		$this->load->library('form_validation');
		//$this->load->model('product_model');
		$this->load->model('gst_model');
		//$this->load->model('product_gst_model');

  }
 
  public function index() {   

		$data = array();
		$data['gst'] = $this->gst_model->gst_list();				
		$this->load->view('controll_admin/gst_list', $data);
	}



	
	public function add_edit() {
		
	 $id = $this->uri->segment(4);

	  $data = array();

		if($this->input->post()){
		
			$this->form_validation->set_rules('gst_name', 'Gst Name', 'required|min_length[2]');
			
			$this->form_validation->set_rules('gst_description', 'Gst Description', 'required');
			
					
			
			if($this->form_validation->run() == TRUE){
				
				$data['name'] = $this->input->post('gst_name');
				$data['description'] = $this->input->post('gst_description');
				$data['status'] = $this->input->post('gst_status');
				$data['cgst'] = $this->input->post('cgst');
				$data['sgst'] = $this->input->post('sgst');
				
				/*if($id == ''){			
					$data['date_added'] = date('Y-m-d H:i:s');
					$data['uploadedimages'] = $this->_uploaded;
					
				}*/

				if($id > 0){

						if($last_id = $this->gst_model->edit_gst($id, $data)){
							$this->session->set_flashdata('succ_msg', 'Gst updated successfully !!!!');
						}else{
							$this->session->set_flashdata('error_msg', $this->db->_error_message());
						}
				}else{
					/*echo 'here';
					var_dump($data);exit;*/
						if($last_id = $this->gst_model->add_gst($data)){
							$this->session->set_flashdata('succ_msg', 'Gst added successfully !!!!');
						}else{
							$this->session->set_flashdata('error_msg', $this->db->_error_message());
						}
				}			
        redirect(base_url().'controll_admin/gst');

			}

		}
	
			if($id > 0){
					$data['gst_details'] = $this->gst_model->gst_details_by_id($id);
				}
					

    $data['gst'] = $this->gst_model->gst_list();
		$this->load->view('controll_admin/gst_list',$data);
		
	}

	

	
	public function change_status($id, $status){
		
		if($this->gst_model->change_status($id, $status)){
			$this->session->set_flashdata('succ_msg', 'Status changed successfully !!!!');
			redirect(base_url().'controll_admin/gst');
			exit();
		}
		
	}
	
	public function ajax_change() {}
	
	public function delete($id){
		
		if($this->gst_model->delete_gst($id)){
			$this->session->set_flashdata('succ_msg', 'Gst deleted successfully !!!!');
			redirect(base_url().'controll_admin/gst');
			exit();
		}
		
	}


	
	
}