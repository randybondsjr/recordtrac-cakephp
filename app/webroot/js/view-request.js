$(document).ready(function(){
  $('.combobox').combobox();
  $('.lead').readmore({
    moreLink: '<p class="lead"><a href="#">More&hellip;</a></p>',
    lessLink: '<p class="lead"><a href="#">Less&hellip;</a></p>'
  });
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
  })
  
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
  })
  
  $("[id^=removeHelper]").popover({ 
      html : true,
      title: function() {
        var num = this.id.slice(12);
        return $("#removehelper-head"+num).html();
      },
      content: function() {
        var num = this.id.slice(12);
        return $("#addhelper-content"+num).html();
      },
      placement: 'left'
  });
  $("[id^=removeHelper]").on('shown.bs.popover', function () {
    var num = this.id.slice(12);
    $('.close').on('click',function(){
      $('#removeHelper'+num).popover('hide');
    });
  })
    //var num = this.id.slice(12);
    //console.log(num);
    
  //});
});