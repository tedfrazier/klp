<?php
/** 
	* @copyright	Copyright (c) 2013 Jm Quick Contact. All rights reserved. 
	* @license		GNU General Public License version 2 or later; see LICENSE.txt 
	*/// no direct access
	defined('_JEXEC') or die;
	$document = JFactory::getDocument();
	$document->addStyleSheet(JURI::base(true) . '/modules/mod_jmquickcontact/assets/css/jmquickcontact.css');
?>
<div class="JMContactWrap <?php echo $class_sfx;?>">
	<form class="JMContactWrapForm" id="form_quickcontact" method="post" action="">
	<div class="JMContactField row-fluid clearfix">
	<?php if($name):?>
	<div class="JMContactFieldItem span4">
	<input type="text" name="jm_quickcontact_name" placeholder="<?php print $name?>" value=""/>
	</div>
	<?php endif;?>
	<?php if($email):?>
	<div class="JMContactFieldItem span4">
	<input type="text" name="jm_quickcontact_email" placeholder="<?php print $email?>" value=""/>
	</div>
	<?php endif;?>
	<?php if($phone):?>
	<div class="JMContactFieldItem span4">
	<input type="text" name="jm_quickcontact_phone" placeholder="<?php print $phone?>" value=""/>
	</div>
	<?php endif;?>
	<?php if($message):?>
	<div class="JMContactField row-fluid clearfix">
	<div class="JMContactFieldItem span12">
	<textarea name="jm_quickcontact_message" placeholder="<?php print $message?>"></textarea>
	</div>
	</div>
	<?php endif;?>
	</div>				
	<div class="JMContactButton row-fluid clearfix">
	<input class="btn btn-white btn-large" type="submit" value="<?php print $send;?>"/>
	<input type="hidden" name="jm_quick_contact" value="1"/>
	</div>
	</form>
	</div>