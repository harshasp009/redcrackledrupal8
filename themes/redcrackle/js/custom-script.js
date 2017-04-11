(function ($) {
  $('img').addClass('img-responsive');
  $('.protheader #edit-title').attr("placeholder", "Enter project name to Search");
  $('#views-exposed-form-blogs-page-1 #edit-title').attr("placeholder", "Search blog");
  //$("section.block-new-block").hide();
  //$("a.get_book").on('click', function() {
  //  $("section.block-new-block").show();
  //})
//  $(window).load(function(){
//    $('#myModal').modal('show');
//  });
//$('span.close_news').on('click', function() {
//  $('.simple_news_block').slideUp("slow");
//})
/* added this line to change the view exposed filter using onchange functionality  */
  if($('.views-exposed-form select').length){
    // Your change function
    $('.views-exposed-form select').change(function() {
      // Submit the form
      $(this).parents('form').submit();
    });
  }
})(jQuery);


(function ($) {
   if($(window).width()>993) {
     $('.dropdown-toggle').click(function () {
       var location = $(this).attr('href');
       window.location.href = location;
       return false;
     });
     $(".nav li.expanded").hover(
       function () {
         $(this).addClass("open");
       }, function () {
         $(this).removeClass("open");
       }
     );
   }


  //$(".nav li.expanded a span.caret").click(function() {
  //    alert("clicked");
  //})
  // else if($(window).width() <= 992) {
  //   $('.dropdown-toggle').click(function () {
  //     var location = $(this).attr('href');
  //     window.location.href = location;
  //     return false;
  //   });
  //   $(".nav li.expanded a span.caret").click(
  //     function () {
  //       var obj = $(".nav li.expanded");
  //       obj.addClass("open");
  //     }, function () {
  //       var obj = $(".nav li.expanded");
  //     obj.removeClass("open");
  //     }
  //   );
  // }
 })(jQuery);

