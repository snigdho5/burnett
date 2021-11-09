function province_select(id)
{
	var dataString='id='+id;
	$.ajax({  
			  type: "POST",
			  dataType:'json',  
			  url:base_url+"index.php/registration/reg_list",  
			  data:dataString,
			  success: function(data)
			  { 
			 	 //console.log(data);
				  var arrlength=data.edit_.length;
				 var str='<option value="">Select Province</option>';
				 for(var i=0; i<arrlength; i++)
				 {	
				 	str+='<option value="';
					str+=data.edit_[i]['province_id'];
					str+='">';			 
				 	str+=data.edit_[i]['provinceName'];
					str+='</option>';						 				 
				}
				 //str+='</select>'
				 $("#province").html(str);				 
				$('#province option[value=""]') .attr("selected","selected");
				 $("#province").removeAttr('disabled');
			  }
			  
	});
}

