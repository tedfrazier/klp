jQuery(window).load(function (){
	jQuery('#jmvideogalleries_videos_items').JMGrid({
		filter:'.jmvideogalleries_videos_filter > li',
		sort:'.jmvideogalleries_videos_sorting >li',
		ordering:ordering,
		cols: cols,
		item: '.jmvideogalleries_videos_item',
		hiddenClass: 'jmhidden'
	});
	jQuery('#jm-video-myModal').on('hide.bs.modal',function(){
		turnOffVideo();
	});
})
function getVideoData(id){ 	
	var title = jQuery('.jm_videogalleries_title'+id).text();
	var desc = jQuery('.jm_videogalleries_desc'+id).text();
	var video = jQuery('.jm_videogalleries_video'+id).text();
	var autoplay = jQuery('.jm_videogalleries_video_src'+id).text();
	jQuery('.jm-video-modal-title').text(title);
	jQuery('.jm-video-modal-video').html('<iframe '+video+'></iframe>');
	var longdesc = jQuery('.jm-video-modal-video iframe').attr('longdesc');
	jQuery('.jm-video-modal-video iframe').attr('src',longdesc+autoplay);
	jQuery('.jm-video-modal-description p').text(desc);
	jQuery('.jm-video-modal-description').css('overflow','hidden');
	//////style scroll
	setTimeout(function(){
		jQuery('.jm-video-modal-description').jScrollPane({
			horizontalGutter:5,
			verticalGutter:5,
			'showArrows': false
		})
		jQuery('.jm-video-modal-description').css('width','100%');
		jQuery('.jspContainer').css('width','100%');
		jQuery('.jspPane').css('width','100%');
	},1000);
}
/*turn off video*/
function turnOffVideo(){
	jQuery('.jm-video-modal-video').text('');	
}
