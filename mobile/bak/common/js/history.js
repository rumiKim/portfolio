//목록
function list_html(page, pageLimit){
	var codeLK		= $(".codeLK").val();
	var winYN		= $(".winYN").val();
	var sortType	= $(".sortType").val();

	$.get("/contents/history_list.php",{
		page		:	page,
		pageLimit	:	pageLimit,
		codeLK		:	codeLK,
		winYN		:	winYN,
		sortType	:	sortType
	},function(e){
		var html = '';
		if(e.totalCnt > 0){
			
			for(var i=0;i<e.datas.length;i++){
				/*switch(e.datas[i].winYN) {
					case 'N' : var winY	= '이월'; break;
					case 'Y' : var winY	= '당첨'; break;
					default  : var winY = '-'; break;
				}*/

				if(e.datas[i].codeLK == 'MM'){
					var p_color = 'item_mega';
				}else{
					var p_color = 'item_power';
				}

				if(e.datas[i].winNos > 0){
					var winNos = "당첨";
					var cla    = "item_win";
				}else{
					var winNos = "낙첨";
					var cla    = "";
				}

				if(e.datas[i].winMoney == ''){
					var winMoney = 0;
				}else{
					var winMoney = number_format(e.datas[i].winMoney,"",",");
				}

				if(e.datas[i].ticketUrls){
					var url = e.datas[i].ticketUrls[0];
				}else{
					var url = '';
				}

				html += '<li class="' + p_color + ' ' + cla + ' wrap">';
					html += '<p class="title"><span class="hide">복권명</span><span>' + e.datas[i].lkName + '</span></p>';
					html += '<ul class="list_info">';
						html += '<li>추첨<span>' + e.datas[i].playDate + '</span></li>';
						html += '<li>신청<span>' + e.datas[i].regDate + '</span></li>';
						html += '<li>게임수<span>' + e.datas[i].ticketCnt + '</span></li>';
					html += '</ul>';
					html += '<div class="bx_prize flex_space">';
						html += '<p>결과<span class="">' + winNos + '</span></p>';
						html += '<div><p>' + winMoney + '</p></div>';
					html += '</div>';
					html += '<div class="bx_btn flex_space">';
						html += '<button class="btn_chkNum btn_type1" data-no="' + e.datas[i].oSeq + '" data-gubun="' + e.datas[i].codeLK + '">신청 번호 확인</button>';
						html += '<button class="btn_scan btn_type1" data-url="' + url + '">복권 스캔 확인</button>';
					html += '</div>';
				html += '</li>';
			}
		}

		if(page == 1){
			$(".list_result").html(html);
		}else{
			$(".list_result").append(html);
		}

		if(html == ''){
			$(".btn_more").hide();
		}
	},"json");
}

$(function(){

var btn_chkNum	= '.sec_history .btn_chkNum';
var pop_history	= $('.pop_history');

//복권 스캔
$(document).on('click','.btn_scan',function(){
	var src = $(this).data("url");

	if(src != ''){
		$('.pop_scan').addClass('on');
		$('.pop_scan').find("img").attr("src",src);
	}
});

//신청 번호 확인
$(document).on('click', btn_chkNum,function(){
	var oSeq  = $(this).data("no");
	var gubun = $(this).data("gubun");

	$.get("/contents/history_detail.php",{
		oSeq	:	oSeq,
	},function(e){
		if(e.errNo > 0){
			alert(e.errMsg);
			return false;
		}

		if(e.totalCnt <= 0){
			$(".info_list").html("");
			pop_history.addClass('on');
			return false;
		}

		var html = "";
		var s    = 1;
		for(var i=0;i<e.datas.length;i++){
			if(gubun == 'MM'){
				var p_color = 'mega';
			}else{
				var p_color = 'power';
			}

			html += '<li>';
				html += '<ul class="list_info clear">';
					html += '<li>티켓 NO.<span>' + s + '</span></li>';
					html += '<li>게임 NO.<span>' + s + '</span></li>';
				html += '</ul>';
				html += '<ul class="list_ball">';
					html += '<li>' + e.datas[i].ballNumDs[0] + '</li>';
					html += '<li>' + e.datas[i].ballNumDs[1] + '</li>';
					html += '<li>' + e.datas[i].ballNumDs[2] + '</li>';
					html += '<li>' + e.datas[i].ballNumDs[3] + '</li>';
					html += '<li>' + e.datas[i].ballNumDs[4] + '</li>';
					html += '<li class="' + p_color + '">' + e.datas[i].ballNumP[0] + '</li>';
				html += '</ul>';
			html += '</li>';

			s++;
		}

		$(".info_list").html(html);
		pop_history.addClass('on');
	},"json");
});



});