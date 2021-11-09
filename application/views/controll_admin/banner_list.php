<?php $this->load->view('controll_admin/common/header'); ?>
<?php $data['mainpage'] ='banner';?>
<?php $this->load->view('controll_admin/common/menu',$data); ?>
<?php if(isset($banner_details[0]))
{
  $page_title = 'Edit Banner - '.$banner_details[0]->name;
}
else
{
  $page_title = 'Add Banner';
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
<?php if($this->session->flashdata('error_msg')){ ?>
<div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <?php echo $this->session->flashdata('error_msg');; ?> </div>
<?php } ?>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span5">
          <div class="widget ">
            <div class="widget-header"> <i class="icon-user"></i>
              <h3>
                <?=$page_title?>
              </h3>
            </div>
            <!-- /widget-header -->
            
            <div class="widget-content">
              <form class="form-horizontal well" name="add_area" id="add_area" method="post" action="<?php echo base_url().BaseAdminURl.'/';?>banner/add_edit/<?php echo $this->uri->segment(4);?>" enctype="multipart/form-data">
                <input type="hidden" name="entry_value" value="addnew_val">
                <fieldset>
                  <div class="control-group">
                    <label class="control-label" for="uploaded_csv">Banner Name</label>
                    <div class="controls">
                      <input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="banner_name" value="<?php echo(isset($banner_details[0]->name)? $banner_details[0]->name : set_value('banner_name')); ?>" name="banner_name" placeholder="Name">
                    </div>
                    <!-- /controls --> 
                  </div>
                  <!-- /control-group -->
                  
                  <div class="control-group">
                    <label class="control-label" for="uploaded_image">Desktop Image <small><?php echo '&nbsp;&nbsp;&nbsp;';?>(jpeg|jpg|png|webp are allowed only)<br>[width: 1500 px, height: 650 px]</small></label>
                    <div class="controls">
                      <input type="file" data-validation="required" data-validation-error-msg="Please enter Image" class="span4" id="desktop_img"  name="desktop_img[]"/>
                      <?php if(!empty($banner_details)){ 
									if(isset($banner_details[0]->desktop_img)){ 
					?>
                      <img src="<?php echo base_url().'uploads/'.$banner_details[0]->desktop_img;?>" title="" alt="Desktop image" style="height:100px; width:100px;"/>
                      <?php 	}
								}
					?>
                    </div>
                    <!-- /controls --> 
                  </div>
                  <!--<div class="control-group">
                    <label class="control-label" for="uploaded_image">Mobile Image</label>
                    <div class="controls">
                      <input type="file" data-validation="required" data-validation-error-msg="Please enter Image" class="span4" id="mobile_img"  name="mobile_img[]"/>
                      <?php if(!empty($banner_details)){ 
									if(isset($banner_details[0]->mobile_img)){ 
					?>
                      <img src="<?php echo base_url().'uploads/'.$banner_details[0]->mobile_img;?>" title="" alt="Mobile image" style="height:100px; width:100px;"/>
                      <?php 	}
								}
					?>
                    </div>
                  </div>-->
				  
				  
				  <div class="control-group">
                    <label class="control-label" for="uploaded_csv">Alt tag for banner</label>
                    <div class="controls">
                      <input type="text" data-validation="required" class="form-control" id="banner_url" value="<?php echo(isset($banner_details[0]->banner_alt_tag)? $banner_details[0]->banner_alt_tag : set_value('banner_alt_tag')); ?>" name="banner_alt_tag" placeholder="banner alt tag">
                    </div>
                  </div>
				  
				  
				  
                  <div class="control-group">
                    <label class="control-label" for="uploaded_csv">Banner URL</label>
                    <div class="controls">
                      <input type="text" data-validation="required" data-validation-error-msg="Please enter url" class="form-control" id="banner_url" value="<?php echo(isset($banner_details[0]->url)? $banner_details[0]->url : set_value('banner_url')); ?>" name="banner_url" placeholder="URL">
                    </div>
                    <!-- /controls --> 
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="uploaded_csv">Description</label>
                    <div class="controls">
                      <textarea class="form-control" rows="3" name="banner_description" placeholder="Description" data-validation="required" data-validation-error-msg="Please enter description"><?php echo(isset($banner_details[0]->description)? $banner_details[0]->description : set_value('description')); ?></textarea>
                    </div>
                    <!-- /controls --> 
                  </div>
				  
					<div class="control-group">
						<label class="control-label" for="uploaded_csv">Banner first heading</label>
						<div class="controls">
							<input type="text" name="banner_first_heading" class="form-control" placeholder="Enter banner first heading" data-validation="required" value="<?php echo(isset($banner_details[0]->banner_first_heading)? $banner_details[0]->banner_first_heading : set_value('banner_first_heading')); ?>">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="uploaded_csv">Banner second heading</label>
						<div class="controls">
							<input type="text" name="banner_second_heading" class="form-control" value="<?php echo(isset($banner_details[0]->banner_second_heading)? $banner_details[0]->banner_second_heading : set_value('banner_second_heading')); ?>" placeholder="Enter banner second heading" data-validation="required">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="uploaded_csv">Banner third heading</label>
						<div class="controls">
							<input type="text" name="banner_third_heading" class="form-control" value="<?php echo(isset($banner_details[0]->banner_third_heading)? $banner_details[0]->banner_third_heading : set_value('banner_third_heading')); ?>" placeholder="Enter banner third heading" data-validation="required">
						</div>
					</div>
					
                  <!-- /control-group --> 
                  
                  <!-- /control-group -->
                  
                  <div class="control-group">
                    <label class="control-label" for="uploaded_csv">Status</label>
                    <div class="controls">
                      <input type="radio" name="banner_status" id="category_status_active" value="Y" <?=(isset($banner_details[0]->status) && $banner_details[0]->status == 'Y')?'checked':''?>>
                      <span class="active_radio" >Active</span>
                      <input type="radio" class="active" name="banner_status" id="category_status_inactive" value="N" <?=(isset($banner_details[0]->status) && $banner_details[0]->status == 'N')?'checked':''?>>
                      <span class="active_radio" >Inactive</span> </div>
                    <!-- /controls --> 
                  </div>
                  <!-- /control-group -->
                  
                  <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                    <?php if(empty($banner_details[0])){ echo "Add";} else{ echo "Update"; }?>
                    Banner </button>
                  </div>
                  <!-- /form-actions -->
                </fieldset>
              </form>
            </div>
          </div>
          <!-- /widget --> 
          
        </div>
        <div class="span7">
          <div class="widget ">
            <div class="widget-header"> <i class="icon-user"></i>
              <h3>Banner List</h3>
            </div>
            <!-- /widget-header -->
            
            <div class="widget-content">
              <div class="table-responsive">
                <table class="table-condensed table-striped dataTables_filter" id="table_of_list">
                  <thead>
                    <tr>
                      <th class="span1">Sl No.</th>
                      <th class="span4">Name</th>
                      <!--<th class="span5">Description</th>-->
                      <th class="span1">Status</th>
                      <th class="span4">Action</th>
                    </tr>
                  </thead>
                  <!--  <tfoot>
                    <tr>
                      <th class="span1">Sl No.</th>
                      <th class="span4">Name</th>
                      
                      <th class="span1">Status</th>
                      <th class="span4">Action</th>
                    </tr>
                  </tfoot> -->
                  <tbody id="stone_area">
                    <?php
					$count = 0;
					$search = array();


					if(!empty($banner))
					{ 
					foreach($banner as $cat)
					{
						$count++;
						?>
                    <tr>
                      <td><?=$count?></td>
                      <td><?=$cat->name==''?'':$cat->name?></td>
                      <!--<td><?=$cat->description==''?'':'<br>'.$cat->description?></td>-->
                      
                      <td><?php if($cat->status=='Y')
						{
						?>
                        <a href="<?php echo base_url().BaseAdminURl.'/';?>banner/change_status/<?php echo $cat->banner_id.'/N';?>" class="btn btn-success">Active</a>
                        <?php
						}
						else
						{
						?>
                        <a href="<?php echo base_url().BaseAdminURl.'/';?>banner/change_status/<?php echo $cat->brand_id.'/Y';?>" class="btn btn-danger">Disable</a>
                        <?php
						}
						?></td>
                      <td class="span4"><!--<a href="#" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>&nbsp; &nbsp;--><a  href="javascript:void(0)" id="<?php echo $cat->banner_id;?>" class="btn btn-danger delete_button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>&nbsp;&nbsp;<a href="<?php echo base_url().BaseAdminURl.'/';?>banner/add_edit/<?php echo $cat->banner_id;?>" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> 
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
            </div>
            <!-- /widget-content --> 
            
          </div>
          <!-- /widget --> 
          
        </div>
      </div>
      <!-- /row --> 
      
    </div>
    <!-- /container --> 
    
  </div>
  <!-- /main-inner --> 
  
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
	window.location='<?php echo base_url().BaseAdminURl.'/';?>banner/delete/'+$(this).attr('id');
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