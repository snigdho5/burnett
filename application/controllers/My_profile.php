<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class My_profile extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();
           $this->load->model('common_my_model');
           $this->load->library('image_lib');
           @$this->load->library('dompdf_gen');
           @$this->load->helper('download'); 

	}
	
	public function index()
	{

		$user_id=$this->session->userdata('user_session_id');

		if($user_id==''){
		//	$this->session->set_flashdata('succ','You have successfully registration...Please Login');
				    redirect(base_url().'user-registation', 'refresh');

		}

		$data['seo_content_details']=  $this->common_my_model->common($table_name ='seo_module', $field = array(), $where = array('seo_module_id'=>'14'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$data['user_details']=$this->common_my_model->common($table_name = 'register_users', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$data['wishlist_list']=$this->common_my_model->common($table_name = 'wishlist', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$data['manage_address_list']=$this->common_my_model->common($table_name = 'user_billing_address', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$data['wallet_transaction_list']=$this->common_my_model->common($table_name ='wallet_transaction', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array('wallet_id'=>'desc'), $start = '', $end = '');


		$data['order_list']=$this->common_my_model->common($table_name = 'orders_management', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array('order_id'=>'desc'), $start = '', $end = '');


				
		$this->load->view('common/header',$data);
		$this->load->view('my_profile_view',$data);
		$this->load->view('common/footer');
	}



	function edit_profile_data()
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


        $user_id=$this->session->userdata('user_session_id');

	 
			        
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
							//'password'=>$password,
							
							//'create_date'=>$created_on
							
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
							//'password'=>$password,
							
							//'create_date'=>$created_on
							
						);

			}


				if($user_type=='DI'){
					$data=array(
							'user_type'=>$user_type,
							'firstname'=>$firstname,
							'lastname'=>$lastname,
							'phone'=>$phone,
							'whatsapp'=>$whatsapp,

                           // 'activate'=>'0',  
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
							//'password'=>$password,
							
							//'create_date'=>$created_on
							
						);

			}


			if($user_type=='ST'){
					$data=array(
							'user_type'=>$user_type,
							'firstname'=>$firstname,
							'lastname'=>$lastname,
							'phone'=>$phone,
							'whatsapp'=>$whatsapp,

                          //  'activate'=>'0', 
							'firmname'=>$firmname,
							'drug_license_no'=>$drug_license_no,
							'gst_pan_no_firm'=>$gst_pan_no_firm,
							'address'=>$address,
							'area_of_work'=>$area_of_work,
							'prev_any_delarship'=>$prev_any_delarship,
							'name_of_company' => $name_of_company,
							'target_of_business'=>$target_of_business,
							//'year_of_experience'=>$year_of_experience,

							'email'=>$email
							//'password'=>$password,
							
							//'create_date'=>$created_on
							
						);

			}




						
                $this->db->where('user_id',$user_id);
				$this->db->update('register_users',$data);

				$this->session->set_flashdata('succ','Your account have successfully updated.');
				redirect(base_url().'my-account', 'refresh');

				

		

}

function change_profile_image()
	{

		

             $user_id= $this->session->userdata('user_session_id');
    



		if($_FILES['profile_pic']['name']=="")
        {
            $image="";
            
        }
        else
        {
            $new_name1 = str_replace(".", "", microtime());
            $new_name = str_replace(" ", "_", $new_name1);
            $file_tmp = $_FILES['profile_pic']['tmp_name'];
            $file = $_FILES['profile_pic']['name'];
            $ext = substr(strrchr($file, '.'), 1);
            if ($ext == "png" || $ext == "gif" || $ext == "jpg" || $ext == "jpeg" )
            {
        
                move_uploaded_file($file_tmp, "./uploads/profile_picture/" . $new_name . "." . $ext);
                $image = $new_name . "." . $ext;

                $config['image_library'] = 'gd2';
                $config['source_image'] = './uploads/profile_picture/' . $image;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = 600;
                $config['height']= 600;
                $config['quality'] = "100%";
               
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
            }
            else
            {
                $this->session->set_flashdata('image_error','please upload an image..!');
               
            }
        }
      
        $preview_data_img=array('profile_picture'=>$image);
        
          $this->db->where('user_id',$user_id);
        
        $this->db->update('register_users',$preview_data_img);

        ?>

        

        <img src="<?php echo base_url();?>uploads/profile_picture/<?php echo $image; ?>" class="avatar img-circle img-thumbnail" alt="avatar">
      
        <p class="pt-2 "><strong>Hello burnett</strong></p>
        <p class="pb-2">Upload a different photo...</p>
        <input type="file" id="profile_pic_id" name="profile_pic" class="text-center center-block file-upload">



     
<?php

}

function change_password()
    {
        if($this->session->userdata('user_session_id')=="")
        {
            
            redirect(base_url().'user-registation', 'refresh');
        }


        $admin_id = $this->session->userdata('user_session_id');
        $old_pass=$this->input->post('old_pass');
        $old_pass_md=$old_pass;

        $new_pass=$this->input->post('new_pass');
       


        $countdata =  $this->common_my_model->common($table_name ='register_users', $field = array(), $where = array('password'=>md5($old_pass_md), 'user_id'=>$admin_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


        if(count($countdata)==0)
        {
            $status='N';
        }

       else{

           $data=array(
            'password'=>md5($new_pass)
        );
       
       // $this->db->update($data,'tbl_user','user_id',$id);


      $this->db->where('user_id',$admin_id);
        $this->db->update('register_users',$data);

      $status='Y';

       } 


        echo json_encode(array('msg'=>$status));

    }


function delete_wishlist($wish_id)
	{

		
        $this ->db-> where('wish_id', $wish_id);
        $this ->db-> delete('wishlist');

        $this->session->set_flashdata('succ','Deleted your wishes product.');
	    redirect(base_url().'my-account', 'refresh');
            


          }


          function wallet_data_submit()
    {
        //echo "ok";
      $user_id=$this->session->userdata('user_session_id');
        $created_date=date('y-m-d H:i:s');
        $amount=$this->input->post('amount');
        

            $wallet_amount=$this->common_my_model->common($table_name ='register_users', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


             

                $phone=@$wallet_amount[0]->mobile;

            $new_wallet_amount=@$wallet_amount[0]->wallet_amount;

            $total_amount=$amount + $new_wallet_amount;

            $amount_data=array('wallet_amount'=>$total_amount);

            $this->db->where('user_id',$user_id);
            $this->db->update('register_users',$amount_data);

            $transaction_id=time().rand(000,999);

            $data=array(
                        'transaction_id'=>$transaction_id,
                        'user_id'=>$user_id,
                        //'transaction_type'
                        'transaction_amount'=>$amount,
                        'transaction_date'=>$created_date
                    );

            $this->db->insert('wallet_transaction',$data);


            $this->session->set_flashdata('succ','Your amount has been successfully added.');
	        redirect(base_url().'my-account', 'refresh');

        
    }

      function cancelled_order()
    {
        //echo "ok";
      $order_id=$this->uri->segment(3);
        

        $data = array(
           
            'order_status'=>'4',
          
          );  

    
      

      $this->db->where('order_id',$order_id);
      $this->db->update('orders_management',$data);

      $this->session->set_flashdata('exist','Your order has been cancelled.');
        redirect(base_url().'my-account', 'refresh'); 

    }


      function download_order_pdf()
    {
        //echo "ok";
        $order_unique_id=$this->uri->segment(3);



        $order_list=$this->common_my_model->common($table_name = 'orders_management', $field = array(), $where = array('order_unique_id'=>$order_unique_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

        $order_details=$this->common_my_model->common($table_name = 'order_detail', $field = array(), $where = array('order_id'=>@$order_list[0]->order_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

        // echo $order_unique_id;exit;

        $shipping_address_details=$this->common_my_model->common($table_name = 'user_shipping_address', $field = array(), $where = array('id'=>@$order_list[0]->shipping_address_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
       
       
      $invoice_no= 'Burnett payment details-'.rand(000,999).''.$order_list[0]->order_id;
     
      $mail_data= array(
                          'order_list'=>$order_list,

                          'order_details'=>$order_details,                         
                          'shipping_address_details'=>$shipping_address_details,
                          
                       
                      );

     
      $this->load->view('order_details_invoice',$mail_data);
      //print_r($mail); exit;
      //$this->load->view('mail_template/client_booking_invoice',$mail_data);
     /* $html = $this->output->get_output();
      $dompdf = new DOMPDF();
      $dompdf->load_html($html);
      $dompdf->set_paper('A4', 'portrait');
      $dompdf->render();
      $output = $dompdf->output();
              
      $i = $invoice_no;
      $file_to_save = './upload/invoice/'.$i.'.pdf';
      file_put_contents($file_to_save,$output);

      $data_file = file_get_contents($file_to_save);
          
      $name = $i.'.pdf';
      force_download($name,$data_file);*/

    }




	
}
?>