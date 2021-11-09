﻿<!-- Top Banner -->
<div class="container-fluid the_banner">
	<div class="row">
		<div class="col">
			<!-- carousel code -->
			<div id="carouselExampleIndicators" class="carousel slide">
				<div class="carousel-inner">
					<?php
						$i = 0;
						foreach($banner as $val){
						$i++;
					?>
					<div class="carousel-item <?php if($i== 1){ echo 'active'; } ?>">
						<img src="<?php echo base_url('uploads/'.$val->desktop_img);?>" alt="<?php echo isset($val->banner_alt_tag)?$val->banner_alt_tag:'';?>"/>
						<div class="carousel-caption d-md-block">
							<div class="col-md-6 col-12">
								<h3 data-animation="animated bounceInLeft"><?php echo isset($val->banner_first_heading)?$val->banner_first_heading:'';?></h3>
								<h4 data-animation="animated bounceInRight"><?php echo isset($val->banner_second_heading)?$val->banner_second_heading:'';?></h4>
								<h5 data-animation="animated bounceInLeft"><?php echo isset($val->banner_third_heading)?$val->banner_third_heading:'';?></h5>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="latest_news_strip">
<div class="col-md-12">
	<marquee behavior="scroll" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();"><?php foreach($message as $val) { echo isset($val->message)?$val->message.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;':'';} ?></marquee>
    </div>
</div>

<!-- Body -->
<div class="container-fluid home_top_images pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center text-md-left">
                <h4>Featured Products</h4>
				
            </div>
        </div>
        <div class="row text-center text-md-left">
			
			<?php foreach($featureProduct as $val){ ?>
            <div class="col-md-3 pb-3">
				<a href="<?php echo isset($val->url)?$val->url:'';?>"><img class="img-fluid" src="<?php echo base_url('uploads/home_image/'.$val->f_image);?>" alt="<?php echo isset($val->alt_tag)?$val->alt_tag:'';?>" /></a>
			</div>
			<?php } ?>
			
            <!--<div class="col-md-3 pb-3"><a href="#"><img class="img-fluid" src="<?php //echo base_url(); ?>assets/frontend/images/latest-product-01.jpg" alt="latest-product-01.jpg" /></a></div>
            <div class="col-md-3 pb-3"><a href="#"><img class="img-fluid" src="<?php //echo base_url(); ?>assets/frontend/images/latest-product-02.jpg" alt="latest-product-02.jpg" /></a></div>
            <div class="col-md-3 pb-3"><a href="#"><img class="img-fluid" src="<?php //echo base_url(); ?>assets/frontend/images/latest-product-03.jpg" alt="latest-product-03.jpg" /></a></div>
            <div class="col-md-3 pb-3"><a href="#"><img class="img-fluid" src="<?php //echo base_url(); ?>assets/frontend/images/latest-product-04.jpg" alt="latest-product-04.jpg" /></a></div>-->
        </div>
        <div class="row pt-4 text-center text-md-left">
		
			<?php foreach($commitmentInfo as $val) { ?>
			<div class="col-md-3">
                <div class="row bardhe">
                    <div class="feature-col col-md-12 kolonat-hom">
						<?php if(isset($val->f_image) && $val->f_image !=''){ ?>
							<div class="ikonat-home">
								<span><img class="img-fluid" src="<?php echo base_url('uploads/home_image/'.$val->f_image);?>" alt="<?php echo isset($val->alt_tag)?$val->alt_tag:'';?>"/></span>
							</div>
						<?php } ?>
                        <div class="teksti-home">
                            <h4 class="title"><?php echo isset($val->title)?$val->title:'';?></h4>
                            <p class="text"><?php echo isset($val->text_msg)?$val->text_msg:'';?></p>
                        </div>
                    </div>
                </div>
            </div>
			<?php } ?>
			
            <!--<div class="col-md-3">
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
                        <div class="ikonat-home"> <span><img class="img-fluid" src="<?php //echo base_url(); ?>assets/frontend/images/30-Days-Return01.png" alt="30-Days-Return01.png" /></span> </div>
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
                        <div class="ikonat-home"> <span><img class="img-fluid" src="<?php //echo base_url(); ?>assets/frontend/images/Secure-Payment01.png" alt="Secure-Payment01.png" /></span> </div>
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
                        <div class="ikonat-home"> <span><img class="img-fluid" src="<?php //echo base_url(); ?>assets/frontend/images/24-7-Support01.png" alt="24-7-Support01.png" /></span> </div>
                        <div class="teksti-home">
                            <h4 class="title">24/7 Support</h4>
                            <p class="text">Delicated Support</p>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
    </div>
</div>

<div class="container-fluid pt-5">
    <div class="container">
        <div class="row home_img_boxs">
            <div class="col-md-4 pl-1 pr-1">
				<!--<a href="javascript:void(0)"><img class="img-fluid" src="<?php //echo base_url(); ?>assets/frontend/images/ads1.jpg" alt="" /></a>-->
				<?php if(isset($yourChoice[0]->f_image) && $yourChoice[0]->f_image !=''){ ;?>
				<a href="<?php echo isset($yourChoice[0]->url)?$yourChoice[0]->url:''?>"><img class="img-fluid" src="<?php echo base_url('uploads/home_image/'.$yourChoice[0]->f_image);?>" alt="<?php isset($yourChoice[0]->alt_tag)?$yourChoice[0]->alt_tag:'';?>"/></a>
				<?php } ?>
			</div>
            <div class="col-md-4 pl-1 pr-1">
				<!--<a href="#"><img class="img-fluid" src="<?php //echo base_url(); ?>assets/frontend/images/ads2.jpg" alt="" />-->
				<?php
					$YTvideoID = isset($youtube[0]->youtube_video_id)?$youtube[0]->youtube_video_id:'';
					echo '<iframe width="380" height="300" src="https://www.youtube.com/embed/'.$YTvideoID.'?autoplay=1&mute=1&controls=0"></iframe>';
				?>
				<!--</a> <a><img class="img-fluid" src="<?php //echo base_url(); ?>assets/frontend/images/ads3.jpg" alt="" /></a>-->
				<?php if(isset($yourChoice[1]->f_image) && $yourChoice[1]->f_image !=''){ ?>
				<a href="<?php echo isset($yourChoice[1]->url)?$yourChoice[1]->url:''?>"><img class="img-fluid" src="<?php echo base_url('uploads/home_image/'.$yourChoice[1]->f_image);?>" alt="<?php isset($yourChoice[1]->alt_tag)?$yourChoice[1]->alt_tag:'';?>"/></a>
				<?php } ?>
			</div>
            <div class="col-md-4 pl-1 pr-1">
				<!--<a href="#"><img class="img-fluid" src="<?php //echo base_url(); ?>assets/frontend/images/ads4.jpg" alt="" /></a>
				<a><img class="img-fluid" src="<?php //echo base_url(); ?>assets/frontend/images/ads5.jpg" alt="" /></a>-->
				<?php if(isset($yourChoice[2]->f_image) && $yourChoice[2]->f_image !=''){ ?>
				<a href="<?php echo isset($yourChoice[2]->url)?$yourChoice[2]->url:''?>"><img class="img-fluid" src="<?php echo base_url('uploads/home_image/'.$yourChoice[2]->f_image);?>" alt="<?php isset($yourChoice[2]->alt_tag)?$yourChoice[2]->alt_tag:'';?>"/></a>
				<?php } ?>
				
				<?php if(isset($yourChoice[3]->f_image) && $yourChoice[3]->f_image !=''){ ?>
				<a href="<?php echo isset($yourChoice[3]->url)?$yourChoice[3]->url:''?>"><img class="img-fluid" src="<?php echo base_url('uploads/home_image/'.$yourChoice[3]->f_image);?>" alt="<?php isset($yourChoice[3]->alt_tag)?$yourChoice[3]->alt_tag:'';?>"/></a>
				<?php } ?>
			</div>
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
            <h3><?php echo isset($content[0]->left_heading)?$content[0]->left_heading:'';?></h3>
            <ul>
                <?php
					$left = explode("\n", $content[0]->left_content);
					for ($x = 0; $x < count($left); $x++) {
						echo '<li>'. $left[$x] . '</li>';
					}
				?>
            </ul>
        </div>
        <div class="col-md-6 home_green_bg">
            <h3><?php echo isset($content[0]->right_heading)?$content[0]->right_heading:'';?></h3>
            <ol>
				<?php
					$right = explode("\n", $content[0]->right_content);
					for ($x = 0; $x < count($right); $x++) {
						echo '<li>'. $right[$x] . '</li>';
					}
				?>
            </ol>
        </div>
		
		
		
		
		<!--<div class="col-md-6 home_blue_bg">
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
        </div>-->
    </div>

</div>

<div class="container-fluid home_img">
    <div class="row">
        <!--<img class="img-fluid" src="<?php //echo base_url(); ?>assets/frontend/images/bady_img_edit1.jpg" alt="bady_img_edit1.jpg" />-->
		<img class="img-fluid" src="<?php echo base_url('uploads/home_image/'.$imagesInfo[0]->image);?>" alt="<?php echo isset($imagesInfo[0]->alt_tag)?$imagesInfo[0]->alt_tag:'';?>"/>
    </div>
</div>

<div class="container-fluid home_suffering pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 suffering_inner">
                <!--<h4 class="pb-3">Are you suffering<br />from a <strong>headache</strong><br />or migraine?</h4>
                <a href="#" class="suffering_btn">Learn more</a>-->
				<h4 class="pb-3"><?php echo isset($imagesInfo[1]->title)?$imagesInfo[1]->title:'';?></h4>
                <a href="#" class="suffering_btn">Learn more</a>
            </div>
            <div class="col-md-6">
				<!--<img class="img-fluid" src="<?php //echo base_url(); ?>assets/frontend/images/blue_bg_img01.png" alt="blue_bg_img01.png" />-->
				<?php if(isset($imagesInfo[1]) && $imagesInfo[1]->image !=''){ ?>
					<img class="img-fluid" src="<?php echo base_url('uploads/home_image/'.$imagesInfo[1]->image);?>" alt="<?php echo isset($imagesInfo[1]->alt_tag)?$imagesInfo[1]->alt_tag:'';?>" />
				<?php } ?>
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

<!--<div class="container-fluid">
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
</div>-->


<!-- Blog -->
<div class="container home_blog pt-5 pb-5">
    <div class="details-card">
        <div class="container">
            <div class="row">
			<?php foreach ($blogInfo as $row) { ?>
				<div class="col-md-4">
                    <div class="card-content">
                        <div class="card-img">
							<?php if($row->image !=''){ ?> <img class="img-fluid" src="<?php echo base_url();?>uploads/blog/small/<?php echo $row->image;?>" alt="<?php echo isset($row->meta_title)?$row->meta_title:'';?>"/> <?php } ?>
                        </div>
                        <div class="card-desc">
                            <h4><?php echo isset($row->blog_title)?$row->blog_title:'';?></h4>
                            <p><?php echo isset($row->description)?character_limiter(@$row->description,60):'';?></p>
                            <a href="<?php echo base_url();?>blog-details/<?php echo $row->blog_id;?>/<?php echo $row->blog_slug;?>" class="btn-card">Read More</a>
                        </div>
                    </div>
                </div>
				<?php } ?>
                <!--<div class="col-md-4">
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
                </div>-->
            </div>
        </div>
    </div>
</div>
