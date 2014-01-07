<!--layout:Default,order:1-->
<?php
/*
#------------------------------------------------------------------------
# Package - JoomlaMan JMSlideShow
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
<div class="jmnewspro <?php echo $moduleclass_sfx; ?>  <?php echo ($params->get('jmnewspro_layout', 'default')) ? ' ' . $params->get('jmnewspro_layout', 'default') : '' ?>" id="jmnewspro-<?php print $module->id; ?>">
  <div class="slider jm-bxslider" <?php echo $jm_params;?> data-onSliderLoad="jmnewspro<?php print $module->id?>()" data-nextSelector="#jmnewspro-<?php print $module->id; ?> .jmnewspro-next" data-prevSelector="#jmnewspro-<?php print $module->id; ?> .jmnewspro-prev">
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
            <?php if ($jmnewspro_show_title || $jmnewspro_show_desc || $jmnewspro_show_category): ?>
              <div class="slide-item-desc-warp<?php print ($jmnewspro_hover) ? ' jmnewsprohover' : ''; ?>">
                <div class="slide-inner">
                  <?php if ($jmnewspro_show_title): ?>
                    <div class="slide-item-title"><?php print $slide->title; ?></div>
                  <?php endif; ?>
                  <?php if($jmnewspro_show_category):?>
										<div class="category"><?php print $slide->category_name;?></div>
									<?php endif;?>
                  <?php if ($jmnewspro_show_desc): ?>
                    <div class="slide-item-desc"><?php print $slide->description; ?></div>
                  <?php endif; ?>
                  <?php if ($jmnewspro_show_readmore): ?>
                    <span class="slide-item-readmore"><a href="<?php print $slide->link ?>"><?php print $jmnewspro_readmore_text; ?></a></span>
                  <?php endif; ?>
									<?php if ($jmnewspro_show_popup):?>
                    <span class="slide-item-zoom">				
												<a class="colorbox" href="<?php echo str_replace(JPATH_ROOT.'/',Juri::root(),$slides[$i]->image); ?>"> 	
													<?php print $jmnewspro_popup_text;?> 	
												</a>					
										</span>
									<?php endif;?>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <?php if ($jmnewspro_show_nav_buttons): ?>
    <span class="jmnewspro-prev"></span>
    <span class="jmnewspro-next"></span>
  <?php endif; ?>
</div>
<!-- END Responsive Carousel MODULE -->
<script type="text/javascript">
	function jmnewspro<?php print $module->id?>(){
			<?php if ($jmnewspro_hover): ?>
      jQuery('#jmnewspro-<?php print $module->id; ?> .slide-item').hover(function(){
        var $sliderHeight = jQuery(this).height();
        var $sliderWidth = jQuery(this).width();
        jQuery(this).find('.jmnewsprohover').width($sliderWidth).stop(true,false).animate({
          height: $sliderHeight+'px', opacity: 1
        },400);
      },function(){
        jQuery(this).find('.jmnewsprohover').stop(true,false).animate({
          height: 0+'px', opacity: 0
        },400);
      })
			<?php endif; ?>
			<?php if($jmnewspro_show_popup):?>
			jQuery(".slide-item-zoom .colorbox").colorbox({rel:'.colorbox','maxWidth':'100%'});
			<?php endif;?>
	}
</script>