<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Burnett Research Lab [Controll Admin]</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/font-awesome-admin.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/style_admin.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/pages/dashboard.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.css" />
<link href="<?php echo base_url();?>assets/css/bootstrap-glyphicons.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="#">Burnett Research Lab [Controll Admin] </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-cog"></i> Account <b class="caret"></b></a>
            <ul class="dropdown-menu">
            <!--<li><a href="<?php echo base_url();?>controll_admin/dashboard/change_password/">Change Password</a></li>-->
              <li><a href="<?php echo base_url();?>controll_admin/dashboard/settings/">Settings</a></li>
              <li><a href="<?php echo base_url();?>controll_admin/product/product_pickup/">Pickup Details</a></li>
              
            </ul>
          </li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-user"></i> <?php echo ucfirst($this->session->userdata('username'));?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              
              <li><a href="<?php echo base_url();?>controll_admin/auth/logout">Logout</a></li>
            </ul>
          </li>
        </ul>
        <?php /*?><form class="navbar-search pull-right">
          <input type="text" class="search-query" placeholder="Search">
        </form><?php */?>
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->

