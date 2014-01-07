jQuery.noConflict();

//var optionObject = [];
//var idEdit = -1;

window.addEvent("domready",function(){
	$$("#jform_params_asset-lbl").getParent().destroy();
	
	$$('.jm_switch').each(function(el)
	{
			
			var options = el.getElements('option');		
			if(options.length==2){
			
				el.setStyle('display','none');
				var value = new Array();
				value[0] = options[0].value;
				value[1] = options[1].value;
				
				var text = new Array();
				text[0] = options[0].text.replace(" ","-").toLowerCase().trim();
				text[1] = options[1].text.replace(" ","-").toLowerCase().trim();
				
				var switchClass = (el.value == value[0]) ? text[0] : text[1];
			
				var switcher = new Element('div',{'class' : 'switcher-'+switchClass});

				switcher.inject(el, 'after');
				switcher.addEvent("click", function(){
					if(el.value == value[1]){
						switcher.setProperty('class','switcher-'+text[0]);
						el.value = value[0];
					} else {
						switcher.setProperty('class','switcher-'+text[1]);
						el.value = value[1];
					}
					jQuery(el).trigger('change');
				});
		}
	});
	jQuery('.adminformlist textarea').parent().css("overflow","hidden");

	jQuery('.jm_color').ColorPicker({
		color: '#0000ff',
		onShow: function (colpkr) {
			jQuery(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(500);
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).val("#"+hex);
			//jQuery(el).css('background',jQuery(el).val())
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery(".pane-sliders select").each(function(){
	
		if(jQuery(this).is(":visible")) {
		jQuery(this).css("width",parseInt(jQuery(this).width())+20);
		jQuery(this).chosen()
		};
	})	
	jQuery(".chzn-container").click(function(){
		jQuery(".panel .pane-slider,.panel .panelform").css("overflow","visible");	
	})
	
	// show/hide weather option
	if(jQuery('input[name="jform[params][weather]"]:checked').val() == 1){
		jQuery('#jform_params_temperatureUnit').parent().parent().show();
		jQuery('#jform_params_cloud').parent().parent().show();
	}else{
		jQuery('#jform_params_temperatureUnit').parent().parent().hide();
		jQuery('#jform_params_cloud').parent().parent().hide();	
	}
	jQuery("input[name='jform[params][weather]']").click(function(){
		if(jQuery('input[name="jform[params][weather]"]:checked').val() == 1){
			jQuery('#jform_params_temperatureUnit').parent().parent().show();
			jQuery('#jform_params_cloud').parent().parent().show();
		}else{
			jQuery('#jform_params_temperatureUnit').parent().parent().hide();
			jQuery('#jform_params_cloud').parent().parent().hide();	
		}
	});
	
	// show/hide input of map address.
	if(jQuery('input[name="jform[params][mapCenterType]"]:checked').val() == "address"){
		jQuery('#jform_params_mapCenterAddress').parent().parent().show();
		jQuery('#jform_params_mapCenterCoordinate').parent().parent().hide();
	}else{
		jQuery('#jform_params_mapCenterCoordinate').parent().parent().show();
		jQuery('#jform_params_mapCenterAddress').parent().parent().hide();		
	}
	jQuery("input[name='jform[params][mapCenterType]']").click(function(){
		if(jQuery('input[name="jform[params][mapCenterType]"]:checked').val() == "address"){
			jQuery('#jform_params_mapCenterAddress').parent().parent().show();
			jQuery('#jform_params_mapCenterCoordinate').parent().parent().hide();
		}else{
			jQuery('#jform_params_mapCenterCoordinate').parent().parent().show();
			jQuery('#jform_params_mapCenterAddress').parent().parent().hide();		
		}
	});
	
	// show/hide option of style map
	if(jQuery('input[name="jform[params][enable-style]"]:checked').val() == 0){
		jQuery("#jform_params_style_title").parent().parent().hide();
		jQuery("#jform_params_createNewOrApplyDefaultStyle").parent().parent().hide();
		jQuery("#jmg-style-message").parent().parent().hide();
	}else{
		jQuery("#jform_params_style_title").parent().parent().show();
		jQuery("#jform_params_createNewOrApplyDefaultStyle").parent().parent().show();
		jQuery("#jmg-style-message").parent().parent().show();
	}
	jQuery("input[name='jform[params][enable-style]']").click(function(){
		if(jQuery('input[name="jform[params][enable-style]"]:checked').val() == 0){
			jQuery("#jform_params_style_title").parent().parent().hide();
			jQuery("#jform_params_createNewOrApplyDefaultStyle").parent().parent().hide();
			jQuery("#jmg-style-message").parent().parent().hide();
		}else{
			jQuery("#jform_params_style_title").parent().parent().show();
			jQuery("#jform_params_createNewOrApplyDefaultStyle").parent().parent().show();
			jQuery("#jmg-style-message").parent().parent().show();
		}
	});
	

	// show/hide option of custom infowindow
	if(jQuery('input[name="jform[params][enable-custom-infobox]"]:checked').val() == 1){
		jQuery('.option-custom-infobox').parent().parent().show();
		jQuery('#jform_params_closeBoxURL').parent().parent().parent().show();
	}else{
		jQuery('.option-custom-infobox').parent().parent().hide();
		jQuery('#jform_params_closeBoxURL').parent().parent().parent().hide();
	}
	jQuery("input[name='jform[params][enable-custom-infobox]']").click(function(){
		if(jQuery('input[name="jform[params][enable-custom-infobox]"]:checked').val() == 1){
			jQuery('.option-custom-infobox').parent().parent().show();
			jQuery('#jform_params_closeBoxURL').parent().parent().parent().show();
		}else{
			jQuery('.option-custom-infobox').parent().parent().hide();
			jQuery('#jform_params_closeBoxURL').parent().parent().parent().hide();
		}
	});
	jQuery('#jmg-main-button > label').remove();
	jQuery('#jmg-style-main-button > label').remove();
	jQuery('#jmg-style-message').parent().css('margin',"0").css('display','inline-block').css('min-width','400px');
	jQuery('#jmg-message').parent().css('margin',"0").css('display','inline-block').css('min-width','400px');
})
