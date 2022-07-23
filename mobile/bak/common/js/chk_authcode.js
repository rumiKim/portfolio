$(function(){
	function myclick(){
	   tel_chk = true;
	   $(".count_down").plug_in_time({
		 minute : 3,
		 second : 0,
		 msec   : 0
	   });
	 }

	 $('.btn_re').on('click',function(){
		var birth	= $("#birth_find").val();
		var tel		= $("#id_find").val();
		var smsFlag	= $("#smsFlag").val();
		var obj		=	$(this);

		if($(".count_down").find(".minute").length > 0){
			return false;
		}
	  
		$.post("/_common/auth.php",{
			smsFlag		:	smsFlag,
			phoneNo		:	tel,
			birthDay	:	birth
		},function(e){
			if(e.errNo){
				alert(e.rtnMsg);
			}else{
				myclick();
				
			}
		},"json");
	});

	$(".btn_code_ok").on("click",function(){
		PlaySound_nolink();
		var birth	= $("#birth_find").val();
		var tel		= $("#id_find").val();
		var smsFlag	= $("#smsFlag").val();
		var num		= $("#num_birth").val();
		var obj		=	$(this);
		
		$.post("/_common/auth_check.php",{
			smsFlag		:	smsFlag,
			phoneNo		:	tel,
			authNum		:	num,
			birthDay	:	birth
		},function(e){
			if(e.errNo){
				b_time =  0;

				alert(e.rtnMsg);
			}else{
				$("#w_frm").submit();
			}
		},"json");
	});
});