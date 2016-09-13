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

// Add data-active value to each li
$('.active_section').each(function() {
  var data_id = 1;
  if(!$(this).hasClass('data-id-actived')) {
    $(this).addClass('data-id-actived')
    $(this).children('li').find('a').each(function() {
        $(this).attr('data-active',data_id);
        data_id++;
    });  
  }
});

$('.custom_logo_link a').addClass('breadcrumb_anger');
$('.custom_logo_link a').attr('data-active','1');

// To add restriction
$('.article_content_section').addClass('article_content_section_height');
$('.article_content_section p:first-child a').attr('id','download_pdf_link');
$('#download_pdf_link').css('display','none');
$('#message_box_popup').prop('cols','30');
$('#message_box_popup').prop('rows','5');

// To download pdf
$('#download_article_popup').click(function() {
  setTimeout(function(){
  if(!$('.wpcf7-form').hasClass('invalid') && !$('.wpcf7-form').hasClass('spam')) {
    $('a#download_pdf_link')[0].click();
  }
}, 3000);
});

// Active class for navigation
$('.active_section li a, .breadcrumb_anger').on('click',function() {
  var id = $(this).data("active");
  localStorage.removeItem('selectedolditem');
  localStorage.setItem("selectedolditem", id);
});

var selectedolditem = localStorage.getItem('selectedolditem'); // fetch selected navigation's datavalue from localStorage
if (selectedolditem != null) { // check selected navigation's datavalue is null or not
  $('.active_section li a').removeClass('active');
  $('.active_section').find('li a[data-active='+selectedolditem+']').addClass('active'); // add activeclass for selected navigation based on its datavalue
}
else {
  $('.active_section li:first').addClass('active'); // add activeclass for homepage
}
// localStorage.removeItem('selectedolditem');

});