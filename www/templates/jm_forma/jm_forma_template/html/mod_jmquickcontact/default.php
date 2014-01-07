<?php
/**
	* @copyright	Copyright (c) 2013 Jm Quick Contact. All rights reserved.
	* @license		GNU General Public License version 2 or later; see LICENSE.txt
	*/// no direct access
	defined('_JEXEC') or die;
	$document = JFactory::getDocument();
	$document->addStyleSheet(JURI::base(true) . '/modules/mod_jmquickcontact/assets/css/jmquickcontact.css');
?>
<div class="JMForma JMContactWrap <?php echo $class_sfx;?>">
	<form class="JMContactWrapForm" id="form_quickcontact" method="post" action="">
		<?php if($name):?>
			<div class="JMContactField clearfix">
			<div class="JMContactFieldItem">
			<input type="text" name="jm_quickcontact_name" value="<?php echo $name; ?>" onblur="if (this.value=='') this.value='<?php echo $name; ?>';" onfocus="if (this.value=='<?php echo $name; ?>') this.value='';"/>
			</div>
			</div>
		<?php endif;?>
		<?php if($email):?>
			<div class="JMContactField clearfix">
			<div class="JMContactFieldItem">
			<input type="text" name="jm_quickcontact_email" value="<?php print $email?>" onblur="if (this.value=='') this.value='<?php echo $email; ?>';" onfocus="if (this.value=='<?php echo $email; ?>') this.value='';"/>
			</div>
			</div>
		<?php endif;?>
		<?php if($phone):?>
			<div class="JMContactField  clearfix">
			<div class="JMContactFieldItem">
			<input type="text" name="jm_quickcontact_phone" value="<?php print $phone?>" onblur="if (this.value=='') this.value='<?php echo $phone; ?>';" onfocus="if (this.value=='<?php echo $phone; ?>') this.value='';"/>
			</div>
			</div>
		<?php endif;?>
		<?php if($message):?>
			<div class="JMContactField clearfix">
			<div class="JMContactFieldItem span12">
			<textarea name="jm_quickcontact_message" onblur="if (this.value=='') this.value='<?php echo $message; ?>';" onfocus="if (this.value=='<?php echo $message; ?>') this.value='';"><?php echo $message; ?></textarea>
			</div>
			</div>
		<?php endif;?>
		<div class="JMContactButton clearfix">
			<input class="btn btn-default" type="submit" value="<?php print $send;?>" />
		</div>
		<input type="hidden" name="jm_quick_contact" value="1"/>
	</form>
</div>