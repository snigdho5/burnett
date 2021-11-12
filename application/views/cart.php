<?php $this->load->view('common/header');
$cart = $this->cart->contents();
//echo '<pre>'; print_r($cart); echo '</pre>'; 
?>
<div class="container-fluid pt-4 pb-4">
    <div class="container pt-4 pb-4">
        <?php
        $signup_success = $this->session->flashdata('cart_info');
        if ($signup_success != "") { ?>
            <div class="alert top-alert-success">
                <?php echo $signup_success; ?> </div>
        <?php }    ?>
        <h1>Cart</h1>
        <div class="row">

        </div>
        <?php if (empty($cart)) { ?>
            <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-12 no-cart">
                    <div class="bg-col row">
                        <h4 class=""><i class="fas fa-shopping-cart"></i> No item in your cart!</h4>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive cart-main">
                        <?php echo form_open('cart/update_cart', 'id="frmupdatecart"'); ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="8%" scope="col"> </th>
                                    <th scope="col" colspan="2">Product</th>
                                    <th scope="col" class="text-right">Price</th>
                                    <th scope="col" class="text-left">Quantity</th>
                                    <th scope="col" class="text-right">Total</th>
                                    <th scope="col" class="text-right">Shipping</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $curr_subtotal = 0;
                                $grand_total = 0;
                                $cgst_total = 0;
                                $sgst_total = 0;
                                $shipping_cost = 0;
                                $count_cart = 0;
                                foreach ($cart as $k => $item) :
                                    if ($this->product_model->is_product($item['id']) > 0) {
                                        $count_cart++;
                                        $product_details = $this->product_model->product_details_by_id($item['id']);
                                        echo form_hidden('cart[' . $item['rowid'] . '][id]', $item['id']);
                                        echo form_hidden('cart[' . $item['rowid'] . '][rowid]', $item['rowid']);
                                        echo form_hidden('cart[' . $item['rowid'] . '][name]', $item['name']);
                                        echo form_hidden('cart[' . $item['rowid'] . '][price]', $item['price']);
                                        echo form_hidden('cart[' . $item['rowid'] . '][qty]', $item['qty']);
                                        // print_obj($cart);
                                ?>
                                        <tr>
                                            <td class="product_cart_img"><img src="<?php echo base_url() . 'uploads/product/small/' . $product_details[0]->product_image; ?>" /> </td>
                                            <td colspan="2"><?php echo $product_details[0]->product_title; ?>
                                                <?php if (isset($item['size']) && $item['size'] != '') { ?>
                                                    <br /><strong>Size: <?php echo $item['size']; ?></strong>
                                                <?php } ?>
                                            </td>
                                            <td class="text-right"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($item['price'], 2); ?></td>
                                            <td class="product-count">
                                                <div class="display-flex">
                                                    <div class="qtyminus" id="qtyminus_<?php echo $item['rowid']; ?>">-</div>
                                                    <input type="text" name="cart[<?php echo $item['rowid'] ?>][qty]" value="<?php echo $item['qty']; ?>" class="qty" id="qty_<?php echo $item['rowid']; ?>">
                                                    <div class="qtyplus" id="qtyplus_<?php echo $item['rowid']; ?>">+</div>
                                                </div>
                                            </td>
                                            <td class="text-right"><i class="fa fa-inr" aria-hidden="true"></i>
                                                <?php
                                                $curr_subtotal = $item['price'] * $item['qty'];
                                                echo number_format($curr_subtotal, 2);
                                                $grand_total = $grand_total + $curr_subtotal;
                                                ?>
                                            </td>
                                            <td class="text-right">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="pincode">Check Availability</label>
                                                        <input type="hidden" id="cod-val-<?php echo $k; ?>" class="cod-val" name="cart[<?php echo $item['rowid'] ?>][cod_val]" value="0">
                                                        <input type="hidden" id="p-weight-<?php echo $k; ?>" class="p-weight weight-var" name="cart[<?php echo $item['rowid'] ?>][weight]" value="<?php echo ($product_details[0]->weight != '') ? $product_details[0]->weight : '0.3'; ?>">
                                                        <input type="hidden" id="shipping_rate<?php echo $k; ?>" name="cart[<?php echo $item['rowid'] ?>][shipping_rate]" class="form-control shipping_rate" placeholder="" value="<?php echo ($item['shipping_rate'] != '') ? $item['shipping_rate'] : ''; ?>">
                                                        <input type="text" id="user-pincode-<?php echo $k; ?>" name="cart[<?php echo $item['rowid'] ?>][user_pincode]" class="form-control user-pincode" placeholder="Enter Pincode.." value="">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <label for="pincode">Online</label>
                                                        <input type="radio" class="form-control is-cod" id="is-cod-<?php echo $k; ?>" name="is_cod_<?php echo $k; ?>" placeholder="Enter Pincode.." value="0" checked>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <label for="pincode">COD</label>
                                                        <input type="radio" class="form-control is-cod" id="is-cod-<?php echo $k; ?>" name="is_cod_<?php echo $k; ?>" placeholder="Enter Pincode.." value="1">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="pin"> </label>
                                                        <button type="button" class="round-black-btn btn-check-pincode" id="btn-check-pincode-<?php echo $k; ?>" data-id="<?php echo $k; ?>">Check</button>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for="pin"> </label>
                                                        <p class="pin-checker-msg<?php echo $k; ?>"></p>
                                                        <p class="couriers-msg<?php echo $k; ?>"></p>
                                                        <p class="delivery-company-p<?php echo $k; ?>" style="display: none;">
                                                            <select id="delivery_company_<?php echo $k; ?>" name="delivery_company<?php echo $k; ?>" class="form-control delivery-company" data-sid="<?php echo $k; ?>">

                                                            </select>
                                                        </p>
                                                    </div>
                                                </div>
                                                <i class="fa fa-inr" aria-hidden="true"></i>
                                                <?php
                                                $shiprate = 0;
                                                if ($item['shipping_rate'] == '') {
                                                    echo number_format($shiprate, 2);
                                                } else if ($item['shipping_rate'] != '') {
                                                    $shipping_cost += $item['shipping_rate'];
                                                    echo number_format($item['shipping_rate'], 2);
                                                }
                                                ?>

                                            </td>
                                            <td class="text-right"><a href="<?php echo base_url() ?>cart/remove/<?= $item['rowid'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                                        </tr>
                                <?php

                                    } else {
                                        $this->cart->remove($k);
                                    }
                                endforeach;
                                ?>

                                <input type="hidden" id="count-cart" name="count_cart" value="<?php echo $count_cart; ?>">
                                <input type="hidden" id="shipping-rate-comma" name="shipping_rate_comma" value="">

                                <tr>
                                    <td></td>
                                    <td colspan="2"></td>
                                    <td></td>
                                    <td></td>
                                    <td>Sub-Total</td>
                                    <td class="text-right"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($grand_total, 2); ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="2"></td>
                                    <td></td>
                                    <td></td>
                                    <td>Shipping</td>
                                    <td class="text-right ship-cost" data-shipcost="<?php echo number_format($shipping_cost, 2); ?>"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo number_format($shipping_cost, 2); ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="2"></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total</strong></td>
                                    <td class="text-right"><strong><i class="fa fa-inr" aria-hidden="true"></i>
                                            <?php

                                            $alltotal =  $grand_total + $shipping_cost + $sgst_total + $cgst_total;
                                            echo number_format($alltotal, 2);

                                            ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <?php echo form_close(); ?>
                        <p id="cart-msg" style="display: none;">cc</p>

                    </div>
                </div>

                <div class="col mb-2">
                    <div class="row">
                        <div class="col-sm-12  col-md-3">
                            &nbsp;
                        </div>
                        <div class="col-sm-12  col-md-3">
                            &nbsp;
                        </div>
                        <div class="col-sm-12  col-md-3">
                            &nbsp;
                        </div>
                        <div class="col-sm-12 col-md-3 text-right">
                            <button class="btn btn-lg btn-block round-black-btn text-uppercase" id="btnupdatecart">Update cart</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12  col-md-3">
                            <button class="btn btn-block btn-light round-black-btn">Continue Shopping</button>
                        </div>
                        <div class="col-sm-12  col-md-3">
                            &nbsp;
                        </div>
                        <div class="col-sm-12  col-md-3">
                            &nbsp;
                        </div>

                        <div class="col-sm-12 col-md-3 text-right">
                            <!--  <button class="btn btn-lg btn-block round-black-btn text-uppercase">Checkout</button> -->

                            <button class="btn btn-lg btn-block round-black-btn text-uppercase" onclick="go_to_checkout();">Checkout</button>




                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>


    </div>
</div>
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#btnupdatecart").on("click", function() {
            $("#cart-msg").hide();
            var shipcost = $('.ship-cost').attr('data-shipcost');
            var ship_comma = $('#shipping-rate-comma').val();
            var count_cart = $('#count-cart').val();
            var ship_comma_count = ship_comma.split(",").length - 1;
            // console.log(ship_comma_count);

            if (shipcost > 0) {
                $("#frmupdatecart").submit();
            } else if (count_cart == ship_comma_count) {
                $("#frmupdatecart").submit();
            } else {
                $("#cart-msg").show();
                $("#cart-msg").html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please select shipping to proceed!');
                $("#cart-msg").css("color", "red");
                $("#cart-msg").css("text-align", "right");
            }

        });
        <?php foreach ($cart as $k => $item) { ?>
            $("#qtyminus_<?php echo $item['rowid']; ?>").on("click", function() {
                var now = $("#qty_<?php echo $item['rowid']; ?>").val();
                if ($.isNumeric(now)) {
                    if (parseInt(now) - 1 > 0) {
                        now--;
                    }
                    $("#qty_<?php echo $item['rowid']; ?>").val(now);
                }
            })
            $("#qtyplus_<?php echo $item['rowid']; ?>").on("click", function() {
                var now = $("#qty_<?php echo $item['rowid']; ?>").val();
                if ($.isNumeric(now)) {
                    $("#qty_<?php echo $item['rowid']; ?>").val(parseInt(now) + 1);
                }
            });
        <?php } ?>
    });
</script>



<script type="text/javascript">
    function go_to_checkout() {
        window.location.href = "<?php echo base_url(); ?>checkout";
    }

    $('body').on('change', '.delivery-company', function() {
        var rate = $(this).find(':selected').attr('data-rate');
        var id = $(this).attr('data-sid');
        // console.log('rate'+rate + 'id'+id);
        $('#shipping_rate' + id).val(rate);

        var ship_comma = $('#shipping-rate-comma').val();
        // if (ship_comma != '') {
        $('#shipping-rate-comma').val(ship_comma + ',' + rate);
        // } else {
        //     $('#shipping-rate-comma').val(rate);
        // }

    });

    $('body').on('click', '.btn-check-pincode', function() {
        var id = $(this).attr('data-id');
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        var user_pincode = $('#user-pincode-' + id).val();
        var productid = $('.product-id' + id).val();
        var product_nm = $('.product-nm' + id).val();
        var cod_val = $('#cod-val-' + id).val();
        var weight = $('#p-weight-' + id).val();

        pinlen = user_pincode.length;

        // console.log(user_pincode);
        // console.log(productid);
        // console.log(product_nm);
        // console.log(cod_val);
        // console.log(weight);
        $('.pin-checker-msg' + id).hide();
        $('.couriers-msg' + id).hide();
        $('.delivery-company-p' + id).hide();
        $('.cart-btns' + id).hide();
        $('.btn-check-pincode' + id).prop('disabled', true);


        if (user_pincode != '' && numberRegex.test(user_pincode) && pinlen == 6 && productid != '' && product_nm != '' && cod_val != '') {

            if (weight != '') {
                $('.pin-checker-msg' + id).show();
                $('.btn-check-pincode' + id).prop('disabled', true);
                $('.pin-checker-msg' + id).html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>check-pincode',
                    data: {
                        user_pincode: user_pincode,
                        productid: productid,
                        product_nm: product_nm,
                        cod_val: cod_val,
                        weight: weight
                    },

                    success: function(resp) {

                        if (resp.success == "1") {

                            $('.pin-checker-msg' + id).html('<b style=""><i class="fa fa-check-circle" aria-hidden="true" style="color:green; font-size:20px;"></i>  ' + resp.message + '</b>');
                            $('.couriers-msg' + id).show();
                            $('.couriers-msg' + id).html('<b style=""><i class="fa fa-plane" aria-hidden="true" style="color:green; font-size:20px;"></i>  Available Couriers: ' + resp.couriers_count + '</b>');
                            $('.delivery-company-p' + id).show();
                            $('.cart-btns' + id).show();
                            $('#delivery_company_' + id).html(resp.courier_options);

                        } else if (resp.success == "0") {

                            $('.pin-checker-msg' + id).html('<b style=""><i class="fa fa-times-circle-o" aria-hidden="true" style="color:red; font-size:20px;"></i> ' + resp.message + '</b>');

                        } else {

                            //window.location.href=resp.redirect;
                        }

                    }
                });
                $('.btn-check-pincode' + id).prop('disabled', false);
            } else {
                $('.pin-checker-msg' + id).show();
                $('.pin-checker-msg' + id).html('<b style=""><i class="fa fa-times-circle-o" aria-hidden="true" style="color:red; font-size:20px;"></i> Product weight not found!</b>');
                $('.btn-check-pincode' + id).prop('disabled', false);
            }
        } else {
            $('.pin-checker-msg' + id).show();
            $('.pin-checker-msg' + id).html('<b style=""><i class="fa fa-times-circle-o" aria-hidden="true" style="color:red; font-size:20px;"></i> Please enter 6 digit Pincode!</b>');
            $('.btn-check-pincode' + id).prop('disabled', false);
        }


    });
</script>