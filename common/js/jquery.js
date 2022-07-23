$(function(){




// policy_agree =============================================================
var btn_agree = $('.btn_agree');

$(document).on('click',".btn_agree_read",function(){ //sec_agree 숨기기
  PlaySound_nolink();
  $('.sec_agree').css('display','none');
  $('.bx_agree').css('display','block');
});

// 약관동의 popup box
$('.bx_agree .btn_agree_chk').on('click',function(){ //약관동의 버튼 클릭
  PlaySound_nolink();
  $("#agree_chk").val("Y");
  $('.sec_agree').css('display','block');
  btn_agree.addClass('chked');
  $(this).parents('.popup').css('display','none');
});
$('.bx_agree .btn_close').on('click',function(){ //약관동의 팝업 닫기
  PlaySound_nolink();
  $('.sec_agree').css('display','block');
});

// popup close //
var btn_popupClose = $('.popup .btn_close');
btn_popupClose.on('click',function(){
  $(this).parents('.popup').css('display','none');
});





// scroll up and down //

var btn_down = $('.btn_down'),
    btn_up = $('.btn_up');


    btn_down.on('click',function(){
      var scrollT = $('.list_depth1').scrollTop();
      $('.list_depth1').animate({
        scrollTop: scrollT + 100
      },300);
    });
    btn_up.on('click',function(){
      var scrollT = $('.list_depth1').scrollTop();
      $('.list_depth1').animate({
        scrollTop: scrollT - 100
      },300);
    });





});
