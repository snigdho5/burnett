<?php $this->load->view('controll_admin/common/header'); ?>
<?php $data['mainpage'] = 'product'; ?>
<?php $this->load->view('controll_admin/common/menu', $data); ?>
<?php
$page_title = 'Bulk Upload';
?>

<?php if ($this->session->flashdata('auth_msg')) { ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('auth_msg'); ?></div>
<?php } ?>



<div class="main">

    <div class="main-inner">

        <div class="container">

            <div class="row">
                <div class="span12 stone_details">
                    <a href="bulkuploadsample" class="btn btn-success">Sample File</a>
                </div>
                <?php if (validation_errors()) { ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo validation_errors(); ?>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('error_msg')) { ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('error_msg'); ?>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('succ_msg')) { ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('succ_msg'); ?>
                    </div>
                <?php } ?>
                <form class="" name="add_area" method="post" action="<?php echo base_url() . BaseAdminURl . '/'; ?>product/product_bulkupload_submit" id="pro_submit_form" enctype="multipart/form-data">


                    <div class="span12 stone_details" id="general_details">
                        <div class="widget ">
                            <div class="widget-header "><a class="accordion-toggle" data-toggle="collapse" data-parent="#general_details" href="#general_details_area">&nbsp;</a> <i class="icon-leaf"></i>
                                <h3><?= $page_title ?></h3>
                                <div class="pull-right"></div>
                            </div>
                            <div class="widget-content panel-collapse collapse in" id="general_details_area">


                                <div class="span4">

                                    <div class="control-group">
                                        <label class="control-label" for="stonegroup_name">Product File</label>
                                        <div class="controls">

                                            <input type="file" data-validation="required" data-validation-error-msg="Please choose" class="form-control" id="bulkupload_file" value="" name="bulkupload_file">

                                        </div>
                                    </div>

                                </div>

                            </div>


                        </div>


                    </div>


                    <div class="span12 stone_details" id="stone_details">

                        <div class="widget ">

                            <div class="widget-header ">


                            </div> <!-- /widget-header -->

                            <div class="widget-content panel-collapse collapse in" id="stone_details_area">

                                <div class="table-responsive">

                                    <div class="form-group">


                                    </div>

                                    <button type="submit" onclick="return pro_form_validation();" class="btn btn-default btn-submit">Submit</button>
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



<link href="<?php echo base_url(); ?>assets/frontend/custom_script/form_validation.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/frontend/custom_script/validation_rulse.js"></script>


<script type="text/javascript">
    function cu_data_Submit_fm() {

        var bulkupload_file = $("#bulkupload_file").val();

        if (bulkupload_file == "") {
            $('#bulkupload_file').removeClass('black_border').addClass('red_border');
        } else {
            $('#bulkupload_file').removeClass('red_border').addClass('black_border');
        }

    }

    function pro_form_validation() {
        //alert('ok');

        // var cat_ids=[];
        //   $(':checkbox[id^="chk_bx"]:checked').each(function(){        
        //    cat_ids.push($(this).val());              
        // });



        $('#pro_submit_form').attr('onchange', 'cu_data_Submit_fm()');
        $('#pro_submit_form').attr('onkeypress', 'cu_data_Submit_fm()');

        cu_data_Submit_fm();

        //  alert($('#user_registration_form_id .red_border').size());

        if ($('#pro_submit_form .red_border').length > 0) {

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