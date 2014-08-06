$(document).ready(function(){
  $('.lead').readmore({
    moreLink: '<p class="lead"><a href="#">More&hellip;</a></p>',
    lessLink: '<p class="lead"><a href="#">Less&hellip;</a></p>'
  });
  $('#reassign').popover({ 
      html : true,
      title: function() {
        return $("#popover-head").html();
      },
      content: function() {
        return $("#popover-content").html();
      },
      placement: 'left'
  });
  $('#reassign').on('shown.bs.popover', function () {
    $('.close').on('click',function(){
      $('#reassign').popover('hide');
    });
  })
});