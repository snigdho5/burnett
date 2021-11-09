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
              <h3>User List</h3>
              <div class="pull-right"> <?php //if($user->user_type == 'DI'){?><a href="<?php echo base_url().BaseAdminURl.'/';?>user/add_edit_dealer" class="btn btn-success">Add New Dealer</a><?php //}?></div>
            </div>
            <!-- /widget-header -->
            
            <div class="widget-content panel-collapse collapse in" id="stone_details_area">
              <div class="table-responsive prolistmysec">
                <table class="table-condensed table-striped dataTables_filter" id="table_of_list">
                  <thead>
                    <tr>
                
        <th class="span2">Sl.No</th>
        <th class="span2">User Type</th>
        <th class="span2">Name</th>
        <th class="span2">Phone</th>
        <th class="span2">Email ID</th>
        <th class="span2">Whats app no</th>
        <th class="span2">Registration no</th>
        <th class="span2">GST/PAN no</th>
        <th class="span2">Status</th>
        <!--<th class="span5">Subscriber</th>-->
        <th class="span5">Action</th>
       
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
                  <tbody>
       <?php if(!empty($users)) { 
							foreach($users as $user){
			?>
       <tr class="odd gradeX">
        <td class="center"><?=$user->user_id?></td>
        <td><?php 
			if($user->user_type == 'CU'){
				echo 'Customer';
			} elseif($user->user_type == 'DR'){
				echo 'Doctor';
			} elseif($user->user_type == 'DI'){
				echo 'Distributor';
			} elseif($user->user_type == 'ST'){
				echo 'Stockist';
			}
		?>
        </td>
        <td><?php echo(isset($user->firstname)? $user->firstname.' '.$user->lastname : '');?></td>
        <td><?php echo(isset($user->phone)? $user->phone : '');?></td>
        <td><?php echo(isset($user->email)? $user->email: '');?></td>
        <td><?php echo(isset($user->whatsapp)? $user->whatsapp: '');?></td>
        <td><?php echo(isset($user->registration_no)? $user->registration_no: '');?></td>
        <td><?php echo(isset($user->gst_pan_no_firm)? $user->gst_pan_no_firm: '');?></td>
        <td class="center"><?php if($user->activate == 1){ ?>
         <a href="<?php echo base_url().BaseAdminURl.'/';?>user/change_status/<?php echo $user->user_id.'/0';?>" class="btn btn-success">Enable</a>
         <?php }else{ ?>
         <a href="<?php echo base_url().BaseAdminURl.'/';?>user/change_status/<?php echo $user->user_id.'/1';?>" class="btn btn-danger">Disable</a>
         <?php } ?></td>
         
          
       	 <td class="center" width="25%"><?php if($user->user_id){ ?>
         <!--<a href="user/view_details/<?php echo $user->user_id;?>" class="btn btn-primary">View</a>  -->  
         <?php if($user->user_type == 'DI'){?>      
         <a href="<?php echo base_url().BaseAdminURl.'/';?>user/add_edit_dealer/<?php echo $user->user_id;?>" class="btn btn-info">Edit</a> 
         <?php } ?>       
         <a href="<?php echo base_url().BaseAdminURl.'/';?>user/delete/<?php echo $user->user_id;?>" class="btn btn-danger">Delete</a>
         <a href="<?php echo base_url().BaseAdminURl.'/';?>user/add_discount_show/<?php echo $user->user_id;?>" class="btn btn-warning">Add Discount</a>
         <?php } ?></td>
       </tr>
       
       <?php  }
         } ?>
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
    </script>
    
    
    
    
    
