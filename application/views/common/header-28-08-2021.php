<?php
$category_list= array();
$CI =& get_instance();
$CI->load->model('common_my_model');
$category_list=  $this->common_my_model->common($table_name ='category', $field = array(), $where = array('status'=>'1','parent_id'=>'o'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');	
//echo '<pre>'; print_r($category_list);echo '</pre>';
$grand_total = 0;
$total_qty = 0;
if ($cart = $this->cart->contents()):
    foreach ($cart as $item):
        $grand_total = $grand_total + $item['subtotal'];
        //$total_qty = $total_qty + $item['qty'];
		$total_qty = $total_qty + 1;
    endforeach;
endif;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- Required meta tags -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>


<?php
     $page_url= $this->uri->segment(1);

     if($page_url=='product-details'){
      $seo_product_id= $this->uri->segment(2);


       $my_seo_product_details=  $this->common_my_model->common($table_name ='product', $field = array(), $where = array('product_id'=>$seo_product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = ''); 

       @$seo_content_details[0]->meta_title=@$my_seo_product_details[0]->meta_title;
       @$seo_content_details[0]->meta_keyword=@$my_seo_product_details[0]->meta_keyword;
       @$seo_content_details[0]->meta_description=@$my_seo_product_details[0]->meta_description;


     }

      if($page_url=='news-details'){
      $seo_product_id= $this->uri->segment(2);


       $my_seo_product_details=  $this->common_my_model->common($table_name ='news', $field = array(), $where = array('news_id'=>$seo_product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = ''); 

       @$seo_content_details[0]->meta_title=@$my_seo_product_details[0]->meta_title;
       @$seo_content_details[0]->meta_keyword=@$my_seo_product_details[0]->meta_keyword;
       @$seo_content_details[0]->meta_description=@$my_seo_product_details[0]->meta_description;


     }

      if($page_url=='blog-details'){
      $seo_product_id= $this->uri->segment(2);


       $my_seo_product_details=  $this->common_my_model->common($table_name ='blog', $field = array(), $where = array('blog_id'=>$seo_product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = ''); 

       @$seo_content_details[0]->meta_title=@$my_seo_product_details[0]->meta_title;
       @$seo_content_details[0]->meta_keyword=@$my_seo_product_details[0]->meta_keyword;
       @$seo_content_details[0]->meta_description=@$my_seo_product_details[0]->meta_description;


     }


     ?>




     <meta name="title" content="<?php echo strip_tags(@$seo_content_details[0]->meta_title); ?>">
      <meta name="keywords" content="<?php if(@$seo_content_details[0]->meta_keyword){ echo strip_tags(@$seo_content_details[0]->meta_keyword);  }else{  echo "Burnett Research Laboratory"; } ?>"/>

     <meta name="description" content="<?php echo strip_tags(@$seo_content_details[0]->meta_description); ?>">
    <title><?php if(@$seo_content_details[0]->meta_title !=''){  echo @$seo_content_details[0]->meta_title; } else{ echo 'Burnett Research Laboratory';} ?></title>




<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/frontend/images/favicon.png" />
    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/bootstrap.min.css" type="text/css"/>
<!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/font-awesome.min.css" type="text/css"/> -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/style.css" type="text/css"/>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/tab-style.css" type="text/css"/>
 <!-- Owl CSS -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/css/owl.carousel.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/css/owl.theme.default.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

    <!-- <title>Burnett Research Laboratory</title> -->

    

     


  </head>
  <body>
  <!-- Top Bar -->
 <header>
<div class="container-fluid top_bar">
  <div class="container">
    <div class="row">
        <div class="col-md-8 text-center text-md-left">
       <nav class="navbar navbar-expand-lg navbar-light my_top_menu">  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url();?>blog-list">Blog<span class="sr-only">(current)</span></a>
      </li>
      <!--<li class="nav-item">
        <a class="nav-link" href="#">Dealer Locator</a>
      </li>-->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url();?>news-list">News</a>
      </li>
      <!--<li class="nav-item">
        <a class="nav-link" href="#">Doctor's Zone</a>
      </li>-->
      <li class="nav-item">
        <a class="nav-link" href="#">FAQ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url();?>contact-us">Contact Us</a>
      </li>
     <!--<li class="nav-item">
        <a class="nav-link" href="#">Career</a>
      </li>-->
    </ul>    
  </div>
</nav>
        </div>
        <div class="col-md-4">
        <div class="top_login text-center text-md-right">
          <?php 
          $user_id= $this->session->userdata('user_session_id');
           $log_in_user_details=$this->common_my_model->common($table_name = 'register_users', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
          // print_r($log_in_user_details);

          if($user_id !=''){ ?>
            <a href="<?php echo base_url();?>my-account"><?php echo  @$log_in_user_details[0]->firstname.' '.@$log_in_user_details[0]->lastname;?></a>
          
        <?php } else {

         
          ?>
          

          <a href="<?php echo base_url();?>user-registation">Register</a> / <a href="<?php echo base_url();?>user-registation">Login</a> 

        <?php } ?>

           &nbsp; <span class="the_cart_top"><a href="<?php echo base_url();?>cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a> <?php echo $total_qty;?></span></div>
        </div>
  </div>
</div>
</div>

<!-- Top Bar -->
<!-- Header -->
 
 <div class="container-fluid header_style">
  <?php $all_header_category_list=  $this->common_my_model->common($table_name ='category', $field = array(), $where = array('status'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = ''); ?>
<div class="container">
  <div class="row">
        <div class="col-md-5 text-center text-md-left">
        <a href="<?php echo base_url();?>"><img class="img-fluid" src="<?php echo base_url();?>assets/frontend/images/logo04.png" alt="logo" /></a><br/>
        <div class="since_year">SINCE 1993</div>
        </div>
        <div class="col-md-4 text-center text-md-left pt-3">
        <div class="best_quality">BEST QUALITY HOMEO MEDICINE</div>
        <a href="tel:03325360426" class="top_phone">+91(33)2536-0426</a><br/>
       <form class="navbar-form search_bar all_view"  name="search_product_frm" id="search_product_frm" action="<?php echo base_url();?>product_list/srearch_product" method="get">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="product_name" id="product_name"/>
            
            <select class="custom-select d-block w-100" id="category_id" name="category_id">
                   <option value="">All category</option>
                   <?php foreach($all_header_category_list as $row){ ?>
                   <option value="<?php echo $row->cat_id;?>" ><?php echo $row->name;?></option>
                   <?php } ?>
                    </select>
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
        </div>
        </form>
        </div>
        <div class="col-md-3 text-center text-md-right pt-3">
        <img class="img-fluid" src="<?php echo base_url();?>assets/frontend/images/top_logo01.jpg" alt="" />
        <div class="top_logo_texts">
        A trusted sign for manufacturing, research &amp; analysis of homeopathic medicine
        </div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 tab_view"><form class="navbar-form search_bar">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="q"/>
            <select class="custom-select d-block w-100" id="bil_country" name="bil_country">
                   <option value="">All category</option>
                   <option value="gril" >gril</option>
                   <option value="boy" >boy</option>
                    </select>
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
        </div>
        </form></div>
    <div class="col-md-3"></div>
    </div>
  </div>  
    </div>

<!-- Header -->

<!-- Menu Bar -->

     <div class="container-fluid menu_bar">
    <div class="container">
      <div class="row"> 
            <nav class="navbar navbar-expand-lg navbar-dark my_main_menu text-center">  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent1">
    <ul class="navbar-nav navbar-center navbar-light">
      <!--<li class="nav-item">
        <a class="nav-link" href="<?php echo base_url();?>product-list">Homoeopathy</a>
      </li>
      <li class="nav-item dropdown megamenu-li dmenu">
                <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Diseases</a>
                <div class="dropdown-menu megamenu sm-menu border-top" aria-labelledby="dropdown01">
                    <div class="row">
                        <div class="col-sm-6 col-lg-3 border-right mb-4">                            
                            <a class="dropdown-item" href="#">Magento Development</a>
                            <a class="dropdown-item" href="#">Magento 2 Migration</a>
                            <a class="dropdown-item" href="#">Odoo ERP</a>
                            <a class="dropdown-item" href="#">Mobile Commerce</a>
                            <a class="dropdown-item" href="#">CRM for Commerce</a></div>
                       <div class="col-sm-6 col-lg-3 border-right mb-4">                        
                            <a class="dropdown-item" href="#">PHP Website Development</a>
                            <a class="dropdown-item" href="#">Phalcon Development</a>
                            <a class="dropdown-item" href="#">Laravel Development</a>
                            <a class="dropdown-item" href="#">WordPress Development</a>
                            <a class="dropdown-item" href="#">Symfony Development</a></div>
                        <div class="col-sm-6 col-lg-3 border-right mb-4">                         
                            <a class="dropdown-item" href="#">iPhone App Development</a>
                            <a class="dropdown-item" href="#">Android App Development</a>
                            <a class="dropdown-item" href="#">Phone Gap App Development</a>
                            <a class="dropdown-item" href="#">Hybrid App Development</a>
                            <a class="dropdown-item" href="#">Ionic Development</a>
                            <a class="dropdown-item" href="#">React Native Development</a>
                            <a class="dropdown-item" href="#">Xamarin App Development</a></div>
                        <div class="col-sm-6 col-lg-3 mb-4">                         
                            <a class="dropdown-item" href="#">Full Stack Development</a>
                            <a class="dropdown-item" href="#">MEAN Stack</a>
                            <a class="dropdown-item" href="#">AngularJS</a>
                            <a class="dropdown-item" href="#">Node.JS Development</a>
                            <a class="dropdown-item" href="#">MongoDB Development</a></div>
                    </div>
                     
                </div>
            </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url();?>product-list/speciality-formulations">Speciality Formulations</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url();?>product-list/mother-tinctures">Mother Tinctures</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url();?>product-list/dilutions-potencies">Dilutions &amp; Potencies</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url();?>product-list/biochemics">Biochemics</a>
      </li>
     <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url();?>product-list/cosmetics">Cosmetics</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url();?>product-list/herbal">Herbal</a>
      </li>-->
      <?php 
	  
	  foreach($category_list as $row){
		 
		  
		  $sub_category_list=$this->common_my_model->common($table_name ='category', $field = array(), $where = array('parent_id'=>@$row->cat_id,'status'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		  ?>
      <li class="nav-item dropdown megamenu-li dmenu">
                <a class="nav-link <?php if(count(@$sub_category_list)>0){echo ' dropdown-toggle';}?>" href="<?php echo base_url().'product-list/'.strtolower($row->unique_name); ?>" id="dropdown<?php echo $row->cat_id;?>" <?php if(count(@$sub_category_list)>0){?> data-toggle="dropdown" aria-haspopup="true"<?php } ?> aria-expanded="false"><?php echo $row->name;?></a>
                
                <?php 
if(count(@$sub_category_list)>0){  ?>
                <div class="dropdown-menu megamenu sm-menu border-top" aria-labelledby="dropdown<?php echo $row->cat_id;?>">
                    <div class="row">
                        <div class="col-md-12 border-right mb-4">  
                        <?php   
						foreach($sub_category_list as $subcatrow){
                        $my_parent_category_details=  $this->common_my_model->common($table_name ='category', $field = array(), $where = array('cat_id'=>@$subcatrow->parent_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = ''); ?>                          
                            <a class="dropdown-item" href="<?php echo base_url().'product-list/'.@$my_parent_category_details[0]->unique_name.'/'.strtolower($subcatrow->unique_name); ?>"><?php echo $subcatrow->name;?></a>
                         <?php } ?>
                            
                         </div>
                    </div>
                     
                </div>
   				<?php } ?>
      </li>
      <?php }?>
      <a href="<?php echo base_url();?>cart" class="menu_cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?php echo $total_qty;?></a> 
    </ul>    
  </div>
</nav>
            </div>
        </div>
     </div> 
</header>  
<!-- Menu Bar -->

<script type="text/javascript">
    $(document).ready(function () {
$('.navbar-light .dmenu').hover(function () {
        $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
    }, function () {
        $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
    });
}); 
 
    $(document).ready(function() {
	$(".megamenu").on("click", function(e) {
		e.stopPropagation();
	});
});
</script>