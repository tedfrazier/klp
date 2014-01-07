jQuery(document).ready(function(){
    //Slider source
	jQuery('#jform_params_asset-lbl').parent().hide();
    JMSlideShow_SourceChange(jQuery('#jform_params_slider_source').val());
    JMSlideShow_ReadMoreChange(jQuery('#jform_params_jmslideshow_show_readmore:checked').val());
		JMSlideShow_ResponsiveChange(jQuery('[id^=jform_params_jmslideshow_responsive]:checked').val());
    JMSlideShow_PagerChange(jQuery('#jform_params_jmslideshow_pager_position').val());
    JMSlideShow_CaptionChange(jQuery('#jform_params_jmslideshow_caption_position').val());
    jQuery('#jform_params_slider_source').change(function(){
        JMSlideShow_SourceChange(jQuery(this).val());
    })
    jQuery('#jform_params_jmslideshow_show_readmore').change(function(){
        JMSlideShow_ReadMoreChange(jQuery(this).is(':checked'));
    })
    jQuery('[id^=jform_params_jmslideshow_responsive]').click(function(){
			JMSlideShow_ResponsiveChange(jQuery(this).val());
    })
		jQuery('#jform_params_jmslideshow_pager_position').change(function(){
        JMSlideShow_PagerChange(jQuery(this).val());
    })
	jQuery('#jform_params_jmslideshow_caption_position').change(function(){
        JMSlideShow_CaptionChange(jQuery(this).val());
    })
})
function JMSlideShow_SourceChange(source){
    switch(source){
        case '1':
            jQuery('#jform_params_jmslideshow_categories').parent().css({display:'block'});
            jQuery('#jform_params_jmslideshow_article_ids').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_k2_categories').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_k2_ids').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_k2_image_source').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_count').parent().css({display:'block'});
            break;
        case '2':
            jQuery('#jform_params_jmslideshow_categories').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_article_ids').parent().css({display:'block'});
            jQuery('#jform_params_jmslideshow_k2_categories').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_k2_ids').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_k2_image_source').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_count').parent().css({display:'none'});
            break;
        case '3':
            jQuery('#jform_params_jmslideshow_categories').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_article_ids').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_k2_categories').parent().css({display:'block'});
            jQuery('#jform_params_jmslideshow_k2_ids').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_k2_image_source').parent().css({display:'block'});
            jQuery('#jform_params_jmslideshow_count').parent().css({display:'block'});
            break;
        case '4':
            jQuery('#jform_params_jmslideshow_categories').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_article_ids').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_k2_categories').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_k2_ids').parent().css({display:'block'});
            jQuery('#jform_params_jmslideshow_k2_image_source').parent().css({display:'block'});
            jQuery('#jform_params_jmslideshow_count').parent().css({display:'none'});
            break;
            
    }
}
function JMSlideShow_ReadMoreChange(source){
    if(source){
		jQuery('#jform_params_jmslideshow_readmore_text').parent().css({display:'block'});
    }else{       
        jQuery('#jform_params_jmslideshow_readmore_text').parent().css({display:'none'});
    }
            
}
function JMSlideShow_ResponsiveChange(source){
    switch(source){
        case '0':
            jQuery('#jform_params_jmslideshow_width').parent().css({display:'block'});
            break;
        case '1':
            jQuery('#jform_params_jmslideshow_width').parent().css({display:'none'});
            break;
    }
            
}
function JMSlideShow_PagerChange(source){
    switch(source){
        case 'topleft':
            jQuery('#jform_params_jmslideshow_pager_left').parent().css({display:'block'});
            jQuery('#jform_params_jmslideshow_pager_top').parent().css({display:'block'});
            jQuery('#jform_params_jmslideshow_pager_bottom').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_pager_right').parent().css({display:'none'});
            break;
        case 'topright':
           jQuery('#jform_params_jmslideshow_pager_left').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_pager_top').parent().css({display:'block'});
            jQuery('#jform_params_jmslideshow_pager_bottom').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_pager_right').parent().css({display:'block'});
            break;
        case 'bottomleft':
           jQuery('#jform_params_jmslideshow_pager_left').parent().css({display:'block'});
            jQuery('#jform_params_jmslideshow_pager_top').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_pager_bottom').parent().css({display:'block'});
            jQuery('#jform_params_jmslideshow_pager_right').parent().css({display:'none'});
            break;
        case 'bottomright':
           jQuery('#jform_params_jmslideshow_pager_left').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_pager_top').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_pager_bottom').parent().css({display:'block'});
            jQuery('#jform_params_jmslideshow_pager_right').parent().css({display:'block'});
            break;
    }
            
}
//caption
function JMSlideShow_CaptionChange(source){
    switch(source){
        case 'topleft':
            jQuery('#jform_params_jmslideshow_caption_left').parent().css({display:'block'});
            jQuery('#jform_params_jmslideshow_caption_top').parent().css({display:'block'});
            jQuery('#jform_params_jmslideshow_caption_bottom').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_caption_right').parent().css({display:'none'});
            break;
        case 'topright':
           jQuery('#jform_params_jmslideshow_caption_left').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_caption_top').parent().css({display:'block'});
            jQuery('#jform_params_jmslideshow_caption_bottom').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_caption_right').parent().css({display:'block'});
            break;
        case 'bottomleft':
           jQuery('#jform_params_jmslideshow_caption_left').parent().css({display:'block'});
            jQuery('#jform_params_jmslideshow_caption_top').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_caption_bottom').parent().css({display:'block'});
            jQuery('#jform_params_jmslideshow_caption_right').parent().css({display:'none'});
            break;
        case 'bottomright':
           jQuery('#jform_params_jmslideshow_caption_left').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_caption_top').parent().css({display:'none'});
            jQuery('#jform_params_jmslideshow_caption_bottom').parent().css({display:'block'});
            jQuery('#jform_params_jmslideshow_caption_right').parent().css({display:'block'});
            break;
    }
            
}