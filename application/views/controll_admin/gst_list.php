<?php $this->load->view('controll_admin/common/header'); ?>
<?php $data['mainpage'] ='ecomm';?>
<?php $this->load->view('controll_admin/common/menu',$data); ?>
<?php if(isset($gst_details[0]))
{
  $page_title = 'Edit Gst Slab - '.$gst_details[0]->name;
}
else
{
  $page_title = 'Add Gst Slab';
}
?>

   <?php if($this->session->flashdata('auth_msg')){ ?>
   <div class="alert alert-success"><?php echo $this->session->flashdata('auth_msg');?></div>
   <?php } ?>
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
   
   <div class="main">
	
	<div class="main-inner">

	    <div class="container">
	
	      <div class="row">
	      	         
                        
                            
         <div class="span5">      		
	      		
	      		<div class="widget ">
	      			
	      			<div class="widget-header">
	      				<i class="icon-user"></i>
	      				<h3><?=$page_title?></h3>
	  				</div> <!-- /widget-header -->
					
					<div class="widget-content">
                     <form class="form-horizontal well" name="add_area" id="add_area" method="post" action="<?php echo base_url().BaseAdminURl.'/';?>gst/add_edit/<?php echo $this->uri->segment(4);?>" enctype="multipart/form-data">
            <input type="hidden" name="entry_value" value="addnew_val">   
                          

									<fieldset>
										<div class="control-group">											
											<label class="control-label" for="uploaded_csv">Gst Name</label>
											<div class="controls">
												 <input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="gst_name" value="<?php echo(isset($gst_details[0]->name)? $gst_details[0]->name : set_value('gst_name')); ?>" name="gst_name" placeholder="Name">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
											<label class="control-label" for="uploaded_csv">Description</label>
											<div class="controls">
												<textarea class="form-control" rows="3" name="gst_description" placeholder="Description" data-validation="required" data-validation-error-msg="Please enter description"><?php echo(isset($gst_details[0]->description)? $gst_details[0]->description : set_value('description')); ?></textarea> 
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                  
										<div class="control-group">											
											<label class="control-label" for="uploaded_csv">Cgst (%)</label>
											<div class="controls">
												 <input type="text" data-validation="required" data-validation-error-msg="Please enter cgst" class="form-control" id="cgst" value="<?php echo(isset($gst_details[0]->cgst)? $gst_details[0]->cgst : set_value('cgst')); ?>" name="cgst" placeholder="Cgst">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
											<label class="control-label" for="uploaded_csv">Sgst (%)</label>
											<div class="controls">
												 <input type="text" data-validation="required" data-validation-error-msg="Please enter sgst" class="form-control" id="sgst" value="<?php echo(isset($gst_details[0]->sgst)? $gst_details[0]->sgst : set_value('sgst')); ?>" name="sgst" placeholder="Sgst">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
									 <!-- /control-group -->
                                        
                                        
										 <div class="control-group">											
											<label class="control-label" for="uploaded_csv">Status</label>
											<div class="controls">
												<input type="radio" name="gst_status" id="gst_status_active" value="1" checked="checked"><span class="active_radio" >Active</span>
                                                <input type="radio" class="active" name="gst_status" id="gst_status_inactive" value="0" <?=(isset($gst_details[0]->status) && $gst_details[0]->status == '0')?'checked':''?>><span class="active_radio" >Inactive</span>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
											
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">Update User</button> 
											
										</div> <!-- /form-actions -->
									</fieldset>
								</form>
                      
					


</div>
				</div> <!-- /widget -->
	      		
		    </div>
       		
         
	      
	      <div class="span7">      		
	      		
	      		<div class="widget ">
               
	      			
	      			<div class="widget-header">
	      				<i class="icon-user"></i>
	      				<h3>Gst List</h3>
	  				</div> <!-- /widget-header -->
					
					<div class="widget-content">
                    
                    
                        <div class="table-responsive">
<table class="table-condensed table-striped dataTables_filter" id="table_of_list">
                  <thead>
                    <tr>
                      <th class="span1">Sl No.</th>
                      <th class="span2">Name</th>
                      <th class="span5">Description</th>
                     <th class="span2">Status</th>
                      <th class="span4">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th class="span1">Sl No.</th>
                      <th class="span2">Name</th>
                      <th class="span5">Description</th>
                      <th class="span2">Status</th>
                      <th class="span4">Action</th>
                    </tr>
                  </tfoot>
                  <tbody id="stone_area">
                    <?php
					$count = 0;
					$search = array();
					if(!empty($gst))
					{ 
					foreach($gst as $cat)
					{
						$count++;
						?>
                    <tr>
                      <td><?=$count?></td>
                      <td><?=$cat->name==''?'':$cat->name?></td>
                      <td><?=$cat->description==''?'':$cat->description?>
                      <?=$cat->cgst==''?'':'<br>Cgst '.$cat->cgst.'%'?>
                      <?=$cat->sgst==''?'':'<br>Sgst '.$cat->sgst.'%'?></td>
                                           
                      <td><?php if($cat->status=='1')
						{
						?>
                            <a href="<?php echo base_url().BaseAdminURl.'/';?>gst/change_status/<?php echo $cat->gst_id.'/0';?>" class="btn btn-success">Active</a>
                        <?php
						}
						else
						{
						?>
							<a href="<?php echo base_url().BaseAdminURl.'/';?>gst/change_status/<?php echo $cat->gst_id.'/1';?>" class="btn btn-danger">Disable</a>
                        <?php
						}
						?></td>
                      <td class="span4"><!--<a href="#" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>&nbsp; &nbsp;--><a  href="javascript:void(0)" id="<?php echo $cat->gst_id;?>" class="btn btn-danger delete_button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>&nbsp;&nbsp;<a href="<?php echo base_url().BaseAdminURl.'/';?>gst/add_edit/<?php echo $cat->gst_id;?>" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        <!--<br>
                        <a href="user/view_details/<?php //echo $product->user_GUID;?>" class="btn btn-warning"><span class="icon-large icon-question-sign
" aria-hidden="true"></span></a>--></td>
                    </tr>
                    <?php
										}
							}
										?>
                  </tbody>
                </table>
</div>
		</div> <!-- /widget-content -->
						
				</div> <!-- /widget -->
	      		
		    </div>	
	      	
	      </div> <!-- /row -->
	
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div>
   
 
    
    

<?php $this->load->view('controll_admin/common/footer'); ?>

<script type="application/javascript">   


$(document).ready(function() {

	$(".edit_button").click(function(){
	//alert();
	$('#submit_value').val('edit');
	$('#submit_send_value').val($(this).attr('id'));
	$('#allform').submit();
	});
	$(".delete_button").click(function(){
	//alert();
	if(confirm("Are You sure You want to delete!"))
	{
	window.location='<?php echo base_url().BaseAdminURl.'/';?>gst/delete/'+$(this).attr('id');
	}
	});
	
	table = $('#table_of_list').DataTable({

        "paging":   true,

		"pageLength": 100,

		"lengthMenu": [[10,25,50,100, 250, 500, -1], [10,25,50,100, 250, 500, "All"]],

		"stateSave": true,

        "ordering": false,

        "info":     false,

		"language": {

			"lengthMenu": "Show no. of Entries in a Grid:  _MENU_ ",

			"sSearch": "Enter keyword to Search: ",



  },

   			});

	$( table.table().container() ).on( 'keyup', 'tfoot input', function () {

        table

            .column( $(this).data('index') )

            .search( this.value )

            .draw();

    } );
});
    </script>