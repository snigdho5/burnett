<?php $this->load->view('controll_admin/common/header'); ?>
<?php $data['mainpage'] ='user';?>
<?php $this->load->view('controll_admin/common/menu',$data); ?>
<?php if(isset($user->name))
{
	$page_title = 'Edit User - '.$user->name;
}
else
{
	$page_title = 'Add User';
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
   
  
       
     <form class="" name="category_form" id="category_form" method="post" action="<?php echo base_url().BaseAdminURl.'/';?>user/add_edit/<?php echo $this->uri->segment(4);?>" enctype="multipart/form-data">
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
											<label class="control-label" for="stonegroup_name">Name</label>
											<div class="controls">
                                            	<input class="form-control" placeholder="Enter Full Name" name="name" value="<?php echo(isset($user->name)? $user->name : set_value('name')); ?>">
                                              
                                         
											</div> <!-- /controls -->
										</div> 
									</div>
                                    
                   	<div class="span4 ML0">
                                    <div class="control-group">
											<label class="control-label" for="stonegroup_name">Phone</label>
											<div class="controls">
                                            	
                                              <input type="text" class="form-control" placeholder="Enter Phone" name="phone" value="<?php echo(isset($user->phone)? $user->phone : set_value('phone')); ?>">
                                              
											</div> <!-- /controls -->
										</div> 
									</div>
                                 
                                 
                     <div class="span4 ML0">
                                    <div class="control-group">
											<label class="control-label" for="stonegroup_name">Email</label>
											<div class="controls">
                                            	
                                             <input type="email" class="form-control" placeholder="Enter unique username" name="email" value="<?php echo(isset($user->email)? $user->email : set_value('email')); ?>">
                                              
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
              <h3>Password (If you enter value it will get change. Leave it blank if you do not want to change)</h3>
              <div class="pull-right"></div>
            </div>
            <div class="widget-content panel-collapse collapse in" id="price_details_area">

                  	<div class="span4">
                                    <div class="control-group">
											<label class="control-label" for="stonegroup_name">New Password</label>
											<div class="controls">
                                            	
                                              <input type="password" class="form-control" id="product_price_inr"  name="password" placeholder="password">
                                          
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
	      				<h3>Status</h3>
                      
	  				</div> <!-- /widget-header -->

					<div class="widget-content panel-collapse collapse in" id="image_details_area">

                     <div class="span6">
 										<div class="control-group">
										
                                            <label class="control-label" for="stonegroup_name">Activation Status</label>
											<div class="controls">
                                            	
                                              <select class="form-control" name="activate">
          <option value="1" <?php if(isset($user->activate) && $user->activate == 1)echo 'selected';//else echo set_select('status', $user->status, False); ?>>Enable</option>
          <option value="0" <?php if(isset($user->activate) && $user->activate == 0)echo 'selected';//else echo set_select('status', $user->status, False); ?>>Disable</option>
         </select>
                                              </div>
                                              
                                              
											
										</div> <!-- /control-group -->


</div>

<div class="span6 ML0">
                                     <!-- /controls -->
<div class="control-group">
											
                                          <label class="control-label" for="stonegroup_name">Subscriber</label>
											<div class="controls">
                                            	<select class="form-control" name="is_subscriber">
          <option value="1" <?php if(isset($user->is_subscriber) && $user->is_subscriber == 1)echo 'selected';//else echo set_select('status', $user->status, False); ?>>Yes</option>
          <option value="0" <?php if(isset($user->is_subscriber) && $user->is_subscriber == 0)echo 'selected';//else echo set_select('status', $user->status, False); ?>>No</option>
         </select>
                                             
                                              </div>      
                                      
											</div>
										</div>
									</div>

					</div> <!-- /widget-content -->

				</div> <!-- /widget -->

		  
         <div class="span12 stone_details" id="stone_details">

	      		<div class="widget ">

	      			 <!-- /widget-header -->

					<div class="widget-content panel-collapse collapse in" id="stone_details_area">

                     <div class="table-responsive">
                     
                      
               
 
    
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



