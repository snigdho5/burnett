<?php $this->load->view('controll_admin/common/header'); ?>
<?php $data['mainpage'] ='message';?>
<?php $this->load->view('controll_admin/common/menu',$data); ?>

<?php if($this->session->flashdata('auth_msg')){ ?>
<div class="alert alert-success">
	<?php echo $this->session->flashdata('auth_msg');?>
</div>
<?php } ?>

<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <?php if(validation_errors()) { ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo validation_errors(); ?> 
                </div>
                <?php } ?>
                <?php if($this->session->flashdata('succ_msg')){ ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('succ_msg');; ?> 
                </div>
                <?php } ?>
				
                <form method="post" action="" id="pro_submit_form" id="pro_submit_form_cls" enctype="multipart/form-data">
                    <div class="span12 stone_details" id="general_details">
                        <div class="widget ">
                            <div class="widget-header ">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#general_details" href="#general_details_area">&nbsp;</a> <i class="icon-leaf"></i>
                                <h3>Add Image</h3>
                                <div class="pull-right"></div>
                            </div>
                            <div class="widget-content panel-collapse collapse in" id="general_details_area">
							
								<div class="span4">
									<div class="control-group">
										<label class="control-label" for="stonegroup_name"> Upload Image <i class="text-danger" style="color : red">*</i> <small><?php echo '&nbsp;&nbsp;&nbsp;';?>(jpeg|jpg|png are allowed only) <br>[width: 1530 px, height: 510 px]</small></label>
										<div class="controls">
											<input type="file" name="f_image" id="seventh_image_id" value="" class="form-control" placeholder="Enter youtube video id" data-validation="required" >
										</div> 
									</div>
								</div>
								
								<div class="span4">
									<div class="control-group">
										<label class="control-label" for="stonegroup_name"> Image Preview <i class="text-danger" style="color : red">*</i></label>
										<?php if(isset($editMsg[0]) && $editMsg[0]->image !=''){ ?>
											<img src="<?php echo base_url('uploads/home_image/'.$editMsg[0]->image);?>" alt="<?php echo isset($editMsg[0]->alt_tag)?$editMsg[0]->alt_tag:'';?>" width="100" height="100"/>
										<?php } ?>
									</div>
								</div>
								
								<input type="hidden" name="hdn_f_image" value="<?php echo isset($editMsg[0]->image)?$editMsg[0]->image:'';?>" >
								
								<div class="span4">
									<div class="control-group">
										<label class="control-label" for="stonegroup_name"> Alt Tag </label>
										<div class="controls">
											<input type="text" name="alt_tag" value="<?php echo isset($editMsg[0]->alt_tag)?$editMsg[0]->alt_tag:'';?>" class="form-control" placeholder="Enter Alt Tag" data-validation="required" >
										</div> 
									</div>
								</div>
								
                            </div>
                        </div>
                    </div>
                    <div class="span12 stone_details" id="stone_details">
                        <div class="widget ">
                            <div class="widget-header ">
                            </div>
                            <div class="widget-content panel-collapse collapse in" id="stone_details_area">
                                <div class="table-responsive">
                                    <div class="form-group">
                                    </div>
                                    <button type="submit" onclick="return pro_form_validation();" class="btn btn-default">Submit</button>
                                    <button type="reset" class="btn btn-default" onclick="javascript:location.reload();">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('controll_admin/common/footer'); ?>

<link href="<?php echo base_url();?>assets/frontend/custom_script/form_validation.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/frontend/custom_script/validation_rulse.js"></script>
<script type="text/javascript">
    /* function cu_data_Submit_fm()
    {
		var seventh_image_id = $("#seventh_image_id").val();
		if (seventh_image_id ==""){
			$('#seventh_image_id').removeClass('black_border').addClass('red_border');
		}else{
			$('#seventh_image_id').removeClass('red_border').addClass('black_border');
		}
    }
    
    function pro_form_validation()
	{
		$('#pro_submit_form').attr('onchange', 'cu_data_Submit_fm()');
		$('#pro_submit_form').attr('onkeypress', 'cu_data_Submit_fm()');

		cu_data_Submit_fm();

		if ($('#pro_submit_form .red_border').length > 0)
		{
			$('#pro_submit_form .red_border:first').focus();
			$('#pro_submit_form .alert-error').show();
			return false;
		} else {
			$("#pro_submit_form").submit();
		} 
	} */
</script>