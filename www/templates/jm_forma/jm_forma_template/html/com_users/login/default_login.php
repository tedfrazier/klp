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
JHtml::_('behavior.noframes');
?>
<div id="jm-login-page" class="login<?php echo $this->pageclass_sfx?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
    <header class="entry-header">
    	<hgroup class="page-header">
            <h1 class="entry-title">
        		<?php echo $this->escape($this->params->get('page_heading')); ?>
            </h1>
        </hgroup>
    </header>
	<?php endif; ?>

	<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
	<div class="login-description">
	<?php endif ; ?>

		<?php if($this->params->get('logindescription_show') == 1) : ?>
			<?php echo $this->params->get('login_description'); ?>
		<?php endif; ?>

		<?php if (($this->params->get('login_image')!='')) :?>
			<img src="<?php echo $this->escape($this->params->get('login_image')); ?>" class="login-image" alt="<?php echo JTEXT::_('COM_USER_LOGIN_IMAGE_ALT')?>"/>
		<?php endif; ?>

	<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
	</div>
	<?php endif ; ?>

	<form class="JMLoginFrontLoginFormWrap" action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post">

		<fieldset>
            <div id="jm-login-form" class="clearfix">
                <?php foreach ($this->form->getFieldset('credentials') as $field): ?>
                    <?php if (!$field->hidden): ?>
                        <div class="control-group row-fluid clearfix">
                            <div class="span3"><?php echo $field->label; ?></div>
                            <div class="span9"><?php echo $field->input; ?></div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                
                <div class="inputfield row-fluid">
                    <div class="<?php if (JPluginHelper::isEnabled('system', 'remember')) echo 'span4'; else echo 'span12' ?>">
                        <button type="submit" class="<?php echo (Helix::direction()=='rtl')?'right':'left'; ?> btn btn-readmore"><?php echo JText::_('JLOGIN'); ?></button>
                    </div>
                    <?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
                    <div class="span8">
                        <input id="remember" type="checkbox" name="remember" class="inputbox <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>" value="yes"  alt="<?php echo JText::_('JGLOBAL_REMEMBER_ME') ?>" title="<?php echo JText::_('JGLOBAL_REMEMBER_ME') ?>" />
                        <span class="<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>" style="margin-<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>:10px;"><?php echo JText::_('JGLOBAL_REMEMBER_ME') ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                
                
            </div>
            <div id="jm-login-link" class="clearfix">
                <ul class="unstyled">
                    <li>
                        <a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
                            <?php echo JText::_('COM_USERS_LOGIN_RESET'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
                            <?php echo JText::_('COM_USERS_LOGIN_REMIND'); ?></a>
                    </li>
                    <?php
                    $usersConfig = JComponentHelper::getParams('com_users');
                    if ($usersConfig->get('allowUserRegistration')) : ?>
                        <li>
                            <a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
                                <?php echo JText::_('COM_USERS_LOGIN_REGISTER'); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
                <input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('login_redirect_url', $this->form->getValue('return'))); ?>" />
                <?php echo JHtml::_('form.token'); ?>
            </div>
		</fieldset>
	</form>
</div>
