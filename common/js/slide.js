$(function(){
  const swiper1 = new Swiper(".sec_visual .swiper-container", {
    pagination: {
          el: ".swiper-pagination",
        },
  });
  const swiper2 = new Swiper(".sec_event .swiper-container", {
    pagination: {
          el: ".sec_event .swiper-pagination",
        },
  });
});
