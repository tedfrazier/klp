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
/* getParams */
$configs = JComponentHelper::getParams('com_jm_video_galleries');
$library_bootstrap = $configs->get('library_bootstrap',0);
$library_jquery = $configs->get('library_jquery',0);
$view_sorting = $configs->get('view_sorting',0);
/* css */
$itemid = JRequest::getVar('Itemid',0);
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
$document->addStyleSheet('components/com_jm_video_galleries/assets/css/jquery.jscrollpane.css');
/* library jquery */
if($library_jquery){
	$document->addScript('components/com_jm_video_galleries/assets/js/jquery-1.8.3.js');
}
$document->addScript('components/com_jm_video_galleries/assets/js/jquery.fitvids.js');
$document->addScript('components/com_jm_video_galleries/assets/js/jquery.mousewheel.js');
$document->addScript('components/com_jm_video_galleries/assets/js/jquery.jscrollpane.min.js');
$document->addScript('components/com_jm_video_galleries/assets/js/jmvideosgalleries.js');
/* library bootstrap */
if($library_bootstrap){
	$document->addStyleSheet('components/com_jm_video_galleries/assets/css/bootstrap.min.css');
	$document->addStyleSheet('components/com_jm_video_galleries/assets/css/bootstrap-responsive.min.css');
	$document->addScript('components/com_jm_video_galleries/assets/js/bootstrap.min.js'); 
}
require_once JPATH_SITE . '/components/com_jm_video_galleries/helpers/jm_video_galleries.php';
?>
<script type="text/javascript">
	var cols = <?php echo $this->col;?>;
	var ordering = '<?php echo $this->ordering;?>';
	setInterval(function(){
		jQuery('.jmvideogalleries_videos_item').each(function(){
			//jQuery(this).find('.padding').width(jQuery(this).width()-20).height(jQuery(this).height()-20);
			jQuery(this).find('.padding').width(jQuery(this).width()).height(jQuery(this).height());
		})
	},500);
</script>
<script src="<?php print JURI::root(true);?>/components/com_jm_video_galleries/assets/js/jquery.grid.min.js" type="text/javascript"></script>
<!--filter--> 
<div id="jm-videogalleries"> 
<ul class="jmfilters jmvideogalleries_videos_filter left">
	<li class="filter"><?php echo JText::_('COM_JM_VIDEO_GALLERIES_VIDEOS_FILTER');?></li>
	<li class="jm-inverse current" data-filter="*"><?php echo JText::_('COM_JM_VIDEO_GALLERIES_VIDEOS_FILTER_ALL');?></li>
	<?php if($this->cat_ids){
		foreach($this->cat_ids AS $cat){
			echo '<li class="jm-inverse" data-filter="'.'.'.$cat->id.'">'.$cat->title.'</li>';
		} 
	}?>
</ul>
<!--sorting-->
<?php if($view_sorting){?>
	<ul class="jmfilters jmvideogalleries_videos_sorting right">
		<li class="filter"><?php echo JText::_('COM_JM_VIDEO_GALLERIES_VIDEOS_SORTING');?></li>
		<li class="jm-inverse" data-sorting="name"><?php echo JText::_('COM_JM_VIDEO_GALLERIES_VIDEOS_SORTING_BY_NAME');?></li>
		<li class="jm-inverse" data-sorting="date"><?php echo JText::_('COM_JM_VIDEO_GALLERIES_VIDEOS_SORTING_BY_DATE');?></li>
	</ul>
<?php }?>
<div class="row-fluid jm-video-container" id="jmvideogalleries_videos_items">
	<?php 
	$cols=$this->col;
	$span=12/$cols;
	if($this->items){
		foreach($this->items AS $item){
			$category = str_replace(","," ",$item->cat_ids);
			/* thumbnail */
			if($item->image!=''){ 
				$thumb = str_replace("../","",$item->image);
			}
			else{
				$thumb = JRoute::_('components/com_jm_video_galleries/assets/images/no-image.png');
			}
			/* iframe video */
			if ($item->video_type == 'Vimeo') {
				$url = $item->url;
				$leng_url = strlen($url);
				$idvideo = substr($url, $leng_url - 8);
				$iframe = "longdesc='http://player.vimeo.com/video/".$idvideo."'  frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen";
				$src ="?autoplay=".$this->autoplay_video;
			} else {
				$url = $item->url;
				$leng_url = strlen($url);
				$idvideo = substr($url, $leng_url - 11);
				$iframe = "longdesc='http://www.youtube.com/embed/".$idvideo."' frameborder='0' allowfullscreen";
				$src ="?autoplay=".$this->autoplay_video;
			}
			/* get global config */
			$config =JFactory::getConfig();
			$link = JRoute::_('index.php?option=com_jm_video_galleries&view=video&id=' . (int) $item->id . '&gid='.$itemid.'&Itemid=' . $itemid);
			?>
			<div class="jmvideogalleries_videos_item <?php echo $category;?>">
				<p class="name" style="display:none"><?php echo $item->title;?></p>
				<p class="date" style="display:none"><?php echo $item->date_created;?></p>
				<div class="jm_videogalleries_video<?php echo $item->id;?>" style="display:none"><?php echo $iframe;?></div>
				<div class="jm_videogalleries_video_src<?php echo $item->id;?>" style="display:none"><?php echo $src;?></div>
				<?php if($this->video_lightbox==0){?>
					<a href="<?php echo $link;?>">
				<?php }else{?>
					<a href="#jm-video-myModal" onclick="javascript:{getVideoData(<?php echo $item->id;?>);jQuery('#jm-video-myModal').modal('show'); return false;}">
				<?php }?>
					<img src="<?php echo $thumb;?>"/>
					<!--title-->
					<div class="jmvideogalleries_videos_title">
						<div class="padding">
						<div class="jmvideogalleries_title_desc clearfix">
							<div class="jmvideogalleries_title jm_videogalleries_title<?php echo $item->id;?> name">
								<i class="fa fa-play"></i>
								<h3 class="JMVideoGalleriesItemTitle"><?php echo substr($item->title,0,35);?></h3>
							</div>
							<div class="span12 jmvideogalleries_date jm_videogalleries_date<?php echo $item->id;?> date" style="display:none"><?php echo $item->date_created;?></div>
							<?php if($this->show_description):?>
                <?php if($this->description_length):?>
								<div class="span12 jmvideogalleries_desc jm_videogalleries_desc<?php echo $item->id; ?>"><?php echo substr($item->description, 0, $this->description_length); ?></div>
								<?php else:?>
                <div class="span12 jmvideogalleries_desc jm_videogalleries_desc<?php echo $item->id; ?>"><?php echo $item->description; ?></div>
								<?php endif;?>
                <?php endif;?>
						</div>
						</div>
					</div>
				</a> 
			</div>
	<?php } ?>
	<?php }?>
</div>
<!--Modal-->
<div id="jm-video-myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="jm-video-modal-header">
		<img id="jm-video-modal-close" onclick="turnOffVideo()" data-dismiss="modal" aria-hidden="true" src="<?php echo (JURI::base() . 'components/com_jm_video_galleries/assets/images/delete-icon.jpg');?>"/>
	</div>
	<div class="jm-video-modal-body">
		<div class="jm-video-modal-title"></div>
		<div class="jm-video-modal-video"></div>
		<div class="jm-video-modal-description"><p></p></div>
	</div>
	<div class="jm-video-modal-footer">
	</div>
</div>
</div>