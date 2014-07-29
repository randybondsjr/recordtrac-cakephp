$(function(){
    var delay = (function(){
      var timer = 0;
      return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
      };
    })();
    $("#RequestTerm").keyup(function(){
          delay(function(){
      $("#RequestIndexForm").submit();
    }, 1000 );
        
    });
    $(".autocomplete").change(function(){
      $("#RequestIndexForm").submit();
    });
});