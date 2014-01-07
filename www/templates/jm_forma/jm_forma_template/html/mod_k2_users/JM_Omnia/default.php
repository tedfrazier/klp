<?php
/**
 * @version		$Id: default.php 1812 2013-01-14 18:45:06Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2013 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

?>

<div id="k2ModuleBox<?php echo $module->id; ?>" class="k2UsersBlock<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">
	<ul class="unstyled row-fluid">
		<?php foreach($users as $key=>$user): ?>
		<li class="span4">

			<?php if($userAvatar && !empty($user->avatar)): ?>
			<div class="k2UsersAvatarWrap">
			<!-- <a class="ubUserAvatar" rel="author" href="<?php echo $user->link; ?>" title="<?php echo K2HelperUtilities::cleanHtml($user->name); ?>"> -->
				<img src="<?php echo $user->avatar; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($user->name); ?>" style="width:<?php echo $avatarWidth; ?>px;height:auto;" />
			<!-- </a> -->
			</div>
			<?php endif; ?>
			<?php 
				$userinfo = explode('|',$user->description); 
				$usernotes = $user->notes;
			?>
			<?php if($userName): ?>
			<div class="k2UsersNameWrap row-fluid clearfix">
				<div class="k2UsersName <?php if($usernotes!='') echo 'span8 left'; else echo 'span12'; ?>">
					<!-- <a class="ubUserName" rel="author" href="<?php echo $user->link; ?>" title="<?php echo K2HelperUtilities::cleanHtml($user->name); ?>"> -->
						<h1 class="title header"><?php echo $user->name; ?></h1>
					<!-- </a> -->
				</div>
				<?php if($usernotes!='') :?>
				<div class="k2UsersType span4 right text-right">
					<?php echo $usernotes; ?>
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<?php if($userDescription && $user->description): ?>
			<div class="ubUserDescription clearfix">
				<?php if($userDescriptionWordLimit): ?>
				<?php echo K2HelperUtilities::wordLimit($user->description, $userDescriptionWordLimit) ?>
				<?php else: ?>
				<?php echo $userinfo[0]; ?>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<?php if($userFeed || ($userURL && $user->url) || $userEmail || ($userinfo !='')): ?>
			<div class="ubUserAdditionalInfoWrap row-fluid clearfix">
				<?php if($userinfo[1] !='') : ?>
				<div class="k2UsersSocialLinks <?php if($userFeed || ($userURL && $user->url) || $userEmail) echo 'span8 left text-left'; else echo 'span12'; ?>">
					<?php echo strip_tags($userinfo[1],'<a>,<span>,<i>'); ?>
				</div>
				<?php endif; ?>
				<?php if($userFeed || ($userURL && $user->url) || $userEmail): ?>
				<div class="ubUserAdditionalInfo text-right <?php if($userinfo[1] !='') echo 'span4 right text-right'; else echo 'span12';?>">

					<?php if($userFeed): ?>
					<!-- RSS feed icon -->
					<a class="ubUserFeedIcon" href="<?php echo $user->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_USERS_RSS_FEED'); ?>">
						<span><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_USERS_RSS_FEED'); ?></span>
					</a>
					<?php endif; ?>

					<?php if($userURL && $user->url): ?>
					<a class="ubUserURL" rel="me" href="<?php echo $user->url; ?>" title="<?php echo JText::_('K2_WEBSITE'); ?>" target="_blank">
						<span><?php echo JText::_('K2_WEBSITE'); ?></span>
					</a>
					<?php endif; ?>

					<?php if($userEmail): ?>
					<span class="ubUserEmail" title="<?php echo JText::_('K2_EMAIL'); ?>">
						<?php echo JHTML::_('Email.cloak', $user->email); ?>
					</span>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<?php if($userItemCount && count($user->items)): ?>
			<h3><?php echo JText::_('K2_RECENT_ITEMS'); ?></h3>
			<ul class="ubUserItems">
				<?php foreach ($user->items as $item): ?>
				<li>
					<a href="<?php echo $item->link; ?>" title="<?php echo K2HelperUtilities::cleanHtml($item->title); ?>">
						<?php echo $item->title; ?>
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>

			<div class="clr"></div>
		</li>
		<?php endforeach; ?>
	</ul>
</div>
