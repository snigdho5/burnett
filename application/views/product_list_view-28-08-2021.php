<!--Body -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<div class="container-fluid">
  <div class="container">
    <div class="row">
      <div class="col-md-3 pl-0 pr-0 home_side_bar mt-5 mb-5">
        <div class="col-md-12 cat_hd"> Categories </div>
        <div class="col-md-12 home_cat_list">
          <ul>
            <?php  if(count(@$category_list)>0){ foreach($category_list as $row){?>
            <li><a href="<?php echo base_url().'product-list/'.strtolower($row->unique_name); ?>"><i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $row->name;?></a>
              <?php 

  $sub_category_list=$this->common_my_model->common($table_name ='category', $field = array(), $where = array('parent_id'=>@$row->cat_id,'status'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

if(count(@$sub_category_list)>0){  ?>
              <ul>
                <?php   foreach($sub_category_list as $subcatrow){

                      $my_parent_category_details=  $this->common_my_model->common($table_name ='category', $field = array(), $where = array('cat_id'=>@$subcatrow->parent_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = ''); ?>
                <li><a href="<?php echo base_url().'product-list/'.@$my_parent_category_details[0]->unique_name.'/'.strtolower($subcatrow->unique_name); ?>"> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $subcatrow->name;?></a></li>
                <?php } ?>
              </ul>
              <?php } ?>
            </li>
            <?php } } else{ echo '<li>No Category Found.</li>'; }?>
            
            <!-- <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Children</a></li>
            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>  Digestive Problem</a></li>
            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>  Female</a></li>
            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>  Fever &amp; General</a></li>
            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>  Joint &amp; Muscles</a></li>
            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>  Lifestyle Diseases</a></li>
            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>  Respiratory Diseases</a></li>
            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>  Skin Diseases</a></li>  -->
            
          </ul>
          
          <!-- <ul id="myUL">

             




<?php  if(count(@$category_list)>0){ foreach($category_list as $row){?><li><span class="caret"><?php echo $row->name;?></span>

   

                  
                    
<?php 

$sub_category_list=$this->common_my_model->common($table_name ='category', $field = array(), $where = array('parent_id'=>@$row->cat_id,'status'=>'1'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

if(count(@$sub_category_list)>0){  ?>
<ul class="nested">
  <?php   foreach($sub_category_list as $subcatrow){

                      $my_parent_category_details=  $this->common_my_model->common($table_name ='category', $field = array(), $where = array('cat_id'=>@$subcatrow->parent_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = ''); ?>
<li><a href="<?php echo base_url().'product-list/'.@$my_parent_category_details[0]->unique_name.'/'.$subcatrow->unique_name; ?>"> <?php echo $subcatrow->name;?></a></li>
<?php } ?>

<li><span class="caret">Tea</span>
<ul class="nested">
<li>Black Tea</li>
<li>White Tea</li>
<li><span class="caret">Green Tea</span>
<ul class="nested">
<li>Sencha</li>
<li>Gyokuro</li>
<li>Matcha</li>
<li>Pi Lo Chun</li>
</ul>
</li>
</ul>
</li>

</ul>
<?php } ?>
</li>
<?php } } else{ echo '<li>No Category Found.</li>'; }?>
</ul> --> 
          
        </div>
        <!--<div class="col-md-12 cat_hd">Brand</div>
        <div class="col-md-12 home_cat_list">
          <div class="filter-content">
            <div class="card-body">
              <form>
                <?php foreach($brand_list as $row){?>
                <label class="form-check">
                  <input class="form-check-input" onclick="product_filter();" type="checkbox" name="brand_id" id="brand_id" value="<?php echo $row->brand_id;?>">
                  <span class="form-check-label"> <?php echo $row->name;?> </span> </label>
                <?php } ?>
              </form>
            </div>
          </div>
        </div>-->
		
        <div class="col-md-12 cat_hd">Price</div>
        <div class="col-md-12 home_cat_list">
          <div class="filter-content">
            <div class="card-body">
              <label class="form-check">
                <input class="form-check-input" type="radio" onclick="product_filter();" name="price_range" id="price_range" value="0-50">
                <span class="form-check-label"> 0-50 </span> </label>
              <label class="form-check">
                <input class="form-check-input" type="radio" onclick="product_filter();" name="price_range" id="price_range" value="50-100">
                <span class="form-check-label"> 50-100 </span> </label>
              <label class="form-check">
                <input class="form-check-input" type="radio" onclick="product_filter();" name="price_range" id="price_range" value="100-200">
                <span class="form-check-label"> 100-200 </span> </label>
              <label class="form-check">
                <input class="form-check-input" type="radio" onclick="product_filter();" name="price_range" id="price_range" value="200-300">
                <span class="form-check-label"> 200-300 </span> </label>
            </div>
            <!-- card-body.// --> 
          </div>
        </div>
        <div class="col-md-12 cat_hd">Order By Price</div>
        <div class="col-md-12 home_cat_list">
          <div class="filter-content">
            <div class="card-body">
              <label class="form-check">
                <input class="form-check-input" type="radio" onclick="product_filter();" name="orderbyprice" id="orderbyprice" value="asc">
                <span class="form-check-label"> Low To High </span> </label>
              <label class="form-check">
                <input class="form-check-input" type="radio" onclick="product_filter();" name="orderbyprice" id="orderbyprice" value="desc">
                <span class="form-check-label"> High To Low </span> </label>
            </div>
            <!-- card-body.// --> 
          </div>
        </div>
      </div>
      <div class="col-md-9 home_featured  mt-5">
      <?php
		$signup_success = $this->session->flashdata('cart_info');
		if($signup_success!=""){ ?>
		<div class="alert top-alert-success">
		<?php echo $signup_success;?> </div>
		<?php }	?>
        <h4>Products List</h4>
        <?php

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
        <?php /*?><div class="container">
          <div class="row pt-4 mb-5" id="">
            <?php if(count($product_list)>0){
                    foreach($product_list as $row){
                  ?>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 pl-1 pr-1 mb-4">
              <div class="product-grid4">
                <div class="product-image4">
                  <?php  if($row->product_image !=''){ ?>
                  <a href="<?php echo base_url();?>product-details/<?php echo $row->product_id;?>/<?php echo $row->unique_key;?>"><img class="pic-1" src="<?php echo base_url();?>uploads/product/small/<?php echo $row->product_image;?>" alt=""/> </a>
                  <?php } ?>
                  <?php  $valid_datetime =  date("Y-m-d H:i:s", strtotime("$row->added_date+2 days")); 

                 // echo $valid_datetime; 

            $current_date     =   date('Y-m-d H:i:s');
            $time1          =   strtotime($current_date);
            $time2          =   strtotime(@$valid_datetime);
           // $time2 = strtotime('2020-10-05 13:00:00');
           // $interval=$time1-$time2;
            $interval=$time2-$time1;
            if($interval >0){

                   ?>
                  <span class="product-new-label">New</span>
                  <?php } ?>
                  <!-- <span class="product-discount-label"> -->
                  
                  <?php
                    if($row->product_type=='simple'){ 
                    $discouont= ((($row->product_regular_price-$row->product_price)*100)/$row->product_regular_price);
                      }else{

                        $product_variable_attribute=  $this->common_my_model->common($table_name ='product_variable_attribute', $field = array(), $where = array('product_id'=>@$row->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
						 echo '<pre>'; print_r($product_variable_attribute); echo '</pre>';
                        $product_variable_attribute_last=  $this->common_my_model->common($table_name ='product_variable_attribute', $field = array(), $where = array('product_id'=>@$row->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array('variable_attribute_id'=>'desc'), $start = '', $end = '');       
						//echo '<pre>'; print_r($product_variable_attribute_last); echo '</pre>';
                         $discouont= (((@$product_variable_attribute[0]->product_regular_price-@$product_variable_attribute[0]->product_price)*100)/@$product_variable_attribute[0]->product_regular_price);
                          
                      }

                     // echo round($discouont);
                    ?>
                  
                  <!-- </span> --> 
                </div>
                <div class="product-content">
                  <h3 class="title"><a href="<?php echo base_url();?>product-details/<?php echo $row->product_id;?>/<?php echo $row->unique_key;?>"><?php echo $row->product_title;?></a></h3>
                  <div class="price"> <i class="fa fa-inr" aria-hidden="true"></i>
                    <?php if($row->product_type=='simple'){  echo $row->product_price; } else{ echo @$product_variable_attribute[0]->product_price.' - <i class="fa fa-inr" aria-hidden="true"></i>'.@$product_variable_attribute_last[0]->product_price; }?>
                    <!-- <span>$16.00</span>--> 
                  </div>
                  <a class="add-to-cart" href="<?php echo base_url();?>product-details/<?php echo $row->product_id;?>/<?php echo $row->unique_key;?>">ADD TO CART</a> </div>
              </div>
            </div>
            <?php } } else{ echo '<h1>No Products Found.</h1>'; } ?>
            <div class="col-md-12 mt-3 mb-3"> 
              <!-- <ul class="pagination pagination-center">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item active"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul> --> 
              <?php echo @$links; ?> </div>
          </div>
        </div><?php */?>
        
        <div class="container new_list_div">    
   			<div class="alpha-series">
                        <a href="?key=all" class="first">ALL</a>
                        <a href="?key=a" class="middle">A</a>
                        <a href="?key=b" class="middle">B</a>
                        <a href="?key=c" class="middle">C</a>
                        <a href="?key=d" class="middle">D</a>
                        <a href="?key=e" class="middle">E</a>
                        <a href="?key=f" class="middle">F</a>
                        <a href="?key=g" class="middle">G</a>
                        <a href="?key=h" class="middle">H</a>
                        <a href="?key=i" class="middle">I</a>
                        <a href="?key=j" class="middle">J</a>
                        <a href="?key=k" class="middle">K</a>
                        <a href="?key=l" class="middle">L</a>
                        <a href="?key=m" class="middle">M</a>
                        <a href="?key=n" class="middle">N</a>
                        <a href="?key=o" class="middle">O</a>
                        <a href="?key=p" class="middle">P</a>
                        <a href="?key=q" class="middle">Q</a>
                        <a href="?key=r" class="middle">R</a>
                        <a href="?key=s" class="middle">S</a>
                        <a href="?key=t" class="middle">T</a>
                        <a href="?key=u" class="middle">U</a>
                        <a href="?key=v" class="middle">V</a>
                        <a href="?key=w" class="middle">W</a>
                        <a href="?key=x" class="middle">X</a>
                        <a href="?key=y" class="middle">Y</a>
                        <a href="?key=z" class="last">Z</a>
              </div>
             
             <div class="product_attributes_category">
             <ul id="show_filter_product">
                 <li id="package_heading" class="li_heading" style="">
                            <ul><li class="product-name">Product Name</li><li class="potency">Potency</li><li class="product-price">Price</li><li class="cart-button">Buy Now</li>			
                            </ul>
                        </li>
                 <?php if(count($product_list)>0){
                    foreach($product_list as $row){ //echo "<pre>";print_r($row);?>       
				 <li class="no-heading">
                            <ul>
                                <li class="product-name">
								<div class="screen-resize" style="display: none;">Product Name</div>
								
								<!--<a href="<?php //echo base_url();?>product-details/<?php //echo $row->product_id;?>/<?php //echo $row->unique_key;?>" onclick="#"><?php //echo $row->product_title;?></a>-->
								
								<a href="<?php echo base_url();?>product-details/<?php echo $row->unique_key;?>" onclick="#"><?php echo $row->product_title;?></a>
								
								</li>
                                <li class="potency">
								<div class="screen-resize" style="display: none;">Potency</div>
								<select name="ddlsizebox" id="ddlsize_<?php echo $row->product_id;?>" onchange="">  
                                <?php
                    if($row->product_type=='simple'){ 
                    	echo '<option value="">&nbsp;</option>';
                      }else{

                        $product_variable_attribute=  $this->common_my_model->common($table_name ='product_variable_attribute', $field = array(), $where = array('product_id'=>@$row->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
					  
					  foreach($product_variable_attribute as $pv){
						  $product_att_val=  $this->common_my_model->common($table_name ='product_attribute', $field = array(), $where = array('product_attribute_id'=>@$pv->variation_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
						  echo '<option data-value="'.$pv->product_price.'" data-id="'.$pv->variable_attribute_id.'" value="'.$product_att_val[0]->name.'">Q&nbsp;'.$product_att_val[0]->name.'</option>';
					  }
					  
					  } ?>
                                 </select>
                                </li>
                                <li class="product-price"><div class="screen-resize" style="display: none;">Price</div>Rs. <span id="comb_price_<?php echo $row->product_id;?>">
								<?php if($row->product_type=='simple'){  echo $row->product_price; } else{ echo @$product_variable_attribute[0]->product_price;} ?></span></li>
                                <li class="cart-button"><div class="screen-resize" style="display: none;"></div>
                                <a class="new_list_btn" onclick="productaddtocart('<?php echo $row->product_id;?>');" rel="" href="javascript:void(0);" title="Buy Now">Buy Now</a>
                                 </li>
                            </ul>
                            <form action="<?php echo base_url()?>cart/add" class="display-flex" id="frmaddtocart_<?php echo $row->product_id;?>" method="post">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="id" value="<?php echo $row->product_id;?>">
                            <input type="hidden" name="name" value="<?php echo $row->product_title;?>">
                            <?php if($row->product_type=='variable'){?>
                            <input type="hidden" name="ddlsize" id="ddlsize" value="">
                            <input type="hidden" name="variable_attribute_id" id="variable_attribute_id" value="">
                            <?php }?>
                            </form>
                            
                        </li> 
                        
                 <script type="text/javascript">
				 $("#ddlsize_<?php echo $row->product_id;?>").change(function() {
					  var selectedItem = $(this).val();
					  var abc = $('option:selected',this).data("value");
					  //alert(abc);
					  $("#comb_price_<?php echo $row->product_id;?>").html(abc);
					});
				 </script>       
                 <?php } } else{ echo '<h1>No Products Found.</h1>'; } ?>          
				 
                         
                               
              </ul>
              
              
                          
                    </div>
		</div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

function productaddtocart(pid) {
	var variable_attribute_id =$("#ddlsize_"+pid+" option:selected").attr('data-id');
	//alert(variable_attribute_id);
	
	var size = $( "#ddlsize_"+pid+" option:selected" ).val();
	
	console.log(variable_attribute_id);
	console.log(size);
	
	$('#ddlsize').val(size);
	$('#variable_attribute_id').val(variable_attribute_id);
    $("#frmaddtocart_"+pid).submit();
 }
  
   function product_filter()
{

             var parent_category ="<?php echo @$this->uri->segment(2); ?>"; 
          var sub_category ="<?php echo @$this->uri->segment(3); ?>"; 
          var category ="<?php echo @$this->uri->segment(4); ?>"; 


         // var med_name= $('#pin_search_med_name').val();

        //  alert(med_name);

            var brand_ids =[];

            $.each($("input[name='brand_id']:checked"), function()
            {            
              brand_ids.push($(this).val());
             });

            console.log(brand_ids);


       // var price_range=$('#price_range').val();

      // if($("#price_range").is(":checked")){

       // $("input[type='radio'][name='radio_"+i+"']:checked").val();

       if($('input[name=price_range]').is(":checked")){


        var price_range=$('input[name=price_range]:checked').val();

       }
       else{
        var price_range='0';

       }

       var myarr = price_range.split("-");
        
        var max=myarr[1];
        var min=myarr[0];

        var orderbyprice=$('input[name=orderbyprice]:checked').val();

 

          var html_string='';
          var base_url='<?php echo base_url();?>';
          var user_id='<?php echo $this->session->userdata('user_session_id'); ?>';

        

  //alert(size);

         $.ajax(
            { 
                 type: "POST",
                  dataType:'html',  
                 url:base_url+"product_list/product_filter",
                 data: {parent_category:parent_category,sub_category:sub_category,brand_ids:brand_ids,max:max,min:min,orderbyprice:orderbyprice},
                // async:false,

        success:function(data)
         { // console.log(data);
             $('#show_filter_product').html(data);              
  
      }  
  });





}

</script>