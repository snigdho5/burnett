<?php $this->load->view('controll_admin/common/header'); ?>
<?php $data['mainpage'] ='product';?>
<?php $this->load->view('controll_admin/common/menu',$data); ?>


   <?php if($this->session->flashdata('auth_msg')){ ?>
   <div class="alert alert-success"><?php echo $this->session->flashdata('auth_msg');?></div>
   <?php } ?>
   
   
   
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
    <?php echo $this->session->flashdata('succ_msg');; ?> </div>
   <?php } ?>
     <form class="" name="add_area"  method="post" action="<?php echo base_url().BaseAdminURl.'/';?>coupon/data_add_submit" id="pro_submit_form" enctype="multipart/form-data">
                           
                            
        <div class="span12 stone_details" id="general_details">
          <div class="widget ">
            <div class="widget-header "><a class="accordion-toggle" data-toggle="collapse" data-parent="#general_details" href="#general_details_area">&nbsp;</a> <i class="icon-leaf"></i>
              <h3>Add Coupon</h3>
              <div class="pull-right"></div>
            </div>
            <div class="widget-content panel-collapse collapse in" id="general_details_area">

                  	

                   

                  <div class="span4">
                     
                      <div class="control-group">
                      <label class="control-label" for="stonegroup_name"> Coupon Title</label>
                      <div class="controls">

                       <input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="coupon_headline" value="" name="coupon_headline" placeholder="Coupon Title">
                                          
                                     
                                              
                      </div> 
                    </div>   

                  </div>

                   <div class="span4">
                     
                      <div class="control-group">
                      <label class="control-label" for="stonegroup_name">Coupon Code</label>
                      <div class="controls">

                       <input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="coupon_code" value="" name="coupon_code" placeholder="Coupon Code">
                                          
                                     
                                              
                      </div> 
                    </div>   

                  </div>



                  <div class="span4">
                     
                      <div class="control-group">
                      <label class="control-label" for="stonegroup_name">Discount Type</label>
                      <div class="controls">

                                                     <select class="form-control" name="coupon_discount_type" id="coupon_discount_type">
                                                   
                                                    <option value=""  >Select Discount Type</option>
                                                    <option value="Flat"  >Flat</option>
                                                    <option value="Persent"  >Persent</option>
                                                    
                                                  </select>
                                          
                                     
                                              
                      </div> 
                    </div>   

                  </div>

                   

                  <div class="span4">
                     
                      <div class="control-group">
                      <label class="control-label" for="stonegroup_name">Coupon Discount</label>
                      <div class="controls">

                       <input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="coupon_discount" value="" name="coupon_discount" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Coupon Discount">
                                          
                                     
                                              
                      </div> 
                    </div>   

                  </div>

                   <div  class="span4">
                     
                     <div class="control-group">
                      <label class="control-label" for="stonegroup_name">Coupon Amount</label>
                      <div class="controls">

                       <input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="coupon_amount" value="" name="coupon_amount" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Coupon Amount">
                                          
                                     
                                              
                      </div> 
                    </div>    

                  </div>

                   <div  class="span4">
                     
                     <div class="control-group">
                      <label class="control-label" for="stonegroup_name">Expire Date</label>
                      <div class="controls">

                       <input type="date" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="coupon_end" value="" name="coupon_end" placeholder="Expire Date">
                                          
                                     
                                              
                      </div> 
                    </div>  
                    
                  </div>

                   <div  class="span4">
                     
                     <div class="control-group">
                      <label class="control-label" for="stonegroup_name">Total Use</label>
                      <div class="controls">

                       <input type="text" data-validation="required" onkeypress='return event.charCode >= 48 && event.charCode <= 57' data-validation-error-msg="Please enter title" class="form-control" id="total_use" value="" name="total_use" placeholder="Total Use">
                                          
                                     
                                              
                      </div> 
                    </div>  
                    
                  </div>

                   <div  class="span4">
                     
                     <div class="control-group">
                      <label class="control-label" for="stonegroup_name">Status</label>
                      <div class="controls">

                        <select class="form-control" name="status" id="status">
                                                   
                                                    
                                                    <option value="1" selected  >Active</option>
                                                    <option value="0"  >Inactive</option>
                                                    
                                                  </select>
                                          
                                     
                                              
                      </div> 
                    </div>  
                    
                  </div>



                </div>
           
            
          </div>
          
          
        </div>

         <!-- /widget -->
        
        <!-- <div class="span12 stone_details" id="price_details">
          <div class="widget ">
            <div class="widget-header "> 
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#price_details" href="#price_details_area">&nbsp;</a><i class="icon-leaf"></i>
              <h3>Seo Details</h3>
              <div class="pull-right"></div>
            </div>
            <div class="widget-content panel-collapse collapse in" id="price_details_area">

                  	<div class="span4">
                                    <div class="control-group">
											<label class="control-label" for="stonegroup_name">Meta Title</label>
											<div class="controls">
                                            	
                                              <input type="text" data-validation="required" data-validation-error-msg="Please enter Price" class="form-control" id="meta_title" value="" name="meta_title" placeholder="Meta Title">
                                          
                                          </div> 
										</div> 
									</div>


                  <div class="span4">
                     
                      <div class="control-group">
                      <label class="control-label" for="stonegroup_name">Meta Keyword</label>
                      <div class="controls">

                       <textarea class="form-control" rows="3" name="meta_keyword" id="meta_keyword" placeholder="Description" data-validation="required" data-validation-error-msg="Meta Keyword"></textarea>
                                          
                                     
                                              
                      </div> 
                    </div>   

                  </div>

                  <div class="span4">
                     
                      <div class="control-group">
                      <label class="control-label" for="stonegroup_name">Meta Description</label>
                      <div class="controls">

                       <textarea class="form-control" rows="3" name="meta_description" id="meta_description" placeholder="Description" data-validation="required" data-validation-error-msg="Meta Description"></textarea>
                                          
                                     
                                              
                      </div> 
                    </div>   

                  </div>
                                    
                  
                                    
					</div>
           
            
          </div>
          
          
        </div> -->

        

        <!-- /controls -->
       		
      
         <!-- /widget -->



            

             <div class="span12 stone_details" id="stone_details">

            <div class="widget ">

              <div class="widget-header ">
                  <!--   <a class="accordion-toggle" data-toggle="collapse" data-parent="#stone_details" href="#stone_details_area">&nbsp;</a>
                <i class="icon-leaf"></i>
                <h3>Link Details</h3> -->
                       
                       <!--  <div class="pull-right">
     <h3 id="button_add_stone"><i class="icon-plus"></i><a onClick="add_link()"> &nbsp; Add</a></h3>
        </div> -->

            </div> <!-- /widget-header -->

          <div class="widget-content panel-collapse collapse in" id="stone_details_area">

                     <div class="table-responsive">
                     
                      <div class="form-group">
      
               
               </div>
               
 
    
    <button type="submit" onclick="return pro_form_validation();" class="btn btn-default">Submit</button>
        <button type="reset" class="btn btn-default" onclick="javascript:location.reload();">Reset</button>
</div>

          </div> <!-- /widget-content -->

        </div> <!-- /widget -->

        </div>
          

		  
       
	      
	      	</form>



         






















	      	
	      </div> <!-- /row -->
	
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> 
    
    

<?php $this->load->view('controll_admin/common/footer'); ?>




<link href="<?php echo base_url();?>assets/frontend/custom_script/form_validation.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/frontend/custom_script/validation_rulse.js"></script>


<script type="text/javascript">

function cu_data_Submit_fm()
{
        var coupon_headline=$("#coupon_headline").val();       
        if (coupon_headline=="") 
        {
            $('#coupon_headline').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#coupon_headline').removeClass('red_border').addClass('black_border');  

        }

          var coupon_code=$("#coupon_code").val();       
        if (coupon_code=="") 
        {
            $('#coupon_code').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#coupon_code').removeClass('red_border').addClass('black_border');               
        }

        var coupon_discount_type=$("#coupon_discount_type").val();       
        if (coupon_discount_type=="") 
        {
            $('#coupon_discount_type').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#coupon_discount_type').removeClass('red_border').addClass('black_border');               
        }


         var coupon_discount=$("#coupon_discount").val();       
        if (coupon_discount=="") 
        {
            $('#coupon_discount').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#coupon_discount').removeClass('red_border').addClass('black_border');               
        }

         var coupon_amount=$("#coupon_amount").val();       
        if (coupon_amount=="") 
        {
            $('#coupon_amount').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#coupon_amount').removeClass('red_border').addClass('black_border');               
        }

        var coupon_end=$("#coupon_end").val();       
        if (coupon_end=="") 
        {
            $('#coupon_end').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#coupon_end').removeClass('red_border').addClass('black_border');               
        }

        var total_use=$("#total_use").val();       
        if (total_use=="") 
        {
            $('#total_use').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#total_use').removeClass('red_border').addClass('black_border');               
        }

        

}

function pro_form_validation()
  {
    //alert('ok');

          // var cat_ids=[];
          //   $(':checkbox[id^="chk_bx"]:checked').each(function(){        
          //    cat_ids.push($(this).val());              
          // });



        $('#pro_submit_form').attr('onchange', 'cu_data_Submit_fm()');
        $('#pro_submit_form').attr('onkeypress', 'cu_data_Submit_fm()');

        cu_data_Submit_fm();

      //  alert($('#user_registration_form_id .red_border').size());

        if ($('#pro_submit_form .red_border').length > 0)
        {

            $('#pro_submit_form .red_border:first').focus();
            $('#pro_submit_form .alert-error').show();
            return false;
        }

        // else if(cat_ids.length==0){              
        //   alert("Please agree with our terms and conditions.");              
        //   return false;            
        // }

        else {

        $("#pro_submit_form").submit();
      } 
  }
</script> 

