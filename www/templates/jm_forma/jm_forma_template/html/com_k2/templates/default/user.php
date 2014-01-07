<?php
/**
 * @version		$Id: user.php 1618 2012-09-21 11:23:08Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

// Get user stuff (do not change)
$user = JFactory::getUser();

?>

<!-- Start K2 User Layout -->

<div id="k2Container" class="userView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">

	<?php if($this->params->get('show_page_title') && $this->params->get('page_title')!=$this->user->name): ?>
	<!-- Page title -->
	<div class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</div>
	<?php endif; ?>

    <?php if($this->params->get('userFeedIcon',1)): ?>
    <div class="Feed_User clearfix">
    	<!-- RSS feed icon -->
    	<div class="k2FeedIcon">
    		<a href="<?php echo $this->feed; ?>" class="<?php echo (Helix::direction()=='rtl')?'left':'right'; ?> hasTip" data-original-title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
    			<i class="fa fa-rss"></i>
    		</a>
    	</div>
    </div>
	<?php endif; ?>

	<?php if ($this->params->get('userImage') || $this->params->get('userName') || $this->params->get('userDescription') || $this->params->get('userURL') || $this->params->get('userEmail')): ?>
	<div class="itemAuthorBlock userBlock row-fluid">
	
		<?php if(isset($this->addLink) && JRequest::getInt('id')==$user->id): ?>
		<!-- Item add link -->
		<span class="userItemAddLink">
			<a class="modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo $this->addLink; ?>">
				<?php echo JText::_('K2_POST_A_NEW_ITEM'); ?>
			</a>
		</span>
		<?php endif; ?>
	
		<?php if ($this->params->get('userImage') && !empty($this->user->avatar)): ?>
        <div class="itemAuthorBlockImage span4">
		<img class="jm-itemAuthorAvatar" src="<?php echo $this->user->avatar; ?>" alt="<?php echo $this->user->name; ?>" style="width:<?php echo $this->params->get('userImageWidth'); ?>px; height:auto;" />
		</div>
        <?php endif; ?>
        <?php if ($this->params->get('userImage') && !empty($this->user->avatar)) $cls='span8'; else $cls='span12'; ?>
		<div class="itemAuthorDetails <?php echo $cls; ?>">
    		<?php if ($this->params->get('userName')): ?>
    		<h2><?php echo $this->user->name; ?></h2>
    		<?php endif; ?>
    		
    		<?php if ($this->params->get('userDescription') && trim($this->user->profile->description)): ?>
    		<div class="userDescription"><?php echo $this->user->profile->description; ?></div>
    		<?php endif; ?>
    		
    		<?php if (($this->params->get('userURL') && isset($this->user->profile->url) && $this->user->profile->url) || $this->params->get('userEmail')): ?>
    		<div class="userAdditionalInfo">
    			<?php if ($this->params->get('userURL') && isset($this->user->profile->url) && $this->user->profile->url): ?>
    			<span class="userURL">
    				<?php echo JText::_('K2_WEBSITE_URL'); ?>: <a href="<?php echo $this->user->profile->url; ?>" target="_blank" rel="me"><?php echo $this->user->profile->url; ?></a>
    			</span>
    			<?php endif; ?>

    			<?php if ($this->params->get('userEmail')): ?>
    			<span class="userEmail">
    				<?php echo JText::_('K2_EMAIL'); ?>: <?php echo JHTML::_('Email.cloak', $this->user->email); ?>
    			</span>
    			<?php endif; ?>	
    		</div>
    		<?php endif; ?>

    		<div class="clr"></div>
            <?php echo $this->user->event->K2UserDisplay; ?>
    		<div class="clr"></div>
        </div>
	</div>
	<?php endif; ?>

	<?php if(count($this->items)): ?>
	<!-- Item list -->
	<div class="userItemList">
		<?php foreach ($this->items as $key=>$item): ?>

		<!-- Start K2 Item Layout -->
		<article class="row-fluid <?php echo ($key%2)?'jm-even':'jm-odd';?> userItemView<?php if(!$item->published || ($item->publish_up != $this->nullDate && $item->publish_up > $this->now) || ($item->publish_down != $this->nullDate && $item->publish_down < $this->now)) echo ' userItemViewUnpublished'; ?><?php echo ($item->featured) ? ' userItemIsFeatured' : ''; ?>">
			<!-- Plugins: BeforeDisplay -->
			<?php echo $item->event->BeforeDisplay; ?>
			<!-- K2 Plugins: K2BeforeDisplay -->
			<?php echo $item->event->K2BeforeDisplay; ?>
            <?php if($this->params->get('userItemImage') && !empty($item->imageGeneric)): ?>
            <div class="userImageBlock span4">
                <!-- Item Image -->
                <div class="userItemImageBlock">
                  <span class="JMuserItemImage">
                    <a href="<?php echo $item->link; ?>" title="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>">
                        <img src="<?php echo $item->imageGeneric; ?>" alt="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>" style="width:<?php echo $this->params->get('itemImageGeneric'); ?>px; height:auto;" />
                    </a>
                  </span>
                </div>
            </div>
            <?php endif; ?>

            <div class="userItemInfo-Text <?php if($this->params->get('userItemImage') && !empty($item->imageGeneric)) echo 'span8'; else echo 'span12'; ?>">
                <?php if($this->params->get('userItemTitle')): ?>
				<!-- Item title -->
				<header class="entry-header">
					<h2 class="userItemTitle entry-title">
						<?php if(isset($item->editLink)): ?>
							<!-- Item edit link -->
							<span class="userItemEditLink">
								<a class="modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo $item->editLink; ?>">
									<?php echo JText::_('K2_EDIT_ITEM'); ?>
								</a>
							</span>
						<?php endif; ?>

						<?php if ($this->params->get('userItemTitleLinked') && $item->published): ?>
							<a href="<?php echo $item->link; ?>">
								<?php echo $item->title; ?>
							</a>
						<?php else: ?>
							<?php echo $item->title; ?>
						<?php endif; ?>
						<?php if(!$item->published || ($item->publish_up != $this->nullDate && $item->publish_up > $this->now) || ($item->publish_down != $this->nullDate && $item->publish_down < $this->now)): ?>
							<span>
							<sup>
								<?php echo JText::_('K2_UNPUBLISHED'); ?>
							</sup>
						</span>
						<?php endif; ?>
					</h2>
				</header>
				<?php endif; ?>
				
				<div class="entry-meta muted clearfix">
                <div class="userItemInfo">
                    <?php if($this->params->get('userItemDateCreated')): ?>
                    <!-- Date created -->
                    <span class="userItemDateCreated entry-info publish-date <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>">
                        <i class="fa fa-calendar"></i>
                        <?php echo JHTML::_('date', $item->created , JText::_('JM_K2_DATE_FORMAT_LC4')); ?>
                    </span>
                    <?php endif; ?>
                    
                    <?php if ($this->params->get('userName')): ?>
                    <?php //echo K2HelperUtilities::writtenBy($this->item->author->profile->gender); ?>
                    <span class="userItemAuthor by-author entry-info <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>">
                        <i class="fa fa-user"></i>
                        <?php echo $this->user->name; ?>
                    </span>
                    <?php endif; ?>
                    
                    <?php if($this->params->get('userItemCategory')): ?>
                        <!-- Item category name -->
                        <span class="userItemCategory itemCategory entry-info <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>">
                            <i class="fa fa-folder-open"></i>
                            <a href="<?php echo $item->category->link; ?>"><?php echo $item->category->name; ?></a>
                        </span>
                    <?php endif; ?>

                    <span class="userItemCommentsLink catItemCommentsLink  entry-info <?php echo (Helix::direction()=='rtl')?'right':'left'; ?> last">
                        <?php if(!empty($item->event->K2CommentsCounter)): ?>
                            <i class="fa fa-comments"></i>
                            <!-- K2 Plugins: K2CommentsCounter -->
                            <?php echo $item->event->K2CommentsCounter; ?>
                        <?php else: ?>
                            <i class="fa fa-comments"></i>
                            <?php if($item->numOfComments > 0): ?>
                                <a href="<?php echo $item->link; ?>#itemCommentsAnchor">
                                    <span class="itemcount"><?php echo $item->numOfComments; ?></span>
                                    <span><?php echo ($item->numOfComments>1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?></span>
                                </a>
                            <?php else: ?>
                                <a href="<?php echo $item->link; ?>#itemCommentsAnchor">
                                    <span class="itemcount"><?php echo '0 '; ?></span><span>comment</span>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </span>
                </div>
                </div>
                <div class="userItemBody">
                    <div class="userItemBody-inner">
                    <!-- Plugins: BeforeDisplayContent -->
                    <?php echo $item->event->BeforeDisplayContent; ?>

                    <!-- K2 Plugins: K2BeforeDisplayContent -->
                    <?php echo $item->event->K2BeforeDisplayContent; ?>

                    

                        <!-- Plugins: AfterDisplayTitle -->
                        <?php echo $item->event->AfterDisplayTitle; ?>

                        <!-- K2 Plugins: K2AfterDisplayTitle -->
                        <?php echo $item->event->K2AfterDisplayTitle; ?>

                    <?php if($this->params->get('userItemIntroText')): ?>
                        <!-- Item introtext -->
                        <div class="userItemIntroText">
                            <?php echo $item->introtext; ?>
                        </div>

                        <?php if ($this->params->get('userItemReadMore')): ?>
                            <!-- Item "read more..." link -->
                            <div class="userItemReadMore clearfix">
                                <a class="show_more k2ReadMore btn btn-readmore <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>" href="<?php echo $item->link; ?>">
                                    <?php echo JText::_('K2_READ_MORE'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="clr"></div>

                    <!-- Plugins: AfterDisplayContent -->
                    <?php echo $item->event->AfterDisplayContent; ?>

                    <!-- K2 Plugins: K2AfterDisplayContent -->
                    <?php echo $item->event->K2AfterDisplayContent; ?>
                    </div>
                </div>
            </div>

		  <!-- Plugins: AfterDisplay -->
		  <?php echo $item->event->AfterDisplay; ?>
		  
		  <!-- K2 Plugins: K2AfterDisplay -->
		  <?php echo $item->event->K2AfterDisplay; ?>

		</article>
		<!-- End K2 Item Layout -->
		
		<?php endforeach; ?>
	</div>

	<!-- Pagination -->
	<?php if(count($this->pagination->getPagesLinks())): ?>
	<div class="k2Pagination pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
        <span class="counter <?php echo (Helix::direction()=='rtl')?'left':'right'; ?>">
            <?php echo $this->pagination->getPagesCounter(); ?>
        </span>
	</div>
	<?php endif; ?>
	
	<?php endif; ?>

</div>

<!-- End K2 User Layout -->
