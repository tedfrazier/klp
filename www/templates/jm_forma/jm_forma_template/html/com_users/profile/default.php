<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 */

defined('_JEXEC') or die;
JHtml::_('behavior.tooltip');
?>
<div class="profile <?php echo $this->pageclass_sfx?>">
<?php if ($this->params->get('show_page_heading')) : ?>
<header class="entry-header">
<hgroup class="page-header">
<h1>
	<?php echo $this->escape($this->params->get('page_heading')); ?>
</h1>
</hgroup>
</header>
<?php endif; ?>

<?php echo $this->loadTemplate('core'); ?>

<?php echo $this->loadTemplate('params'); ?>

<?php echo $this->loadTemplate('custom'); ?>

<?php if (JFactory::getUser()->id == $this->data->id) : ?>
<a class="btn btn-default btn-readmore" href="<?php echo JRoute::_('index.php?option=com_users&task=profile.edit&user_id='.(int) $this->data->id);?>">
	<?php echo JText::_('COM_USERS_Edit_Profile'); ?></a>
	<div class="rowSpace row-space clearfix"></div>
<?php endif; ?>
</div>
