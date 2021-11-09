$(document).ready(function(){
$('.billing_save_address_btn').click(function () {          
         var pattern = /^\d{10}$/;
         var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
         var address_id = $('#billing_address_id').val();         
         var name = $('#billing_address_name').val();
         var email= $('#billing_address_email').val();
         var phone= $('#billing_address_phone').val();
         var pincode= $('#billing_address_pincode').val();
         var flat= $('#billing_address_flat').val();
         var locality= $('#billing_address_locality').val();        
         var city= $('#billing_address_city').val();
         var state= $('#billing_address_state').val();
         var country= $('#billing_address_country').val();
         
         if(name.trim()==''){
             notify('error','Please enter billing full name!');
         }else if(email.trim()=='' || !reg.test(email)){
             notify('error','Please enter a valid email address!');
         }else if(phone.trim()=='' && !pattern.test(phone) ){
             notify('error','Please enter a valid billing phone number!');
         }else if(flat.trim()==''){
             notify('error','Please enter your billing flat/house no!');
         }else if(locality.trim()==''){
             notify('error','Please enter your billing locality!');
         }else if(pincode.trim()==''){
             notify('error','Please enter a billing address Pincode!');
         }else if(city.trim()==''){
             notify('error','Please enter your billing City Name!');
         }else if(state.trim()==''){
             notify('error','Please enter your billing State Name!');
         }else if(country.trim()==''){
             notify('error','Please enter your billing Country Name!');
         }else {         
             $.ajax({
                 type: 'POST',
                 url:  "<?php echo base_url()?>myaccount/add_new_billing_address",
                 data: { 'address_id':address_id, 'name': name,'phone':phone,'pincode':pincode,'city':city,'state':state,'email':email,'flat':flat,'locality':locality,'country':country},
                 success: function (responsedata) {
                     location.reload();
                   }
             }); 
         }
     });
	 
$('.shipping_save_address_btn').click(function () {          
         var pattern = /^\d{10}$/;
         var address_id = $('#shipping_address_id').val();
         var name = $('#shipping_address_name').val();
         var phone= $('#shipping_address_phone').val();
         var pincode= $('#shipping_address_pincode').val();
         var flat= $('#shipping_address_flat').val();
         var locality= $('#shipping_address_locality').val();
         var landmark= $('#shipping_address_landmark').val();
         var city= $('#shipping_address_city').val();
         var state= $('#shipping_address_state').val();
         var country= $('#shipping_address_country').val();
         var type= $('#shipping_address_type').val();
         if(name.trim()==''){
             notify('error','Please enter shipping full name!');
         }else if(phone.trim()=='' && !pattern.test(phone) ){
             notify('error','Please enter a valid shipping phone number!');
         }else if(pincode.trim()==''){
             notify('error','Please enter a shipping address Pincode!');
         }else if(flat.trim()==''){
             notify('Please enter shipping address Flat / House No. / Floor / Building!','error');
         }else if(locality.trim()==''){
             notify('error','Please enter your Locality!');
         }else if(landmark.trim()==''){
             notify('error','Please enter a Landmark!');
         }else if(city.trim()==''){
             notify('error','Please enter your shipping City Name!');
         }else if(state.trim()==''){
             notify('error','Please enter your shipping State Name!');
         }else if(country.trim()==''){
             notify('error','Please enter your shipping Country Name!');
         }else if(type.trim()==''){
             notify('error','Please select your shipping Address Type!');
         }else {
            $.ajax({
                 type: 'POST',
                 url:  "<?php echo base_url()?>myaccount/add_new_delivery_address",
                 data: { 'address_id':address_id, 'name': name,'phone':phone,'pincode':pincode,'flat':flat,'locality':locality,'landmark':landmark,'city':city,'state':state,'country':country,'type':type },
                 success: function (responsedata) {
                     location.reload();
                   }
             }); 
         }
     });
	 
	 
$('.place-order-login').click(function (e) {
		
		 var default_billing = $('#default_billing').val();    
		 var default_shipping = $('#default_shipping').val();    
		// alert(default_billing);
		 //alert(default_shipping);
         if(default_billing==0 || default_billing.trim()=='' || default_shipping==0 || default_shipping.trim()=='')
		 {
			  notify('info','Please add billing and shipping address');
		 }
		 else
		 {
		window.location = "<?php echo base_url()?>checkout/process";
		 }
		});
		
		
$('.billing-edit-address-list').click(function () {
        document.getElementById('add_billing_address_from').style.display='block';
        document.getElementById('add_shipping_address_from').style.display='none';
      var address_id =  $(this).attr("edit-id");
       $.ajax({
                 type: 'POST',
                 url: "<?php echo base_url()?>myaccount/edit_delete_billing_address",
                 data: { 'address_id': address_id,'method':'edit' },
                 success: function (responsedata) {                        
                       $('#billing_address_name').val(responsedata.name);
	               $('#billing_address_phone').val(responsedata.phone);
		       $('#billing_address_pincode').val(responsedata.pincode);		      
		       $('#billing_address_city').val(responsedata.city);
		       $('#billing_address_state').val(responsedata.state);
		       $('#billing_address_email').val(responsedata.email);
		       $('#billing_address_id').val(address_id);
		       $('#billing_address_flat').val(responsedata.flat_house_floor_building);
                       $('#billing_address_locality').val(responsedata.locality);
                       $('#billing_address_country').val(responsedata.country);                      
                   }
             });   
              
    });

$('.shipping_edit-address-list').click(function () { 
      var address_id =  $(this).attr("edit-id");
      document.getElementById('add_billing_address_from').style.display='none';
      document.getElementById('add_shipping_address_from').style.display='block';
      $.ajax({
                 type: 'POST',
                 url: "<?php echo base_url()?>myaccount/edit_delete_shipping_address",
                 data: { 'address_id': address_id,'method':'edit' },
                 success: function (responsedata) {                        
                       $('#shipping_address_name').val(responsedata.name);
	               $('#shipping_address_phone').val(responsedata.phone);
		       $('#shipping_address_pincode').val(responsedata.pincode);
		       $('#shipping_address_flat').val(responsedata.flat_house_floor_building);
		       $('#shipping_address_locality').val(responsedata.locality);
		       $('#shipping_address_landmark').val(responsedata.landmark);
		       $('#shipping_address_city').val(responsedata.city);
		       $('#shipping_address_state').val(responsedata.state);
		        $('#shipping_address_country').val(responsedata.country);
		       $('#shipping_address_id').val(address_id);                     
                   }
             });    
              
    });
    
$('.billing-delete-address-list').click(function () { 
      var address_id =  $(this).attr("del-id");
	  //alert(address_id);
      var result = confirm("Are you sure,You Want to delete this?");
      if (result) {

       $.ajax({
                 type: 'POST',
				 url: "<?php echo base_url()?>myaccount/edit_delete_billing_address",
                 data: { 'address_id': address_id,'method':'delete' },
                 success: function (responsedata) {
                       location.reload();       
                   }
             }); 
        }        
              
    });
    
$('.shipping_delete-address-list').click(function () { 
      var address_id =  $(this).attr("del-id");
      var result = confirm("Are you sure,You Want to delete this?");
      if (result) {
       $.ajax({
                 type: 'POST',
                 url: "<?php echo base_url()?>myaccount/edit_delete_shipping_address",
                 data: { 'address_id': address_id,'method':'delete' },
                 success: function (responsedata) {
                         location.reload();       
                   }
             }); 
        }        
              
    });
    
$('.billing-default-address-list').click(function () { 
      var address_id =  $(this).attr("bill-id");     
      var result = confirm("Are you sure,You Want to make this as default billing address?");
      if (result) {
         $.ajax({
                 type: 'POST',
				 url: "<?php echo base_url()?>myaccount/set_default_billing_address",
                 data: { 'address_id': address_id },
                 success: function (responsedata) {
                         location.reload();       
                   }
             }); 
        }        
              
    });
    
$('.shipping-default-address-list').click(function () { 
      var address_id =  $(this).attr("ship-id");      
      var result = confirm("Are you sure,You Want to make this as default billing address?");
      if (result) {
         $.ajax({
                 type: 'POST',
				 url: "<?php echo base_url()?>myaccount/set_default_shipping_address",
                 data: { 'address_id': address_id },
                 success: function (responsedata) {
                         location.reload();       
                   }
             }); 
        }        
              
    });
	
$('#login-button').click(function () {
    var gremail = $('#gremail').val();
    var grpassword = $('#grpassword').val();
    if(!gremail){
        $('.errorlemail').html('please enter a valid email id');
        return false;
    }
    else if(!grpassword){
        $('.errorlemail').html('Please enter your password');
        return false;
    }
    else {
        var postLogindata = {
            email: gremail,
            password: grpassword
        };
        $.post( "<?php echo base_url()?>myaccount/normalsignin", JSON.stringify(postLogindata), function(response){
            $('.errorlemail, .errorlpassword').html('');
            if(response=='errorCredential'){
                $('.errorlemail').html('Please enter valid credentials').css({'color':'red'});
                return false;
            }
            else if(response=='accountIsNotActive'){
                $('.errorlemail').html('Your account is not activated!').css({'color':'red'});
                return false;
            }
            else if(response=='success'){
                window.location.reload();
            }
        });
    }

});	
});

 function form_validation()
	 {
		 var pattern = /^\d{10}$/;
         var return_val = false;
         var name = $('#shipping_address_name').val();
         var phone= $('#shipping_address_phone').val();
         var pincode= $('#shipping_address_pincode').val();
         var flat= $('#shipping_address_flat').val();
         var locality= $('#shipping_address_locality').val();
         var landmark= $('#shipping_address_landmark').val();
         var city= $('#shipping_address_city').val();
         var state= $('#shipping_address_state').val();
         var country= $('#shipping_address_country').val();
         var type= $('#shipping_address_type').val();
		 
         var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        
         var bname = $('#billing_address_name').val();
         var bemail= $('#billing_address_email').val();
         var bphone= $('#billing_address_phone').val();
         var bpincode= $('#billing_address_pincode').val();
         var bflat= $('#billing_address_flat').val();
         var blocality= $('#billing_address_locality').val();        
         var bcity= $('#billing_address_city').val();
         var bstate= $('#billing_address_state').val();
         var bcountry= $('#billing_address_country').val();
         
         if(bname.trim()==''){
             notify('error','Please enter billing full name!');
         }else if(bemail.trim()=='' || !reg.test(bemail)){
             notify('error','Please enter a valid email address!');
         }else if(bphone.trim()=='' && !pattern.test(bphone) ){
             notify('error','Please enter a valid billing phone number!');
         }else if(bflat.trim()==''){
             notify('error','Please enter your billing flat/house no!');
         }else if(blocality.trim()==''){
             notify('error','Please enter your billing locality!');
         }else if(bpincode.trim()==''){
             notify('error','Please enter a billing address Pincode!');
         }else if(bcity.trim()==''){
             notify('error','Please enter your billing City Name!');
         }else if(bstate.trim()==''){
             notify('error','Please enter your billing State Name!');
         }else if(bcountry.trim()==''){
             notify('error','Please enter your billing Country Name!');
         }
         else if(name.trim()==''){
             notify('error','Please enter shipping full name!');
         }else if(phone.trim()=='' && !pattern.test(phone) ){
             notify('error','Please enter a valid shipping phone number!');
         }else if(pincode.trim()==''){
             notify('error','Please enter a shipping address Pincode!');
         }else if(flat.trim()==''){
             notify('Please enter shipping address Flat / House No. / Floor / Building!','error');
         }else if(locality.trim()==''){
             notify('error','Please enter your Locality!');
         }else if(landmark.trim()==''){
             notify('error','Please enter a Landmark!');
         }else if(city.trim()==''){
             notify('error','Please enter your shipping City Name!');
         }else if(state.trim()==''){
             notify('error','Please enter your shipping State Name!');
         }else if(country.trim()==''){
             notify('error','Please enter your shipping Country Name!');
         }else if(type.trim()==''){
             notify('error','Please select your shipping Address Type!');
         } 
		 else
		 {
			 return_val = true;
		 }
		 
		 return return_val;
	 }
	 
 function notify(msgtype,msg) {
var notifyarea=$(".notify-grass");
         notifyarea.html(''); 
           $('html, body').animate({
                     'scrollTop' : $(".notify-grass").position().top
                     });
         if(msgtype=='info'){          
            notifyarea.append("<div class='message-box message-info'><div class='message-icon'><i class='fa fa-exclamation'></i></div><div class='message-text'><b>"+msg+"</b></div><div class='message-close'><i class='fa fa-times'></i></div></div>");
        }else if (msgtype=='success'){           
           notifyarea.append("<div class='message-box message-success'><div class='message-icon'><i class='fa fa-check'></i></div><div class='message-text'><b>"+msg+"</b></div><div class='message-close'><i class='fa fa-times'></i></div></div>");
        }else if (msgtype=='warning'){            
            notifyarea.append("<div class='message-box message-warning'><div class='message-icon'><i class='fa fa-exclamation'></i></div><div class='message-text'><b>"+msg+"</b></div><div class='message-close'><i class='fa fa-times'></i></div></div>");
        }else if (msgtype=='error'){           
           notifyarea.append("<div class='message-box message-danger'><div class='message-icon'><i class='fa fa-times'></i></div><div class='message-text'><b>"+msg+"</b></div><div class='message-close'><i class='fa fa-times'></i></div></div>");
        }    
         
       /*  toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        if(msgtype=='info'){
            toastr["info"](msg);           
        }else if (msgtype=='success'){
           toastr["success"](msg);           
        }else if (msgtype=='warning'){
            toastr["warning"](msg);            
        }else if (msgtype=='error'){
            toastr["error"](msg);          
        } */

      setTimeout(function(){
       notifyarea.html('');
      },4000);
    }
	
 function load_language()
		{
			//alert($('#language_selector').val());
			$.ajax({
      url: "<?php echo base_url()?>ajax/load_language",
      type: "POST",
      data: "language="+$('#language_selector').val(),
      success: function(data) {
		
		location.reload();
     //$('#already_section_'+id).remove();
      }
    });

		}
 $(document).on("click", "#btn_signin", function () {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var password = $('#user_signin_password').val();
        var email = $('#user_signin_email').val();
        if(email.trim()=='' || !regex.test(email)){
            notify('warning','Please Enter A Valid Email!');
        }else if(password.trim()==''){
            notify('warning','Please Enter Your Password!');
        }else {
            $.ajax({
                method: "POST",
                data:{"email":email,"password":password},
                url: "<?php echo base_url()?>myaccount/user_normal_signin",
                success: function(data) {                    
                    notify(data.class,data.message);
                    if(data.status==1) {
                       setTimeout(function(){ window.location.reload(); }, 3000);                       
                    }
                }
            });
        }

    });	