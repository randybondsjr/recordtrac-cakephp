$(function() {
  $( ".date-picker" ).datepicker({
    //comment the beforeShow handler if you want to see the ugly overlay
    beforeShow: function() {
      setTimeout(function(){
        $('.ui-datepicker').css('z-index', 99999999999999);
      }, 0);
    }
  });

  $("#RequestRequestStart").datepicker({
    maxDate: 0,
    beforeShow: function() {
      setTimeout(function(){
        $('.ui-datepicker').css('z-index', 99999999999999);
      }, 0);
    },
    onSelect: function(selected) {
      $("#RequestRequestEnd").datepicker("option","minDate", selected)
    }
  });
  $("#RequestRequestEnd").datepicker({
    maxDate: 0,
    beforeShow: function() {
      setTimeout(function(){
        $('.ui-datepicker').css('z-index', 99999999999999);
      }, 0);
    },
    onSelect: function(selected) {
       $("#RequestRequestStart").datepicker("option","maxDate", selected)
    }
  });
});