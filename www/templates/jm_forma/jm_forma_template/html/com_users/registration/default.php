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
?>
<div id="jm-registration-page" class="registration<?php echo $this->pageclass_sfx?>">
    <?php //if ($this->params->get('show_page_heading')) : ?>
    <header class="entry-header">
    <hgroup class="page-header">
        <h1 class="entry-title">
        <?php echo $this->escape($this->params->get('page_heading')); ?>
        </h1>
    </hgroup>
    </header>
    <?php //endif; ?>

    <form id="member-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post" class="form-validate">
        <?php foreach ($this->form->getFieldsets() as $fieldset): // Iterate through the form fieldsets and display each one.?>
            <?php $fields = $this->form->getFieldset($fieldset->name);?>
            <?php if (count($fields)):?>
                <fieldset>
                <div id="jm-registration-form" class="clearfix">
                    <div class="jm-registration-field-wrap">
                        <?php foreach($fields as $field):// Iterate through the fields in the set and display them.?>
                            <?php if ($field->hidden):// If the field is hidden, just display the input.?>
                                <?php echo $field->input;?>
                            <?php else:?>
                                <div class="jm-registration-field-details clearfix">
                                <?php echo $field->label; ?>
                                <?php if (!$field->required && $field->type!='Spacer'): ?>
                                    <span class="optional"><?php echo JText::_('COM_USERS_OPTIONAL'); ?></span>
                                <?php endif; ?>
                                <?php echo ($field->type!='Spacer') ? $field->input : "&#160;"; ?>
                                </div>
                            <?php endif;?>
                        <?php endforeach;?>
                    </div>
                    <div id="jm-registration-bt" class="clearfix">
                        <button type="submit" class="validate left btn btn-trans-gray"><?php echo JText::_('JREGISTER');?></button>
                        <a class="jm-btn left btn btn-trans-gray" href="<?php echo JRoute::_('');?>" title="<?php echo JText::_('JCANCEL');?>"><?php echo JText::_('JCANCEL');?></a>
                        <input type="hidden" name="option" value="com_users" />
                        <input type="hidden" name="task" value="registration.register" />
                        <?php echo JHtml::_('form.token');?>
                    </div>
                </div>
                </fieldset>
            <?php endif;?>
        <?php endforeach;?>
	</form>
</div>