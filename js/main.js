$(document).ready(function() {

  $("select").material_select();
  $(".button-collapse").sideNav();

  $("#comment").on("click", () => {
    $("#text-div").toggleClass("scale-in").toggleClass("hidden");
    $("#comment_text").focus();
  });







}); // End of jQuery
