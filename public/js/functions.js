$(document).ready(function() {
  
  /* list fade toggle */

  $(".list").click(function(e) {
    $(this).toggleClass('list--active');
    e.stopPropagation();
  });

});