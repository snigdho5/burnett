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
              <h3>Coupon List</h3>
              <div class="pull-right"><a href="coupon/add_view" class="btn btn-success">ADD COUPON</a> </div>
            </div>
            <!-- /widget-header -->


            
            <div class="widget-content panel-collapse collapse in" id="stone_details_area">
              <div class="table-responsive prolistmysec">
                <table class="table-condensed table-striped dataTables_filter" id="table_of_list">
                  <thead>
                    <tr>
                       <th class="span1">Sl No.</th>
                      <th class="span1">Coupon Title.</th>
                      <th class="span2">Coupon Code</th>
                      <th class="span5">Discount Type</th>
                      <th class="span5">Discount</th>
                     <!--  <th class="span5">GST</th>
                     <th class="span5">Unit</th>-->
                      <th class="span5">Applied Amount </th> 
                      <th class="span5">Expire Date</th>
                      <th class="span5">Total Use</th>
                     <th class="span2">Status</th>
                      <th class="span2">Action</th>
                    </tr>
                  </thead>
                  <!--<tfoot>
                    <tr>
                      <th class="span1">Sl No.</th>
                      <th class="span2">Image</th>
                      <th class="span5">Title</th>
                      <th class="span5">Price Per Unit </th>
                      <th class="span5">Unit</th>
                     <th class="span2">Status</th>
                      <th class="span4">Action</th>
                    </tr>
                  </tfoot>-->
                  <tbody id="stone_area">
                    <?php
					$count = 0;
					$search = array();
        //  print_r($products);
					if(!empty($coupons))
					{ 
					foreach($coupons as $row)
					{
						$count++;
						?>
                    <tr>
                      <td><?=$count?></td>
                      <td><?php echo $row->coupon_headline;?></td>
                      <td><?php echo $row->coupon_code;?></td>
                      
                      <td><?php  echo $row->coupon_discount_type;  ?> </td>
                     
                      
                      
                      
                      <td><?php  echo $row->coupon_discount;?></td>
                      <td> <?php  echo $row->coupon_amount; ?></td>
                      <td> <?php  echo $row->coupon_end; ?></td>
                      <td> <?php  echo $row->total_use; ?></td>


                     



                      
                      
                      
                      <td><?php if($row->status=='1')
						{
						?>
                            <a href="coupon/change_status/<?php echo $row->coupon_id.'/0';?>" class="btn btn-success">Active</a>
                        <?php
						}
						else
						{
						?>
							<a href="coupon/change_status/<?php echo $row->coupon_id.'/1';?>" class="btn btn-danger">Disable</a>
                        <?php
						}
						?></td>
                      <td class="span4"><!--<a href="#" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>&nbsp; &nbsp;--><a title="delete"  href="coupon/delete/<?php echo $row->coupon_id;?>" id="del"  onclick="return confirm('Are you sure ?')" class="btn btn-danger delete_button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>&nbsp;&nbsp;<a title="Edit" href="coupon/edit_view/<?php echo $row->coupon_id;?>" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>

                      


                      
                        <!--<br>
                        <a href="user/view_details/<?php //echo $product->user_GUID;?>" class="btn btn-warning"><span class="icon-large icon-question-sign
" aria-hidden="true"></span></a>--></td>
                    </tr>
                    <?php
										}
							}
										?>
                  </tbody>
                </table>
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
	
 //  $(".delete_button").click(function(){
	
	// if(confirm("Are You sure You want to delete!"))
	// {
	// $('#submit_value').val('delete');
	// $('#submit_send_value').val($(this).attr('id'));
	// $('#allform').submit();
	// }
	// });
	
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
    </script>