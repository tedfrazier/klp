<!--layout:JM Parallax Vertical ,order:1-->
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
global $jmnewspro_bxslider_load;
if (empty($jmnewspro_bxslider_load)) {
  $document->addScript(JURI::root(true) . 'modules/mod_jmparallax/assets/js/jquery.bxslider.js');
  $jmnewspro_bxslider_load = 1;
}
?>
<div data-stellar-background-ratio="<?php print $parallax_background_ratio;?>" class="jm-omnia jmparallax_wrap <?php echo $moduleclass_sfx; ?>" id="jmparallax_wrap<?php echo $module_id; ?>">
  <div class="container">
	<div class="container-inner">
		<div class="carousel slide" data-interval="<?php print $parallax_timeout;?>">
			<div class="carousel-inner">
				<div class="slider_wrap">
					<?php foreach($slides as $k=>$slide):?>
					<div class="item<?php if($k==0) print " active";?>">
					<?php echo $slide; ?>
					</div>
					<?php endforeach;?>
				</div>
			</div>
		</div>
	</div>
  </div>
</div> 
<style type="text/css">
	#jmparallax_wrap<?php print $module_id;?>{
		background-image:url('<?php echo JURI::root() . $background_image; ?>');
		background-repeat: <?php print $repeat_background;?>;
		/*background-attachment: <?php print ($parallax_background)?'scroll':'scroll';?>;*/
		/*background-size: cover;*/
		background-clip: padding-box;
		color: <?php print $text_color;?>;
		padding-top: <?php print $top_padding;?>px;
		padding-bottom: <?php print $bottom_padding;?>px;
		-webkit-transform: translateZ(1);
		-webkit-transform: translate3d(1, 1, 1); 
    transform: translate3d(1, 1, 1);
	}
</style>
<script>
	jQuery(document).ready(function($){
		var controls = <?php echo $parallax_carousel_controls;?>;
		var pager = false;
		if(controls==1) pager = true;
		$('#jmparallax_wrap<?php print $module_id;?> .slider_wrap').bxSlider({
			mode:'vertical',
			auto: true,
			pager: pager,
			controls: false,
			speed: 1000,
			pause: <?php echo $parallax_timeout;?>
		});
		var $parallax = $('#jmparallax_wrap<?php echo $module_id; ?>');
		$parallax.attr('data-offset-top',$parallax.offset().top);
		var ratio = $parallax.data('stellar-background-ratio');
		$(window).scroll(function(){
			if($(window).height() < $parallax.offset().top){
				if($(window).scrollTop()+$(window).height() > $parallax.offset().top){
					var yPos = (($(window).scrollTop() - $parallax.offset().top) * (1-ratio)); 
					// Put together our final background position
					var coords = '50% '+ yPos + 'px';
					// Move the background
					$parallax.css({ backgroundPosition: coords });
				}
			}else{
				var yPos = ($(window).scrollTop() * (1-ratio)); 
				// Put together our final background position
				var coords = '50% '+ yPos + 'px';
				// Move the background
				$parallax.css({ backgroundPosition: coords });
			}
		})

	});
</script>