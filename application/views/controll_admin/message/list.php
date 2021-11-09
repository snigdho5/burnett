<?php $this->load->view('controll_admin/common/header'); ?>

<?php $data['mainpage'] ='message';?>

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
                    <?php echo validation_errors(); ?> 
                </div>
                <?php } ?>
                <?php if($this->session->flashdata('succ_msg')){ ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('succ_msg');; ?> 
                </div>
                <?php } ?>
				
                <div class="span12 stone_details" id="stone_details">
                    <div class="widget ">
                        <div class="widget-header ">
                            <i class="icon-list-ol"></i>
                            <h3>Message List</h3>
                            <div class="pull-right"><a href="message/add" class="btn btn-success">Add Message</a> </div>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content panel-collapse collapse in" id="stone_details_area">
                            <div class="table-responsive prolistmysec">
                                <table class="table-condensed table-striped dataTables_filter" id="table_of_list" style="margin-left: 48px; margin-right: 20px; width: -webkit-fill-available;">
                                    <thead>
                                        <tr>
                                            <th class="span1">Sl No.</th>
                                            <th class="span1">Seo Title.</th>
                                            <th class="span1">Status</th>
                                            <th class="span2" style="width: 49.50px !important;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="stone_area">
                                        <?php
											$i = 0;
											foreach($messages as $value){
											$i++;
										?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>
												<?php  echo isset($value->message)?character_limiter($value->message,500):''; ?>
											</td>
											<td class="center">
											<?php if($value->status == 1){ ?>
												<a href="<?php echo base_url().BaseAdminURl.'/';?>message/status/<?php echo isset($value->message_id)?$value->message_id:'';?>" class="btn btn-success">Active</a>
											<?php }else{ ?>
												<a href="<?php echo base_url().BaseAdminURl.'/';?>message/status/<?php echo isset($value->message_id)?$value->message_id:'';?>" class="btn btn-danger">Inactive</a>
											<?php } ?>
											</td>
                                            <td>
                                                <a href="<?php echo base_url().BaseAdminURl.'/';?>message/edit/<?php echo isset($value->message_id)?$value->message_id:'';?>" title="Edit" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
												
												<a href="<?php echo base_url().BaseAdminURl.'/';?>message/delete/<?php echo isset($value->message_id)?$value->message_id:'';?>" onclick="return confirm('Are you sure you want to delete it ?')" title="delete"  class="btn btn-danger delete_button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
												
                                            </td>
                                        </tr>
										<?php
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
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /main-inner -->
</div>
<?php $this->load->view('controll_admin/common/footer'); ?>
<script type="application/javascript">   
    $(document).ready(function() {
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