function sub_admin_validation(action)
{
	
	var action=action;//For Focus value
	
	var sub_admin_email=$('#sub_admin_email').val()
	if (!sub_admin_email || !isFristCharacterSpace(sub_admin_email) || !isEmail(sub_admin_email))
	{
		$('#sub_admin_email').removeClass('black_border').addClass('red_border');	
	}
	else
	{  
		$('#sub_admin_email').removeClass('red_border').addClass('black_border');	
	}
	
	var sub_admin_full_name=$('#sub_admin_full_name').val()
	if (!sub_admin_full_name || !isFristCharacterSpace(sub_admin_full_name))
	{
		$('#sub_admin_full_name').removeClass('black_border').addClass('red_border');	
	}
	else
	{  
	
		$('#sub_admin_full_name').removeClass('red_border').addClass('black_border');	
	}
	
	var user_name=$('#user_name').val()
	if (!user_name || !isFristCharacterSpace(user_name))
	{
		$('#user_name').removeClass('black_border').addClass('red_border');	
	}
	else
	{  
	
		$('#user_name').removeClass('red_border').addClass('black_border');	
	}
	
	var sub_admin_password=$('#sub_admin_password').val()
	if (!sub_admin_password || !isFristCharacterSpace(sub_admin_password))
	{
		$('#sub_admin_password').removeClass('black_border').addClass('red_border');	
	}
	else
	{  
	
		$('#sub_admin_password').removeClass('red_border').addClass('black_border');	
	}
	
	
	var confirm_password=$('#confirm_password').val()
	var sub_admin_password=$('#sub_admin_password').val()
	if (!confirm_password || !isFristCharacterSpace(confirm_password))
	{
		$('#confirm_password').removeClass('black_border').addClass('red_border');	
	}
	else
	{  
		if(confirm_password!=sub_admin_password)
		{
		
			$('#confirm_password').removeClass('black_border').addClass('red_border');	
		}
		else
		{
			$('#confirm_password').removeClass('red_border').addClass('black_border');
		}
	}
		
}
