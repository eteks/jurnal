$(document).ready(function() {

$('.download').on('click',function() {
	var download_article_value = $('#download_article_name').val();
	var download_article_date = $('#download_article_date').val();
	$('#article_name_box').val(download_article_value);
	$('#article_name_box').prop('disabled',true);
	$('#download_popup_date').val(download_article_date);
	$('#download_popup_date').prop('disabled',true);


});
$('.article_content_section').addClass('article_content_section_height');
$('.article_content_section p:first-child a').attr('id','download_pdf_link');
$('#download_pdf_link').css('display','none');
$('#message_box_popup').prop('cols','30');
$('#message_box_popup').prop('rows','5');

// $('.download_article_popup')

$('#download_article_popup').click(function() {



setTimeout(function(){
 
	if($('.wpcf7-form').hasClass('invalid')) {
		
	}
	else {
		$('a#download_pdf_link')[0].click();
	}


}, 3000);


	

});

});