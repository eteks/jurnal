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



// $('.download_article_popup')

$('.wpcf7-form').submit(function() {



	

$(function () {
    var specialElementHandlers = {
        '#editor': function (element,renderer) {
            return true;
        }
    };
 $('#cmd').click(function () {
        var doc = new jsPDF();
        doc.fromHTML($('#target').html(), 15, 15, {
            'width': 170,'elementHandlers': specialElementHandlers
        });
        doc.save('sample-file.pdf');
    });  
});

});

});