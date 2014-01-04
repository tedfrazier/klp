<!--Layout: JM Forma,order:5-->
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
$document->addStyleSheet(JURI::root().'modules/mod_jmtwitterroll/assets/css/mod_jmtwitter_forma.css');
$moduleId = $module->id;
?>
<?php foreach($tweets as $i=>$tweet){ $user= $tweet->user; } ?>
<div id="twitter<?php echo $moduleId; ?>" class="jmtwitterroll JMForma">
	<div id="myCarousel" class="jm-carousel slide">
		<?php if($avatar==1){?>
		<div class="twitterAvatar clearfix">
			<img class="twitterSearchesNProfileImg" src="<?php echo $user->profile_image_url;?>">
			<span class="twitterSearchesNUser">
				<a href="<?php echo "http://www.twitter.com/".$searchTerm ?>" target="_blank">
					@<?php echo $user->name;?>
				</a>
			</span>
		</div>
		<?php }?>
		<?php if($avatar==2){?>
		<div class="twitterIcon clearfix">
			<i class="fa fa-twitter "></i>
			<span class="twitterSearchesNUser">
				<a href="<?php echo "http://www.twitter.com/".$searchTerm ?>" target="_blank">
					@<?php echo $user->name;?>
				</a>
			</span>
		</div>
		<?php }?>
		
		<div class="carousel-inner">
		<?php foreach($tweets as $i=>$tweet){ ?>
			<div class="item_slide clearfix item<?php if($i==0) echo " active"?>" alt="<?php echo $i;?>"> 
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
		<div class="JMTwitterRollNav">
			<a class="prev" href="#myCarousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
			<a class="next" href="#myCarousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
		</div>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('.jm-carousel').carousel({interval:5000});
	})
</script>