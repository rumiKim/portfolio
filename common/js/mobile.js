$(function(){

  $('.sel_link').on('change',function(){
    let url = $(this).val();
    location.href = url
  });


  $('.list_faq > li > a').on('click',function(e){
    e.preventDefault()
    $(this).next().stop().slideToggle(200);
    $(this).parent().toggleClass('active');
    $(this).parent().siblings().removeClass('active');
    $(this).parent().siblings().children('div').slideUp(200);

  });

});
