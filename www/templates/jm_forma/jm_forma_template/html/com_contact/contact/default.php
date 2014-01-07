<?php
 /**
 * @package		Joomla.Site
 * @subpackage	com_contact
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$cparams = JComponentHelper::getParams ('com_media');
?>
<div class="contactDtailsWrap contact <?php echo $this->pageclass_sfx?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
	<header class="entry-header">
		<hgroup class="page-header">
			<h1 class="entry-title">
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h1>
		</hgroup>
	</header>
	<?php endif; ?>
	<?php if ($this->contact->name && $this->params->get('show_name')) : ?>
	<header class="entry-header">
		<h3 class="jm-component-heading entry-title">
			<span class="contact-name"><?php echo $this->contact->name; ?></span>
		</h3>
	</header>
	<?php endif;  ?>
	<?php if ($this->params->get('show_contact_category') == 'show_no_link') : ?>
		<h4>
			<span class="contact-category"><?php echo $this->contact->category_title; ?></span>
		</h4>
	<?php endif; ?>
	<?php if ($this->params->get('show_contact_category') == 'show_with_link') : ?>
		<?php $contactLink = ContactHelperRoute::getCategoryRoute($this->contact->catid);?>
		<h4>
			<span class="contact-category"><a href="<?php echo $contactLink; ?>">
				<?php echo $this->escape($this->contact->category_title); ?></a>
			</span>
		</h4>
	<?php endif; ?>
    
    <article class="row-fluid clearfix">
		<div class="span4 contact-left">
		<?php if ($this->params->get('show_contact_list') && count($this->contacts) > 1) : ?>
			<form action="#" method="get" name="selectForm" id="selectForm">
				<?php echo JText::_('COM_CONTACT_SELECT_CONTACT'); ?>
				<?php echo JHtml::_('select.genericlist',  $this->contacts, 'id', 'class="inputbox" onchange="document.location.href = this.value"', 'link', 'name', $this->contact->link);?>
			</form>
		<?php endif; ?>
		<?php  if ($this->params->get('presentation_style')!='plain'){?>
			<?php  echo  JHtml::_($this->params->get('presentation_style').'.start', 'contact-slider'); ?>
		<?php  echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('COM_CONTACT_DETAILS'), 'basic-details'); } ?>
		<?php if ($this->params->get('presentation_style')=='plain'):?>
		<header class="entry-header">
			<?php  echo '<h3 class="entry-title">'. JText::_('JM_CONTACT_INFO').'</h3>';  ?>
		</header>
		<?php endif; ?>
		<?php if ($this->contact->image && $this->params->get('show_image')) : ?>
			<div class="contact-image">
				<?php echo JHtml::_('image', $this->contact->image, JText::_('COM_CONTACT_IMAGE_DETAILS'), array('align' => 'middle')); ?>
			</div>
		<?php endif; ?>
	    
		<?php if ($this->contact->con_position && $this->params->get('show_position')) : ?>
			<p class="contact-position"><?php echo $this->contact->con_position; ?></p>
		<?php endif; ?>

		<?php echo $this->loadTemplate('address'); ?>

		<?php if ($this->params->get('allow_vcard')) :	?>
			<?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS');?>
				<a href="<?php echo JRoute::_('index.php?option=com_contact&amp;view=contact&amp;id='.$this->contact->id . '&amp;format=vcf'); ?>">
				<?php echo JText::_('COM_CONTACT_VCARD');?></a>
		<?php endif; ?>
	    
	    <?php if ($this->params->get('show_links')) : ?>
			<?php echo $this->loadTemplate('links'); ?>
		<?php endif; ?>
		<?php if ($this->params->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
			<?php if ($this->params->get('presentation_style')!='plain'):?>
			<?php echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('JGLOBAL_ARTICLES'), 'display-articles'); ?>
			<?php endif; ?>
			<?php echo $this->loadTemplate('articles'); ?>
		<?php endif; ?>
		<?php if ($this->params->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
			<?php if ($this->params->get('presentation_style')!='plain'):?>
				<?php echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('COM_CONTACT_PROFILE'), 'display-profile'); ?>
			<?php endif; ?>
			<?php if ($this->params->get('presentation_style')=='plain'):?>
				<?php echo '<h4>'. JText::_('COM_CONTACT_PROFILE').'</h4>'; ?>
			<?php endif; ?>
			<?php echo $this->loadTemplate('profile'); ?>
		<?php endif; ?>
		</div>
	    <div class="span8 contact-right">
		<header class="entry-header">
			<?php  echo '<h3 class="entry-title">'. JText::_('JM_GET_IN_TOUCH').'</h3>';  ?>
		</header>
		<?php if ($this->contact->misc && $this->params->get('show_misc')) : ?>
			<?php if ($this->params->get('presentation_style')!='plain'){?>
				<?php echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('COM_CONTACT_OTHER_INFORMATION'), 'display-misc');} ?>
				<div class="contact-misc">
					<?php echo $this->contact->misc; ?>
				</div>
			<?php endif; ?>

		
		<?php if ($this->params->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>

			<?php if ($this->params->get('presentation_style')!='plain'):?>
				<?php  echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('COM_CONTACT_EMAIL_FORM'), 'display-form');  ?>
			<?php endif; ?>
			<?php if ($this->params->get('presentation_style')=='plain'):?>
				<?php  //echo '<h4>'. JText::_('COM_CONTACT_EMAIL_FORM').'</h4>';  ?>
			<?php endif; ?>
			<?php  echo $this->loadTemplate('form');  ?>
		<?php endif; ?>


		<?php if ($this->params->get('presentation_style')!='plain'){?>
				<?php echo JHtml::_($this->params->get('presentation_style').'.end');} ?>
	    </div>
	</article>      
</div>
