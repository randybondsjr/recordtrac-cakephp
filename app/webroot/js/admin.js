//Initial load of page
$(document).ready(sizeContent);

//Every resize of window
$(window).resize(sizeContent);

//Dynamically assign height
function sizeContent() {
    var newHeight = $("html").height() - $(".navbar-fixed-top").height() - $(".admin-head").height() - ($("#footer").height()*2) + 56 + "px";
    $(".full-height").css("height", newHeight);
}