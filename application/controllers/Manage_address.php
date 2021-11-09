<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_address extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();
           $this->load->model('common_my_model');
           $this->load->library('image_lib');

	}
	
	public function manage_address_add_view()
	{
    $user_id=$this->session->userdata('user_session_id');

    $user_details=$this->common_my_model->common($table_name = 'register_users', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
    // $country_list=$this->common_my_model->common($table_name = 'country', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
     $state_list=$this->common_my_model->common($table_name = 'states', $field = array(), $where = array('country_id'=>'101'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	?>
	<div class="col-md-9">
      <div class="tab-content" id="myTabContent">

	 <form class="form-horizontal" id="add_manage_address_registration_form" action="<?php echo base_url();?>manage_address/add_submit" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Name <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="name" id="name" value="<?php echo @$user_details[0]->firstname.' '.@$user_details[0]->lastname;?>"  placeholder="Enter your Name" />
                                    
                                            </div>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Contact No <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="phone" id="phone" value="<?php echo @$user_details[0]->phone;?>" placeholder="Enter your Contact No" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" />
                                            </div>
                                        </div>
                                    </div> 


                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Email <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="email" id="email" value="<?php echo @$user_details[0]->email;?>" placeholder="Enter your Email" />
                                            </div>
                                        </div>
                                    </div> 

                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Locality <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="locality" id="locality" value="<?php echo @$user_details[0]->address;?>" placeholder="Enter your Locality" />
                                            </div>
                                        </div>
                                    </div>
                                   

                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Flat No <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="flat_house_floor_building" id="flat_house_floor_building" value="" placeholder="Enter your Contact No" />
                                            </div>
                                        </div>
                                    </div> 


                                   
                                   

                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Pincode <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="pincode" id="pincode" value="" placeholder="Enter your Pincode" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="6" />
                                            </div>
                                        </div>
                                    </div> 


                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Country <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   

                                   <select class="form-control" name="country" id="country" >
                                     <option value="">Select Country</option>
                                     <!-- <?php foreach($country_list as $row){?>
                                      <option value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>
                                    <?php } ?> -->

                                     <option value="India"  >India</option>
                                   </select>




                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">State <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <!-- <input type="text" class="form-control" name="state" id="state" value="" placeholder="Enter your State" /> -->

                                    <select class="form-control" name="state" id="state" >
                                     <option value="">Select State</option>
                                      <?php foreach($state_list as $row){?>
                                      <option value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>
                                    <?php } ?> 

                                     
                                   </select>


                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">City <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="city" id="city" value="" placeholder="Enter your City" />
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="form-group ">
                                        <button type="submit" onclick="return add_manage_address_form_validation()" class="btn btn-primary btn-lg login-button">Submit</button>
                                    </div>                                  
                                </form>
                            </div>
                        </div>


				
	<?php	
	}



	public function manage_address_edit_view()
	{

		$id=$this->input->post('id');
	//	echo $id;

		$manage_address_details=$this->common_my_model->common($table_name = 'user_billing_address', $field = array(), $where = array('id'=>$id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

   // $country_list=$this->common_my_model->common($table_name = 'country', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
     $state_list=$this->common_my_model->common($table_name = 'states', $field = array(), $where = array('country_id'=>'101'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


	?>
	<div class="col-md-9">
      <div class="tab-content" id="myTabContent">

	 <form class="form-horizontal" id="edit_manage_address_registration_form" action="<?php echo base_url();?>manage_address/edit_submit" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Name <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="name" id="name" value="<?php echo @$manage_address_details[0]->name; ?>"  placeholder="Enter your Name" />
                                   <input type="hidden" class="form-control" name="id" id="id" value="<?php echo @$manage_address_details[0]->id; ?>"  placeholder="Enter your First Name" />
                                    
                                            </div>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Contact No <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="phone" id="phone" value="<?php echo @$manage_address_details[0]->phone; ?>" placeholder="Enter your Contact No" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" />
                                            </div>
                                        </div>
                                    </div> 


                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Email <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="email" id="email" value="<?php echo @$manage_address_details[0]->email; ?>" placeholder="Enter your Email" />
                                            </div>
                                        </div>
                                    </div> 

                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Locality <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="locality" id="locality" value="<?php echo @$manage_address_details[0]->locality; ?>" placeholder="Enter your Locality" />
                                            </div>
                                        </div>
                                    </div>
                                   

                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Flat No <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="flat_house_floor_building" id="flat_house_floor_building" value="<?php echo @$manage_address_details[0]->flat_house_floor_building; ?>" placeholder="Enter your Contact No" />
                                            </div>
                                        </div>
                                    </div> 


                                   
                                   

                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Pincode <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="pincode" id="pincode" value="<?php echo @$manage_address_details[0]->pincode; ?>" placeholder="Enter your Pincode" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="6" />
                                            </div>
                                        </div>
                                    </div> 


                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Country <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <select class="form-control" name="country" id="country" >
                                     <option value="">Select Country</option>
                                    
                                    <!--  <?php foreach($country_list as $row){?>
                                      <option value="<?php echo $row->name; ?>" <?php  if(@$manage_address_details[0]->country==$row->name){echo 'selected';}?>   ><?php echo $row->name; ?></option>
                                    <?php } ?> -->

                                     <option value="India" <?php  if(@$manage_address_details[0]->country=='India'){echo 'selected';}?>   >India</option>

                                   </select>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">State <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                  <!--  <input type="text" class="form-control" name="state" id="state" value="<?php echo @$manage_address_details[0]->state; ?>" placeholder="Enter your State" /> -->

                                   <select class="form-control" name="state" id="state" >
                                     <option value="">Select State</option>
                                      <?php foreach($state_list as $row){?>
                                      <option value="<?php echo $row->name; ?>" <?php  if(@$manage_address_details[0]->state==$row->name){echo 'selected';}?> ><?php echo $row->name; ?></option>
                                    <?php } ?> 

                                     
                                   </select>


                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">City <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="city" id="city" value="<?php echo @$manage_address_details[0]->city; ?>" placeholder="Enter your City" />
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="form-group ">
                                        <button type="submit" onclick="return edit_manage_address_form_validation()" class="btn btn-primary btn-lg login-button">Submit</button>
                                    </div>                                  
                                </form>
                            </div>
                        </div>


				
	<?php	
	}



	function add_submit()
	{

		$user_id = $this->session->userdata('user_session_id');
		
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$locality = $this->input->post('locality');
		$landmark = $this->input->post('landmark');
		$city = $this->input->post('city');
		$state = $this->input->post('state');
    $country = $this->input->post('country');
		$pincode = $this->input->post('pincode');
		$flat_house_floor_building = $this->input->post('flat_house_floor_building');
		$current_date=date('Y-m-d H:i:s');


		$chk = $this->common_my_model->common($table_name = 'user_billing_address', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		if(count($chk)>0)
		{
			$default_billing='0';
		}
		else
		{
           $default_billing='1';
		}


		
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
						'default_billing' =>$default_billing,
						// 'landmark'=>'home',
						'create_dt'=>$current_date
					);	//echo '<pre>';	print_r($data); exit;

		
			$this->db->insert('user_billing_address',$data);
			$this->session->set_flashdata('succ','Your address successfully added.');
				redirect(base_url().'my-account', 'refresh'); 
						
		

}



function edit_submit()
  {

    $user_id = $this->session->userdata('user_session_id');
    $id = $this->input->post('id');
    $name = $this->input->post('name');
    $email = $this->input->post('email');
    $phone = $this->input->post('phone');
    $locality = $this->input->post('locality');
    $landmark = $this->input->post('landmark');
    $city = $this->input->post('city');
    $state = $this->input->post('state');
    $country = $this->input->post('country');
    $pincode = $this->input->post('pincode');
    $flat_house_floor_building = $this->input->post('flat_house_floor_building');
    $current_date=date('Y-m-d H:i:s');


   


    
    $data = array(
            
            'name'=>$name,
            'email'=>$email,
            'phone'=>$phone,
            'locality'=>$locality,
            'flat_house_floor_building'=>$flat_house_floor_building,
            'landmark'=>$landmark,
            'city'=>$city,
            'state'=>$state,
            'pincode'=>$pincode,
            'country'=>$country,
           // 'user_id'=>$user_id,
           // 'default_billing' =>$default_billing,
           // 'landmark'=>'home',
            'create_dt'=>$current_date
          );  //echo '<pre>'; print_r($data); exit;

    
      

      $this->db->where('id',$id);
      $this->db->update('user_billing_address',$data);

      $this->session->set_flashdata('succ','Your address successfully updated.');
        redirect(base_url().'my-account', 'refresh'); 
            
    

}







function delete_address($id)
	{

		
        $this ->db-> where('id', $id);
        $this ->db-> delete('user_billing_address');

        $this->session->set_flashdata('succ','Deleted your address.');
	    redirect(base_url().'my-account', 'refresh');
            


          }


 function make_default_manage_address()
    {
        
        $user_id = $this->session->userdata('user_session_id');

        $id = $this->input->post('address_id');
        $data['address'] = $this->common_my_model->common($table_name = 'user_billing_address', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

        $data['pre_default_address'] = $this->common_my_model->common($table_name = 'user_billing_address', $field = array(), $where = array('default_billing'=>'1','user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

        //echo @$default_id=$data['pre_default_address'][0]->id; exit();

        if (@$data['pre_default_address'][0]->default_billing=='1') {

            @$default_id=$data['pre_default_address'][0]->id;

            $data=array(    
                     'default_billing'=>'0'
                     
                    );
        $this->db->where('id',$default_id);
        $this->db->update('user_billing_address',$data);
        }

        $data=array(    
                     'default_billing'=>'1',
                     
                    );

        $this->db->where('id',$id);
        $this->db->update('user_billing_address',$data);

        echo json_encode(array('status'=>'success'));
      

    }





	
}
?>