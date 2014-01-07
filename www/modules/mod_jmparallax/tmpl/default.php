<!--layout:Default,order:1-->
<?php
/* * --------------------------------------------------------------------
  # Package - JoomlaMan JM Parallax
  # Version 1.0.0
  # --------------------------------------------------------------------
  # Author - JoomlaMan http://www.joomlaman.com
  # Copyright © 2012 - 2013 JoomlaMan.com. All Rights Reserved.
  # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
  # Websites: http://www.JoomlaMan.com
  ---------------------------------------------------------------------* */
// no direct access
defined('_JEXEC') || die('Restricted access');
$moduleclass_sfx = $params->get('moduleclass_sfx');
$back = '';
if ($parallax_background) {
  $back = 'fixed';
} else {
  $back = 'scroll';
}
?> 
<div data-stellar-background-ratio="<?php print $parallax_background_ratio;?>" class="jm-omnia jmparallax_wrap <?php echo $moduleclass_sfx; ?>" id="jmparallax_wrap<?php echo $module_id; ?>">
  <div class="container">
	<div class="container-inner">
		<div class="carousel slide" data-interval="<?php print $parallax_timeout;?>">
			<div class="carousel-inner">
				<?php foreach($slides as $k=>$slide):?>
				<div class="item<?php if($k==0) print " active";?>">
				<?php echo $slide; ?>
				</div>
				<?php endforeach;?>
			</div>
			<?php if($parallax_carousel_controls):?>
				<div class="parallax-indicators">
				<ol class="carousel-indicators <?php print $parallax_carousel_controls_position;?>">
				<?php foreach($slides as $k=>$slide):?>
					<li data-target="#carousel-example-generic" onclick="javascript:{jQuery('#jmparallax_wrap<?php print $module_id;?> .carousel').carousel(<?php print $k;?>)}" data-slide-to="<?php print $k;?>" class="<?php if($k==0) print "active";?>"><span></span></li>
				<?php endforeach;?>
				</ol>
				</div>
			<?php endif;?>
		</div>
	</div>
  </div>
</div>
<style type="text/css">
	#jmparallax_wrap<?php print $module_id;?>{
		background-image:url('<?php echo JURI::root() . $background_image; ?>');
		background-repeat: <?php print $repeat_background;?>;
		background-attachment: <?php print ($parallax_background)?'scroll':'scroll';?>;
		/*background-size: cover;*/
		background-clip: padding-box;
		color: <?php print $text_color;?>;
		padding-top: <?php print $top_padding;?>px;
		padding-bottom: <?php print $bottom_padding;?>px;
	}
</style>
<script>
	jQuery(document).ready(function($){
		$('#jmparallax_wrap<?php print $module_id;?> .carousel').each(function(index, element) {
			$(this)[index].slide = null;
		});
		$('#jmparallax_wrap<?php print $module_id;?> .carousel').carousel({interval:<?php print $parallax_timeout;?>});
		$.stellar({
			horizontalScrolling: false,
			verticalOffset: 40
		});
	});
</script>