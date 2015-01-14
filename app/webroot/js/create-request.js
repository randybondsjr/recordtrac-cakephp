$(document).ready(function(){
    $('.combobox').combobox();
    $("#RequestText").popover({
        html: true,
        content: "Describe in detail the records you need. This message can be viewed by the public. Don’t reveal personal information about yourself or others.",
        placement: "bottom",
        trigger: 'focus'
    });
    $("#RequesterEmail").popover({
        html: true,
        content: "This email address can be viewed by the public. We'll use it to send updates about your request.",
        placement: "bottom",
        trigger: 'focus'
    });
    $("#RequesterAlias").popover({
        html: true,
        content: "This name can be viewed by the public.",
        placement: "bottom",
        trigger: 'focus'
    });
    $("#RequesterPhone").popover({
        html: true,
        content: "Only employees will be able to view this information.",
        placement: "bottom",
        trigger: 'focus'
    });
    $("#RequestRequestStart").popover({
        html: true,
        content: "Choose a date when the records you are requesting should start. If no end date is chosen, the end date for the request will be today.",
        placement: "top",
        trigger: 'focus'
    });
    $("#RequestRequestEnd").popover({
        html: true,
        content: "Choose a date when the records you are requesting should end. This may not be in the future.",
        placement: "top",
        trigger: 'focus'
    });
    
    $('#RequestText').on('blur', function() {
    
    request_text = $(this).val();
    request = $.ajax({
      url: 'is_public_record',
      type: 'post',
      data: {
        request_text: request_text
      }
    });
    request.done( function(data) {
      console.log(data);
      $div = $('#not_public_record');
      if (data != '') {
        $div.addClass('alert').addClass('alert-danger');
        $div.html(data);
        $div.prepend("<span class='glyphicon glyphicon-exclamation-sign'></span>&nbsp;");
      } else {
        $div.empty();
        $div.removeClass('alert').removeClass('alert-error');
      }
    });
  })
});