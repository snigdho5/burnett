<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sign_up extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();
           $this->load->model('common_my_model');
            $this->load->library('email');

	}
	
	public function index()
	{
		$data['seo_content_details'] =  $this->common_my_model->common($table_name ='seo_module', $field = array(), $where = array('seo_module_id'=>'13'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$data['redirect'] = xss_clean(($this->uri->segment(2) != '') ? $this->uri->segment(2) : ''); 
				
		$this->load->view('common/header',$data);
		$this->load->view('Sign_up_view',$data);
		$this->load->view('common/footer');
	}


	function sign_up_submt_data()
	{

		$user_type= $this->input->post('user_type');
		$field_name=strtolower($user_type).'_firstname';
		$firstname= $this->input->post(strtolower($user_type).'_firstname');		
		$lastname= $this->input->post(strtolower($user_type).'_lastname');
		$phone= $this->input->post(strtolower($user_type).'_phone');
		$whatsapp= $this->input->post(strtolower($user_type).'_whatsapp');

		$have_registration_no= $this->input->post(strtolower($user_type).'_have_registration_no');
		$registration_no= $this->input->post(strtolower($user_type).'_registration_no');

		$firmname= $this->input->post(strtolower($user_type).'_firmname');
		$drug_license_no= $this->input->post(strtolower($user_type).'_drug_license_no');
		$gst_pan_no_firm= $this->input->post(strtolower($user_type).'_gst_pan_no_firm');
		$address= $this->input->post(strtolower($user_type).'_address');
		$area_of_work= $this->input->post(strtolower($user_type).'_area_of_work');
		$prev_any_delarship= $this->input->post(strtolower($user_type).'_prev_any_delarship');
		$name_of_company= $this->input->post(strtolower($user_type).'_name_of_company');
		$target_of_business= $this->input->post(strtolower($user_type).'_target_of_business');
		$year_of_experience= $this->input->post(strtolower($user_type).'_year_of_experience');


		$email= $this->input->post(strtolower($user_type).'_email');		
        $password= md5($this->input->post(strtolower($user_type).'_password'));
		$created_on= date('Y-m-d H:i:s');





             



		 $dr_chember_picture=NULL;

         if(@$_FILES['dr_chember_picture']['name']!="")
        {
            $new_name1 = str_replace(".", "", microtime());
            $new_name = str_replace(" ", "_", $new_name1);
            $file_tmp = $_FILES['dr_chember_picture']['tmp_name'];
            $file = $_FILES['dr_chember_picture']['name'];
            $ext = substr(strrchr($file, '.'), 1);
            
                move_uploaded_file($file_tmp, "./assets/frontend/uploads/chember_picture/" . $new_name . "." . $ext);
                
                $dr_chember_picture = $new_name . "." . $ext;
      
            
        }


		
		

		// echo $email;exit;

		$email_check=$this->common_my_model->common($table_name = 'register_users', $field = array(), $where = array('email'=>$email), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$mobile_check=$this->common_my_model->common($table_name = 'register_users', $field = array(), $where = array('phone'=>$phone), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

			if(count($email_check) > 0)
			{
				$this->session->set_flashdata('exist',"Your Email Is Already Used.");
		 		redirect(base_url().'user-registation', 'refresh');
			}
			elseif(count($mobile_check) > 0)
			{
				$this->session->set_flashdata('exist',"Your Contact No Is Already Used.");
		 		redirect(base_url().'user-registation', 'refresh');
			}
			else
			{        
				if($user_type=='CU'){
					$data=array(
							'user_type'=>$user_type,
							'firstname'=>$firstname,
							'lastname'=>$lastname,
							'phone'=>$phone,
							'whatsapp'=>$whatsapp,

							//'have_registration_no'=>$have_registration_no,
							//'registration_no'=>$registration_no,
							//'chember_picture'=>$dr_chember_picture,

							'email'=>$email,
							'password'=>$password,
							
							'create_date'=>$created_on
							
						);

			}

			if($user_type=='DR'){
					$data=array(
							'user_type'=>$user_type,
							'firstname'=>$firstname,
							'lastname'=>$lastname,
							'phone'=>$phone,
							'whatsapp'=>$whatsapp,

							'have_registration_no'=>$have_registration_no,
							'registration_no'=>$registration_no,
							'chember_picture'=>$dr_chember_picture,

							'email'=>$email,
							'password'=>$password,
							
							'create_date'=>$created_on
							
						);

			}


				if($user_type=='DI'){
					$data=array(
							'user_type'=>$user_type,
							'firstname'=>$firstname,
							'lastname'=>$lastname,
							'phone'=>$phone,
							'whatsapp'=>$whatsapp,

                            'activate'=>'0',  
							'firmname'=>$firmname,
							'drug_license_no'=>$drug_license_no,
							'gst_pan_no_firm'=>$gst_pan_no_firm,
							'address'=>$address,
							'area_of_work'=>$area_of_work,
							'prev_any_delarship'=>$prev_any_delarship,
							'name_of_company' => $name_of_company,
							'target_of_business'=>$target_of_business,
							'year_of_experience'=>$year_of_experience,

							'email'=>$email,
							'password'=>$password,
							
							'create_date'=>$created_on
							
						);

			}


			if($user_type=='ST'){
					$data=array(
							'user_type'=>$user_type,
							'firstname'=>$firstname,
							'lastname'=>$lastname,
							'phone'=>$phone,
							'whatsapp'=>$whatsapp,

                            'activate'=>'0', 
							'firmname'=>$firmname,
							'drug_license_no'=>$drug_license_no,
							'gst_pan_no_firm'=>$gst_pan_no_firm,
							'address'=>$address,
							'area_of_work'=>$area_of_work,
							'prev_any_delarship'=>$prev_any_delarship,
							'name_of_company' => $name_of_company,
							'target_of_business'=>$target_of_business,
							//'year_of_experience'=>$year_of_experience,

							'email'=>$email,
							'password'=>$password,
							
							'create_date'=>$created_on
							
						);

			}




						

				$this->db->insert('register_users',$data);

				//$this->session->set_flashdata('succ','You have successfully registration...Please Login');
				//redirect(base_url().'user-registation', 'refresh');



				 if($email !=''){

				// Send an email with password reset link
				$message = 'Dear Admin' ."\n\n";
				$message .=  $firstname . ' ' .$lastname. ' has been register your site. Please approve his/her account.' . "\n";
			//	$message .= 'Your Password Reset Link:: http://celebrity-production.solutionsfinder.co.uk/resetpassword/' . base64_encode($return->user_id) . "\n\n";
				$message .= 'Best Regards,' . "\n";
				$message .= 'Burnett';
				@$this->email->from($email, 'Burnett Support');
				@$this->email->to('support@solutionsfinder.com');
				@$this->email->reply_to($email, 'Burnett');
				@$this->email->subject('Your Burnett Registration');
				@$this->email->message($message);
				if(@$this->email->send()) {
					$this->session->set_flashdata('succ','You have successfully registration...Please Login');
				    redirect(base_url().'user-registation', 'refresh');
				}
				else{
					$this->session->set_flashdata('succ',"You have successfully registration...Please Login.");
		 		      redirect(base_url().'user-registation', 'refresh');
				}
			}




			}


		

}

	
}
?>