$(document).ready(function(){
  $('.collapsible').collapsible();
  $('.modal').modal();
  $('.tooltipped').tooltip();

  $("li#codeComp").on("click", function(){
    $("div#example").hide();
    $("div#codeComp").show();
    $("a#zoomIn").hide();
  });
  $("li#learn").on("click", function(){
    $("div#example").show();
    $("div#codeComp").hide();
    $("a#zoomIn").show();
  });$("li#ins").on("click", function(){
    $("div#example").show();
    $("div#codeComp").hide();
    $("a#zoomIn").show();
  });

});
