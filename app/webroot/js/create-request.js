$(document).ready(function(){
    $('.combobox').combobox();
    $("#RequestText").popover({
        html: true,
        content: " Describe in detail the records you need. This message can be viewed by the public. Don’t reveal personal information about yourself or others.",
        placement: "bottom",
        trigger: 'focus'
    });
    $("#RequesterEmail").popover({
        html: true,
        content: "No one will be able to view your email address. We'll use it to send updates about your request.",
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