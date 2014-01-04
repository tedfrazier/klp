<!--Layout: Bootstrap Carousel,order:4-->
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
$document->addStyleSheet(JURI::root().'modules/mod_jmtwitterroll/assets/css/mod_jmtwitter_default.css');
///$document->addStyleSheet(JURI::root().'modules/mod_jmtwitterroll/assets/css/bootstrap.css');
//$document->addStyleSheet(JURI::root().'modules/mod_jmtwitterroll/assets/css/bootstrap-responsive.css');
$moduleId = $module->id;
$user= $tweet->user;
?>
<?php foreach($tweets as $i=>$tweet){ $user= $tweet->user; } ?>
<script type="text/javascript" src="<?php echo JURI::root(true).'/modules/mod_jmtwitterroll/assets/js/bootstrap.js';?>"></script>
<script type="text/javascript" src="<?php echo JURI::root(true).'/modules/mod_jmtwitterroll/assets/js/bootstrap-carousel.js';?>"></script>
<div id="twitter<?php echo $moduleId; ?>" class="jmtwitterroll">
<div id="myCarousel" class="carousel slide">
<div class="carousel-inner">
<?php if($avatar==1){?>
<div class="twitterAvatar">
	<img class="twitterSearchesNProfileImg" src="<?php echo $user->profile_image_url;?>">
	<span class="twitterSearchesNUser">
		<a href="<?php echo "http://www.twitter.com/".$searchTerm ?>" target="_blank">
			@<?php echo $user->name;?>
		</a>
	</span>
</div>
<?php }?>
<?php if($avatar==2){?>
<div class="twitterIcon">
	<i class="fa fa-twitter "></i>
	<span class="twitterSearchesNUser">
		<a href="<?php echo "http://www.twitter.com/".$searchTerm ?>" target="_blank">
			@<?php echo $user->name;?>
		</a>
	</span>
</div>
<?php }?>
<?php foreach($tweets as $i=>$tweet){ ?>
	<div class="item_slide item<?php if($i==0) echo " active"?>" alt="<?php echo $i;?>"> 
		
		<div class="twitterContentWrap">
			<div class="twitterSearchesNText"> 
				<?php
				$text = $tweet->text;
				echo $text;?>
			</div>
			<span class="twitterSearchesNTime">
				<?php echo modJmTwitterrollHelper::prettyDate($tweet->created_at);?>
			</span>
		</div>
	</div>
<?php }?>
</div>
<a class="carousel-control" href="#myCarousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
<a class="carousel-control right" href="#myCarousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
</div>
</div>
<!-- <style type="text/css">
  #twitter<?php echo $moduleId; ?> {
    height:<?php echo $height; ?>;
    width:<?php echo $width; ?>;
  }

</style> -->
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('.carousel').carousel({interval:5000});
	})
</script>