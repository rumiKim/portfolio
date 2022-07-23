// $(document).ready(function(){

  function view2(){
    $.ajax({
      url: "../test/index.html",
      dataType: "text",
      success: function(data){
        $("#ee").html(data);
      }
    });
  }



// });
