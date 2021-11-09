<?php $this->load->view('controll_admin/common/header'); ?>
<?php $data['mainpage'] ='site';?>
<?php $this->load->view('controll_admin/common/menu',$data); ?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3> Today's Stats</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="widget big-stats-container">
                <div class="widget-content">
                 
                  <div id="big_stats" class="cf">
                 <?php if($this->session->flashdata('auth_msg')){ ?>
   <div class="alert alert-success alert-dismissable">
	 	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<?php echo $this->session->flashdata('auth_msg');?></div>
<?php } ?>
                  
                  </div>
                   <div id="big_stats" class="cf">  <div class="stat"> <i class="icon-bullhorn"></i> <span class="value"> <h1 class="bigstats">Welcome to Burnett Research Lab </h1></span> </div>
                    <!-- .stat --> 
                  </div>
                </div>
                <!-- /widget-content --> 
                
              </div>
            </div>
          </div>
      
        </div>
        <!-- /span6 -->
     
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>

<?php $this->load->view('controll_admin/common/footer'); ?>