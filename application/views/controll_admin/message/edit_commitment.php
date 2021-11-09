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
				
                <form method="post" action="" id="pro_submit_form" class="pro_submit_form_cls" enctype="multipart/form-data">
                    <div class="span12 stone_details" id="general_details">
                        <div class="widget ">
                            <div class="widget-header ">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#general_details" href="#general_details_area">&nbsp;</a> <i class="icon-leaf"></i>
                                <h3>Edit Commitment</h3>
                                <div class="pull-right"></div>
                            </div>
                            <div class="widget-content panel-collapse collapse in" id="general_details_area">
								
								<div class="span4">
									<div class="control-group">
										<label class="control-label" for="stonegroup_name"> Title<i class="text-danger" style="color : red">*</i></label>
										<div class="controls">
											<input type="text" name="title" id="title" value="<?php echo isset($editMsg[0]->title)?$editMsg[0]->title:'';?>" class="form-control" placeholder="Enter title" data-validation="required" >
											<?php echo form_error('title', '<div class="text-danger">', '</div>'); ?>
										</div> 
									</div>
								</div>
								
								<div class="span4">
									<div class="control-group">
										<label class="control-label" for="stonegroup_name"> Text <i class="text-danger" style="color : red">*</i></label>
										<div class="controls">
											<input type="text" name="text_msg" id="title" value="<?php echo isset($editMsg[0]->text_msg)?$editMsg[0]->text_msg:'';?>" class="form-control" placeholder="Enter text" data-validation="required" >
											<?php echo form_error('text_msg', '<div class="text-danger">', '</div>'); ?>
										</div> 
									</div>
								</div>
								
								<div class="span4">
									<div class="control-group">
										<label class="control-label" for="stonegroup_name"> Alt Tag </label>
										<div class="controls">
											<input type="text" name="alt_tag" id="alt_tag" value="<?php echo isset($editMsg[0]->alt_tag)?$editMsg[0]->alt_tag:'';?>" class="form-control" placeholder="Enter alt tag" data-validation="required" >
										</div> 
									</div>
								</div>
								
								<input type="hidden" name="hdn_f_image" value="<?php echo isset($editMsg[0]->f_image)?$editMsg[0]->f_image:'';?>"/>
								
								<input type="hidden" name="hdn_title" value="<?php echo isset($editMsg[0]->title)?$editMsg[0]->title:'';?>"/>
								
								<div class="span4">
									<div class="control-group">
										<label class="control-label" for="stonegroup_name"> Image<i class="text-danger" style="color : red">*</i><small><?php echo '&nbsp;&nbsp;&nbsp;';?>(jpeg|jpg|png are allowed only) <br>[width: 50 px, height: 50 px]</small></label>
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