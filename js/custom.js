$(document).ready(function() {

// To insert article name and current date in popup
$('.download').on('click',function() {
	var download_article_value = $('#download_article_name').val();
	var download_article_date = $('#download_article_date').val();
	$('#article_name_box').val(download_article_value);
	$('#article_name_box').prop('readonly',true);
	$('#download_popup_date').val(download_article_date);
	$('#download_popup_date').prop('readonly',true);


});

// To add restriction
$('.article_content_section').addClass('article_content_section_height');
$('.article_content_section p:first-child a').attr('id','download_pdf_link');
$('#download_pdf_link').css('display','none');
$('#message_box_popup').prop('cols','30');
$('#message_box_popup').prop('rows','5');

// To download pdf
$('#download_article_popup').click(function() {
	setTimeout(function(){
	if(!$('.wpcf7-form').hasClass('invalid')) {
		$('a#download_pdf_link')[0].click();
	}
}, 3000);
});

// Active class for navigation
 $('.active_section li, .breadcrumb_anger').on('click',function() {
        var id = $(this).data("active");
        localStorage.setItem("selectedolditem", id);
    });

    var selectedolditem = localStorage.getItem('selectedolditem');
	if (selectedolditem != null) {
		$('.active_section li').removeClass('active');
		$('.active_section').find('li[data-active='+selectedolditem+']').addClass('active');
   	}
   	else {
   		$('.active_section li:first').addClass('active');
   	}
   	// localStorage.removeItem('selectedolditem');




});






// To add active class for navigation (home, about, contact)
 $('.active_section li').on('click',function() { // click event
        var id = $(this).data("active"); // get data value from current navigation
        localStorage.setItem("selectedolditem", id); // store current navigation's datavalue to localStorage
    });

    var selectedolditem = localStorage.getItem('selectedolditem'); // fetch selected navigation's datavalue from localStorage
	if (selectedolditem != null) { // check selected navigation's datavalue is null or not
		$('.active_section li').removeClass('active');
		$('.active_section').find('li[data-active='+selectedolditem+']').addClass('active'); // add activeclass for selected navigation based on its datavalue
   	}
   	else {
   		$('.active_section li:first').addClass('active'); // add activeclass for homepage
   	}
   	// localStorage.removeItem('selectedolditem');