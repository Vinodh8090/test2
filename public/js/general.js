// $(window).load(function() {  
//   $('#slider-model, #slider-worker, #slider-agency, #slider-customer, #mid-slider').royalSlider({
//     controlNavigation: 'bullets',
//     autoScaleSlider: true,
//     autoScaleSliderWidth: 1000,
//     autoScaleSliderHeight: 563,
//     loop: true,
//     // imageScaleMode: 'fit',
//     navigateByClick: true,
//     numImagesToPreload: 1,
//     arrowsNav: false,
//     imageScalePadding: 0,
//     //autoHeight: true,
//     transitionType: 'fade',
//     transitionSpeed: 1000,
//     keyboardNavEnabled: true,
//     //fadeinLoadedSlide: true,
//     globalCaption: false,
//     globalCaptionInside: false,
//     autoPlay: {
//       enabled: true,
//       pauseOnHover: false,
//     }
//   });
// });


$('.hs-nav').on('click',function(){
  $(this).toggleClass('hide');
  $('.flex-fill.mt .col-2.col-md-3.fside').toggleClass('hide');
  $('.flex-fill.mt .col-12.col-md-9.fside').toggleClass('full100');
});




// Show the first tab and hide the rest
$('.tabbtn a:first-child').addClass('active');
$('.tabcnt').hide();
$('.tabcnt:first').show();

// old tab function
$('.tabbtn a').on('click',function(){
  $('.tabbtn a').removeClass('active');
  $(this).addClass('active');
  $('.tabcnt').hide();
  
  var activeTab = $(this).attr('href');
  $(activeTab).fadeIn();
  return false;
});

// new tab function
$('.ntab a:first-child').addClass('active');
$('.ntab-cont').hide();
$('.ntab-cont:first').show();

$('.ntab a').on('click',function(){
  $('.ntab a').removeClass('active');
  $(this).addClass('active');
  $('.ntab-cont').hide();
  
  var activeTab = $(this).attr('href');
  $(activeTab).fadeIn();
  return false;
});

// new sub tab function
$('.subtbtn a:first-child').addClass('active');
$('.subtcnt').hide();
$('.subtcnt:first').show();

$('.subtbtn a').on('click',function(){
  $('.subtbtn a').removeClass('active');
  $(this).addClass('active');
  $('.subtcnt').hide();
  
  var activeTab = $(this).attr('href');
  $(activeTab).fadeIn();
  return false;
});


function showPass() {
  var x = document.getElementById("password");
  if (x.type === "text") {
    x.type = "password";
  } else {
    x.type = "text";
  }
}

function showPass2() {
  var x = document.getElementById("password-confirm");
  if (x.type === "text") {
    x.type = "password";
  } else {
    x.type = "text";
  }
}
