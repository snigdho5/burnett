<!-- Body -->
<?php //echo '<pre>'; print_r($product_details); echo '</pre>';?>
<div class="container-fluid">
    <div class="container pt-5 pb-5">
	<?php
	$signup_success = $this->session->flashdata('cart_info');
	if($signup_success!=""){ ?>
    <div class="alert top-alert-success">
    <?php echo $signup_success;?> </div>
    <?php }	?>
    <div class="row">
                <div class="col-md-6">
                    <div id="slider" class="owl-carousel product-slider">
                        
                     <?php foreach($product_details_image as $key=>$row_image){?>
                        
                        
                           <?php if($key=='0'){ ?> 
                            <div class="item imagebig1">
                            <img data-toggle="magnify" src="<?php echo base_url();?>uploads/product/small/<?php echo $row_image->product_image;?>" /></div>
                        <?php } else{ ?>
                            <div class="item imagebig1">
                            <img src="<?php echo base_url();?>uploads/product/small/<?php echo $row_image->product_image;?>" /></div>
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

                         <?php foreach($product_details_image as $key=>$row_image){?>
                        <div class="item">
                            <img src="<?php echo base_url();?>uploads/product/small/<?php echo $row_image->product_image;?>" />
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
                <div class="col-md-6">
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
                    if($product_details[0]->product_type=='simple'){ 
                    $discouont= ((($product_details[0]->product_regular_price-$product_details[0]->product_price)*100)/$product_details[0]->product_regular_price);
                      }else{

                        $product_variable_attribute=  $this->common_my_model->common($table_name ='product_variable_attribute', $field = array(), $where = array('product_id'=>@$product_details[0]->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = ''); 
                        $product_variable_attribute_last=  $this->common_my_model->common($table_name ='product_variable_attribute', $field = array(), $where = array('product_id'=>@$product_details[0]->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array('variable_attribute_id'=>'desc'), $start = '', $end = '');       

                         $discouont= ((($product_variable_attribute[0]->product_regular_price-$product_variable_attribute[0]->product_price)*100)/$product_variable_attribute[0]->product_regular_price);
                          
                      }

                      // echo $discouont;
                    ?>


                            <div class="product-price-discount"><span><?php if($product_details[0]->product_type=='simple'){  echo '<i class="fa fa-inr" aria-hidden="true"></i>'.$product_details[0]->product_price; } else{ echo '<i class="fa fa-inr" aria-hidden="true"></i>'.$product_variable_attribute[0]->product_price.' - <i class="fa fa-inr" aria-hidden="true"></i>'.$product_variable_attribute_last[0]->product_price; }?></span><span class="line-through"></span></div>
                        </div>
                        <p><?php echo @$brand_details[0]->name; ?></p>
                        <div class="row">
                           

                            <div class="col-md-6">
                              <?php if($product_details[0]->product_type=='variable'){ ?>  <label for="size">Size</label>
                                <select id="size" name="size" onchange="change_size();" class="form-control">
                                    <?php 

                                    foreach($control_product_variable_attribute as $row){
                                        $product_attribute=$this->common_my_model->common($table_name = 'product_attribute', $field = array(), $where = array('product_attribute_id'=>@$row->variation_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
                                    ?>
                                    <option value="<?php echo @$row->variable_attribute_id; ?>"><?php echo @$product_attribute[0]->name; ?></option>
                                <?php } ?>
                                   
                                </select> <?php } ?>
                            </div>




                            <div class="col-md-6">
                                &nbsp;
                            </div>
                            <div class="col-md-6">
                            <div class="product-price-discount" id="show_size_price"><span><?php if($product_details[0]->product_type=='simple'){  echo '<i class="fa fa-inr" aria-hidden="true"></i>'.$product_details[0]->product_price; } else{ echo '<i class="fa fa-inr" aria-hidden="true"></i>'.$product_variable_attribute[0]->product_price; }?></span></div>
                            </div>
                        </div>
                        <div class="product-count">
                            <label for="size">Quantity</label>
                            <form action="<?php echo base_url()?>cart/add" class="display-flex" id="frmaddtocart" method="post">
                                <div class="qtyminus">-</div>
                                <input type="text" name="quantity" value="1" class="qty">
                                <div class="qtyplus">+</div>
                                <input type="hidden" name="id" value="<?php echo $product_details[0]->product_id;?>">
                                <input type="hidden" name="name" value="<?php echo $product_details[0]->product_title;?>">
                                <input type="hidden" name="unique_key" value="<?php echo $product_details[0]->unique_key;?>">
                                <input type="hidden" name="category_id" value="<?php echo $product_details[0]->category_id;?>">
                                <input type="hidden" name="ddlsize" id="ddlsize" value="">
                                <input type="hidden" name="variable_attribute_id" id="variable_attribute_id" value="">
                            </form>
                                
                                <a href="javascript:void(0);" class="round-black-btn" id="btnaddtocart" onClick="submitDetailsForm()">Add to Cart</a>
                                <!--<input type="submit" class="round-black-btn" value="Add to Cart" />-->
                            
                            <a href="#" onclick="wishlist('<?php echo $this->uri->segment(2); ?>');" class="round-black-btn">Add to Wishlist</a>
                        </div>
                    </div>
                </div>
            </div>
             <small><?php
            $succ_message=$this->session->flashdata('succ');
            if($succ_message){
              ?>
              <br><span style="color:green;font-size:20px">
                <?php echo $succ_message; ?>
              </span>
              <?php
              }
              ?></small>

              <small><?php
            $err_message=$this->session->flashdata('exist');
            if($err_message){
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
                        <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" id="review-tab" data-toggle="tab" href="#additional-information" role="tab" aria-controls="review" aria-selected="false">Additional information</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews (<?php echo count($product_review_count);?>)</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                       <?php echo $product_details[0]->product_description; ?>
                    </div>
                    <div class="tab-pane fade" id="additional-information" role="tabpanel" aria-labelledby="additional-information">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.
                    </div>
                    <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                        <div class="review-heading">REVIEWS</div>
                        <p class="mb-20">There are no reviews yet.</p>
                        <form class="review-form" id="cu_registration_form" action="<?php echo base_url();?>product_details/product_review_submit" method="post" enctype="multipart/form-data">
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
                                <input type="hidden" name="product_hidden_id" id="product_hidden_id" class="form-control" placeholder="" value="<?php echo $this->uri->segment(2);?>">
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
                </div>
            </div>









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










   </div>
</div>

<!-- Body --->

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript">
function submitDetailsForm() {
	var variable_attribute_id =$('#size').val();
	var size = $( "#size option:selected" ).text();
	//alert(variable_attribute_id);
	//alert(size);
	$('#ddlsize').val(size);
	$('#variable_attribute_id').val(variable_attribute_id);
       $("#frmaddtocart").submit();
    }

function cu_data_Submit_fm()
{
        var name=$("#name").val();       
        if (name=="") 
        {
            $('#name').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#name').removeClass('red_border').addClass('black_border');               
        }

          var email_id=$("#email_id").val();       
        if (!isEmail(email_id)) 
        {
            $('#email_id').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#email_id').removeClass('red_border').addClass('black_border');               
        }

         var message=$("#message").val();       
        if (message=="") 
        {
            $('#message').removeClass('black_border').addClass('red_border');
        } 
        else 
        {
            $('#message').removeClass('red_border').addClass('black_border');               
        }



       


}

function form_validation()
  {
   

        $('#cu_registration_form').attr('onchange', 'cu_data_Submit_fm()');
        $('#cu_registration_form').attr('onkeypress', 'cu_data_Submit_fm()');

        cu_data_Submit_fm();

      //  alert($('#user_registration_form_id .red_border').size());

        if ($('#cu_registration_form .red_border').length > 0)
        {

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

    function wishlist(product_id)
{

 

          var html_string='';
          var base_url='<?php echo base_url();?>';
          var user_id='<?php echo $this->session->userdata('user_session_id'); ?>';

          if(user_id !='')
      {



         $.ajax(
            { 
                 type: "POST",
                  dataType:'json',  
                 url:base_url+"Wishlist/add_to_wishlist",
                 data: {product_id:product_id,user_id:user_id},
                // async:false,

        success:function(data)
         { 
            if(data.status=='success')
           alert(data.message);              
  
      }  
  });

}
else {
    alert('Please login first.');
    window.location.href = '<?php echo base_url().'user-registation'; ?>';
   // window.location.href("<?php echo base_url().'user-registation'; ?>");
}



}

    

</script>


<script type="text/javascript">

    function change_size()
{

 

          var html_string='';
          var base_url='<?php echo base_url();?>';
          var user_id='<?php echo $this->session->userdata('user_session_id'); ?>';

         var variable_attribute_id =$('#size').val();
		 var size = $( "#size option:selected" ).text();

  //alert(size);

         $.ajax(
            { 
                 type: "POST",
                  dataType:'json',  
                 url:base_url+"product_details/change_size",
                 data: {variable_attribute_id:variable_attribute_id},
                // async:false,

        success:function(data)
         { console.log(data);
             $('#show_size_price').html('<span><i class="fa fa-inr" aria-hidden="true"></i>'+data.price+'</span>');              
  
      }  
  });





}
$(".qtyminus").on("click",function(){
                var now = $(".qty").val();
                if ($.isNumeric(now)){
                    if (parseInt(now) -1> 0)
                    { now--;}
                    $(".qty").val(now);
                }
            })            
$(".qtyplus").on("click",function(){
                var now = $(".qty").val();
                if ($.isNumeric(now)){
                    $(".qty").val(parseInt(now)+1);
                }
            });
    

</script>


