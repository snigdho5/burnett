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
				
				<?php if(validation_errors()){ ?>
					<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<?php echo validation_errors(); ?> </div>
				<?php } ?>
				
                <form method="post" action="" id="pro_submit_form" enctype="multipart/form-data">
                    <div class="span12 stone_details" id="general_details">
                        <div class="widget ">
                            <div class="widget-header ">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#general_details" href="#general_details_area">&nbsp;</a> <i class="icon-leaf"></i>
                                <h3>Add Get Your Choice</h3>
                                <div class="pull-right"></div>
                            </div>
                            <div class="widget-content panel-collapse collapse in" id="general_details_area">
                                
								
								<div class="span4">
									<div class="control-group">
										<label class="control-label" for="stonegroup_name"> Title<i class="text-danger" style="color : red">*</i></label>
										<div class="controls">
											<input type="text" name="title" id="title" value="<?php echo set_value('title');?>" class="form-control" placeholder="Enter title" data-validation="required" >
											<?php echo form_error('title', '<div class="text-danger">', '</div>'); ?>
										</div> 
									</div>
								</div>
								
								<div class="span4">
									<div class="control-group">
										<label class="control-label" for="stonegroup_name"> Url<i class="text-danger" style="color : red">*</i></label>
										<div class="controls">
											<input type="text" name="url" value="<?php echo set_value('url');?>" class="form-control" placeholder="Enter featured url" data-validation="required" >
											<?php echo form_error('url', '<div class="text-danger">', '</div>'); ?>
										</div> 
									</div>
								</div>
								
								<div class="span4">
									<div class="control-group">
										<label class="control-label" for="stonegroup_name"> Alt Tag<i class="text-danger" style="color : red">*</i></label>
										<div class="controls">
											<input type="text" name="alt_tag" id="alt_tag" value="<?php echo set_value('alt_tag');?>" class="form-control" placeholder="Enter alt tag" data-validation="required" >
											<?php echo form_error('alt_tag', '<div class="text-danger">', '</div>'); ?>
										</div> 
									</div>
								</div>
								
								<div class="span4">
									<div class="control-group">
										<label class="control-label" for="stonegroup_name"> Image<i class="text-danger" style="color : red">*</i><small><?php echo '&nbsp;&nbsp;&nbsp;';?>(jpeg|jpg|png are allowed only)</small></label>
										<div class="controls">
											<input type="file" name="f_image" id="f_image" class="form-control" data-validation="required" style="height: 29px;">
											<div class="text-danger" style="color : red"><?php if(isset($error) && $error!=''){ echo $error;} ?></div>
										</div> 
									</div>
								</div>
								
                                <div  class="span4">
                                    <div class="control-group">
                                        <label class="control-label" for="stonegroup_name">Status<i class="text-danger" style="color : red">*</i></label>
                                        <div class="controls">
                                            <select class="form-control" name="status" id="status_id">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
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