//목록
function list_html(page, pageLimit){
	var schDateS		= $(".schDateS").val();
	var schDateE		= $(".schDateE").val();
	var sortType		= $(".sortType:checked").val();

	$.get("/contents/refund/list_refund.php",{
		page		:	page,
		pageLimit	:	pageLimit,
		schDateS	:	schDateS,
		schDateE	:	schDateE,
		sortType	:	sortType
	},function(e){
		var html = '';
		if(e.totalCnt > 0){
			
			for(var i=0;i<e.datas.length;i++){
				if(e.datas[i].csName == '신청'){
					var cla    = "";
				}else{
					var cla    = "item_win";
				}

				if(e.datas[i].cashMoney == ''){
					var cashMoney = 0;
				}else{
					var cashMoney = number_format(e.datas[i].cashMoney,"",",");
				}

				html += '<li class="item_mega ' + cla + ' wrap">';
					html += '<p class="title"><span class="hide">신청일</span><span>' + e.datas[i].regDate + '</span></p>';
					html += '<ul class="list_info">';
						html += '<li>은행<span>' + e.datas[i].bankOriName + '</span></li>';
						html += '<li>예금주<span>' + e.datas[i].accountName + '</span></li>';
						html += '<li>계좌번호<span>' + e.datas[i].accountNum + '</span></li>';
					html += '</ul>';
					html += '<div class="bx_prize flex_space">';
						html += '<p>결과<span class="">' + e.datas[i].csName + '</span></p>';
						html += '<div><p>' + cashMoney + '</p></div>';
					html += '</div>';
					html += '<div class="bx_btn flex_space">';
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