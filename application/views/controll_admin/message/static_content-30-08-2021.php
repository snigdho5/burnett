<?php

$this->load->view('controll_admin/common/header');
$data['mainpage'] ='message';
$this->load->view('controll_admin/common/menu',$data);

?>

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
                <form method="post" action="" id="pro_submit_form">
                    <div class="span12 stone_details" id="general_details">
                        <div class="widget ">
                            <div class="widget-header ">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#general_details" href="#general_details_area">&nbsp;</a> <i class="icon-leaf"></i>
                                <h3>Add static home content</h3>
                                <div class="pull-right"></div>
                            </div>
                            <div class="widget-content panel-collapse collapse in" id="general_details_area">
							
								<div class="span4">
									<div class="control-group">
										<label class="control-label" for="stonegroup_name"> Left Heading </label>
										<div class="controls">
											<input type="text" name="left_heading" id="left_heading_id" value="<?php echo isset($editMsg[0]->left_heading)?$editMsg[0]->left_heading:'';?>" class="form-control" placeholder="Enter left heading" data-validation="required">
											<?php echo form_error('left_heading', '<div class="text-danger">', '</div>'); ?>
										</div>
									</div>
								</div>							
								
                                <div class="span4">
                                    <div class="control-group">
                                        <label class="control-label" for="stonegroup_name">Left Content</label>
                                        <div class="controls">
                                            <textarea name="left_content" id="left_content_id" class="form-control" rows="3" placeholder="Message" data-validation="required" data-validation-error-msg="Please enter left content"><?php echo isset($editMsg[0]->left_content)?$editMsg[0]->left_content:'';?></textarea>
											<?php echo form_error('left_content', '<div class="text-danger">', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                
								<div class="span4">
									<div class="control-group">
										<label class="control-label" for="stonegroup_name"> Right Heading </label>
										<div class="controls">
											<input type="text" name="right_heading" id="right_heading_id" value="<?php echo isset($editMsg[0]->right_heading)?$editMsg[0]->right_heading:'';?>" class="form-control" placeholder="Enter right heading" data-validation="required">
											<?php echo form_error('right_heading', '<div class="text-danger">', '</div>'); ?>
										</div> 
									</div>
								</div>							
								
                                <div class="span4">
                                    <div class="control-group">
                                        <label class="control-label" for="stonegroup_name">Right Content</label>
                                        <div class="controls">
                                            <textarea name="right_content" id="right_content_id" class="form-control" rows="3" placeholder="Message" data-validation="required" data-validation-error-msg="Please enter left content"><?php echo isset($editMsg[0]->right_content)?$editMsg[0]->right_content:'';?></textarea>
											<?php echo form_error('right_content', '<div class="text-danger">', '</div>'); ?>
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
    function cu_data_Submit_fm()
    {
		var message_id = $("#message_id").val();
		if (message_id ==""){
			$('#message_id').removeClass('black_border').addClass('red_border');
		}else{
			$('#message_id').removeClass('red_border').addClass('black_border');
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
	}
</script>