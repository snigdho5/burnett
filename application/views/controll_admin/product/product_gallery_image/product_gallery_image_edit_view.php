<?php $this->load->view('controll_admin/common/header'); ?>
<?php $data['mainpage'] ='product';?>
<?php $this->load->view('controll_admin/common/menu',$data); ?>
<?php if(isset($product_details[0]))
{
	$page_title = 'Edit Product - '.$product_details[0]->unique_key;
}
else
{
	$page_title = 'Add Product';
}
?>

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
     <form class="" name="add_area"  method="post" action="<?php echo base_url().BaseAdminURl.'/';?>product_gallery_image/edit_submit" id="pro_submit_form" enctype="multipart/form-data">
                           
                            
        <div class="span12 stone_details" id="general_details">
          <div class="widget ">
            <div class="widget-header "><a class="accordion-toggle" data-toggle="collapse" data-parent="#general_details" href="#general_details_area">&nbsp;</a> <i class="icon-leaf"></i>
              <h3>Product Image Edit</h3>
              <div class="pull-right"></div>
            </div>
            <div class="widget-content panel-collapse collapse in" id="general_details_area">
                  <div class="span4">
                       <div class="control-group"><label class="control-label" for="stonegroup_name">Product image </label><div class="controls"><input type="file" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="product_image" value="" name="product_image" placeholder="Product Price"><br/>
					<small style="color: #f99797">(Allowed type png,jpg and jpeg wtih 1000 X 1000 px)</small></div></div>
                  </div>
				
				<div class="span4">
					<div class="control-group">
						<label class="control-label" for="stonegroup_name">Alt For Product Image</label>
							<div class="controls">
								<input type="text" name="alt_for_product_image" value="<?php echo isset($edited_details[0]->alt_for_product_image)?$edited_details[0]->alt_for_product_image:'';?>" class="form-control" placeholder="Alt For Product Image">
							</div>
						<label class="sell-price-msg"></label>
					</div>
				</div>

                  <input type="hidden" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="hidden_product_id" value="<?php echo $this->uri->segment(5); ?>" name="hidden_product_id" placeholder="Product Price">

                   <input type="hidden" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="hidden_product_image_id" value="<?php echo $this->uri->segment(4); ?>" name="hidden_product_image_id" placeholder="Product image">

                   <input type="hidden" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="old_pic" value="<?php echo $edited_details[0]->product_image; ?>" name="old_pic" placeholder="Product image">







                </div>
           
            
          </div>
          
          
        </div>

         <!-- /widget -->
        
       <!--  <div class="span12 stone_details" id="price_details">
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
          
          
        </div>
 -->



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

<script type="text/javascript">
			
function select_product_option_fun()
{
	
	var select_product_option = $('#select_product_option').val();
  var html = '';


 if(select_product_option=='variable'){

 var base_url='<?php echo base_url();?>';

         $.ajax(
            { 
                 type: "POST",
                  dataType:'html',  
                 url:base_url+"controll_admin/product/product_attribute_get",
                 data: {},
                // async:false,

        success:function(data)
         { 
           
          $('#show_attribute').html(data); 
          $('#show_price').html('');      
                  
  
      }  
  });

       }
      else if(select_product_option=='simple'){
        $('#show_attribute').html('');  
        $('#show_variation').html('');
        $('#show_price').html('<div class="control-group"><label class="control-label" for="stonegroup_name">Product Price</label><div class="controls"><input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="product_price" value="" name="product_price" placeholder="Product Price"></div></div>'); 

      }
      else{
        $('#show_attribute').html('');  
        $('#show_variation').html('');
        $('#show_price').html(''); 

      }



 

	//$('#stone_area_row_0').after(msg);

	
}


function select_attribute_option_fun()
{
  
  var select_product_option = $('#select_product_option').val();
  var attribute_id = $('#attribute_id').val();
  var html = '';


 if(attribute_id !=''){

 var base_url='<?php echo base_url();?>';

         $.ajax(
            { 
                 type: "POST",
                  dataType:'html',  
                 url:base_url+"controll_admin/product_variable_attribute/product_variation_get",
                 data: {attribute_id:attribute_id},
                // async:false,

        success:function(data)
         { 
           
          $('#show_variation').html(data);      
                  
  
      }  
  });

       }
       else{
        $('#show_variation').html(''); 
       }


 

  //$('#stone_area_row_0').after(msg);

  
}


</script>


<link href="<?php echo base_url();?>assets/frontend/custom_script/form_validation.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/frontend/custom_script/validation_rulse.js"></script>


<script type="text/javascript">

function cu_data_Submit_fm()
{
       

              var attribute_id=$("#attribute_id").val();       
        if (attribute_id=="") 
        {
            $('#attribute_id').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#attribute_id').removeClass('red_border').addClass('black_border'); 



             var variation_id=$("#variation_id").val();       
        if (variation_id=="") 
        {
            $('#variation_id').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#variation_id').removeClass('red_border').addClass('black_border');               
        }
      }


            var product_price=$("#product_price").val();       
        if (product_price=="") 
        {
            $('#product_price').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#product_price').removeClass('red_border').addClass('black_border');               
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

