$(function(){
	function myclick(){
	   tel_chk = true;
	   $(".count_down").plug_in_time({
		 minute : 3,
		 second : 0,
		 msec   : 0
	   });
	 }

	$('.btn_verify, .btn_re').on('click',function(){
		b_time =  0;

		PlaySound_nolink();
		var birth	= $("#chk_birth").val();
		var tel		= $("#chk_tel").val();
		var obj		=	$(this);

		if($(".count_down").find(".minute").length > 0){
			return false;
		}
	  

		$.post("/_common/auth.php",{
			phoneNo		:	tel,
			birthDay	:	birth
		},function(e){
			if(e.errNo){
				alert(e.rtnMsg);
			}else{
				if($(this).hasClass('btn_verify')){
					obj.css('display','none');
				}
				$('.bx_verify').addClass('show');
				myclick();
				
			}
		},"json");
	});


	// keypad

	var key_gubun = "";
	var input_keypad = $('.bx_keypad > input'),
		keypad = $('.bx_keypad'),
		btn_num = $('.keypad button');

	$('.list_type1 li > input').focus(function(){ //키패드 열림 및 포커스
		b_time =  0;

	  PlaySound_nolink();
	  keypad.css('display','block');
	  input_keypad.focus();

	  if($(this).hasClass('chk_birth')){
		input_keypad.attr('placeholder','예시) 750917');
		key_gubun = "birth";
	  }else if($(this).hasClass('chk_tel')){
		input_keypad.attr('placeholder','예시) 010-9999-9999');
		key_gubun = "tel";
	  }else if($(this).hasClass('chk_num')){
		input_keypad.attr('placeholder','');
		key_gubun = "num";
	  }
	});

	keypad.find(".key_num").on("click",function(){ //숫자 버튼
		b_time =  0;

		PlaySound_nolink();
		var n = $(this).html();
		var old_v = input_keypad.val();

		if(key_gubun == 'birth'){
			if(old_v.length >= 6){
				return false;
			}
			
			input_keypad.val(old_v+n+"");
		}else if(key_gubun == 'tel'){
			if(old_v.length >= 13){
				return false;
			}

			if(old_v.length == 3 || old_v.length == 8){
				old_v += "-";
			}
			
			input_keypad.val(old_v+n+"");
		}else if(key_gubun == 'num'){
			if(old_v.length >= 5){
				return false;
			}
			
			input_keypad.val(old_v+n+"");
		}

		
	});

	$(".btn_complete").on("click",function(){ //입력완료 버튼
		b_time =  0;

		PlaySound_nolink();
		var n = input_keypad.val();
		if(key_gubun == 'birth'){
			$("#chk_birth").val(n);
		}else if(key_gubun == 'tel'){
			$("#chk_tel").val(n);
		}else if(key_gubun == 'num'){
			$("#chk_num").val(n);
		}

		keypad.find('.btn_cancel').click();
	});


	$('.btn_reset').on('click',function(){ //리셋 버튼
		b_time =  0;

	  PlaySound_nolink();
	  input_keypad.val("").focus();
	});
	keypad.find('.btn_cancel').on('click',function(){
		b_time =  0;

	  PlaySound_nolink();
	  keypad.css('display','none');
	  input_keypad.val("");
	});

	$(".btn_code_ok").on("click",function(){
		PlaySound_nolink();
		var birth	= $("#chk_birth").val();
		var tel		= $("#chk_tel").val();
		var num		= $("#chk_num").val();
		var obj		=	$(this);
		
		$.post("/_common/auth_check.php",{
			phoneNo		:	tel,
			authNum		:	num,
			birthDay	:	birth
		},function(e){
			if(e.errNo){
				b_time =  0;

				$(".popup_error").show();
				//alert(e.rtnMsg);
			}else{
				$("#w_frm").attr("action","policy_agree.html");
				$("#w_frm").find('[name="birth"]').val($("#chk_birth").val());
				$("#w_frm").find('[name="tel"]').val($("#chk_tel").val());
				$("#w_frm").find('[name="authNum"]').val($("#chk_num").val());
				$("#w_frm").submit();
			}
		},"json");
	});



});