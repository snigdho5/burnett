<?php $this->load->view('controll_admin/common/header'); ?>
<?php $data['mainpage'] ='order';?>
<?php $this->load->view('controll_admin/common/menu',$data); ?>

<!-- /#page-wrapper -->

<div class="main">
	
	<div class="main-inner">

	    <div class="container">
	
	      <div class="row">
           <?php if(validation_errors()) { ?>
   <div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <?php echo validation_errors(); ?> </div>
   <?php } ?>
   <?php if($this->session->flashdata('succ_msg')){ ?>
   <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <?php echo $this->session->flashdata('succ_msg'); ?> </div>
   <?php } ?>
   
  
    
                            
        <div class="span12 stone_details" id="general_details">
          <div class="widget ">
            <div class="widget-header "><a class="accordion-toggle" data-toggle="collapse" data-parent="#general_details" href="#general_details_area">&nbsp;</a> <i class="icon-leaf"></i>
              <h3>Edit-Order (<?=$order[0]->order_unique_id?>)</h3>
              <div class="pull-right"></div>
            </div>
            <div class="widget-content panel-collapse collapse in" id="general_details_area">
<form role="form" name="category_form" method="post" action="<?php echo base_url().BaseAdminURl.'/';?>order/update" enctype="multipart/form-data" class="order-detail">
<input type="hidden" name="order_id" value="<?=$order[0]->order_id?>" />
<input type="hidden" name="order_unique_id" value="<?=$order[0]->order_unique_id?>" />
                  	<div class="span4">
                                    <div class="control-group">
											<label class="control-label" for="stonegroup_name">Status</label>
											<div class="controls">
                                            	<select class="form-control" name="order_status">
        <!--  <option value="0" <?=$order[0]->order_status=='0' || $order[0]->payment_status=='0'?'selected="selected"':''?>>Failed</option> 
         <option value="1" <?=$order[0]->order_status=='1' && $order[0]->payment_status=='1'?'selected="selected"':''?>>Processing</option>-->
         
         <option value="3" <?=$order[0]->order_status=='1'?'selected="selected"':''?>>Processing</option>
         <option value="2" <?=$order[0]->order_status=='2'?'selected="selected"':''?>>Ship In Progress</option>
    <option value="3" <?=$order[0]->order_status=='3'?'selected="selected"':''?>>Delivered</option>
    <option value="4" <?=$order[0]->order_status=='4'?'selected="selected"':''?>>Completed</option>
    <option value="4" <?=$order[0]->order_status=='5'?'selected="selected"':''?>>Cancelled</option>
         
         </select>
             
											</div> <!-- /controls -->
										</div> 
									</div>
                                    
                   	<div class="span4 ML0">
                                    <div class="control-group">
											  <button type="submit" class="btn btn-default">Update</button>
                                              
                                      
                                              
											</div> <!-- /controls -->
										</div> 
                                        
                                         </form>
									</div>
                                 
                             
                     </div>
            <!-- /widget-header -->
            
            <!-- /widget-content --> 
            
          </div>
          <!-- /widget --> 
          
        </div>
        
        <div class="span12 stone_details" id="price_details">
          <div class="widget ">
           <div class="" id="cd-login">
<small class="font-small">Order Date - <?php echo date('M d,Y',strtotime($order[0]->date ));?></small>
<p style="height:20px;"></p>

                  <table  class="table cart_table">
                  <thead>
                            <tr>
                                <th>Product</th>
                                <th class="text-center">Price</th>
                                <th>Quantity</th>
                                <th class="text-center">Tax</th>
                                <th class="text-center">Total</th>
                                <th> </th>
                            </tr>
                		</thead>
                  <tbody>
                  
                  <?php $order_details = $this->myaccountmodel->get_order_modules_item($order[0]->order_id);
				 // var_dump($order_details);
				 foreach($order_details as $inner_dt){ 

          $product_details=$this->common_my_model->common($table_name ='product', $field = array(), $where = array('product_id'=>$inner_dt->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

				 ?>
                 <tr>
                  <td class="col-sm-8 col-md-6">
                               		<div class="media">
                                    <a class="thumbnail pull-left" href="#"> <img class="media-object" src="<?php echo base_url().'uploads/product/'.$product_details[0]->product_image;?>" alt="" /> </a>
                                    <div class="media-body">
                                        <h4 class="media-heading"><?php echo $product_details[0]->product_title;?></h4>
                                        <h5 class="media-heading">Batch No.: <?php echo $product_details[0]->product_batch_no;?></h5>
                                        <p><?php echo character_limiter($product_details[0]->product_description,40);?></p>
                                        <!--<span>Status: </span><span class="text-success"><strong>In Stock</strong></span>-->
                                    </div>
                                </div>
                                </td>
                                <td class="col-sm-1 col-md-1 text-center"><i class="fas fa-<?php echo $order[0]->order_currency_sign;?>-sign"></i> <?=$inner_dt->price?></td>
                                <td class="col-sm-1 col-md-1" style="text-align: center"><?=$inner_dt->quantity?></td>
                                
                                
                                <td class="col-sm-2 col-md-2 text-center ">
                             
                                CGST (<?=$inner_dt->cgst_title?>%): <i class="fas fa-<?php echo $order[0]->order_currency_sign;?>-sign"></i> <?=$inner_dt->cgst?>
                                <br />
                                SGST (<?=$inner_dt->sgst_title?>%): <i class="fas fa-<?php echo $order[0]->order_currency_sign;?>-sign"></i> <?=$inner_dt->sgst?>
								
								</td>
                                
                                
                                <td class="col-sm-1 col-md-1 text-center"><i class="fas fa-<?php echo $order[0]->order_currency_sign;?>-sign"></i> <?=$inner_dt->price * $inner_dt->quantity?></td>
                                                                </tr>
                                                                <?php
				 }
				  ?>
                  </tbody></table>

<table class="order-tableee no-border" align="center" border="0" cellspacing="0" style="width: 100%; margin: 0px auto; font-size: 13px; border: 0px; margin-bottom: 30px;">
                                                                    <tbody><tr>
                                                                        <td height="10" colspan="3"></td>
                                                                    </tr>
                                                                    <tr style="text-align: center;">
                                                                        <td style="text-align: right" width="110">Order Amount :</td><td width="350"></td><td style="text-align: left; padding-right: 20px;" width="70"><i style="color:#000;" class="fas fa-<?php echo $order[0]->order_currency_sign;?>-sign"></i> <?php echo $order[0]->order_subtotal_value;?></td>
                                                                    </tr>
                                                                    <tr style="text-align: center;">
                                                                        <td style="text-align: right" width="110">CGST :</td><td width="350"></td><td style="text-align: left; padding-right: 20px;" width="70"><i style="color:#000;" class="fas fa-<?php echo $order[0]->order_currency_sign;?>-sign"></i> <?php echo $order[0]->order_cgst_value;?></td>
                                                                    </tr>
                                                                    <tr style="text-align: center;">
                                                                        <td style="text-align: right" width="110">SGST :</td><td width="350"></td><td style="text-align: left; padding-right: 20px;" width="70"><i style="color:#000;" class="fas fa-<?php echo $order[0]->order_currency_sign;?>-sign"></i> <?php echo $order[0]->order_sgst_value;?></td>
                                                                    </tr>
                                                                    <tr style="text-align: center; font-weight: bold;">
                                                                        <td style="text-align: right" width="110">Net payble :</td><td width="350"></td><td style="text-align: left; padding-right: 20px;" width="70"><i style="color:#000;" class="fas fa-<?php echo $order[0]->order_currency_sign;?>-sign"></i> <?php echo $order[0]->order_total_value;?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="10" colspan="3"></td>
                                                                    </tr>
                                                                </tbody></table>
<?php /*?>
<a class="button style-12">Re-Order </a><?php */?>

			
               <div class="row shipment_details">
               <div class="col-sm-12 col-md-12 col-lg-6">
               <h6>Billing Address</h6> 
                 <div class="default-not-set-border">
                                               <div class="address-middle">
                                                  <i class="fas fa-user"></i><?php echo $order[0]->billing_name;?><br>
                                                  <i class="fas fa-envelope"></i><?php echo $order[0]->billing_email;?><br>
                                                  <i class="fas fa-phone"></i><?php echo $order[0]->billing_phone;?><br>
                                                  <i class="fas fa-map-marker"></i><?= $order[0]->billing_flat_house_floor_building ?>, <?= $order[0]->billing_city ?> - <?= $order[0]->billing_pincode ?><br><?= $order[0]->billing_state ?> ,<?= $order[0]->billing_country?>
                                                 <br /> Locality : <?= $order[0]->billing_locality ?>
                                               </div>
                                               
                                            </div>
                                         </div>
                                         
               <div class="col-sm-12 col-md-12 col-lg-6">
               <h6>Shipping Address</h6> 
                 <div class="default-not-set-border">
                                               <div class="address-middle">
                                                  <i class="fas fa-user"></i><?php echo $order[0]->shipping_name;?><br>
                                                  <i class="fas fa-phone"></i><?php echo $order[0]->shipping_phone;?><br>
                                                  <i class="fas fa-map-marker"></i><?= $order[0]->shipping_flat_house_floor_building ?>, <?= $order[0]->shipping_city ?> - <?= $order[0]->shipping_pincode ?><br><?= $order[0]->shipping_state ?> ,<?= $order[0]->shipping_country?>
                                                 <br /> LandMark : <?= $order[0]->shipping_landmark ?>
                                                 <br /> Locality : <?= $order[0]->shipping_locality ?>
                                                 <br /> Type : <?= $order[0]->shipping_address_type ?>
                                               </div>
                                               
                                            </div>
                                         </div>
               </div>
                
                
                
                
                
					
                    	
                    </div> 
            
            
          </div>
          <!-- /widget --> 
          
        </div>
       		
         <!-- /widget -->


	      	
	      </div> <!-- /row -->
	
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div>

<?php $this->load->view('controll_admin/common/footer'); ?>
