$(function(){
	var src     = "/common/button.mp3";
	var borswer = window.navigator.userAgent.toLowerCase();
	if(borswer.indexOf("trident") >= 0){
		var strEmbed = '<embed id="button_c" src="'+src+'" autostart="true" hidden="true" loop="false"></embed>';
		if($("body").find("#button_c").length <= 0){
			$("body").append(strEmbed);
		}
		var btn_play = document.getElementById("button_c");
		btn_play.volume = 0;
	}else{
		var strAudio = "<audio id='button_c' src='"+src+"' hidden='true'>";
		if($("body").find("#button_c").length <= 0){
			$("body").append(strAudio);
		}
		
		var btn_play = document.getElementById("button_c");

	}
});

function TimeDown(id, value){

	var totalSeconds	= parseInt(value / 1000);
	var modulo			= totalSeconds % (60 * 60 * 24);
	var hours			= Math.floor(modulo / (60 * 60));
	var day				= Math.floor(totalSeconds / (60 * 60 * 24));
	modulo				= modulo % (60 * 60);

	var minutes			= Math.floor(modulo / 60);
	var seconds			= modulo % 60;

	day					= day.toString().length == 1 ? '0' + day : day + "";
	hours				= hours.toString().length == 1 ? '0' + hours : hours + "";
	minutes				= minutes.toString().length == 1 ? '0' + minutes : minutes + "";
	seconds				= seconds.toString().length == 1 ? '0' + seconds : seconds + "";

	var items_day		= '<li class="items_day"><span>'+day.substr(0,1)+'</span><span>'+day.substr(1,1)+'</span></li>';
	var items_hours		= '<li class="items_hours"><span>'+hours.substr(0,1)+'</span><span>'+hours.substr(1,1)+'</span></li>';
	var items_min		= '<li class="items_min"><span>'+minutes.substr(0,1)+'</span><span>'+minutes.substr(1,1)+'</span></li>';
	var items_sec		= '<li class="items_sec"><span>'+seconds.substr(0,1)+'</span><span>'+seconds.substr(1,1)+'</span></li>';


	document.getElementById(id).innerHTML = items_day + items_hours + items_min + items_sec;

	if(day == "00" && hours == "00" && minutes == "00" && parseInt(seconds)-1<0){

	}else{
		setTimeout(function () {
			TimeDown(id, value-1000);
		}, 1000)
	}

}

function PlaySound(link){
	var btn_play = document.getElementById("button_c");
	btn_play.play();

	setTimeout(function () {
		location.href = link;
	}, 900)
	
}

function PlaySound_nolink(){
	var btn_play = document.getElementById("button_c");
	btn_play.play();
	
}


var b_time =  0;
function back_time(){
	b_time++;
	if(b_time >= 5){
		window.location.href= "/contents/popup.html";
	}
	else{
		setTimeout("back_time()",1000*60);
	}
}