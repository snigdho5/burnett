<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li <?=$mainpage=="home"?'class="active"':''?>><a href="<?php echo base_url();?>controll_admin/dashboard/"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
        
        <!--<li class="<?=$mainpage=="product"?'active':''?>  dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-leaf"></i><span>Manage Product</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url();?>controll_admin/product/add_edit"><i class="icon-plus"></i> Add New Product</a></li>
            <li><a href="<?php echo base_url();?>controll_admin/product"><i class="icon-list-ul"></i> Product list</a></li>
            <li><a href="<?php echo base_url();?>controll_admin/product/product_bulk_mng"><i class="icon-pencil"></i> Product Bulk Editing</a></li>
             <li><a href="<?php echo base_url();?>controll_admin/product/product_excel_up"><i class="icon-pencil"></i> Product Excel uploading</a></li>
             </ul>
        </li>-->
        
        <li class="<?=$mainpage=="user"?'active':''?>  dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i><span>Manage User</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url();?>controll_admin/user"><i class="icon-user"></i> All Users</a></li>
            <li><a href="<?php echo base_url();?>controll_admin/user/customer_list"><i class="icon-user"></i> Customers</a></li>
            <li><a href="<?php echo base_url();?>controll_admin/user/doctor_list"><i class="icon-user"></i> Doctors</a></li>
            <li><a href="<?php echo base_url();?>controll_admin/user/dealer_list"><i class="icon-user"></i> Distributors</a></li>
            <li><a href="<?php echo base_url();?>controll_admin/user/stockist_list"><i class="icon-user"></i> Stockists</a></li>
           </ul>
        </li>
        <!--<li class="<?=$mainpage=="user"?'active':''?>  dropdown"><a href="<?php echo base_url();?>controll_admin/user"> <i class="icon-user"></i><span>Manage User</span> <b class="caret"></b></a>-->
          
        <!--</li>
        <li class="<?=$mainpage=="order"?'active':''?>  dropdown"><a href="<?php echo base_url();?>controll_admin/order"> <i class="icon-list"></i><span>Manage Order</span> <b class="caret"></b></a>
          
        </li>-->
         <li class="<?=$mainpage=="ecomm"?'active':''?>  dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-shopping-cart"></i><span>Ecommerce Settings</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url();?>controll_admin/category"><i class="icon-sitemap"></i> Category Management</a></li>
            <!--<li><a href="<?php echo base_url();?>controll_admin/gst"><i class="icon-legal"></i> GST Slab</a></li>-->
             <li><a href="<?php echo base_url();?>controll_admin/brand"><i class="icon-sitemap"></i> Brand Management</a></li>
             <!-- <li><a href="<?php echo base_url();?>controll_admin/product_attribute/unit_add_edit"><i class="icon-sitemap"></i> Unit Management</a></li> -->
              <li><a href="<?php echo base_url();?>controll_admin/product_attribute"><i class="icon-sitemap"></i> Product Attribute</a></li>

              <li><a href="<?php echo base_url();?>controll_admin/product"><i class="icon-sitemap"></i> Product Management</a></li>

              <li><a href="<?php echo base_url();?>controll_admin/blog"><i class="icon-sitemap"></i> Blog Management</a></li>
               <li><a href="<?php echo base_url();?>controll_admin/news"><i class="icon-sitemap"></i> News Management</a></li>
            
    
          </ul>
        </li>
        
        <li class="<?=$mainpage=="banner"?'active':''?>"><a href="<?php echo base_url();?>controll_admin/banner"><i class="icon-picture"></i><span>Banner List</span></a></li>
		
		<li class="<?=$mainpage=="message"?'active':''?>">
			<a href="<?php echo base_url();?>controll_admin/message"><i class="icon-picture"></i><span>Message</span></a>
		</li>
		
		<li class="<?=$mainpage=="saveYTvideo"?'active':''?>">
			<a href="<?php echo base_url();?>controll_admin/message/saveYTvideo"><i class="icon-picture"></i><span>YouTube Video</span></a>
		</li>

        <li class="<?=$mainpage=="coupon"?'active':''?>"><a href="<?php echo base_url();?>controll_admin/coupon"><i class="icon-picture"></i><span>Coupon List</span> </a> </li>
          <li class="<?=$mainpage=="coupon"?'active':''?>"><a href="<?php echo base_url();?>controll_admin/order"><i class="icon-picture"></i><span>Order List</span> </a> </li>

          <li class="<?=$mainpage=="coupon"?'active':''?>"><a href="<?php echo base_url();?>controll_admin/seo_module"><i class="icon-picture"></i><span>Seo Module</span> </a> </li>


      <?php /*?> 
        <li class="<?=$mainpage=="location"?'active':''?> dropdown"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-map-marker"></i><span>Manage location</span> <b class="caret"></b></a>  
        <ul class="dropdown-menu">
            <li><a href="<?php echo base_url();?>controll_admin/country"><i class="icon-plus"></i> Manage Country</a></li>
            <li><a href="<?php echo base_url();?>controll_admin/city"><i class="icon-reorder"></i> Manage State</a></li>
          </ul></li>
         <li <?=$mainpage=="cms"?'class="active"':''?>><a href="<?php echo base_url();?>controll_admin/cms"><i class="fa fa-address-card-o"></i><span>CMS</span> </a> </li>
       <!-- <li <?=$mainpage=="order"?'class="active"':''?>><a href="order_mng.php"><i class="icon-book"></i><span>Manage Payment</span> </a> </li>-->
        <li class="<?=$mainpage=="payout"?'active':''?> dropdown"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-calendar"></i><span>Manage Payout</span> <b class="caret"></b></a>  
        <ul class="dropdown-menu">
            <li><a href="<?php echo base_url();?>controll_admin/doctor/pending_list"><i class="icon-plus"></i> Pending List</a></li>
            <li><a href="<?php echo base_url();?>controll_admin/doctor/approved_list"><i class="icon-reorder"></i> Approved List</a></li>
          </ul></li>
        <!--<li <?=$mainpage=="banner"?'class="active"':''?>><a href="banner_mng.php"><i class="icon-picture"></i><span>Manage Wallet</span> </a> </li>-->
       
        
        
        <li class="<?=$mainpage=="report"?'active':''?> dropdown"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list-alt"></i><span>Report</span> <b class="caret"></b></a>  
        <ul class="dropdown-menu">
            <li><a href="<?php echo base_url();?>controll_admin/report/wallet"><i class="icon-plus"></i> Wallet recharge</a></li>
            <li><a href="<?php echo base_url();?>controll_admin/report/earning"><i class="icon-plus"></i> Doctor Earning</a></li>
            <li><a href="<?php echo base_url();?>controll_admin/report/payout"><i class="icon-plus"></i> Doctor Payout</a></li>
            
            <li><a href="<?php echo base_url();?>controll_admin/report/user"><i class="icon-plus"></i> User List</a></li>
          </ul></li>
          
          <li class="<?=$mainpage=="settings"?'active':''?>  dropdown"><a href="<?php echo base_url();?>controll_admin/dashboard/settings/" > <i class="icon-cog"></i><span>Settings</span> <b class="caret"></b></a>
          
        </li><?php */?>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
