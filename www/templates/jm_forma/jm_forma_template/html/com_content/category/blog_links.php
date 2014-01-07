<?php

// no direct access
defined('_JEXEC') or die;
?>

<section class="items-more">
	<h3 class="item-title"><?php echo JText::_('COM_CONTENT_MORE_ARTICLES'); ?></h3>
	<ul class="style-list unstyled">
	<?php foreach ($this->link_items as &$item): ?>
		<li>
			<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid)); ?>">
				<i class="fa fa-angle-<?php echo (Helix::direction()=='rtl')?'left':'right'; ?>" style="margin-<?php echo (Helix::direction()=='rtl')?'left':'right'; ?>:2px;"></i>
				<?php echo $item->title; ?>
			</a>
		</li>
	<?php endforeach; ?>
	</ul>
</section>