<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class login extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();
           $this->load->model('common_my_model');

	}
	
	

	function submit_data()
	{
		//echo "ok";
		$phone_or_email=$this->input->post('phone_or_email');
		$password=$this->input->post('password');
		$otp=$this->input->post('otp');


		//echo $phone_or_email." ".$password;exit;
		

		 if($phone_or_email=='' || $password=='')
		{
			redirect($this->url->link(3));
		}

		$login_avail=  $this->common_my_model->common($table_name ='register_users', $field = array(), $where = array('email'=>$phone_or_email,'password'=>md5($password)), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$login_avail2= $this->common_my_model->common($table_name = 'register_users', $field = array(), $where = array('phone'=>$phone_or_email,'password'=>md5($password)), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		//print_r($login_avail); exit;

		if(count($login_avail) > 0)
		{
			if(@$login_avail[0]->activate=='1')
			{
				$this->session_set($login_avail);

				// $this->session->set_flashdata('exist',"The Email Id entered by you is invalid.");

				redirect(base_url().'my-account', 'refresh');
			}
			else{
			$this->session->set_flashdata('exist',"Your account are not approve by admin");	
		   redirect(base_url().'user-registation', 'refresh');

		}

		}	
		
		else if(count($login_avail2) > 0)
		{
			if(@$login_avail2[0]->activate=='1')
			{
				$this->session_set($login_avail2);

			//	$this->session->set_flashdata('exist',"The Phone No entered by you is invalid.");

				redirect(base_url().'my-account', 'refresh');
			}
			else{
			$this->session->set_flashdata('exist',"Your account are not approve by admin");	
		   redirect(base_url().'user-registation', 'refresh');

		}

			
		}
		else{
			$this->session->set_flashdata('exist',"Invalid Your Email Or Password");	
		redirect(base_url().'user-registation', 'refresh');

		}
	
		

			
		
	


		

			


	}


	public function session_set($login_avail)
	{
		 $user_id= @$login_avail[0]->user_id; 
		 $user_email= @$login_avail[0]->email; 
		 $user_ph= @$login_avail[0]->phone;
		// $fname= @$login_avail[0]->first_name; 
		 $user_type_id= @$login_avail[0]->user_type;
		// $authorised= @$login_avail[0]->admin_approved; 
		 
		 
		 $log_session = array(					  
				   
				   'user_email'=>$user_email,
				   'user_session_id'=>$user_id,
				  // 'user_fname'=>$fname,
				   'user_contact'=>$user_ph,
				   //'authorised'=>$authorised,
				   //'user_type'=>$user_type,
				   'logged_in' => TRUE
			   						);
		 $this->session->set_userdata($log_session);
		//echo '<pre>'; print_r($this->session->all_userdata()) ; exit;
	}


	function logout()
	{
		$this->session->unset_userdata('user_session_id');
		$this->session->unset_userdata('user_email');
		$this->session->unset_userdata('user_fname');
		$this->session->unset_userdata('user_contact');

		redirect(base_url().'user-registation', 'refresh');
	}


	




}

?>
