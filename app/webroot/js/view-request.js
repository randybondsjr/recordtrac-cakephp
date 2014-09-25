$(document).ready(function(){
  $('.selectpicker').selectpicker();
  $('[rel=tooltip]').tooltip();
  
  //more link
  $('.lead').readmore({
    moreLink: '<p class="lead"><a href="#">More&hellip;</a></p>',
    lessLink: '<p class="lead"><a href="#">Less&hellip;</a></p>'
  });
  $('.longdescription').readmore({
    maxHeight: 38,
    moreLink: '<p><a href="#">More&hellip;</a></p>',
    lessLink: '<p><a href="#">Less&hellip;</a></p>'
  });
  
  //REASSIGN REQUEST
  $('#reassign').popover({ 
      html : true,
      title: function() {
        return $("#reassign-head").html();
      },
      content: function() {
        return $("#reassign-content").html();
      },
      placement: 'left'
  });
  $('#reassign').on('shown.bs.popover', function () {
    $('.close').on('click',function(){
      $('#reassign').popover('hide');
    });
  });
  
  //ADD HELPER
  $('#addHelper').popover({ 
      html : true,
      title: function() {
        return $("#addhelper-head").html();
      },
      content: function() {
        return $("#addhelper-content").html();
      },
      placement: 'left'
  });
  $('#addHelper').on('shown.bs.popover', function () {
    $('.close').on('click',function(){
      $('#addHelper').popover('hide');
    });
  });
  
  //REMOVE HELPER
  $("[id^=removeHelper]").popover({ 
      html : true,
      title: function() {
        var num = this.id.slice(12);
        return $("#removehelper-head"+num).html();
      },
      content: function() {
        var num = this.id.slice(12);
        return $("#removehelper-content"+num).html();
      },
      placement: 'left'
  });
  $("[id^=removeHelper]").on('shown.bs.popover', function () {
    var num = this.id.slice(12);
    $('.close').on('click',function(){
      $('#removeHelper'+num).popover('hide');
    });
  });
  
  //History popover
  $('#historyPopover').popover({ 
      html : true,
      title: function() {
        return $("#history-head").html();
      },
      content: function() {
        return $("#history-content").html();
      },
      placement: 'bottom'
  });
  $('#historyPopover').on('shown.bs.popover', function () {
    $('.close').on('click',function(){
      $('#historyPopover').popover('hide');
    });
  });
  
  $("#subscribeHelp").popover({
    placement: "left"
  });
  
  //staff actions
  $('.rw-btn-wrap').click(function(){
    $(this).addClass('active');
    var target = $(this).data("target");
    $(".target-for").not(target).hide();
    $('.rw-btn-wrap').not(this).removeClass('active');
    $("[data-target-for='"+target+"']").slideDown();
    //
  });

  $('#extend-request').click(function(e){
    e.preventDefault();
    var val = $('#ExtendExtendReasons').val();
    console.log(val);
    $('#ExtendText').append(val);
    $('#extendModal').modal('show');
  });
  $('#close-request').click(function(e){
    e.preventDefault();
    var val = $('#CloseClosedReasons').val();
    console.log(val);
    $('#CloseText').append(val);
    $('#closedModal').modal('show');
  });

});