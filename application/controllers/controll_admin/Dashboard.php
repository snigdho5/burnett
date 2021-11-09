<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Dashboard extends CI_Controller
{
 
  function __construct()
  {
    parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('auth_model');
  }
 
  public function index() {
		
    if($this->session->userdata('is_admin_login')) {
    	$this->load->view('controll_admin/dashboard');
    }else {
				$this->load->view('controll_admin/auth');
  	}

	}
	
	public function settings(){
		
		if($this->session->userdata('is_admin_login')) {
    	$data = array();
			$id = 1;	 		
	 		
		if($this->input->post()){
	
			$this->form_validation->set_rules('admin_email', 'Admin Email', 'required');
			
			
			if($this->form_validation->run() == TRUE){
				
				$data['admin_email'] = $this->input->post('admin_email');
				$data['standard_call_time'] = $this->input->post('standard_call_time');	
				$data['long_call_time'] = $this->input->post('long_call_time');
				
				$data['bpoint_user'] = $this->input->post('bpoint_user');
				$data['bpoint_pass'] = $this->input->post('bpoint_pass');
				$data['bpoint_merchant'] = $this->input->post('bpoint_merchant');
							
				
				if($id > 0){
					
					if($this->auth_model->edit_settings($id, $data)){
						$this->session->set_flashdata('succ_msg', 'Settings updated successfully !!!!');
					}else{
						$this->session->set_flashdata('error_msg', $this->db->_error_message());
					}
				} /*else{
					
					if($this->category_model->add_category($data)){
						$this->session->set_flashdata('succ_msg', 'Category added successfully !!!!');
					}else{
						$this->session->set_flashdata('error_msg', $this->db->_error_message());
					}
				
				}*/
				redirect("controll_admin/dashboard/settings/");
				exit;	
			}
		
		}
		
		if($id > 0){
			$data['settings'] = $this->auth_model->site_settings($id);
		}
			
			$this->load->view('controll_admin/settings', $data);
    } else {
			$this->load->view('controll_admin/auth');
  	}
	}
	public function change_password(){
		
		if($this->session->userdata('is_admin_login')) {
    	$data = array();
			$id = $this->uri->segment(4);	 		
	 		
		if($this->input->post()){
	
			$this->form_validation->set_rules('old_password', 'Old Password', 'required');
			$this->form_validation->set_rules('new_password', 'New Password', 'required');
		
			if($this->form_validation->run() == TRUE){
				
				$data['old_password'] = $this->input->post('old_password');
				$data['new_password'] = $this->input->post('new_password');	
			
				if($id > 0){
					
					if($this->auth_model->change_password($id, $data)){
						$this->session->set_flashdata('succ_msg', 'Password updated successfully !!!!');
					}else{
						$this->session->set_flashdata('error_msg', 'Old Password is not correct');
					}
				} /*else{
					
					if($this->category_model->add_category($data)){
						$this->session->set_flashdata('succ_msg', 'Category added successfully !!!!');
					}else{
						$this->session->set_flashdata('error_msg', $this->db->_error_message());
					}
				
				}*/
				redirect("controll_admin/dashboard/change_password/".$id);
				exit;	
			}
		
		}
		
		
			
			$this->load->view('admin/common/change_password');
    } else {
			$this->load->view('admin/auth');
  	}
	}
	
	public function add_edit() {
	 
	 $id = $this->uri->segment(4);
	 
	 $data = array();
		if($this->input->post()){
		
			$this->form_validation->set_rules('name', 'Name', 'required|min_length[2]');
			$this->form_validation->set_rules('description', 'Description', 'required|min_length[5]|max_length[255]');
			$this->form_validation->set_rules('parent_id', 'Is Parent', 'required');		
			$this->form_validation->set_rules('status', 'Status', 'required');			
			
			if($this->form_validation->run() == TRUE){
				
				$data['name'] = $this->input->post('name');
				$data['description'] = $this->input->post('description');					
				$data['parent_id'] = $this->input->post('parent_id');
				$data['status'] = $this->input->post('status');				
				$data['date_added'] = date('Y-m-d H:i:s');
				
				if($id > 0){
					
					if($this->category_model->edit_category($id, $data)){
						$this->session->set_flashdata('succ_msg', 'Category updated successfully !!!!');
					}else{
						$this->session->set_flashdata('error_msg', $this->db->_error_message());
					}
				}else{
					
					if($this->category_model->add_category($data)){
						$this->session->set_flashdata('succ_msg', 'Category added successfully !!!!');
					}else{
						$this->session->set_flashdata('error_msg', $this->db->_error_message());
					}
				
				}
				redirect('admin/gallery_category');
				exit;	
			}
		
		}
		
		if($id > 0){
			$data['category_details'] = $this->category_model->category_details_by_id($id);
		}
		//print_r($data['category_details']);
		
		$data['all_active_categories'] = $this->category_model->active_category_list();
		$this->load->view('admin/gallery/category_add_edit',$data);
		
	}
	
	
	
	
}