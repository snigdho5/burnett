<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class User extends CI_Controller
{
 private $_uploaded;
  function __construct() { 
    parent::__construct();
		if(!$this->session->userdata('is_admin_login')) {
    	redirect('admin');
			exit();
    }
		$this->load->library('form_validation');
		$this->load->model('user_model');
		$this->load->model('common_my_model');
  }
 
  public function index() {    
		
		$data = array();
		$data['users'] = $this->user_model->user_list();				
		$this->load->view('controll_admin/user_list', $data);
	}
	
	public function customer_list() {    
		
		$data = array();
		$data['users'] = $this->user_model->customer_list();				
		$this->load->view('controll_admin/user_list', $data);
	}
	
	public function doctor_list() {    
		
		$data = array();
		$data['users'] = $this->user_model->doctor_list();				
		$this->load->view('controll_admin/user_list', $data);
	}
	
	public function dealer_list() {    
		
		$data = array();
		$data['users'] = $this->user_model->dealer_list();				
		$this->load->view('controll_admin/user_list', $data);
	}
	
	public function stockist_list() {    
		
		$data = array();
		$data['users'] = $this->user_model->stockist_list();				
		$this->load->view('controll_admin/user_list', $data);
	}
	
	public function add_edit() {
		
	 $id = $this->uri->segment(4);
	 
	 $data = array();
		if($this->input->post()){
		
			$this->form_validation->set_rules('name', 'Name', 'required|min_length[2]');
			$this->form_validation->set_rules('phone', 'Phone', 'required|min_length[8]');
	
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		
			
			if($this->form_validation->run() == TRUE){
				
				$data['name'] = $this->input->post('name');
				
				$data['phone'] = $this->input->post('phone');					
				$data['email'] = $this->input->post('email');				
				$data['activate'] = $this->input->post('activate');
				$data['is_subscriber'] = $this->input->post('is_subscriber');
				$password = $this->input->post('password');
			
				if($id > 0){
					if($password=='')
					{
					}
					else
					{
					$data['password'] = md5($password);	
					}
					
						if($last_id = $this->user_model->edit_user($id, $data)){
							$this->session->set_flashdata('succ_msg', 'User updated successfully !!!!');
						}else{
							$this->session->set_flashdata('error_msg', $this->db->_error_message());
						}
				}else{
					if($password=='')
					{
						$data['password'] = md5('123456');	
					}
					else
					{
					$data['password'] = md5($password);	
					}
					
						if($last_id = $this->user_model->add_user($data)){
							$this->session->set_flashdata('succ_msg', 'User added successfully !!!!');
						}else{
							$this->session->set_flashdata('error_msg', $this->db->_error_message());
						}
				}
				
		
		
		
				redirect('controll_admin/user');
				exit;	
			}
		
		}
		
		if($id > 0){
			 $user = $this->user_model->user_details_by_id($id);
			 $data['user'] = $user[0];

		}
		
		$this->load->view('controll_admin/user_add_edit',$data);
		
	}
	
	public function add_edit_dealer() {
		
	 $id = $this->uri->segment(4);
	 
	 $data = array();
		if($this->input->post()){
		
			$this->form_validation->set_rules('di_firstname', 'Name', 'required|min_length[2]');
			$this->form_validation->set_rules('di_phone', 'Phone', 'required|min_length[8]');
	
			$this->form_validation->set_rules('di_email', 'Email', 'trim|required|valid_email');
		
			
			if($this->form_validation->run() == TRUE){
				
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
				//$prev_any_delarship= $this->input->post(strtolower($user_type).'_prev_any_delarship');
				$prev_any_delarship= 'N';
				$name_of_company= $this->input->post(strtolower($user_type).'_name_of_company');
				$target_of_business= $this->input->post(strtolower($user_type).'_target_of_business');
				$year_of_experience= $this->input->post(strtolower($user_type).'_year_of_experience');
				$activate= $this->input->post('activate');
				$pin_code= $this->input->post(strtolower($user_type).'_pin_code');
				$email= $this->input->post(strtolower($user_type).'_email');		
				$password= $this->input->post(strtolower($user_type).'_password');
				
				$created_on= date('Y-m-d H:i:s');
			
				if($id > 0){
					if($password=='')
					{
					}
					else
					{
						$data['password'] = md5($password);	
					}
					$data=array(
						'user_type'=>$user_type,
						'firstname'=>$firstname,
						'lastname'=>$lastname,
						'phone'=>$phone,
						'whatsapp'=>$whatsapp,
						'pin_code'=>$pin_code,
						'activate'=>$activate,  
						'firmname'=>$firmname,
						'drug_license_no'=>$drug_license_no,
						'gst_pan_no_firm'=>$gst_pan_no_firm,
						'address'=>$address,
						'area_of_work'=>$area_of_work,
						'prev_any_delarship'=>$prev_any_delarship,
						'name_of_company' => $name_of_company,
						'target_of_business'=>$target_of_business,
						'year_of_experience'=>$year_of_experience,
						'email'=>$email
					
					);
					
					if($last_id = $this->user_model->edit_user($id, $data)){
						$this->session->set_flashdata('succ_msg', 'Dealer Data updated successfully !!!!');
					}else{
						$this->session->set_flashdata('error_msg', $this->db->_error_message());
					}
				}else{
					
					if($password=='')
					{
						$password = md5('123456');	
					}
					else
					{
						$password = md5($password);	
					}
					
					$email_check=$this->common_my_model->common($table_name = 'register_users', $field = array(), $where = array('email'=>$email), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

					$mobile_check=$this->common_my_model->common($table_name = 'register_users', $field = array(), $where = array('phone'=>$phone), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
			
						if(count($email_check) > 0)
						{
							$this->session->set_flashdata('error_msg',"Your Email Is Already Used.");
							redirect('controll_admin/user/dealer_list');
							exit;
						}
						elseif(count($mobile_check) > 0)
						{
							$this->session->set_flashdata('error_msg',"Your Contact No Is Already Used.");
							redirect('controll_admin/user/dealer_list');
							exit;
						}
						else
						{
							$data=array(
								'user_type'=>$user_type,
								'firstname'=>$firstname,
								'lastname'=>$lastname,
								'phone'=>$phone,
								'whatsapp'=>$whatsapp,
								'pin_code'=>$pin_code,
								'activate'=>$activate,  
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
					
					
					
					
					
					
						if($last_id = $this->user_model->add_user($data)){
							$this->session->set_flashdata('succ_msg', 'Dealer added successfully !!!!');
						}else{
							$this->session->set_flashdata('error_msg', $this->db->_error_message());
						}
				}
				
		
		
		
				redirect('controll_admin/user/dealer_list');
				exit;	
			}
		
		}
		
		if($id > 0){
			 $user = $this->user_model->user_details_by_id($id);
			 $data['user'] = $user[0];

		}
		
		$this->load->view('controll_admin/add_edit_dealer',$data);
		
	}
	
	public function view_details($id){
		
		$user = $this->user_model->user_details_by_id($id);
		$data['user'] = $user[0];
		//var_dump($data); die;
		$this->load->view('controll_admin/user_details',$data);
	}
	
	public function change_status($id, $status){
		
		if($this->user_model->change_status($id, $status)){
			$this->session->set_flashdata('succ_msg', 'Status changed successfully !!!!');
			redirect('controll_admin/user');
			exit();
		}
		
	}
	
	public function delete($id){
		
		if($this->user_model->delete_user($id)){
			$this->session->set_flashdata('succ_msg', 'User deleted successfully !!!!');
			redirect('controll_admin/user');
			exit();
		}
		
	}
	
	public function fileupload_check() {
    
    
    $number_of_files = sizeof($_FILES['uploadedimages']['tmp_name']);
    
    $files = $_FILES['uploadedimages'];

   
    for($i=0;$i<$number_of_files;$i++)
    {
      if($_FILES['uploadedimages']['error'][$i] != 0)
      {
        // save the error message and return false, the validation of uploaded files failed
        $this->form_validation->set_message('fileupload_check', 'Couldn\'t upload the file(s)');
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
      $_FILES['uploadedimage']['name'] = time().rand(1000,9999999999).$files['name'][$i];
      $_FILES['uploadedimage']['type'] = $files['type'][$i];
      $_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'][$i];
      $_FILES['uploadedimage']['error'] = $files['error'][$i];
      $_FILES['uploadedimage']['size'] = $files['size'][$i];
      
      //now we initialize the upload library
      $this->upload->initialize($config);
      if ($this->upload->do_upload('uploadedimage'))
      {
        $this->_uploaded[$i] = $this->upload->data();
      }
      else
      {
        $this->form_validation->set_message('fileupload_check', $this->upload->display_errors());
        return FALSE;
      }
    }
    return TRUE;
  }
	
	public function product_section_image_upload($value,$field)
	{
			
		if($_FILES[$field]['size'] != 0)
		{
		
			$upload_dir = 'uploads/content/';
			if (!is_dir($upload_dir))
			{
				 mkdir($upload_dir);
			}	
			$config['upload_path']   = $upload_dir;
            $config['max_size'] = 1024 * 5;
            $config['allowed_types'] = 'gif|png|jpg|jpeg';
			$config['overwrite']     = false;
            $config['encrypt_name'] = TRUE;
			
			$this->load->library('upload', $config);
			if($this->upload->do_upload($field))
			{
				$upload_data = $this->upload->data();
				$_POST[$field] = $upload_data['file_name'];
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('image_upload', $this->upload->display_errors());
				return FALSE;
			}
		}	
		else
		{
			
			
				$this->form_validation->set_message('image_upload', 'No file selected');
				return false;
			
			
		}
	}
	
	
	public function delete_image($image_id, $id){
		
		if($this->product_model->delete_image_only($image_id)){
			$this->session->set_flashdata('succ_msg', 'Image deleted successfully !!!!');
			redirect('admin/product/add_edit/'.$id);
			exit();
		}
		
	}
	
	
	public function add_discount_show($uid) {    
		$data = array();
		$data['discount_details'] = $this->user_model->user_discount_list_by_id($uid);				
		$this->load->view('controll_admin/discount_list', $data);
	}

	public function add_discount($uid) {    
		$data = array();
		$data['user_discount_details'] = $this->user_model->user_discount_list_by_id($uid);				
		$this->load->view('controll_admin/discount_add', $data);
	}

	function discount_add_submit()
  {
     
           $user_id= $this->input->post('user_id');

         



            
            $discount_type = $this->input->post('discount_type');
            $discount_amount = $this->input->post('discount_amount');
            $exp_date = $this->input->post('exp_date');
            $status = $this->input->post('status');
            $total_use = $this->input->post('total_use');            
            $date_added=date('Y-m-d H:i:s');
            


            
        $insert_data= array( 
                                'user_id'=>$user_id,  
                               'discount_type'=>$discount_type,
                                'discount_amount' =>$discount_amount,
                                'exp_date'=>$exp_date,
                                'status'=>$status,
                                
                                'total_use'=>$total_use,
                                'status'=>$status,
                                                              
                               );



        $edited_details = $this->common_my_model->common($table_name ='user_discount', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



   if(count(@$edited_details)>0){
          $this->db->where('user_id',$user_id);
         $this->db->update('user_discount',$insert_data);

   } else{

   	$this->db->insert('user_discount', $insert_data);

   }
      
        

        // $this->db->where('coupon_id',$coupon_id);
        // $this->db->update('coupon',$insert_data);
     


        $this->session->set_flashdata('succ_add','Successfully edited');
        redirect(base_url().BaseAdminURl."/user/add_discount_show/$user_id");
  }




	
}