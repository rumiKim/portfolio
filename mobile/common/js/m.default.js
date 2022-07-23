
$(function(){
 // new WOW().init();

 $('.btn_menu').on('click',function(){
   $('.bx_menu').addClass('open');
 });
 $('.bx_menu .btn_close').on('click',function(){
   $('.bx_menu').removeClass('open');
 });

 var btn_gnb = $('header nav > ul > li > a');
 btn_gnb.on('click',function(e){
   e.preventDefault();
   $(this).parent().children('ul').slideToggle();
   $(this).parent().siblings().children('ul').slideUp();
 });




// sub tab (type.html)
 var tab = $('.wrap_tab.type2 .tab li');
 tab.on('click', function() {
   var idx = $(this).index();
   $(this).children().addClass('on');
   $(this).siblings().children().removeClass('on');
   $(this).parents('.wrap_tabBox').find('.bx_tab').eq(idx).addClass('on');
   $(this).parents('.wrap_tabBox').find('.bx_tab').eq(idx).siblings().removeClass('on');
 });




// btn_scrollDown
  // $('.btn_scrollDown').on('click',function(){
  //   var y = $(window).scrollTop();
  //   $('html , body').animate({scrollTop:y + 500}, 700);
  // });



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
// $(window).scroll(function(){
//
//   // change bg position
//   var y = $(this).scrollTop();
//   if(y > 600){
//     $('.sec_intro').addClass('chgPosition');
//   }
//
//   // header
//   if(y > 650){
//     $('header').addClass('on');
//   }else{
//     $('header').removeClass('on');
//
//   }
//
// });






}); //end
