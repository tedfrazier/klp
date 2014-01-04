<!--Layout:Latest News List,order:4--> 
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

global $jmnewspro_bxslider_load;
$document = JFactory::getDocument();
if (empty($jmnewspro_bxslider_load)) {
  $document->addScript(JURI::root(true) . '/modules/mod_jmnewspro/assets/js/jquery.bxslider.js');
  $jmnewspro_bxslider_load = 1;
}
?>
<?php $float = (Helix::direction()=='rtl')?'right':'left';?>

<div class="jmnewspro <?php //echo $moduleclass_sfx; ?>  <?php echo ($params->get('jmnewspro_layout', 'default')) ? ' ' . $params->get('jmnewspro_layout', 'default') : '' ?>" id="jmnewspro-<?php print $module->id; ?>">
  <?php
  foreach ($slides as $slide) {
    print '<div class="jmnewspro-item" style="height:'.$params->get('jmnewspro_item_height',50).'px">';
    echo  '<span class="title '.$float.'">' . $slide->title . '</span>';
    if ($params->get('jmnewspro_show_desc', 0)) {
      print '<div class="decs">' . $slide->description . '</div>';
    }
    echo '<span class="'.$float.'">' . date('F d, Y', $slide->created) . '</span>';
    print '</div>';
  }
  ?>
</div>
<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery('#jmnewspro-<?php print $module->id; ?>').bxSlider({
      mode: 'vertical',
      slideSelector: 'div.jmnewspro-item',
      minSlides: <?php echo $params->get('jmnewspro_minslide', 3); ?>,
      maxSlides: <?php echo $params->get('jmnewspro_maxslide', 3); ?>,
      auto: <?php echo $params->get('jmnewspro_auto', false); ?>,
      controls: false,
      slideMargin: <?php echo $params->get('jmnewspro_slidemargin',10)?>,
      pager: false,
      startSlide:0,
      pause: <?php echo $params->get('jmnewspro_timeout', 5000); ?>,
      speed: <?php echo $params->get('jmnewspro_speed', 500); ?>,
      autoHover: <?php echo $params->get('jmnewspro_onhover',false); ?>
    });
  })
  
</script>