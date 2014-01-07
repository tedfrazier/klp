<!--Layout: bxSlider Carousel Horizontal,order:3-->
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
require_once (JPATH_SITE.'/modules/mod_jmtwitterroll/helper.php');
$document = JFactory::getDocument();
$document->addStyleSheet(JURI::root().'/modules/mod_jmtwitterroll/assets/css/mod_jmtwitter_default.css');
$moduleId = $module->id;
if($load_bxslider=="true"){
	echo '<script type="text/javascript" src="'.JURI::root(true).'/modules/mod_jmtwitterroll/assets/js/jquery.bxslider.js"></script>';
}?>
<div id="twitter<?php echo $moduleId; ?>" class="jmtwitterroll <?php print $moduleclass_sfx;?>">
<div class="twitterSearchesNContainters">
<?php foreach($tweets as $i=>$tweet){
	$user= $tweet->user;
?>
	<div class="item_slide" alt="<?php echo $i;?>">
		<?php if($avatar==1){?>
		<img class="twitterSearchesNProfileImg" src="<?php echo $user->profile_image_url;?>">
		<?php }?>
		<?php if($avatar==2){?>
		<img class="twitterSearchesNProfileImg" src="<?php echo JURI::root().'modules/mod_jmtwitterroll/assets/images/twitter.png';?>">
		<?php }?>
		<div>
			<div class="twitterSearchesNText"> 
				<?php
				$text = $tweet->text;
				echo $text;?>
			</div>
			<span class="twitterSearchesNTime">
				<?php echo modJmTwitterrollHelper::prettyDate($tweet->created_at);?>
			</span>
			<span class="twitterSearchesNUser">
				<a href="<?php echo "http://www.twitter.com/".$searchTerm ?>" target="_blank">
					Follow Us - @<?php echo $user->name;?>
				</a>
			</span>
		</div>
	</div>

<?php }?>
</div>
</div>
<style type="text/css">
  #twitter<?php echo $moduleId; ?> {
    height:<?php echo $height; ?>;
    width:<?php echo $width; ?>;
  }

</style>
<script type="text/javascript">
	jQuery(document).ready(function(){
		var twitter<?php echo $moduleId; ?> = jQuery('#twitter<?php echo $moduleId; ?> .twitterSearchesNContainters').bxSlider({
			slideMargin: 5,
			auto: <?php echo $auto;?>,
			moveSlides:1,
			touchEnabled:<?php echo $touch;?>,
			speed:<?php echo $tweetScroll;?>,
			pause:<?php echo $timeout;?>,
			pager: false
		});
	})
</script>