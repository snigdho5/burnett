<?php $this->load->view('controll_admin/common/header'); ?>
<?php $data['mainpage'] = 'product'; ?>
<?php $this->load->view('controll_admin/common/menu', $data); ?>
<?php
// if (isset($product_details[0])) {
$page_title = 'View / Edit Pickup - ';
// } else {
//   $page_title = 'Add Product';
// }
?>

<?php if ($this->session->flashdata('auth_msg')) { ?>
    <div class="alert alert-success"><?php echo $this->session->flashdata('auth_msg'); ?></div>
<?php } ?>



<div class="main">

    <div class="main-inner">

        <div class="container">

            <div class="row">
                <?php if (validation_errors()) { ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo validation_errors(); ?>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('succ_msg')) { ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('succ_msg');; ?>
                    </div>
                <?php } ?>
                <form class="" name="add_area" method="post" action="<?php echo base_url() . BaseAdminURl . '/'; ?>product/product_pickup_edit_submit" id="pro_submit_form" enctype="multipart/form-data">


                    <div class="span12 stone_details" id="general_details">
                        <div class="widget ">
                            <div class="widget-header "><a class="accordion-toggle" data-toggle="collapse" data-parent="#general_details" href="#general_details_area">&nbsp;</a> <i class="icon-leaf"></i>
                                <h3><?= $page_title ?></h3>
                                <div class="pull-right"></div>
                            </div>
                            <div class="widget-content panel-collapse collapse in" id="general_details_area">


                                <div class="span4">

                                    <div class="control-group"><label class="control-label" for="stonegroup_name">Pickup Pincode</label>
                                        <div class="controls">
                                            <input type="hidden" name="pickupid" value="<?php echo $pickup_det->id; ?>">
                                            <input type="text" data-validation="required" data-validation-error-msg="Please Enter Pickup Pincode" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="pickup_pincode" value="<?php echo $pickup_det->pickup_pincode; ?>" name="pickup_pincode" placeholder="Pickup Pincode">
                                        </div>
                                    </div>

                                </div>

                                <div class="span4">

                                    <div class="control-group"><label class="control-label" for="stonegroup_name">Contact Number</label>
                                        <div class="controls">
                                            <input type="text" data-validation="required" data-validation-error-msg="Please Enter Contact Number" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="contact_number" value="<?php echo $pickup_det->phone; ?>" name="contact_number" placeholder="Contact Number">
                                        </div>
                                    </div>

                                </div>

                                
                                <div class="span4">

                                    <div class="control-group"><label class="control-label" for="stonegroup_name">Warehouse Address</label>
                                        <div class="controls">
                                            <textarea data-validation="required" data-validation-error-msg="Please Enter Warehouse Address" class="form-control" id="pickup_address" name="pickup_address" placeholder="Warehouse Address"><?php echo $pickup_det->address; ?></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="span4">

                                    <div class="control-group"><label class="control-label" for="stonegroup_name">Warehouse Landmark</label>
                                        <div class="controls">
                                            <textarea data-validation="required" data-validation-error-msg="Please Enter Warehouse Landmark" class="form-control" id="pickup_landmark" name="pickup_landmark" placeholder="Warehouse Landmark"><?php echo $pickup_det->landmark; ?></textarea>
                                        </div>
                                    </div>

                                </div>

                            </div>


                        </div>


                    </div>



                    <div class="span12 stone_details" id="stone_details">

                        <div class="widget ">

                            <div class="widget-header ">
                                <!--   <a class="accordion-toggle" data-toggle="collapse" data-parent="#stone_details" href="#stone_details_area">&nbsp;</a>
                <i class="icon-leaf"></i>
                <h3>Link Details</h3> -->

                                <!--  <div class="pull-right">
     <h3 id="button_add_stone"><i class="icon-plus"></i><a onClick="add_link()"> &nbsp; Add</a></h3>
        </div> -->

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

        var pickup_pincode = $("#pickup_pincode").val();

        if (pickup_pincode == "" && pickup_pincode.length == 6) {
            $('#pickup_pincode').removeClass('black_border').addClass('red_border');
        } else {
            $('#pickup_pincode').removeClass('red_border').addClass('black_border');
        }

        var pickup_address = $("#pickup_address").val();
        if (pickup_address == "") {
            $('#pickup_address').removeClass('black_border').addClass('red_border');
        } else {
            $('#pickup_address').removeClass('red_border').addClass('black_border');
        }

        var pickup_landmark = $("#pickup_landmark").val();
        if (pickup_landmark == "") {
            $('#pickup_landmark').removeClass('black_border').addClass('red_border');
        } else {
            $('#pickup_landmark').removeClass('red_border').addClass('black_border');
        }

        var contact_number = $("#contact_number").val();
        if (contact_number == "") {
            $('#contact_number').removeClass('black_border').addClass('red_border');
        } else {
            $('#contact_number').removeClass('red_border').addClass('black_border');
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