<!--Body -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
        <div class="col-md-3 pl-0 pr-0 home_side_bar mt-5 mb-5">
        <div class="col-md-12 cat_hd">
        Cetagories
        </div>
        <div class="col-md-12 home_cat_list">
        <ul>
             <?php  if(count(@$category_list)>0){ foreach($category_list as $row){?>
            <li><a href="<?php echo base_url().'product-list/'.$row->unique_name; ?>"><i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $row->name;?></a></li>
        <?php } } else{ echo '<li>No Category Found.</li>'; }?>
           <!--  <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Children</a></li>
            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>  Digestive Problem</a></li>
            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>  Female</a></li>
            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>  Fever &amp; General</a></li>
            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>  Joint &amp; Muscles</a></li>
            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>  Lifestyle Diseases</a></li>
            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>  Respiratory Diseases</a></li>
            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>  Skin Diseases</a></li> -->
            </ul>
        </div>
        </div>
        <div class="col-md-9 home_featured  mt-5">
        <h4>Products List</h4> <?php

        $parent_slug = $this->uri->segment(2);
        $sub_slug = $this->uri->segment(3);

        if($parent_slug !='' && $sub_slug==''){
          $title_parent_category_details=  $this->common_my_model->common($table_name ='category', $field = array(), $where = array('unique_name'=>@$parent_slug), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
          echo $title_parent_category_details[0]->name;

        }

        if($sub_slug !=''){

          $title_parent_category_details=  $this->common_my_model->common($table_name ='category', $field = array(), $where = array('unique_name'=>@$parent_slug), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

        
        $title_sub_category_details=  $this->common_my_model->common($table_name ='category', $field = array(), $where = array('unique_name'=>@$sub_slug), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

         echo $title_parent_category_details[0]->name.' > '.$title_sub_category_details[0]->name;

       }


         ?>
        <div class="container">    
             <div class="row pt-4 mb-5">
                
                 <?php 



                 if(count(@$sub_category_list)>0){  ?>

                  
                    <?php   foreach($sub_category_list as $row){

                      $my_parent_category_details=  $this->common_my_model->common($table_name ='category', $field = array(), $where = array('cat_id'=>@$row->parent_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



                      ?>



                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 pl-1 pr-1 mb-4">
                    
            <div class="product-grid4">
                <div class="product-image4">
                   <?php  if($row->category_image !=''){ ?> <a href="<?php echo base_url().'product-list/'.@$my_parent_category_details[0]->unique_name.'/'.$row->unique_name; ?>"><img class="pic-1" src="<?php echo base_url();?>uploads/<?php echo $row->category_image;?>" style="height:100px;width: 200px" alt=""/> </a> <?php } ?>
                   
                  <!--  <span class="product-new-label">New</span>  
                    <span class="product-discount-label">-%</span> -->
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="<?php echo base_url().'product-list/'.@$my_parent_category_details[0]->unique_name.'/'.$row->unique_name; ?>"><?php echo $row->name;?></a></h3>
                    <div class="price">
                        <!-- <i class="fa fa-inr" aria-hidden="true"></i>  -->
                        <!-- <span>$16.00</span>-->
                    </div>
                    <a class="add-to-cart" href="<?php echo base_url().'product-list/'.@$my_parent_category_details[0]->unique_name.'/'.$row->unique_name; ?>">More</a>
                </div>
            </div>
        
        </div>


                  
                    <?php } ?>
                  

                <?php } else{ ?>







                <?php if(count($product_list)>0){
                    foreach($product_list as $row){
                  ?>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 pl-1 pr-1 mb-4">
                    
            <div class="product-grid4">
                <div class="product-image4">
                   <?php  if($row->product_image !=''){ ?> <a href="<?php echo base_url();?>product-details/<?php echo $row->product_id;?>/<?php echo $row->unique_key;?>"><img class="pic-1" src="<?php echo base_url();?>uploads/product/small/<?php echo $row->product_image;?>" alt=""/> </a> <?php } ?>
                   
                  <?php  $valid_datetime =  date("Y-m-d H:i:s", strtotime("$row->added_date+2 days")); 

                 // echo $valid_datetime; 

            $current_date     =   date('Y-m-d H:i:s');
            $time1          =   strtotime($current_date);
            $time2          =   strtotime(@$valid_datetime);
           // $time2 = strtotime('2020-10-05 13:00:00');
           // $interval=$time1-$time2;
            $interval=$time2-$time1;
            if($interval >0){

                   ?>  <span class="product-new-label">New</span>  <?php } ?>
                    <!-- <span class="product-discount-label"> -->

                      <?php
                    if($row->product_type=='simple'){ 
                    $discouont= ((($row->product_regular_price-$row->product_price)*100)/$row->product_regular_price);
                      }else{

                        $product_variable_attribute=  $this->common_my_model->common($table_name ='product_variable_attribute', $field = array(), $where = array('product_id'=>@$row->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = ''); 
                        $product_variable_attribute_last=  $this->common_my_model->common($table_name ='product_variable_attribute', $field = array(), $where = array('product_id'=>@$row->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array('variable_attribute_id'=>'desc'), $start = '', $end = '');       

                         $discouont= (((@$product_variable_attribute[0]->product_regular_price-@$product_variable_attribute[0]->product_price)*100)/@$product_variable_attribute[0]->product_regular_price);
                          
                      }

                     // echo round($discouont);
                    ?>
                      
                    <!-- </span> -->
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="<?php echo base_url();?>product-details/<?php echo $row->product_id;?>/<?php echo $row->unique_key;?>"><?php echo $row->product_title;?></a></h3>
                    <div class="price">
                        <i class="fa fa-inr" aria-hidden="true"></i> <?php if($row->product_type=='simple'){  echo $row->product_price; } else{ echo @$product_variable_attribute[0]->product_price.' - <i class="fa fa-inr" aria-hidden="true"></i>'.@$product_variable_attribute_last[0]->product_price; }?>
                        <!-- <span>$16.00</span>-->
                    </div>
                    <a class="add-to-cart" href="<?php echo base_url();?>product-details/<?php echo $row->product_id;?>/<?php echo $row->unique_key;?>">ADD TO CART</a>
                </div>
            </div>
        
        </div>

         <?php } } else{ echo '<h1>No Products Found.</h1>'; } ?>

       <?php } ?>


     



        
        <div class="col-md-12 mt-3 mb-3">
        <!-- <ul class="pagination pagination-center">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item active"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul> -->
  <?php echo @$links; ?>

        </div>
    </div>
</div>
        </div>
        </div>
   </div>
</div>

<!-- Body