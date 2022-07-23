
$(function(){





 new WOW().init();


 // header

 var bg = $('header > .bg'),
     header = $('header'),
     gnb = $('header nav > ul'),
     snb = $('header nav > ul ul');

     gnb.on('mouseenter',function(){
       header.addClass('on');
       snb.addClass('on');
     }).on('mouseleave',function(){
       if ( bg.is(':hover')) {
       }else {
         header.removeClass('on');
         snb.removeClass('on');
       }
     });

     bg.on('mouseleave',function(){
       header.removeClass('on');
       snb.removeClass('on');
     });


     // tab
     var tab = $('.wrap_tab.type2 .tab li');
     tab.on('click', function() {
       var idx = $(this).index();
       $(this).children().addClass('on');
       $(this).siblings().children().removeClass('on');
       $(this).parents('.wrap_tabBox').find('.bx_tab').eq(idx).addClass('on');
       $(this).parents('.wrap_tabBox').find('.bx_tab').eq(idx).siblings().removeClass('on');
     });







 // $('header nav > ul').on('mouseleave',function(){
 //   bg.stop().slideUp();
 // });

 // bg.on('mouseover',function(){
 //    $(this).stop().show();
 // });
 // bg.on('mouseout',function(){
 //   $(this).stop().slideUp();
 // });


 //
 // $('.btn_menu').on('click',function(){
 //   $(this).toggleClass('on');
 //   $('.bx_menu_all').toggleClass('show');
 // });
 //


// btn_scrollDown
  $('.btn_scrollDown').on('click',function(){
    var y = $(window).scrollTop();
    $('html , body').animate({scrollTop:y + 500}, 700);
  });



  const swiper = new Swiper('.slide1', {
  // Optional parameters
  loop: true,

  // If we need pagination
  pagination: {
    el: '.slide1 .pagination',
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


// animation=======================================================

//1. scroll animation================================
$(window).scroll(function(){

  // change bg position
  var y = $(this).scrollTop();
  if(y > 600){
    $('.sec_intro').addClass('chgPosition');
  }

  // header
  if(y > 0){
    $('header').addClass('chgColor');
  }else{
    $('header').removeClass('chgColor');

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
