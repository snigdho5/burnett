<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Auth extends CI_Controller
{
 
  function __construct()
  {
    parent::__construct();
	
		$this->load->library('form_validation');
		$this->load->model('auth_model');
		
  }
 
  public function index() {
		
    if($this->session->userdata('is_admin_login')) {
    	redirect('controll_admin/dashboard');
    } else {
			$this->load->view('controll_admin/auth');
  	}
	}
	
	
	public function login(){
		
		$username = $this->input->post('username');
    $password = $this->input->post('password');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE) {				
				redirect('controll_admin/auth');
				exit();
		} else {
				//$salt = '5&JDDlwz%Rwh!t2Yg-Igae@QxPzFTSId';
				$enc_pass  = md5($password);
				$login_arr = $this->auth_model->authentification($username, $enc_pass);	
				if(!empty($login_arr)){
					$this->session->set_userdata('is_admin_login', true);
					$this->session->set_userdata('username', $login_arr->username);
					$this->session->set_flashdata('auth_msg', 'You have successfully logged in !!!!');
					redirect('controll_admin/dashboard');
					exit();
				}else{							
					$this->session->set_flashdata('auth_msg', 'Please check your username or password !!!!');
					redirect('controll_admin');
					exit();
			}
		}
						
	}
	
	 public function logout(){
   	$this->session->unset_userdata('is_admin_login');
		$this->session->sess_destroy();
    redirect('controll_admin', 'refresh');
   }	
	
	
}