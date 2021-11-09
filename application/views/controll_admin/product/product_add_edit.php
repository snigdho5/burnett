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
        <form class="" name="add_area" id="add_area" method="post" action="<?php echo base_url() . BaseAdminURl . '/'; ?>product/add_edit/<?php echo $this->uri->segment(4); ?>" enctype="multipart/form-data">


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

                      <select class="form-control" name="select_product_option" id="select_product_option">
                        <option value="">Select Product Option</option>
                        <option value="sample">Sample Product</option>
                        <option value="variable">Variable Product</option>
                      </select>

                      <!--  <input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="product_title_eng" value="" name="product_title_eng" placeholder="Title"> -->

                      <br />
                      <textarea class="form-control" rows="3" name="product_des_eng" placeholder="Description" data-validation="required" data-validation-error-msg="Please enter description"></textarea>

                    </div>
                  </div>
                </div>

                <div class="span4 ML0">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Hindi</label>
                    <div class="controls">

                      <input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="product_title_hin" value="" name="product_title_hin" placeholder="Title">

                      <br />
                      <textarea class="form-control" rows="3" name="product_des_hin" placeholder="Description" data-validation="required" data-validation-error-msg="Please enter description"></textarea>

                    </div>
                  </div>
                </div>


                <div class="span4 ML0">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Bengali</label>
                    <div class="controls">

                      <input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="product_title_ben" value="" name="product_title_ben" placeholder="Title">

                      <br />
                      <textarea class="form-control" rows="3" name="product_des_ben" placeholder="Description" data-validation="required" data-validation-error-msg="Please enter description"></textarea>

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
                <h3>Price / Unit</h3>
                <div class="pull-right"></div>
              </div>
              <div class="widget-content panel-collapse collapse in" id="price_details_area">

                <div class="span4">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">INR</label>
                    <div class="controls">

                      <input type="text" data-validation="required" data-validation-error-msg="Please enter Price" class="form-control" id="product_price_inr" value="" name="product_price_inr" placeholder="Title">

                    </div>
                  </div>
                </div>

                <div class="span4 ML0">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">USD</label>
                    <div class="controls">

                      <input type="text" data-validation="required" data-validation-error-msg="Please enter Price" class="form-control" id="product_price_usd" value="" name="product_price_usd" placeholder="Title">

                    </div>
                  </div>
                </div>


                <div class="span4 ML0">
                  <div class="control-group">
                    <label class="control-label" for="stonegroup_name">Unit (Kg/Pc) </label>

                    <div class="controls">

                      1 <input type="text" data-validation="required" data-validation-error-msg="Please enter Unit (Kg/Pc)" class="form-control" id="product_unit" value="" name="product_unit" placeholder="Please enter Unit (Kg/Pc)">

                    </div> <!-- /controls -->
                  </div>
                </div>

              </div>


            </div>


          </div>

          <!-- /controls -->

          <div class="span12 stone_details" id="image_details">

            <div class="widget ">

              <div class="widget-header ">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#image_details" href="#image_details_area">&nbsp;</a>
                <i class="icon-leaf"></i>
                <h3>Image</h3>

              </div>

              <div class="widget-content panel-collapse collapse in" id="image_details_area">

                <div class="span4">
                  <div class="control-group">

                    <div class="controls">
                      <input type="file" class="span4" id="main_image" name="main_image[]">

                      <img src="<?php echo base_url() . 'uploads/' . $product_details[0]->product_image; ?>" title="" alt="category image" style="height:100px; width:100px;" />

                    </div>
                    <br />
                    <label class="control-label" for="stonegroup_name">Batch No</label>
                    <div class="controls">

                      <input type="text" data-validation="required" data-validation-error-msg="Please enter batch no" class="form-control" id="product_batch_no" value="" name="product_batch_no" placeholder="batch No">
                    </div>

                    <br />
                    <label class="control-label" for="stonegroup_name">Unique Name</label>
                    <div class="controls">

                      <input type="text" class="form-control" id="unique_key" value="" name="unique_key" placeholder="Please enter unique_key or leave">
                    </div>
                  </div>


                </div>

                <div class="span4 ML0">
                  <div class="control-group">



                    <label class="control-label" for="stonegroup_name">Quantity Info</label>
                    <div class="controls">
                      <input type="text" data-validation="required" data-validation-error-msg="Please enter Quantity" class="form-control" id="product_quantity_info" value="" name="product_quantity_info" placeholder="Quantity  Info">
                    </div><br />

                    <label class="control-label" for="stonegroup_name">Stock</label>
                    <div class="controls">
                      <input type="text" data-validation="required" data-validation-error-msg="Please enter stock" class="form-control" id="stock_count" value="" name="stock_count" placeholder="Count of stock">
                    </div>
                  </div>
                </div>

                <div class="span4 ML0">
                  <div class="control-group">

                    <label class="control-label" for="stonegroup_name">Category</label>
                    <div class="controls">
                      <select class="form-control" name="category_id">








                        <optgroup label="">

                          <option value=""></option>



                          <option value=""></option>


                        </optgroup>





                      </select>

                    </div>

                    <br />
                    <label class="control-label" for="stonegroup_name">GST Slab</label>
                    <div class="controls">
                      <select class="form-control" name="gst_id">



                        <option value=""></option>



                      </select>

                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>
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



                  <button type="submit" class="btn btn-default">Submit</button>
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
<script src="//cdn.ckeditor.com/4.9.1/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('cms_details');
  CKEDITOR.config.allowedContent = true;



  function add_link() {

    var link_count = $('#link_count').val();
    var link_count_new = parseInt(link_count) + 1;
    $('#link_count').val(link_count_new);
    $('#button_remove_link').remove();

    var msg = '<tr id="link_area_row_' + link_count_new + '"><td id="link_remove_area_' + link_count_new + '"><h3 id="button_remove_link"><a onClick="remove_link()"><i class="icon-minus-sign"></i></a></h3></td><td><input type="text"  id="link_title_' + link_count_new + '" name="link_title_' + link_count_new + '" value=""></td><td><input type="text"  id="link_subtitle_' + link_count_new + '" name="link_subtitle_' + link_count_new + '"></td><td><input type="text" style="" id="link_link_' + link_count_new + '" name="link_link_' + link_count_new + '"></td></tr> ';
    if (link_count == 0) {
      //''
      //$('#button_add_stone').after('');
      $('#link_area').html(msg);
      //$('#stone_area_row_0').after(msg);

    } else {

      $('#link_area_row_' + link_count).after(msg);
    }



    //$('#link_itemname_'+link_count_new).val($("#item_GUID option:selected").text());
  }

  function remove_link() {
    var link_count = $('#link_count').val();
    var link_count_new = parseInt(link_count) - 1;
    $('#link_count').val(link_count_new);
    $('#link_area_row_top_' + link_count).remove();
    $('#link_area_row_' + link_count).remove();

    if (link_count_new != 0) {
      $('#link_remove_area_' + link_count_new).html('<h3 id="button_remove_link"><a onClick="remove_link()"><i class="icon-minus-sign"></i></a></h3>');

    }
  }


  function delete_link(id) {
    $.ajax({
      url: "<?php echo base_url() ?>controll_admin/product/ajax_change",
      async: false,
      type: "POST",
      data: "action=delete_link&id=" + id,
      dataType: "html",
      success: function(data) {
        //  alert(data);
        $('#already_link_' + id).remove();
        $('#already_link_edit_' + id).remove();
      }
    });
  }

  function edit_link(id) {
    $('#already_link_edit_' + id).css('display', 'table-row');
    $('#already_link_' + id).css('display', 'none');

  }

  function unedit_link(id) {
    $('#already_link_edit_' + id).css('display', 'none');
    $('#already_link_' + id).css('display', 'table-row');
  }

  function update_link(id) {

    $.ajax({
      url: "<?php echo base_url() ?>controll_admin/product/ajax_change",
      async: false,
      type: "POST",
      data: "action=modify_link&id=" + id + "&already_link_title=" + $('#already_link_title_' + id).val() + "&already_link_subtitle=" + $('#already_link_subtitle_' + id).val() + "&already_link_href=" + $('#already_link_href_' + id).val(),
      dataType: "html",
      success: function(data) {
        // alert(data);
        location.reload();

      }
    });
  }
</script>