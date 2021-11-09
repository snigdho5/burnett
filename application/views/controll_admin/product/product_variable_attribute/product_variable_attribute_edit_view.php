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
        <form class="" name="add_area" method="post" action="<?php echo base_url() . BaseAdminURl . '/'; ?>product_variable_attribute/edit_submit" id="pro_submit_form" enctype="multipart/form-data">


          <div class="span12 stone_details" id="general_details">
            <div class="widget ">
              <div class="widget-header "><a class="accordion-toggle" data-toggle="collapse" data-parent="#general_details" href="#general_details_area">&nbsp;</a> <i class="icon-leaf"></i>
                <h3><?= $page_title ?></h3>
                <div class="pull-right"></div>
              </div>
              <div class="widget-content panel-collapse collapse in" id="general_details_area">



                <div id="show_attribute" class="span4">

                  <div class="control-group"><label class="control-label" for="stonegroup_name">Attribute</label>
                    <div class="controls"> <select class="form-control" onchange="select_attribute_option_fun();" name="attribute_id" id="attribute_id">
                        <option value="">Select Attribute</option>


                        <?php


                        $products_attribute = $this->common_my_model->common($table_name = 'product_attribute', $field = array(), $where = array('status' => '1', 'variation' => 'o'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

                        foreach ($products_attribute as $key => $value) {
                        ?>

                          <option value="<?php echo $value->product_attribute_id; ?>" <?php if (@$value->product_attribute_id == @$edited_details[0]->attribute_id) {
                                                                                        echo 'selected';
                                                                                      }  ?>><?php echo $value->name; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>




                </div>


                <div id="show_variation" class="span4">



                  <?php $attribute_id = $edited_details[0]->attribute_id;





                  $products_variation = $this->common_my_model->common($table_name = 'product_attribute', $field = array(), $where = array('status' => '1', 'variation' => $attribute_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



                  ?>

                  <div class="control-group"><label class="control-label" for="stonegroup_name">Variation</label>
                    <div class="controls"> <select class="form-control" name="variation_id" id="variation_id">
                        <option value="">Select Variation</option>


                        <?php


                        // $products_attribute = $this->common_my_model->common($table_name ='product_attribute', $field = array(), $where = array('status'=>'1','variation'=>'o'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

                        foreach ($products_variation as $key => $value) {
                        ?>

                          <option value="<?php echo $value->product_attribute_id; ?>" <?php if (@$value->product_attribute_id == @$edited_details[0]->variation_id) {
                                                                                        echo 'selected';
                                                                                      } ?>><?php echo $value->name; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>





                </div>

                <div id="regular_price" class="span4">


                  <div class="control-group"><label class="control-label" for="stonegroup_name">Product Regular Price</label>
                    <div class="controls"><input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control product-regular-price" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="product_regular_price" value="<?php echo @$edited_details[0]->product_regular_price; ?>" name="product_regular_price" placeholder="Product Regular Price"></div>
                  </div>


                </div>


                <div class="span4">

                  <div class="control-group"><label class="control-label" for="stonegroup_name">Product Sell Price</label>
                    <div class="controls"><input type="text" data-validation="required" data-validation-error-msg="Please enter title" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control  product-sell-price" id="product_price" value="<?php echo @$edited_details[0]->product_price; ?>" name="product_price" placeholder="Product Sell Price"></div>
                    <label class="sell-price-msg"></label>
                  </div>

                </div>

                <div class="span4">

                  <div class="control-group"><label class="control-label" for="stonegroup_name">Product Weight (in Kg)</label>
                    <div class="controls"><input type="text" data-validation="required" data-validation-error-msg="Please enter Weight in Kg (e.g. 0.5 / 11)" class="form-control " id="product_weight" value="<?php echo @$edited_details[0]->weight; ?>" name="product_weight" placeholder="Product Weight"></div>
                    <label class="sell-price-msg"></label>
                  </div>

                </div>

                <div class="span4">

                  <div class="control-group"><label class="control-label" for="stonegroup_name">Product Length</label>
                    <div class="controls"><input type="text" data-validation="required" data-validation-error-msg="Please enter Length" class="form-control " id="product_length" value="<?php echo @$edited_details[0]->length; ?>"  name="product_length" placeholder="Product Length"></div>
                  </div>

                </div>

                <div class="span4">

                  <div class="control-group"><label class="control-label" for="stonegroup_name">Product Breadth</label>
                    <div class="controls"><input type="text" data-validation="required" data-validation-error-msg="Please enter Breadth" class="form-control " id="product_breadth" value="<?php echo @$edited_details[0]->breadth; ?>"  name="product_breadth" placeholder="Product Breadth"></div>
                  </div>

                </div>

                <div class="span4">

                  <div class="control-group"><label class="control-label" for="stonegroup_name">Product Height</label>
                    <div class="controls"><input type="text" data-validation="required" data-validation-error-msg="Please enter Height" class="form-control " id="product_height" value="<?php echo @$edited_details[0]->height; ?>"  name="product_height" placeholder="Product Height"></div>
                  </div>

                </div>


                <input type="hidden" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="hidden_product_id" value="<?php echo $this->uri->segment(5); ?>" name="hidden_product_id" placeholder="Product Price">

                <input type="hidden" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="hidden_variable_attribute_id" value="<?php echo $this->uri->segment(4); ?>" name="hidden_variable_attribute_id" placeholder="Product Price">






              </div>


            </div>


          </div>

          <!-- /widget -->

          <!--  <div class="span12 stone_details" id="price_details">
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
 -->



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


    if (select_product_option == 'variable') {

      var base_url = '<?php echo base_url(); ?>';

      $.ajax({
        type: "POST",
        dataType: 'html',
        url: base_url + "controll_admin/product/product_attribute_get",
        data: {},
        // async:false,

        success: function(data) {

          $('#show_attribute').html(data);
          $('#show_price').html('');


        }
      });

    } else if (select_product_option == 'simple') {
      $('#show_attribute').html('');
      $('#show_variation').html('');
      $('#show_price').html('<div class="control-group"><label class="control-label" for="stonegroup_name">Product Price</label><div class="controls"><input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="product_price" value="" name="product_price" placeholder="Product Price"></div></div>');

    } else {
      $('#show_attribute').html('');
      $('#show_variation').html('');
      $('#show_price').html('');

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
        url: base_url + "controll_admin/product_variable_attribute/product_variation_get",
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


    var attribute_id = $("#attribute_id").val();
    if (attribute_id == "") {
      $('#attribute_id').removeClass('black_border').addClass('red_border');
    } else {
      $('#attribute_id').removeClass('red_border').addClass('black_border');



      var variation_id = $("#variation_id").val();
      if (variation_id == "") {
        $('#variation_id').removeClass('black_border').addClass('red_border');
      } else {
        $('#variation_id').removeClass('red_border').addClass('black_border');
      }
    }


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