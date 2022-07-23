$(function() {




  // bottomFixedMenu
  $('.body_idx').find('.link_home').addClass('on');
  $('.body_Bubble').find('.link_bubble').addClass('on');
  $('.body_search').find('.link_search').addClass('on');
  $('.body_archive').find('.link_archive').addClass('on');
  $('.body_alarm').find('.link_alarm').addClass('on');


  // header & btn_top block
  var headerOffset = $("header").offset().top,
    gnb = $(".bar_nav");


  $(window).scroll(function() {
    var scrollTop = $(this).scrollTop();
    var scrollBtm = $(document).height() - $(window).height() - $(window).scrollTop();


    if (scrollBtm < 100 || scrollTop < 60) {
      $('.btn_top').removeClass('show');
    } else {
      $('.btn_top').addClass('show');
    }

  })


  // header_left open
  var btn_gnb = $('.btn_openGnb'),
    leftmenu = $('.header_left'),
    btn_closeGnb = $('.btn_closeGnb');

  btn_gnb.on('click', function() {
    leftmenu.addClass('open');
    $('.dim').addClass('on');
    $('body').css('overflow', 'hidden');
    return false;
  });
  btn_closeGnb.on('click', function() {
    leftmenu.removeClass('open');
    $('.dim').removeClass('on');
    $('body').css('overflow', 'visible');
  });


  // dim click Gnb close
  $('.dim').on('click', function() {
    $('.dim').removeClass('on');
    leftmenu.removeClass('open');
    $('body').css('overflow', 'visible');
  });


  // togglemenu
  var btn_menu = $('.section_gnb ul > li > a');
  var list_toggleMenu = $('.section_gnb .list_toggle > li');
  var btn_toggleMenu = $('.section_gnb .list_toggle > li > a');
  btn_toggleMenu.on('click', function(e) {
    $(this).toggleClass('open');
    $(this).next('ul').slideToggle();
    $(this).parent('li').toggleClass('open');
    $(this).parent('li').siblings().removeClass('open');
    $(this).parent('li').siblings().children('ul').slideUp();
    $(this).parent('li').siblings().children('a').removeClass('open');
    e.preventDefault();
  });


  // bx_search
  var btn_openSearch = $('.link_search'),
    bx_search = $('.bx_search'),
    input_search = $('.bx_search > input'),
    btn_search = $('.btn_search');

  btn_openSearch.on('click', function() {
    $('.wrap_search').addClass('show');
    $('body').css('overflow', 'hidden');
    input_search.focus();
    return false;
  });



  // 검색페이지로 이동
  btn_search.on('click', function() {
    if (input_search.val().length > 0) {
      $(location).attr('href', '../contents/search.html');
      bx_search.removeClass('on');
      input_search.val('');
    } else {
      alert('검색어를 입력해주세요');
    }
  });



  // 검색창
  var btn_close02 = $('.btn_popupClose_02');
  btn_close02.on('click', function() {
    $(this).parents('.bx_popup_02').removeClass('show');
    $('body').css('overflow', 'visible');
  });




  // list ===================================================================
  // list_bxIn
  var btn_bxOpen = $('.list_bxIn > li > a');
  btn_bxOpen.on('click', function() {
    $(this).toggleClass('open');
    $(this).parent('li').children('div').slideToggle(200);
    return false;
  });

  // list_scrap
  var btn_fav = $('.items_fav button'),
    btn_scrap = $('.items_scrap button');

  btn_fav.on('click', function() {
    $(this).toggleClass('clicked');
  });
  btn_scrap.on('click', function() {
    $(this).toggleClass('scraped');
  });





  // file ============================================================
  // 파일첨부
  $('.input_ori').on('change', function() {
    if (window.FileReader) {
      var fileName = $(this).val().split('/').pop().split('\\').pop();
    } else {
      var fileName = $(this).val().split('/').pop().split('\\').pop();
    }
    $(this).parents('.wrap_file').find('.bx_fileName').text(fileName);
  });

  // 파일 다운로드

  // input filename
  var fileUrl = $('.btn_download').attr('download');
  $('.fileName2').text(fileUrl);

  // taphold
  $('.section_award .list_bxIn li a').on('taphold', function() {
    alert('ddd');
  });




  // items label design
  var itemsDone = $('.items_done'),
    itemsBest = $('.items_best');

  itemsBest.find('.bx_title').append('<div class="circle_blue"><span>닉네임</span><p class="items_win">50,000</p></div>');


  // changeTxt
  var changeTxt = function() {
    $('.ask_direct ul .items_answered').find('.status').text('답변완료');
    $('.section_mycontest ul .items_allowed').find('.status').text('승인완료');
    // $('.section_direct ul .items_waiting').find('.status').text('답변대기');
  };

  changeTxt();









  // swiper
  var swiper = new Swiper('.slide1', {
    navigation: {
      nextEl: '.btn_slide.next',
      prevEl: '.btn_slide.prev',
    },
    slidesPerView: 1,
    // spaceBetween: 1,
    autoplay: {
      delay: 3000,
      disableOnInteraction: true
    },
    loop: true,
    followFinger: true,
    pagination: {
      el: '.swiper_paging',
      type: 'bullets',
    },
    // speed:
  });


  // css =================================================================
  var changePadding = function() {
    if ($('.list_info .items_push').length > 0) {
      $('.list_info .items_push').parents('li').find('p').css('padding', '.85rem 0px 0.5rem');
    }
  };
  changePadding();



  // my/ find.html======================================================
  var btn_chk = $('.list_find > li a');
  btn_chk.on('click', function() {
    $(this).addClass('checked');
    $(this).parent().siblings().children().removeClass('checked');
    return false;
  });

  var btn_send = $('.list_send > li a');
  btn_send.on('click', function() {
    var btn_send_idx = $(this).parent().index();
    $('.bx_send').children().eq(btn_send_idx).addClass('on');
    $('.bx_send').children().eq(btn_send_idx).siblings().removeClass('on');
  });


  //choice emial
  var sel_em = $('.sel_em');
  sel_em.change(function() {
    if (sel_em.val() !== '직접입력') {
      $(this).parents('.bx_email').find('.input_02').css('display', 'none');
    } else {
      $(this).parents('.bx_email').find('.input_02').css('display', 'block')
    }
  });

  $('.btn_chgBlue').on('click', function() {
    $(this).addClass('on');
    $(this).parent().siblings().children().removeClass('on');
  });


  // make.html //

  // 결제 금액
  var bx_num = $('.bx_total_num'),
    bx_point = $('.bx_total_point'),
    bx_total = $('.bx_total .color_blue');




  $('.wrap_select_02.num select').change(function() {
    var val_num = $(this).val();
    // bx_num.val(val_num);
    bx_num.attr('value', val_num);
    // bx_total.text(val_num);
  });

  $('.wrap_select_02.point select').change(function() {
    var val_point = $(this).val();
    bx_point.attr('value', val_point);
  });






  // var total = val_num*val_point;




  // if($('.bx_total_num').val().length > 0 && $('.bx_total_point').length > 0){
  //   console.log('dd');
  // }









});
