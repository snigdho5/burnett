<?php $this->load->view('controll_admin/common/header'); ?>
<?php $data['mainpage'] = 'order'; ?>
<?php $this->load->view('controll_admin/common/menu', $data); ?>

<?php if ($this->session->flashdata('auth_msg')) { ?>
  <div class="alert alert-success"><?php echo $this->session->flashdata('auth_msg'); ?></div>
<?php } ?>


<div class="main">

  <div class="main-inner">

    <div class="container">

      <div class="row">
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



        <div class="span12 stone_details" id="stone_details">
          <div class="widget ">
            <div class="widget-header "> <i class="icon-list-ol"></i>
              <h3>Order List</h3>
              <div class="pull-right"> </div>
            </div>
            <!-- /widget-header -->

            <div class="widget-content panel-collapse collapse in" id="stone_details_area">
              <div class="table-responsive prolistmysec">
                <table class="table-condensed table-striped dataTables_filter" id="table_of_list">
                  <thead>
                    <tr>

                      <th class="span1">Sl.No</th>
                      <th class="span2">Order ID</th>
                      <th class="span1">Order Amount</th>
                      <th class="span1">Date</th>
                      <th class="span1">Payment Type</th>
                      <th class="span1">Payment Status</th>
                      <th class="span1">Order Status</th>
                      <th class="span3">Action</th>
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
                    <?php if (!empty($orders)) {
                      foreach ($orders as $O) {

                        if ($O->order_status == '1') {

                          $or_status = '<span class="label label-warning">Processing</span>';
                        } elseif ($O->order_status == '2') {

                          $or_status = '<span class="label label-info">Ship In Progress</span>';
                        } elseif ($O->order_status == '3') {

                          $or_status = '<span class="label label-success">Delivered</span>';
                        } elseif ($O->order_status == '4') {
                          $or_status = '<span class="label label-default">Cancelled</span>';
                        } else {
                          $or_status = '<span class="label label-default">Failed</span>';
                        }

                        //$count++;	
                    ?>
                        <tr class="odd gradeX">
                          <td><?php echo (isset($O->order_id) ? $O->order_id : ''); ?></td>
                          <td><?php echo (isset($O->order_unique_id) ? $O->order_unique_id : ''); ?></td>
                          <td><?php echo (isset($O->order_total_value) ? $O->order_total_value : ''); ?></td>
                          <td class="center"><?php echo (isset($O->date) ? date('Y-m-d', strtotime($O->date)) : ''); ?></td>
                          <td class="center"><?php echo $O->payment_type; ?></td>
                          <td class="center"><?php echo $O->payment_status; ?></td>
                          <td class="center"><?php echo $or_status; ?></td>

                          <td class="center"><?php if ($O->order_unique_id) { ?>
                              <a href="<?php echo base_url() . BaseAdminURl . '/'; ?>order/view_details/<?php echo $O->order_unique_id; ?>" class="btn btn-primary">View</a>

                              <?php if ($O->order_status == '3') { ?> <a href="<?php echo base_url() . BaseAdminURl . '/'; ?>order/download_order_pdf/<?php echo $O->order_unique_id; ?>" class="btn btn-danger"  target="_blank">Download</a> <?php } ?>

                              <?php if ($O->order_status != '3' && $O->order_status != '4') { ?>
                                <a href="<?php echo base_url() . BaseAdminURl . '/'; ?>order/delete/<?php echo $O->order_unique_id; ?>" class="btn btn-danger">Delete</a> <?php } ?>



                            <?php } ?>
                          </td>
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

    $(".edit_button").click(function() {
      //alert();
      $('#submit_value').val('edit');
      $('#submit_send_value').val($(this).attr('id'));
      $('#allform').submit();
    });
    $(".delete_button").click(function() {
      //alert();
      if (confirm("Are You sure You want to delete!")) {
        $('#submit_value').val('delete');
        $('#submit_send_value').val($(this).attr('id'));
        $('#allform').submit();
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