<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.5
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>
<div class="resetPageWrap <?php echo $this->pageclass_sfx?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
	<header class="entry-header">
	    <hgroup class="page-header">
			<h1>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h1>
		</hgroup>
    </header>
	<?php endif; ?>

	<form id="user-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=reset.request'); ?>" method="post" class="form-validate ResetFieldWrap clearfix">
		<?php foreach ($this->form->getFieldsets() as $fieldset): ?>
			<p class="resetDesc"><?php echo JText::_($fieldset->label); ?></p>
			<div class="resetField">
				<?php foreach ($this->form->getFieldset($fieldset->name) as $name => $field): ?>
				<span style="margin-<?php echo (Helix::direction()=='rtl')?'left':'right'; ?>:30px;" class="<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>"><?php echo $field->label; ?></span>
				<?php echo $field->input; ?>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>

		<div class="resetButton clearfix">
			<button type="submit" class="validate <?php echo (Helix::direction()=='rtl')?'right':'left'; ?> btn btn-default btn-readmore">
				<?php echo JText::_('JSUBMIT'); ?></button>
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
</div>
