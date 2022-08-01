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

});

function showPopup(param) {
  const popup = document.querySelector('.popup.' + param);
  popup.classList.add('active');
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
