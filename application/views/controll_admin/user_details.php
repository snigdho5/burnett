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
              <h3>User Details</h3>
              <div class="pull-right"> </div>
            </div>
            <!-- /widget-header -->
            
            <div class="widget-content panel-collapse collapse in" id="stone_details_area">
              <div class="table-responsive prolistmysec">
                <?php //print_r($user);?>
                <table border="0" width="100%">
                  <tr>
                    <td><strong>Name: </strong> <?php echo $user->firstname.' '.$user->lastname;?></td>
                    <td><strong>Email: </strong> <?php echo $user->email;?></td>
                  </tr>
                  <tr>
                    <td><strong>Telephone No: </strong> <?php echo $user->phone;?></td>
                    <td><strong>Whats app No: </strong> <?php echo $user->whatsapp;?></td>
                  </tr>
                  <tr>
                    <td><strong>Have Registration: </strong> <?php echo $user->have_registration_no;?></td>
                    <td><strong>Registration No: </strong> <?php echo $user->registration_no;?></td>
                  </tr>
                  <tr>
                    <td><strong>Firm name: </strong> <?php echo $user->firmname;?></td>
                    <td><strong>Drug license No: </strong> <?php echo $user->drug_license_no;?></td>
                  </tr>
                  <tr>
                    <td><strong>GST/PAN no of Firm: </strong> <?php echo $user->gst_pan_no_firm;?></td>
                    <td><strong>Address: </strong> <?php echo $user->address;?></td>
                  </tr>
                  <tr>
                    <td><strong>Area of work: </strong> <?php echo $user->area_of_work;?></td>
                    <td><strong>Previous any Delarship: </strong> <?php echo $user->prev_any_delarship;?></td>
                  </tr>
                  <tr>
                    <td><strong>Name of company: </strong> <?php echo $user->name_of_company;?></td>
                    <td><strong>Target of business: </strong> <?php echo $user->target_of_business;?></td>
                  </tr>
                  <tr>
                    <td><strong>Experience: </strong> <?php echo $user->year_of_experience;?></td>
                    <td><strong>User Type: </strong> <?php echo $user->user_type;?></td>
                  </tr>
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