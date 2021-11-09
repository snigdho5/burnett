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
				
                <form method="post" action="" id="pro_submit_form">
                    <div class="span12 stone_details" id="general_details">
                        <div class="widget ">
                            <div class="widget-header ">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#general_details" href="#general_details_area">&nbsp;</a> <i class="icon-leaf"></i>
                                <h3>Add message</h3>
                                <div class="pull-right"></div>
                            </div>
                            <div class="widget-content panel-collapse collapse in" id="general_details_area">
                                <div class="span4">
                                    <div class="control-group">
                                        <label class="control-label" for="stonegroup_name">Message</label>
                                        <div class="controls">
                                            <textarea class="form-control" rows="3" name="message" id="message_id" placeholder="Message" data-validation="required" data-validation-error-msg="Please enter message"><?php echo isset($editMsg[0]->message)?$editMsg[0]->message:'';?></textarea>
											<?php echo form_error('message', '<div class="text-danger">', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div  class="span4">
                                    <div class="control-group">
                                        <label class="control-label" for="stonegroup_name">Status</label>
                                        <div class="controls">
                                            <select class="form-control" name="status" id="status_id">
                                                <option value="1" <?php if($editMsg[0]->status == 1){ echo 'selected';};?> >Active</option>
                                                <option value="0" <?php if($editMsg[0]->status == 0){ echo 'selected';};?> >Inactive</option>
                                            </select>
											<?php echo form_error('status', '<div class="text-danger">', '</div>'); ?>
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