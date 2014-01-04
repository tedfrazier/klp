<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.noframes');
//load user_profile plugin language
$lang = JFactory::getLanguage();
$lang->load( 'plg_user_profile', JPATH_ADMINISTRATOR );
?>
<div id="jm-registration-page" class="profileEdit <?php echo $this->pageclass_sfx?> clearfix">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<header class="entry-header clearfix">
	    <hgroup class="page-header">
		<h1>
			<?php echo $this->escape($this->params->get('page_heading')); ?>
		</h1>
		</hgroup>
	    </header>
	<?php  endif; ?>

	<form id="member-profile" action="<?php echo JRoute::_('index.php?option=com_users&task=profile.save'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
		<?php foreach ($this->form->getFieldsets() as $group => $fieldset):// Iterate through the form fieldsets and display each one.?>
			<?php $fields = $this->form->getFieldset($group);?>
			<?php if (count($fields)):?>
			<fieldset class="<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>">
			<div id="jm-registration-form" class="clearfix" style="margin-<?php echo (Helix::direction()=='rtl')?'left':'right'; ?>:30px;">
				<?php foreach ($fields as $field):// Iterate through the fields in the set and display them.?>
					<?php if ($field->hidden):// If the field is hidden, just display the input.?>
						<?php echo $field->input;?>
					<?php else:?>
						<div class="jm-registration-field-details">
							<?php echo $field->label; ?>
							<?php if (!$field->required && $field->type!='Spacer' && $field->name!='jform[username]' && $field->name!='jform[password1]' && $field->name!='jform[password2]'): ?>
								<span class="optional"><?php echo JText::_('COM_USERS_OPTIONAL'); ?></span>
							<?php endif; ?>
						<?php echo $field->input; ?>
						</div>
					<?php endif;?>
				<?php endforeach;?>
			</div>
			</fieldset>
			<?php endif;?>
		<?php endforeach;?>
		<div class="clearfix"></div>
		<div class="memberEditButon clearfix">
			<button type="submit" class="validate btn btn-default btn-readmore"><span><?php echo JText::_('JSUBMIT'); ?></span></button>
			<?php echo JText::_('COM_USERS_OR'); ?>
			<a href="<?php echo JRoute::_(''); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>

			<input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="profile.save" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
</div>
