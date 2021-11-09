<?php $this->load->view('controll_admin/common/header'); ?>
<?php $data['mainpage'] = 'product'; ?>
<?php $this->load->view('controll_admin/common/menu', $data); ?>
<?php if (isset($product_details[0])) {
  $page_title = 'Edit Product - ' . $product_details[0]->unique_key;
} else {
  $page_title = 'Add Product';
}
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
        <form class="" name="add_area" method="post" action="<?php echo base_url() . BaseAdminURl . '/'; ?>product/product_add_submit" id="pro_submit_form" enctype="multipart/form-data">


          <div class="span12 stone_details" id="general_details">
            <div class="widget ">
              <div class="widget-header "><a class="accordion-toggle" data-toggle="collapse" data-parent="#general_details" href="#general_details_area">&nbsp;</a> <i class="icon-leaf"></i>
                <h3><?= $page_title ?></h3>
                <div class="pull-right"></div>
              </div>
              <div class="widget-content panel-collapse collapse in" id="general_details_area">

                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Select Product Option</label>
                    <div class="controls">

                      <select class="form-control" onchange="select_product_option_fun();" name="select_product_option" id="select_product_option">
                        <option value="">Select Product Option</option>
                        <option value="simple">Simple Product</option>
                        <option value="variable">Variable Product</option>
                      </select>

                      <!--  <input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="product_title_eng" value="" name="product_title_eng" placeholder="Title">
                                          
                                          <br /> 
                                          <textarea class="form-control" rows="3" name="product_des_eng" placeholder="Description" data-validation="required" data-validation-error-msg="Please enter description"></textarea>

                                          <div id="show_attribute" class="span4 ML0">  -->

                    </div>
                  </div>
                </div>

                <div id="show_attribute" class="span4">


                </div>


                <div id="show_variation" class="span4">



                </div>

                <div class="span4">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Select Category</label>
                    <div class="controls">
                      <select class="form-control cast-crew-multiple" name="category_id[]" id="category_id" multiple="multiple">

                        <option value="">Select Category</option>
                        <?php foreach ($category_list as $cat) { ?>
                          <option value="<?php echo $cat->cat_id; ?>"><?php echo $cat->name; ?></option>
                        <?php } ?>
                      </select>



                    </div>
                  </div>

                </div>


                <?php /*<div class="span4">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Select Brand</label>
                    <div class="controls">

                      <select class="form-control" name="brand_id" id="brand_id">
                        <option value="">Select Brand</option>
                        <?php foreach ($brand_list as $brand) { ?>
                          <option value="<?php echo $brand->brand_id; ?>"><?php echo $brand->name; ?></option>
                        <?php } ?>

                      </select>



                    </div>
                  </div>

                </div>*/ ?>



                <div class="span4">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name"> Product Name</label>
                    <div class="controls">

                      <input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="product_title" value="" name="product_title" placeholder="Product Name">



                    </div>
                  </div>

                </div>

                <?php /*<div class="span4">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Batch No</label>
                    <div class="controls">

                      <input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="product_batch_no" value="" name="product_batch_no" placeholder="Batch No">



                    </div>
                  </div>

                </div>*/?>



                <div class="span4">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Product Quantity</label>
                    <div class="controls">

                      <input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="product_quantity_info" value="" name="product_quantity_info" placeholder="Product Quantity">



                    </div>
                  </div>

                </div>
                <div class="span4">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Stocks Product</label>
                    <div class="controls">

                      <input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="stock_count" value="" name="stock_count" placeholder="Stocks Product">



                    </div>
                  </div>

                </div>

                <div id="show_price" class="span4">



                </div>

                <div id="regular_price" class="span4">


                </div>

                <div class="span4">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Product Image</label>
                    <div class="controls">

                      <input type="file" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="product_image" value="" name="product_image">



                    </div>
                  </div>

                </div>

              </div>
            </div>
          </div>


          <div class="span12 stone_details" id="price_details">
            <div class="widget ">
              <div class="widget-header ">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#price_details" href="#price_details_area">&nbsp;</a><i class="icon-leaf"></i>
                <h3>Product Description Details</h3>
                <div class="pull-right"></div>
              </div>
              <div class="widget-content panel-collapse collapse in" id="price_details_area">

                <div class="span4">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Product Component</label>
                    <div class="controls">

                      <textarea class="form-control" rows="3" name="product_description" id="product_description" placeholder="Component" data-validation="required" data-validation-error-msg="Please enter Component"></textarea>



                    </div>
                  </div>

                </div>

                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Product Dose English Text</label>
                    <div class="controls">
                      <textarea class="form-control" rows="3" name="dose" id="dose" placeholder="Dose English Text" data-validation="required" data-validation-error-msg="Please enter dose"></textarea>

                    </div>
                  </div>

                </div>

                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Product Dose Hindi Text</label>
                    <div class="controls">
                      <textarea class="form-control" rows="3" name="dose_hindi" id="dose_hindi" placeholder="Dose Hindi Text" data-validation="required" data-validation-error-msg="Please enter dose"></textarea>

                    </div>
                  </div>

                </div>

                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Product Dose Bengali Text</label>
                    <div class="controls">
                      <textarea class="form-control" rows="3" name="dose_bengali" id="dose_bengali" placeholder="Dose Bengali Text" data-validation="required" data-validation-error-msg="Please enter dose"></textarea>

                    </div>
                  </div>

                </div>

                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">English Indication Text</label>
                    <div class="controls">
                      <textarea class="form-control" rows="3" name="indication_english_text" id="indication_english_text" placeholder="English Indication Text" data-validation="required" data-validation-error-msg="Please enter English Indication Text"></textarea>

                    </div>
                  </div>

                </div>

                <div class="span4" style="line-height:75px;">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">English Indication Image</label>
                    <div class="controls">

                      <input type="file" data-validation="required" data-validation-error-msg="Please enter Image" class="form-control" id="indication_english_img" value="" name="indication_english_img">



                    </div>
                  </div>

                </div>

                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Hindi Indication Text</label>
                    <div class="controls">
                      <textarea class="form-control" rows="3" name="indication_hindi_text" id="indication_hindi_text" placeholder="Hindi Indication Text" data-validation="required" data-validation-error-msg="Please enter Hindi Indication Text"></textarea>

                    </div>
                  </div>

                </div>

                <div class="span4" style="line-height:75px;">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Hindi Indication Image</label>
                    <div class="controls">

                      <input type="file" data-validation="required" data-validation-error-msg="Please enter Image" class="form-control" id="indication_hindi_img" value="" name="indication_hindi_img">



                    </div>
                  </div>

                </div>

                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Bengali Indication Text</label>
                    <div class="controls">
                      <textarea class="form-control" rows="3" name="indication_bengali_text" id="indication_bengali_text" placeholder="Bengali Indication Text" data-validation="required" data-validation-error-msg="Please enter Bengali Indication Text"></textarea>

                    </div>
                  </div>

                </div>

                <div class="span4">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Bengali Indication Image</label>
                    <div class="controls">

                      <input type="file" data-validation="required" data-validation-error-msg="Please enter Image" class="form-control" id="indication_bengali_img" value="" name="indication_bengali_img">



                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <!-- /widget -->

          <div class="span12 stone_details" id="price_details">
            <div class="widget ">
              <div class="widget-header ">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#price_details" href="#price_details_area">&nbsp;</a><i class="icon-leaf"></i>
                <h3>Seo Details</h3>
                <div class="pull-right"></div>
              </div>
              <div class="widget-content panel-collapse collapse in" id="price_details_area">

                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Meta Title</label>
                    <div class="controls">

                      <input type="text" data-validation="required" data-validation-error-msg="Please enter Price" class="form-control" id="meta_title" value="" name="meta_title" placeholder="Meta Title">

                    </div>
                  </div>
                </div>


                <div class="span4">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Meta Keyword</label>
                    <div class="controls">

                      <textarea class="form-control" rows="3" name="meta_keyword" id="meta_keyword" placeholder="Description" data-validation="required" data-validation-error-msg="Meta Keyword"></textarea>



                    </div>
                  </div>

                </div>

                <div class="span4">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Meta Description</label>
                    <div class="controls">

                      <textarea class="form-control" rows="3" name="meta_description" id="meta_description" placeholder="Description" data-validation="required" data-validation-error-msg="Meta Description"></textarea>



                    </div>
                  </div>

                </div>



              </div>


            </div>


          </div>

          <!-- /controls -->


          <!-- /widget -->





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



                  <button type="submit" onclick="return pro_form_validation();" class="btn btn-default">Submit</button>
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

<script type="text/javascript">
  function select_product_option_fun() {

    var select_product_option = $('#select_product_option').val();
    var html = '';



    if (select_product_option == 'simple') {
      $('#show_attribute').html('');
      $('#show_variation').html('');
      $('#show_price').html('<div class="control-group"><label class="control-label" for="stonegroup_name">Product Sell Price</label><div class="controls"><input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="product_price" value="" name="product_price" placeholder="Product Sell Price"></div></div>');


      $('#regular_price').html('<div class="control-group"><label class="control-label" for="stonegroup_name">Product Regular Price</label><div class="controls"><input type="text" data-validation="required" data-validation-error-msg="Please enter title" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" id="product_regular_price" value="" name="product_regular_price" placeholder="Product Regular Price"></div></div>');


    } else {
      $('#show_attribute').html('');
      $('#show_variation').html('');
      $('#show_price').html('');
      $('#regular_price').html('');


    }





    //$('#stone_area_row_0').after(msg);


  }


  function select_attribute_option_fun() {

    var select_product_option = $('#select_product_option').val();
    var attribute_id = $('#attribute_id').val();
    var html = '';


    if (attribute_id != '') {

      var base_url = '<?php echo base_url(); ?>';

      $.ajax({
        type: "POST",
        dataType: 'html',
        url: base_url + "controll_admin/product/product_variation_get",
        data: {
          attribute_id: attribute_id
        },
        // async:false,

        success: function(data) {

          $('#show_variation').html(data);


        }
      });

    } else {
      $('#show_variation').html('');
    }




    //$('#stone_area_row_0').after(msg);


  }
</script>


<link href="<?php echo base_url(); ?>assets/frontend/custom_script/form_validation.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/frontend/custom_script/validation_rulse.js"></script>


<script type="text/javascript">
  function cu_data_Submit_fm() {
    var select_product_option = $("#select_product_option").val();
    if (select_product_option == "") {
      $('#select_product_option').removeClass('black_border').addClass('red_border');
    } else {
      $('#select_product_option').removeClass('red_border').addClass('black_border');




      if (select_product_option == 'simple') {


        var product_price = $("#product_price").val();
        if (product_price == "") {
          $('#product_price').removeClass('black_border').addClass('red_border');
        } else {
          $('#product_price').removeClass('red_border').addClass('black_border');
        }

        var product_regular_price = $("#product_regular_price").val();
        if (product_regular_price == "") {
          $('#product_regular_price').removeClass('black_border').addClass('red_border');
        } else {
          $('#product_regular_price').removeClass('red_border').addClass('black_border');
        }



      }










    }

    var category_id = $("#category_id").val();
    if (category_id == "") {
      $('#category_id').removeClass('black_border').addClass('red_border');
    } else {
      $('#category_id').removeClass('red_border').addClass('black_border');
    }

    // var brand_id = $("#brand_id").val();
    // if (brand_id == "") {
    //   $('#brand_id').removeClass('black_border').addClass('red_border');
    // } else {
    //   $('#brand_id').removeClass('red_border').addClass('black_border');
    // }


    var product_title = $("#product_title").val();
    if (product_title == "") {
      $('#product_title').removeClass('black_border').addClass('red_border');
    } else {
      $('#product_title').removeClass('red_border').addClass('black_border');
    }

    // var product_batch_no = $("#product_batch_no").val();
    // if (product_batch_no == "") {
    //   $('#product_batch_no').removeClass('black_border').addClass('red_border');
    // } else {
    //   $('#product_batch_no').removeClass('red_border').addClass('black_border');
    // }

    var product_quantity_info = $("#product_quantity_info").val();
    if (product_quantity_info == "") {
      $('#product_quantity_info').removeClass('black_border').addClass('red_border');
    } else {
      $('#product_quantity_info').removeClass('red_border').addClass('black_border');
    }

    var stock_count = $("#stock_count").val();
    if (stock_count == "") {
      $('#stock_count').removeClass('black_border').addClass('red_border');
    } else {
      $('#stock_count').removeClass('red_border').addClass('black_border');
    }



    var product_image = $("#product_image").val();
    if (product_image == "") {
      $('#product_image').removeClass('black_border').addClass('red_border');
    } else {
      $('#product_image').removeClass('red_border').addClass('black_border');
    }

    var product_description = $("#product_description").val();
    if (product_description == "") {
      $('#product_description').removeClass('black_border').addClass('red_border');
    } else {
      $('#product_description').removeClass('red_border').addClass('black_border');
    }


    var dose = $("#dose").val();
    if (dose == "") {
      $('#dose').removeClass('black_border').addClass('red_border');
    } else {
      $('#dose').removeClass('red_border').addClass('black_border');
    }





    // var cu_confirm=$("#cu_confirm").val();
    // if (cu_confirm=="" || cu_confirm!=cu_password) 
    // {
    //     $('#cu_confirm').removeClass('black_border').addClass('red_border');            
    // } 
    // else 
    // {
    //     $('#cu_confirm').removeClass('red_border').addClass('black_border');
    // }


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