<?php
/**
 * @version		$Id: comments.php 1812 2013-01-14 18:45:06Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2013 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;
$doc = JFactory::getDocument();
$language = $doc->language;
$direction = $doc->direction;
if($direction ='ltr') $pad_pos = 'left'; else $pad_pos = 'right';
?>

<div id="k2ModuleBox<?php echo $module->id; ?>" class="k2LatestCommentsBlock <?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">
	<?php if($params->get('feed')): ?>
	<div class="k2FeedIcon right">
		<a href="<?php echo JRoute::_('index.php?option=com_k2&view=itemlist&format=feed&moduleID='.$module->id); ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
			<i class="fa fa-rss-sign"></i> 
		</a>
		<div class="clr"></div>
	</div>
	<?php endif; ?>
	<?php if(count($comments)): ?>
	<ul>
		<?php foreach ($comments as $key=>$comment):	?>
		<li class="<?php //echo ($key%2) ? "odd" : "even"; if(count($comments)==$key+1) echo ' lastItem'; ?>">
			<?php if($comment->userImage): ?>
			<div class="k2CommentAvatar">
			<a class="k2Avatar lcAvatar" href="<?php echo $comment->link; ?>" title="<?php echo K2HelperUtilities::cleanHtml($comment->commentText); ?>">
				<img class="<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>" src="<?php echo $comment->userImage; ?>" alt="<?php echo JFilterOutput::cleanText($comment->userName); ?>" style="width:<?php echo $lcAvatarWidth; ?>px;height:auto;" />
			</a>
			</div>
			<?php endif; ?>
			<div class="k2CommentInfo" style="padding-<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>:<?php echo $lcAvatarWidth+15; ?>px">
				<?php if($params->get('commenterName')): ?>
				<h5 class="lcUsername">
					<?php //echo JText::_('K2_WRITTEN_BY'); ?>
					<?php if(isset($comment->userLink)): ?>
					<a rel="author" href="<?php echo $comment->userLink; ?>"><?php echo $comment->userName; ?></a>
					<?php elseif($comment->commentURL): ?>
					<a target="_blank" rel="nofollow" href="<?php echo $comment->commentURL; ?>"><?php echo $comment->userName; ?></a>
					<?php else: ?>
					<?php echo $comment->userName; ?>
					<?php endif; ?>
				</h5>
				<?php endif; ?>

				<?php if($params->get('commentDate')): ?>
				<div class="lcCommentDate">
					<?php if($params->get('commentDateFormat') == 'relative'): ?>
					<?php echo $comment->commentDate; ?>
					<?php else: ?>
					<?php //echo JText::_('K2_ON'); ?> <?php echo JHTML::_('date', $comment->commentDate, JText::_('JM_DATE_FORMAT_LC2')); ?>
					<?php endif; ?>
				</div>
				<?php endif; ?>

				<?php if($params->get('commentLink')): ?>
				<a href="<?php echo $comment->link; ?>"><span class="lcComment"><?php echo $comment->commentText; ?></span></a>
				<?php else: ?>
				<span class="lcComment"><?php echo $comment->commentText; ?></span>
				<?php endif; ?>


				<div class="clr"></div>

				<?php if($params->get('itemTitle')): ?>
				<div class="lcItemTitle"><a href="<?php echo $comment->itemLink; ?>"><?php echo $comment->title; ?></a></div>
				<?php endif; ?>

				<?php if($params->get('itemCategory')): ?>
				<div class="lcItemCategory">(<a href="<?php echo $comment->catLink; ?>"><?php echo $comment->categoryname; ?></a>)</div>
				<?php endif; ?>
			</div>
			<div class="clr"></div>
		</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>

	

</div>
