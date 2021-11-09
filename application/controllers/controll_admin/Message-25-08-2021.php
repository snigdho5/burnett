<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		date_default_timezone_set("Asia/Kolkata");
		if (!$this->session->userdata('is_admin_login')){
			redirect('controll_admin');
			exit();
		}
		//error_reporting(0);
	}
	
	public function index(){
		$data['messages'] = $this->db->get('message')->result();
		$this->load->view('controll_admin/message/list', $data);
	}
	
	public function add(){
		
		$data = $this->input->post();
		$data = array_map('trim', $data);
		$data = $this->security->xss_clean($data);
		
		$this->form_validation->set_rules('message', 'message', 'required|trim|xss_clean');
		$this->form_validation->set_rules('status', 'status', 'required|trim|xss_clean');
		
		if (!$this->form_validation->run() === FALSE )
		{
			$InsertData = array(
				'message' 		=> $data['message'],
				'status' 		=> $data['status'],
				'created_on' 	=> date('Y-m-d H:i:s'),
				'updated_on' 	=> date('Y-m-d H:i:s')
			);
			//echo "<pre>";print_r($InsertData);exit();
			
			$this->db->insert('message', $InsertData);
			$this->session->set_flashdata('succ_msg','Message saved successfully');
			redirect(base_url().BaseAdminURl.'/message/add');
			
		}else{
			$this->load->view('controll_admin/message/add');
		}
	}
	
	public function edit($id){
		
		$data = $this->input->post();
		$data = array_map('trim', $data);
		$data = $this->security->xss_clean($data);
		
		$this->form_validation->set_rules('message', 'message', 'required|trim|xss_clean');
		$this->form_validation->set_rules('status', 'status', 'required|trim|xss_clean');
		
		if (!$this->form_validation->run() === FALSE )
		{
			$updatetData = array(
				'message' 		=> $data['message'],
				'status' 		=> $data['status'],
				'updated_on' 	=> date('Y-m-d H:i:s')
			);
			
			$this->db->where('message_id',$id)->update('message',$updatetData);
			$this->session->set_flashdata('succ_msg','Message updated successfully');
			redirect(base_url().BaseAdminURl.'/message/edit/'.$id);
			
		}else{
			
			$data['editMsg'] = $this->db->where('message_id', $id)->get('message')->result();
			$this->load->view('controll_admin/message/edit', $data);
		}
	}
	
	public function status($id){
		
		$msgData = $this->db->where('message_id', $id)->get('message')->result();
		if($msgData[0]->status == 1){
			$updateStatus = 0;
			$satusMsg = 'Message inactivated successfully.';
		}else{
			$updateStatus = 1;
			$satusMsg = 'Message activated successfully.';
		}
		$this->db->set('status', $updateStatus)->where('message_id', $id)->update('message');
		$this->session->set_flashdata('succ_msg',$satusMsg);
		redirect(base_url().BaseAdminURl.'/message');
	}
	
	
	public function delete($id){
		$this->db->where('message_id', $id)->delete('message');
		$this->session->set_flashdata('succ_msg','Message deleted successfully');
		redirect(base_url().BaseAdminURl.'/message');
	}
	
	
	public function saveYTvideo(){
		
		$data = $this->input->post();
		$data = array_map('trim', $data);
		$data = $this->security->xss_clean($data);
		
		$this->form_validation->set_rules('youtube_video_id', 'youtube video id', 'required|trim|xss_clean');
		$this->form_validation->set_rules('status', 'status', 'required|trim|xss_clean');
		
		if (!$this->form_validation->run() === FALSE )
		{
			$updatetData = array(
				'youtube_video_id' 	=> $data['youtube_video_id'],
				'status' 			=> $data['status'],
				//'created_on' 		=> date('Y-m-d H:i:s'),
				'updated_on' 		=> date('Y-m-d H:i:s')
			);
			//echo "<pre>";print_r($updatetData);exit();
			
			$this->db->where('id',1)->update('youtube',$updatetData);
			$this->session->set_flashdata('succ_msg','Youtube details saved successfully');
			redirect(base_url().BaseAdminURl.'/message/saveYTvideo');
			
		}else{
			
			$data['editMsg'] = $this->db->where('id', 1)->get('youtube')->result();
			$this->load->view('controll_admin/message/save_youtube_video', $data);
		}
	}
	
	public function staticContent(){
		
		$data = $this->input->post();
		$data = array_map('trim', $data);
		$data = $this->security->xss_clean($data);
		
		$this->form_validation->set_rules('left_heading', 'left heading', 'required|trim|xss_clean');
		$this->form_validation->set_rules('left_content', 'left content', 'required|trim|xss_clean');
		$this->form_validation->set_rules('right_heading', 'right heading', 'required|trim|xss_clean');
		$this->form_validation->set_rules('right_content', 'right content', 'required|trim|xss_clean');
		
		if (!$this->form_validation->run() === FALSE )
		{
			$updatetData = array(
				'left_heading' 	=> $data['left_heading'],
				'left_content' 	=> $data['left_content'],
				'right_heading' => $data['right_heading'],
				'right_content' => $data['right_content'],
				//'created_on' 	=> date('Y-m-d H:i:s'),
				'updated_on' 	=> date('Y-m-d H:i:s')
			);
			//echo "<pre>";print_r($updatetData);exit();
			
			$this->db->where('id',1)->update('static_content',$updatetData);
			$this->session->set_flashdata('succ_msg','Youtube details saved successfully');
			redirect(base_url().BaseAdminURl.'/message/staticContent');
			
		}else{
			$data['editMsg'] = $this->db->where('id', 1)->get('static_content')->result();
			$this->load->view('controll_admin/message/static_content', $data);
		}
	}
	
	
	public function get_your_choice(){
		
		$data = $this->input->post();
		$data = array_map('trim', $data);
		$data = $this->security->xss_clean($data);
		
		$this->form_validation->set_rules('title', 'title', 'required|trim|xss_clean');
		$this->form_validation->set_rules('alt_tag', 'alt tag', 'required|trim|xss_clean');
		$this->form_validation->set_rules('status', 'status', 'required|trim|xss_clean');
		
		$folder = FCPATH.'uploads/home_image/';
		if(!file_exists($folder)){
			mkdir($folder, 0777, true);
		}
		
		$config['upload_path']   = './uploads/home_image/';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']      = '1072';  // (3MB * 1024KB) = 1072 KB Allowed.
		$config['max_width']     = '';
		$config['max_height']    = '';
		$config['file_name']     = 'image_'.time();

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		
		if ( ! $this->upload->do_upload('f_image') && isset($data) && !empty($data) )
		{
			$data['error'] = $this->upload->display_errors();
		} else {
			$img = array('uploaded_img' => $this->upload->data());
			$f_image = $img['uploaded_img']['file_name'];
		}
		
		if (!$this->form_validation->run() === FALSE && $this->upload->display_errors() =='' )
		{
			$InsertData = array(
				'title' 	=> $data['title'],
				'f_image' 	=> isset($f_image)?$f_image:'',
				'status' 	=> $data['status'],
				'alt_tag' 	=> $data['alt_tag'],
				'created_on' => date('Y-m-d H:i:s'),
				'updated_on' => date('Y-m-d H:i:s')
			);
			
			$this->db->insert('get_your_choice', $InsertData);
			$this->session->set_flashdata('succ_msg','Image details saved successfully');
			redirect(base_url().BaseAdminURl.'/message/get_your_choice');
			exit();
		}else{
			$this->load->view('controll_admin/message/get_your_choice', $data);
		}
	}
	
	public function edit_get_your_choice($id){
		
		$data = $this->input->post();
		$data = array_map('trim', $data);
		$data = $this->security->xss_clean($data);
		
		$this->form_validation->set_rules('title', 'title', 'required|trim|xss_clean');
		$this->form_validation->set_rules('alt_tag', 'alt tag', 'required|trim|xss_clean');
		$this->form_validation->set_rules('status', 'status', 'required|trim|xss_clean');
		
		if( isset($_FILES) && !empty($_FILES) && $_FILES['f_image']['tmp_name'] !=''){
			$folder = FCPATH.'uploads/home_image/';
			if(!file_exists($folder)){
				mkdir($folder, 0777, true);
			}
			
			$config['upload_path']   = './uploads/home_image/';
			$config['allowed_types'] = 'jpeg|jpg|png';
			$config['max_size']      = '1072';  // (3MB * 1024KB) = 1072 KB Allowed.
			$config['max_width']     = '';
			$config['max_height']    = '';
			$config['file_name']     = 'image_'.time();

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if ( ! $this->upload->do_upload('f_image') && isset($data) && !empty($data) )
			{
				$data['error'] = $this->upload->display_errors();
			} else {
				$img = array('uploaded_img' => $this->upload->data());
				$f_image = $img['uploaded_img']['file_name'];
				
				$img_path = FCPATH.'uploads/home_image/'.$this->security->xss_clean($this->input->post('hdn_f_image'));
				if( isset($img) && $f_image != '' ){
				  	unlink($img_path);
				}
			}
		}else{
			$f_image = $this->security->xss_clean($this->input->post('hdn_f_image'));
		}
		
		if (!$this->form_validation->run() === FALSE )
		{
			$updatetData = array(
				'title' 	=> $data['title'],
				'f_image' 	=> isset($f_image)?$f_image:'',
				'status' 	=> $data['status'],
				'alt_tag' 	=> $data['alt_tag'],
				'created_on' => date('Y-m-d H:i:s'),
				'updated_on' => date('Y-m-d H:i:s')
			);
			
			$this->db->where('id', $id)->update('get_your_choice',$updatetData);
			$this->session->set_flashdata('succ_msg','Image details updated successfully');
			redirect(base_url().BaseAdminURl.'/message/edit_get_your_choice/'.$id);
			exit();
		}else{
			$data['editMsg'] = $this->db->where('id', $id)->get('get_your_choice')->result();
			$this->load->view('controll_admin/message/edit_get_your_choice', $data);
		}
	}
	
	public function get_your_choice_list(){
		$data['getChoice'] = $this->db->get('get_your_choice')->result();
		$this->load->view('controll_admin/message/get_your_choice_list', $data);
	}
	
	public function change_status($id){
		
		$msgData = $this->db->where('id', $id)->get('get_your_choice')->result();
		if($msgData[0]->status == 1){
			$updateStatus = 0;
			$satusMsg = 'Choice inactivated successfully.';
		}else{
			$updateStatus = 1;
			$satusMsg = 'Choice activated successfully.';
		}
		$this->db->set('status', $updateStatus)->where('id', $id)->update('get_your_choice');
		$this->session->set_flashdata('succ_msg',$satusMsg);
		redirect(base_url().BaseAdminURl.'/message/get_your_choice_list');
	}
	
	
	public function do_delete($id){
		$this->db->where('id', $id)->delete('get_your_choice');
		$this->session->set_flashdata('succ_msg','Choice deleted successfully');
		redirect(base_url().BaseAdminURl.'/message/get_your_choice_list');
	}
	
	
}
?>