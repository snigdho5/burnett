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
				'created_on' 		=> date('Y-m-d H:i:s'),
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
}
?>