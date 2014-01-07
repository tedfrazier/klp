jQuery(document).ready(function(){
    //Slider source
	jQuery('#jform_params_asset-lbl').parent().hide();
    JMSlideShow_SourceChange(jQuery('#jform_params_slider_source').val());
    jQuery('#jform_params_slider_source').change(function(){
        JMSlideShow_SourceChange(jQuery(this).val());
    })
})
function JMSlideShow_SourceChange(source){
    switch(source){
        case '1':
            jQuery('#jform_params_jmcategory').parents('li').css({display:'block'});
            jQuery('#jform_params_jmk2_categories').parents('li').css({display:'none'});
            jQuery('#jform_params_jmrss_link').parents('li').css({display:'none'});
            jQuery('#jform_params_jmexternal_link').parents('li').css({display:'none'});
            break;
        case '2':
           jQuery('#jform_params_jmcategory').parents('li').css({display:'none'});
            jQuery('#jform_params_jmk2_categories').parents('li').css({display:'block'});
            jQuery('#jform_params_jmrss_link').parents('li').css({display:'none'});
            jQuery('#jform_params_jmexternal_link').parents('li').css({display:'none'});
            break;
        case '3':
           jQuery('#jform_params_jmcategory').parents('li').css({display:'none'});
            jQuery('#jform_params_jmk2_categories').parents('li').css({display:'none'});
            jQuery('#jform_params_jmrss_link').parents('li').css({display:'block'});
            jQuery('#jform_params_jmexternal_link').parents('li').css({display:'none'});
            break; 
        case '4':
           jQuery('#jform_params_jmcategory').parents('li').css({display:'none'});
            jQuery('#jform_params_jmk2_categories').parents('li').css({display:'none'});
            jQuery('#jform_params_jmrss_link').parents('li').css({display:'none'});
            jQuery('#jform_params_jmexternal_link').parents('li').css({display:'block'});
            break;
            
    }
}