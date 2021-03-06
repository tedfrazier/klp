<?php
/**
 * @version		$Id: item.php 1766 2012-11-22 14:10:24Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

?>
<?php if(JRequest::getInt('print')==1): ?>
<!-- Print button at the top of the print page only -->
<a class="itemPrintThisPage" rel="nofollow" href="#" onclick="window.print();return false;">
	<span><?php echo JText::_('K2_PRINT_THIS_PAGE'); ?></span>
</a>
<?php endif; ?>

<!-- Start K2 Item Layout -->
<span id="startOfPageId<?php echo JRequest::getInt('id'); ?>"></span>

<article id="k2Container" class="Portfolio itemView<?php echo ($this->item->featured) ? ' itemIsFeatured' : ''; ?> <?php if($this->item->params->get('pageclass_sfx')) echo ' '.$this->item->params->get('pageclass_sfx'); ?> clearfix">
	<!-- Plugins: BeforeDisplay -->
	<?php echo $this->item->event->BeforeDisplay; ?>
	<!-- K2 Plugins: K2BeforeDisplay -->
	<?php echo $this->item->event->K2BeforeDisplay; ?>
	<?php if(
			$this->item->params->get('itemTitle') ||
			$this->item->params->get('itemFontResizer') ||
			$this->item->params->get('itemPrintButton') ||
			$this->item->params->get('itemEmailButton') ||
			$this->item->params->get('itemSocialButton') ||
			$this->item->params->get('itemVideoAnchor') ||
			$this->item->params->get('itemImageGalleryAnchor')
	): ?>
	<header class="itemHeader entry-title clearfix">
		<?php if($this->item->params->get('itemTitle')): ?>
		<!-- Item title -->
		<h2 class="itemTitle row-fluid clearfix">
			<?php if(isset($this->item->editLink)): ?>
				<!-- Item edit link -->
				<span class="itemEditLink">
					<a class="modal hasTip" data-original-title="<?php echo JText::_('K2_EDIT_ITEM'); ?>" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo $this->item->editLink; ?>">
						<i class="fa fa-edit"></i>
					</a>
				</span>
			<?php endif; ?>

			<span class="item-title"><?php echo $this->item->title; ?></span>

			<?php if($this->item->params->get('itemFeaturedNotice') && $this->item->featured): ?>
			<!-- Featured flag -->
			<span>
				<sup>
					<?php echo JText::_('K2_FEATURED'); ?>
				</sup>
			</span>
			<?php endif; ?>
		
			<?php if(
			$this->item->params->get('itemFontResizer') ||
			$this->item->params->get('itemPrintButton') ||
			$this->item->params->get('itemEmailButton') ||
			$this->item->params->get('itemSocialButton') ||
			$this->item->params->get('itemVideoAnchor') ||
			$this->item->params->get('itemImageGalleryAnchor')
			): ?>
			<span class="itemToolbar  <?php echo (Helix::direction()=='rtl')?'left':'right'; ?>">
				<?php if($this->item->params->get('itemFontResizer')): ?>
				<!-- Font Resizer -->
				<a href="#" id="fontDecrease" class="hasTip <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>" data-original-title="<?php echo JText::_('K2_DECREASE_FONT_SIZE'); ?>" title="<?php echo JText::_('K2_DECREASE_FONT_SIZE'); ?>">
					<i class="fa fa-minus-sign"></i>
				</a>
				<a href="#" id="fontIncrease" class="hasTip <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>" data-original-title="<?php echo JText::_('K2_INCREASE_FONT_SIZE'); ?>" title="<?php echo JText::_('K2_INCREASE_FONT_SIZE'); ?>">
					<i class="fa fa-plus-sign"></i>
				</a>
				<?php endif; ?>

				<?php if($this->item->params->get('itemPrintButton') && !JRequest::getInt('print')): ?>
				<!-- Print Button -->
				<a title="<?php echo JText::_('K2_PRINT'); ?>" class="itemPrintLink hasTip <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>" data-original-title="<?php echo JText::_('K2_PRINT'); ?>" rel="nofollow" href="<?php echo $this->item->printLink; ?>" onclick="window.open(this.href,'printWindow','width=900,height=600,location=no,menubar=no,resizable=yes,scrollbars=yes'); return false;">
					<i class="fa fa-print"></i>
				</a>
				<?php endif; ?>

				<?php if($this->item->params->get('itemEmailButton') && !JRequest::getInt('print')): ?>
				<!-- Email Button -->
				<a title="<?php echo JText::_('K2_EMAIL'); ?>" class="itemEmailLink hasTip <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>" data-original-title="<?php echo JText::_('K2_EMAIL'); ?>" rel="nofollow" href="<?php echo $this->item->emailLink; ?>" onclick="window.open(this.href,'emailWindow','width=400,height=350,location=no,menubar=no,resizable=no,scrollbars=no'); return false;">
					<i class="fa fa-envelope"></i>
				</a>
				<?php endif; ?>

				<?php if($this->item->params->get('itemVideoAnchor') && !empty($this->item->video)): ?>
				<!-- Anchor link to item video below - if it exists -->
				<a title="<?php echo JText::_('K2_MEDIA'); ?>" class="itemVideoLink k2Anchor hasTip <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>" data-original-title="<?php echo JText::_('K2_MEDIA'); ?>" href="<?php echo $this->item->link; ?>#itemVideoAnchor">
					<i class="fa fa-facetime-video"></i>
				</a>
				<?php endif; ?>

				<?php if($this->item->params->get('itemImageGalleryAnchor') && !empty($this->item->gallery)): ?>
				<!-- Anchor link to item image gallery below - if it exists -->
				<a title="<?php echo JText::_('K2_IMAGE_GALLERY'); ?>" class="itemImageGalleryLink k2Anchor hasTip <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>" data-original-title="<?php echo JText::_('K2_IMAGE_GALLERY'); ?>" href="<?php echo $this->item->link; ?>#itemImageGalleryAnchor">
					<i class="fa fa-th-large"></i>
				</a>
				<?php endif; ?>
				
				<?php if($this->item->params->get('itemSocialButton') && !is_null($this->item->params->get('socialButtonCode', NULL))): ?>
					<!-- Item Social Button -->
					<?php echo $this->item->params->get('socialButtonCode'); ?>
				<?php endif; ?>
			</span>
			<?php endif; ?> 
		</h2>
		<?php endif; ?> 
	</header>
	<?php endif; ?>
	<?php if(
			$this->item->params->get('itemDateCreated') || 
			$this->item->params->get('itemAuthor')      ||
			$this->item->params->get('itemCategory')    ||
			$this->item->params->get('itemCommentsAnchor')		
	): ?>
	<div class="item-info entry-meta muted clearfix">
		<!-- Date created -->
		<?php if($this->item->params->get('itemDateCreated')): ?>
		<span class="entry-info itemCreatedDate <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>">
			<i class="fa fa-calendar <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>"></i><?php echo JHTML::_('date', $this->item->created , JText::_('jS M')); ?>
		</span>
		<?php endif; ?>
		<?php if($this->item->params->get('itemAuthor')): ?>
		<!-- Item Author -->
		<span class="entry-info itemAuthor <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>">
			<i class="fa fa-user <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>"></i>
			<?php if(empty($this->item->created_by_alias)): ?>
				<a rel="author" href="<?php echo $this->item->author->link; ?>"><?php echo $this->item->author->name; ?></a>
			<?php else: ?>
				<?php echo $this->item->author->name; ?>
			<?php endif; ?>
		</span>
		<?php endif; ?>
		
		<?php if($this->item->params->get('itemCategory')): ?>
		<!-- Item category -->
		<span class="entry-info itemCategory <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>">
			<i class="fa fa-folder <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>"></i>
			<a href="<?php echo $this->item->category->link; ?>"><?php echo $this->item->category->name; ?></a>
		</span>
		<?php endif; ?>
		
		<?php if($this->item->params->get('itemCommentsAnchor') && $this->item->params->get('itemComments') && ( ($this->item->params->get('comments') == '2' && !$this->user->guest) || ($this->item->params->get('comments') == '1')) ): ?>
		<span class="entry-info itemCategory <?php echo (Helix::direction()=='rtl')?'right':'left'; ?> last hasTip" data-original-title="Comments">	
			<!-- Anchor link to comments below - if enabled -->
			<i class="fa fa-comment"></i>
			<?php if($this->item->numOfComments > 0): ?>
			<a class="itemCommentsLink k2Anchor" href="<?php echo $this->item->link; ?>#itemCommentsAnchor">
				<span><?php echo $this->item->numOfComments; ?></span> 
			</a>
			<?php else: ?>
			<a class="itemCommentsLink k2Anchor" href="<?php echo $this->item->link; ?>#itemCommentsAnchor">
				<?php echo JText::_('0'); ?>
			</a>
			<?php endif; ?>
		</span>
		<?php endif; ?> 
	</div>
	<?php endif; ?>
	<!-- Plugins: AfterDisplayTitle -->
	<?php echo $this->item->event->AfterDisplayTitle; ?>
	<!-- K2 Plugins: K2AfterDisplayTitle -->
	<?php echo $this->item->event->K2AfterDisplayTitle; ?>
	<content class="itemContent entry-content row-fluid clearfix">
		<!-- Plugins: BeforeDisplayContent -->
		<?php echo $this->item->event->BeforeDisplayContent; ?>
		<!-- K2 Plugins: K2BeforeDisplayContent -->
		<?php echo $this->item->event->K2BeforeDisplayContent; ?>
		
		<?php if(!empty($this->item->image) || !empty($this->item->gallery)): ?>
		<div class="itemImageBlock span8">
			<?php if($this->item->params->get('itemImageGallery') && !empty($this->item->gallery)): ?>
				<!-- Item image gallery -->
				<div class="itemImageGallery">
					<a name="itemImageGalleryAnchor" id="itemImageGalleryAnchor"></a>
					<?php echo $this->item->gallery; ?>
				</div>
			<?php else: ?>
				<!-- Item Image -->
				<span class="itemImage">
				<a class="modal" rel="{handler: 'image'}" href="<?php echo $this->item->imageXLarge; ?>" title="<?php echo JText::_('K2_CLICK_TO_PREVIEW_IMAGE'); ?>">
					<img src="<?php echo $this->item->image; ?>" alt="<?php if(!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption); else echo K2HelperUtilities::cleanHtml($this->item->title); ?>" style="width:<?php echo $this->item->imageWidth; ?>px; height:auto;" />
				</a>
				</span>
				<?php if($this->item->params->get('itemImageMainCaption') && !empty($this->item->image_caption)): ?>
				<!-- Image caption -->
				<span class="itemImageCaption"><?php echo $this->item->image_caption; ?></span>
				<?php endif; ?>

				<?php if($this->item->params->get('itemImageMainCredits') && !empty($this->item->image_credits)): ?>
				<!-- Image credits -->
				<span class="itemImageCredits"><?php echo $this->item->image_credits; ?></span>
				<?php endif; ?> 
			<?php endif; ?> 
		</div>
		<?php endif; ?>
		
		<div class="itemContentBlock <?php if(!empty($this->item->image) || !empty($this->item->gallery)) echo 'span4'; else echo 'span12'; ?>">		
			<?php if(!empty($this->item->fulltext)): ?>
			<div class="module">
				<h3 class="header"><span class="title"><?php echo JText::_('JM_K2_ABOUT_PROJECT'); ?></span></h3>
				<?php if($this->item->params->get('itemIntroText')): ?>
					<!-- Item introtext -->
					<div class="itemIntroText">	
						<?php echo $this->item->introtext; ?>
					</div>
				<?php endif; ?>
				<?php if($this->item->params->get('itemFullText')): ?>
					<div class="itemFullText">
						<?php echo $this->item->fulltext; ?>
					</div>
				<?php endif; ?>
			</div>
			<?php else: ?>
			<div class="module">
				<h3 class="header"><span class="title"><?php echo JText::_('JM_K2_ABOUT_PROJECT'); ?></span></h3>
				<!-- Item text -->
				<div class="itemFullText">
					<?php echo $this->item->introtext; ?>
				</div>
			</div>
			<?php endif; ?>
		
			<?php if($this->item->params->get('itemExtraFields') && count($this->item->extra_fields)): ?>
			<!-- Item extra fields -->
			<div class="itemExtraFields module clearfix">
				<h3 class="header"><span class="title"><?php echo JText::_('JM_K2_ADDITIONAL_INFO'); ?></span></h3>
				<ul class="unstyled">
					<?php foreach ($this->item->extra_fields as $key=>$extraField): ?>
						<?php if($extraField->value != ''): ?>
						<li class="<?php echo ($key%2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
							<?php if($extraField->type == 'header'): ?>
								<a class="itemExtraFieldsHeader clearfix"><?php echo $extraField->name; ?></a>
							<?php elseif($extraField->type == 'link'): ?>
								
							<?php else: ?>
								<a class="itemExtraFieldsLabel clearfix"><?php echo $extraField->name; ?></a>
							<?php endif; ?>
							
							<?php if($extraField->type == 'multipleSelect'): 
							
								$value = explode(', ', $extraField->value);
								$str = $extraField->value;
								$chars=str_split($str);
								$count=0;
								foreach($chars as &$char){ if ($char==','){$count++;}}
								echo '<ul class="style-list unstyled check-sign">';
										for($i=0; $i <= $count; $i++) echo '<li>'.$value[$i].'</li>';
								echo '</ul>';
							?>
							<?php elseif($extraField->type == 'link'): ?>
							  <span class="itemExtraFieldsValue btn btn-readmore"><?php echo $extraField->value; ?></span>
							<?php elseif($extraField->type != 'date'): ?>
							  <span class="itemExtraFieldsValue"><?php echo $extraField->value; ?></span>
							<?php else: ?>
							  <span class="itemExtraFieldsValue"><?php echo JHTML::_('date', $extraField->value , JText::_('d F Y')); ?></span>
							<?php endif; ?>
						</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
		</div>
	</content>
	<?php if(
		$this->item->params->get('itemHits') || 
		$this->item->params->get('itemDateModified') ||
		$this->item->params->get('itemCategory') ||
		$this->item->params->get('itemRating') ||
		$this->item->params->get('itemTags') 
	): ?>
	<footer class="itemFooter clearfix">
		<?php if($this->item->params->get('itemHits') || ($this->item->params->get('itemDateModified') && intval($this->item->modified)!=0)): ?>
		<div class="itemUpdate row-fluid clearfix">
			<?php if($this->item->params->get('itemHits')): ?>
			<!-- Item Hits -->
			<time class="itemHits info-title <?php if($this->item->params->get('itemDateModified') && intval($this->item->modified)!=0) echo 'span6'; else echo 'span12'; ?>">
				<span class="<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>">
					<i class="fa fa-book" style="margin-<?php echo (Helix::direction()=='rtl')?'left':'right'; ?>:15px;"></i>
					<?php echo JText::_('K2_READ'); ?> <?php echo $this->item->hits; ?> <?php echo JText::_('K2_TIMES'); ?>
				</span>
			</time>
			<?php endif; ?>

			<?php if($this->item->params->get('itemDateModified') && intval($this->item->modified)!=0): ?>
			<!-- Item date modified -->
			<time class="itemDateModified info-title <?php if($this->item->params->get('itemHits')) echo 'span6'; else echo 'span12'; ?>">
				<span class="<?php echo (Helix::direction()=='rtl')?'left':'right'; ?>">
					<i class="fa fa-refresh" style="margin-<?php echo (Helix::direction()=='rtl')?'left':'right'; ?>:15px;"></i><?php echo JText::_('JM_K2_LAST_MODIFIED_ON'); ?> <?php echo JHTML::_('date', $this->item->modified, JText::_('JM_K2_DATE_FORMAT_LC4')); ?>
				</span>
			</time>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<?php if($this->item->params->get('itemCategory')): ?>
		<!-- Item category -->
		<div class="itemCategory clearfix">
			<div class="itemCategory-Inner info-title">
			  <i class="fa fa-align-justify" style="margin-<?php echo (Helix::direction()=='rtl')?'left':'right'; ?>:15px;"></i>
			  <span class=""><?php echo JText::_('K2_PUBLISHED_IN'); ?></span>
			  <a href="<?php echo $this->item->category->link; ?>"><?php echo $this->item->category->name; ?></a>
			</div>
		</div>
		<?php endif; ?>
		<?php  if($this->item->params->get('itemRating')): ?>
		<!-- Item Rating -->
		<div class="itemRatingBlock clearfix">
			<div class="rate-header info-title <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>">
				<i class="fa fa-star" style="margin-<?php echo (Helix::direction()=='rtl')?'left':'right'; ?>:15px;"></i>
				<span><?php echo JText::_('K2_RATE_THIS_ITEM'); ?></span>
			</div>
			<div class="itemRatingForm" style="padding-<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>:130px;">
				<ul class="itemRatingList <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>">
					<li class="itemCurrentRating" id="itemCurrentRating<?php echo $this->item->id; ?>" style="width:<?php echo $this->item->votingPercentage; ?>%;<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>:0;"></li>
					<li><a href="#" rel="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_1_STAR_OUT_OF_5'); ?>" class="one-star" style="<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>:0;">1</a></li>
					<li><a href="#" rel="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_2_STARS_OUT_OF_5'); ?>" class="two-stars" style="<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>:0;">2</a></li>
					<li><a href="#" rel="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_3_STARS_OUT_OF_5'); ?>" class="three-stars" style="<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>:0;">3</a></li>
					<li><a href="#" rel="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_4_STARS_OUT_OF_5'); ?>" class="four-stars" style="<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>:0;">4</a></li>
					<li><a href="#" rel="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_5_STARS_OUT_OF_5'); ?>" class="five-stars" style="<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>:0;">5</a></li>
				</ul>
				<div id="itemRatingLog<?php echo $this->item->id; ?>" class="itemRatingLog"><?php echo $this->item->numOfvotes; ?></div>
			</div>
		</div>
		<?php endif; ?>			
		<?php if($this->item->params->get('itemTags') && count($this->item->tags)): ?>
		<!-- Item tags -->
		<div class="itemTagsBlock clearfix">
			<div class="itemTagsBlock-Inner Inner module">
				<div class="tags-header info-title <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>">
					<i class="fa fa-tags" style="margin-<?php echo (Helix::direction()=='rtl')?'left':'right'; ?>:15px;"></i>
					<span class=""><?php echo JText::_('K2_TAGGED_UNDER'); ?></span>
				</div>
				<div class="style-tags" style="padding-<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>:130px;">
					<?php foreach ($this->item->tags as $tag): ?>
					<a class="<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>" href="<?php echo $tag->link; ?>">
					<?php echo $tag->name; ?>
					</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</footer>
	<?php endif; ?>
	
	<?php if($this->item->params->get('itemTwitterButton',1) || $this->item->params->get('itemFacebookButton',1) || $this->item->params->get('itemGooglePlusOneButton',1)): ?>
	<!-- Social sharing -->
	<div class="itemSocialSharing clearfix">
		<?php if($this->item->params->get('itemTwitterButton',1)): ?>
		<!-- Twitter Button -->
		<div class="itemTwitterButton">
			<a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal"<?php if($this->item->params->get('twitterUsername')): ?> data-via="<?php echo $this->item->params->get('twitterUsername'); ?>"<?php endif; ?>><?php echo JText::_('K2_TWEET'); ?></a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
		</div>
		<?php endif; ?>

		<?php if($this->item->params->get('itemFacebookButton',1)): ?>
		<!-- Facebook Button -->
		<div class="itemFacebookButton">
			<div id="fb-root"></div>
			<script type="text/javascript">
				(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) {return;}
					js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/en_US/all.js#appId=177111755694317&xfbml=1";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script>
			<div class="fb-like" data-send="false" data-width="200" data-show-faces="true"></div>
		</div>
		<?php endif; ?>

		<?php if($this->item->params->get('itemGooglePlusOneButton',1)): ?>
		<!-- Google +1 Button -->
		<div class="itemGooglePlusOneButton">
			<g:plusone annotation="inline" width="120"></g:plusone>
			<script type="text/javascript">
				(function() {
					window.___gcfg = {lang: 'en'}; // Define button default language here
					var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
					po.src = 'https://apis.google.com/js/plusone.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				})();
			</script>
		</div>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<?php if($this->item->params->get('itemAttachments') && count($this->item->attachments)):?>
	<div class="itemExtraInfo">
		<?php if($this->item->params->get('itemAttachments') && count($this->item->attachments)): ?>
		<!-- Item attachments -->
		<div class="itemAttachmentsBlock clearfix">
			<span><?php echo JText::_('K2_DOWNLOAD_ATTACHMENTS'); ?></span>
			<ul class="itemAttachments unstyled style-list">
				<?php foreach ($this->item->attachments as $attachment): ?>
				<li>
					<a title="<?php echo K2HelperUtilities::cleanHtml($attachment->titleAttribute); ?>" href="<?php echo $attachment->link; ?>">
					<i class="fa fa-file <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>" style="margin-<?php echo (Helix::direction()=='rtl')?'left':'right'; ?>:15px;"></i>
					<?php echo $attachment->title; ?>
					</a>
					<?php if($this->item->params->get('itemAttachmentsCounter')): ?>
						<span>(<?php echo $attachment->hits; ?> <?php echo ($attachment->hits==1) ? JText::_('K2_DOWNLOAD') : JText::_('K2_DOWNLOADS'); ?>)</span>
					<?php endif; ?>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
	</div>
	<?php endif; ?>	 
	<!-- Plugins: AfterDisplayContent -->
	<?php echo $this->item->event->AfterDisplayContent; ?>
	<!-- K2 Plugins: K2AfterDisplayContent -->
	<?php echo $this->item->event->K2AfterDisplayContent; ?>


	<?php if($this->item->params->get('itemAuthorBlock') && empty($this->item->created_by_alias)): ?>
	<!-- Author Block -->
	<div class="itemAuthorBlock clearfix">
		<div class="itemAuthorBlock-Info row-fluid clearfix ">
			<?php if($this->item->params->get('itemAuthorImage') && !empty($this->item->author->avatar)): ?>
			<div class="itemAuthorAvatarWrap span4">
				<img class="jm-itemAuthorAvatar" src="<?php echo $this->item->author->avatar; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($this->item->author->name); ?>" />
			</div>
			<?php endif; ?>

			<div class="itemAuthorDetails <?php if(!$this->item->params->get('itemAuthorImage') && empty($this->item->author->avatar)) echo 'span12'; else echo 'span8' ?>">
				<?php if($this->item->params->get('itemAuthorDescription')) :?>
				<h2 class="itemAuthorName entry-title">
					<a rel="author" href="<?php echo $this->item->author->link; ?>"><?php echo $this->item->author->name; ?></a>
				</h2>
				<?php endif; ?>
				<?php if($this->item->params->get('itemAuthorDescription') && !empty($this->item->author->profile->description)): ?>
					<?php echo $this->item->author->profile->description; ?>
				<?php endif; ?>

				<?php if($this->item->params->get('itemAuthorURL') && !empty($this->item->author->profile->url)): ?>
				<span class="itemAuthorUrl <?php echo (Helix::direction()=='rtl')?'right':'left'; ?> clearfix">
				<span class="title-info"><?php echo JText::_('K2_WEBSITE'); ?></span>
				<a rel="me" href="<?php echo $this->item->author->profile->url; ?>" target="_blank"><?php echo str_replace('http://','',$this->item->author->profile->url); ?></a></span>
				<?php endif; ?>

				<?php if($this->item->params->get('itemAuthorEmail')): ?>
				<span class="itemAuthorEmail <?php echo (Helix::direction()=='rtl')?'right':'left'; ?> clearfix">
				<span class="title-info"><?php echo JText::_('K2_EMAIL'); ?></span>
				<?php echo JHTML::_('Email.cloak', $this->item->author->email); ?>
				</span>
				<?php endif; ?>
				<!-- K2 Plugins: K2UserDisplay -->
				<?php echo $this->item->event->K2UserDisplay; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
		

	<?php if($this->item->params->get('itemAuthorLatest') && empty($this->item->created_by_alias) && isset($this->authorLatestItems)): ?>
	<!-- Latest items from author -->
	<div class="itemAuthorLatest <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>">
		<h3 class="entry-title"><?php echo JText::_('K2_LATEST_FROM'); ?> <?php echo $this->item->author->name; ?></h3>
		<ul class="unstyled">
			<?php foreach($this->authorLatestItems as $key=>$item): ?>
			<li class="clearfix">
				<a href="<?php echo $item->link ?>">
				<i class="fa fa-angle-<?php echo (Helix::direction()=='rtl')?'left':'right'; ?>" style="margin-<?php echo (Helix::direction()=='rtl')?'left':'right'; ?>:10px;"></i>
				<?php echo $item->title; ?>
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	
	<?php if($this->item->params->get('itemRelated') && isset($this->relatedItems)): ?>
	<!-- Related items by tag -->
	<div class="itemAuthorRelated">
		<?php include 'item_related.php';?>
	</div>
	<?php endif; ?>

	<?php if($this->item->params->get('itemVideo') && !empty($this->item->video)): ?>
	
		<!-- Item video -->
		<div class="itemVideoBlock module title-line span12">
			<a name="itemVideoAnchor" id="itemVideoAnchor"></a>
			<h3 class="header entry-title"><span><?php echo JText::_('K2_MEDIA'); ?></span></h3>
			<?php if($this->item->videoType=='embedded'): ?>
			<div class="itemVideoEmbedded">
				<?php echo $this->item->video; ?>
			</div>
			<?php else: ?>
				<span class="itemVideo"><?php echo $this->item->video; ?></span>
			<?php endif; ?>

			<?php if($this->item->params->get('itemVideoCaption') && !empty($this->item->video_caption)): ?>
			<span class="itemVideoCaption"><?php echo $this->item->video_caption; ?></span>
			<?php endif; ?>

			<?php if($this->item->params->get('itemVideoCredits') && !empty($this->item->video_credits)): ?>
			<span class="itemVideoCredits"><?php echo $this->item->video_credits; ?></span>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	
	<?php if($this->item->params->get('itemNavigation') && !JRequest::getCmd('print') && (isset($this->item->nextLink) || isset($this->item->previousLink))): ?>
	<!-- Item navigation -->
	<div class="itemNavigation">
		<span class="itemNavigationTitle info-title"><?php echo JText::_('K2_MORE_IN_THIS_CATEGORY'); ?></span>
		<?php if(isset($this->item->previousLink)): ?>
		<a class="itemPrevious" href="<?php echo $this->item->previousLink; ?>">
			<i class="fa fa-angle-left"></i> <?php echo $this->item->previousTitle; ?>
		</a>
		<?php endif; ?>

		<?php if(isset($this->item->nextLink)): ?>
		<a class="itemNext" href="<?php echo $this->item->nextLink; ?>">
			<?php echo $this->item->nextTitle; ?> <i class="fa fa-angle-right"></i>
		</a>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<!-- Plugins: AfterDisplay -->
	<?php echo $this->item->event->AfterDisplay; ?>
	<!-- K2 Plugins: K2AfterDisplay -->
	<?php echo $this->item->event->K2AfterDisplay; ?>

	<?php if(JRequest::getCmd('print')): ?>
	<div class="itemBackToTop clearfix">
		<a class="k2Anchor <?php echo (Helix::direction()=='rtl')?'left':'right'; ?> hasTip" data-original-title="<?php echo JText::_('K2_BACK_TO_TOP'); ?>" href="<?php echo $this->item->link; ?>#startOfPageId<?php echo JRequest::getInt('id'); ?>">
			<i class="fa fa-circle-arrow-up"></i>
		</a>
	</div>
	<?php endif; ?>
</article>
<!-- End K2 Item Layout -->
