﻿<!--Body -->
<div class="container-fluid pt-4 pb-4">
<div class="container pt-4 pb-4">
    <h1>Account details</h1>
     <small>
                        <?php
                              $succ_add=$this->session->flashdata('exist');
                              if($succ_add){
                                ?>
                                <br><span style="color:red">
                                  <?php echo $succ_add; ?>
                                </span>
                                <?php
                                  }
                        ?>
                   </small>
                    <small>
                        <?php
                              $succ_add=$this->session->flashdata('succ');
                              if($succ_add){
                                ?>
                                <br><span style="color:green">
                                  <?php echo $succ_add; ?>
                                </span>
                                <?php
                                  }
                        ?>
                   </small>

      <div class="row">
    
    </div>
  <hr>
  <div class="row">
    <div class="col-md-3"> 
    <div class="text-center profile-img">
      <form id="profile_pic_form">
        <?php if(@$user_details[0]->profile_picture==''){?>

        
        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
      <?php } else{?>
        <img src="<?php echo base_url();?>uploads/profile_picture/<?php echo @$user_details[0]->profile_picture;?>" class="avatar img-circle img-thumbnail" alt="avatar">
        
      <?php } ?>
        <p class="pt-2 "><strong>Hello <?php echo @$user_details[0]->firstname; ?></strong></p>
        <p class="pb-2">Upload a different photo...</p>
        <input type="file" id="profile_pic_id"  name="profile_pic" class="text-center center-block file-upload">
      </form>
      </div>  
        <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="true">Dashboard</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false">Orders</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="wishlist-tab" data-toggle="tab" href="#wishlist" role="tab" aria-controls="wishlist" aria-selected="false">Wishlist</a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link" id="addresses-tab" data-toggle="tab" href="#addresses" role="tab" aria-controls="addresses" aria-selected="false">Addresses</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="account-details-tab" data-toggle="tab" href="#account-details" role="tab" aria-controls="account-details" aria-selected="false">Account details</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="wallet-tab" data-toggle="tab" href="#wallet" role="tab" aria-controls="wallet" aria-selected="false">Wallet</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="changepassword-tab" data-toggle="tab" href="#changepassword" role="tab" aria-controls="changepassword" aria-selected="false">Change Passwrod</a>
  </li>

 <li class="nav-item">
    <a class="nav-link"  href="<?php echo base_url();?>login/logout" >Logout</a>
  </li>
</ul>
    </div>
    <!-- /.col-md-4 -->
        <div class="col-md-9">
      <div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
  <h2>Dashboard</h2>
  

<!--     <p> Hello burnett (not burnett? <a href="#">Log out</a>)</p>
    <p> From your account dashboard you can view your <a href="#">recent orders</a>, manage your <a href="#">shipping and billing addresses</a>, and <a href="#">edit your password and account details</a>.</p>
 -->


  <form class="form-horizontal" id="show_my_profile_data_form" action="<?php echo base_url();?>my_profile/edit_profile_data" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Name </label>
                                        <div class="cols-sm-10">
                                                                                            
                                   <?php echo @$user_details[0]->firstname.' '.@$user_details[0]->lastname; ?>
                                            
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Contact Number </label>
                                        <div class="cols-sm-10">
                                                                                           
                                   <?php echo @$user_details[0]->phone; ?>
                                            
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Whats App Number </label>
                                        <div class="cols-sm-10">
                                                                                          
                                   <?php echo @$user_details[0]->whatsapp; ?>
                                         
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Email Id </label>
                                        <div class="cols-sm-10">
                                                                                          
                                   <?php echo @$user_details[0]->email; ?>
                                         
                                        </div>
                                    </div>

                                    <?php if($user_details[0]->user_type=='DR'){?>

                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Doctor Registration No </label>
                                        <div class="cols-sm-10">
                                                                                          
                                   <?php echo @$user_details[0]->registration_no; ?>
                                         
                                        </div>
                                    </div>

                                  <?php } ?>

                                  <?php if($user_details[0]->user_type=='DI'){?>

                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Firm Name </label>
                                        <div class="cols-sm-10">
                                                                                          
                                   <?php echo @$user_details[0]->firmname; ?>
                                         
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Drug License No </label>
                                        <div class="cols-sm-10">
                                                                                          
                                   <?php echo @$user_details[0]->drug_license_no; ?>
                                         
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">GST No/PAN No Of Firm </label>
                                        <div class="cols-sm-10">
                                                                                          
                                  <?php echo @$user_details[0]->gst_pan_no_firm; ?>
                                         
                                        </div>
                                    </div>


                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Address </label>
                                        <div class="cols-sm-10">
                                                                                          
                                  <?php echo @$user_details[0]->address; ?>
                                         
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Area Name for Work </label>
                                        <div class="cols-sm-10">
                                                                                          
                                  <?php echo @$user_details[0]->area_of_work; ?>
                                         
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Name of delearship company </label>
                                        <div class="cols-sm-10">
                                                                                          
                                  <?php echo @$user_details[0]->name_of_company; ?>
                                         
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Estimated Target of Business </label>
                                        <div class="cols-sm-10">
                                                                                          
                                  <?php echo @$user_details[0]->target_of_business; ?>
                                         
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Experience </label>
                                        <div class="cols-sm-10">
                                                                                          
                                 <?php echo @$user_details[0]->year_of_experience; ?>
                                         
                                        </div>
                                    </div>

                                  <?php } ?>



                                  <?php if($user_details[0]->user_type=='ST'){?>

                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Firm Name </label>
                                        <div class="cols-sm-10">
                                                                                          
                                   <?php echo @$user_details[0]->firmname; ?>
                                         
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Drug License No </label>
                                        <div class="cols-sm-10">
                                                                                          
                                   <?php echo @$user_details[0]->drug_license_no; ?>
                                         
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">GST No/PAN No Of Firm </label>
                                        <div class="cols-sm-10">
                                                                                          
                                  <?php echo @$user_details[0]->gst_pan_no_firm; ?>
                                         
                                        </div>
                                    </div>


                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Address </label>
                                        <div class="cols-sm-10">
                                                                                          
                                  <?php echo @$user_details[0]->address; ?>
                                         
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Area Name for Work </label>
                                        <div class="cols-sm-10">
                                                                                          
                                  <?php echo @$user_details[0]->area_of_work; ?>
                                         
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Name of delearship company </label>
                                        <div class="cols-sm-10">
                                                                                          
                                  <?php echo @$user_details[0]->name_of_company; ?>
                                         
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Estimated Target of Business </label>
                                        <div class="cols-sm-10">
                                                                                          
                                  <?php echo @$user_details[0]->target_of_business; ?>
                                         
                                        </div>
                                    </div>
                                    

                                  <?php } ?>



                                     






                                  </form>





     <!-- <p> <?php echo @$user_details[0]->firstname.' '.@$user_details[0]->lastname; ?> </p>
    <p> </p> -->






  </div>
  <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
  <h2>Orders (<?php echo count($order_list);?>)</h2>
  <div class="table-responsive">
   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_table">
  <tr align="center">
    <th>Sl No</th>
    <th>Order Id</th>
    
    <th>Total Price</th>
   <!-- <th>Name</th>
    <th>Phone</th>
    <th>Email</th>
     <th>Pincode</th> -->
    <th>Date</th>
    <th>Status</th>
    <th>Action</th>
    
  </tr>
  
<?php 
$count_order=0;
foreach($order_list as $row){
  $count_order++;
  ?>
  <tr align="center">
    <td><?php echo $count_order; ?></td>
    <td><?php echo $row->order_unique_id;?></td>
    
    <td><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $row->order_total_value;?></td>
    <?php $user_details=$this->common_my_model->common($table_name = 'register_users', $field = array(), $where = array('user_id'=>$row->user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
    ?>
    <!-- <td><?php echo $user_details[0]->firstname.' '.$user_details[0]->lastname;?></td>
    <td><?php echo $user_details[0]->phone;?></td>
    <td><?php echo $user_details[0]->email;?></td> -->
    <!-- <td><?php echo $user_details[0]->order_status;?></td> -->
    <td><?php echo date('M d,Y',strtotime($row->date)); ?></td>
    <td><?php

      if( $row->order_status=='1'){
                              
                             $or_status = '<span class="label label-warning">Processing</span>';
                            }
                            elseif( $row->order_status=='2'){ 
                             
                             $or_status = '<span class="label label-info">Ship In Progress</span>';
                            }
                            elseif( $row->order_status=='3'){ 
                             
                             $or_status = '<span class="label label-success">Delivered</span>';
                            }
                          
                          elseif( $row->order_status=='4'){ 
                              $or_status = '<span class="label label-default">Cancelled</span>';
                           }
                           else
                           {
                              $or_status = '<span class="label label-default">Failed</span>';
                           }




     echo $or_status;?></td>
    <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalord<?php echo $count_order; ?>">
View
</button>

<?php if( $row->order_status =='3'){ ?>
<a title="Invoice"  href="my_profile/download_order_pdf/<?php echo $row->order_unique_id;?>" id="del"  class="btn btn-danger delete_button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>Download</a> <?php } ?>

<?php if( $row->order_status !='3' && $row->order_status !='4'){ ?>
<a title="Cancelled"  href="my_profile/cancelled_order/<?php echo $row->order_id;?>" id="del"  onclick="return confirm('Are you sure ?')" class="btn btn-danger delete_button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>Cancel</a> <?php } ?>

</td>
    
  </tr>








<?php  } ?>
<!--  <tr align="center">
    <td>02</td>
    <td>November, 30, 2020</td>
    <td>Client Name</td>
    <td>The address</td>
    <td>9999999999</td>
    <td><i class="fa fa-inr" aria-hidden="true"></i> 2000</td>
  </tr> -->

</table>
</div>
     </div>

     <div class="tab-pane fade" id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">
  <h2>Wishlist</h2>
  <div class="table-responsive">
   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_table">
  <tr align="center">
    <th>Product Name</th>
    <th>Image</th>
    <th>Price</th>
   <!--  <th>Address</th>
    <th>Phone</th> -->
    <th>action</th>
  </tr>
  
<?php foreach($wishlist_list as $row){?>
  <tr align="center">
    <td><?php 

    $product_details=$this->common_my_model->common($table_name = 'product', $field = array(), $where = array('product_id'=>$row->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    echo @$product_details[0]->product_title; ?></td>
    <td><a href="<?php echo base_url();?>product-details/<?php echo $product_details[0]->product_id;?>/<?php echo $product_details[0]->unique_key;?>"><img style="height:50px;width:50px;" src="<?php echo base_url();?>uploads/product/small/<?php echo $product_details[0]->product_image;?>" /> </a></td>
    
    <td><i class="fa fa-inr" aria-hidden="true"></i>  <?php
                    if($product_details[0]->product_type=='simple'){ 
                    $price= $product_details[0]->product_price;
                      }else{

                        $product_variable_attribute=  $this->common_my_model->common($table_name ='product_variable_attribute', $field = array(), $where = array('product_id'=>@$product_details[0]->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = ''); 
                        $product_variable_attribute_last=  $this->common_my_model->common($table_name ='product_variable_attribute', $field = array(), $where = array('product_id'=>@$product_details[0]->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array('variable_attribute_id'=>'desc'), $start = '', $end = '');       

                         $price= $product_variable_attribute[0]->product_price;
                          
                      }

                       echo $price;
                    ?></td>
    <td><a title="delete"  href="my_profile/delete_wishlist/<?php echo $row->wish_id;?>" id="del"  onclick="return confirm('Are you sure ?')" class="btn btn-danger delete_button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>Delete</a></td>
  </tr>

<?php } ?>
 
</table>
</div>
     </div>
  <div class="tab-pane fade" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
  <h2>Addresses</h2>
   <p>The following addresses will be used on the checkout page by default.</p>
   <a href="#" class="btn btn-primary btn-lg login-button" onclick="add_menage_address_show();">Add</a>
   <!-- <button type="submit" onclick="return cu_sign_up_form_validation()" class="btn btn-primary btn-lg login-button">Register</button> -->
    <div class="row">

      <?php if(count($manage_address_list)>0){
      foreach($manage_address_list as $rowadd) {?>
        <div class="col-md-6">
        <h4><?php echo $rowadd->name; ?></h4>
        <p><?php echo $rowadd->email; ?></p>
        <p><?php echo $rowadd->phone; ?></p>
        <p><?php echo $rowadd->locality; ?></p>
        <p><?php echo $rowadd->pincode; ?></p>
        <p>
          <?php if($rowadd->default_billing=='0'){ ?>
          <a href="#" class="btn btn-primary btn-lg login-button" onclick="change_status_default_address(<?php echo @$rowadd->id; ?>)">Make default</a>
        <?php } ?>
        <?php if($rowadd->default_billing=='1'){ ?>

                <a href="#" class="btn btn-primary btn-lg login-button" >Default</a>
          <?php } ?>

        </p>
        
        <a href="#" onclick="edit_menage_address_show('<?php echo $rowadd->id; ?>');" >Edit</a>
         <a title="delete" href="manage_address/delete_address/<?php echo $rowadd->id;?>" id="del"  onclick="return confirm('Are you sure ?')"  >Delete</a>
        </div>

      <?php } } else{ echo 'Added No Address .';}?>

       <!-- <div class="col-md-6">
        <h4>Shipping address</h4>
        <p>You have not set up this type of address yet. </p>
        <a href="#">Edit</a>
        </div>

         <div class="col-md-6">
        <h4>Shipping address</h4>
        <p>You have not set up this type of address yet. </p>
        <a href="#">Edit</a>
        </div> -->


    </div>

    <div class="row"id="add_view_address"></div>
    <div class="row"id="edit_view_address"></div>



  </div>
  <div class="tab-pane fade" id="account-details" role="tabpanel" aria-labelledby="account-details">
  <h2>Account details</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, eveniet earum. Sed accusantium eligendi molestiae quo hic velit nobis et, tempora placeat ratione rem blanditiis voluptates vel ipsam? Facilis, earum!</p> 

    <!-- <form class="form-horizontal" id="cu_registration_form" action="<?php echo base_url();?>sign_up/sign_up_submt_data" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">First Name <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter your First Name" />
                                    <input type="hidden" name="user_type" value="CU" />
                                            </div>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Last Name <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter your Last Name" />
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Telephone Number <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
              <input type="text" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="phone" id="phone" placeholder="Enter your Telephone Number" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Whats App Number</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
              <input type="text" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="whatsapp" id="whatsapp" placeholder="Enter your Whats App Number" />
                                            </div>
                                        </div>
                                    </div>   

                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Email Id</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
              <input type="text" class="form-control" name="email" id="email" placeholder="Enter your Email Id" />
                                            </div>
                                        </div>
                                    </div>                                    
                                    
                                                                                                            
                                 

                                    
                                    <div class="form-group ">
                                        <button type="submit" onclick="return cu_sign_up_form_validation()" class="btn btn-primary btn-lg login-button">Register</button>
                                    </div>                                  
                                </form> -->

                                <?php if(@$user_details[0]->user_type=='CU'){?>



                                <form class="form-horizontal" id="cu_registration_form" action="<?php echo base_url();?>my_profile/edit_profile_data" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">First Name <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="cu_firstname" id="cu_firstname" value="<?php echo @$user_details[0]->firstname; ?>"  placeholder="Enter your First Name" />
                                    <input type="hidden" name="user_type" value="CU" />
                                            </div>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Last Name <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="cu_lastname" id="cu_lastname" value="<?php echo @$user_details[0]->lastname; ?>" placeholder="Enter your Last Name" />
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Telephone Number <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
              <input type="text" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="cu_phone" id="cu_phone" value="<?php echo @$user_details[0]->phone; ?>" placeholder="Enter your Telephone Number" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Whats App Number</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
              <input type="text" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="cu_whatsapp" id="cu_whatsapp" value="<?php echo @$user_details[0]->whatsapp; ?>" placeholder="Enter your Whats App Number" />
                                            </div>
                                        </div>
                                    </div>   

                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Email Id</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
              <input type="text" class="form-control" name="cu_email" id="cu_email" value="<?php echo @$user_details[0]->email; ?>" placeholder="Enter your Email Id" />
                                            </div>
                                        </div>
                                    </div>                                    
                                    
                                                                                                            
                                    <!-- <div class="form-group">
                                        <label for="password" class="cols-sm-2 control-label">Password <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                              
                                                <input type="password" class="form-control" name="cu_password" id="cu_password"  placeholder="Enter your Password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm" class="cols-sm-2 control-label">Confirm Password <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                                <input type="password" class="form-control" name="cu_confirm" id="cu_confirm" placeholder="Confirm your Password" />
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="form-group ">
                                        <button type="submit" onclick="return cu_sign_up_form_validation()" class="btn btn-primary btn-lg login-button">Update</button>
                                    </div>                                  
                                </form>


                                    <?php } ?> 

                                    <?php if($user_details[0]->user_type=='DR'){?>


                                 <form class="form-horizontal" id="dr_registration_form" action="<?php echo base_url();?>my_profile/edit_profile_data" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">First Name <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="dr_firstname" id="dr_firstname" value="<?php echo @$user_details[0]->firstname; ?>"   placeholder="Enter your First Name" />
                                   <input type="hidden" name="user_type" value="DR" />
                                            </div>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Last Name <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="dr_lastname" id="dr_lastname" value="<?php echo @$user_details[0]->lastname; ?>" placeholder="Enter your Last Name" />
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Telephone Number <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
              <input type="text" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="dr_phone" id="dr_phone" value="<?php echo @$user_details[0]->phone; ?>" placeholder="Enter your Telephone Number" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Whats App Number</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
              <input type="text" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="dr_whatsapp" id="dr_whatsapp" value="<?php echo @$user_details[0]->whatsapp; ?>" placeholder="Enter your Whats App Number" />
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="email" class="cols-sm-2 control-label">Doctor Email  <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
              <input type="text" class="form-control" name="dr_email" id="dr_email" value="<?php echo @$user_details[0]->email; ?>" placeholder="Enter your Email" />
                                            </div>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label for="email" class="cols-sm-2 control-label">Have You any registration no  <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
              
                                       <!-- <select class="form-control" name="dr_have_registration_no" id="dr_have_registration_no" onchange="change_dr_registration();"> 
                                        <option value="">Select registration no</option>
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>

                                        </select> -->

                                        <input type="radio"  class="form-control" name="dr_have_registration_no"  onclick="change_dr_registration();" value="Y" <?php if(@$user_details[0]->have_registration_no=='Y'){echo 'checked';} ?> >Yes</input>
                                        <input type="radio" onclick="change_dr_registration();" class="form-control" name="dr_have_registration_no"  value="N" <?php if(@$user_details[0]->have_registration_no=='N'){echo 'checked';} ?> >No</input>




                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" id="show_dr_registration">
                                        
                                    </div>

                                                                                                            
                                   <!--  <div class="form-group">
                                        <label for="password" class="cols-sm-2 control-label">Password <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                              
                                                <input type="password" class="form-control" name="dr_password" id="dr_password"  placeholder="Enter your Password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm" class="cols-sm-2 control-label">Confirm Password <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                                <input type="password" class="form-control" name="dr_confirm" id="dr_confirm" placeholder="Confirm your Password" />
                                            </div>
                                        </div>
                                    </div> -->


                                    <div class="form-group ">
                                        <button type="submit" onclick="return dr_sign_up_form_validation()" class="btn btn-primary btn-lg login-button">Update</button>
                                    </div>                                  
                                </form>

                                    <?php } ?> 

                                    <?php if($user_details[0]->user_type=='DI'){?>




                                <form class="form-horizontal" id="di_registration_form" action="<?php echo base_url();?>my_profile/edit_profile_data" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">First Name <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="di_firstname" id="di_firstname" value="<?php echo @$user_details[0]->firstname; ?>" placeholder="Enter your First Name" />
                                   <input type="hidden" name="user_type" value="DI" />
                                            </div>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Last Name <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="di_lastname" id="di_lastname" value="<?php echo @$user_details[0]->lastname; ?>" placeholder="Enter your Last Name" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Firm Name <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="di_firmname" id="di_firmname" value="<?php echo @$user_details[0]->firmname; ?>" placeholder="Enter your Firm Name" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Drug License No <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="di_drug_license_no" id="di_drug_license_no" value="<?php echo @$user_details[0]->drug_license_no; ?>" placeholder="Enter your Drug License No" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">GST No/PAN No Of Firm <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="di_gst_pan_no_firm" id="di_gst_pan_no_firm" value="<?php echo @$user_details[0]->gst_pan_no_firm; ?>" placeholder="Enter your GST No" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Address <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                            <textarea class="form-control" name="di_address" id="di_address"><?php echo @$user_details[0]->address; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Telephone Number <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="di_phone" id="di_phone" value="<?php echo @$user_details[0]->phone; ?>" placeholder="Enter your Telephone Number" />
                                            </div>
                                        </div>
                                    </div>
                                                                        
                                    <div class="form-group">
                                        <label for="email" class="cols-sm-2 control-label">Distributor Email <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                       <input type="text" class="form-control" name="di_email" id="di_email" value="<?php echo @$user_details[0]->email; ?>" placeholder="Enter Distributor Email" />
                                            </div>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Whats App Number</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
              <input type="text" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="di_whatsapp" id="di_whatsapp" value="<?php echo @$user_details[0]->whatsapp; ?>" placeholder="Enter your Whats App Number" />
                                            </div>
                                        </div>
                                    </div>  
                                    
                                    <div class="form-group">
                                        <label for="username" class="cols-sm-2 control-label">Area Name for Work <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                             
                                    <input type="text" class="form-control" name="di_area_of_work" id="di_area_of_work" value="<?php echo @$user_details[0]->area_of_work; ?>" placeholder="Enter Area Name for Work" />
                                            </div>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label for="email" class="cols-sm-2 control-label">Have You any registration no  <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
              
                                     <!--   <select class="form-control" name="di_prev_any_delarship" id="di_prev_any_delarship" onchange="change_di_delarship();"> 
                                        <option value="">Select delarship</option>
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>

                                        </select> -->

                                         <input type="radio" checked class="form-control" name="di_prev_any_delarship"  onclick="change_di_delarship();" value="Y" <?php if(@$user_details[0]->prev_any_delarship=='Y'){echo 'checked';} ?> >Yes</input>
                                        <input type="radio" onclick="change_di_delarship();" class="form-control" name="di_prev_any_delarship"  value="N" <?php if(@$user_details[0]->prev_any_delarship=='N'){echo 'checked';} ?> >No</input>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" id="show_di_delarship">
                                        
                                    </div>








                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Estimated Target of Business – (by amount in lacks)</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                             
                                    <input type="text" class="form-control" name="di_target_of_business" id="di_target_of_business" value="<?php echo @$user_details[0]->target_of_business; ?>" placeholder="Estimated Target of Business – (by amount in lacks)" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">How Many Year of Experience in this Field<span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                             
                                    <input type="number" class="form-control" name="di_year_of_experience" id="di_year_of_experience" value="<?php echo @$user_details[0]->year_of_experience; ?>" placeholder="0" />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="password" class="cols-sm-2 control-label">Password <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                              
                                                <input type="password" class="form-control" name="di_password" id="di_password"  placeholder="Enter your Password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm" class="cols-sm-2 control-label">Confirm Password <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                                <input type="password" class="form-control" name="di_confirm" id="di_confirm"  placeholder="Confirm your Password" />
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="form-group ">
                                        <button type="submit" onclick="return di_sign_up_form_validation()" class="btn btn-primary btn-lg login-button">Update</button>
                                    </div>                                  
                                </form>

                                <?php } ?> 

                                    <?php if($user_details[0]->user_type=='ST'){?>



                                 <form class="form-horizontal" id="st_registration_form" action="<?php echo base_url();?>my_profile/edit_profile_data" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">First Name <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="st_firstname" id="st_firstname" value="<?php echo @$user_details[0]->firstname; ?>"  placeholder="Enter your First Name" />
                                    <input type="hidden" name="user_type" value="ST" />
                                            </div>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Last Name <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="st_lastname" id="st_lastname" value="<?php echo @$user_details[0]->lastname; ?>"  placeholder="Enter your Last Name" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Firm Name <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="st_firmname" id="st_firmname" value="<?php echo @$user_details[0]->firmname; ?>"  placeholder="Enter your Firm Name" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Drug License No <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="st_drug_license_no" id="st_drug_license_no" value="<?php echo @$user_details[0]->drug_license_no; ?>"  placeholder="Enter your Drug License No" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">GST No/PAN No Of Firm <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="st_gst_pan_no_firm" id="st_gst_pan_no_firm" value="<?php echo @$user_details[0]->gst_pan_no_firm; ?>"  placeholder="Enter your GST No" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Address <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                            <textarea class="form-control" name="st_address" id="st_address" ><?php echo @$user_details[0]->address; ?> </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Telephone Number <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="st_phone" id="st_phone" value="<?php echo @$user_details[0]->phone; ?>"  placeholder="Enter your Telephone Number" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Whats App Number <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="st_whatsapp" id="st_whatsapp" value="<?php echo @$user_details[0]->whatsapp; ?>"   placeholder="Enter your Whats App Number" />
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="email" class="cols-sm-2 control-label">Stockist Email <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                       <input type="text" class="form-control" name="st_email" id="st_email" value="<?php echo @$user_details[0]->email; ?>"  placeholder="Enter Stockist Email" />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="username" class="cols-sm-2 control-label">Licence Number <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                             
                                    <input type="text" class="form-control" name="st_whatsapp" id="st_whatsapp" placeholder="Licence Number" />
                                            </div></div></div> -->
                                    <div class="form-group">
                                        <label for="username" class="cols-sm-2 control-label">Area Name for Work <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                             
                                    <input type="text" class="form-control" name="st_area_of_work" id="st_area_of_work" value="<?php echo @$user_details[0]->area_of_work; ?>"  placeholder="Enter Area Name for Work" />
                                            </div>
                                        </div>
                                    </div>


                                     <div class="form-group">
                                        <label for="email" class="cols-sm-2 control-label">Have You any delearship no  <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
              
                                      <!--  <select class="form-control" name="st_prev_any_delarship" id="st_prev_any_delarship" onchange="change_st_delarship();"> 
                                        <option value="">Select delarship</option>
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>

                                        </select> -->

                                         <input type="radio" checked class="form-control" name="st_prev_any_delarship"  onclick="change_st_delarship();" value="Y" <?php if(@$user_details[0]->prev_any_delarship=='Y'){echo 'checked';} ?> >Yes</input>
                                        <input type="radio" onclick="change_st_delarship();" class="form-control" name="st_prev_any_delarship"  value="N" <?php if(@$user_details[0]->prev_any_delarship=='N'){echo 'checked';} ?> >No</input>



                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" id="show_st_delarship">
                                        
                                    </div>




                                    <div class="form-group">
                                        <label for="username" class="cols-sm-2 control-label">Estimated Target of Business – (by amount in lacks)</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                             
                                    <input type="text" class="form-control" name="st_target_of_business" id="st_target_of_business" value="<?php echo @$user_details[0]->target_of_business; ?>"  placeholder="Estimated Target of Business – (by amount in lacks)" />
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <!-- <div class="form-group">
                                        <label for="password" class="cols-sm-2 control-label">Password <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                              
                                                <input type="password" class="form-control" name="st_password" id="st_password"  placeholder="Enter your Password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm" class="cols-sm-2 control-label">Confirm Password <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                                <input type="password" class="form-control" name="st_confirm" id="st_confirm" placeholder="Confirm your Password" />
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="form-group ">
                                        <button type="submit" onclick="return st_sign_up_form_validation()" class="btn btn-primary btn-lg login-button">Update</button>
                                    </div>                                  
                                </form>

                                <?php } ?> 


                               









  </div>


   <?php 

        $user_id= $this->session->userdata('user_session_id');

        $user_wallet_details_payment=  $this->common_my_model->common($table_name ='register_users', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

        ?>


   <div class="tab-pane fade" id="wallet" role="tabpanel" aria-labelledby="wallet-tab">
  <h2>User Wallet (<?php echo @$user_wallet_details_payment[0]->wallet_amount;?>)</h2>
  <form class="form-horizontal" id="wallet_amount_validation_id" action="<?php echo base_url();?>my_profile/wallet_data_submit" name="wallet_amount_validation_id" method="post" enctype="multipart/form-data">


                                    
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Amount <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="text" class="form-control" name="amount" id="amount" value=""   placeholder="Enter Your Amount" />

                                     



         <input type="hidden" name="wallet_login_email" id="wallet_login_email" value="<?php echo @$user_wallet_details_payment[0]->email;?>">

          <input type="hidden" name="wallet_login_mobile" id="wallet_login_mobile" value="<?php echo @$user_wallet_details_payment[0]->phone;?>">

                                   
                                  
                                            </div>
                                        </div>
                                    </div>


                                   

                                                                     
                                </form>
                                     <!-- only for razarpay----->
                                   <div class="form-group ">
                                        <button type="submit" onclick="return wallet_amount_validation()" class="btn btn-primary btn-lg login-button">Submit</button>
                                    </div> 


                                     <!---------------------list------------------->

                                     <h2>Wallet Transaction (<?php echo @$user_wallet_details_payment[0]->wallet_amount;?>)</h2>
  <div class="table-responsive">
   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_table">
  <tr align="center">
    <th>Transaction Id</th>
    
    <th>Price</th>
   <!--  <th>Address</th>
    <th>Phone</th> -->
    <th>Date</th>
  </tr>
  
<?php foreach($wallet_transaction_list as $row){?>
  <tr align="center">
    <td><?php  echo @$row->transaction_id; ?></td>
    
    
    <td><i class="fa fa-inr" aria-hidden="true"></i>  <?php  echo @$row->transaction_amount; ?></td>
    <td><?php  echo @$row->transaction_date; ?></td>
  </tr>

<?php } ?>
 
</table>
</div>





     </div>




   <div class="tab-pane fade" id="changepassword" role="tabpanel" aria-labelledby="changepassword-tab">
  <h2>Change Password</h2>
  <form class="form-horizontal" id="pass_validation_id" name="pass_validation_id" method="post" enctype="multipart/form-data">


                                     <span id="succ_match" style="color:green;"></span>
                                     <span id="old_pass_match" style="color:red;"></span>
                                     <span id="new_pass_match" style="color:red;"></span>
                                     <span id="conf_pass_match" style="color:red;"></span>
                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Old Password <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="password" class="form-control" name="old_pass" id="old_pass" value=""   placeholder="Enter Old Password" />

                                   
                                  
                                            </div>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">New Password <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="password" class="form-control" name="new_password" id="new_password" value="" placeholder="Enter New Password" />
                                   
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Confirm Password <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                                
                                   <input type="password" class="form-control" name="confirm_password" id="confirm_password" value="" placeholder="Enter Confirm Password" />

                                    
                                            </div>
                                        </div>
                                    </div> 

                                     <div class="form-group ">
                                        <button type="button" onclick="return change_pass_validation()" class="btn btn-primary btn-lg login-button">Change Password</button>
                                    </div>                                  
                                </form>





     </div>




















</div>
    </div>
    <!-- /.col-md-8 -->
  </div> 
  
</div>
</div>

<!-- Body---->


<!-------Modal Order detaiols---------->
<!-------Modal Order detaiols---------->

<?php 
$count_order_modal=0;
foreach($order_list as $row){
  $count_order_modal++;

  $order_modal_billing_details=$this->common_my_model->common($table_name ='user_billing_address', $field = array(), $where = array('user_id'=>$row->user_id,'default_billing'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

$order_modal_shipping_details=$this->common_my_model->common($table_name ='user_shipping_address', $field = array(), $where = array('id'=>$row->shipping_address_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


  
  ?>

<!-- <div class="container-fluid pt-4 pb-4">
<div class="container pt-4 pb-4"> -->
<!-- Button to Open the Modal -->


<!-- The Modal -->
<div class="modal fade" id="myModalord<?php echo $count_order_modal;?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <div class="row">
      <div class="col-md-6">
       <!--  <h4>Billing address</h4>
        <p><?php echo $order_modal_billing_details[0]->name;?></p>  
        <p><?php echo $order_modal_billing_details[0]->email;?></p>
        <p><?php echo $order_modal_billing_details[0]->phone;?></p>
        <p><?php echo $order_modal_billing_details[0]->locality .' ,'.$order_modal_billing_details[0]->flat_house_floor_building;?></p>
        <p><?php echo $order_modal_billing_details[0]->city .' , '.$order_modal_billing_details[0]->pincode;?></p>
      
        <p><?php echo $order_modal_billing_details[0]->state .' , '. $order_modal_billing_details[0]->country;?></p> -->

         <h4>Billing address</h4>
        <p><?php echo $row->billing_name;?></p>  
        <p><?php echo $row->billing_email;?></p>
        <p><?php echo $row->billing_phone;?></p>
        <p><?php echo $row->billing_locality .' ,'.$row->billing_flat_house_floor_building;?></p>
        <p><?php echo $row->billing_city .' , '.$row->billing_pincode;?></p>
      
        <p><?php echo $row->billing_state .' , '. $row->billing_country;?></p>
       
        </div>
       <div class="col-md-6">
        <h4>Shipping address</h4>
        <p><?php echo $order_modal_shipping_details[0]->name;?></p>  
        <p><?php echo $order_modal_shipping_details[0]->email;?></p>
        <p><?php echo $order_modal_shipping_details[0]->phone;?></p>
        <p><?php echo $order_modal_shipping_details[0]->locality .' ,'.$order_modal_shipping_details[0]->flat_house_floor_building;?></p>
        <p><?php echo $order_modal_shipping_details[0]->city .' , '.$order_modal_shipping_details[0]->pincode;?></p>
       <!--  <p><?php echo $order_modal_billing_details[0]->pincode;?></p> -->
        <p><?php echo $order_modal_shipping_details[0]->state .' , '. $order_modal_shipping_details[0]->country;?></p>        
        </div>
    </div>
     <div class="table-responsive cart-main">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="20%" scope="col"> </th>
                            <th scope="col" colspan="3">Product</th>                           
                            <th scope="col" class="text-left">Quantity</th>
                            <th colspan="2" scope="col" class="text-right">Price</th>
                        </tr>
                    </thead>
                    <tbody>

                      <?php $order_details_modal=$this->common_my_model->common($table_name ='order_detail', $field = array(), $where = array('order_id'=>$row->order_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

                        
                              ?>

                       <?php foreach($order_details_modal as $ord_row){

                        $order_modal_product_details=$this->common_my_model->common($table_name ='product', $field = array(), $where = array('product_id'=>$ord_row->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

                        ?>       
                        <tr>

                            <td class="product_cart_img"><img src="<?php echo base_url().'uploads/product/small/'.$order_modal_product_details[0]->product_image;?>" /> </td>
                            <td colspan="3"><?php echo $order_modal_product_details[0]->product_title;?></td>                           
                            <td class="product-count"><?php echo $ord_row->quantity;?></td>
                            <td colspan="2" class="text-right"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $ord_row->price;?></td>
                        </tr>
                      <?php } ?>
                       
                       <!--  <tr>
                            <td class="product_cart_img"><img src="images/Ashoka-Tonic01.jpg" /> </td>
                            <td colspan="3">Ashoka Tonic</td>                            
                            <td class="product-count">1</td>
                            <td colspan="2" class="text-right"><i class="fa fa-inr" aria-hidden="true"></i> 33,90</td>
                        </tr>
                        <tr>
                            <td class="product_cart_img"><img src="images/Ashoka-Tonic01.jpg" /> </td>
                            <td colspan="3">Ashoka Tonic</td>                            
                            <td class="product-count">1</td>
                            <td colspan="2" class="text-right"><i class="fa fa-inr" aria-hidden="true"></i> 70,00</td>
                        </tr> -->
                           <?php if(@$row->user_discount !=0){?>
                         <tr>
                            <td></td>
                            <td colspan="2"></td>
                            <td></td>
                            <td class="text-right"><strong>User Discount</strong>: </td>                          
                            <td colspan="2" class="text-right"> <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($row->user_discount,2);?></strong></td>
                        </tr>
                      <?php } ?>
                      <?php if(@$row->coupon_discount !=""){?>
                         <tr>
                            <td></td>
                            <td colspan="2"></td>
                            <td></td>
                            <td class="text-right"><strong>Coupon Discount</strong>: </td>                          
                            <td colspan="2" class="text-right"> <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($row->coupon_discount,2);?></strong></td>
                        </tr>

                        <?php } ?>

                              <tr>
                            <td></td>
                            <td colspan="2"></td>
                            <td></td>
                            <td class="text-right"><strong>Total</strong>: </td>                          
                            <td colspan="2" class="text-right"> <strong><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($row->order_total_value,2);?></strong></td>
                        </tr>

                    </tbody>

                </table>
            </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
      </div>

    </div>
  </div>
</div>


<!-- </div>
</div> -->


<?php } ?>





<script type="text/javascript">

function cu_data_Submit_fm()
{
        var cu_firstname=$("#cu_firstname").val();       
        if (cu_firstname=="") 
        {
            $('#cu_firstname').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#cu_firstname').removeClass('red_border').addClass('black_border');               
        }

         var cu_lastname=$("#cu_lastname").val();       
        if (cu_lastname=="") 
        {
            $('#cu_lastname').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#cu_lastname').removeClass('red_border').addClass('black_border');               
        }



        var cu_phone=$("#cu_phone").val();       
        if (cu_phone=="" || cu_phone.length<10) 
        {
            $('#cu_phone').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#cu_phone').removeClass('red_border').addClass('black_border');               
        }


        var cu_email=$("#cu_email").val();       
        if (!isEmail(cu_email)) 
        {
            $('#cu_email').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#cu_email').removeClass('red_border').addClass('black_border');               
        }


        // var cu_password=$("#cu_password").val();       
        // if (cu_password=="") 
        // {
        //     $('#cu_password').removeClass('black_border').addClass('red_border');
        // } 
        // else 
        // {
        //     $('#cu_password').removeClass('red_border').addClass('black_border');               
        // }


        // var cu_confirm=$("#cu_confirm").val();
        // if (cu_confirm=="" || cu_confirm!=cu_password) 
        // {
        //     $('#cu_confirm').removeClass('black_border').addClass('red_border');            
        // } 
        // else 
        // {
        //     $('#cu_confirm').removeClass('red_border').addClass('black_border');
        // }


}

function cu_sign_up_form_validation()
  {
    //alert('ok');

          // var cat_ids=[];
          //   $(':checkbox[id^="chk_bx"]:checked').each(function(){        
          //    cat_ids.push($(this).val());              
          // });



        $('#cu_registration_form').attr('onchange', 'cu_data_Submit_fm()');
        $('#cu_registration_form').attr('onkeypress', 'cu_data_Submit_fm()');

        cu_data_Submit_fm();

      //  alert($('#user_registration_form_id .red_border').size());

        if ($('#cu_registration_form .red_border').length > 0)
        {

            $('#cu_registration_form .red_border:first').focus();
            $('#cu_registration_form .alert-error').show();
            return false;
        }

        // else if(cat_ids.length==0){              
        //   alert("Please agree with our terms and conditions.");              
        //   return false;            
        // }

        else {

        $("#cu_registration_form").submit();
      } 
  }
</script> 






<script type="text/javascript">

function dr_data_Submit_fm()
{
        var dr_firstname=$("#dr_firstname").val();       
        if (dr_firstname=="") 
        {
            $('#dr_firstname').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#dr_firstname').removeClass('red_border').addClass('black_border');               
        }

         var dr_lastname=$("#dr_lastname").val();       
        if (dr_lastname=="") 
        {
            $('#dr_lastname').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#dr_lastname').removeClass('red_border').addClass('black_border');               
        }



        var dr_phone=$("#dr_phone").val();       
        if (dr_phone=="" || dr_phone.length<10) 
        {
            $('#dr_phone').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#dr_phone').removeClass('red_border').addClass('black_border');               
        }


        var dr_email=$("#dr_email").val();       
        if (!isEmail(dr_email)) 
        {
            $('#dr_email').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#dr_email').removeClass('red_border').addClass('black_border');               
        }

      //  var dr_have_registration_no=$("#dr_have_registration_no").val();       
       
        var dr_have_registration_no=  $("input[type='radio'][name='dr_have_registration_no']:checked").val();  
          if(dr_have_registration_no=='Y'){

            var dr_registration_no=$("#dr_registration_no").val();       
        if (dr_registration_no=="") 
        {
            $('#dr_registration_no').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#dr_registration_no').removeClass('red_border').addClass('black_border');               
        }


          }


           if(dr_have_registration_no=='N'){

            var dr_chember_picture=$("#dr_chember_picture").val();       
        if (dr_chember_picture=="") 
        {
            $('#dr_chember_picture').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#dr_chember_picture').removeClass('red_border').addClass('black_border');               
        }


          }





         






        // var dr_password=$("#dr_password").val();       
        // if (dr_password=="") 
        // {
        //     $('#dr_password').removeClass('black_border').addClass('red_border');
        // } 
        // else 
        // {
        //     $('#dr_password').removeClass('red_border').addClass('black_border');               
        // }

       

        // var dr_confirm=$("#dr_confirm").val();
        // if (dr_confirm=="" || dr_confirm!=dr_password) 
        // {
        //     $('#dr_confirm').removeClass('black_border').addClass('red_border');            
        // } 
        // else 
        // {
        //     $('#dr_confirm').removeClass('red_border').addClass('black_border');
        // }


}

function dr_sign_up_form_validation()
  {
    //alert('ok');

          // var cat_ids=[];
          //   $(':checkbox[id^="chk_bx"]:checked').each(function(){        
          //    cat_ids.push($(this).val());              
          // });



        $('#dr_registration_form').attr('onchange', 'dr_data_Submit_fm()');
        $('#dr_registration_form').attr('onkeypress', 'dr_data_Submit_fm()');

        dr_data_Submit_fm();

      //  alert($('#user_registration_form_id .red_border').size());

        if ($('#dr_registration_form .red_border').length > 0)
        {

            $('#dr_registration_form .red_border:first').focus();
            $('#dr_registration_form .alert-error').show();
            return false;
        }

        // else if(cat_ids.length==0){              
        //   alert("Please agree with our terms and conditions.");              
        //   return false;            
        // }

        else {

        $("#dr_registration_form").submit();
      } 
  }



function change_dr_registration(){

  var change_reg_val=  $("input[type='radio'][name='dr_have_registration_no']:checked").val();

 var html='';

    if(change_reg_val=='Y')
    {
        html=' <label for="email" class="cols-sm-2 control-label">Doctor Registration Id  <span>*</span></label><div class="cols-sm-10"><div class="input-group"><input type="text" class="form-control" name="dr_registration_no" id="dr_registration_no" placeholder="Enter your Registration Id" /></div></div>';
     
    }else{

         html=' <label for="email" class="cols-sm-2 control-label">Doctor Chember Picture  <span>*</span></label><div class="cols-sm-10"><div class="input-group"><input type="file" class="form-control" name="dr_chember_picture" id="dr_chember_picture"" /></div></div>';

    }

    $("#show_dr_registration").html(html);

}



</script> 



<script type="text/javascript">




function di_data_Submit_fm()
{
        var di_firstname=$("#di_firstname").val();       
        if (di_firstname=="") 
        {
            $('#di_firstname').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#di_firstname').removeClass('red_border').addClass('black_border');               
        }

         var di_lastname=$("#di_lastname").val();       
        if (di_lastname=="") 
        {
            $('#di_lastname').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#di_lastname').removeClass('red_border').addClass('black_border');               
        }


         var di_firmname=$("#di_firmname").val();       
        if (di_firmname=="") 
        {
            $('#di_firmname').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#di_firmname').removeClass('red_border').addClass('black_border');               
        }

          var di_drug_license_no=$("#di_drug_license_no").val();       
        if (di_drug_license_no=="") 
        {
            $('#di_drug_license_no').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#di_drug_license_no').removeClass('red_border').addClass('black_border');               
        }





          var di_gst_pan_no_firm=$("#di_gst_pan_no_firm").val();       
        if (di_gst_pan_no_firm=="") 
        {
            $('#di_gst_pan_no_firm').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#di_gst_pan_no_firm').removeClass('red_border').addClass('black_border');               
        }
          var di_address=$("#di_address").val();       
        if (di_address=="") 
        {
            $('#di_address').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#di_address').removeClass('red_border').addClass('black_border');               
        }
          var di_phone=$("#di_phone").val();       
        if (di_phone=="") 
        {
            $('#di_phone').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#di_phone').removeClass('red_border').addClass('black_border');               
        }
          var di_email=$("#di_email").val();       
         
         if (!isEmail(di_email)) 
        {
            $('#di_email').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#di_email').removeClass('red_border').addClass('black_border');               
        }
          var di_area_of_work=$("#di_area_of_work").val();       
        if (di_area_of_work=="") 
        {
            $('#di_area_of_work').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#di_area_of_work').removeClass('red_border').addClass('black_border');               
        }
         







        // var di_prev_any_delarship=$("#di_prev_any_delarship").val(); 
         var di_prev_any_delarship=  $("input[type='radio'][name='di_prev_any_delarship']:checked").val();      
       

          if(di_prev_any_delarship=='Y'){

            var di_name_of_company=$("#di_name_of_company").val();       
        if (di_name_of_company=="") 
        {
            $('#di_name_of_company').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#di_name_of_company').removeClass('red_border').addClass('black_border');               
        }


          }



         





          var di_target_of_business=$("#di_target_of_business").val();       
        if (di_target_of_business=="") 
        {
            $('#di_target_of_business').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#di_target_of_business').removeClass('red_border').addClass('black_border');               
        }
          var di_year_of_experience=$("#di_year_of_experience").val();       
        if (di_year_of_experience=="") 
        {
            $('#di_year_of_experience').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#di_year_of_experience').removeClass('red_border').addClass('black_border');               
        }
          










        
       






        // var di_password=$("#di_password").val();       
        // if (di_password=="") 
        // {
        //     $('#di_password').removeClass('black_border').addClass('red_border');
        // } 
        // else 
        // {
        //     $('#di_password').removeClass('red_border').addClass('black_border');               
        // }


        // var di_confirm=$("#di_confirm").val();
        // if (di_confirm=="" || di_confirm!=di_password) 
        // {
        //     $('#di_confirm').removeClass('black_border').addClass('red_border');            
        // } 
        // else 
        // {
        //     $('#di_confirm').removeClass('red_border').addClass('black_border');
        // }


}

function di_sign_up_form_validation()
  {
    //alert('ok');

          // var cat_ids=[];
          //   $(':checkbox[id^="chk_bx"]:checked').each(function(){        
          //    cat_ids.push($(this).val());              
          // });



        $('#di_registration_form').attr('onchange', 'di_data_Submit_fm()');
        $('#di_registration_form').attr('onkeypress', 'di_data_Submit_fm()');

        di_data_Submit_fm();

      //  alert($('#user_registration_form_id .red_border').size());

        if ($('#di_registration_form .red_border').length > 0)
        {

            $('#di_registration_form .red_border:first').focus();
            $('#di_registration_form .alert-error').show();
            return false;
        }

        // else if(cat_ids.length==0){              
        //   alert("Please agree with our terms and conditions.");              
        //   return false;            
        // }

        else {

        $("#di_registration_form").submit();
      } 
  }












function change_di_delarship(){

 // var di_prev_any_delarship=  $("#di_prev_any_delarship").val();
   var di_prev_any_delarship=  $("input[type='radio'][name='di_prev_any_delarship']:checked").val();     

 var di_html='';

    if(di_prev_any_delarship=='Y')
    {
        di_html=' <label for="email" class="cols-sm-2 control-label">Name of company  <span>*</span></label><div class="cols-sm-10"><div class="input-group"><input type="text" class="form-control" name="di_name_of_company" id="di_name_of_company" value="<?php echo @$user_details[0]->name_of_company; ?>" placeholder="Name of company" /></div></div>';
     
    }else{

         di_html='';

    }

    $("#show_di_delarship").html(di_html);

}



</script>





<script type="text/javascript">




function st_data_Submit_fm()
{
        var st_firstname=$("#st_firstname").val();       
        if (st_firstname=="") 
        {
            $('#st_firstname').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#st_firstname').removeClass('red_border').addClass('black_border');               
        }

         var st_lastname=$("#st_lastname").val();       
        if (st_lastname=="") 
        {
            $('#st_lastname').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#st_lastname').removeClass('red_border').addClass('black_border');               
        }


         var st_firmname=$("#st_firmname").val();       
        if (st_firmname=="") 
        {
            $('#st_firmname').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#st_firmname').removeClass('red_border').addClass('black_border');               
        }

          var st_drug_license_no=$("#st_drug_license_no").val();       
        if (st_drug_license_no=="") 
        {
            $('#st_drug_license_no').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#st_drug_license_no').removeClass('red_border').addClass('black_border');               
        }





          var st_gst_pan_no_firm=$("#st_gst_pan_no_firm").val();       
        if (st_gst_pan_no_firm=="") 
        {
            $('#st_gst_pan_no_firm').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#st_gst_pan_no_firm').removeClass('red_border').addClass('black_border');               
        }
          var st_address=$("#st_address").val();       
        if (st_address=="") 
        {
            $('#st_address').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#st_address').removeClass('red_border').addClass('black_border');               
        }
          var st_phone=$("#st_phone").val();       
        if (st_phone=="") 
        {
            $('#st_phone').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#st_phone').removeClass('red_border').addClass('black_border');               
        }
          var st_email=$("#st_email").val();       
        
         if (!isEmail(st_email))
        {
            $('#st_email').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#st_email').removeClass('red_border').addClass('black_border');               
        }
          var st_area_of_work=$("#st_area_of_work").val();       
        if (st_area_of_work=="") 
        {
            $('#st_area_of_work').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#st_area_of_work').removeClass('red_border').addClass('black_border');               
        }
         







        // var st_prev_any_delarship=$("#st_prev_any_delarship").val();   
          var st_prev_any_delarship=  $("input[type='radio'][name='st_prev_any_delarship']:checked").val();    
        

          if(st_prev_any_delarship=='Y'){

            var st_name_of_company=$("#st_name_of_company").val();       
        if (st_name_of_company=="") 
        {
            $('#st_name_of_company').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#st_name_of_company').removeClass('red_border').addClass('black_border');               
        }


          }



           





          var st_target_of_business=$("#st_target_of_business").val();       
        if (st_target_of_business=="") 
        {
            $('#st_target_of_business').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#st_target_of_business').removeClass('red_border').addClass('black_border');               
        }
        



        // var st_password=$("#st_password").val();       
        // if (st_password=="") 
        // {
        //     $('#st_password').removeClass('black_border').addClass('red_border');
        // } 
        // else 
        // {
        //     $('#st_password').removeClass('red_border').addClass('black_border');               
        // }

      

        // var st_confirm=$("#st_confirm").val();
        // if (st_confirm=="" || st_confirm!=st_password) 
        // {
        //     $('#st_confirm').removeClass('black_border').addClass('red_border');            
        // } 
        // else 
        // {
        //     $('#st_confirm').removeClass('red_border').addClass('black_border');
        // }


}

function st_sign_up_form_validation()
  {
    //alert('ok');

          // var cat_ids=[];
          //   $(':checkbox[id^="chk_bx"]:checked').each(function(){        
          //    cat_ids.push($(this).val());              
          // });



        $('#st_registration_form').attr('onchange', 'st_data_Submit_fm()');
        $('#st_registration_form').attr('onkeypress', 'st_data_Submit_fm()');

        st_data_Submit_fm();

      //  alert($('#user_registration_form_id .red_border').size());

        if ($('#st_registration_form .red_border').length > 0)
        {

            $('#st_registration_form .red_border:first').focus();
            $('#st_registration_form .alert-error').show();
            return false;
        }

        // else if(cat_ids.length==0){              
        //   alert("Please agree with our terms and conditions.");              
        //   return false;            
        // }

        else {

        $("#st_registration_form").submit();
      } 
  }












function change_st_delarship(){

//  var st_prev_any_delarship=  $("#st_prev_any_delarship").val();
    var st_prev_any_delarship=  $("input[type='radio'][name='st_prev_any_delarship']:checked").val();   

 var st_html='';

    if(st_prev_any_delarship=='Y')
    {
        st_html=' <label for="email" class="cols-sm-2 control-label">Name of company  <span>*</span></label><div class="cols-sm-10"><div class="input-group"><input type="text" class="form-control" name="st_name_of_company" id="st_name_of_company" value="<?php echo @$user_details[0]->name_of_company; ?>" placeholder="Name of company" /></div></div>';
     
    }else{

         st_html='';

    }

    $("#show_st_delarship").html(st_html);

}



</script>




<script type="text/javascript">

function log_in_data_Submit_fm()
{
        var phone_or_email=$("#phone_or_email").val();       
        if (phone_or_email=="") 
        {
            $('#phone_or_email').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#phone_or_email').removeClass('red_border').addClass('black_border');               
        }

         var password=$("#password").val();       
        if (password=="") 
        {
            $('#password').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#password').removeClass('red_border').addClass('black_border');               
        }





}

function log_in_form_validation()
  {
    //alert('ok');

          // var cat_ids=[];
          //   $(':checkbox[id^="chk_bx"]:checked').each(function(){        
          //    cat_ids.push($(this).val());              
          // });



        $('#log_in_registration_form').attr('onchange', 'log_in_data_Submit_fm()');
        $('#log_in_registration_form').attr('onkeypress', 'log_in_data_Submit_fm()');

        log_in_data_Submit_fm();

      //  alert($('#user_registration_form_id .red_border').size());

        if ($('#log_in_registration_form .red_border').length > 0)
        {

            $('#cu_registration_form .red_border:first').focus();
            $('#log_in_registration_form .alert-error').show();
            return false;
        }

        // else if(cat_ids.length==0){              
        //   alert("Please agree with our terms and conditions.");              
        //   return false;            
        // }

        else {

        $("#log_in_registration_form").submit();
      } 
  }
</script> 














<script type="text/javascript">




function ready_dr_have_registration_no_fun(){

 
  var ready_dr_have_registration_no=  $("input[type='radio'][name='dr_have_registration_no']:checked").val();
 // alert(ready_dr_have_registration_no);
 var dr_ready_html=''

 if(ready_dr_have_registration_no=='Y')
 {

  dr_ready_html=' <label for="email" class="cols-sm-2 control-label">Doctor Registration Id  <span>*</span></label><div class="cols-sm-10"><div class="input-group"><input type="text" class="form-control" name="dr_registration_no" id="dr_registration_no" value="<?php echo @$user_details[0]->registration_no; ?>" placeholder="Enter your Registration Id" /></div></div>';
}



    $("#show_dr_registration").html(dr_ready_html);

}



function ready_di_have_registration_no_fun(){

 
  var ready_di_prev_any_delarship=  $("input[type='radio'][name='di_prev_any_delarship']:checked").val();
 // alert(ready_dr_have_registration_no);
 var di_ready_html=''

 if(ready_di_prev_any_delarship=='Y')
 {

  di_ready_html=' <label for="email" class="cols-sm-2 control-label">Name of company  <span>*</span></label><div class="cols-sm-10"><div class="input-group"><input type="text" class="form-control" name="di_name_of_company" id="di_name_of_company" value="<?php echo @$user_details[0]->name_of_company; ?>" placeholder="Name of company" /></div></div>';
}



    $("#show_di_delarship").html(di_ready_html);

}



function ready_st_have_registration_no_fun(){

 
  var ready_st_prev_any_delarship=  $("input[type='radio'][name='st_prev_any_delarship']:checked").val();
       
 // alert(ready_dr_have_registration_no);
 var st_ready_html=''

 if(ready_st_prev_any_delarship=='Y')
 {

  st_ready_html=' <label for="email" class="cols-sm-2 control-label">Name of company  <span>*</span></label><div class="cols-sm-10"><div class="input-group"><input type="text" class="form-control" name="st_name_of_company" id="st_name_of_company" value="<?php echo @$user_details[0]->name_of_company; ?>" placeholder="Name of company" /></div></div>';
}



    $("#show_st_delarship").html(st_ready_html);

}

</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">

   $("#profile_pic_id").on('change', function(){
  var form = $("#profile_pic_form")[0];
  var form_data = new FormData(form);
  var base_url='<?php echo base_url(); ?>';
 
   $.ajax({
    url: base_url+"my_profile/change_profile_image",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false, 
    success:function(data)
    {
    //  $('#sample_div').css('display','none');
    //  $('#upload_presciption_modal').modal('hide');
      $('#profile_pic_form').html(data);
    

    }
   });

   alert('Your profile picture changed successfully.');



  
 });
  

</script>


<script type="text/javascript">

function data_Submit_fm()
{
   var old_pass=$("#old_pass").val();       
        if (old_pass=="") 
        {
            $('#old_pass').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#old_pass').removeClass('red_border').addClass('black_border');               
        }

        var new_password=$("#new_password").val();       
        if (new_password=="") 
        {
            $('#new_password').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#new_password').removeClass('red_border').addClass('black_border');               
        }

         var confirm_password=$("#confirm_password").val();       
        if (confirm_password=="") 
        {
            $('#confirm_password').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#confirm_password').removeClass('red_border').addClass('black_border');               
        }


}



function change_pass_validation()
    {
      // alert('ok');

var  old_pass=$('#old_pass').val();
       var new_pass=$('#new_password').val();
      var  conf_pass=$('#confirm_password').val();
     

       $('#pass_validation_id').attr('onchange', 'data_Submit_fm()');
        $('#pass_validation_id').attr('onkeypress', 'data_Submit_fm()');

        data_Submit_fm();

        if ($('#pass_validation_id .red_border').length > 0)
        {

            $('#pass_validation_id .red_border:first').focus();
            $('#pass_validation_id .alert-error').show();
            return false;
        }

         else if(new_pass!=conf_pass){  

           $('#old_pass_match').html("");

            $('#succ_match').html("");
             $('#conf_pass_match').html("Confirm Password does not match");


           return false;            
         }

        else {

        //  $("#pass_validation_id").submit();



 $.ajax(
            {
                type: "POST",
                dataType:'json',
                url:"<?php echo base_url();?>my_profile/change_password",
                data: {old_pass: old_pass,
                  new_pass: new_pass,
                },
                async: false,
                success: function(data)
                {
                  var   status=data.msg;


 if(status=='N')
        {
            $('#old_pass_match').html(" Old password does not match..!");
            $('#succ_match').html("");
            $('#conf_pass_match').html("");
        }
        if(status=='Y')
        {
           $('#old_pass').val('');
           $('#new_password').val('');
           $('#confirm_password').val('');

            $('#old_pass_match').html("");
            $('#conf_pass_match').html("");

            $('#succ_match').html("password successfully changed");
        }




                }
            });








      }       
    }
  </script> 





<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

<script type="text/javascript">

  $(document).ready(function() { 

 ready_dr_have_registration_no_fun();
 ready_di_have_registration_no_fun();
 ready_st_have_registration_no_fun();


 


});

</script>

  
  




<!------------- manage address ---------------------------------->
<!------------- manage address ---------------------------------->

<script type="text/javascript">
         function change_status_default_address(value)
        {
            // alert(value);
            var order = confirm("Are You Sure to make this Default?");
            if(order)
            {
                $.ajax(
                   {
                        type: "POST",
                        dataType:'json',
                        url:"<?php echo base_url(); ?>manage_address/make_default_manage_address",
                        data: {address_id:value},
                        async: true,
                        success: function(data)
                        {
                          if(data.status=='success'){
                           
                           window.location.href="<?php echo base_url(); ?>my-account";
                          
                          }
                              
                        }
                    });  
            }
            else
            {
                alert("denied");
            }
        }
    </script>



<script type="text/javascript">

  function  add_menage_address_show()
 {

  // var test_data='11';
   var base_url='<?php echo base_url(); ?>';

           $.ajax({
             url:base_url+'manage_address/manage_address_add_view',
             data:{},
             dataType: "html",
             type: "POST",
             success: function(data){
            $('#add_view_address').html(data);
                
              }

             });



$('#edit_view_address').html('');


 }

 function  edit_menage_address_show(id)
 {

  // alert(id);
   var base_url='<?php echo base_url(); ?>';

           $.ajax({
             url:base_url+'manage_address/manage_address_edit_view',
             data:{id:id},
             dataType: "html",
             type: "POST",
             success: function(data){
            $('#edit_view_address').html(data);
                
              }

             });



$('#add_view_address').html('');


 }
  

</script>


<script type="text/javascript">

function add_manage_address_data_Submit_fm()
{
        var name=$("#name").val();       
        if (name=="") 
        {
            $('#name').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#name').removeClass('red_border').addClass('black_border');               
        }

        
        var phone=$("#phone").val();       
        if (phone=="" || phone.length<10) 
        {
            $('#phone').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#phone').removeClass('red_border').addClass('black_border');               
        }
          var email=$("#email").val();       
        
         if (!isEmail(email))
        {
            $('#email').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#email').removeClass('red_border').addClass('black_border');               
        }

         var locality=$("#locality").val();       
        if (locality=="") 
        {
            $('#locality').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#locality').removeClass('red_border').addClass('black_border');               
        }

         var flat_house_floor_building=$("#flat_house_floor_building").val();       
        if (flat_house_floor_building=="") 
        {
            $('#flat_house_floor_building').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#flat_house_floor_building').removeClass('red_border').addClass('black_border');               
        }

        var pincode=$("#pincode").val();       
        if (pincode=="") 
        {
            $('#pincode').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#pincode').removeClass('red_border').addClass('black_border');               
        }

         var country=$("#country").val();       
        if (country=="") 
        {
            $('#country').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#country').removeClass('red_border').addClass('black_border');               
        }

        var state=$("#state").val();       
        if (state=="") 
        {
            $('#state').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#state').removeClass('red_border').addClass('black_border');               
        }

         var city=$("#city").val();       
        if (city=="") 
        {
            $('#city').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#city').removeClass('red_border').addClass('black_border');               
        }







}

function add_manage_address_form_validation()
  {
    //alert('ok');

          // var cat_ids=[];
          //   $(':checkbox[id^="chk_bx"]:checked').each(function(){        
          //    cat_ids.push($(this).val());              
          // });



        $('#add_manage_address_registration_form').attr('onchange', 'add_manage_address_data_Submit_fm()');
        $('#add_manage_address_registration_form').attr('onkeypress', 'add_manage_address_data_Submit_fm()');

        add_manage_address_data_Submit_fm();

      //  alert($('#user_registration_form_id .red_border').size());

        if ($('#add_manage_address_registration_form .red_border').length > 0)
        {

            $('#add_manage_address_registration_form .red_border:first').focus();
            $('#add_manage_address_registration_form .alert-error').show();
            return false;
        }

        // else if(cat_ids.length==0){              
        //   alert("Please agree with our terms and conditions.");              
        //   return false;            
        // }

        else {

        $("#add_manage_address_registration_form").submit();
      } 
  }


function edit_manage_address_data_Submit_fm()
{
        var name=$("#name").val();       
        if (name=="") 
        {
            $('#name').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#name').removeClass('red_border').addClass('black_border');               
        }

        
        var phone=$("#phone").val();       
        if (phone=="" || phone.length<10) 
        {
            $('#phone').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#phone').removeClass('red_border').addClass('black_border');               
        }
          var email=$("#email").val();       
        
         if (!isEmail(email))
        {
            $('#email').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#email').removeClass('red_border').addClass('black_border');               
        }

         var locality=$("#locality").val();       
        if (locality=="") 
        {
            $('#locality').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#locality').removeClass('red_border').addClass('black_border');               
        }

         var flat_house_floor_building=$("#flat_house_floor_building").val();       
        if (flat_house_floor_building=="") 
        {
            $('#flat_house_floor_building').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#flat_house_floor_building').removeClass('red_border').addClass('black_border');               
        }

        var pincode=$("#pincode").val();       
        if (pincode=="") 
        {
            $('#pincode').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#pincode').removeClass('red_border').addClass('black_border');               
        }

         var country=$("#country").val();       
        if (country=="") 
        {
            $('#country').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#country').removeClass('red_border').addClass('black_border');               
        }

        var state=$("#state").val();       
        if (state=="") 
        {
            $('#state').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#state').removeClass('red_border').addClass('black_border');               
        }

         var city=$("#city").val();       
        if (city=="") 
        {
            $('#city').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#city').removeClass('red_border').addClass('black_border');               
        }







}

function edit_manage_address_form_validation()
  {
    //alert('ok');

          // var cat_ids=[];
          //   $(':checkbox[id^="chk_bx"]:checked').each(function(){        
          //    cat_ids.push($(this).val());              
          // });



        $('#edit_manage_address_registration_form').attr('onchange', 'edit_manage_address_data_Submit_fm()');
        $('#edit_manage_address_registration_form').attr('onkeypress', 'edit_manage_address_data_Submit_fm()');

        edit_manage_address_data_Submit_fm();

      //  alert($('#user_registration_form_id .red_border').size());

        if ($('#edit_manage_address_registration_form .red_border').length > 0)
        {

            $('#edit_manage_address_registration_form .red_border:first').focus();
            $('#edit_manage_address_registration_form .alert-error').show();
            return false;
        }

        // else if(cat_ids.length==0){              
        //   alert("Please agree with our terms and conditions.");              
        //   return false;            
        // }

        else {

        $("#edit_manage_address_registration_form").submit();
      } 
  }


</script> 




<!--------------------- Wallet Wallet ----------------------------->

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript">
function wallet_amount_validation()
{




 var wall_ammount=$('#amount').val();

if(wall_ammount ==''){

alert('Give your wallet ammount');
return false;
}

else{
// var payment_method= ($('#paymethod').val());
var final_price=$('#amount').val();

// alert(final_price);

         //if(payment_method=='razorpay'){

  var amount = parseInt(final_price);
    var total = parseInt(amount*100);
    // var order_unique_id= ($('#order_id').val());
    var phone = ($('#wallet_login_mobile').val());
    var email = ($('#wallet_login_email').val());

   // alert(phone);
   //  alert(email);

var options = {
    "key": "rzp_live_LEAUu6VbaSlEZy",
    "amount": total,
   //  "currency": 'USD',
  //  "display_currency": 'USD', 
   //  "display_amount": final_price,    // 2000 paise = INR 20
    "name": "onlySpare ",
    "description": 'Wallet Credit Amount',

    "image": "<?php echo base_url();?>assets/frontend/images/ogo04.png",
    "handler": function (response){



            $("#wallet_amount_validation_id").submit();

    },
    "prefill": {
        "contact": phone,
        "email": email
    },
    
};


var rzp1 = new Razorpay(options);
$('#proceed_pay').html('Proceed to pay ');
                         rzp1.open();
                       //  e.preventDefault();
 


   

/*}
if(payment_method=='paypal'){

  $("#final_payment_form").submit();
  
    }*/


}










}


</script>
<script>
function form_cod_submit()
{
  

            $("#razr_payForm").submit();

   
}
</script>

