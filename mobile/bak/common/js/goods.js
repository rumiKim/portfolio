//추천안내 목록
function list_html(page, pageLimit, codeLK){
	if(codeLK == 'MM'){
		var p_color = 'mega';
	}else{
		var p_color = 'power';
	}
	$.get("/contents/drawing/result_list.php",{
		page		:	page,
		pageLimit	:	pageLimit,
		codeLK		:	codeLK
	},function(e){
		var html = '';
		if(e.totalCnt > 0){
			if(page == 1){
				$(".list_time").find("li").eq(0).find("div").html(convertDate(e.datas[0].playDateTimeKor, "str3"));
				$(".list_time").find("li").eq(1).find("div").html(convertDate(e.datas[0].playDateTime, "str3"));
				var winNums = e.datas[0].winNums.split(",");

				for(var i=0;i<winNums.length;i++){
					$(".one_ball").eq(0).find("li").eq(i).text(winNums[i]);
				}
			}

			
			for(var i=0;i<e.datas.length;i++){
				switch(e.datas[i].winYN) {
					case 'N' : var winY	= '이월'; break;
					case 'Y' : var winY	= '당첨'; break;
					default  : var winY = '-'; break;
				}

				var winNums = e.datas[i].winNums.split(",");

				html += '<li class="wrap">';
					html += '<ul class="list_info">';
						html += '<li>NO<span>' + e.datas[i].wiSeq + '</span></li>';
						html += '<li>일자<span>' + convertDate(e.datas[i].playDateTimeKor, "str3") + '</span></li>';
						html += '<li>결과<span>' + winY + '</span></li>';
					html += '</ul>';
					html += '<div class="bx_prize">';
						html += '<ul class="list_ball two_ball">';
							html += '<li>' + winNums[0] + '</li>';
							html += '<li>' + winNums[1] + '</li>';
							html += '<li>' + winNums[2] + '</li>';
							html += '<li>' + winNums[3] + '</li>';
							html += '<li>' + winNums[4] + '</li>';
							html += '<li class="' + p_color + '">' + winNums[5] + '</li>';
						html += '</ul>';
						html += '<div class="prize">';
							html += '<p>' + e.datas[i].winMoneyWon + '</p>';
							html += '<span>' + e.datas[i].winMoney + '</span>';
						html += '</div>';
					html += '</div>';
					html += '<div class="bx_btn flex_space">';
						html += '<button class="btn_type1">추첨방송</button>';
						html += '<button class="btn_type1 btn_read" data-no="' + e.datas[i].wiSeq + '">상세보기</button>';
					html += '</div>';
					html += '<div style="display:none;" class="iframe_div">' + e.datas[i].movieUrl + '</div>';
				html += '</li>';
			}

			$(".list_result").append(html);
		}

		if(html == ''){
			$(".btn_more").hide();
		}
	},"json");
}

// 추첨방송 & 상세보기 팝업

var btn_view = '.list_result .bx_btn button:last-child';
$(document).on('click',btn_view,function(){
	$(this).parents('body').css('overflow','hidden');
	$(this).parents('body').find('.pop_draw').addClass('on');

	var wiSeq	= $(this).data("no");
	var winNums	=$(this).parent().parent().find(".two_ball");

	$.get("/contents/drawing/result_info.php",{
		wiSeq	:	wiSeq
	},function(e){
		$(".info_now_date").html(convertDate(e.datas.playDateTime,"str2"));

		for(var i=0;i<6;i++){
			$(".info_ball").find("li").eq(i).text(winNums.find("li").eq(i).text());
		}

		for(var i=0;i<e.datas.winCnts.length;i++){
			$(".tb_info").find("tbody").find("tr").eq(i).find('td').eq(2).find("p").text(number_format(e.datas.winMoneys[i],"",","));
			$(".tb_info").find("tbody").find("tr").eq(i).find('td').eq(3).text(number_format(e.datas.winCnts[i],"",","));
		}
	},"json");
});

var btn_video = '.list_result .bx_btn button:first-child';
$(document).on('click',btn_video,function(){
	var obj  = $(this).parent().parent();
	var date = obj.find(".list_info").find("li").eq(1).find("span").html();
	if(obj.find(".iframe_div").html() == ''){
		return false;
	}

	$(".wrap_iframe").html(obj.html());
	$(".pop_video").find(".bx_txt").find("span").html(date + " 추첨영상");

	$(this).parents('body').css('overflow','hidden');
	$(this).parents('body').find('.pop_video').addClass('on');
});
// close video stop
$(document).on('click','.pop_video .btn_close',function(){
	$(this).parents('.pop_video').find('iframe').attr('src',$('iframe').attr('src'));
});