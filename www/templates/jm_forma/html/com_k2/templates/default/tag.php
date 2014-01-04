<?php
/**
 * @version		$Id: tag.php 1766 2012-11-22 14:10:24Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

?>


<!-- Start K2 Tag Layout -->
<div id="k2Container" class="default tagView tagView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">
	<?php if($this->params->get('show_page_title')): ?>
	<!-- Page title -->
	<div class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</div>
	<?php endif; ?>

	<?php if($this->params->get('tagFeedIcon',1)): ?>
	<!-- RSS feed icon -->
	<div class="k2FeedIcon clearfix">
		<a href="<?php echo $this->feed; ?>" class="<?php echo (Helix::direction()=='rtl')?'left':'right'; ?> hasTip" data-original-title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
			<i class="fa fa-rss"></i>
		</a>
	</div>
	<?php endif; ?>

	<?php if(count($this->items)): ?>
	<article class="tagItemList row-fluid">
		<?php foreach($this->items as $item): ?>
		<!-- Start K2 Item Layout -->
		<div class="tagItemView clearfix row-fluid">
			<?php if($item->params->get('tagItemImage',1) && !empty($item->imageGeneric)): ?>
			  <!-- Item Image -->
			  <div class="tagItemImageBlock span4">
					<span class="tagItemImage">
					<a href="<?php echo $item->link; ?>" title="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>">
						<img src="<?php echo $item->imageGeneric; ?>" alt="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>" style="width:<?php echo $item->params->get('itemImageGeneric'); ?>px; height:auto;" />
					</a>
					</span>
			  </div>
			<?php endif; ?>

		    <div class="tagItemBody <?php if(!$item->params->get('tagItemImage',1) && empty($item->imageGeneric)) echo ' span12'; else echo 'span8'; ?>">
				<?php if($item->params->get('tagItemTitle',1)): ?>
				<header class="tagItemHeader entry-header">
					<!-- Item title -->
					<h2 class="title entry-title">
					<?php if ($item->params->get('tagItemTitleLinked',1)): ?>
						<a href="<?php echo $item->link; ?>">
							<?php echo $item->title; ?>
						</a>
					<?php else: ?>
						<?php echo $item->title; ?>
					<?php endif; ?>
					</h2>
				</header>
				<?php endif; ?>
				<div class="entry-meta muted clearfix">
					<?php if($item->params->get('tagItemDateCreated',1)): ?>
					<!-- Date created -->
					<span class="tagItemDateCreated entry-info publish-date <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>">
						<i class="fa fa-calenda"></i>
						<?php echo JHTML::_('date', $item->created , JText::_('JM_K2_DATE_FORMAT_LC4')); ?>
					</span>
					<?php endif; ?>
					
					<?php if($item->params->get('tagItemCategory')): ?>
					<!-- Item category name -->
					<span class="tagItemInfo entry-info item-tags <?php echo (Helix::direction()=='rtl')?'right':'left'; ?> last">
						<i class="fa fa-folder-open"></i>
						<a href="<?php echo $item->category->link; ?>"><?php echo $item->category->name; ?></a>
					</span>
					<?php endif; ?>
				</div>
				
				<?php /*
					$tags = K2ModelItem::getItemTags($item->id);
					for ($i=0; $i<sizeof($tags); $i++) {
					$tags[$i]->link = JRoute::_(K2HelperRoute::getTagRoute($tags[$i]->name));
					}
					$item->tags=$tags;
				?>
				<?php if(count($item->tags)): ?>
				<!-- Item tags -->
				<div class="ItemTagsBlock clearfix">
					<i class="fa fa-tags <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>" style="margin-<?php echo (Helix::direction()=='rtl')?'left':'right'; ?>:15px;"></i>
					<span class="catItemTags style-list style-tags unstyled">
					<?php foreach ($item->tags as $tag): ?>
					<a href="<?php echo $tag->link; ?>" class="<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>"><?php echo $tag->name; ?></a>
					<?php endforeach; ?>
					</span>
				</div>
				<?php endif; */ ?>
				
				
				<?php if($item->params->get('tagItemIntroText',1)): ?>
				<!-- Item introtext -->
				<content class="tagItemIntroText">
					<?php echo $item->introtext; ?>
				</content>
				<?php endif; ?>

				<?php if($item->params->get('tagItemExtraFields',0) && count($item->extra_fields)): ?>
				<!-- Item extra fields -->  
				<div class="tagItemExtraFields">
					<h4 class="entry-title"><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></h4>
					<ul class="style-list unstyled">
					<?php foreach ($item->extra_fields as $key=>$extraField): ?>
					<?php if($extraField->value != ''): ?>
					<li class="<?php echo ($key%2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
						<?php if($extraField->type == 'header'): ?>
						<h4 class="tagItemExtraFieldsHeader"><?php echo $extraField->name; ?></h4>
						<?php else: ?>
						<i class="fa fa-angle-<?php echo (Helix::direction()=='rtl')?'left':'right'; ?>"></i>
						<span class="tagItemExtraFieldsLabel"><?php echo $extraField->name; ?></span>
						<span class="tagItemExtraFieldsValue"><?php echo $extraField->value; ?></span>
						<?php endif; ?>		
					</li>
					<?php endif; ?>
					<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>

				<?php if ($item->params->get('tagItemReadMore')): ?>
				<!-- Item "read more..." link -->
				<div class="tagItemReadMore">
					<a class="k2ReadMore btn btn-readmore <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>" href="<?php echo $item->link; ?>">
						<?php echo JText::_('JM_K2_READ_MORE'); ?>
					</a>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<!-- End K2 Item Layout -->
		<?php endforeach; ?>
	</article>

	<!-- Pagination -->
	<?php if($this->pagination->getPagesLinks()): ?>
	<div class="k2Pagination pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
		<span class="counter <?php echo (Helix::direction()=='rtl')?'left':'right'; ?>"
		<?php echo $this->pagination->getPagesCounter(); ?>
		</span>
	</div>
	<?php endif; ?>

	<?php endif; ?>
	
</div>
<!-- End K2 Tag Layout -->
