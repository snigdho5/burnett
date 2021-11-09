// autocomplet : this function will be executed every time we change the text
function brand_autocomplet()
{
	//alert('ok')
	//alert('ok')
	//alert(base_url);
	var min_length = 0; // min caracters to display the autocomplete
	var keyword = $('#brand_name').val();
	//alert(keyword)
	if (keyword.length >= min_length)
	 {
		//alert(base_url);
		$.ajax({
			url:base_url+'index.php/auto_complete_all/brand_autocomplete/',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data)
			{
				//alert(data)
				$('#brand_list_id').show();
				$('#brand_list_id').html(data);
			}
		});
	} 
	else 
	{
		$('#brand_list_id').hide();
	}
}

// set_item : this function will be executed when we select an item
function brand_set_item(item,id) 
{
	
	// change input value
	$('#brand_name').val(item);
	$('#brand_id').val(id);
	// hide proposition list
	$('#brand_list_id').hide();
}


function brand_name_autocomplete_multiple(id)
{
	//alert('ok');
	var item='';
	var brand_field_id=id;
	multifield_selecte_state_country_company(item,brand_field_id)
	
	var min_length = 0; // min caracters to display the autocomplete
	var keyword = $('#equivqlent_brand_name_'+id).val();
	//alert(keyword);
	
	if (keyword.length >= min_length)
	 {
		//alert(base_url);
		$.ajax({
			url:base_url+'index.php/auto_complete_all/brand_autocomplete_multiple/',
			type: 'POST',
			data:
			{
				keyword:keyword,
				id:id
				
			},
			success:function(data)
			{
				//alert(data)
				auto_complete_state_country_company_by_brand_name(keyword);
				$('#brand_list_multiple_id_'+id).show();
				$('#brand_list_multiple_id_'+id).html(data);
			}
		});
	} 
	else 
	{
		$('#brand_list_multiple_id_'+id).hide();
	}
	
}


//START AUTO_COMPLETE_STATE_COUNTRY_COMPANY_BY_BRAND_NAME
function auto_complete_state_country_company_by_brand_name(keyword)
{
	
}
//END AUTO_COMPLETE_STATE_COUNTRY_COMPANY_BY_BRAND_NAME



function brand_set_item_multiple(item,brand_id,brand_field_id) 
{
	 multifield_selecte_state_country_company(item,brand_field_id)
	// change input value
	$('#equivqlent_brand_name_'+brand_field_id).val(item);
	$('#equivalent_brand_id_'+brand_field_id).val(brand_id);
	
	// hide proposition list
	$('#brand_list_multiple_id_'+brand_field_id).hide();
}




function company_name_autocomplete_multiple(id)
{
	 //alert('ok');
	
	var min_length = 0; // min caracters to display the autocomplete
	var keyword = $('#equivqlent_company_name_'+id).val();
	if (keyword.length >= min_length)
	 {
		
		//alert(base_url);
		$.ajax({
			url:base_url+'index.php/auto_complete_all/company_name_autocomplete_multiple/',
			type: 'POST',
			data:
			{
				keyword:keyword,
				id:id
				
			},
			success:function(data)
			{
				//alert(data)
				$('#company_list_multiple_id_'+id).show();
				$('#company_list_multiple_id_'+id).html(data);
			}
		});
	} 
	else 
	{
		$('#company_list_multiple_id_'+id).hide();
	}
	
}



function company_name_set_item_multiple(item,company_id,company_field_id) 
{
	
	// change input value
	$('#equivqlent_company_name_'+company_field_id).val(item);
	$('#equivalent_company_id_'+company_field_id).val(company_id);
	// hide proposition list
	$('#company_list_multiple_id_'+company_field_id).hide();
}


function country_name_autocomplete_multiple(id)
{
	 //alert('ok');
	
	var min_length = 0; // min caracters to display the autocomplete
	var keyword = $('#equivqlent_country_name_'+id).val();
	if (keyword.length >= min_length)
	 {
		
		//alert(base_url);
		$.ajax({
			url:base_url+'index.php/auto_complete_all/country_name_autocomplete_multiple/',
			type: 'POST',
			data:
			{
				keyword:keyword,
				id:id
				
			},
			success:function(data)
			{
				//alert(data)
				$('#country_list_multiple_id_'+id).show();
				$('#country_list_multiple_id_'+id).html(data);
			}
		});
	} 
	else 
	{
		$('#country_list_multiple_id_'+id).hide();
	}
	
}



function country_name_set_item_multiple(item,country_id,country_field_id) 
{
	
	// change input value
	$('#equivqlent_country_name_'+country_field_id).val(item);
	$('#equivalent_country_id_'+country_field_id).val(country_id);
	// hide proposition list
	$('#country_list_multiple_id_'+country_field_id).hide();
}


function state_name_autocomplete_multiple(id)
{
	 //alert('ok');
	
	var min_length = 0; // min caracters to display the autocomplete
	var keyword = $('#equivqlent_state_name_'+id).val();
	 //alert(keyword);
	if (keyword.length >= min_length)
	 {
		
		//alert(base_url);
		$.ajax({
			url:base_url+'index.php/auto_complete_all/state_name_autocomplete_multiple/',
			type: 'POST',
			data:
			{
				keyword:keyword,
				id:id
				
			},
			success:function(data)
			{
				//alert(data)
				$('#state_list_multiple_id_'+id).show();
				$('#state_list_multiple_id_'+id).html(data);
			}
		});
	} 
	else 
	{
		$('#state_list_multiple_id_'+id).hide();
	}
	
}

function state_name_set_item_multiple(item,state_id,state_field_id) 
{
	
	// change input value
	$('#equivqlent_state_name_'+state_field_id).val(item);
	$('#equivalent_state_id_'+state_field_id).val(state_id);
	
	// hide proposition list
	$('#state_list_multiple_id_'+state_field_id).hide();
}





//SUPLIER LIST AUTO COMPLETE 
function suplier_autocomplet()
{
	//alert('ok')
	//alert(base_url);
	var min_length = 0; // min caracters to display the autocomplete
	var keyword = $('#suplier').val();
	if (keyword.length >= min_length)
	 {
		//alert(base_url);
		$.ajax({
			url:base_url+'index.php/auto_complete_all/suplier_autocomplete/',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data)
			{
				//alert(data)
				$('#suplier_list').show();
				$('#suplier_list').html(data);
			}
		});
	} 
	else 
	{
		$('#suplier_list').hide();
	}
}

// set_item : this function will be executed when we select an item
function suplier_set_item(item,id) 
{
	// change input value
	$('#suplier').val(item);
	//$('#suplier_id').val(id);
	// hide proposition list
	$('#suplier_list').hide();
	
}


//SUPLIER LIST AUTO COMPLETE 
function email_live_check()
{
	//alert('ok')
	//alert(base_url);
	var min_length = 0; // min caracters to display the autocomplete
	var keyword = $('#suplier_email').val();
	
	if (keyword.length >= min_length)
	 {
		//alert(base_url);
		$.ajax({
			url:base_url+'index.php/auto_complete_all/email_live_check/',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data)
			{
				if(data)
				{
					var user_details= '{"userDetails":'+data+'}';				
					obj = JSON.parse(user_details);
					
					//alert(obj.userDetails.length)
					var user_name=obj.userDetails[0].user_name;
					var user_id=obj.userDetails[0].user_id;
					
					var company_name=obj.userDetails[0].company_name;
					var country_name=obj.userDetails[0].country_name;
					var state_name=obj.userDetails[0].state_name;
					
					$("#suplier").val(user_name)
					$("#company_name").val(company_name)
					$("#country_name").val(country_name)
					$("#state_name").val(state_name)
					$("#suplier_id").val(user_id)
				}
				else
				{
				    $("#suplier").val('')
					$("#suplier_id").val('')
					$("#suplier").val(user_name)
					$("#company_name").val('')
					$("#country_name").val('')
					$("#state_name").val('')
					
				}
				
			}
		});
	} 
	
}







