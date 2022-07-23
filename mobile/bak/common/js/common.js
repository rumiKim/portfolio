// result_mega / power .html
function isRealNum(val){

	if(val === "" || val ==null){
		return false;
	}
	if(!isNaN(val)){
		return true; 
	}else{ 
		return false; 
	} 
}

function number_format(number,bit,sign,gapnum){
	var bit    = arguments[1] ? arguments[1] : 2 ;
	var sign   = arguments[2] ? arguments[2] : ' ' ;
	var gapnum = arguments[3] ? arguments[3] : 3 ;
	var str    = '' ;

	number	   = Number(number);

	if(!isRealNum(number)){
		return 0;
	}

	number     = number.toFixed(bit);
	realnum    = number.split('.')[0];
	realnumarr = realnum.split('');
	
	for(var i=1;i<=realnumarr.length;i++){
		str = realnumarr[realnumarr.length-i] + str ;
		if(i%gapnum == 0){
			str = sign+str;
		}
	}
	
	str = (realnum.length%gapnum==0) ? str.substr(1) : str;
	realnum = str;
	return realnum;
}

//날자변경
function convertDate(str,val){
	// 아이폰에서는 아래와 같이 임시변환
	str = str.replace(/-/g,'/');
	var date = new Date(str);
	
	if (date == 'Invalid Date') {
		// 아이폰에서는 아래와 같이 변환해야 함
		date = new Date(str.split('+')[0]);
	}

	var info = getDateInfo(date);
	return info[val];
}

//날자변경
function getDateInfo(date_str) {
	if(date == ''){
		return false;
	}
	
	var date= new Date(Date.parse(date_str));

	var wstr = ['일', '월', '화', '수', '목', '금', '토'];
	var yyyy = date.getFullYear();
	var mm = Number(date.getMonth()) + 1;
	var m = Number(date.getMonth()) + 1;
	var dd = date.getDate();
	var idx = date.getDay();
	var hh = date.getHours();
	var ii = date.getMinutes();

	mm = String(mm).length === 1 ? '0' + mm : mm;
	dd = String(dd).length === 1 ? '0' + dd : dd;
	hh = String(hh).length === 1 ? '0' + hh : hh;
	ii = String(ii).length === 1 ? '0' + ii : ii;

	return {
		str : yyyy + "-" + mm + "-" + dd + "(" + wstr[idx] + ")",
		str2: m + "." + dd + "" + dd + "일 " + wstr[idx] + "요일 " + hh + ":" + ii + "(현지시간)",
		str3: mm + "월 " + dd + "일 " + wstr[idx] + "요일 " + hh + ":" + ii + "",
		str4: yyyy + "-" + mm + "-" + dd,
		yyyy: yyyy,
		mm  : mm,
		dd  : dd,
		ws  : wstr[idx]
	};
}




$(function(){

// gnb
$('.btn_menu').on('click',function(){
  $('body').css('overflow','hidden');
  $('#wrap_gnb').addClass('on');
});


var btn_closeMenu = $('#wrap_gnb .btn_close');

btn_closeMenu.on('click',function(){
  $(this).parents('body').removeClass('menuClose');
});



var chgPadding = function() {
  var tab = $('.tab_type1');
  if($('body').find(tab).length > 0){
    tab.parent('main').css('padding-top','33.32vw');
  }
};
chgPadding();


// tabbox
var btn_tab = $('.list_tab li button');
btn_tab.on('click',function(){
  var idx_tab = $(this).parent('li').index(); //부모 li index
  $(this).parent().addClass('on');
  $(this).parent().siblings().removeClass('on');
  $(this).parents('.sec_tab').find('.bx_tab').eq(idx_tab).addClass('on');
  $(this).parents('.sec_tab').find('.bx_tab').eq(idx_tab).siblings('.bx_tab').removeClass('on');
});


// popup 기본
var btn_pop = $('.btn_pop'),
    btn_popClose = $('.pop_type1 .btn_close');

btn_pop.on('click',function(){
  $(this).parents('body').find('.pop_type1').addClass('on');
});
btn_popClose.on('click',function(){
  $(this).parents('body').css('overflow','visible');
  $(this).parents('.pop_type1').removeClass('on');
});



// list_fold

var btn_fold = '.list_fold > li > a';
$(document).on('click', btn_fold,function(e){
  $(this).toggleClass('on');
  $(this).next('div').slideToggle();
  $(this).parent('li').siblings().find('a').removeClass('on');

  if($('.board_type').length <= 0){
	return false;
  }

  var board_type = $('.board_type').val();
  var no		 = $(this).data("no");

  if(no == '' || typeof no == 'undefined'){
	return false;
  }

  $.get("/contents/cs/readnum.php",{
	bo_type	:	board_type,
	no		:	no
  },function(e){},"json");

});


// 공지사항
$('.sec_toggle .list_fold > li > a').on('click',function(e){
  e.preventDefault();
  $(this).parent('li').siblings().find('div').slideUp();
});


// gnb
var btn_gnb = $('#wrap_gnb .list_fold > li > a');
btn_gnb.on('click',function(e){
  if($(this).next('ul').length !== 0){ //ul안에 ul있을 경우
    e.preventDefault();
    $(this).next('ul').slideToggle();
    $(this).parent().siblings().children('ul').slideUp();
  }else{ // ul안에 ul 없을 경우
	  var href = $(this).attr("href");

	  if(href != '' && typeof href != 'undefined'){
		location.href = href;
	  }
  }
});

$('#wrap_gnb .btn_close').on('click',function(){
  $('#wrap_gnb').removeClass('on');
});

});