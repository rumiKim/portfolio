$(function() {

      // 메뉴
      const siteMap = $('.sitemap'),
        gnbListItem = $('.gnb_total li > a');


      $('.btn_menu').on('click', function() {
        siteMap.toggleClass('active');
      });

      gnbListItem.on('click',function(e){
        if($(this).next().length > 0){
          e.preventDefault();
          $(this).toggleClass('active');
          $(this).parent().siblings().children('a').removeClass('active')
        }
      });





        // select 페이지 이동
        $('.sel_link').on('change', function() {
          let url = $(this).val();
          location.href = url
        });


        // 자주묻는 질문 드롭다운 리스트
        $('.list_faq > li > a').on('click', function(e) {
          e.preventDefault()
          $(this).next().stop().slideToggle(200);
          $(this).parent().toggleClass('active');
          $(this).parent().siblings().removeClass('active');
          $(this).parent().siblings().children('div').slideUp(200);
        });




      }); //jquery function end
