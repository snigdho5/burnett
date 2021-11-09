<?php $this->load->view('controll_admin/common/header'); ?>
<?php $data['mainpage'] = 'ecomm'; ?>
<?php $this->load->view('controll_admin/common/menu', $data); ?>
<?php if (isset($product_attribute_details[0])) {
	$page_title = 'Edit Attribute - ' . $product_attribute_details[0]->unique_name;
} else {
	$page_title = 'Add Attribute';
}
?>

<?php if ($this->session->flashdata('auth_msg')) { ?>
	<div class="alert alert-success"><?php echo $this->session->flashdata('auth_msg'); ?></div>
<?php } ?>
<?php if (validation_errors()) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<?php echo validation_errors(); ?>
	</div>
<?php } ?>
<?php if ($this->session->flashdata('succ_msg')) { ?>
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<?php echo $this->session->flashdata('succ_msg');; ?>
	</div>
<?php } ?>

<div class="main">

	<div class="main-inner">

		<div class="container">

			<div class="row">



				<div class="span5">

					<div class="widget ">

						<div class="widget-header">
							<i class="icon-user"></i>
							<h3><?= $page_title ?></h3>
						</div> <!-- /widget-header -->

						<div class="widget-content">
							<form class="form-horizontal well" name="add_area" id="add_area" method="post" action="<?php echo base_url() . BaseAdminURl . '/'; ?>product_attribute/add_edit/<?php echo $this->uri->segment(4); ?>" enctype="multipart/form-data">
								<input type="hidden" name="entry_value" value="addnew_val">


								<fieldset>
									<div class="control-group">
										<label class="control-label" for="uploaded_csv">Attribute Name</label>
										<div class="controls">
											<input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="product_attribute_name" value="<?php echo (isset($product_attribute_details[0]->name) ? $product_attribute_details[0]->name : set_value('product_attribute_name')); ?>" name="product_attribute_name" placeholder="Name">
										</div> <!-- /controls -->
									</div> <!-- /control-group -->

									<div class="control-group">
										<label class="control-label" for="uploaded_csv">Attribute Unique Name</label>
										<div class="controls">
											<input type="text" data-validation="required" data-validation-error-msg="Please enter title" class="form-control" id="unique_name" value="<?php echo (isset($product_attribute_details[0]->unique_name) ? $product_attribute_details[0]->unique_name : set_value('unique_name')); ?>" name="unique_name" placeholder="Unique Name">
										</div> <!-- /controls -->
									</div>

									<?php /*<div class="control-group">
										<label class="control-label" for="uploaded_image">Attribute Image</label>
										<div class="controls">
											<input type="file" data-validation="required" data-validation-error-msg="Please enter Image" class="span4" id="main_image" name="main_image[]" />

											<?php if (!empty($product_attribute_details)) {
												if (isset($product_attribute_details[0]->product_attribute_image)) {
											?>
													<img src="<?php echo base_url() . 'uploads/' . $product_attribute_details[0]->product_attribute_image; ?>" title="" alt="attribute image" style="height:100px; width:100px;" />
											<?php 	}
											}
											?>


										</div> <!-- /controls -->
									</div>
									*/ ?>


									<div class="control-group">
										<label class="control-label" for="uploaded_csv">Select Variation Level</label>
										<div class="controls">
											<select class="form-control" rows="3" name="variation">
												<option value="0"> Default</option>
												<?php
												if (!empty($product_attribute)) {
													foreach ($product_attribute as $cat) {

														if ($product_attribute_details[0]->product_attribute_id != $cat->product_attribute_id) {
												?>

															<option value="<?php echo $cat->product_attribute_id; ?>" 
															<?php
																if (@$product_attribute_details[0]->variation == @$cat->product_attribute_id) {
																		echo "selected";
															} ?>> <?php echo $cat->name; ?></option>
													<?php

														}
														$count++;
													}
													?>

												<?php
												}
												?>

											</select>


										</div> <!-- /controls -->
									</div>





									<div class="control-group">
										<label class="control-label" for="uploaded_csv">Description</label>
										<div class="controls">
											<textarea class="form-control" rows="3" name="product_attribute_description" placeholder="Description" data-validation="required" data-validation-error-msg="Please enter description"><?php echo (isset($product_attribute_details[0]->description) ? $product_attribute_details[0]->description : set_value('description')); ?></textarea>
										</div> <!-- /controls -->
									</div> <!-- /control-group -->



									<!-- /control-group -->


									<div class="control-group">
										<label class="control-label" for="uploaded_csv">Status</label>
										<div class="controls">
											<input type="radio" name="product_attribute_status" id="category_status_active" value="1" <?= (isset($product_attribute_details[0]->status) && $product_attribute_details[0]->status == '1') ? 'checked' : '' ?>><span class="active_radio">Active</span>
											<input type="radio" class="active" name="product_attribute_status" id="category_status_inactive" value="0" <?= (isset($product_attribute_details[0]->status) && $product_attribute_details[0]->status == '0') ? 'checked' : '' ?>><span class="active_radio">Inactive</span>
										</div> <!-- /controls -->
									</div> <!-- /control-group -->


									<div class="form-actions">
										<button type="submit" class="btn btn-primary">
											<?php if (empty($product_attribute_details[0])) {
												echo "Add";
											} else {

												echo "Update";
											}
											?> Attribute
										</button>

									</div> <!-- /form-actions -->
								</fieldset>
							</form>





						</div>
					</div> <!-- /widget -->

				</div>



				<div class="span7">

					<div class="widget ">


						<div class="widget-header">
							<i class="icon-user"></i>
							<h3>Product Attribute List</h3>
						</div> <!-- /widget-header -->

						<div class="widget-content">


							<div class="table-responsive">
								<table class="table-condensed table-striped dataTables_filter" id="table_of_list">
									<thead>
										<tr>
											<th class="span1">Sl No.</th>
											<th class="span4">Name</th>
											<!--<th class="span5">Description</th>-->
											<th class="span1">Status</th>
											<th class="span4">Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th class="span1">Sl No.</th>
											<th class="span4">Name</th>
											<!--<th class="span5">Description</th>-->
											<th class="span1">Status</th>
											<th class="span4">Action</th>
										</tr>
									</tfoot>
									<tbody id="stone_area">
										<?php
										$count = 0;
										$search = array();


										if (!empty($product_attribute)) {
											foreach ($product_attribute as $cat) {
												$count++;
										?>


												<tr>
													<td><?= $count ?></td>
													<td><?= $cat->name == '' ? '' : $cat->name ?></td>
													<!--<td><?= $cat->description == '' ? '' : '<br>' . $cat->description ?></td>-->

													<td>
														<?php if ($cat->status == '1') {
														?>
															<a href="<?php echo base_url() . BaseAdminURl . '/'; ?>product_attribute/change_status/<?php echo $cat->product_attribute_id . '/0'; ?>" class="btn btn-success">Active</a>
														<?php
														} else {
														?>
															<a href="<?php echo base_url() . BaseAdminURl . '/'; ?>product_attribute/change_status/<?php echo $cat->product_attribute_id . '/1'; ?>" class="btn btn-danger">Disable</a>
														<?php
														}
														?>
													</td>
													<td class="span4">
														<!--<a href="#" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>&nbsp; &nbsp;--><a href="javascript:void(0)" id="<?php echo $cat->product_attribute_id; ?>" class="btn btn-danger delete_button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>&nbsp;&nbsp;<a href="<?php echo base_url() . BaseAdminURl . '/'; ?>product_attribute/add_edit/<?php echo $cat->product_attribute_id; ?>" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
														<!--<br>
                        <a href="user/view_details/<?php //echo $product->user_GUID;
													?>" class="btn btn-warning"><span class="icon-large icon-question-sign
" aria-hidden="true"></span></a>-->
													</td>
												</tr>




												<?php
												$subcount = 0;
												if (!empty($cat->subs)) {
													foreach ($cat->subs as $sub) {

														/*if($subcount%2 =='0'){
              $color = "#00ba8b";
        	}
        	else{
        	    $color = "#ffff";	
        	}*/
												?>

														<tr class="success">
															<td>&emsp;</td>
															<td>&emsp;&emsp;-<?= $sub->name == '' ? '' : $sub->name ?></td>
															<!--<td><?= $cat->description == '' ? '' : '<br>' . $cat->description ?></td>-->

															<td>
																<?php if ($sub->status == '1') {
																?>
																	<a href="<?php echo base_url() . BaseAdminURl . '/'; ?>product_attribute/change_status/<?php echo $sub->product_attribute_id . '/0'; ?>" class="btn btn-success">Active</a>
																<?php
																} else {
																?>
																	<a href="<?php echo base_url() . BaseAdminURl . '/'; ?>product_attribute/change_status/<?php echo $sub->product_attribute_id . '/1'; ?>" class="btn btn-danger">Disable</a>
																<?php
																}
																?>
															</td>
															<td class="span4">
																<!--<a href="#" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>&nbsp; &nbsp;--><a href="javascript:void(0)" id="<?php echo $sub->product_attribute_id; ?>" class="btn btn-danger delete_button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>&nbsp;&nbsp;<a href="<?php echo base_url() . BaseAdminURl . '/'; ?>product_attribute/add_edit/<?php echo $sub->product_attribute_id; ?>" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
																<!--<br>
                        <a href="user/view_details/<?php //echo $product->user_GUID;
													?>" class="btn btn-warning"><span class="icon-large icon-question-sign
" aria-hidden="true"></span></a>-->
															</td>
														</tr>


												<?php
														$subcount++;
													}
												}


												?>


										<?php
											}
										}
										?>
									</tbody>
								</table>
							</div>
						</div> <!-- /widget-content -->

					</div> <!-- /widget -->

				</div>

			</div> <!-- /row -->

		</div> <!-- /container -->

	</div> <!-- /main-inner -->

</div>





<?php $this->load->view('controll_admin/common/footer'); ?>

<script type="application/javascript">
	$(document).ready(function() {

		$(".edit_button").click(function() {
			//alert();
			$('#submit_value').val('edit');
			$('#submit_send_value').val($(this).attr('id'));
			$('#allform').submit();
		});
		$(".delete_button").click(function() {
			//alert();
			if (confirm("Are You sure You want to delete!")) {
				window.location = '<?php echo base_url() . BaseAdminURl . '/'; ?>product_attribute/delete/' + $(this).attr('id');
			}
		});

		table = $('#table_of_list').DataTable({

			"paging": true,

			"pageLength": 100,

			"lengthMenu": [
				[10, 25, 50, 100, 250, 500, -1],
				[10, 25, 50, 100, 250, 500, "All"]
			],

			"stateSave": true,

			"ordering": false,

			"info": false,

			"language": {

				"lengthMenu": "Show no. of Entries in a Grid:  _MENU_ ",

				"sSearch": "Enter keyword to Search: ",



			},

		});

		$(table.table().container()).on('keyup', 'tfoot input', function() {

			table

				.column($(this).data('index'))

				.search(this.value)

				.draw();

		});
	});
</script>