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
        <form class="" name="add_area" method="post" action="<?php echo base_url() . BaseAdminURl . '/'; ?>product/product_edit_submit" id="pro_submit_form" enctype="multipart/form-data">


          <div class="span12 stone_details" id="general_details">
            <div class="widget ">
              <div class="widget-header "><a class="accordion-toggle" data-toggle="collapse" data-parent="#general_details" href="#general_details_area">&nbsp;</a> <i class="icon-leaf"></i>
                <h3>Edit Product</h3>
                <div class="pull-right"></div>
              </div>
              <div class="widget-content panel-collapse collapse in" id="general_details_area">

                <div class="span4" style="display: none;">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Select Product Option</label>
                    <div class="controls">

                      <select class="form-control" onchange="select_product_option_fun();" name="select_product_option" id="select_product_option">
                        <option value="">Select Product Option</option>
                        <option value="simple" <?php if (@$product_list[0]->product_type == 'simple') {
                                                  echo 'selected';
                                                } ?>>Simple Product</option>
                        <option value="variable" <?php if (@$product_list[0]->product_type == 'variable') {
                                                    echo 'selected';
                                                  } ?>>Variable Product</option>
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
                        <?php foreach ($category_list as $cat) {

                          $product_category_details = $this->common_my_model->common($table_name = 'product_category', $field = array(), $where = array('product_id' => @$product_list[0]->product_id, 'category_id' => $cat->cat_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



                        ?>
                          <option value="<?php echo $cat->cat_id; ?>" <?php foreach ($product_category_details as $cat_pro) {
                                                                        if (@$cat->cat_id == @$cat_pro->category_id) {
                                                                          echo 'selected';
                                                                        }
                                                                      } ?>><?php echo $cat->name; ?></option>

                        <?php }  ?>

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
                        <?php foreach ($brand_list as $brand) {
                           ?>
                          <option value="<?php echo $brand->brand_id; ?>" <?php if (@$product_list[0]->brand_id == @$brand->brand_id) { echo 'selected';} ?>><?php echo $brand->name; ?></option>
                        <?php } ?>

                      </select>



                    </div>
                  </div>

                </div>*/ ?>



                <div class="span4">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name"> Product Name</label>
                    <div class="controls">

                      <input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="product_title" value="<?php echo @$product_list[0]->product_title; ?>" name="product_title" placeholder="Product Name">

                      <input type="hidden" id="old_pic" name="old_pic" value="<?php echo @$product_list[0]->product_image; ?>">
                      <input type="hidden" id="old_indication_english_img" name="old_indication_english_img" value="<?php echo @$product_list[0]->indication_english_img; ?>">
                      <input type="hidden" id="old_indication_hindi_img" name="old_indication_hindi_img" value="<?php echo @$product_list[0]->indication_hindi_img; ?>">
                      <input type="hidden" id="old_indication_bengali_img" name="old_indication_bengali_img" value="<?php echo @$product_list[0]->indication_bengali_img; ?>">

                      <input type="hidden" id="edited_product_id" name="edited_product_id" value="<?php echo @$product_list[0]->product_id; ?>">



                    </div>
                  </div>

                </div>

                <?php /* <div class="span4">
                     
                      <div class="control-group">
                      <label class="control-label" for="stonegroup_name">Batch No</label>
                      <div class="controls">

                       <input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="product_batch_no" value="<?php echo @$product_list[0]->product_batch_no;?>" name="product_batch_no" placeholder="Batch No">
                                          
                                     
                                              
                      </div> 
                    </div>   

                  </div> */ ?>



                <div class="span4">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Product Quantity</label>
                    <div class="controls">

                      <input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="product_quantity_info" value="<?php echo @$product_list[0]->product_quantity_info; ?>" name="product_quantity_info" placeholder="Product Quantity">



                    </div>
                  </div>

                </div>



                <div class="span4">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Stocks Product</label>
                    <div class="controls">

                      <input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="stock_count" value="<?php echo @$product_list[0]->stock_count; ?>" name="stock_count" placeholder="Stocks Product">



                    </div>
                  </div>

                </div>


                <div id="regular_price" class="span4">

                  <?php if (@$product_list[0]->product_type == 'simple') { ?>
                    <div class="control-group"><label class="control-label" for="stonegroup_name">Product Regular Price</label>
                      <div class="controls"><input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control product-regular-price" id="product_regular_price" value="<?php echo @$product_list[0]->product_regular_price; ?>" name="product_regular_price" placeholder="Product Regular Price"></div>
                    </div>
                  <?php } ?>

                </div>

                <div id="show_price" class="span4">

                  <?php if (@$product_list[0]->product_type == 'simple') { ?>
                    <div class="control-group"><label class="control-label" for="stonegroup_name">Product Sell Price</label>
                      <div class="controls"><input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control product-sell-price" id="product_price" value="<?php echo @$product_list[0]->product_price; ?>" name="product_price" placeholder="Product Price"></div>
                      <label class="sell-price-msg"></label>
                    </div>
                  <?php } ?>

                </div>

                <div class="span4">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Product Image </label>
                    <div class="controls">

                      <input type="file" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="product_image" value="" name="product_image">
                      <br />
                      <small style="color: #f99797">(Allowed type png,jpg and jpeg wtih 1000 X 1000 px)</small>


                    </div>
                  </div>

                </div>

                <div class="span4">

                  <div class="control-group"><label class="control-label" for="stonegroup_name">Product Weight (in Kg)</label>
                    <div class="controls"><input type="text" data-validation="required" data-validation-error-msg="Please enter Weight in Kg (e.g. 0.5 / 11)" class="form-control " id="product_weight" value="<?php echo @$product_list[0]->weight; ?>" name="product_weight" placeholder="Product Weight"></div>
                    <label class="sell-price-msg"></label>
                  </div>

                </div>

                <div class="span4">

                  <div class="control-group"><label class="control-label" for="stonegroup_name">Product Length</label>
                    <div class="controls"><input type="text" data-validation="required" data-validation-error-msg="Please enter Length" class="form-control " id="product_length" value="<?php echo @$product_list[0]->length; ?>"  name="product_length" placeholder="Product Length"></div>
                  </div>

                </div>

                <div class="span4">

                  <div class="control-group"><label class="control-label" for="stonegroup_name">Product Breadth</label>
                    <div class="controls"><input type="text" data-validation="required" data-validation-error-msg="Please enter Breadth" class="form-control " id="product_breadth" value="<?php echo @$product_list[0]->breadth; ?>"  name="product_breadth" placeholder="Product Breadth"></div>
                  </div>

                </div>

                <div class="span4">

                  <div class="control-group"><label class="control-label" for="stonegroup_name">Product Height</label>
                    <div class="controls"><input type="text" data-validation="required" data-validation-error-msg="Please enter Height" class="form-control " id="product_height" value="<?php echo @$product_list[0]->height; ?>"  name="product_height" placeholder="Product Height"></div>
                  </div>

                </div>

                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Alt For Product Image</label>
                    <div class="controls">
                      <input type="text" name="alt_for_product_image" value="<?php echo isset($product_list[0]->alt_for_product_image) ? $product_list[0]->alt_for_product_image : ''; ?>" class="form-control" placeholder="Alt For Product Image">
                    </div>
                    <label class="sell-price-msg"></label>
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
                    <label class="control-label" for="stonegroup_name">Information for Doctors</label>
                    <div class="controls">

                      <textarea class="form-control" rows="3" name="info_for_doctor" id="info_for_doctor" placeholder="Information for Doctor" data-validation="required" data-validation-error-msg="Please enter Information for Doctor"><?php echo @$product_list[0]->info_for_doctor; ?></textarea>

                    </div>
                  </div>

                </div>

                <div class="span4">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Product Description</label>
                    <div class="controls">

                      <textarea class="form-control" rows="3" name="product_description" id="product_description" placeholder="Description" data-validation="required" data-validation-error-msg="Please enter Description"><?php echo @$product_list[0]->product_description; ?></textarea>

                    </div>
                  </div>

                </div>

                <div class="span4">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Product Component</label>
                    <div class="controls">

                      <textarea class="form-control" rows="3" name="product_component" id="product_component" placeholder="Component" data-validation="required" data-validation-error-msg="Please enter Component"><?php echo @$product_list[0]->product_component; ?></textarea>

                    </div>
                  </div>

                </div>

                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Product Dose English Text</label>
                    <div class="controls">
                      <textarea class="form-control" rows="3" name="dose" id="dose" placeholder="Dose English Text" data-validation="required" data-validation-error-msg="Please enter dose"><?php echo @$product_list[0]->dose; ?></textarea>

                    </div>
                  </div>

                </div>

                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Product Dose Hindi Text</label>
                    <div class="controls">
                      <textarea class="form-control" rows="3" name="dose_hindi" id="dose_hindi" placeholder="Dose Hindi Text" data-validation="required" data-validation-error-msg="Please enter dose"><?php echo @$product_list[0]->dose_hindi; ?></textarea>

                    </div>
                  </div>

                </div>

                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Product Dose Bengali Text</label>
                    <div class="controls">
                      <textarea class="form-control" rows="3" name="dose_bengali" id="dose_bengali" placeholder="Dose Bengali Text" data-validation="required" data-validation-error-msg="Please enter dose"><?php echo @$product_list[0]->dose_bengali; ?></textarea>

                    </div>
                  </div>

                </div>

                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">English Indication Text</label>
                    <div class="controls">
                      <textarea class="form-control" rows="3" name="indication_english_text" id="indication_english_text" placeholder="English Indication Text" data-validation="required" data-validation-error-msg="Please enter English Indication Text"><?php echo @$product_list[0]->indication_english_text; ?></textarea>

                    </div>
                  </div>

                </div>

                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">English Indication Image</label>
                    <div class="controls">
                      <input type="file" data-validation="required" data-validation-error-msg="Please enter Image" class="form-control" id="indication_english_img" value="" name="indication_english_img">
                    </div>
                  </div>
                </div>

                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Alt For English Indication Image</label>
                    <div class="controls">
                      <input type="text" name="alt_for_english_indication_image" value="<?php echo isset($product_list[0]->alt_for_eng_indication_image) ? $product_list[0]->alt_for_eng_indication_image : ''; ?>" class="form-control" placeholder="Alt For English Indication Image">
                    </div>
                    <label class="sell-price-msg"></label>
                  </div>
                </div>

                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Hindi Indication Text</label>
                    <div class="controls">
                      <textarea class="form-control" rows="3" name="indication_hindi_text" id="indication_hindi_text" placeholder="Hindi Indication Text" data-validation="required" data-validation-error-msg="Please enter Hindi Indication Text"><?php echo @$product_list[0]->indication_hindi_text; ?></textarea>

                    </div>
                  </div>

                </div>

                <div class="span4">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Hindi Indication Image</label>
                    <div class="controls">

                      <input type="file" data-validation="required" data-validation-error-msg="Please enter Image" class="form-control" id="indication_hindi_img" value="" name="indication_hindi_img">



                    </div>
                  </div>

                </div>

                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Alt For Hindi Indication Image</label>
                    <div class="controls">
                      <input type="text" name="alt_for_hindi_indication_image" value="<?php echo isset($product_list[0]->alt_for_hindi_indication_image) ? $product_list[0]->alt_for_hindi_indication_image : ''; ?>" class="form-control" placeholder="Alt For Hindi Indication Image">
                    </div>
                    <label class="sell-price-msg"></label>
                  </div>
                </div>

                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Bengali Indication Text</label>
                    <div class="controls">
                      <textarea class="form-control" rows="3" name="indication_bengali_text" id="indication_bengali_text" placeholder="Bengali Indication Text" data-validation="required" data-validation-error-msg="Please enter Bengali Indication Text"><?php echo @$product_list[0]->indication_bengali_text; ?></textarea>

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

                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Alt For Bengali Indication Image</label>
                    <div class="controls">
                      <input type="text" name="alt_for_bengali_indication_image" value="<?php echo isset($product_list[0]->alt_for_ben_indication_image) ? $product_list[0]->alt_for_ben_indication_image : ''; ?>" class="form-control" placeholder="Alt For Bengali Indication Image">
                    </div>
                    <label class="sell-price-msg"></label>
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

                      <input type="text" data-validation="required" data-validation-error-msg="Please enter Price" class="form-control" id="meta_title" value="<?php echo @$product_list[0]->meta_title; ?>" name="meta_title" placeholder="Meta Title">

                    </div>
                  </div>
                </div>


                <div class="span4">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Meta Keyword</label>
                    <div class="controls">

                      <textarea class="form-control" rows="3" name="meta_keyword" id="meta_keyword" placeholder="Description" data-validation="required" data-validation-error-msg="Meta Keyword"><?php echo @$product_list[0]->meta_keyword; ?></textarea>



                    </div>
                  </div>

                </div>

                <div class="span4">

                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Meta Description</label>
                    <div class="controls">

                      <textarea class="form-control" rows="3" name="meta_description" id="meta_description" placeholder="Description" data-validation="required" data-validation-error-msg="Meta Description"><?php echo @$product_list[0]->meta_description; ?></textarea>



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

<script type="text/javascript">
  function select_product_option_fun() {

    var select_product_option = $('#select_product_option').val();
    var html = '';



    if (select_product_option == 'simple') {
      $('#show_attribute').html('');
      $('#show_variation').html('');
      $('#show_price').html('<div class="control-group"><label class="control-label" for="stonegroup_name">Product Price</label><div class="controls"><input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="product_price" value="" name="product_price" placeholder="Product Price"></div></div>');

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

    //  var product_batch_no=$("#product_batch_no").val();       
    // if (product_batch_no=="") 
    // {
    //     $('#product_batch_no').removeClass('black_border').addClass('red_border');
    // } 
    // else 
    // {
    //     $('#product_batch_no').removeClass('red_border').addClass('black_border');               
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



    // var product_image=$("#product_image").val();       
    // if (product_image=="") 
    // {
    //     $('#product_image').removeClass('black_border').addClass('red_border');
    // } 
    // else 
    // {
    //     $('#product_image').removeClass('red_border').addClass('black_border');               
    // }

    var product_component = $("#product_component").val();
    if (product_component == "") {
      $('#product_component').removeClass('black_border').addClass('red_border');
    } else {
      $('#product_component').removeClass('red_border').addClass('black_border');
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
<script>
  $('body').on('keyup', '.product-sell-price', function() {
    var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
    var product_sell_price = parseInt($('.product-sell-price').val());
    var product_regular_price = parseInt($('.product-regular-price').val());

    if (product_regular_price != '' && numberRegex.test(product_regular_price) && product_regular_price > 0 && product_sell_price != '' && numberRegex.test(product_sell_price) && product_sell_price > 0) {
      //console.log(product_regular_price +'<' +product_sell_price);
      if (product_sell_price > product_regular_price) {
        // console.log('Selling price cannot be greater than Regular price!');
        $('.sell-price-msg').html('Selling price cannot be greater than Regular price!');
        $('.sell-price-msg').css('color', 'red');
        $('.btn-submit').prop('disabled', true);
      } else {
        //console.log('all ok');
        $('.sell-price-msg').html('');
        $('.btn-submit').prop('disabled', false);
      }
    } else {
      //console.log('not ok');
      $('.sell-price-msg').html('Please enter valid Regular price!');
      $('.sell-price-msg').css('color', 'red');
      $('.product-sell-price').val('0');
      $('.btn-submit').prop('disabled', true);
    }
  });
</script>