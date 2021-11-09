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
     <form class="" name="add_area" id="add_area" method="post" action="<?php echo base_url().BaseAdminURl.'/';?>product/add_edit/<?php echo $this->uri->segment(4);?>" enctype="multipart/form-data">
                            <input type="hidden" name="entry_value" value="addnew_val">
                       
                            <input type="hidden" name="link_count" id="link_count" value="0">
                            
        <div class="span12 stone_details" id="general_details">
          <div class="widget ">
            <div class="widget-header "><a class="accordion-toggle" data-toggle="collapse" data-parent="#general_details" href="#general_details_area">&nbsp;</a> <i class="icon-leaf"></i>
              <h3><?=$page_title?></h3>
              <div class="pull-right"></div>
            </div>
            <div class="widget-content panel-collapse collapse in" id="general_details_area">

                  	<div class="span4">
                                    <div class="control-group">
											<label class="control-label" for="stonegroup_name">English</label>
											<div class="controls">
                                            	
                                              <input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="product_title_eng" value="<?php echo(isset($product_details[0]->product_title_eng)? $product_details[0]->product_title_eng : set_value('product_title_eng')); ?>" name="product_title_eng" placeholder="Title">
                                          
                                          <br /> 
                                          <textarea class="form-control" rows="3" name="product_des_eng" placeholder="Description" data-validation="required" data-validation-error-msg="Please enter description"><?php echo(isset($product_details[0]->product_des_eng)? $product_details[0]->product_des_eng : set_value('product_des_eng')); ?></textarea> 
                                              
											</div> <!-- /controls -->
										</div> 
									</div>
                                    
                   	<div class="span4 ML0">
                                    <div class="control-group">
											<label class="control-label" for="stonegroup_name">Hindi</label>
											<div class="controls">
                                            	
                                              <input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="product_title_hin" value="<?php echo(isset($product_details[0]->product_title_hin)? $product_details[0]->product_title_hin : set_value('product_title_hin')); ?>" name="product_title_hin" placeholder="Title">
                                          
                                          <br /> 
                                          <textarea class="form-control" rows="3" name="product_des_hin" placeholder="Description" data-validation="required" data-validation-error-msg="Please enter description"><?php echo(isset($product_details[0]->product_des_hin)? $product_details[0]->product_des_hin : set_value('product_des_hin')); ?></textarea> 
                                              
											</div> <!-- /controls -->
										</div> 
									</div>
                                 
                                 
                     <div class="span4 ML0">
                                    <div class="control-group">
											<label class="control-label" for="stonegroup_name">Bengali</label>
											<div class="controls">
                                            	
                                              <input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="product_title_ben" value="<?php echo(isset($product_details[0]->product_title_ben)? $product_details[0]->product_title_ben : set_value('product_title_ben')); ?>" name="product_title_ben" placeholder="Title">
                                          
                                          <br /> 
                                          <textarea class="form-control" rows="3" name="product_des_ben" placeholder="Description" data-validation="required" data-validation-error-msg="Please enter description"><?php echo(isset($product_details[0]->product_des_ben)? $product_details[0]->product_des_ben : set_value('product_des_ben')); ?></textarea> 
                                              
											</div> <!-- /controls -->
										</div> 
									</div></div>
            <!-- /widget-header -->
            
            <!-- /widget-content --> 
            
          </div>
          <!-- /widget --> 
          
        </div>
        
        <div class="span12 stone_details" id="price_details">
          <div class="widget ">
            <div class="widget-header "> 
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#price_details" href="#price_details_area">&nbsp;</a><i class="icon-leaf"></i>
              <h3>Price / Unit</h3>
              <div class="pull-right"></div>
            </div>
            <div class="widget-content panel-collapse collapse in" id="price_details_area">

                  	<div class="span4">
                                    <div class="control-group">
											<label class="control-label" for="stonegroup_name">INR</label>
											<div class="controls">
                                            	
                                              <input type="text" data-validation="required" data-validation-error-msg="Please enter Price" class="form-control" id="product_price_inr" value="<?php echo(isset($product_details[0]->product_price_inr)? $product_details[0]->product_price_inr : set_value('product_price_inr')); ?>" name="product_price_inr" placeholder="Title">
                                          
                                          </div> <!-- /controls -->
										</div> 
									</div>
                                    
                   <div class="span4 ML0">
                                    <div class="control-group">
											<label class="control-label" for="stonegroup_name">USD</label>
											<div class="controls">
                                            	
                                              <input type="text" data-validation="required" data-validation-error-msg="Please enter Price" class="form-control" id="product_price_usd" value="<?php echo(isset($product_details[0]->product_price_usd)? $product_details[0]->product_price_usd : set_value('product_price_usd')); ?>" name="product_price_usd" placeholder="Title">
                                          
                                          </div> <!-- /controls -->
										</div> 
									</div>

					
                    <div class="span4 ML0">
                                    <div class="control-group">
											<label class="control-label" for="stonegroup_name">Unit (Kg/Pc)		</label>
									
<div class="controls">
                                            	
                                             1  <input type="text" data-validation="required" data-validation-error-msg="Please enter Unit (Kg/Pc)" class="form-control" id="product_unit" value="<?php echo(isset($product_details[0]->product_unit)? $product_details[0]->product_unit : set_value('product_unit')); ?>" name="product_unit" placeholder="Please enter Unit (Kg/Pc)">
                                          
                                          </div> <!-- /controls -->
										</div> 
									</div>
                                    
					</div>
            <!-- /widget-header -->
            
            <!-- /widget-content --> 
            
          </div>
          <!-- /widget --> 
          
        </div>
       		
        <div class="span12 stone_details" id="image_details">

	      		<div class="widget ">

	      			<div class="widget-header ">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#image_details" href="#image_details_area">&nbsp;</a>
	      				<i class="icon-leaf"></i>
	      				<h3>Image</h3>
                      
	  				</div> <!-- /widget-header -->

					<div class="widget-content panel-collapse collapse in" id="image_details_area">

                     <div class="span4">
 										<div class="control-group">
											
											<div class="controls">
												<input type="file" class="span4" id="main_image"  name="main_image[]">
                                                <?php if(!empty($product_details)){ 
									if(isset($product_details[0]->product_image)){ 
					?>
          					<img src="<?php echo base_url().'uploads/'.$product_details[0]->product_image;?>" title="" alt="category image" style="height:100px; width:100px;"/>
          <?php 	}
								}
					?>
											</div> <!-- /controls -->
                                            <br />
                                            <label class="control-label" for="stonegroup_name">Batch No</label>
											<div class="controls">
                                            	
                                              <input type="text" data-validation="required" data-validation-error-msg="Please enter batch no" class="form-control" id="product_batch_no" value="<?php echo(isset($product_details[0]->product_batch_no)? $product_details[0]->product_batch_no : set_value('product_title_ben')); ?>" name="product_batch_no" placeholder="batch No">
                                              </div>
                                              
                                              <br />
                                            <label class="control-label" for="stonegroup_name">Unique Name</label>
											<div class="controls">
                                            	
                                              <input type="text"  class="form-control" id="unique_key" value="<?php echo(isset($product_details[0]->unique_key)? $product_details[0]->unique_key : set_value('unique_key')); ?>" name="unique_key" placeholder="Please enter unique_key or leave">
                                              </div>
										</div> <!-- /control-group -->


</div>

<div class="span4 ML0">
                                    <div class="control-group">
											
                                          
                                          
                                          <label class="control-label" for="stonegroup_name">Quantity Info</label>
                                          <div class="controls">
                                         <input type="text" data-validation="required" data-validation-error-msg="Please enter Quantity" class="form-control" id="product_quantity_info" value="<?php echo(isset($product_details[0]->product_quantity_info)? $product_details[0]->product_quantity_info : set_value('product_quantity_info')); ?>" name="product_quantity_info" placeholder="Quantity  Info">
                                         </div><br /> 
                                         
                                         <label class="control-label" for="stonegroup_name">Stock</label>
                                          <div class="controls">
                                         <input type="text" data-validation="required" data-validation-error-msg="Please enter stock" class="form-control" id="stock_count" value="<?php echo(isset($product_details[0]->stock_count)? $product_details[0]->stock_count : set_value('stock_count')); ?>" name="stock_count" placeholder="Count of stock">
                                         </div>
											</div> <!-- /controls -->
										</div> 
                                        
                                        <div class="span4 ML0">
                                    <div class="control-group">
											
                                          <label class="control-label" for="stonegroup_name">Category</label>
											<div class="controls">
                                            	<select class="form-control" name="category_id">     
         
        <?php if(!empty($results))
						  {
							
							  foreach($results as $k => $value){ 
							  ?>
                                      		     



<?php
if(!empty($value->subs)) { 
?>

          <optgroup label="<?php echo $value->name;?>">
<?php
}else{
?>
<option value="<?php echo $value->cat_id;?>"  <?php if(isset($product_details[0]->category_id) && $product_details[0]->category_id == $value->cat_id) echo 'selected="selected"';?>>&nbsp;&nbsp;&nbsp;<?php echo $value->name;?>
            
          </option>
<?php
}
?>

          <!--<option value="<?php echo $value->cat_id;?>"  <?php if(isset($product_details[0]->category_id) && $product_details[0]->category_id == $value->cat_id) echo 'selected="selected"';?>>&nbsp;&nbsp;&nbsp;<?php echo $value->name;?>
            
          </option>-->
<?php
/*if(!empty($value->chk)) { 

   foreach ($value->chk as $chks)  {
    ?>

 <option value="<?php echo $chks->cat_id;?>"  <?php if(isset($product_details[0]->category_id) && $product_details[0]->category_id == $chks->cat_id) echo 'selected="selected"';?>>&nbsp;&nbsp;&nbsp;<?php echo $chks->name;?></option>

<?php
 }
}*/
?>



<?php

if(!empty($value->subs)) { 
        foreach ($value->subs as $sub)  {

          ?>
       <option value="<?php echo $sub->cat_id;?>"  <?php if(isset($product_details[0]->category_id) && $product_details[0]->category_id == $sub->cat_id) echo 'selected="selected"';?>>&nbsp;&nbsp;&nbsp;<?php echo $sub->name;?></option>

          <?php


      }

    }


?>
 </optgroup>
                                    
                          
           <?php }
						  }?>



         </select>
                                             
                                              </div>      
                                          
                                          <br />
                                       <label class="control-label" for="stonegroup_name">GST Slab</label>
											<div class="controls">
                                            	<select class="form-control" name="gst_id">     
         
                          <?php if(!empty($results_gst))
						  {
							
							  foreach($results_gst as $kgst => $valuegst){ 
							  ?>
                                      		     
                                                    <option value="<?php echo $valuegst->gst_id;?>"  <?php if(isset($product_details[0]->gst_id) && $product_details[0]->gst_id == $valuegst->gst_id) echo 'selected="selected"';?>>&nbsp;&nbsp;&nbsp;<?php echo $valuegst->name;?></option>
                                    
                          
                                 <?php }
						  }?>
         </select>
                                             
                                              </div>    
											</div> <!-- /controls -->
										</div>
									</div>

					</div> <!-- /widget-content -->

				</div> <!-- /widget -->

		  
         <div class="span12 stone_details" id="stone_details">

	      		<div class="widget ">

	      			<div class="widget-header ">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#stone_details" href="#stone_details_area">&nbsp;</a>
	      				<i class="icon-leaf"></i>
	      				<h3>Link Details</h3>
                       
                        <div class="pull-right">
     <h3 id="button_add_stone"><i class="icon-plus"></i><a onClick="add_link()"> &nbsp; Add</a></h3>
        </div>

	  				</div> <!-- /widget-header -->

					<div class="widget-content panel-collapse collapse in" id="stone_details_area">

                     <div class="table-responsive">
                     
                      <div class="form-group">
       <?php if(isset($product_section))
			   {
				   
				  if(count($product_section)>0 && $product_section!=false)
			   {?>
				<table class="table stone_area_row table-condensed table-hover">
    <thead>
      <tr>
       <th>&nbsp;&nbsp;</th>
      	<th>title</th>
        <th>Subtitle</th>
         <th>link</th>
 	
      </tr>
    </thead>
    <tbody>
    <?php
	foreach($product_section as $PS)
			   {
				   ?>
   <tr id="already_link_<?=$PS->product_link_id?>">
   <td><h3><a onClick="delete_link(<?=$PS->product_link_id?>)"><i class="glyphicon glyphicon-trash"></i></a>
   <a id="edit_section_area_<?=$PS->product_link_id?>" onClick="edit_link(<?=$PS->product_link_id?>)"><i class="glyphicon glyphicon-pencil"></i></a>
   </h3>
   </td>
    <td><?=$PS->product_link_title?></td>
    <td><?=$PS->product_link_subtitle?></td>
     <td><?=$PS->product_link_href?></td>
   
   
  
   
   </tr>
   
   <tr id="already_link_edit_<?=$PS->product_link_id?>" style="display:none;">
   <td><h3>
   <a id="unedit_section_area_<?=$PS->product_link_id?>" onClick="unedit_link(<?=$PS->product_link_id?>)"><i class="glyphicon glyphicon-remove"></i></a>
    <a id="update_section_area_<?=$PS->product_link_id?>" onClick="update_link(<?=$PS->product_link_id?>)"><i class="glyphicon glyphicon-ok"></i></a></h3>
   </td>
    <td><input type="text" class="" id="already_link_title_<?=$PS->product_link_id?>" name="already_link_title_<?=$PS->product_link_id?>" value="<?=$PS->product_link_title?>"></td>
    <td><input type="text" class="" id="already_link_subtitle_<?=$PS->product_link_id?>" name="already_link_subtitle_<?=$PS->product_link_id?>" value="<?=$PS->product_link_subtitle?>"></td>
     <td><input type="text" class="" id="already_link_href_<?=$PS->product_link_id?>" name="already_link_href_<?=$PS->product_link_id?>" value="<?=$PS->product_link_href?>"></td>
   
   
  
   
   </tr>
                                 
		<?php
			   }
			   ?>
    </tbody>
    </table>   
			  <?php }
			   }
			   ?>
               
               </div>
               
 <table class="table stone_area_row table-condensed table-hover table-striped">
    <thead>
      <tr>
      <th>&nbsp;&nbsp;</th>
      <th>Link Title</th>
      <th>Link Subtitle</th>
      <th>Link (http://)</th>
      </tr>
    </thead>
    <tbody id="link_area">



    </tbody>
    </table>
    
    <button type="submit" class="btn btn-default">Submit</button>
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
<script src="//cdn.ckeditor.com/4.9.1/standard/ckeditor.js"></script>
<script>
	CKEDITOR.replace( 'cms_details' );
	CKEDITOR.config.allowedContent = true;
	
	
	
function add_link()
{
	
	var link_count = $('#link_count').val();
	var link_count_new = parseInt(link_count)+1;
	$('#link_count').val(link_count_new);
	$('#button_remove_link').remove();
	
	var msg = '<tr id="link_area_row_'+link_count_new+'"><td id="link_remove_area_'+link_count_new+'"><h3 id="button_remove_link"><a onClick="remove_link()"><i class="icon-minus-sign"></i></a></h3></td><td><input type="text"  id="link_title_'+link_count_new+'" name="link_title_'+link_count_new+'" value=""></td><td><input type="text"  id="link_subtitle_'+link_count_new+'" name="link_subtitle_'+link_count_new+'"></td><td><input type="text" style="" id="link_link_'+link_count_new+'" name="link_link_'+link_count_new+'"></td></tr> ';
	if(link_count==0)
	{
	//''
	//$('#button_add_stone').after('');
	$('#link_area').html(msg);
	//$('#stone_area_row_0').after(msg);

	}
	else
	{

	$('#link_area_row_'+link_count).after(msg);
	}


	
	//$('#link_itemname_'+link_count_new).val($("#item_GUID option:selected").text());
}

function remove_link()
{
var link_count = $('#link_count').val();
var link_count_new = parseInt(link_count)-1;
$('#link_count').val(link_count_new);
$('#link_area_row_top_'+link_count).remove();
$('#link_area_row_'+link_count).remove();

if(link_count_new!=0)
{
$('#link_remove_area_'+link_count_new).html('<h3 id="button_remove_link"><a onClick="remove_link()"><i class="icon-minus-sign"></i></a></h3>');

}
}


function delete_link(id)
{
	$.ajax({
      url: "<?php echo base_url()?>controll_admin/product/ajax_change",
      async: false,
      type: "POST",
      data: "action=delete_link&id="+id,
      dataType: "html",
      success: function(data) {
		//  alert(data);
     $('#already_link_'+id).remove();
	 $('#already_link_edit_'+id).remove();
      }
    });
}

function edit_link(id)
{
	$('#already_link_edit_'+id).css('display','table-row');
	$('#already_link_'+id).css('display','none');
	
}
function unedit_link(id)
{
	$('#already_link_edit_'+id).css('display','none');
	$('#already_link_'+id).css('display','table-row');
}
function update_link(id)
{

	$.ajax({
      url: "<?php echo base_url()?>controll_admin/product/ajax_change",
      async: false,
      type: "POST",
      data: "action=modify_link&id="+id+"&already_link_title="+$('#already_link_title_'+id).val()+"&already_link_subtitle="+$('#already_link_subtitle_'+id).val()+"&already_link_href="+$('#already_link_href_'+id).val(),
      dataType: "html",
      success: function(data) {
		 // alert(data);
   location.reload();
	
      }
    });
}
</script>