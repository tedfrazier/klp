<!--layout:Default,order:1-->
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
<div class="jmnewspro row-fluid" id="jmnewspro-<?php print $module->id; ?>">
<?php if ($module->showtitle != 0 || $jmnewspro_show_nav_buttons) { ?>
<div class="span2 <?php echo ($params->get('jmnewspro_layout', 'default')) ? ' ' . $params->get('jmnewspro_layout', 'default') : '' ?>">
	<?php if ($module->showtitle != 0) { ?>
	<h3 class="header">
		<?php 
			echo '<span class="title">'.$module->title.'</span>';
		?>
		<span class="title-border"></span>
	</h3>
	<?php } ?>
	<?php if ($jmnewspro_show_nav_buttons): ?>
	<div class="nav-buttons center-left">
		<span class="jmnewspro-prev"></span>
		<span class="jmnewspro-next"></span>
	</div>
	<?php endif; ?>
</div>
<?php } ?>
<div class="span10 jmnewspro <?php echo $moduleclass_sfx; ?> <?php print ($jmnewspro_hover) ? 'overlay' : ''; ?> <?php echo ($params->get('jmnewspro_layout', 'default')) ? ' ' . $params->get('jmnewspro_layout', 'default') : '' ?>"> 
  <div class="slider jm-bxslider span9" <?php echo $jm_params;?> data-onSliderLoad="jmnewspro<?php print $module->id?>()" data-nextSelector="#jmnewspro-<?php print $module->id; ?> .jmnewspro-next" data-prevSelector="#jmnewspro-<?php print $module->id; ?> .jmnewspro-prev" data-nextText="<i class='fa fa-angle-right'></i>" data-prevText="<i class='fa fa-angle-left'></i>">
    <?php foreach ($slides as $i => $slide): ?>
      <div class="slide-item" style="min-height:<?php print $jmnewspro_item_height; ?>px">
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
                <article class="slide-inner row-fluid">
                  <div class="span2 item-info">
                      <time class="created-date modified-date">
                        <span class="date"><?php echo date('d'); ?></span>
                        <span class="month"><?php echo date('M'); ?></span>
                      </time>
                      <div class="item-icon">
                        <i class="fa fa-<?php if($slide->content_type == 'video') echo 'play'; elseif ($slide->content_type == 'text') echo 'pencil'; else echo 'pencil';?>"></i>
                      </div>
                  </div>
                  <div class="span10">
                    <?php if ($jmnewspro_show_title): ?>
                      <h4 class="entry-title slide-item-title"><?php print $slide->title; ?></h4>
                    <?php endif; ?>
                    <?php if($jmnewspro_show_category):?>
                      <div class="category"><?php print $slide->category_name;?></div>
                    <?php endif;?>
                    <?php if ($jmnewspro_show_desc): ?>
                      <div class="slide-item-desc"><?php print $slide->description; ?></div>
                    <?php endif; ?>
                    <?php if ($jmnewspro_show_readmore): ?>
                      <div class="slide-item-readmore"><a class="btn btn-default" href="<?php print $slide->link ?>"><?php print $jmnewspro_readmore_text; ?></a></div>
                    <?php endif; ?>
                  </div>
                </article>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  
</div>
<!-- END Responsive Carousel MODULE -->
</div>
<script type="text/javascript">
	function jmnewspro<?php print $module->id?>(){
		$('#jmnewspro-<?php print $module->id?> .bx-viewport').height($('#jmnewspro-<?php print $module->id?> .slide-item').height());
	}
</script>