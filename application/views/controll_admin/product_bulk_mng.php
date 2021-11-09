<?php $this->load->view('controll_admin/common/header'); ?>
<?php $data['mainpage'] ='product';?>
<?php $this->load->view('controll_admin/common/menu',$data); ?>


   <?php if($this->session->flashdata('auth_msg')){ ?>
   <div class="alert alert-success"><?php echo $this->session->flashdata('auth_msg');?></div>
   <?php } ?>
   
   
   
<div class="main">
	
	<div class="main-inner">

	    <div class="container">
	
	      <div class="row">
           <?php if(validation_errors()) { ?>
   <div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <?php echo validation_errors(); ?> </div>
   <?php } ?>
   <?php if($this->session->flashdata('succ_msg')){ ?>
   <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <?php echo $this->session->flashdata('succ_msg');; ?> </div>
   <?php } ?>
     
      <?php /*?><div class="span12">
          <div class="widget ">
            <div class="widget-header"> <i class="icon-shopping-cart"></i>
              <h3>Filter & sorting</h3>
            </div>
            <!-- /widget-header -->
            
            <div class="widget-content">
            <form id="sortfilter" name="sortfilter" method="get">
              <h3>Sort by</h3>
              <div class="span12 ML0">
                <div class="control-group">
                  <div class="controls">
                    <select class="span4" id="sort_by" name="sort_by" >
                      <option value="lot_no">Lot No</option>
                      <option value="design_no">Design No</option>
                      <option value="item_name">Item Name</option>
                    </select>
                    <button type="submit" class="btn btn-primary product_list_btn">Go</button>
                    &nbsp; </div>
                  <!-- /controls --> 
                </div>
                <!-- /control-group --> 
               
              </div>
              <h3>Filter</h3>
              <div class="span4 ML0">
                <div class="control-group">
                  <label class="control-label">Item SubGroup</label>
                  <div class="controls">
                    <select class="span4" id="item_subgroup_GUID" name="item_subgroup_GUID" onChange="change_dependable('item_subgroup_GUID','item_GUID','item_master','item_GUID','item_name','item_subgroup_GUID','','Item Name')">
                      <option value="">Item SubGroup</option>
                      
                    </select>
                    &nbsp; </div>
                  <!-- /controls --> 
                </div>
                <!-- /control-group -->
                
                <div class="control-group">
                  <label class="control-label" for="stonegroup_name">Item Name</label>
                  <div class="controls">
                    <select class="span4" id="item_GUID" name="item_GUID">
                      <option value="">Item Name</option>
                      
                    </select>
                    &nbsp; </div>
                  <!-- /controls --> 
                </div>
                <!-- /control-group -->
                
                <div class="control-group">
                  <label class="control-label" for="stonegroup_name">Item Category</label>
                  <div class="controls">
                    <select class="span4" id="category_GUID" name="category_GUID">
                      <option value="">Item Category</option>
                      
                    </select>
                    &nbsp; </div>
                  <!-- /controls --> 
                </div>
                <!-- /control-group --> 
                
                  <div class="control-group">
                  <label class="control-label">Item Style</label>
                  <div class="controls">
                    <select class="span4" id="style_GUID" name="style_GUID">
                      <option value="">Item Style</option>
                      
                    </select>
                    &nbsp; </div>
                  <!-- /controls --> 
                </div>
                <!-- /control-group -->
              </div>
              
              <div class="span4 margin_left_15">
              
                
                <div class="control-group">
                  <label class="control-label">Item Size</label>
                  <div class="controls">
                    <select class="span4" id="size_GUID" name="size_GUID">
                      <option value="">Item Size</option>
                      
                    </select>
                    &nbsp; </div>
                  <!-- /controls --> 
                </div>
                <!-- /control-group -->
                
                <div class="control-group">
                  <label class="control-label">Item Weight</label>
                  <div class="controls">
                    <select class="span4" id="weight_GUID" name="weight_GUID">
                      <option value="">Item Weight</option>
                      
                    </select>
                    &nbsp; </div>
                  <!-- /controls --> 
                </div>
                <!-- /control-group --> 
                
                <div class="control-group">
                  <label class="control-label" for=" stonegroup_name">Status</label>
                  <div class="controls">
                    <select class="span4" id="is_disabled" name="is_disabled" >
                    <option value="all">All</option>
                      <option value="0">Enable</option>
                      <option value="1">Disable</option>
                    </select>
                    &nbsp; </div>
                  <!-- /controls --> 
                </div>
                <!-- /control-group --> 
                
                 <div class="control-group">
                  <label class="control-label" for=" stonegroup_name">Coll. Type</label>
                  <div class="controls">
                    <select class="span4" id="is_general_or_collection" name="is_general_or_collection" >
                    <option value="">All</option>
                      <option value="general">General</option>
                      <option value="collection">Collection</option>
                    </select>
                    &nbsp; </div>
                  <!-- /controls --> 
                </div>
                <!-- /control-group -->
                
              </div>
              
              <div class="span4 margin_left_15">
                 <div class="control-group">
                  <label class="control-label" for=" stonegroup_name">Stock Status</label>
                  <div class="controls">
                    <select class="span4" id="out_of_stock" name="out_of_stock" >
                    <option value="">All</option>
                      <option value="0">In Stock</option>
                      <option value="1">Out Of Stock</option>
                    </select>
                    &nbsp; </div>
                  <!-- /controls --> 
                </div>
                <!-- /control-group --> 
               
                <div class="control-group">
                  <label class="control-label" for=" stonegroup_name">Price Type</label>
                  <div class="controls">
                    <select class="span4" id="is_price_type" name="is_price_type" onChange="open_price_range_group()" >
                    <option value="">All</option>
                      <option value="calculated">Calculated</option>
                      <option value="variable">Variable</option>
                      <option value="estimated">Estimated</option>
                    </select>
                    &nbsp; </div>
                  <!-- /controls --> 
                </div>
                <!-- /control-group -->
                <div class="control-group" id="price_range_group" >
                  <label class="control-label" for="stonegroup_name">Price Range</label>
                  <div class="controls">
                    <input type="text" class="amount_2_decimal span1_mod" id="price_from" name="price_from" placeholder="From" value="" >
                    -
                    <input type="text" class="amount_2_decimal span1_mod" id="price_to" name="price_to" placeholder="To" value="" >
                  </div>
                  <!-- /controls --> 
                </div>
                
                <!-- /form-actions --> 
                <div class="control-btn">
                	<button type="submit" class="btn btn-primary">Search</button>
             	 	<a href="product_list.php" class="btn btn-warning">Reset</a>
              	</div>
              
              </div>
              
              
             </form>
            </div>
            <!-- /widget-content --> 
            
          </div>
          <!-- /widget --> 
          
          <!-- /form-actions --> 
          
        </div><?php */?>
        
        <div class="span12 stone_details" id="stone_details">
          <div class="widget ">
            <div class="widget-header "> <i class="icon-list-ol"></i>
              <h3>Product List</h3>
              <div class="pull-right"> </div>
            </div>
            <!-- /widget-header -->
            
            <div class="widget-content panel-collapse collapse in" id="stone_details_area">
              <div class="table-responsive prolistmysec">
              
              <form method="post">
              <button type="submit" class="btn btn-primary pro_bulk_mng_update_btn">Update</button>
                <table class="table-condensed table-striped dataTables_filter" id="table_of_list">
                  <thead>
                    <tr>
                      <th class="span1">Sl No.</th>
                      <th class="span2">Image</th>
                      <th class="span5">Title</th>
                      <th class="span5">Price Per Unit </th>
                      <th class="span5">Unit</th>
                     <th class="span6"><select id="what_to_edit" name="what_to_edit" onChange="change_field()"><option value="" <?=$what_to_edit==''?'selected':''?>>Select to Edit</option>

                       <option value="product_price" <?=$what_to_edit=='product_price'?'selected':''?>>Price</option>

                       <option value="stock_count" <?=$what_to_edit=='stock_count'?'selected':''?>>Quantity</option>

                      </select></th>
                      
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th class="span1">Sl No.</th>
                      <th class="span2">Image</th>
                      <th class="span5">Title</th>
                      <th class="span5">Price Per Unit </th>
                      <th class="span5">Unit</th>
                     <th class="span6"></th>
                    </tr>
                  </tfoot>
                  <tbody id="stone_area">
                    <?php
					$count = 0;
					$search = array();
					if(!empty($products))
					{ 
					foreach($products as $product)
					{
						$count++;
						?>
                    <tr>
                      <td><?=$count?></td>
                      <td><img src="<?php echo $product->product_image==''?base_url().'assets/images/default_img.jpg':base_url().'uploads/'.$product->product_image;?>" title="" alt="User Image" style="height:50px; width:50px;"/></td>
                      <td><?=$product->product_title_eng==''?'':$product->product_title_eng?>
                      <?=$product->product_title_hin==''?'':'<br>'.$product->product_title_hin?>
                      <?=$product->product_title_ben==''?'':'<br>'.$product->product_title_ben?></td>
                      <td>INR : <?=$product->product_price_inr?><br />
                      USD : <?=$product->product_price_usd?></td>
                      <td><?=$product->stock_count?> <?=$product->product_unit?></td>
                      
                      
                      <td class="span4 pro_bulk_disabl_chk">

<input type="hidden" value="<?=$product->product_id?>" name="product_GUID[]">

<span class="what_to_edit_area _area" <?=$what_to_edit==''?'':'style="display:none;"'?>>Not Selected</span>

<span class="what_to_edit_area stock_count_area" <?=$what_to_edit=='stock_count'?'':'style="display:none;"'?>><div class="control-group form-horizontal form-horizontal1">

											<label class="control-label" for="stonegroup_name">Quantity</label>

											<div class="controls">



												<input type="text" class="amount_2_decimal span1_mod" id="stock_count_<?=$product->product_id?>" name="stock_count_<?=$product->product_id?>" placeholder="stock_count"  value="<?=$product->stock_count?>">
                                               

											</div> <!-- /controls -->

										</div></span>

<span class="what_to_edit_area product_price_area" <?=$what_to_edit=='product_price'?'':'style="display:none;"'?>><div class="control-group form-horizontal form-horizontal1">

											<label class="control-label" for="stonegroup_name">INR</label>

											<div class="controls">



												 <input type="text" class="amount_2_decimal span1_mod" id="product_price_inr_<?=$product->product_id?>" name="product_price_inr_<?=$product->product_id?>" placeholder="INR"  value="<?=$product->product_price_inr?>">
                                              
											</div> <!-- /controls -->
                                            
                                            
                                            <label class="control-label" for="stonegroup_name">USD</label>

											<div class="controls">


<input type="text" class="amount_2_decimal span1_mod" id="product_price_usd_<?=$product->product_id?>" name="product_price_usd_<?=$product->product_id?>" placeholder="USD"  value="<?=$product->product_price_usd?>">

											</div> <!-- /controls -->

										</div></span>







</td>
                      
                    </tr>
                    <?php
										}
							}
										?>
                  </tbody>
                </table>
                
              </form>
              </div>
            </div>
            <!-- /widget-content --> 
            
          </div>
          <!-- /widget --> 
          
        </div>
       		
            
	      
	      	

	      	
	      </div> <!-- /row -->
	
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> 
    
    

<?php $this->load->view('controll_admin/common/footer'); ?>

<script type="application/javascript">   


$(document).ready(function() {

	$(".edit_button").click(function(){
	//alert();
	$('#submit_value').val('edit');
	$('#submit_send_value').val($(this).attr('id'));
	$('#allform').submit();
	});
	$(".delete_button").click(function(){
	//alert();
	if(confirm("Are You sure You want to delete!"))
	{
	$('#submit_value').val('delete');
	$('#submit_send_value').val($(this).attr('id'));
	$('#allform').submit();
	}
	});
	
	table = $('#table_of_list').DataTable({

        "paging":   true,

		"pageLength": 100,

		"lengthMenu": [[10,25,50,100, 250, 500, -1], [10,25,50,100, 250, 500, "All"]],

		"stateSave": true,

        "ordering": false,

        "info":     false,

		"language": {

			"lengthMenu": "Show no. of Entries in a Grid:  _MENU_ ",

			"sSearch": "Enter keyword to Search: ",



  },

   			});

	$( table.table().container() ).on( 'keyup', 'tfoot input', function () {

        table

            .column( $(this).data('index') )

            .search( this.value )

            .draw();

    } );
});

function change_field()

	   {

		$('.what_to_edit_area').css('display','none'); 

		$('.'+$('#what_to_edit').val() +'_area').css('display','block');  

	   }

    </script>