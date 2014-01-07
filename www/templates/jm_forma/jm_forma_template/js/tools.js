(function($) {

  /**
   * Copyright 2012, Digital Fusion
   * Licensed under the MIT license.
   * http://teamdf.com/jquery-plugins/license/
   *
   * @author Sam Sehnert
   * @desc A small plugin that checks whether elements are within
   *     the user visible viewport of a web browser.
   *     only accounts for vertical position, not horizontal.
   */

   $.fn.visible = function(partial) {

   	var $t            = $(this),
   	$w            = $(window),
   	viewTop       = $w.scrollTop(),
   	viewBottom    = viewTop + $w.height(),
   	_top          = $t.offset().top,
   	_bottom       = _top + $t.height(),
   	compareTop    = partial === true ? _bottom : _top,
   	compareBottom = partial === true ? _top : _bottom;

   	if($t.hasClass('visible')){
   		return false;
   	}

   	return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

   };

   var addAnimation = function(element){
   	$(element).each(function(i, el){
   		var el = $(el);
   		if (el.visible(true)) {
   			el.removeClass('visible').addClass('animated'); 
   		} 
   	});
   }

   var checkVisible = function(element){
   	$(element).each(function(i, el) {
   		var el = $(el);
         if (el.visible(false)) {
   			el.addClass("visible"); 
   		} 
   	});   	
   }

   $(window).load(function(){
   	checkVisible('.animation');
      $('.sp-main-menu-toggler').appendTo('#header');
      $('.sp-mobile-menu').appendTo('#header');
   });

   $(window).scroll(function(event) {

      addAnimation('.animation');

      //Goto Top
      if ($(this).scrollTop() > 300) {
            $('.sp-totop').fadeIn();
            $('.sp-totop').addClass('show');
         } else {
            $('.sp-totop').fadeOut();
            $('.sp-totop').removeClass('show');
         }
      });

      $('.sp-totop').click(function(){
         $('html').animate({
            scrollTop: 0
         }, 500);
      });

})(jQuery);