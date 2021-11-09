<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Forgot_password extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();
           $this->load->model('common_my_model');
           $this->load->library('email');

	}
	
	

	function index()
	{
		$data['seo_content_details']=  $this->common_my_model->common($table_name ='seo_module', $field = array(), $where = array('seo_module_id'=>'9'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
				
		$this->load->view('common/header',$data);
		$this->load->view('forgot_password_view',$data);
		$this->load->view('common/footer');

	}



	function forgot_pass_submit_data()
	{

		$email_id = $this->input->post('email');
		if(!empty($email_id)) {
			$return = $this->common_my_model->email_id_check($email_id);
			if($return == 'doesnt_exists'){
				
				$this->session->set_flashdata('exist',"User does not exists");	
		        redirect(base_url().'forgotpassword', 'refresh');
			}
			elseif($return == 'user_inactive'){
				
				$this->session->set_flashdata('exist',"User inactive");	
		        redirect(base_url().'forgotpassword', 'refresh');
			}
			else{
				// Send an email with password reset link
				$message = 'Dear ' . $return->firstname . ',' . "\n\n";
				$message .= 'A Password Reset Request has been received for your Burnett account. However, if this is not initiated by you then please ingore this mail. You can reset your password by clicking on the link below.' . "\n";
				$message .= 'Your Password Reset Link:: http://182.75.124.211/burnett-research-lab/resetpassword/' . base64_encode($return->user_id) . "\n\n";
				$message .= 'Best Regards,' . "\n";
				$message .= 'Burnett';
				$this->email->from('support@solutionsfinder.com', 'Burnett Support');
				$this->email->to($email_id);
				$this->email->reply_to('support@solutionsfinder.com', 'Burnett');
				$this->email->subject('Your Burnett Account Password Reset Link');
				$this->email->message($message);
				if($this->email->send()) {
					
					$this->session->set_flashdata('succ',"An email has been sent to your registered email address with reset password link. You can reset your password now.");	
					redirect(base_url().'forgotpassword', 'refresh');
				}
				else{

					$this->session->set_flashdata('exist',"Mail cannot be sent");	
					redirect(base_url().'forgotpassword', 'refresh');
				}
			}
			//$json = json_encode($data);
			//echo $json;
		}
	

	}



	function resetpassword()
	{
		$data['seo_content_details']=  $this->common_my_model->common($table_name ='seo_module', $field = array(), $where = array('seo_module_id'=>'5'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	//	$login_avail=  $this->common_my_model->common($table_name ='register_users', $field = array(), $where = array('email'=>$phone_or_email,'password'=>base64_encode($password)), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
				
		$this->load->view('common/header',$data);
		$this->load->view('reset_password_view',$data);
		$this->load->view('common/footer');

	}


	public function password_reset()
	{
		
		 $user_id 	=	base64_decode($this->input->post('user_id'));
		// $user_id 	=	$this->input->post('user_id');
	    //	echo $user_id;exit;

		$password 	= 	md5($this->input->post('password'));
		if(!empty($user_id) && !empty($password)){
			if($this->common_my_model->validate_user_id($user_id) == 'ok'){

				$data['password'] = $password;

				$this->db->where('user_id', $user_id);
		       if($this->db->update('register_users', $data)) {


			//	if($this->api_model->password_reset($user_id, $password)){

					// $data['status']		= 	'success';
					// $data['message'] 	= 	'Password reset successfully.';
					$this->session->set_flashdata('succ',"Password reset successfully.");	
		            redirect(base_url().'resetpassword/'.$this->input->post('user_id'), 'refresh');
				}
				else{
					

				$this->session->set_flashdata('exist',"Cannot reset password now!");	
		        redirect(base_url().'resetpassword/'.$this->input->post('user_id'), 'refresh');
				}
			}
			elseif($this->common_my_model->validate_user_id($user_id) == 'user_inactive'){
				

				$this->session->set_flashdata('exist',"user inactive");	
		        redirect(base_url().'resetpassword/'.$this->input->post('user_id'), 'refresh');
			}
			elseif($this->common_my_model->validate_user_id($user_id) == 'user_not_found'){
				
				$this->session->set_flashdata('exist',"user not found");	
		        redirect(base_url().'resetpassword/'.$this->input->post('user_id'), 'refresh');
			}
			// $json = json_encode($data);
			// echo $json;
		}
	}


}
