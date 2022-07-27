$(function(){

  // 메인 비주얼
  const swiper1 = new Swiper(".sec_visual .swiper-container", {
    pagination: {
          el: ".swiper-pagination",
          type:'fraction'
        },
  });


  const swiper2 = new Swiper(".sec_notice .swiper-container", {
    direction: "vertical",
    navigation: {
          nextEl: ".sec_notice .btn_next",
          prevEl: ".sec_notice .btn_prev",
        },
    loop:true
  });





});
