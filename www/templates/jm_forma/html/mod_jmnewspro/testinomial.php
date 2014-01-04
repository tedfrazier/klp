<!--layout:Clients Testinomial,order:4-->
<?php
/* * --------------------------------------------------------------------
  # Package - JoomlaMan JMNewsPro
  # Version 1.0.1
  # --------------------------------------------------------------------
  # Author - JoomlaMan http://www.joomlaman.com
  # Copyright © 2012 - 2013 JoomlaMan.com. All Rights Reserved.
  # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
  # Websites: http://www.JoomlaMan.com
  ---------------------------------------------------------------------* */
// no direct access
defined('_JEXEC') or die('Restricted access');
global $jmnewspro_jquery_load;
global $jmnewspro_bxslider_load;
$document = JFactory::getDocument();
$jmnewspro_include_jquery = $params->get('jmnewspro_include_jquery', 0);
if ($jmnewspro_include_jquery) {
  if (empty($jmnewspro_jquery_load)) {
    $document->addScript(JURI::root(true) . '/modules/mod_jmnewspro/assets/js/jquery-1.8.3.js');
    $jmnewspro_jquery_load = 1;
  }
}
if (empty($jmnewspro_bxslider_load)) {
  $document->addScript(JURI::root(true) . '/modules/mod_jmnewspro/assets/js/jquery.bxslider.js');
  $jmnewspro_bxslider_load = 1;
}
$jmnewspro_item_width = $params->get('jmnewspro_item_width', 200);
$jmnewspro_item_height = $params->get('jmnewspro_item_height', 200);
$jmnewspro_minslide = $params->get('jmnewspro_minslide', 1);
$jmnewspro_maxslide = $params->get('jmnewspro_maxslide', 3);
$jmnewspro_moveslide = $params->get('jmnewspro_moveslide', 0);
$jmnewspro_slidemargin = $params->get('jmnewspro_slidemargin', 10);
$moduleclass_sfx = $params->get('moduleclass_sfx');
$jmnewspro_show_nav_buttons = $params->get('jmnewspro_show_nav_buttons', 0);
$jmnewspro_show_pager = $params->get('jmnewspro_show_pager', 0);
$jmnewspro_show_title = $params->get('jmnewspro_show_title', 1);
$jmnewspro_show_desc = $params->get('jmnewspro_show_desc', 1);
$jmnewspro_show_image = $params->get('jmnewspro_show_image', 1);
$jmnewspro_show_readmore = $params->get('jmnewspro_show_readmore', 0);
$jmnewspro_readmore_text = $params->get('jmnewspro_readmore_text', 'Read more');
$jmnewspro_hover = $params->get('jmnewspro_hover', 0);
$jmnewspro_pager_position = $params->get('jmnewspro_pager_position', 'bottomright');
$jmnewspro_image_link = $params->get('jmnewspro_image_link', 'bottomright');
if (empty($slides)) {
  print "There are no slide to show, Please make sure you have configured SlideShow correctly.";
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
  <div class="slider">
    <?php foreach ($slides as $i => $slide): ?>
      <div class="slide-item" style="min-height:<?php print $jmnewspro_item_height; ?>px">
        <div class="slide-item-wrap">
          <div class="slide-item-wrap-item">
			<?php if ($jmnewspro_show_desc): ?>
			<div class="slide-item-desc">
			<div class="testinomialUserDescription">
				<?php echo $slide->description; ?>
			</div>
			<div class="ArrowWrap"><span class="arrow"></span></div>	
			</div>
			<?php endif; ?>
            <?php if ($jmnewspro_show_image): ?>
              <div class="slide-item-image testinomialUsersAvatarWrap clearfix">
                <?php if ($jmnewspro_image_link): ?>
                  <a href="<?php print $slide->link; ?>"><img src="<?php echo $slide->getMainImage(); ?>"></a>
                <?php else: ?>
                  <img src="<?php echo $slide->getMainImage(); ?>">
                <?php endif; ?>
              </div>
            <?php endif; ?>
            <?php if ($jmnewspro_show_title): ?>
              <div class="slide-item-desc-warp<?php print ($jmnewspro_hover) ? ' jmnewsprohover' : ''; ?>">
                <div class="slide-inner">
                  <?php if ($jmnewspro_show_title): ?>
                      <?php
                        $tmp=explode('|',$slide->title);
                      ?>
                    <div class="testinomialNameWrap slide-item-title clearfix">
                        <div class="testinomialUsersName"><h3 class="title header"><?php echo $tmp[0]; ?></h3></div>
                        <div class="testinomialUsersType"><?php echo $tmp[1]; ?></div>
                    </div>
                  <?php endif; ?> 
                </div>
              </div>
            <?php endif; ?>
			<?php if ($jmnewspro_show_readmore): ?>
			<span class="slide-item-readmore"><a href="<?php print $slide->link ?>"><?php print $jmnewspro_readmore_text; ?></a></span>
		  <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <?php if ($jmnewspro_show_nav_buttons): ?>
    <span class="jmnewspro-prev" onclick="javascript:{jQuery(this).parents('.jmnewspro').find('.bx-prev').trigger('click')}">Prev</span>
    <span class="jmnewspro-next" onclick="javascript:{jQuery(this).parents('.jmnewspro').find('.bx-next').trigger('click')}">Next</span>
  <?php endif; ?>
</div>
<!-- END Responsive Carousel MODULE -->
<script type="text/javascript">
  jQuery(document).ready(function(){
    var $itemWidthNew = <?php echo $jmnewspro_item_width; ?>;
    var options = {};
    function adjustSlide(){
      var $moduleWidth = jQuery('#jmnewspro-<?php print $module->id; ?>').width();
      var $itemWidth = <?php echo $jmnewspro_item_width; ?>;
      var $items = $moduleWidth/$itemWidth;
      $items = parseInt($items.toString());
      if($items > <?php print $jmnewspro_maxslide; ?>){
        $items = <?php print $jmnewspro_maxslide; ?>;
      }
      var $marginTotal = <?php echo $jmnewspro_slidemargin; ?>*($items-1);
      $itemWidthNew = ($moduleWidth - $marginTotal)/$items;
      if($itemWidthNew > $moduleWidth) $itemWidthNew = $moduleWidth;
      jQuery('#jmnewspro-<?php print $module->id; ?> .slide-item').width($itemWidthNew);
      //jQuery('#jmnewspro-<?php print $module->id; ?> .slide-item img').width($itemWidthNew);
      options.slideSelector = 'div.slide-item';
      options.slideWidth = $itemWidthNew;
      options.minSlides =	<?php echo $jmnewspro_minslide; ?>;
      options.maxSlides = <?php echo $jmnewspro_maxslide; ?>;
      options.moveSlides = <?php echo $jmnewspro_moveslide; ?>;
      options.slideMargin = <?php echo $jmnewspro_slidemargin; ?>;
      options.speed = <?php echo $jmnewspro_speed; ?>;
      options.infiniteLoop = true;
      options.autoHover = <?php echo $jmnewspro_onhover; ?>;
      options.auto = <?php echo $jmnewspro_auto; ?>;
      options.pause = <?php echo $jmnewspro_timeout; ?>;
      options.adaptiveHeight = true;
      options.controls = <?php print empty($jmnewspro_show_nav_buttons) ? 'false' : 'true'; ?>;
    }
    adjustSlide();
    var jmnewspro<?php print $module->id; ?>=jQuery('#jmnewspro-<?php print $module->id; ?> .slider').bxSlider(options);
   
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
  });
</script>
