$(function(){
	// 자동수동선택
	var num		= Number($('[name="num"]').val());
	var chk		= Number($('[name="chk"]').val());
	var w_html	= '';
	var color	= $('[name="colors"]').val();


	function button_chk(nm, val,objs){
		var obj = $(".cart_list").find("ol").eq(chk);
		var line = true;

		PlaySound_nolink();

		if(obj.find("li").eq(nm).find("button").html() != ''){
			return false;
		}

		if(nm == 5){
			objs.addClass(color);
		}else{
			objs.addClass("white");
		}

		obj.find("li").eq(nm).find("button").html(val);
		obj.find(".btn_del").removeClass("btn_gray");

		obj.find("li").each(function(){
			if($(this).find("button").html() == ''){
				line = false;
			}
		});

		if(line){

			$("#five_btn").find(".white").removeClass("white");
			$("#one_btn").find("."+color).removeClass(color);

			if(chk == num-1){
				$(".btn_type1").removeClass("bg_gray");
				$(".btn_type1").addClass("bg_"+color);
			}else{
				chk++;
			}
		}
		
	}
	//삭제
	$(document).on("click",".btn_del",function(){
		b_time =  1;

		var obj   = $(this).parent().parent();
		var d_num = $(".cart_list").find(".btn_del").index(this);
		var html  = "";

		PlaySound_nolink();

		for (var i=0; i<6; i++){
			obj.find('li').eq(i).find("button").html("");
		}

		$(".btn_type1").removeClass("bg_"+color);
		$(".btn_type1").addClass("bg_gray");

		$(this).addClass("btn_gray");

		var html  = $(".cart_list").find("ol").eq(d_num).html();

		$(".cart_list").find("ol").eq(d_num).remove();
		$(".cart_list").append('<ol class="list_common">'+html+'</ol>');

		if(($("#five_btn").find(".white").length < 5 || $("#one_btn").find("."+color).length < 1) && chk != d_num){
			chk--;
		}else{

			$("#five_btn").find(".white").removeClass("white");
			$("#one_btn").find("."+color).removeClass(color);

			chk = $(".cart_list").find(".btn_del").index($(".cart_list").find(".btn_gray:eq(0)"));
		}
		
	});

	//화이트 번호
	$(document).on("click","#five_btn button",function(){
		b_time =  1;

		var nm  = $("#five_btn").find(".white").length;
		var val = $(this).html();

		if(nm >= 5){
			return false;
		}

		if($(this).is(".white")){
			return false;
		}

		//$(this).addClass("white");

		button_chk(nm, val,$(this))

	});

	//노랑 버튼
	$(document).on("click","#one_btn button",function(){
		b_time =  1;

		var nm  = $("#one_btn").find("."+color).length;
		var val = $(this).html();

		if(nm >= 1){
			return false;
		}

		if($(this).is("."+color)){
			return false;
		}

		//$(this).addClass(color);

		button_chk(5, val,$(this))
	});

	//확인 버튼
	$(document).on("click",".btn_type1",function(){
		var numbers = new Array();
		var s		= 0;

		PlaySound_nolink();

		$(".cart_list").find("ol").each(function(){
			var number = "";
			for(var i=0;i<6;i++){
				number += $(this).find("li").eq(i).find("button").html() + ",";
			}

			$(".number_in").eq(s).val(number);
			s++;
		});

		$("#w_frm").submit();
	});
});