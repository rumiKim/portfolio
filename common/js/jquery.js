$(document).ready(function() {


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


    if( scrollBtm < 100 || scrollTop < 60){
      $('.btn_top').removeClass('show');
    }else{
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
  $('.dim').on('click',function(){
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
    $('body').css('overflow','hidden');
    input_search.focus();
    return false;
  });



    // 검색페이지로 이동
  btn_search.on('click',function(){
    if (input_search.val().length > 0) {
      $(location).attr('href', '../contents/search.html');
      bx_search.removeClass('on');
      input_search.val('');
    }else {
      alert('검색어를 입력해주세요');
    }
  });




  // popupOpen & close
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

  // bx_viewAll
  $('.btn_viewAll').on('click',function(){
    $('.bx_viewAll').addClass('show');
  });


// popup
  $('.btn_make').on('click',function(){
    $('.popup_make').addClass('show');
  });

  $('.btn_apply').on('click',function(){
    $('.popup_apply').addClass('show');
  });


  var btn_close02 = $('.btn_popupClose_02');
  btn_close02.on('click',function(){
    $(this).parents('.bx_popup_02').removeClass('show');
    $('body').css('overflow','visible');
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

  btn_fav.on('click',function(){
    $(this).toggleClass('clicked');
  });
  btn_scrap.on('click',function(){
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
	var fileUrl = $('.btn_download').attr('href');
	$('.fileName2').text(fileUrl);

	// taphold
	$('.section_award .list_bxIn li a').on('taphold', function() {
		alert('ddd');
	});




// items label design
  var itemsDone = $('.items_done'),
    itemsBest = $('.items_best');

  itemsBest.find('.bx_title').append('<div class="circle_blue"><span>닉네임</span><p class="items_win">50,000</p></div>');
  // list_simple
  // $('.list_simple').find(itemsBest).append('<div class="circle_blue"><span>닉네임</span><p class="items_win">50,000</p></div>');


  // changeTxt

  var changeTxt = function(){
    $('.ask_direct ul .items_answered').find('.status').text('답변완료');
    $('.section_mycontest ul .items_allowed').find('.status').text('승인완료');
  };

  changeTxt();










  // swiper
    var swiper = new Swiper('.slide1', {
      navigation: {
        nextEl: '.btn_slide.next',
        prevEl: '.btn_slide.prev',
      },
      slidesPerView: 1,
      spaceBetween: 15,
      autoplay:{
        delay:3000,
        disableOnInteraction:true
      },
      loop:true,
      followFinger: true,
      pagination: {
        el: '.swiper_paging',
        type: 'bullets',
      },
      // speed:
    });



    var changePadding = function(){
      if ($('.list_info .items_push').length > 0) {
        $('.list_info .items_push').parents('li').find('p').css('padding','1.1rem 0 .2rem');
      }
    };

    changePadding();













});
