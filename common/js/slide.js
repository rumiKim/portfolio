$(function() {


  const swiper1 = new Swiper(".index .sec_visual .swiper-container", {
    pagination: {
      el: '.swiper-pagination',
      clickable: true, // 페이징을 클릭하면 해당 영역으로 이동, 필요시 지정해 줘야 기능 작동
    },
    navigation: { // 네비게이션 설정
      nextEl: '.btn_slide.next',
      prevEl: '.btn_slide.prev',
    },
    loop:true
  });



});
