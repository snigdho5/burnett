<!-- Body -->
<?php //echo '<pre>'; print_r($product_details); echo '</pre>';
?>
<div class="container-fluid">
    <div class="container pt-5 pb-5">
        <?php
        $signup_success = $this->session->flashdata('cart_info');
        if ($signup_success != "") { ?>
            <div class="alert top-alert-success">
                <?php echo $signup_success; ?> </div>
        <?php }    ?>
        <div class="row">
            <div class="col-md-5">
                <div id="slider" class="owl-carousel product-slider">

                    <?php foreach ($product_details_image as $key => $row_image) {

                        $product_info = $this->db->where('product_id', $row_image->product_id)->get('product')->result();

                    ?>


                        <?php if ($key == '0') { ?>
                            <div class="item imagebig1">
                                <img data-toggle="magnify" src="<?php echo base_url(); ?>uploads/product/small/<?php echo $row_image->product_image; ?>" alt="<?php echo isset($product_info[0]->alt_for_product_image) ? $product_info[0]->alt_for_product_image : ''; ?>" />
                            </div>
                        <?php } else { ?>
                            <div class="item imagebig1">
                                <img src="<?php echo base_url(); ?>uploads/product/small/<?php echo $row_image->product_image; ?>" alt="<?php echo isset($product_info[0]->alt_for_product_image) ? $product_info[0]->alt_for_product_image : ''; ?>" />
                            </div>
                        <?php } ?>

                    <?php } ?>


                    <!-- <div class="item imagebig1">
                            <img src="images/Ashoka-Tonic01.jpg" />
                        </div>
                        <div class="item imagebig1">
                            <img src="images/Ashoka-Tonic01.jpg" />
                        </div>
                        <div class="item imagebig1">
                            <img src="images/Ashoka-Tonic01.jpg" />
                        </div>
                        <div class="item imagebig1">
                            <img src="images/Ashoka-Tonic01.jpg" />
                        </div>
                        <div class="item imagebig1">
                            <img src="images/Ashoka-Tonic01.jpg" />
                        </div>
                        <div class="item imagebig1">
                            <img src="images/Ashoka-Tonic01.jpg" />
                        </div> -->


                </div>
                <div id="thumb" class="owl-carousel product-thumb">

                    <?php foreach ($product_details_image as $key => $row_image) {
                        $product_info = $this->db->where('product_id', $row_image->product_id)->get('product')->result();
                    ?>
                        <div class="item">
                            <img src="<?php echo base_url(); ?>uploads/product/small/<?php echo $row_image->product_image; ?>" alt="<?php echo isset($product_info[0]->alt_for_product_image) ? $product_info[0]->alt_for_product_image : ''; ?>" />
                        </div>
                    <?php } ?>


                    <!--  <div class="item">
                            <img src="images/Ashoka-Tonic01.jpg" />
                        </div>
                        <div class="item">
                            <img src="images/Ashoka-Tonic01.jpg" />
                        </div>
                        <div class="item">
                            <img src="images/Ashoka-Tonic01.jpg" />
                        </div>
                        <div class="item">
                            <img src="images/Ashoka-Tonic01.jpg" />
                        </div>
                        <div class="item">
                            <img src="images/Ashoka-Tonic01.jpg" />
                        </div>
                        <div class="item">
                            <img src="images/Ashoka-Tonic01.jpg" />
                        </div>
                        <div class="item">
                            <img src="images/Ashoka-Tonic01.jpg" />
                        </div> -->


                </div>
            </div>
            <div class="col-md-7">
                <?php if ($product_details[0]->product_type == 'simple') {
                    //print_obj($product_details);die;
                ?>
                    <div class="product-dtl">
                        <div class="product-info">
                            <div class="product-name"><?php echo @$product_details[0]->product_title; ?></div>
                            <!--<div class="reviews-counter">
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" checked />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" checked />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" checked />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="text">1 star</label>
                                  </div>
                                <span>3 Reviews</span>
                            </div>-->

                            <?php
                            if ($product_details[0]->product_type == 'simple') {
                                $discouont = ((($product_details[0]->product_regular_price - $product_details[0]->product_price) * 100) / $product_details[0]->product_regular_price);
                            } else {

                                $product_variable_attribute =  $this->common_my_model->common($table_name = 'product_variable_attribute', $field = array(), $where = array('product_id' => @$product_details[0]->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                                $product_variable_attribute_last =  $this->common_my_model->common($table_name = 'product_variable_attribute', $field = array(), $where = array('product_id' => @$product_details[0]->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array('variable_attribute_id' => 'desc'), $start = '', $end = '');

                                $discouont = ((($product_variable_attribute[0]->product_regular_price - $product_variable_attribute[0]->product_price) * 100) / $product_variable_attribute[0]->product_regular_price);
                            }

                            // print_obj($product_details);die;

                            // echo $discouont;
                            ?>


                            <div class="product-price-discount"><span><?php if ($product_details[0]->product_type == 'simple') {
                                                                            echo '<i class="fa fa-inr" aria-hidden="true"></i>' . $product_details[0]->product_price;
                                                                        } else {
                                                                            echo '<i class="fa fa-inr" aria-hidden="true"></i>' . $product_variable_attribute[0]->product_price . ' - <i class="fa fa-inr" aria-hidden="true"></i>' . $product_variable_attribute_last[0]->product_price;
                                                                        } ?></span><span class="line-through"></span></div>
                        </div>
                        <p><?php echo @$brand_details[0]->name; ?></p>

                        <?php /*<div class="row">


                            <div class="col-md-6">
                                <?php if ($product_details[0]->product_type == 'variable') { ?> <label for="size">Size</label>
                                    <select id="size" name="size" onchange="change_size();" class="form-control">
                                        <?php

                                        foreach ($control_product_variable_attribute as $row) {
                                            $product_attribute = $this->common_my_model->common($table_name = 'product_attribute', $field = array(), $where = array('product_attribute_id' => @$row->variation_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                                        ?>
                                            <option value="<?php echo @$row->variable_attribute_id; ?>"><?php echo @$product_attribute[0]->name; ?></option>
                                        <?php } ?>

                                    </select> <?php } ?>
                            </div>




                            <div class="col-md-6">
                                &nbsp;
                            </div>
                            <div class="col-md-6">
                                <div class="product-price-discount" id="show_size_price"><span><?php if ($product_details[0]->product_type == 'simple') {
                                                                                                    echo '<i class="fa fa-inr" aria-hidden="true"></i>' . $product_details[0]->product_price;
                                                                                                } else {
                                                                                                    echo '<i class="fa fa-inr" aria-hidden="true"></i>' . $product_variable_attribute[0]->product_price;
                                                                                                } ?></span></div>
                            </div>
                        </div> */ ?>

                        <!-- Pincode checker // -snigdho -->
                        <div class="row">
                            <div class="col-md-3">
                                <label for="pincode">Check Availability</label>
                                <input type="hidden" class="cod-val" name="cod_val" value="0">
                                <input type="hidden" class="p-weight" name="weight" value="<?php echo @$product_details[0]->weight; ?>">
                                <input type="text" class="form-control user-pincode" placeholder="Enter Pincode.." value="">
                            </div>
                            <div class="col-md-1">
                                <label for="pincode">Online</label>
                                <input type="radio" class="form-control is-cod" name="is_cod" placeholder="Enter Pincode.." value="0" checked>
                            </div>
                            <div class="col-md-1">
                                <label for="pincode">COD</label>
                                <input type="radio" class="form-control is-cod" name="is_cod" placeholder="Enter Pincode.." value="1">
                            </div>
                            <div class="col-md-2">
                                <label for="pin"> </label>
                                <button class="round-black-btn btn-check-pincode">Check</button>
                            </div>
                            <div class="col-md-5">
                                <label for="pin"> </label>
                                <p class="pin-checker-msg"></p>
                                <p class="couriers-msg"></p>
                                <p class="delivery-company-p" style="display: none;">
                                    <select id="delivery_company" name="delivery_company" class="form-control delivery-company">

                                    </select>
                                </p>
                            </div>
                        </div>

                        <!-- Pincode checker ends// -snigdho -->

                        <div class="product-count">
                            <label for="size">Quantity</label>
                            <form action="<?php echo base_url() ?>cart/add" class="display-flex" id="frmaddtocart" method="post">
                                <div class="qtyminus">-</div>
                                <input type="text" name="quantity" value="1" class="qty">
                                <div class="qtyplus">+</div>
                                <input type="hidden" class="product-id" name="id" value="<?php echo $product_details[0]->product_id; ?>">
                                <input type="hidden" class="product-nm" name="name" value="<?php echo $product_details[0]->product_title; ?>">
                                <input type="hidden" name="unique_key" value="<?php echo $product_details[0]->unique_key; ?>">
                                <input type="hidden" name="category_id" value="<?php echo $product_details[0]->category_id; ?>">
                                <input type="hidden" name="ddlsize" id="ddlsize" value="">
                                <input type="hidden" name="variable_attribute_id" id="variable_attribute_id" value="">
                            </form>


                            <div class="cart-btns" style="display: none;">
                                <a href="javascript:void(0);" class="round-black-btn" id="btnaddtocart" onClick="submitDetailsForm()">Add to Cart</a>
                                <!--<input type="submit" class="round-black-btn" value="Add to Cart" />-->

                                <a href="#" onclick="wishlist('<?php echo $this->uri->segment(2); ?>');" class="round-black-btn">Add to Wishlist</a>

                                <a href="#" class="round-black-btn" data-toggle="modal" data-target="#myModal1">Add Enquiry
                                    <div></div>
                                </a>
                            </div>



                        </div>
                    </div>
                <?php } ?>
                <?php if ($product_details[0]->product_type == 'variable') {
                    $product_variable_attribute =  $this->common_my_model->common($table_name = 'product_variable_attribute', $field = array(), $where = array('product_id' => @$product_details[0]->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                ?>
                    <div class="product-dtl">
                        <div class="product-info">
                            <div class="product-name"><?php echo @$product_details[0]->product_title; ?></div>
                        </div>
                        <p><?php echo @$brand_details[0]->name; ?></p>
                        <div class="product_attributes">
                            <div class="product-list-inner2">
                                <form action="<?php echo base_url() ?>cart/add" class="display-flex" id="frmvercart" method="post">
                                    <ul>

                                        <li class="li_heading" id="package_heading" style="height:48px;">

                                            <ul>
                                                <li class="checkbox-detail">
                                                </li>
                                                <li class="packaging-detail">Net Quantity</li>

                                                <li class="size-detail">Package Name</li>
                                                <li class="listprice-detail">MRP Rs. <span style="font-size: 10px;"><br>
                                                        (Inc. of all taxes)</span></li>
                                                <li class="saleprice-detail">Sales Price</li>
                                                <li class="qty-detail">Qty</li>
                                                <li class="total-detail">Total Price</li>
                                            </ul>

                                        </li>
                                        <div class="clear"></div>

                                        <?php
                                        //echo '<pre>'; print_r($product_variable_attribute);echo '</pre>'; die;
                                        foreach ($product_variable_attribute as $pv) {
                                            $product_att_val =  $this->common_my_model->common($table_name = 'product_attribute', $field = array(), $where = array('product_attribute_id' => @$pv->variation_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                                            //echo 'ff<pre>'; print_r($product_att_val);echo '</pre>';
                                        ?>
                                            <li>
                                                <ul>
                                                    <li class="checkbox-detail">
                                                        <input type="checkbox" value="<?php echo $pv->variable_attribute_id; ?>" class="product-checkbox" data-weight="<?php echo ($product_att_val[0]->weight != '') ? $product_att_val[0]->weight : '0'; ?>" id="check_<?php echo $pv->variable_attribute_id; ?>" name="chkpack[]"><input type="hidden" name="txtsize_<?php echo $pv->variable_attribute_id; ?>" value="<?php echo $product_att_val[0]->name; ?>" />
                                                    </li>
                                                    <li class="packaging-detail"><?php echo $product_att_val[0]->name; ?></li>
                                                    <li class="size-detail">
                                                        <div class="screen-resize" style="display:none">Package Size</div><?php echo @$product_details[0]->product_title; ?>
                                                    </li>
                                                    <li class="listprice-detail">
                                                        <div class="screen-resize" style="display:none">List Price</div>Rs. <?php echo $pv->product_price; ?>
                                                    </li>
                                                    <li class="saleprice-detail">
                                                        <div class="screen-resize" style="display:none">Sale Price</div>
                                                        <div itemprop="offers" itemscope="" itemtype="">
                                                            <span itemprop="priceCurrency" content="INR"></span>
                                                            <link itemprop="availability" href="">
                                                            <meta itemprop="priceValidUntil" content="2021-05-10">
                                                            <meta itemprop="url" content="#">
                                                            <span itemprop="price" content="125">Rs. <?php echo $pv->product_price; ?></span>
                                                        </div>
                                                    </li>
                                                    <li class="qty-detail">
                                                        <div class="screen-resize" style="display:none">Qty</div><input type="text" name="txtqty_<?php echo $pv->variable_attribute_id; ?>" value="1" maxlength="3" onblur="calculatePrice(<?php echo $pv->variable_attribute_id; ?>,<?php echo $pv->product_price; ?>,this.value)" id="txtqty_<?php echo $pv->variable_attribute_id; ?>">
                                                    </li>
                                                    <li class="total-detail">
                                                        <div class="screen-resize" style="display:none">Total Price</div> Rs. <span id="attrTotal_<?php echo $pv->variable_attribute_id; ?>"><?php echo $pv->product_price; ?></span>
                                                    </li>
                                                    <div class="clear"></div>
                                                </ul>
                                            </li>
                                        <?php } ?>

                                    </ul>
                                    <input type="hidden" name="view_type" value="detail_view" />
                                    <input type="hidden" name="hiddprotype" value="variable_product" />
                                    <input type="hidden" class="product-id" name="id" value="<?php echo $product_details[0]->product_id; ?>" />
                                    <input type="hidden" class="product-nm" name="name" value="<?php echo $product_details[0]->product_title; ?>">
                                </form>
                            </div>
                            <br clear="all">


                            <!-- Pincode checker // -snigdho -->
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="pincode">Check Availability</label>
                                    <input type="hidden" class="cod-val" name="cod_val" value="0">
                                    <input type="hidden" class="p-weight weight-var" name="weight" value="0">
                                    <input type="text" class="form-control user-pincode" placeholder="Enter Pincode.." value="">
                                </div>
                                <div class="col-md-1">
                                    <label for="pincode">Online</label>
                                    <input type="radio" class="form-control is-cod" name="is_cod" placeholder="Enter Pincode.." value="0" checked>
                                </div>
                                <div class="col-md-1">
                                    <label for="pincode">COD</label>
                                    <input type="radio" class="form-control is-cod" name="is_cod" placeholder="Enter Pincode.." value="1">
                                </div>
                                <div class="col-md-2">
                                    <label for="pin"> </label>
                                    <button class="round-black-btn btn-check-pincode">Check</button>
                                </div>
                                <div class="col-md-5">
                                    <label for="pin"> </label>
                                    <p class="pin-checker-msg"></p>
                                    <p class="couriers-msg"></p>
                                    <p class="delivery-company-p" style="display: none;">
                                        <select id="delivery_company" name="delivery_company" class="form-control delivery-company">

                                        </select>
                                    </p>
                                </div>
                            </div>

                            <!-- Pincode checker ends// -snigdho -->


                            <p class="add_to_cart_multicart"><a href="javascript:void(0);" class="round-black-btn" id="btnaddtocart" onclick="submitCartForm()">Add to Cart</a></p>
                            <div class="continue_addtowishlist_block">
                                <p class="buttons_bottom_block">
                                    <a href="#" id="wishlist_button" onclick="WishlistCart('wishlist_block_list', 'add', '3945', $('#idCombination').val(), document.getElementById('quantity_wanted').value); return false;" title="Add to my wishlist">Add to wishlist</a>
                                </p>

                                <p class="continue-shopping"><a href="#">Continue Shopping</a></p>

                            </div>


                            <div class="cont_stock">
                                <span class="instock diw_headig">Shipping Details</span>
                                <span class="deliveryinfo">Dispatched within 7 working days subject to the availability.</span>
                            </div>
                        </div>

                    </div>
                <?php } ?>
            </div>
        </div>
        <small><?php
                $succ_message = $this->session->flashdata('succ');
                if ($succ_message) {
                ?>
                <br><span style="color:green;font-size:20px">
                    <?php echo $succ_message; ?>
                </span>
            <?php
                }
            ?></small>

        <small><?php
                $err_message = $this->session->flashdata('exist');
                if ($err_message) {
                ?>
                <br><span style="color:red;font-size:20px">
                    <?php echo $err_message; ?>
                </span>
            <?php
                }
            ?></small>

        <div class="product-info-tabs">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="component-tab" data-toggle="tab" href="#component" role="tab" aria-controls="component" aria-selected="true">Component</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="additional-information-tab" data-toggle="tab" href="#additional-information" role="tab" aria-controls="review" aria-selected="false">Indication</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="dose-tab" data-toggle="tab" href="#dose" role="tab" aria-controls="review" aria-selected="false">Dose</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews (<?php echo count($product_review_count); ?>)</a>
                </li>

                <?php
                if ($product_details[0]->product_description != '') {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="false">Description</a>
                    </li>
                <?php
                }
                ?>

                <?php
                if ($product_details[0]->info_for_doctor != '') {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" id="info-for-doc-tab" data-toggle="tab" href="#info-for-doc" role="tab" aria-controls="review" aria-selected="false">Information for Doctors</a>
                    </li>
                <?php
                }
                ?>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="component" role="tabpanel" aria-labelledby="component-tab">
                    <?php echo $product_details[0]->product_component; ?>
                </div>
                <div class="tab-pane fade" id="additional-information" role="tabpanel" aria-labelledby="additional-information">

                    <div class="rt-container">
                        <div class="col-rt-12">
                            <div class="Scriptcontent">
                                <div class="tabs">
                                    <div class="tab">
                                        <input type="radio" id="rd1" name="rd">
                                        <label class="tab-label" for="rd1">English</label>
                                        <div class="tab-content"> <?php echo $product_details[0]->indication_english_text; ?><br>
                                            <!-- Trigger the Modal -->
                                            <?php
                                            if ($product_details[0]->indication_english_img != '') {
                                            ?>
                                                <img id="myImg" src="<?php echo base_url() . 'uploads/product/' . $product_details[0]->indication_english_img; ?>" alt="<?php echo isset($product_details[0]->alt_for_eng_indication_image) ? $product_details[0]->alt_for_eng_indication_image : ''; ?>" style="width:100%;max-width:300px; margin:20px auto; display:block;">
                                            <?php
                                            }
                                            ?>


                                            <!-- The Modal -->
                                            <div id="myModal" class="modal">

                                                <!-- The Close Button -->
                                                <span class="close">&times;</span>

                                                <!-- Modal Content (The Image) -->
                                                <img class="modal-content" id="img01">

                                                <!-- Modal Caption (Image Text) -->
                                                <!--<div id="caption"></div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        <input type="radio" id="rd2" name="rd">
                                        <label class="tab-label" for="rd2">Hindi</label>
                                        <div class="tab-content"> <?php echo $product_details[0]->indication_hindi_text; ?> </br>
                                            <?php
                                            if ($product_details[0]->indication_hindi_img != '') {
                                            ?>
                                                <img id="myImg-hin" src="<?php echo base_url() . 'uploads/product/' . $product_details[0]->indication_hindi_img; ?>" alt="<?php echo isset($product_details[0]->alt_for_hindi_indication_image) ? $product_details[0]->alt_for_hindi_indication_image : ''; ?>" style="width:100%;max-width:300px; margin:20px auto; display:block;">
                                            <?php
                                            }
                                            ?>
                                            <!-- The Modal -->
                                            <div id="myModal-hin" class="modal">

                                                <!-- The Close Button -->
                                                <span class="close-hin">&times;</span>

                                                <!-- Modal Content (The Image) -->
                                                <img class="modal-content" id="img01-hin">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        <input type="radio" id="rd3" name="rd">
                                        <label class="tab-label" for="rd3">Bengali</label>
                                        <div class="tab-content"> <?php echo $product_details[0]->indication_bengali_text; ?></br>
                                            <?php
                                            if ($product_details[0]->indication_bengali_img != '') {
                                            ?>
                                                <img id="myImg-ben" src="<?php echo base_url() . 'uploads/product/' . $product_details[0]->indication_bengali_img; ?>" alt="<?php echo isset($product_details[0]->alt_for_ben_indication_image) ? $product_details[0]->alt_for_ben_indication_image : ''; ?>" style="width:100%;max-width:300px; margin:20px auto; display:block;">
                                            <?php
                                            }
                                            ?>

                                            <!-- The Modal -->
                                            <div id="myModal-ben" class="modal">

                                                <!-- The Close Button -->
                                                <span class="close-ben">&times;</span>

                                                <!-- Modal Content (The Image) -->
                                                <img class="modal-content" id="img01-ben">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END ACCORDION -->


                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="tab-pane fade" id="dose" role="tabpanel" aria-labelledby="dose">
                    <?php //echo $product_details[0]->dose; 
                    ?>
                    <div class="rt-container-new">
                        <div class="col-rt-12">
                            <div class="Scriptcontent">
                                <div class="tabs">
                                    <div class="tab">
                                        <input type="radio" id="rd4" name="rd">
                                        <label class="tab-label" for="rd4">English</label>
                                        <div class="tab-content"> <?php echo $product_details[0]->dose; ?></div>
                                    </div>
                                    <div class="tab">
                                        <input type="radio" id="rd5" name="rd">
                                        <label class="tab-label" for="rd5">Hindi</label>
                                        <div class="tab-content"> <?php echo $product_details[0]->dose_hindi; ?> </div>
                                    </div>
                                    <div class="tab">
                                        <input type="radio" id="rd6" name="rd">
                                        <label class="tab-label" for="rd6">Bengali</label>
                                        <div class="tab-content"> <?php echo $product_details[0]->dose_bengali; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                    <div class="review-heading">REVIEWS</div>
                    <p class="mb-20">
                        <?php
                        if (!empty($product_review_count)) {
                            foreach ($product_review_count as $key => $value) {
                                echo ($key + 1) . '. <b>Date: </b>' . $value->date_added;
                                echo '<b>Name: </b>' . $value->name;
                                echo '<b>Message: </b>' . $value->message;
                                echo '<br>';
                            }
                        } else {
                            echo 'There are no reviews yet.';
                        }
                        ?>

                    </p>
                    <form class="review-form" id="cu_registration_form" action="<?php echo base_url(); ?>product_details/product_review_submit" method="post" enctype="multipart/form-data">
                        <!--<div class="form-group">
                                <label>Your rating</label>
                                <div class="reviews-counter">
                                    <div class="rate">
                                        <input type="radio" id="star5" name="rate" value="5" />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" name="rate" value="4" />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" name="rate" value="3" />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" name="rate" value="2" />
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" name="rate" value="1" />
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                </div>
                            </div>-->
                        <div class="form-group">
                            <label>Your message</label>
                            <textarea class="form-control" rows="10" name="message" id="message"></textarea>
                            <input type="hidden" name="product_hidden_id" id="product_hidden_id" class="form-control" placeholder="" value="<?php echo $this->uri->segment(2); ?>">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="email_id" id="email_id" class="form-control" placeholder="Email Id">
                                </div>
                            </div>
                        </div>
                        <button type="submit" onclick="return form_validation()" class="round-black-btn">Submit Review</button>
                    </form>
                </div>
                <?php
                //echo "<pre>";print_r($product_details);
                if ($product_details[0]->product_description != '') {
                ?>
                    <div class="tab-pane fade active" id="description" role="tabpanel" aria-labelledby="description-tab">
                        <?php echo $product_details[0]->product_description; ?>
                    </div>
                <?php
                }
                ?>

                <?php
                if ($product_details[0]->info_for_doctor != '') {
                ?>
                    <div class="tab-pane fade active" id="info-for-doc" role="tabpanel" aria-labelledby="info-for-doc-tab">
                        <?php echo $product_details[0]->info_for_doctor; ?>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <h4>Related Products</h4>
            </div>
            <?php if (count($related_product_list) > 0) {
                foreach ($related_product_list as $row) {
            ?>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 pl-1 pr-1 mb-4">

                        <div class="product-grid4">
                            <div class="product-image4">
                                <?php if ($row->product_image != '') { ?>

                                    <!--<a href="<?php //echo base_url(); 
                                                    ?>product-details/<?php //echo $row->product_id; 
                                                                        ?>/<?php //echo $row->unique_key; 
                                                                            ?>"><img class="pic-1" src="<?php //echo base_url(); 
                                                                                                        ?>uploads/product/small/<?php //echo $row->product_image; 
                                                                                                                                                    ?>" alt="" /> </a>-->

                                    <a href="<?php echo base_url(); ?>product-details/<?php echo $row->unique_key; ?>"><img class="pic-1" src="<?php echo base_url(); ?>uploads/product/small/<?php echo $row->product_image; ?>" alt="<?php echo isset($row->alt_for_product_image) ? $row->alt_for_product_image : ''; ?>" /></a>

                                <?php } ?>

                                <?php $valid_datetime =  date("Y-m-d H:i:s", strtotime("$row->added_date+2 days"));

                                // echo $valid_datetime; 

                                $current_date     =   date('Y-m-d H:i:s');
                                $time1          =   strtotime($current_date);
                                $time2          =   strtotime(@$valid_datetime);
                                // $time2 = strtotime('2020-10-05 13:00:00');
                                // $interval=$time1-$time2;
                                $interval = $time2 - $time1;
                                if ($interval > 0) {

                                ?> <span class="product-new-label">New</span> <?php } ?>
                                <!-- <span class="product-discount-label"> -->

                                <?php
                                if ($row->product_type == 'simple') {
                                    $discouont = ((($row->product_regular_price - $row->product_price) * 100) / $row->product_regular_price);
                                } else {

                                    $product_variable_attribute =  $this->common_my_model->common($table_name = 'product_variable_attribute', $field = array(), $where = array('product_id' => @$row->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                                    $product_variable_attribute_last =  $this->common_my_model->common($table_name = 'product_variable_attribute', $field = array(), $where = array('product_id' => @$row->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array('variable_attribute_id' => 'desc'), $start = '', $end = '');

                                    //$discouont = (((@$product_variable_attribute[0]->product_regular_price - @$product_variable_attribute[0]->product_price) * 100) / @$product_variable_attribute[0]->product_regular_price);

                                    $discouont = (!empty($product_variable_attribute) &&  $product_variable_attribute[0]->product_regular_price != '' && $product_variable_attribute[0]->product_price != '') ? (((@$product_variable_attribute[0]->product_regular_price - @$product_variable_attribute[0]->product_price) * 100) / @$product_variable_attribute[0]->product_regular_price) : 0;
                                }

                                // echo round($discouont);
                                ?>

                                <!-- </span> -->
                            </div>
                            <div class="product-content">
                                <h3 class="title"><a href="<?php echo base_url(); ?>product-details/<?php echo $row->unique_key; ?>"><?php echo $row->product_title; ?></a></h3>
                                <div class="price">
                                    <i class="fa fa-inr" aria-hidden="true"></i> <?php if ($row->product_type == 'simple') {
                                                                                        echo $row->product_price;
                                                                                    } else {
                                                                                        echo @$product_variable_attribute[0]->product_price . ' - <i class="fa fa-inr" aria-hidden="true"></i>' . @$product_variable_attribute_last[0]->product_price;
                                                                                    } ?>
                                    <!-- <span>$16.00</span>-->
                                </div>
                                <a class="add-to-cart" href="<?php echo base_url(); ?>product-details/<?php echo $row->unique_key; ?>">READ MORE</a>
                            </div>
                        </div>

                    </div>

            <?php }
            } else {
                echo '<h1>No Products Found.</h1>';
            } ?>
        </div>


        <div class="modal fade" id="myModal1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Your Enquiry</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="col-xl-12 col-md-12 pt-12">
                                    <form class="form-horizontal" id="enquery_registration_form" action="<?php echo base_url(); ?>product_details/product_enquiry_submit" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="youremail" class="cols-sm-2 control-label">Enter Your Name<span>*</span></label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="enquery_name" id="enquery_name" placeholder="Enter your name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="youremail" class="cols-sm-2 control-label">Enter Your Email <span>*</span></label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="enquery_mail" id="enquery_mail" placeholder="Enter your email">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="youremail" class="cols-sm-2 control-label">Contact No <span>*</span></label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="enquery_phone" id="enquery_phone" placeholder="Enter your Contact No">
                                                    <input type="hidden" name="product_enquery_hidden_id" id="product_enquery_hidden_id" class="form-control" placeholder="" value="<?php echo $this->uri->segment(2); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="yourreview" class="cols-sm-2 control-label">Add Your Enquiry <span>*</span></label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <textarea class="form-control" name="enquery_message" id="enquery_message" cols="" rows="" placeholder="Add your review"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <button type="submit" onclick="return enquery_form_validation()" class="btn btn-primary btn-lg login-button">Submit</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<!-- Body --->

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript">
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function() {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }


    var modal_hin = document.getElementById("myModal-hin");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img_hin = document.getElementById("myImg-hin");
    var modalImg_hin = document.getElementById("img01-hin");
    //var captionText = document.getElementById("caption");
    img_hin.onclick = function() {
        modal_hin.style.display = "block";
        modalImg_hin.src = this.src;
    }

    // Get the <span> element that closes the modal
    var span_hin = document.getElementsByClassName("close-hin")[0];

    // When the user clicks on <span> (x), close the modal
    span_hin.onclick = function() {
        modal_hin.style.display = "none";
    }


    var modal_ben = document.getElementById("myModal-ben");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img_ben = document.getElementById("myImg-ben");
    var modalImg_ben = document.getElementById("img01-ben");
    //var captionText = document.getElementById("caption");
    img_ben.onclick = function() {
        modal_ben.style.display = "block";
        modalImg_ben.src = this.src;
    }

    // Get the <span> element that closes the modal
    var span_ben = document.getElementsByClassName("close-ben")[0];

    // When the user clicks on <span> (x), close the modal
    span_ben.onclick = function() {
        modal_ben.style.display = "none";
    }






    function submitCartForm() {
        if ($('input[type=checkbox]:checked').length > 0) {
            $("#frmvercart").submit();
        } else {
            alert("Please select at least one to add.");
        }
    }

    function calculatePrice(variable_attribute_id, price, qty) {
        var totprice = price * qty;
        $('#attrTotal_' + variable_attribute_id).html(totprice.toFixed(2));
    }

    function submitDetailsForm() {
        var variable_attribute_id = $('#size').val();
        var size = $("#size option:selected").text();
        //alert(variable_attribute_id);
        //alert(size);
        $('#ddlsize').val(size);
        $('#variable_attribute_id').val(variable_attribute_id);
        $("#frmaddtocart").submit();
    }

    function cu_data_Submit_fm() {
        var name = $("#name").val();
        if (name == "") {
            $('#name').removeClass('black_border').addClass('red_border');
        } else {
            $('#name').removeClass('red_border').addClass('black_border');
        }

        var email_id = $("#email_id").val();
        if (!isEmail(email_id)) {
            $('#email_id').removeClass('black_border').addClass('red_border');
        } else {
            $('#email_id').removeClass('red_border').addClass('black_border');
        }

        var message = $("#message").val();
        if (message == "") {
            $('#message').removeClass('black_border').addClass('red_border');
        } else {
            $('#message').removeClass('red_border').addClass('black_border');
        }

    }

    function form_validation() {


        $('#cu_registration_form').attr('onchange', 'cu_data_Submit_fm()');
        $('#cu_registration_form').attr('onkeypress', 'cu_data_Submit_fm()');

        cu_data_Submit_fm();

        //  alert($('#user_registration_form_id .red_border').size());

        if ($('#cu_registration_form .red_border').length > 0) {

            $('#cu_registration_form .red_border:first').focus();
            $('#cu_registration_form .alert-error').show();
            return false;
        }

        // else if(cat_ids.length==0){              
        //   alert("Please agree with our terms and conditions.");              
        //   return false;            
        // }
        else {

            $("#cu_registration_form").submit();
        }
    }
</script>


<script type="text/javascript">
    function enquery_data_Submit_fm() {
        var enquery_name = $("#enquery_name").val();
        if (enquery_name == "") {
            $('#enquery_name').removeClass('black_border').addClass('red_border');
        } else {
            $('#enquery_name').removeClass('red_border').addClass('black_border');
        }

        var enquery_mail = $("#enquery_mail").val();
        if (!isEmail(enquery_mail)) {
            $('#enquery_mail').removeClass('black_border').addClass('red_border');
        } else {
            $('#enquery_mail').removeClass('red_border').addClass('black_border');
        }

        var enquery_phone = $("#enquery_phone").val();
        if (enquery_phone == "") {
            $('#enquery_phone').removeClass('black_border').addClass('red_border');
        } else {
            $('#enquery_phone').removeClass('red_border').addClass('black_border');
        }

        var enquery_message = $("#enquery_message").val();
        if (enquery_message == "") {
            $('#enquery_message').removeClass('black_border').addClass('red_border');
        } else {
            $('#enquery_message').removeClass('red_border').addClass('black_border');
        }






    }

    function enquery_form_validation() {


        $('#enquery_registration_form').attr('onchange', 'enquery_data_Submit_fm()');
        $('#enquery_registration_form').attr('onkeypress', 'enquery_data_Submit_fm()');

        enquery_data_Submit_fm();

        //  alert($('#user_registration_form_id .red_border').size());

        if ($('#enquery_registration_form .red_border').length > 0) {

            $('#enquery_registration_form .red_border:first').focus();
            $('#enquery_registration_form .alert-error').show();
            return false;
        }

        // else if(cat_ids.length==0){              
        //   alert("Please agree with our terms and conditions.");              
        //   return false;            
        // }
        else {

            $("#enquery_registration_form").submit();
        }
    }
</script>




<script type="text/javascript">
    function wishlist(product_id) {



        var html_string = '';
        var base_url = '<?php echo base_url(); ?>';
        var user_id = '<?php echo $this->session->userdata('user_session_id'); ?>';

        if (user_id != '') {



            $.ajax({
                type: "POST",
                dataType: 'json',
                url: base_url + "Wishlist/add_to_wishlist",
                data: {
                    product_id: product_id,
                    user_id: user_id
                },
                // async:false,

                success: function(data) {
                    if (data.status == 'success')
                        alert(data.message);

                }
            });

        } else {
            alert('Please login first.');
            window.location.href = '<?php echo base_url() . 'user-registation'; ?>';
            // window.location.href("<?php echo base_url() . 'user-registation'; ?>");
        }



    }
</script>


<script type="text/javascript">
    function change_size() {



        var html_string = '';
        var base_url = '<?php echo base_url(); ?>';
        var user_id = '<?php echo $this->session->userdata('user_session_id'); ?>';

        var variable_attribute_id = $('#size').val();
        var size = $("#size option:selected").text();

        //alert(size);

        $.ajax({
            type: "POST",
            dataType: 'json',
            url: base_url + "product_details/change_size",
            data: {
                variable_attribute_id: variable_attribute_id
            },
            // async:false,

            success: function(data) {
                console.log(data);
                $('#show_size_price').html('<span><i class="fa fa-inr" aria-hidden="true"></i>' + data.price + '</span>');

            }
        });





    }
    $(".qtyminus").on("click", function() {
        var now = $(".qty").val();
        if ($.isNumeric(now)) {
            if (parseInt(now) - 1 > 0) {
                now--;
            }
            $(".qty").val(now);
        }
    })
    $(".qtyplus").on("click", function() {
        var now = $(".qty").val();
        if ($.isNumeric(now)) {
            $(".qty").val(parseInt(now) + 1);
        }
    });
</script>

<script>
    // Snigdho
    $('body').on('click', '.is-cod', function() {
        var is_cod = $(this).val();
        $('.cod-val').val(is_cod);
    });

    $('body').on('change', '.product-checkbox', function() {
        var weight = $(this).attr('data-weight');
        $('.p-weight').val(weight);
    });

    $('body').on('click', '.btn-check-pincode', function() {
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        var user_pincode = $('.user-pincode').val();
        var productid = $('.product-id').val();
        var product_nm = $('.product-nm').val();
        var cod_val = $('.cod-val').val();
        var weight = $('.p-weight').val();

        pinlen = user_pincode.length;

        // console.log(user_pincode);
        // console.log(productid);
        // console.log(product_nm);
        // console.log(cod_val);
        // console.log(weight);
        $('.pin-checker-msg').hide();
        $('.couriers-msg').hide();
        $('.delivery-company-p').hide();
        $('.cart-btns').hide();
        $('.btn-check-pincode').prop('disabled', true);


        if (user_pincode != '' && numberRegex.test(user_pincode) && pinlen == 6 && productid != '' && product_nm != '' && cod_val != '') {

            if (weight != '') {
                $('.pin-checker-msg').show();
                $('.btn-check-pincode').prop('disabled', true);
                $('.pin-checker-msg').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
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

                            $('.pin-checker-msg').html('<b style=""><i class="fa fa-check-circle" aria-hidden="true" style="color:green; font-size:20px;"></i>  ' + resp.message + '</b>');
                            $('.couriers-msg').show();
                            // $('.couriers-msg').html('<b style=""><i class="fa fa-plane" aria-hidden="true" style="color:green; font-size:20px;"></i>  Available Couriers: ' + resp.couriers_count + '</b>');
                            // $('.delivery-company-p').show();
                            // $('.cart-btns').show();
                            // $('.delivery-company').html(resp.courier_options);

                        } else if (resp.success == "0") {

                            $('.pin-checker-msg').html('<b style=""><i class="fa fa-times-circle-o" aria-hidden="true" style="color:red; font-size:20px;"></i> ' + resp.message + '</b>');

                        } else {

                            //window.location.href=resp.redirect;
                        }

                    }
                });
                $('.btn-check-pincode').prop('disabled', false);
            } else {
                $('.pin-checker-msg').show();
                $('.pin-checker-msg').html('<b style=""><i class="fa fa-times-circle-o" aria-hidden="true" style="color:red; font-size:20px;"></i> Product weight not found!</b>');
                $('.btn-check-pincode').prop('disabled', false);
            }
        } else {
            $('.pin-checker-msg').show();
            $('.pin-checker-msg').html('<b style=""><i class="fa fa-times-circle-o" aria-hidden="true" style="color:red; font-size:20px;"></i> Please enter 6 digit Pincode!</b>');
            $('.btn-check-pincode').prop('disabled', false);
        }


    });
</script>