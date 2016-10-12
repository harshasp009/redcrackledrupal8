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
 })(jQuery);

