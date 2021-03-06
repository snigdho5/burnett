<!-- Top Banner -->

<div class="container-fluid">
    <div class="row">
        <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="container">
                <div class="carousel-inner pt-5">
                    <div class="carousel-item active">
                        <div class="mask flex-center">
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-md-6 col-12 order-md-1 order-3">
                                        <h4>BEST QUALITY HOMEO MEDICINE</h4>
                                        <p>A Leading homoeopathic medicine manufacturing laboratory in india</p>
                                        <h5>Burnett gives you a new life...</h5>

                                    </div>
                                    <div class="col-md-6 col-12 order-md-2 order-1">&nbsp;</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> -->
            </div>
        </div>
    </div>
</div>

<!-- Top Banner -->

<!-- Body -->
<div class="container-fluid home_top_images pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center text-md-left">
                <h4>Latest Products</h4>
            </div>
        </div>
        <div class="row text-center text-md-left">
            <div class="col-md-3 pb-3"><a href="#"><img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/latest-product-01.jpg" alt="latest-product-01.jpg" /></a></div>
            <div class="col-md-3 pb-3"><a href="#"><img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/latest-product-02.jpg" alt="latest-product-02.jpg" /></a></div>
            <div class="col-md-3 pb-3"><a href="#"><img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/latest-product-03.jpg" alt="latest-product-03.jpg" /></a></div>
            <div class="col-md-3 pb-3"><a href="#"><img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/latest-product-04.jpg" alt="latest-product-04.jpg" /></a></div>
        </div>
        <div class="row pt-4 text-center text-md-left">
            <div class="col-md-3">
                <div class="row bardhe">
                    <div class="feature-col col-md-12 kolonat-hom">
                        <div class="ikonat-home"> <span><img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/Free-Delivery01.png" alt="Free-Delivery01.png" /></span> </div>
                        <div class="teksti-home">
                            <h4 class="title">Free Delivery</h4>
                            <p class="text">For all oders over <i class="fa fa-inr" aria-hidden="true"></i> 100</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row bardhe top_icons_line">
                    <div class="feature-col col-md-12 kolonat-hom">
                        <div class="ikonat-home"> <span><img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/30-Days-Return01.png" alt="30-Days-Return01.png" /></span> </div>
                        <div class="teksti-home">
                            <h4 class="title">30 Days Return</h4>
                            <p class="text">If goods have problems</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row bardhe top_icons_line">
                    <div class="feature-col col-md-12 kolonat-hom">
                        <div class="ikonat-home"> <span><img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/Secure-Payment01.png" alt="Secure-Payment01.png" /></span> </div>
                        <div class="teksti-home">
                            <h4 class="title">Secure Payment</h4>
                            <p class="text">100% Secure Payment</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row bardhe top_icons_line">
                    <div class="feature-col col-md-12 kolonat-hom">
                        <div class="ikonat-home"> <span><img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/24-7-Support01.png" alt="24-7-Support01.png" /></span> </div>
                        <div class="teksti-home">
                            <h4 class="title">24/7 Support</h4>
                            <p class="text">Delicated Support</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-5">
    <div class="container">
        <div class="row home_img_boxs">
            <div class="col-md-4 pl-1 pr-1"><a href="#"><img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/ads1.jpg" alt="" /></a></div>
            <div class="col-md-4 pl-1 pr-1"><a href="#"><img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/ads2.jpg" alt="" /></a> <a><img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/ads3.jpg" alt="" /></a></div>
            <div class="col-md-4 pl-1 pr-1"><a href="#"><img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/ads4.jpg" alt="" /></a> <a><img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/ads5.jpg" alt="" /></a></div>
        </div>
    </div>
</div>

<!--<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-3 pl-0 pr-0 home_side_bar mt-5">
                <div class="col-md-12 cat_hd">
                    Categories
                </div>
                <div class="col-md-12 home_cat_list">
                    <ul>
                        <?php foreach ($category_list as $row) { ?>
                            <li><a href="<?php echo base_url() . 'product-list/' . $row->unique_name; ?>"><i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $row->name; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-9 home_featured  mt-5">
                <h4>Featured Products</h4>
                <div class="container">
                    <div class="row pt-4">
                        <?php foreach ($product_list as $row) { //echo "<pre>";print_r($row); ?>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 pl-1 pr-1">
                                <div class="product-grid4">
                                    <div class="product-image4">

                                        <?php if ($row->product_image != '') { ?> <a href="<?php echo base_url(); ?>product-details/<?php echo $row->unique_key; ?>"><img class="pic-1" src="<?php echo base_url(); ?>uploads/product/small/<?php echo $row->product_image; ?>" alt="<?php echo isset($row->alt_for_product_image)?$row->alt_for_product_image:'';?>" /> </a> <?php } ?>

                                        <span class="product-discount-label">-<?php
											if ($row->product_type == 'simple') {
												$discouont = ((($row->product_regular_price - $row->product_price) * 100) / $row->product_regular_price);
											} else {

												$product_variable_attribute =  $this->common_my_model->common($table_name = 'product_variable_attribute', $field = array(), $where = array('product_id' => @$row->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
												$product_variable_attribute_last =  $this->common_my_model->common($table_name = 'product_variable_attribute', $field = array(), $where = array('product_id' => @$row->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array('variable_attribute_id' => 'desc'), $start = '', $end = '');

												$discouont = (!empty($product_variable_attribute) &&  $product_variable_attribute[0]->product_regular_price != '' && $product_variable_attribute[0]->product_price != '')?((($product_variable_attribute[0]->product_regular_price - $product_variable_attribute[0]->product_price) * 100) / $product_variable_attribute[0]->product_regular_price):0;
											}
											
											echo $discouont;
											?>%</span>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"><a href="<?php echo base_url(); ?>product-details/<?php echo $row->unique_key; ?>"><?php echo $row->product_title; ?></a></h3>
                                        <div class="price">
                                            <i class="fa fa-inr" aria-hidden="true"></i><?php if ($row->product_type == 'simple') {
												echo $row->product_price;
											} else {
												echo (!empty(($product_variable_attribute) && $product_variable_attribute[0]->product_price != '')?$product_variable_attribute[0]->product_price:'') . ' - <i class="fa fa-inr" aria-hidden="true"></i>' . ((!empty($product_variable_attribute_last) && $product_variable_attribute_last[0]->product_price != '')?$product_variable_attribute_last[0]->product_price:'');
											} ?>
                                        </div>
                                        <a class="add-to-cart" href="<?php echo base_url(); ?>product-details/<?php echo $row->unique_key; ?>">READ MORE</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->

<div class="container-fluid pt-5">
    <div class="row">
        <div class="col-md-6 home_blue_bg">
            <h3>What to do at home isolation for covid -19 positive case take homeo medicine by any good homoeopathic doctor and</h3>
            <ul>
                <li>Gurgle with worm water with salt</li>
                <li>Liquor tea three time daily</li>
                <li>Take warm water everyday</li>
                <li>Wear mask when go outside or any meeting</li>
                <li>14 days home isolation must</li>
                <li>Take sour fruit</li>
                <li>Use sanitizer (75% alcohol sanitizer )</li>
                <li>Do regular exercise for good blood circulation of body.</li>
                <li>Think positive and be positive.</li>
                <li>Take Vitamin D3 tablet and vitamin c tablet</li>
                <li>Coronavirus protection by homoeopathic medicine to improve the immunity of respiratory system</li>
            </ul>
        </div>
        <div class="col-md-6 home_green_bg">
            <h3>Coronavirus protection by homoeopathic medicine to improve the immunity of respiratory system</h3>

            <ol>
                <li>Aswagandha mother tincture 40 to 50drops take everyday three time</li>
                <li>Amloki mother tincture 40 to 50drops take everyday three time</li>
                <li>Zingsang mother tincture 40 to 50drops take everyday three time</li>
                <li>Arsenicum album &nbsp;30 (as per aayush guideline)</li>
                <li>Take medicine as per symptoms arises after consulting with the doctor</li>
            </ol>
        </div>
    </div>

</div>


<div class="container-fluid home_img">
    <div class="row">
        <img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/bady_img_edit1.jpg" alt="bady_img_edit1.jpg" />
    </div>
</div>

<div class="container-fluid home_suffering pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 suffering_inner">
                <h4 class="pb-3">Are you suffering<br />from a <strong>headache</strong><br />or migraine?</h4>
                <a href="#" class="suffering_btn">Learn more</a>
            </div>
            <div class="col-md-6">
                <img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/blue_bg_img01.png" alt="blue_bg_img01.png" />
            </div>
        </div>
    </div>
</div>
<div class="container-fluid home_img pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 one_img_box">
                <img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/one-img01.jpg" alt="one-img01.jpg" />
            </div>
            <div class="col-md-6 subscribe_box">
                <div class="subscribe_inner">
                    <div class="input-group">
                        <h4>Subscribe to our newsletter</h4>
                        <div class="col-md-12 pl-0 pr-0">
                            <input type="text" class="form-control input-lg" name="email" id="email" placeholder="Your Email Address" />
                        </div>
                        <div class="col-md-12 pl-0 pr-0">
                            <button class="btn btn-warning btn-lg">SIGN UP</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="p-2 green_boxss">
                <img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/100-plus.jpg" alt="100-plus.jpg" />
                <h5>29</h5>
                <p>Years of experiance in homeopathy</p>
            </div>
            <div class="p-2 green_boxss">
                <img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/gmp-icon.jpg" alt="gmp-icon.jpg" />
                <h5>GMP</h5>
                <p>Certified</p>
            </div>
            <div class="p-2 green_boxss">
                <img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/iso-icon.jpg" alt="iso-icon.jpg" />
                <h5>ISO</h5>
                <p>9001: 2015 Cetified</p>
            </div>
            <div class="p-2 green_boxss">
                <img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/Secure-icon.jpg" alt="Secure-icon.jpg" />
                <h5>Secure</h5>
                <p>Reliable &amp; Trusted</p>
            </div>
            <div class="p-2 green_boxss">
                <img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/Millions-icon.jpg" alt="Millions-icon.jpg" />
                <h5>Millions</h5>
                <p>Of Satisfied Customers Globally</p>

            </div>
        </div>
    </div>
</div>

<!-- Blog -->


<div class="container home_blog pt-5 pb-5">
    <div class="details-card">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card-content">
                        <div class="card-img">
                            <img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/blog01.jpg" alt="blog01.jpg" />
                        </div>
                        <div class="card-desc">
                            <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis
                                voluptas totam</p>
                            <a href="#" class="btn-card">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-content">
                        <div class="card-img">
                            <img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/blog02.jpg" alt="" />
                        </div>
                        <div class="card-desc">
                            <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis
                                voluptas totam</p>
                            <a href="#" class="btn-card">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-content">
                        <div class="card-img">
                            <img class="img-fluid" src="<?php echo base_url(); ?>assets/frontend/images/blog03.jpg" alt="blog03.jpg" />
                        </div>
                        <div class="card-desc">
                            <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis
                                voluptas totam</p>
                            <a href="#" class="btn-card">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>