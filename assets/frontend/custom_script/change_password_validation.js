
    //$('#message').hide();
		//alert('ok');
	$('#change_password_admin input[type=password]').each(function()
	{
		
		$(this).after('<span class="errorMsgRight" style="padding:8px;color:red"></span>');
		
	});	
	
	  
		
	$("#old_password").on("focusout keyup keypress blur  change click",function()
	{
		
      if (!$(this).val()  || !isFristCharacterSpace($(this).val()))
		{
			var message='Please enter Old Password ';
			$(this).focus().parent().find('.errorMsgRight').addClass('commonErrorShow').show().html(message);
		}
		else
		{
			$(this).parent().find('.errorMsgRight').removeClass('commonErrorShow').hide();
		}
    });
	
	
	
	$("#new_password").on("focusout keyup click",function()
	{
      if (!$(this).val()  || !isFristCharacterSpace($(this).val()))
		{
			var message='Please create a New Password';
			$(this).focus().parent().find('.errorMsgRight').addClass('commonErrorShow').show().html(message);
		}
		else
		{
			$(this).parent().find('.errorMsgRight').removeClass('commonErrorShow').hide();
			var confirm_password=$('#confirm_password').val() 
			var new_password=$(this).val();
			if($('#confirm_password').val()  && isFristCharacterSpace($('#confirm_password').val()))
			{
				if(confirm_password==new_password)
				{
					$('#confirm_password').parent().find('.errorMsgRight').removeClass('commonErrorShow').hide();
					
				}
				else if(confirm_password!=new_password)
				{
					var message='New Password and Confirm password missmatch.';
					$('#confirm_password').parent().find('.errorMsgRight').addClass('commonErrorShow').show().html(message);
				}
				else
				{
					
				}
			}
		}
    });
	
	

	$("#confirm_password").on("focusout keyup keypress blur change click",function()
	{
       if (!$(this).val()  || !isFristCharacterSpace($(this).val()))
		{
			var message='Please enter Confirm Password.';
			$(this).focus().parent().find('.errorMsgRight').addClass('commonErrorShow').show().html(message);
		}
		else
		{
			var new_password=$('#new_password').val() 
			var confirm_password=$(this).val();
			if(new_password==confirm_password)
			{
				$(this).parent().find('.errorMsgRight').removeClass('commonErrorShow').hide();
			}
			else
			{
				 if (!$('#new_password').val()  || !isFristCharacterSpace($('#new_password').val()))
		         {
					var message='Please create a new password.';
					$(this).focus().parent().find('.errorMsgRight').addClass('commonErrorShow').show().html(message);
				 }
				 else
				 {
					var message='New Password and Confirm password missmatch.';
					$(this).focus().parent().find('.errorMsgRight').addClass('commonErrorShow').show().html(message); 
				 }
			}
			
		}
    });
	
	function myFunction()
	 {
				
				
			$('#old_password').trigger("click");
			$('#new_password').trigger("click");	
			$('#confirm_password').trigger("click");
		
		    if ($('#change_password_admin .commonErrorShow').size()>0) 
			{
					//alert('ok');
				//$('#changeEmailForm .commonErrorShow').is('show');
				// return false;
			}
			else
			{
				//alert(count);
			   //alert ("Thanks All fields Were Entered Correctly");
			   $("#change_password_admin").submit();
			   
			}	
		
		
	 };
		
		
			
	
			
	 

	
	
	
