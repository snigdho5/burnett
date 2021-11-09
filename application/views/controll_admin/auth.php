<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>Burnett Research Lab [Controll Admin]</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url();?>assets/css/font-awesome.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    
<link href="<?php echo base_url();?>assets/css/style_admin.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/css/pages/signin.css" rel="stylesheet" type="text/css">

</head>

<body>
	
	<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
			<a class="brand" href="index.html">
				Burnett Research Lab [Controll Admin]
			</a>		
			
			<div class="nav-collapse">
				<ul class="nav pull-right">
					
				</ul>
				
			</div><!--/.nav-collapse -->	
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->



<div class="account-container">
	
	<div class="content clearfix">
		
		<form role="form" id="auth_form" method="post" action="<?php echo base_url(); ?>controll_admin/auth/login">
		
			<h1>Member Login</h1>		
			
			<div class="login-fields">
				<?php if($this->session->flashdata('auth_msg')){ ?>
 <div class="alert alert-danger"><?php echo $this->session->flashdata('auth_msg');?></div>
 <?php } ?>
				<div class="field">
					<label for="username">Username</label>
					<input type="text" id="username" name="username" value="" placeholder="Username" class="login username-field" />
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Password:</label>
					<input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field"/>
				</div> <!-- /password -->
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<?php /*?><span class="login-checkbox">
					<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					<label class="choice" for="Field">Keep me signed in</label>
				</span><?php */?>
									
				<button class="button btn btn-success btn-large" type="submit" name="btn-login">Sign In</button>
				
			</div> <!-- .actions -->
			
			
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->



<!--<div class="login-extra">
	<a href="#">Reset Password</a>
</div>--> <!-- /login-extra -->


<script src="<?php echo base_url();?>assets/js/jquery-1.7.2.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>

<script src="<?php echo base_url();?>assets/js/signin.js"></script>

</body>

</html>

