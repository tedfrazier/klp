/**
 * @package Helix Framework
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2013 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

spnoConflict(function($){
	//Menu height fix
	$('#sp-menu li.parent').hover(function(){
		$(this).find('.sp-submenu-inner').each(function(){
			var subs = $(this).find('> .megacol');
			if(subs.length < 2) return;
			var maxHeight = Math.max.apply(null, $(this).find(">.megacol").map(function(){
				return $(this).height();
			}).get());
			$(this).find(">.megacol").height(maxHeight);
		})
	})
	
	$('#sp-our-service-wrapper #our-service, #sp-fp-news2-wrapper #fp-news2').each(function(){
		var $spans = $(this).find('>div[class^=span]');
		var maxHeight = Math.max.apply(null, $spans.map(function(){
				return $(this).height();
		}).get());
		$spans.height(maxHeight);
	})
	$('.hasTip').tooltip({
        html: true
    })
});