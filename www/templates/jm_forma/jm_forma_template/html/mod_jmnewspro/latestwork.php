<!--layout:Latest Work,order:0-->
<?php
/*
#------------------------------------------------------------------------
# Package - JoomlaMan JM News Pro
# Version 1.0
# -----------------------------------------------------------------------
# Author - JoomlaMan http://www.joomlaman.com
# Copyright © 2012 - 2013 JoomlaMan.com. All Rights Reserved.
# @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
# Websites: http://www.JoomlaMan.com
#------------------------------------------------------------------------
*/
// no direct access
defined('_JEXEC') or die('Restricted access');
$document = JFactory::getDocument();
$document->addStyleSheet(JURI::root(true) . '/modules/mod_jmnewspro/assets/css/style_common.css');
if($jmnewspro_show_popup) {
	$document->addScript(JURI::root(true) . '/modules/mod_jmnewspro/assets/js/jquery.colorbox-min.js');
	$document->addStyleSheet(JURI::root(true) . '/modules/mod_jmnewspro/assets/css/colorbox.css');
}
if (empty($slides)) {
  echo "There are no slide to show, Please make sure you have configured SlideShow correctly.";
  return;
}
?>
<style type="text/css">
<?php if (!$jmnewspro_show_pager): ?>
    #jmnewspro-<?php print $module->id; ?> .bx-controls{
      display: none;
    }
<?php endif; ?>
<?php if ($jmnewspro_pager_position == 'topleft'): ?>
    #jmnewspro-<?php print $module->id; ?> .bx-controls{
      left: 0; position: absolute; top: -15px;
    }
<?php elseif ($jmnewspro_pager_position == 'topright'): ?>
    #jmnewspro-<?php print $module->id; ?> .bx-controls{
      right: 0; position: absolute; top: -15px;
    }
<?php elseif ($jmnewspro_pager_position == 'bottomleft'): ?>
    #jmnewspro-<?php print $module->id; ?> .bx-controls{
      left: 0; position: absolute; bottom: -15px;
    }
<?php elseif ($jmnewspro_pager_position == 'bottomright'): ?>
    #jmnewspro-<?php print $module->id; ?> .bx-controls{
      right: 0; position: absolute; bottom: -15px;
    }
<?php endif; ?>        
</style>        
<!-- START Responsive Carousel MODULE -->
<div class="jmnewspro <?php echo $moduleclass_sfx; ?> <?php print ($jmnewspro_hover) ? 'overlay' : ''; ?> <?php echo ($params->get('jmnewspro_layout', 'default')) ? '' . $params->get('jmnewspro_layout', 'default') : '' ?>" id="jmnewspro-<?php print $module->id; ?>">
  <div class="slider jm-bxslider" <?php echo $jm_params;?> data-onSliderLoad="jmnewspro<?php print $module->id?>()" data-nextSelector="#jmnewspro-<?php print $module->id; ?> .jmnewspro-next" data-prevSelector="#jmnewspro-<?php print $module->id; ?> .jmnewspro-prev" data-nextText="<i class='fa fa-angle-right'></i>" data-prevText="<i class='fa fa-angle-left'></i>">
    <?php foreach ($slides as $i => $slide): ?>
      <div class="slide-item <?php echo $slide->content_type;?>" style="min-height:<?php print $jmnewspro_item_height; ?>px">
        <div class="slide-item-wrap">
          <div class="slide-item-wrap-item">
            <?php if ($jmnewspro_show_image): ?>
              <div class="slide-item-image clearfix">
                <?php if ($jmnewspro_image_link): ?>
                  <a href="<?php print $slide->link; ?>"><img src="<?php echo $slide->getMainImage(); ?>"></a>
                <?php else: ?>
                  <img src="<?php echo $slide->getMainImage(); ?>">
                <?php endif; ?>
              </div>
            <?php endif; ?>
            <?php if ($jmnewspro_show_title || $jmnewspro_show_desc || $jmnewspro_show_category || $jmnewspro_show_readmore || $jmnewspro_show_popup): ?>
              <div class="slide-item-desc-warp<?php print ($jmnewspro_hover) ? ' jmnewsprohover' : ''; ?>">
                <div class="slide-inner">
									<div class="padding">
        					<?php if ($jmnewspro_show_readmore || $jmnewspro_show_popup): ?>
                  <div class="detailButtonWrap" style="width:100%">
                    <?php if ($jmnewspro_show_readmore ): ?>
                      <a class="slide-item-readmore hasTip" data-original-title="View details" href="<?php print $slide->link ?>"><i class="fa fa-link"></i></a>
                    <?php endif; ?>
                    <?php if ($jmnewspro_show_popup): ?>
                      <a class="slide-item-zoom colorbox hasTip" data-original-title="Open Image" href="<?php echo str_replace(JPATH_ROOT.'/',Juri::root(),$slide->image); ?>" title="Open images"><i class="fa fa-plus"></i></a>
                    <?php endif; ?>
                  </div>
                  <?php endif; ?>

        					<?php if($jmnewspro_show_title):?>
        						<header class="slide-item-title entry-header"><h2 class="entry-title"><?php print $slide->title; ?></h2></header>
        					<?php endif;?>
        					<?php if($jmnewspro_show_category =='1'):?>
        						<h2 class="category"><?php print $slide->category_name;?></h2>
        					<?php endif;?>
        					<?php if($jmnewspro_show_desc):?>
        						<div class="slide-item-desc"><?php print $slide->description; ?></div>
        					<?php endif;?>
                </div>
								</div>
              </div>
            <?php endif; ?>		
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <?php if ($jmnewspro_show_nav_buttons): ?>
  <div class="nav-buttons center-center">
    <span class="jmnewspro-prev prev"></span>
    <span class="jmnewspro-next next"></span>
  </div>
  <?php endif; ?>
</div>
<!-- END Responsive Carousel MODULE -->
<script type="text/javascript">
	var getDirection = function (ev, obj) {
	var w = $(obj).width(),
		h = $(obj).height(),
		x = (ev.pageX - $(obj).offset().left - (w / 2)) * (w > h ? (h / w) : 1),
		y = (ev.pageY - $(obj).offset().top - (h / 2)) * (h > w ? (w / h) : 1),
		d = Math.round( Math.atan2(y, x) / 1.57079633 + 5 ) % 4;
	return d;
	};

	var addClass = function ( ev, obj, state ) {
		var direction = getDirection( ev, obj ),
			class_suffix = "";

		obj.className = "";

		switch ( direction ) {
			case 0 : class_suffix = '-top';    break;
			case 1 : class_suffix = '-right';  break;
			case 2 : class_suffix = '-bottom'; break;
			case 3 : class_suffix = '-left';   break;
		}
		obj.classList.add( state + class_suffix );
		obj.classList.add( 'slide-item-wrap');
	};
	function jmnewspro<?php print $module->id?>(){
		$('#jmnewspro-<?php print $module->id?> .bx-viewport').height($('#jmnewspro-<?php print $module->id?> .slide-item').height());
		
		var paddingTop = ($('#jmnewspro-<?php print $module->id;?> .slide-item').height() - 70 )/2;
		$('#jmnewspro-<?php print $module->id;?> .detailButtonWrap').css({
			paddingTop:paddingTop + 'px'
		});
		$('.latestwork .slide-item-wrap').each(function(ev){
			$(this).hover(function(ev){
				addClass( ev, this, 'in' );
			},function(ev){
				addClass( ev, this, 'out' );
			})
		})
		<?php if($jmnewspro_show_popup):?>
			$("#jmnewspro-<?php print $module->id;?> .colorbox").colorbox({rel:'.colorbox','maxWidth':'100%'});
		<?php endif;?>
		
		<?php if ($jmnewspro_show_nav_buttons): ?>
		if(jQuery('#jmnewspro-<?php print $module->id; ?>').find('img').length > 0){
			var tmpImg = new Image();
			tmpImg.src = jQuery('#jmnewspro-<?php print $module->id; ?> img:first').attr('src') ;
			tmpImg.onload = function() {
				jQuery('#jmnewspro-<?php print $module->id; ?>').find('.jmnewspro-prev, .jmnewspro-next').css({
					top: jQuery('#jmnewspro-<?php print $module->id; ?>').find('.slide-item-image').height()/2
				})
			};
		}else{
			jQuery('#jmnewspro-<?php print $module->id; ?>').find('.jmnewspro-prev, .jmnewspro-next').css({
				top: jQuery('#jmnewspro-<?php print $module->id; ?>').find('.slide-item').height()/2
			})
		}
		<?php endif; ?>
	}
</script>