function add_page_validation(action)
{	
	var action=action;//For Focus value
	var page_title=$('#page_title').val()
	if (!page_title || !isFristCharacterSpace(page_title))
	{
		$('#page_title').removeClass('black_border').addClass('red_border');	
	}
	else
	{  
		$('#page_title').removeClass('red_border').addClass('black_border');	
	}
	
	var page_headline=$('#page_headline').val()
	if (!page_headline || !isFristCharacterSpace(page_headline))
	{
		$('#page_headline').removeClass('black_border').addClass('red_border');	
	}
	else
	{  
	
		$('#page_headline').removeClass('red_border').addClass('black_border');	
	}
	
	var meta_title=$('#meta_title').val()
	if (!meta_title || !isFristCharacterSpace(meta_title))
	{
		$('#meta_title').removeClass('black_border').addClass('red_border');	
	}
	else
	{  
	
		$('#meta_title').removeClass('red_border').addClass('black_border');	
	}
	
	var meta_description=$('#meta_description').val()
	if (!meta_description || !isFristCharacterSpace(meta_description))
	{
		$('#meta_description').removeClass('black_border').addClass('red_border');	
	}
	else
	{  
		$('#meta_description').removeClass('red_border').addClass('black_border');	
	}
		
}
