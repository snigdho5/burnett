function isEmail(emailid) 
{
	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	return pattern.test(emailid);
}
	
function isValidURL(url)
{
	//regular expression for URL
	var pattern = /^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/;
	
	if(pattern.test(url))
	{
		return true;
	} 
	else 
	{
		return false;
	}
}
	
function isFristCharacterSpace(string)
{
	//regular  for avoiding frist character space
	//string1=string.trim() 
	//alert(string[0])
	//string.charAt(0)==' '
	string=string.trim();
	if(string=='')
	{
		return false;
	}
	else
	{
		return true;
	}
}


function isNull(string)
{ //alert("checknull");
	//regular  for avoiding frist character space
	//string1=string.trim() 
	//alert(string[0])
	//string.charAt(0)==' '
	string=string.trim();
	if(string=='')
	{
		return false;
	}
	else
	{
		return true;
	}
}


function strWordCounter(string)
{
	var regex = /\s+/gi;
	var wordCount = string.trim().replace(regex, ' ').split(' ').length;
	var totalChars = string.length;
	var charCount = string.trim().length;
	var charCountNoSpace = string.replace(regex, '').length;
	
	return wordCount;
}
//start Array validation 

(function() 
{
	

	$('#select_services_form1').ajaxForm({
		
			
		
		beforeSubmit: function() 
		{	
		  alert('ok');
		   return true;
	    },
		
		beforeSend:function()
		{
			//alert('ok');
			//old_email = base_url+'assets/images/loader.gif';
			//html = '';
			//html+= '<image src="'+old_email+'" width="198px">';
			//$('.upload-image').html( html );
		},
	    success: function(msg) 
		{
			//alert(msg);
	    },
		complete: function(xhr) 
		{
		    resetAllMsg()
			 resetForm()
			var result = xhr.responseText;
			result = $.parseJSON(result);
			if(result.success_msg)
			{
				$('#success_msg').show().html(result.success_msg);
			} 
			else if(result.error_msg)
			{
				$('#error_msg').show().html(result.error_msg);
			}
			else 
			{
				alert('Something went wrong please try again');
			}
			//$('#error_div').delay(5000).fadeOut('slow');
		}
	}); 
	
});
//end Array validation 

function isNormalInteger(str) 
{
    return /^\+?\d+$/.test(str);
}

function isNormalIntegerFloat(str) 
{
	if(/^[0-9]+\.[0-9]+$/.test(str) || /^\+?(0|[1-9]\d*)$/.test(str) )
	{
		 return true;
	}
	else
	{
		 return false;
	}   
}


function isMobile(str)  
{  
  var mobno = /^\+?([0-9]{2})\)?[-. ]?([0-9]{10})$/;  
  if(str.value.match(mobno)) 
        {  
      return true;  
        }  
      else  
        {  
       
        return false;  
        }  
}  