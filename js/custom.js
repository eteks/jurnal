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
// $('.custom_logo_link a').attr('data-active','11');


// To add restriction
$('.article_content_section').addClass('article_content_section_height');
// $('.article_content_section p:first-child a').attr('id','download_pdf_link');
$('#download_pdf_link').css('visibility','hidden');
// $('#message_box_popup').prop('cols','30');
// $('#message_box_popup').prop('rows','5');





// To download pdf
$('#download_article_popup').click(function() {
  var href_link= $('.article_description_language a').attr('href');
  $('#download_pdf_link').attr('href',href_link);
  setTimeout(function(){
  if(!$('.wpcf7-form').hasClass('invalid') && !$('.wpcf7-form').hasClass('spam')) {
    $('a#download_pdf_link')[0].click();
  }
}, 5000);
});







// Active class for navigation
$('.active_section li a, .breadcrumb_anger').on('click',function() {
  var id = $(this).data("active");
  localStorage.removeItem('selectedolditem');
  localStorage.setItem("selectedolditem", id);
});
var filename = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
var title1 = document.getElementsByTagName("title")[0].innerHTML;
var title2 = $('.header_title').text();
if(title1==title2) {
  localStorage.removeItem('selectedolditem');
}
var selectedolditem = localStorage.getItem('selectedolditem'); // fetch selected navigation's datavalue from localStorage
if (selectedolditem != null) { // check selected navigation's datavalue is null or not
  $('.active_section li a').removeClass('active');
  $('.active_section').find('li a[data-active='+selectedolditem+']').addClass('active'); // add activeclass for selected navigation based on its datavalue
}
else {
  $('.active_section li:first a').addClass('active'); // add activeclass for homepage
}
// localStorage.removeItem('selectedolditem');













var lang_value = localStorage.getItem('selectedlang');
// alert(testtt);
if(lang_value!=null && lang_value!="english") {
  $("#language_convet_section option[value="+lang_value+"]").prop('selected','true');
  if(lang_value=='tamil') {
    $('.eng').addClass('display_none_lang');
    $('.fre').addClass('display_none_lang');
    $('.tam').fadeIn(1000);
    $('.tam').removeClass('display_none_lang');
  }
  else  {
    $('.eng').addClass('display_none_lang');
    $('.tam').addClass('display_none_lang');
    $('.fre').fadeIn(1000);
    $('.fre').removeClass('display_none_lang');
  }
}
else {
  $("#language_convet_section option[value=english]").prop('selected','true');
  $('.fre').addClass('display_none_lang');
  $('.tam').addClass('display_none_lang');
  $('.eng').fadeIn(1000);
  $('.eng').removeClass('display_none_lang');
}






$('.language_convet_section').on('change',function(){
  var selected_value = $(this).val();
  if(selected_value=='tamil') {
    var lang_val="tamil";
    $('.eng').addClass('display_none_lang');
    $('.fre').addClass('display_none_lang');
    $('.tam').fadeIn(1000);
    $('.tam').removeClass('display_none_lang');
    $('.eng').css('display','none');
    $('.fre').css('display','none');
    localStorage.setItem("selectedlang", lang_val);
  }
  else if(selected_value=='french') {
    var lang_val="french";
    $('.eng').addClass('display_none_lang');
    $('.tam').addClass('display_none_lang');
    $('.fre').fadeIn(1000);
    $('.fre').removeClass('display_none_lang');
    $('.eng').css('display','none');
    $('.tam').css('display','none');
    localStorage.setItem("selectedlang", lang_val);
  }
  else {
    var lang_val="english";
    $('.fre').addClass('display_none_lang');
    $('.tam').addClass('display_none_lang');
    $('.eng').fadeIn(1000);
    $('.eng').removeClass('display_none_lang');
    $('.fre').css('display','none');
    $('.tam').css('display','none');
    localStorage.setItem("selectedlang", lang_val);
  }

});

}); // Document ready end