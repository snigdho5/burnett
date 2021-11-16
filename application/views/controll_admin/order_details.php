<?php $this->load->view('controll_admin/common/header'); ?>
<?php $data['mainpage'] = 'order_details'; ?>
<?php $this->load->view('controll_admin/common/menu', $data); ?>

<!-- /#page-wrapper -->

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
            <?php echo $this->session->flashdata('succ_msg'); ?>
          </div>
        <?php }
        ?>

        <?php
        // print_obj($myorder);die;
        if (!empty($myorder)) {

        ?>


          <div class="span12 stone_details" id="general_details">
            <div class="widget ">
              <div class="widget-header "><a class="accordion-toggle" data-toggle="collapse" data-parent="#general_details" href="#general_details_area">&nbsp;</a> <i class="icon-leaf"></i>
                <h3>Edit-Order (<?= $myorder[0]->order_unique_id ?>)</h3>
                <div class="pull-right"></div>
              </div>
              <div class="widget-content panel-collapse collapse in" id="general_details_area">
                <form role="form" name="category_form" method="post" action="<?php echo base_url() . BaseAdminURl . '/'; ?>order/update" enctype="multipart/form-data" class="order-detail">
                  <input type="hidden" name="order_id" id="order_id" value="<?= $myorder[0]->order_id ?>" />
                  <input type="hidden" name="order_unique_id" value="<?= $myorder[0]->order_unique_id ?>" />
                  <div class="span4">
                    <div class="control-group">
                      <label class="control-label" for="stonegroup_name">Change Status</label>
                      <div class="controls">
                        <select class="form-control order-status" name="order_status" required>
                        <option value="" >Select</option>
                          <!--  <option value="0" <?= $myorder[0]->order_status == '0' || $myorder[0]->payment_status == '0' ? 'selected="selected"' : '' ?>>Failed</option> 
                          <option value="1" <?= $myorder[0]->order_status == '1' && $myorder[0]->payment_status == '1' ? 'selected="selected"' : '' ?>>Processing</option>-->

                          <option value="3" <?= $myorder[0]->order_status == '1' ? 'selected="selected"' : '' ?>>Processing</option>

                          <?php if ($myorder[0]->order_status != '2') { ?>
                            <option value="2" <?php echo $myorder[0]->order_status == '2' ? 'selected="selected"' : ''; ?>>Ship In Progress</option>
                          <?php } ?>

                          <option value="3" <?= $myorder[0]->order_status == '3' ? 'selected="selected"' : '' ?>>Delivered</option>
                          <!-- <option value="4" <?= $myorder[0]->order_status == '4' ? 'selected="selected"' : '' ?>>Completed</option> -->
                          <option value="4" <?= $myorder[0]->order_status == '4' ? 'selected="selected"' : '' ?>>Cancelled</option>

                        </select>

                      </div> <!-- /controls -->
                    </div>
                  </div>

                  <div class="span4 ML0">
                    <div class="control-group">

                      <button type="submit" class="btn btn-default">Update</button>

                    </div> <!-- /controls -->
                  </div>


                  <div class="span4 ship-status-div" style="display: none;">
                    <div class="control-group">
                      <label class="control-label">Status</label>
                      <p class="order-status-msg"></p>
                    </div>
                  </div>

                </form>
              </div>


            </div>
            <!-- /widget-header -->

            <!-- /widget-content -->

          </div>
          <!-- /widget -->

      </div>

      <div class="span12 stone_details" id="price_details">
        <div class="widget ">
          <div class="" id="cd-login">

            <small class="font-small"><b>Order Status - </b>
              <?php
              if ($myorder[0]->order_status == '1') {
                echo 'Processing';
              } else if ($myorder[0]->order_status == '2') {
                echo 'Ship In Progress';
              } else if ($myorder[0]->order_status == '3') {
                echo 'Delivered';
              } else if ($myorder[0]->order_status == '4') {
                echo 'Cancelled';
              }
              ?>
            </small><br>
            <small class="font-small"><b>Order Date - </b><?php echo date('M d,Y', strtotime($myorder[0]->date)); ?></small>
            <p style="height:20px;"></p>

            <?php
            if ($myorder[0]->order_status == '2') {
            ?>
              <input class="form-control awbno" name="awbno" placeholder="Enter AWB" />
              <button type="button" class="btn btn-default update-awbno">Update AWB</button>
              <p class="awb-msg" style="display: none;"></p>
            <?php
            }
            ?>

            <p style="height:20px;"></p>

            <table class="table cart_table">
              <thead>
                <tr>
                  <th>Product</th>
                  <th class="text-center">Price</th>
                  <th>Quantity</th>
                  <th class="text-center">Shipping</th>
                  <th class="text-center">Total</th>
                  <th> </th>
                </tr>
              </thead>
              <tbody>

                <?php $order_details = $this->myaccountmodel->get_order_modules_item($myorder[0]->order_id);
                // print_obj($order_details);die;
                if (!empty($order_details)) {

                  foreach ($order_details as $inner_dt) {

                    $product_details = $this->common_my_model->common($table_name = 'product', $field = array(), $where = array('product_id' => $inner_dt->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

                ?>
                    <tr>
                      <td class="col-sm-8 col-md-6">
                        <div class="media">
                          <a class="thumbnail pull-left" href="#"> <img style="height: 50px;width: 50px;" class="media-object" src="<?php echo base_url() . 'uploads/product/small/' . $product_details[0]->product_image; ?>" alt="" /> </a>
                          <div class="media-body">
                            <h4 class="media-heading"><?php echo $product_details[0]->product_title; ?></h4>
                            <h5 class="media-heading">Batch No.: <?php echo $product_details[0]->product_batch_no; ?></h5>
                            <p><?php echo character_limiter($product_details[0]->product_description, 40); ?></p>
                            <!--<span>Status: </span><span class="text-success"><strong>In Stock</strong></span>-->
                          </div>
                        </div>
                      </td>
                      <td class="col-sm-1 col-md-1 text-center"><i class="fas fa-<?php echo $myorder[0]->order_currency_sign; ?>-sign"></i> <?= $inner_dt->price ?></td>
                      <td class="col-sm-1 col-md-1" style="text-align: center"><?= $inner_dt->quantity ?></td>
                      <td class="col-sm-1 col-md-1" style="text-align: center"><?php echo $inner_dt->shipping_rate; ?></td>
                      <td class="col-sm-1 col-md-1 text-center"><i class="fas fa-<?php echo $myorder[0]->order_currency_sign; ?>-sign"></i> <?= $inner_dt->price * $inner_dt->quantity ?></td>

                    </tr>
                <?php
                  }
                }
                ?>
              </tbody>
            </table>

            <table class="order-tableee no-border" align="center" border="0" cellspacing="0" style="width: 100%; margin: 0px auto; font-size: 13px; border: 0px; margin-bottom: 30px;">
              <tbody>
                <tr>
                  <td height="10" colspan="3"></td>
                </tr>

                <?php if (@$myorder[0]->user_discount != 0) { ?>
                  <tr style="text-align: center;">
                    <td style="text-align: right" width="110">User Discount :</td>
                    <td width="350"></td>
                    <td style="text-align: left; padding-right: 20px;" width="70"><i style="color:#000;" class="fas fa-<?php echo $myorder[0]->order_currency_sign; ?>-sign"></i> <?php echo $myorder[0]->user_discount; ?></td>
                  </tr>

                <?php } ?>
                <?php if (@$myorder[0]->coupon_discount != "") { ?>

                  <tr style="text-align: center;">
                    <td style="text-align: right" width="110">Coupon Discount :</td>
                    <td width="350"></td>
                    <td style="text-align: left; padding-right: 20px;" width="70"><i style="color:#000;" class="fas fa-<?php echo $myorder[0]->order_currency_sign; ?>-sign"></i> <?php echo $myorder[0]->coupon_discount; ?></td>
                  </tr>

                <?php } ?>

                <tr style="text-align: center; font-weight: bold;">
                  <td style="text-align: right" width="110">Total Price :</td>
                  <td width="350"></td>
                  <td style="text-align: left; padding-right: 20px;" width="70"><i style="color:#000;" class="fas fa-<?php echo $myorder[0]->order_currency_sign; ?>-sign"></i> <?php echo number_format($myorder[0]->order_total_value, 2); ?></td>
                </tr>

                <?php if ($myorder[0]->pay_wallet_amount > 0) { ?>

                  <tr style="text-align: center;">
                    <td style="text-align: right" width="110">Wallet Pay :</td>
                    <td width="350"></td>
                    <td style="text-align: left; padding-right: 20px;" width="70"><i style="color:#000;" class="fas fa-<?php echo $myorder[0]->order_currency_sign; ?>-sign"></i> <?php echo number_format($myorder[0]->pay_wallet_amount, 2); ?></td>
                  </tr>

                  <tr style="text-align: center;">
                    <td style="text-align: right" width="110">Due Amount :</td>
                    <td width="350"></td>
                    <td style="text-align: left; padding-right: 20px;" width="70"><i style="color:#000;" class="fas fa-<?php echo $myorder[0]->order_currency_sign; ?>-sign"></i> <?php echo number_format(@$myorder[0]->order_total_value - @$myorder[0]->pay_wallet_amount, 2); ?></td>
                  </tr>

                <?php } ?>

                <tr>
                  <td height="10" colspan="3"></td>
                </tr>
              </tbody>
            </table>
            <?php

            $billing_details = $this->common_my_model->common($table_name = 'user_billing_address', $field = array(), $where = array('user_id' => $myorder[0]->user_id, 'default_billing' => '1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

            $shipping_details = $this->common_my_model->common($table_name = 'user_shipping_address', $field = array(), $where = array('id' => $myorder[0]->shipping_address_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

            ?>

            <div class="row shipment_details">
              <div class="col-sm-6 col-md-6 col-lg-6">
                <h6>Billing Address</h6>
                <div class="default-not-set-border">
                  <!--  <div class="address-middle">
                        <i class="fas fa-user"></i><?php echo $billing_details[0]->name; ?><br>
                        <i class="fas fa-envelope"></i><?php echo $billing_details[0]->email; ?><br>
                                                  <i class="fas fa-phone"></i><?php echo $billing_details[0]->phone; ?><br>
                                                  <i class="fas fa-map-marker"></i><?= $billing_details[0]->flat_house_floor_building ?>, <?= $billing_details[0]->city ?> - <?= $billing_details[0]->pincode ?><br><?= $billing_details[0]->state ?> ,<?= $billing_details[0]->country ?>
                                                 <br /> Locality : <?= $billing_details[0]->locality ?>
                                               </div> -->

                  <div class="address-middle">
                    <i class="fas fa-user"></i><?php echo $myorder[0]->billing_name; ?><br>
                    <i class="fas fa-envelope"></i><?php echo $myorder[0]->billing_email; ?><br>
                    <i class="fas fa-phone"></i><?php echo $myorder[0]->billing_phone; ?><br>
                    <i class="fas fa-map-marker"></i><?= $myorder[0]->billing_flat_house_floor_building ?>, <?= $myorder[0]->billing_city ?> - <?= $myorder[0]->billing_pincode ?><br><?= $myorder[0]->billing_state ?> ,<?= $myorder[0]->billing_country ?>
                    <br /> Locality : <?= $myorder[0]->billing_locality ?>
                  </div>

                </div>
              </div>

              <div class="col-sm-6 col-md-6 col-lg-6">
                <h6>Shipping Address</h6>
                <div class="default-not-set-border">
                  <div class="address-middle">
                    <i class="fas fa-user"></i><?php echo $shipping_details[0]->name; ?><br>
                    <i class="fas fa-phone"></i><?php echo $shipping_details[0]->phone; ?><br>
                    <i class="fas fa-map-marker"></i><?= $shipping_details[0]->flat_house_floor_building ?>, <?= $shipping_details[0]->city ?> - <?= $shipping_details[0]->pincode ?><br><?= $shipping_details[0]->state ?> ,<?= $shipping_details[0]->country ?>
                    <br /> LandMark : <?= $shipping_details[0]->landmark ?>
                    <br /> Locality : <?= $shipping_details[0]->locality ?>
                    <br /> Type : <?= $shipping_details[0]->address_type ?>
                  </div>

                </div>
              </div>
            </div>


          </div>


        </div>
        <!-- /widget -->

      </div>

      <!-- /widget -->

    <?php
        } else {
    ?>
      <h3>Order Not found!</h3>
    <?php
        }
    ?>

    </div> <!-- /row -->

  </div> <!-- /container -->

</div> <!-- /main-inner -->

</div>

<?php $this->load->view('controll_admin/common/footer'); ?>

<script>
  $('body').on('change', '.order-status', function() {
    var order_status = $('.order-status').val();
    //$('.ship-status-div').hide();
    //console.log(order_status);

    if (order_status != '' && order_status == '2') {

      //$('.ship-status-div').show();
      //$('.order-status-msg').html('loading..');

    } else {
      //console.log('not ok');
      //$('.ship-status-div').hide();

      // $('.sell-price-msg').html('Please enter valid Regular price!');
      // $('.sell-price-msg').css('color', 'red');
      // $('.product-sell-price').val('0');
      // $('.btn-submit').prop('disabled', true);
    }
  });

  $('body').on('click', '.update-awbno', function() {
    var awbno = $('.awbno').val();
    var order_id = $('#order_id').val();
    $('.awb-msg').hide();
    $('.awb-msg').html('');

    if (awbno != '') {
      $.ajax({
        type: "POST",
        dataType: 'html',
        url: "<?php echo base_url(); ?>controll_admin/order/update_awbno",
        data: {
          awbno: awbno,
          order_id: order_id
        },
        // async:false,

        success: function(data) {
          var data = $.parseJSON(data);
          if (data.status == 'success') {
            $('.awb-msg').show();
            $('.awb-msg').html(data.msg);
            $('.awb-msg').css('color', 'green');
          } else {
            $('.awb-msg').show();
            $('.awb-msg').html(data.msg);
            $('.awb-msg').css('color', 'red');
          }

        }
      });
    } else {
      $('.awb-msg').show();
      $('.awb-msg').html('Please enter AWB no to update!');
      $('.awb-msg').css('color', 'red');
    }



  });
</script>