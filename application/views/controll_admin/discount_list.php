<?php $this->load->view('controll_admin/common/header'); ?>
<?php $data['mainpage'] ='user';?>
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
              <h3>User Discount List</h3>
              <div class="pull-right"><a href="<?php echo base_url().BaseAdminURl.'/';?>user/add_discount/<?php echo @$this->uri->segment(4);?>" class="btn btn-success">ADD DISCOUNT</a> </div>
            </div>
            <!-- /widget-header -->


            
            <div class="widget-content panel-collapse collapse in" id="stone_details_area">
              <div class="table-responsive prolistmysec">
                <table class="table-condensed table-striped dataTables_filter" id="table_of_list">
                  <thead>
                    <tr>
                       <th class="span1">Sl No.</th>
                      <th class="span5">Discount Type</th>
                      <th class="span5">Discount</th>
                      <th class="span5">Expire Date</th>
                      <th class="span5">Total Use</th>
                      <!-- <th class="span2">Status</th>
                      <th class="span2">Action</th> -->
                    </tr>
                  </thead>
                  <tbody id="stone_area">
                    <?php
					$count = 0;
					$search = array();
					if(!empty($discount_details))
					{ 
					foreach($discount_details as $row)
					{
						$count++;
						?>
                    <tr>
                      <td><?=$count?></td>
                      <td><?php  echo $row->discount_type;  ?> </td>
                      <td><?php  echo $row->discount_amount;?></td>
                      <td> <?php  echo $row->exp_date; ?></td>
                      <td> <?php  echo $row->total_use; ?></td>
                      
                      <!-- <td><?php if($row->status=='1')
						{
						?>
                            <a href="coupon/change_status/<?php echo $row->discount_id.'/0';?>" class="btn btn-success">Active</a>
                        <?php
						}
						else
						{
						?>
							<a href="coupon/change_status/<?php echo $row->discount_id.'/1';?>" class="btn btn-danger">Disable</a>
                        <?php
						}
						?></td>
                      <td class="span4"><a title="delete"  href="coupon/delete/<?php echo $row->discount_id;?>" id="del"  onclick="return confirm('Are you sure ?')" class="btn btn-danger delete_button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>&nbsp;&nbsp;<a title="Edit" href="coupon/edit_view/<?php echo $row->discount_id;?>" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>

                      
                       </td> -->
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