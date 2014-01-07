jQuery(document).ready(function(){
	var aspectRatio = 0.5625;
  jQuery(document).ready(function(){
    var wrapWidth = jQuery('#jm-videogalleries-video').width();
    var wrapHeight = wrapWidth * aspectRatio;
    jQuery('#jm-videogalleries-video > iframe').width(wrapWidth).height(wrapHeight);
    jQuery(window).resize(function(){
      var wrapWidth = jQuery('#jm-videogalleries-video').width();
      var wrapHeight = wrapWidth * aspectRatio;
      jQuery('#jm-videogalleries-video > iframe').width(wrapWidth).height(wrapHeight);
    })
  })
});