$(function(){


    var btn_open = $('.btn_popupOpen');
    var btn_close = $('.btn_popupClose');


    btn_open.on('click', function() {
      $('.bx_popup').addClass('show');
    });

    btn_close.on('click', function() {
      $(this).parents('.bx_popup').removeClass('show');
    });

    $('.popup_main .btn_popupClose').on('click', function() {
      $(this).parents('.popup_main').css('display','none');
    });




      $('.btn_make').on('click',function(){
        $('.popup_make').addClass('show');
      });

      $('.btn_apply').on('click',function(){
        $('.bx_apply').addClass('show');
      });

      $('.btn_askProject').on('click',function(){
        $('.bx_askProject').addClass('show');
      });

      $('.btn_ask').on('click',function(){
        $('.bx_ask').addClass('show');
      });

      $('.btn_end').on('click',function(){
        $('.bx_end').addClass('show');
      });

      $('.btn_exchg').on('click',function(){
        $('.bx_exchg').addClass('show');
      });

      $('.btn_chgDone').on('click',function(){
        $('.bx_chgDone').addClass('show');
      });

      // bubble_exchange.html
      $('.bx_bank .btn_cancel').on('click',function(){
        $(this).parents('.bx_bank').hide();
    });





      // register_step01.html

      $('.btn_chkEmail').on('click',function(){
        $('.bx_chkEmail').addClass('show');
      });

      $('.btn_sendNum').on('click',function(){
        $('.bx_sendNum').addClass('show');
      });

      $('.btn_chkNick').on('click',function(){
        $('.bx_chkNick').addClass('show');
      });

      // my/ myinfo 정보 변경

      $('.bx_chg > div').append('<button class="btn_cancel ico_close"><span class="hide">변경취소</span></button>');
      $('.btn_cancel').on('click',function(){
        $(this).parents('.bx_popup').removeClass('show');
      });

      $('.btn_chgPw').on('click',function(){
        $('.bx_chgPw').addClass('show');
      });

      $('.btn_chgTel').on('click',function(){
        $('.bx_chgTel').addClass('show');
      });

      $('.btn_chgNick').on('click',function(){
        $('.bx_chgNick').addClass('show');
      });


      // button function
      // 클릭 메인으로 이동
      $('.btn_idx').on('click',function(){
        $(this).parents('.bx_popup').removeClass('show');
        location.replace('/index.html');
      });



});
