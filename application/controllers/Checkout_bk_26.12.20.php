<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Checkout extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();
           $this->load->model('common_my_model');
           $this->load->library('pagination');
            $this->load->library('email');

	}
	
	public function index()
	{

      $user_id=$this->session->userdata('user_session_id');

     if($user_id==''){
       redirect(base_url().'user-registation', 'refresh'); 
     }

       $cart = $this->cart->contents();
    
     if(count(@$cart)==0){
     	redirect(base_url().'product-list', 'refresh'); 
     }

     	


    
      $data['user_billing_address_details']=  $this->common_my_model->common($table_name ='user_billing_address', $field = array(), $where = array('user_id'=>$user_id,'default_billing'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

       $data['seo_content_details']=  $this->common_my_model->common($table_name ='seo_module', $field = array(), $where = array('seo_module_id'=>'11'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
       // $data['bil_country_list']=$this->common_my_model->common($table_name = 'country', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
        $data['bil_state_list']=$this->common_my_model->common($table_name = 'states', $field = array(), $where = array('country_id'=>'101'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

       
         
		$this->load->view('common/header',$data);
		$this->load->view('checkout_view',$data);
		$this->load->view('common/footer');
	}


    public function same_billing_address()
	{
		// $country_list=$this->common_my_model->common($table_name = 'country', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		$state_list=$this->common_my_model->common($table_name = 'states', $field = array(), $where = array('country_id'=>'101'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		?>

		<h4 class="mb-3">Shipping address</h4><form class="needs-validation" novalidate=""><div class="row"><div class="col-md-6 mb-3"><label for="firstName">Name</label><input type="text" class="form-control" id="ship_name" name="ship_name" placeholder="Enter your Name" value="" ><div class="invalid-feedback">    Valid first name is required.</div></div><div class="col-md-6 mb-3"><label for="lastName">Email</label><input type="text" class="form-control" id="ship_email" name="ship_email" placeholder="Enter your Email" value="" ><div class="invalid-feedback">Valid last name is required.</div></div></div><div class="mb-3"><label for="username">Contact No</label><div class="input-group"><input type="text" class="form-control" id="ship_phone" name="ship_phone" placeholder="Enter your Contact No" value="" ><div class="invalid-feedback" style="width: 100%;">Your username is required.</div></div></div><div class="mb-3"><label for="email">Flat No <span class="text-muted">(Optional)</span></label><input type="email" class="form-control" id="ship_flat_house_floor_building" name="ship_flat_house_floor_building" placeholder="Flat No" value=""><div class="invalid-feedback">Please enter a valid email address for shipping updates.</div></div><div class="mb-3"><label for="address">Locality </label><textarea class="form-control" id="ship_locality" name="ship_locality" placeholder="Locality"></textarea><div class="invalid-feedback"> Please enter your shipping address.</div></div><div class="mb-3"><label for="address2">Pincode </label><input type="text" class="form-control" id="ship_pincode" name="ship_pincode" placeholder="Enter your Contact No" value="" ></div>
			<div class="mb-3"><label for="address2">Address Type </label><select class="custom-select d-block w-100" id="ship_address_type" name="ship_address_type" >
                                     
                                      <option value="Home" >Home</option>
                                      <option value="Office" >Office</option>
                                </select></div>


			<div class="row"><div class="col-md-5 mb-3"><label for="country">Country</label><select class="custom-select d-block w-100" id="ship_country" name="ship_country" > <option value="">Select Country</option>
                                     <option value="India"  >India</option>
                                </select><div class="invalid-feedback">Please select a valid country.</div></div><div class="col-md-4 mb-3"><label for="state">State</label>
                                	<!-- <input type="text" class="form-control" id="ship_state" name="ship_state" placeholder="Enter State" value="" > -->
                                	 <select class="custom-select d-block w-100" id="ship_state" name="ship_state" >
                   <option value="">Select State</option>
                                     <?php foreach($state_list as $row){?>
                                      <option value="<?php echo $row->name; ?>" ><?php echo $row->name; ?></option>
                                    <?php } ?>
                </select>

                                	<div class="invalid-feedback">Please provide a valid state.</div></div><div class="col-md-3 mb-3"><label for="zip">City</label><input type="text" class="form-control" id="ship_city" name="ship_city" placeholder="Enter City" value="" ><div class="invalid-feedback">City required.</div></div></div>
			
	
	<?php	
	}



	
	function checkout_submit_data()
	{

		$user_id = $this->session->userdata('user_session_id');
		$payment_type = $this->session->userdata('payment_type_session_id');
		$checkbox_same_billing_out = $this->input->post('checkbox_same_billing_out');

		if($checkbox_same_billing_out=='same_not'){
		$name = $this->input->post('ship_name');
		$email = $this->input->post('ship_email');
		$phone = $this->input->post('ship_phone');
		$locality = $this->input->post('ship_locality');
		$landmark = $this->input->post('ship_landmark');
		$city = $this->input->post('ship_city');
		$state = $this->input->post('ship_state');
        $country = $this->input->post('ship_country');
		$pincode = $this->input->post('ship_pincode');
		$address_type = $this->input->post('ship_address_type');
		$flat_house_floor_building = $this->input->post('ship_flat_house_floor_building');
		$additional_information = $this->session->userdata('additional_information_session_id');
		$current_date=date('Y-m-d H:i:s');

		}
		else{

		$name = $this->input->post('bil_name');
		$email = $this->input->post('bil_email');
		$phone = $this->input->post('bil_phone');
		$locality = $this->input->post('bil_locality');
		$landmark = $this->input->post('bil_landmark');
		$city = $this->input->post('bil_city');
		$state = $this->input->post('bil_state');
        $country = $this->input->post('bil_country');
		$pincode = $this->input->post('bil_pincode');
		$address_type = $this->input->post('bil_address_type');
		$flat_house_floor_building = $this->input->post('bil_flat_house_floor_building');
		$additional_information = $this->session->userdata('additional_information_session_id');
		$current_date=date('Y-m-d H:i:s');

		

		}

		$user_billing_address_details=  $this->common_my_model->common($table_name ='user_billing_address', $field = array(), $where = array('user_id'=>$user_id,'default_billing'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		

		
		$data = array(
						
						'name'=>$name,
						'email'=>$email,
						'phone'=>$phone,
						'locality'=>$locality,
						'flat_house_floor_building'=>$flat_house_floor_building,
						'landmark'=>$landmark,
						'city'=>$city,
						'state'=>$state,
                        'country'=>$country,
						'pincode'=>$pincode,
						'user_id'=>$user_id,
						'address_type' =>$address_type,
						'additional_information'=>$additional_information,
						'create_dt'=>$current_date
					);	//echo '<pre>';	print_r($data); exit;

		
			$this->db->insert('user_shipping_address',$data);
			$shipping_address_id =$this->db->insert_id();



			/*----------billing data update-----------------*/ 

			$default_billing_data = array(
						
						'name'=>$name,
						'email'=>$email,
						'phone'=>$phone,
						'locality'=>$locality,
						'flat_house_floor_building'=>$flat_house_floor_building,
						'landmark'=>$landmark,
						'city'=>$city,
						'state'=>$state,
                        'country'=>$country,
						'pincode'=>$pincode,
						// 'user_id'=>$user_id,
						// 'address_type' =>$address_type,
						// 'additional_information'=>$additional_information,
						'create_dt'=>$current_date
					);	//echo '<pre>';	print_r($data); exit;

		
			

			$this->db->where('id',$user_billing_address_details[0]->id);
		    $this->db->update('user_billing_address',$default_billing_data);
           /*----------billing data update-----------------*/










			  $order_cart = $this->cart->contents();
              $curr_subtotal = 0;
              $grand_total = 0;
              $cgst_total = 0;
              $sgst_total = 0;
              $shipping_cost = 0;

              foreach ($order_cart as $k=>$item){
              
              $curr_subtotal = $item['price']*$item['qty']; 
             // echo number_format($curr_subtotal, 2);
              $grand_total = $grand_total + $curr_subtotal;

          }



                  if($payment_type=="cod")
				{
                  $order_data = array(
						
						'user_id'=>$user_id,
						'order_total_value'=>$grand_total,
						'order_status'=>'1',
						'payment_status'=>'Unpaid',
						'payment_type'=>$payment_type,
						'date'=>date('Y-m-d H:i:s')
						
					);

              }   


                  if($payment_type=="online")
				{
                  $order_data = array(
						
						'user_id'=>$user_id,
						'order_total_value'=>$grand_total,
						'order_status'=>'1',
						'payment_status'=>'Paid',
						'payment_type'=>$payment_type,
						'date'=>date('Y-m-d H:i:s')
						
					);

              }




          	if($payment_type=="wallet")
				{
					$chk_amt=$this->common_my_model->common($table_name = 'register_users', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

					

		           $my_amt=@$chk_amt[0]->wallet_amount;

		           $new_amt= $my_amt - $grand_total;

		           $data_amt=array('wallet_amount'=>$new_amt);

		           $this->db->where('user_id',$user_id);
		           $this->db->update('register_users',$data_amt);

						$order_data= array(
									
						'user_id'=>$user_id,
						'order_total_value'=>$grand_total,
						'order_status'=>'1',
						'payment_status'=>'Paid',
						'payment_type'=>$payment_type,
						'date'=>date('Y-m-d H:i:s')
									
									);
				}



           

                 $this->db->insert('orders_management',$order_data);
                $order_id= $this->db->insert_id();

                $uni_code= date('Ymd').rand(000,999).$order_id;
				// $string = str_shuffle('QWERTYUIOPASDFGHJKLZXCVBNMqwertyuioplkjhgfdsazxcvbnm1234567890');
				// $uni_track_code = substr($string,-10);
				
				

				$order_update_data= array(
						'order_unique_id'=>$uni_code,
						'shipping_address_id'=>$shipping_address_id,


						'billing_name'=>$name,
						'billing_email'=>$email,
						'billing_phone'=>$phone,
						'billing_locality'=>$locality,
						'billing_flat_house_floor_building'=>$flat_house_floor_building,
						// 'landmark'=>$landmark,
						'billing_city'=>$city,
						'billing_state'=>$state,
                        'billing_country'=>$country,
						'billing_pincode'=>$pincode,
						// 'user_id'=>$user_id,
						// 'address_type' =>$address_type,



									);

				$this->db->where('order_id', $order_id);
				$this->db->update('orders_management',$order_update_data);

             







              $cart = $this->cart->contents();
              foreach ($cart as $k=>$item){

              $product_details=  $this->common_my_model->common($table_name ='product', $field = array(), $where = array('product_id'=>$item['id']), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

             
                 $order_details_data = array(
						
						'order_id'=>$order_id,
						'product_id'=>$item['id'],
						'quantity'=>$item['qty'],
						'price'=>$item['price'],
						
					);

                 $this->db->insert('order_detail',$order_details_data);

             }

             /*-------------- Mail Template -----------------------*/

             $order_list=$this->common_my_model->common($table_name = 'orders_management', $field = array(), $where = array('order_unique_id'=>$uni_code), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

        $order_details=$this->common_my_model->common($table_name = 'order_detail', $field = array(), $where = array('order_id'=>@$order_list[0]->order_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

        // echo $order_unique_id;exit;

        $shipping_address_details=$this->common_my_model->common($table_name = 'user_shipping_address', $field = array(), $where = array('id'=>@$order_list[0]->shipping_address_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

        $my_user_details=$this->common_my_model->common($table_name = 'register_users', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
       
       
      $invoice_no= 'Burnett payment details-'.rand(000,999).''.$order_list[0]->order_id;
     
      $mail_data= array(
                          'order_list'=>$order_list,

                          'order_details'=>$order_details,                         
                          'shipping_address_details'=>$shipping_address_details,
                          
                       
                      );

            @$this->email->set_mailtype("html");

            $html_email_user = $this->load->view('order_details_invoice',$mail_data, true);
            

            // print_r($html_email_user);exit;
             // print_r($send_user_mail_html );exit;
            

            @$this->email->from('support@solutionsfinder.com');
            @$this->email->to($my_user_details[0]->email);
            @$this->email->subject('payment details from Burnett');
            @$this->email->message($html_email_user);
            @$reponse=@$this->email->send();











              /*-------------- Mail Template -----------------------*/


             $this->cart->destroy();



			$this->session->set_flashdata('succ','Your address successfully added.');
				redirect(base_url().'checkout/order_success', 'refresh'); 
						
		

}



        function change_payment_type(){

     $payment_type=$this->input->post('payment_type');
    

     $newData=array(
                'payment_type_session_id'=>$payment_type,
              
            );
            $this->session->set_userdata($newData);

        //  echo  $this->session->userdata('payment_type_session_id');
  
  }

  function change_additional_information(){

     $additional_information=$this->input->post('additional_information');
    

     $newData=array(
                'additional_information_session_id'=>$additional_information,
              
            );
            $this->session->set_userdata($newData);

        //  echo  $this->session->userdata('additional_information_session_id');
  
  }

  function order_success(){

     $user_id=$this->session->userdata('user_session_id');

     if($user_id==''){
       redirect(base_url().'user-registation', 'refresh'); 
     }


     $this->load->view('common/header');
		$this->load->view('order_success_view');
		$this->load->view('common/footer');
  
  }


   function calculate_gst(){

     $state=$this->input->post('state');

     ?>

      <?php $cart = $this->cart->contents();

            $curr_subtotal = 0;
            $grand_total = 0;
            $cgst = 9;
            $sgst = 9;
            $igst = 18;

            $cgst_total = 0;
            $sgst_total = 0;
            $igst_total = 0;

            $without_gst_total = 0;
            $all_total = 0;


            foreach ($cart as $k=>$item){

              $product_details=  $this->common_my_model->common($table_name ='product', $field = array(), $where = array('product_id'=>$item['id']), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

              $curr_subtotal = $item['price']*$item['qty']; 
             // echo number_format($curr_subtotal, 2);
              $grand_total = $grand_total + $curr_subtotal;


             ?>
           
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0"><?php echo @$product_details[0]->product_title .' ('.$item['qty'].')';?></h6>
              </div>
              <span class="text-muted"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format(@$item['price'], 2);?></span>
            </li>

          <?php } ?>

           <!--  <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Second product</h6>
              </div>
              <span class="text-muted"><i class="fa fa-inr" aria-hidden="true"></i> 80</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Third item</h6>
              </div>
              <span class="text-muted"><i class="fa fa-inr" aria-hidden="true"></i> 20</span>
            </li> -->
            <!--<li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Promo code</h6>
                <small>EXAMPLECODE</small>
              </div>
              <span class="text-success">-$5</span>
            </li>-->

             <?php 

            // echo strtolower(str_replace(' ','',@$user_billing_address_details[0]->state));

             if(strtolower(str_replace(' ','',@$state))== 'westbengal'){ 

                 $cgst_total= (($grand_total*$cgst)/100);
                 $sgst_total= (($grand_total*$sgst)/100);

                 $without_gst_total= ($grand_total-($cgst_total+$sgst_total));

                 } else{

                  $igst_total= (($grand_total*$igst)/100);

                  $without_gst_total= ($grand_total-$igst_total);


                 }   

                     ?>



             <li class="list-group-item d-flex justify-content-between">
              <span>Sub Total (INR)</span>
              <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($without_gst_total, 2);?></strong>
            </li>


          <?php if(strtolower(str_replace(' ','',@$state))== 'westbengal'){ 

                // $cgst_total= (($grand_total*$cgst)/100);
               //  $sgst_total= (($grand_total*$sgst)/100);    


           ?>

            <li class="list-group-item d-flex justify-content-between">
              <span>CGST (<?php echo $cgst;?>%)</span>
              <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($cgst_total, 2);?></strong>
            </li>

             <li class="list-group-item d-flex justify-content-between">
              <span>SGST (<?php echo $sgst;?>%)</span>
              <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($sgst_total, 2);?></strong>
            </li>

          <?php } else{

         // $igst_total= (($grand_total*$igst)/100); 
            ?>

            <li class="list-group-item d-flex justify-content-between">
              <span>IGST (<?php echo $igst;?>%)</span>
              <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($igst_total, 2);?></strong>
            </li>

          <?php  } ?>




            <li class="list-group-item d-flex justify-content-between">
              <span>Total (INR)</span>
              <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php 
              $alltotal =  $grand_total;
              echo number_format($alltotal, 2);
              ?></strong>
            </li>



     <?php 
  
  }

	



	
}
?>