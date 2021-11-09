
function addTinyMCE(id) {
	tinyMCE
	.init({
		mode : "exact",		
		elements : id,
		theme : "advanced",
		plugins : "table,paste,insertdatetime,aspnetbrowser",		
		verify_html : true,
		theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,link,|,table,aspnetbrowser,code",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 :  "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		apply_source_formatting : true,
		theme_advanced_statusbar_location : "bottom",
		plugin_insertdate_dateFormat : '%m/%d/%Y',
		theme_advanced_resizing : true,
		convert_urls : false,		
		
	});
} // JavaScript Document
	
	/*jQuery(document).ready(function() {
	 addTinyMCE("edit_route");

	});*/