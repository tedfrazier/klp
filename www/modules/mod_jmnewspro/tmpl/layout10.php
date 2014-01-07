<!--layout:Portfolio Masonry,order:11-->
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
$document->addScript(JURI::root(true) . '/modules/mod_jmnewspro/assets/js/masonry.pkgd.min.js');

if (empty($slides)) {
  echo "There are no slide to show, Please make sure you have configured SlideShow correctly.";
  return;
}
?>
<style>
.slide-item {float:left}
.slide-item img{width:100%}
.slide-item.w1 { width: 25%; }
.slide-item.w2 { width: 50%; }
</style>      
<!-- START Responsive Carousel MODULE -->
<div class="jmnewspro <?php echo $moduleclass_sfx; ?> css3 <?php echo $params->get('jmnewspro_layout', 'default');?>" id="jmnewspro-<?php echo $module->id; ?>">
  <div id="jmnewpro-masonry">
    <?php foreach ($slides as $i => $slide): ?>
			<div class="slide-item <?php echo $slide->content_type;?>">
        <div class="slide-item-wrap">
          <div class="view slide-item-wrap-item">
            <?php if ($jmnewspro_show_image): ?>
              <div class="slide-item-image clearfix">
                <?php if ($jmnewspro_image_link): ?>
                  <a href="<?php echo $slide->link; ?>"><img src="<?php echo $slide->getMainImage(); ?>"></a>
                <?php else: ?>
                  <img src="<?php echo $slide->getMainImage(); ?>">
                <?php endif; ?>
              </div>
            <?php endif; ?>
            <?php if ($jmnewspro_show_title || $jmnewspro_show_desc || $jmnewspro_show_category): ?>
              <div class="slide-item-desc-warp<?php echo ($jmnewspro_hover) ? ' jmnewsprohover' : ''; ?>">
                <div class="slide-inner">
                  <div class="padding">
                    <?php if ($jmnewspro_show_title): ?>
                      <div class="slide-item-title"><?php echo $slide->title; ?></div>
                    <?php endif; ?>
                    <?php if($jmnewspro_show_category):?>
                      <div class="category"><?php echo $slide->category_name;?></div>
                    <?php endif;?>
                    <?php if ($jmnewspro_show_desc): ?>
                      <div class="slide-item-desc"><?php echo $slide->description; ?></div>
                    <?php endif; ?>
                    
						
                  </div>
				<?php if ($jmnewspro_show_readmore || $jmnewspro_show_popup): ?>
				<div class="detailButtonWrap">
					<?php if ($jmnewspro_show_readmore): ?>
						<a class="slide-item-readmore hasTip" title="JM_VIEW_DETAILS" href="<?php echo $slide->link ?>"><?php echo $jmnewspro_readmore_text; ?></a></span>
					<?php endif; ?>
					<?php if ($jmnewspro_show_popup):?>				
						<a class="slide-item-readmore slide-item-zoom colorbox hasTip" title="JM_OPEN_IMAGE" href="<?php echo str_replace(JPATH_ROOT.'/',Juri::root(),$slides[$i]->image); ?>"> 	
							<?php print $jmnewspro_popup_text;?> 	
						</a>					
					<?php endif;?>
				</div>
				<?php endif;?>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
		<div style="clear:both"></div>
  </div>
</div>
<!-- END Responsive Carousel MODULE -->

<script type="text/javascript">
	var jmmasonry = function(){
		var colwidth = Math.floor(jQuery(window).width()/4);
		if(jQuery(window).width()<768){
			colwidth = jQuery(window).width();
		}
		jQuery('#jmnewpro-masonry .slide-item').each(function(){
			cols = Math.round(jQuery(this).width()/colwidth);
			cols = (cols>2)?2:cols;
			if(jQuery(window).width()<768){
				cols = 1;
			}
			jQuery(this).width(colwidth * cols);
		})
		setTimeout(function(){
			jQuery('#jmnewpro-masonry').masonry({
				// options
				columnWidth: colwidth,
				itemSelector: '.slide-item'
			});
		},500);
	}
	
	jQuery(window).load(function(){
		jmmasonry();		
	}).resize(function(){
		jQuery('#jmnewpro-masonry').masonry('destroy');
		jmmasonry();
	})
	jQuery(document).ready(function($){
		var obj = '#jmnewspro-<?php print $module->id; ?>';
		//$(".colorbox").colorbox({rel:'.colorbox',maxWidth:'100%'});
		var nodes  = document.querySelectorAll('.layout10 .slide-item-wrap'),
		_nodes = [].slice.call(nodes, 0);
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
		};

		// bind events
		$(_nodes).each(function(){
			$(this).hover(function(ev){
				addClass( ev, this, 'in' );
			},function(ev){
				addClass( ev, this, 'out' );
			})
		})
	});
</script>