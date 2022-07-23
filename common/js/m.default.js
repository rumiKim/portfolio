
$(function(){

 // new WOW().init();

 $('.btn_menu').on('click',function(){
   $('.bx_menu').addClass('open');
 });

 $('.bx_menu .btn_close').on('click',function(){
   $('.bx_menu').removeClass('open');
 });









// btn_scrollDown
  $('.btn_scrollDown').on('click',function(){
    var y = $(window).scrollTop();
    $('html , body').animate({scrollTop:y + 500}, 700);
  });



  const swiper = new Swiper('.slide1_m', {
  // Optional parameters
  loop: true,

  // If we need pagination
  pagination: {
    el: '.slide1_m .pagination',
  },

  // Navigation arrows
  navigation: {
    nextEl: '.slide1 .btn_slide_next',
    prevEl: '.slide1 .btn_slide_prev',
  },

  // And if we need scrollbar
  scrollbar: {
    el: '.swiper-scrollbar',
  },
});


const swiper2 = new Swiper('.slide2_m', {
  slidesPerView : 1.3,
  spaceBetween: 20,
  centeredSlides:true
});

// animation=======================================================

//1. scroll animation================================
$(window).scroll(function(){

  // change bg position
  var y = $(this).scrollTop();
  if(y > 600){
    $('.sec_intro').addClass('chgPosition');
  }

  // header
  if(y > 650){
    $('header').addClass('on');
  }else{
    $('header').removeClass('on');

  }

});



//1. scroll animation================================
// var li = $('.sec_news ul li');
// li.each(function(i,e){
//   $(this).addClass('on');
// });
//
//
// setInterval(function()
//     {
//
//
//
//
//
//
//
//     },2000);
//
//

















}); //end
