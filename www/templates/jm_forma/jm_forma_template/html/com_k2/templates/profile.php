<?php
/**
 * @version		$Id: profile.php 1812 2013-01-14 18:45:06Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2013 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

?>

<!-- K2 user profile form -->
<form action="<?php echo JURI::root(true); ?>/index.php" enctype="multipart/form-data" method="post" name="userform" autocomplete="off" class="form-validate">
	<?php if($this->params->def('show_page_title',1)): ?>
	<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</div>
	<?php endif; ?>
	<article id="k2Container" class="k2AccountPage">
			<header class="entry-header">
				<h2 class="entry-title">
					<?php echo JText::_('K2_ACCOUNT_DETAILS'); ?>
				</h2>
			</header>
			<div class="row-fluid">
				<div class="span6">
					<label for="username"><?php echo JText::_('K2_USER_NAME'); ?></label>
					<span><b><?php echo $this->user->get('username'); ?></b></span>
				</div>
				<div class="span6">
					<label id="namemsg" for="name"><?php echo JText::_('K2_NAME'); ?></label>
					<input type="text" name="<?php echo $this->nameFieldName; ?>" id="name" size="40" value="<?php echo $this->escape($this->user->get( 'name' )); ?>" class="inputbox required" maxlength="50" />
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<label id="emailmsg" for="email"><?php echo JText::_('K2_EMAIL'); ?></label>
					<input type="text" id="email" name="<?php echo $this->emailFieldName; ?>" size="40" value="<?php echo $this->escape($this->user->get( 'email' )); ?>" class="inputbox required validate-email" maxlength="100" />
				</div>
				<?php if(version_compare(JVERSION, '2.5', 'ge')): ?>
					<div class="span6">
						<label id="email2msg" for="email2"><?php echo JText::_('K2_CONFIRM_EMAIL'); ?> *</label>
						<input type="text" id="email2" name="jform[email2]" size="40" value="<?php echo $this->escape($this->user->get( 'email' )); ?>" class="inputbox required validate-email" maxlength="100" />
					</div>
				<?php endif; ?>
			</div>
			
			<div class="row-fluid">
				<div class="span6">
					<label id="pwmsg" for="password"><?php echo JText::_('K2_PASSWORD'); ?></label>
					<input class="inputbox validate-password" type="password" id="password" name="<?php echo $this->passwordFieldName; ?>" size="40" value="" />
				</div>
				<div class="span6">
					<label id="pw2msg" for="password2"><?php echo JText::_('K2_VERIFY_PASSWORD'); ?></label>
					<input class="inputbox validate-passverify" type="password" id="password2" name="<?php echo $this->passwordVerifyFieldName; ?>" size="40" value="" />
				</div>
			</div>
			<header class="entry-header">
				<h2 class="entry-title">
					<?php echo JText::_('K2_PERSONAL_DETAILS'); ?>
				</h2>
			</header>
			<!-- K2 attached fields -->
			<div class="gender row-fluid">
				<div class="span2">
					<label id="gendermsg" for="gender"><?php echo JText::_('K2_GENDER'); ?></label>
				</div>
				<div class="span10">
					<?php echo $this->lists['gender']; ?>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<label id="descriptionmsg" for="description"><?php echo JText::_('K2_DESCRIPTION'); ?></label>
					<?php echo $this->editor; ?>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span2">
					<label id="imagemsg" for="image"><?php echo JText::_( 'K2_USER_IMAGE_AVATAR' ); ?></label>
				</div>
				<div class="span10">
					<input type="file" id="image" name="image"/>
					<?php if ($this->K2User->image): ?>
						<img class="k2AccountPageImage" src="<?php echo JURI::root(true).'/media/k2/users/'.$this->K2User->image; ?>" alt="<?php echo $this->user->name; ?>" />
						<input type="checkbox" name="del_image" id="del_image" />
						<label for="del_image">
							<?php echo JText::_('K2_CHECK_THIS_BOX_TO_DELETE_CURRENT_IMAGE_OR_JUST_UPLOAD_A_NEW_IMAGE_TO_REPLACE_THE_EXISTING_ONE'); ?>
						</label>
					<?php endif; ?>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span2">
					<label id="urlmsg" for="url"><?php echo JText::_('K2_URL'); ?></label>
				</div>
				<div class="span10">
					<input type="text" size="50" value="<?php echo $this->K2User->url; ?>" name="url" id="url"/>
				</div>
			</div>
			<?php if(count(array_filter($this->K2Plugins))): ?>
			<!-- K2 Plugin attached fields -->
			<header class="entry-header">
				<h2 class="entry-title">
					<?php echo JText::_('K2_ADDITIONAL_DETAILS'); ?>
				</h2>
			</header>
			<?php foreach($this->K2Plugins as $K2Plugin): ?>
			<?php if(!is_null($K2Plugin)): ?>
			<div class="row-fluid k2Plugin">
				<div class="span12">
					<?php echo $K2Plugin->fields; ?>
				</div>
			</div>
			<?php endif; ?>
			<?php endforeach; ?>
			<?php endif; ?>
			<?php if(isset($this->params) && version_compare(JVERSION, '1.6', 'lt')): ?>
			<header class="entry-header">
				<h2 class="entry-title">
					<?php echo JText::_('K2_ADMINISTRATIVE_DETAILS'); ?>
				</h2>
			</header>
			<div class="row-fluid">
				<div class="span13" id="userAdminParams">
					<?php echo $this->params->render('params'); ?>
				</div>
			</div>
			<?php endif; ?>
			<!-- Joomla! 1.6+ JForm implementation -->
			<?php if(isset($this->form)): ?>
			<?php foreach ($this->form->getFieldsets() as $fieldset): // Iterate through the form fieldsets and display each one.?>
				<?php if($fieldset->name != 'core'): ?>
				<?php $fields = $this->form->getFieldset($fieldset->name);?>
				<?php if (count($fields)):?>
					<?php if (isset($fieldset->label)):// If the fieldset has a label set, display it as the legend.?>
					<header class="entry-header">
						<h2 class="entry-title">
							<?php echo JText::_($fieldset->label);?>
						</h2>
					</header>
					<?php endif;?>
					<?php foreach($fields as $field):// Iterate through the fields in the set and display them.?>
						<?php if ($field->hidden):// If the field is hidden, just display the input.?>
							<div class="row-fluid"><div class="span12"><?php echo $field->input;?></div></div>
						<?php else:?>
							<div class="row-fluid">
								<div class="span4">
									<?php echo $field->label; ?>
									<?php if (!$field->required && $field->type != 'Spacer'): ?>
										<span class="optional"><?php echo JText::_('COM_USERS_OPTIONAL');?></span>
									<?php endif; ?>
								</div>
								<div class="span8"><?php echo $field->input;?></div>
							</div>
						<?php endif;?>
					<?php endforeach;?>
				<?php endif;?>
				<?php endif; ?>
			<?php endforeach;?>
			<?php endif; ?>
		<div class="rowSpace clearfix"></div>
		<div class="k2AccountPageUpdate">
			<button class="btn btn-default btn-readmore validate" type="submit" onclick="submitbutton( this.form );return false;">
				<?php echo JText::_('K2_SAVE'); ?>
			</button>
		</div>
	</article>
	<input type="hidden" name="<?php echo $this->usernameFieldName; ?>" value="<?php echo $this->user->get('username'); ?>" />
	<input type="hidden" name="<?php echo $this->idFieldName; ?>" value="<?php echo $this->user->get('id'); ?>" />
	<input type="hidden" name="gid" value="<?php echo $this->user->get('gid'); ?>" />
	<input type="hidden" name="option" value="<?php echo $this->optionValue; ?>" />
	<input type="hidden" name="task" value="<?php echo $this->taskValue; ?>" />
	<input type="hidden" name="K2UserForm" value="1" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
