$(function() {

  // gnb function
  const gnb = $('.list_gnb>li>a');
  const heder = $('.header');
  const mobWrap = $('.wrapper_mob');



  gnb.on('mouseenter', function() {
    $(this).next('ul').addClass('active');
    $(this).parent('li').siblings().find('ul').removeClass('active')
  });
  heder.on('mouseleave', function() {
    $('.list_gnb>li>ul').removeClass('active')
  });

  // mobile menu open function
  $('.btn_menu').on('click', function() {
    mobWrap.addClass('open')
  });
  // mobile menu close function
  mobWrap.find('.btn_close').on('click', function() {
    mobWrap.removeClass('open')
  });


  // show popup
  //
  $('.btn_view').on('click',function(e){
    e.preventDefault();
  });

  $('.btn_view.policy1').on('click',function(e){
    $('#policy1').addClass('active')
  });
  $('.btn_view.policy2').on('click',function(e){
    $('#policy2').addClass('active')
  });
  $('.btn_view.policy3').on('click',function(e){
    $('#policy3').addClass('active')
  });

  $('.wrap_popup .btn_close').on('click',function(){
    $(this).parents('.wrap_popup').removeClass('active')
  });

  if($(window).width() < 1025){
    gnb.on('click', function(e) {
      $(this).addClass('active');
      $(this).parent('li').siblings().find('a').removeClass('active')
      if($(this).next('ul')){
        e.preventDefault();
      }
      // $(this).next('ul').addClass('active');
      // $(this).parent('li').siblings().find('ul').removeClass('active')
    });
  }


  // mypage page tab function
  $('.btn_tab *').on('click',function(e){
    e.preventDefault();
    const idx = $(this).parent().index();

    const tabBox = $(this).parents('.container').find('.content_tab').eq(idx);
    tabBox.addClass('active');
    tabBox.siblings('.content_tab').removeClass('active')



  });



}); //jquery function end

function showPopup(param) {
  // const popup = document.querySelector('.popup.' + param);
  const popup = $('.wrap_popup.'+param)
  popup.addClass('active');

  // popup.classList.add('active');
}

// popup common

const closePopBtn = document.querySelectorAll('.popup .btn_close');

for (let i = 0; i < closePopBtn.length; i++) {
  closePopBtn[i].addEventListener('click', function() {
    this.closest('.popup').classList.remove('active');
  });
}


// scroll to top
const scrollTopBtn = document.querySelector('.btn_top');
scrollTopBtn.addEventListener('click', function() {
  window.scrollTo(0, 0);
});

const noLink = document.querySelectorAll('.nolink');
for (let i = 0; i < noLink.length; i++) {
  noLink[i].addEventListener('click', function(e) {
    e.preventDefault()
  });
}
