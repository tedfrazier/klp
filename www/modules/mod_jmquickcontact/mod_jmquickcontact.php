<?php
/**
 * @copyright	@copyright	Copyright (c) 2013 Jm Quick Contact. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';
$submit = JRequest::getVar('submit_quickcontact');
$class_sfx = htmlspecialchars($params->get('class_sfx'));
if(isset($_POST['jm_quick_contact'])){
	modjmquickcontactHelper::sendMail($params);
}
$name = $params->get('name','');
$email = $params->get('email','');
$phone = $params->get('phone','');
$message = $params->get('message','');
$send = $params->get('send','Send');
require(JModuleHelper::getLayoutPath('mod_jmquickcontact', $params->get('layout', 'default')));