'use strict';

// popup common

const closePopBtn = document.querySelectorAll('.popup .btn_close');

  for(let i=0; i<closePopBtn.length; i++){
    closePopBtn[i].addEventListener('click',function(){
      this.closest('.popup').classList.remove('active');
    });
  }


// 팝업띄울 버튼 class에 btn_popup 추가, id 값에 btn_* 넣기, 띄울 팝업 클래스명에 *추가
const popupBtn = document.querySelectorAll('.btn_popup');

for(let i=0; i<popupBtn.length; i++){
  popupBtn[i].addEventListener('click',function(e){
    e.preventDefault();

    let btnName = this.getAttribute('id'); //id값 추출
    btnName = btnName.substr(4, btnName.length); //재할당

    showPopup(btnName);
  });

}

  function showPopup(param){

    const popup = document.querySelector('.popup.'+param);
    popup.classList.add('active');
  }
