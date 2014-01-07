<?php 
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$class = ' first ';
$d=0;
if (count($this->items[$this->parent->id]) > 0 && $this->maxLevelcat != 0) :
?>
<div id="SubCategoriesList">
<div class="row-fluid">
<?php foreach($this->items[$this->parent->id] as $id => $item) : ?>
	<?php
	$d++;
	if ($this->params->get('show_empty_categories_cat') || $item->numitems || count($item->getChildren())) :
	if (!isset($this->items[$this->parent->id][$id + 1]))
	{
		$class = ' last ';
	}
	?>
	<div class="span4 row-space <?php echo $class; ?>">
		<?php $class = ''; ?>
		<?php
			preg_match('/<img (.*?)>/', $item->description, $match);
			$contentIMG = $match[0];
			$contentText=  preg_replace("/\< *[img][^\>]*[.]*\>/i","",$item->description,1);
		?>
		<?php if($contentIMG) { ?>
			<div class="subCategoryImage text-center">
				<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($item->id));?>"><?php echo $contentIMG; ?></a>
				<h2 class="subCategoryTitle entry-title">
					<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($item->id));?>">
					<?php echo $this->escape($item->title); ?></a>
					
					<?php if (count($item->getChildren()) > 0) : ?>
						<a href="#category-<?php echo $item->id;?>" data-toggle="collapse" data-toggle="button" class="btn btn-mini pull-right"><i class="fa fa-plus"></i></a>
					<?php endif;?>
				</h2>
			</div>
		<?php } ?>
		<div class="subCategoryDescWrap JMbox JMbox-grey text-center">
			<?php if ($this->params->get('show_cat_num_articles_cat') == 1) :?>
				<div class="subCategoryCountItem text-italic text-info">
					<?php if ($item->numitems> 1) $countText = JText::_('JM_ITEMS'); else  $countText = JText::_('JM_ITEM'); ?><?php echo $item->numitems; ?> <?php echo $countText; ?>
				</div>
			<?php endif; ?>
			<?php if ($this->params->get('show_subcat_desc_cat') == 1) :?>
				<?php if ($item->description) : ?>
					<div class="subCategoryDesc">
						<?php //echo JHtml::_('content.prepare', $item->description, '', 'com_content.categories'); ?>
						<?php echo $contentText; ?>
					</div>
				<?php endif; ?>
	        <?php endif; ?>
			<div class="subCategoryReadmore clearfix"><a class="btn btn-default" href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($item->id));?>"><?php echo JText::_('JM_K2_VIEW_ITEMS'); ?></a></div>
		</div>
		<?php /* if (count($item->getChildren()) > 0) :?>
			<div class="collapse fade" id="category-<?php echo $item->id;?>">
			<?php
			$this->items[$item->id] = $item->getChildren();
			$this->parent = $item;
			$this->maxLevelcat--;
			echo $this->loadTemplate('items');
			$this->parent = $item->getParent();
			$this->maxLevelcat++;
			?>
			</div>
		<?php
		endif; */?>
	</div>
	<?php endif; ?>
	<?php if ($d%3 == 0) echo '</div><div class="row-fluid">'; ?>
<?php endforeach; ?>
</div>
<?php endif; ?>
</div>
