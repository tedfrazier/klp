<?php
/**
 * @version		$Id: category.php 1618 2012-09-21 11:23:08Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined('_JEXEC') or die;
$cols = $this->params->get('subCatColumns');
$span = 12/$cols;

?>
<!-- Start K2 Category Layout -->
<div id="k2Container" class="default itemList itemListView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?> clearfix">
	<?php if($this->params->get('show_page_title')): ?>
	<!-- Page title -->
	<h1 class="page-title page-heading menu-page-heading componentheading <?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</h1>
	<?php endif; ?>
	<?php if($this->params->get('catFeedIcon')): ?>
	<!-- RSS feed icon -->
	<div class="k2FeedIcon clearfix">
		<a class="<?php echo (Helix::direction()=='rtl')?'left':'right'; ?> hasTip" data-original-title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>" href="<?php echo $this->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
			<i class="fa fa-rss-sign"></i>
		</a>
	</div>
	<?php endif; ?>
	<?php if(isset($this->category) || ( $this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories) )): ?>
	<!-- Blocks for current category and subcategories -->
	<div class="itemListCategoriesBlock">
		<?php if(isset($this->category) && ( $this->params->get('catImage') || $this->params->get('catTitle') || $this->params->get('catDescription') || $this->category->event->K2CategoryDisplay )): ?>
		<!-- Category block -->
		<div class="itemListCategory row-fluid clearfix">
			<?php if(isset($this->addLink)): ?>
			<!-- Item add link -->
			<span class="catItemAddLink">
				<a class="modal" rel="{handler:'iframe',size:{x:990,y:650}}" href="<?php echo $this->addLink; ?>">
					<?php echo JText::_('K2_ADD_A_NEW_ITEM_IN_THIS_CATEGORY'); ?>
				</a>
			</span>
			<?php endif; ?>
			<?php if($this->params->get('catImage') && $this->category->image): ?>
			<div class="catImage span4">
			<!-- Category image -->
				<img class="" 
					alt="<?php echo K2HelperUtilities::cleanHtml($this->category->name); ?>" 
					src="<?php echo $this->category->image; ?>" 
					style="width:<?php echo $this->params->get('catImageWidth'); ?>px; height:auto;" 
				/>
			</div>
			<?php endif; ?>
			<?php if($this->params->get('catTitle') || $this->params->get('catDescription')): ?>
			<div class="catInfo <?php if(!$this->params->get('catImage') && !$this->category->image) echo 'span12'; else echo 'span8';  ?>">
				<?php if($this->params->get('catTitle')): ?>
				<!-- Category title -->
				<h1 class="page-header page-heading"><?php echo $this->category->name; ?><?php if($this->params->get('catTitleItemCounter')) echo ' ('.$this->pagination->total.')'; ?></h1>
				<?php endif; ?>
				<?php if($this->params->get('catDescription')): ?>
				<!-- Category description -->
				<?php echo $this->category->description; ?>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<!-- K2 Plugins: K2CategoryDisplay -->
			<?php echo $this->category->event->K2CategoryDisplay; ?>
			<div class="clr"></div>
		</div>
		<?php endif; ?>
		<?php if($this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories)): ?>
		<!-- Subcategories -->
		<div class="itemListSubCategories clearfix">
			<div class="row-fluid">
			<?php foreach($this->subCategories as $key=>$subCategory): ?>
			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('subCatColumns'))==0))
				$lastContainer= ' Last';
			elseif ((($key+1)%($this->params->get('subCatColumns'))==1))
				$lastContainer=' First';
			else  
				$lastContainer=' Center';
			?>
			
			<div class="span<?php echo $span;?> row-space cols<?php echo $this->params->get('subCatColumns');?> subCategoryContainer clearfix">
				<div class="subCategoryWrap clearfix">
                    <div class="subCategory-inner">
                        <?php if($this->params->get('subCatImage') && $subCategory->image): ?>
                        <div class="subCategoryImageWrap text-center">
                        	<!-- Subcategory image -->
	                        <a class="subCategoryImage" href="<?php echo $subCategory->link; ?>">
	                            <img alt="<?php echo K2HelperUtilities::cleanHtml($subCategory->name); ?>" src="<?php echo $subCategory->image; ?>" />
	                        </a>
							<?php if($this->params->get('subCatTitle')): ?>
							<!-- Subcategory title -->
							<h2 class="CatTitle">
								<a href="<?php echo $subCategory->link; ?>">
									<?php echo $subCategory->name; ?>
								</a>
							</h2>
							<?php endif; ?>
						</div>
                        <?php endif; ?>
						<div class="subCategoryDescWrap text-center">
							<?php if($this->params->get('subCatTitleItemCounter')) { ?>
							<div class="subCategoryCountItem">
								<?php if ($subCategory->numOfItems > 1) $countText = JText::_('JM_ITEMS'); else  $countText = JText::_('JM_ITEM'); ?>
								<?php echo $subCategory->numOfItems.' '.$countText; ?>
							</div>
							<?php } ?>
	                        <?php if($this->params->get('subCatDescription')): ?>
	                        <!-- Subcategory description -->
	                        	<?php echo $subCategory->description; ?>
	                        <?php endif; ?>
                        	<!-- Subcategory more... -->
							<div class="subCategoryReadMore text-center clearfix">
		                        <a class="btn btn-readmore subCategoryMore show_more" href="<?php echo $subCategory->link; ?>">
		                            <?php echo JText::_('JM_K2_VIEW_ITEMS'); ?>
		                        </a>
							</div>
                        </div>
                    </div>
				</div>
			</div>
			<?php if(($key+1)%($this->params->get('subCatColumns'))==0): ?>
			</div><div class="row-fluid">
			<?php endif; ?>
			<?php endforeach; ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<?php if((isset($this->leading) || isset($this->primary) || isset($this->secondary) || isset($this->links)) && (count($this->leading) || count($this->primary) || count($this->secondary) || count($this->links))): ?>
	<!-- Item list -->
	<div class="itemList">
		<?php if(isset($this->leading) && count($this->leading)): ?>
		<!-- Leading items -->
		<div id="itemListLeading" class="clearfix">
			<div class="row-fluid">
			<?php foreach($this->leading as $key=>$item): ?>
			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('num_leading_columns'))==0) || count($this->leading)<$this->params->get('num_leading_columns') )
				$lastContainer= ' Last';
			elseif((($key+1)%($this->params->get('num_leading_columns'))==1))
				$lastContainer=' First';
			else $lastContainer=' Center';
			?>
			<div class="<?php echo ($key%2)?'jm-even':'jm-odd';?> span<?php echo 12/$this->params->get('num_leading_columns');?> cols<?php echo $this->params->get('num_leading_columns');?> itemContainer  row-space clearfix">
				<div class="jm-item">
                    <?php
                        // Load category_item.php by default
                        $this->item=$item;
                        echo $this->loadTemplate('item_lead');
                    ?>
                </div>
			</div>
			<?php if(($key+1)%($this->params->get('num_leading_columns'))==0): ?>
			</div><div class="row-fluid">
			<?php endif; ?>
			<?php endforeach; ?>
			</div>
		</div>
		<?php endif; ?>
		<?php if(isset($this->primary) && count($this->primary)): ?>
		<!-- Primary items -->
		<div id="itemListPrimary">
			<div class="row-fluid">
			<?php foreach($this->primary as $key=>$item): ?>
			<?php
			// Define a CSS class for the last container on each row
			if($this->params->get('num_primary_columns')==1)
				{$lastContainer ='';}
			else{
				if( (($key+1)%($this->params->get('num_primary_columns'))==0) || count($this->primary)<$this->params->get('num_primary_columns') )
					$lastContainer= ' Last';
				elseif( (($key+1)%($this->params->get('num_primary_columns'))==1))
					$lastContainer= ' First';
				else
					$lastContainer=' Center';
			}
			?>
			<div class="<?php echo ($key%2)?'jm-even':'jm-odd';?> span<?php echo 12/$this->params->get('num_primary_columns');?> cols<?php echo $this->params->get('num_primary_columns');?> itemContainer row-space clearfix">
                <div class="jm-item">
                <?php
					// Load category_item.php by default
					$this->item=$item;
					echo $this->loadTemplate('item_primary');
				?>
                </div>
			</div>
			<?php if(($key+1)%($this->params->get('num_primary_columns'))==0): ?>
			</div><div class="row-fluid">
			<?php endif; ?>
			<?php endforeach; ?>
			</div>
		</div>
		<?php endif; ?>
		<?php if(isset($this->secondary) && count($this->secondary)): ?>
		<!-- Secondary items -->
		<div id="itemListSecondary">
			<div class="row-fluid">
			<?php foreach($this->secondary as $key=>$item): ?>
			
			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('num_secondary_columns'))==0) || count($this->secondary)<$this->params->get('num_secondary_columns') )
				$lastContainer= ' itemContainerLast';
			else
				$lastContainer='';
			?>
			
			<div class="<?php echo ($key%2)?'jm-even':'jm-odd';?> span<?php echo 12/$this->params->get('num_secondary_columns');?> cols<?php echo $this->params->get('num_secondary_columns');?> itemContainer row-space clearfix">
                <div class="jm-item">
                <?php
					// Load category_item.php by default
					$this->item=$item;
					echo $this->loadTemplate('item');
				?>
                </div>
			</div>
			<?php if(($key+1)%($this->params->get('num_secondary_columns'))==0): ?>
			</div><div class="row-fluid">
			<?php endif; ?>
			<?php endforeach; ?>
			</div>
		</div>
		<?php endif; ?>
		<?php if(isset($this->links) && count($this->links)): ?>
		<!-- Link items -->
		<div id="itemListLinks">
			<h4><?php echo JText::_('K2_MORE'); ?></h4>
			<div class="catItemView group<?php echo ucfirst($this->item->itemGroup); ?><?php if($this->item->params->get('pageclass_sfx')) echo ' '.$this->item->params->get('pageclass_sfx'); ?>">
				<ul class="style-list unstyled">
				<?php foreach($this->links as $key=>$item): ?>
				<?php
				// Define a CSS class for the last container on each row
				if( (($key+1)%($this->params->get('num_links_columns'))==0) || count($this->links)<$this->params->get('num_links_columns') )
					$lastContainer= ' itemContainerLast';
				else
					$lastContainer='';
				?>
					<?php
						// Load category_item_links.php by default
						$this->item=$item;
						echo $this->loadTemplate('item_links');
					?>
				<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<?php endif; ?>
	</div>
	<!-- Pagination -->
	<?php if(count($this->pagination->getPagesLinks())): ?>
	<section class="k2Pagination pagination clearfix">
		<div class="<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>">
		<?php if($this->params->get('catPagination')) echo $this->pagination->getPagesLinks(); ?>
		</div>
		<span class="k2page counter <?php echo (Helix::direction()=='rtl')?'left':'right'; ?>">
		<?php if($this->params->get('catPaginationResults')) echo $this->pagination->getPagesCounter(); ?>
		</span>
	</section>
	<?php endif; ?>
	<?php endif; ?>
</div>
<!-- End K2 Category Layout -->
