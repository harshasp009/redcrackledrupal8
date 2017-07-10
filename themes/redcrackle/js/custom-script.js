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
  $('div.tile div.views-col').click(function() {
    window.location=$(this).find("a").attr("href");
    return false;
  });
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

  //$('button.navbar-toggle').click(function() {
  ////  console.log('test1');
  ////  $('ul.navbar-nav').find('li').addClass('expanded dropdown');
  ////  $('ul.navbar-nav').find('li ul').addClass('menu dropdown-menu');
  ////  $('ul.navbar-nav').find('li a').addClass('dropdown-toggle');
  ////
  ////
  ////} else {
  //    console.log($('ul.navbar-nav > li:nth-child(1) a').text());
  //        $('ul.navbar-nav > li:nth-child(2)').addClass('open');
  //    //$('ul.navbar-nav').find('li').removeClass('expanded dropdown');
  //    //$('ul.navbar-nav').find('li ul').removeClass('menu dropdown-menu');
  //    //$('ul.navbar-nav').find('li a').removeClass('dropdown-toggle');
  //    //$('ul.navbar-nav').find('li a').removeAttr('data-target data-toggle')
  ////}
  //});



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

