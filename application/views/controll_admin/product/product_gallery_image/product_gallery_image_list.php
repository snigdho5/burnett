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
     
      
        
        <div class="span12 stone_details" id="stone_details">
          <div class="widget ">
            <div class="widget-header "> <i class="icon-list-ol"></i>
              <h3>Product Image List</h3>
              <div class="pull-right"><a href="<?php echo base_url().BaseAdminURl; ?>/product_gallery_image/add_view/<?php echo $this->uri->segment(4); ?>" class="btn btn-success">ADD PRODUCT IMAGE</a> </div>
            </div>
            <!-- /widget-header -->


            
            <div class="widget-content panel-collapse collapse in" id="stone_details_area">
              <div class="table-responsive prolistmysec">
                <table class="table-condensed table-striped dataTables_filter" id="table_of_list">
                  <thead>
                    <tr>
                      <th class="span1">Sl No.</th>
                     
                      <th class="span5">Product Name</th>
                      <th class="span5">Image</th>
                    
                      
                     <!-- <th class="span2">Status</th> -->
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
					if(!empty($data_list))
					{ 
					foreach($data_list as $product)
					{
						$count++;
						?>
                    <tr>
                      <td><?=$count?></td>
                     
                      <td><?php

                      $product_details = $this->common_my_model->common($table_name ='product', $field = array(), $where = array('product_id'=>$product->product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

                      echo $product_details[0]->product_title;?></td>
                      
                       <td><img src="<?php echo $product->product_image==''?base_url().'assets/images/default_img.jpg':base_url().'uploads/product/'.$product->product_image;?>" title="" alt="User Image" style="height:50px; width:50px;"/></td>
                     
                      
                      
                      
                      
                      <td class="span4"><!--<a href="#" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>&nbsp; &nbsp;--><a  href="<?php echo base_url().BaseAdminURl.'/';?>product_gallery_image/delete/<?php echo $product->product_image_id;?>/<?php echo $this->uri->segment(4); ?>" id="del"  onclick="return confirm('Are you sure ?')" class="btn btn-danger delete_button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>&nbsp;&nbsp;<a href="<?php echo base_url().BaseAdminURl.'/';?>product_gallery_image/edit_view/<?php echo $product->product_image_id;?>/<?php echo $this->uri->segment(4); ?>" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>


                      
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