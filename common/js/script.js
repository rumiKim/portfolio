'use strict';

const noLink = document.querySelectorAll('.nolink');
for (let i = 0; i < noLink.length; i++) {
  noLink[i].addEventListener('click', function(e) {
    e.preventDefault()
  });
}

const btn_menu = document.querySelector('.btn_menu'),
  sitemap = document.querySelector('.sitemap');
btn_menu.addEventListener('click', function() {
  sitemap.classList.toggle('open');
});


// popup common

const closePopBtn = document.querySelectorAll('.popup .btn_close');

for (let i = 0; i < closePopBtn.length; i++) {
  closePopBtn[i].addEventListener('click', function() {
    this.closest('.popup').classList.remove('active');
  });
}


// 팝업띄울 버튼 class에 btn_popup 추가, id 값에 btn_* 넣기, 띄울 팝업 클래스명에 *추가
const popupBtn = document.querySelectorAll('.btn_popup');

for (let i = 0; i < popupBtn.length; i++) {
  popupBtn[i].addEventListener('click', function(e) {
    e.preventDefault();

    let btnName = this.getAttribute('id'); //id값 추출
    btnName = btnName.substr(4, btnName.length); //재할당

    showPopup(btnName);
  });

}

function showPopup(param) {

  const popup = document.querySelector('.popup.' + param);
  popup.classList.add('active');
}


$(function() {
  $("input[type='file']").on('change', function() {
    var fileName = $(this).val();
    $(this).next('.fileName').val(fileName)
  });
});


// tab_type1
// $(function(){
//   let tabBtn = $('.tab_type1 > li > *');
//   tabBtn.on('click',function(e){
//     e.preventDefault();
//     let idx = $(this).parent().index();
//     $(this).parent('li').addClass('on');
//     $(this).parent('li').siblings().removeClass('on');
//     $(this).parents('.wrap_tab').next('.wrap_tabbox').children('div').eq(idx).addClass('on')
//     $(this).parents('.wrap_tab').next('.wrap_tabbox').children().eq(idx).siblings().removeClass('on')
//   });
//
// });
