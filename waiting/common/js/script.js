
$(document).ready(function(){
	//ȭ�� ������
	$("html, body").stop().animate({scrollTop:0},300);
	$("#wrap").css("height",$(window).height());
	$("#wrap").css("width",$(window).width());

	//sns ���
	$('.container_sns li a').mouseover(function(){
		$(this).find('img').addClass('bounce');
	});
	$('.container_sns li a').mouseleave(function(){
		$(this).find('img').removeClass('bounce');
	});

	//��¥ ī��Ʈ
	$('#clock').countdown('2022/8/31', function(event) {
	  var $this = $(this).html(event.strftime(''
		+ '<div><span>%d</span> <span>Days</span></div> '
		+ '<div><span>%H</span> <span>Hours</span></div> '
		+ '<div><span>%M</span> <span>Minutes</span></div> '
		+ '<div><span>%S</span> <span>Seconds</span></div>'));
	});
	//���� ��ǲ�ڽ� �÷�����
	$('.container_div .container_bot input').click(function(){
		$(this).css('border-color','#f19c4f')
	});
});
//ȭ�� ��������
$(window).resize(function() {	
	$("#wrap").css("width",$(window).width())
	$("#wrap").css("height",$(window).height())	
});
