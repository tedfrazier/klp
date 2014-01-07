<!--Layout:Default,order:0-->
<?php
/* * --------------------------------------------------------------------
  # Package - JoomlaMan Module
  # Version 1.0
  # --------------------------------------------------------------------
  # Author - JoomlaMan http://www.joomlaman.com
  # Copyright (coffee) 2012 - 2013 JoomlaMan.com. All Rights Reserved.
  # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
  # Websites: http://www.JoomlaMan.com
  ---------------------------------------------------------------------* */
// no direct access
defined('_JEXEC') or die('Restricted access');
$document = JFactory::getDocument();
$moduleId = $module->id;
?>
<div id="twitter<?php echo $moduleId; ?>"></div>
<style type="text/css">
  #twitter<?php echo $moduleId; ?> {
    height:<?php echo $height; ?>;
    width:<?php echo $width; ?>;
  }
</style>
<script type="text/javascript">
  var root = '<?php echo JURI::root(); ?>';
  var searchTerm = '<?php echo $searchTerm ?>';
  var count = '<?php echo $count ?>';
</script>
<script type="text/javascript" src="<?php print JURI::root(true) ?>/modules/mod_jmtwitterroll/assets/js/twitter.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery('#twitter<?php echo $moduleId; ?>').twitterSearchesN({ 
      term:  '<?php echo $searchTerm; ?>', 
      title: '<?php echo $title; ?>', 
      titleLink: '<?php echo $titleLink; ?>', 
      timeout: <?php echo $tweetScroll; ?>,
      colorExterior: '<?php echo $colorExterior; ?>',
      colorInterior: '<?php echo $colorInterior; ?>',
      avatar: <?php echo $avatar; ?>,
      pause: <?php echo $pause; ?>,
      time: <?php echo $time; ?>,
      bird: <?php echo $bird; ?>,
      site_url: '<?php print JURI::root(true) ?>',
			itemid: <?php print $jmitemid;?>
    });
  });
</script>