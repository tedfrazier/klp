<?php
/**
 * @package     com_jm_video_galleries
 * @version     1.0.0
 * Author - JoomlaMan http://www.joomlaman.com
 * Copyright (C) 2012 - 2013 JoomlaMan.com. All Rights Reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 * Websites: http://www.JoomlaMan.com
 * Support: support@joomlaman.com
*/
// no direct access
defined('_JEXEC') or die;
jimport('joomla.application.component.helper');
$lang = JFactory::getLanguage();
$lang->load('com_jm_video_galleries', JPATH_ADMINISTRATOR);
/* getParams */
$configs = JComponentHelper::getParams('com_jm_video_galleries');
$library_bootstrap = $configs->get('library_bootstrap',0);
$library_jquery = $configs->get('library_jquery',0);
$social_button = $configs->get('social_button',0);
$itemid = JRequest::getVar('Itemid',0);
/* css */
$document = JFactory::getDocument();
if (!defined('DS'))
    define('DS', '/');
require_once JPATH_SITE . DS . 'components' . DS . 'com_jm_video_galleries' . DS . 'helpers' . DS . 'jm_video_galleries.php';
$custom_css = JPATH_SITE . '/templates/' . Jm_video_galleriesHelper::getTemplate() . '/css/jmvideogalleries.css';
if (file_exists($custom_css)) {
    $document->addStylesheet(JURI::base(true) . '/templates/' . Jm_video_galleriesHelper::getTemplate() . '/css/jmvideogalleries.css');
} else {
    $document->addStylesheet(JURI::base(true) . '/components/com_jm_video_galleries/assets/css/jmvideogalleries.css');
}
/* library jquery */
if($library_jquery){
	$document->addScript('components/com_jm_video_galleries/assets/js/jquery-1.8.3.js');
}
/* jquery */
$document->addScript('components/com_jm_video_galleries/assets/js/jquery.fitvids.js');
$document->addScript('components/com_jm_video_galleries/assets/js/jmvideogalleries.js');
/* library bootstrap */
if($library_bootstrap){
	$document->addStyleSheet('components/com_jm_video_galleries/assets/css/bootstrap-responsive.min.css');
	$document->addStyleSheet('components/com_jm_video_galleries/assets/css/bootstrap.min.css');
	$document->addScript('components/com_jm_video_galleries/assets/js/bootstrap.min.js');
}
$gid=JRequest::getVar('gid',0);
?>
<div id="jm-videogalleries">
	<?php if ($this->item) {?>
		<!--title-->
		<div class="row-fluid jmvideogalleries-video-title"> 
			<div class="span8 offset1">
				<h4><?php echo $this->item->title; ?></h4>
			</div>
			<div class="span2 jmvideogalleries-back-to-projects">
			    <?php if($gid):?>
				<a href="<?php print JRoute::_('index.php?option=com_jm_video_galleries&view=videos&Itemid='.$gid);?>" title="<?php echo JText::_('COM_JM_VIDEO_GALLERIES_VIDEO_BACK_TO_GALLERY');?>"><i class="fa fa-th"></i><?php echo JText::_('COM_JM_VIDEO_GALLERIES_VIDEO_BACK_TO_GALLERY');?></a>
			    <?php endif;?>
			</div>
		</div>
		
		<div class="row-fluid jmvideogalleries-video-content">
			<!--item-->
			
			<?php if($social_button){?>
				
				<div class="jmvideogalleries-video-social">
					<ul>
						<li>
							<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
						</li>
						<li> 
							<div id="fb-root"></div>
							<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=139769666230347";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
							<div class="fb-like" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
						</li>
						<li>
							<?php 
								$link = JURI::root().($this->link_replace);
								$img =JURI::root().$this->thumb;
							?>
							<a href="//pinterest.com/pin/create/button/?url=<?php echo $link; ?>&media=<?php echo $img;?>&description=<?php echo $this->item->description;?>" data-pin-do="buttonPin" data-pin-config="beside">
								<img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" />
							</a>
						</li>     
					</ul>
				</div>		
			<?php }?>
			
			<div class="span12">
				<!--prev-->
				<div class="span1">
					<?php
					$list = $this->model->getPrevItems($this->cat_ids, $this->item->ordering);
					///get global config
				          $config = JFactory::getConfig();
				          if ($list) {
				            $next = $list->title;
						if($gid){
							$link = JRoute::_('index.php?option=com_jm_video_galleries&view=video&gid='.$gid.'&Itemid='.$itemid.'&id=' . (int) $list->id);
						}else{
							$link = JRoute::_('index.php?option=com_jm_video_galleries&view=video&Itemid='.$itemid.'&id=' . (int) $list->id);
						}
							echo '<a class="jm-np prev" href = "' . $link . '" title="' . $next . '">';
							echo '<i class="fa fa-angle-left"></i>';
							echo '</a>';
					}else{
						echo '<i class="fa fa-angle-left"></i>';
					}
					?>
				</div>
				<!--video-->
				<div class="span10" id="jm-videogalleries-video">
					<?php
				          if (Jm_video_galleriesHelper::videoType($this->item->url) == 'vimeo') {
				            $idvideo = Jm_video_galleriesHelper::getVideoID($this->item->url);
				            ?>
				            <iframe src="http://player.vimeo.com/video/<?php echo $idvideo; ?>?autoplay=<?php echo $this->autoplay_video; ?>" longdesc="http://player.vimeo.com/video/<?php echo $idvideo; ?>?autoplay=1"  frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe> 
				            <?php
				          } else {
				            $idvideo = Jm_video_galleriesHelper::getVideoID($this->item->url);
				            ?>
				            <iframe src="http://www.youtube.com/embed/<?php echo $idvideo; ?>?autoplay=<?php echo $this->autoplay_video; ?>" longdesc="http://www.youtube.com/embed/<?php echo $idvideo; ?>" frameborder="0" allowfullscreen></iframe>
				          <?php } ?>
				</div>
				<!--next-->
				<div class="span1">
					<?php
					$list = $this->model->getNextItems($this->cat_ids,$this->item->ordering);
					if ($list) {
							$next = $list->title;
							///get global config
							if($gid){
								$link = JRoute::_('index.php?option=com_jm_video_galleries&gid='.$gid.'&Itemid='.$itemid.'&view=video&id=' . (int) $list->id);
							}else{
								$link = JRoute::_('index.php?option=com_jm_video_galleries&Itemid='.$itemid.'&view=video&id=' . (int) $list->id);
							}
							echo '<a class="jm-np next" href = "' . $link . '" title="' . $next . '">';
							echo '<i class="fa fa-angle-right"></i>';
							echo '</a>';
						} else {
							echo '<i class="fa fa-angle-right"></i>';
						}
					?>
				</div>
			</div>
		</div>
		<!--description-->
		<?php if(strlen($this->item->description)>0){?>
		<div class="row-fluid jmvideogalleries-video-description">
			<p><?php echo $this->item->description; ?></p>
		</div>
		<?php }?>
	<?php }else{
		echo JText::_('COM_JM_VIDEO_GALLERIES_ITEM_NOT_LOADED');
	} ?>
	<!--get script social-->
	<?php $document->addScript('components/com_jm_video_galleries/assets/js/social.js');?>
</div>