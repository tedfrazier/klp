<?php

/* * --------------------------------------------------------------------
  # Package - JoomlaMan JM Login
  # Version 1.0.1
  # --------------------------------------------------------------------
  # Author - JoomlaMan http://www.joomlaman.com
  # Copyright © 2012 - 2013 JoomlaMan.com. All Rights Reserved.
  # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
  # Websites: http://www.JoomlaMan.com
  ---------------------------------------------------------------------* */

// no direct access
define( '_JEXEC', 1 );
header('Content-Type: application/json');
define('DS', DIRECTORY_SEPARATOR);
define('JPATH_BASE', dirname(__FILE__) . DS . ".." . DS . "..");
require_once ( JPATH_BASE . DS . 'includes' . DS . 'defines.php' );
require_once ( JPATH_BASE . DS . 'includes' . DS . 'framework.php' );
$app = JFactory::getApplication('site');
$app->initialise();
jimport('joomla.application.component.helper');
jimport( 'joomla.application.module.helper' );
jimport( 'joomla.html.parameter' );
jimport('joomla.user.helper');
$lang = JFactory::getLanguage();
$lang->load('com_users');
$module = &JModuleHelper::getModule('mod_jmlogin');
$moduleParams = json_decode($module->params);
if($moduleParams->show_recaptcha){
	require_once JPATH_BASE . '/modules/mod_jmlogin/assets/recapcha/recaptchalib.php';
	$private_key = $moduleParams->recaptcha_private;
}
$result = array();
//print $private_key;
$result = array('status'=>'ok', 'error'=>'');
$data = array();
$data['name'] = JRequest::getVar('register_name','');
$data['username'] = JRequest::getVar('register_username','');
$data['password'] = JRequest::getVar('register_pass','');
$data['password2'] = JRequest::getVar('register_pass_verify','');
$data['email'] = JRequest::getVar('register_email','');

if(strlen($data['name']) < 5){
	$result['status'] = 'failed';
	$result['error'] = 'Name must be at least 5 characters long';
	print json_encode($result);
	exit;
}
if(strlen($data['username']) < 5){
	$result['status'] = 'failed';
	$result['error'] = 'Username must be at least 5 characters long';
	print json_encode($result);
	exit;
}
if(strlen($data['password']) < 5){
	$result['status'] = 'failed';
	$result['error'] = 'Password must be at least 5 characters long';
	print json_encode($result);
	exit;
}
$app = JFactory::getApplication();
$usersconfig = JComponentHelper::getParams('com_users');
$defaultUserGroup = $usersconfig->get('new_usertype', 2);
$data['groups'] = array($defaultUserGroup);
$data['sendEmail'] = 1;


$user = clone(JFactory::getUser(0));
if (!$user->bind($data)) { // now bind the data to the JUser Object, if it not works....
		$result['status'] = 'failed';
		$result['error'] = JText::_($user->getError());
		print json_encode($result);
		exit;
}
if($moduleParams->show_recaptcha){
	$resp = recaptcha_check_answer($private_key, $_SERVER["REMOTE_ADDR"], $_REQUEST["recaptcha_challenge_field"], $_REQUEST["recaptcha_response_field"]);
	if(!$resp->is_valid) {
		$result['status'] = 'failed';
		$result['error'] = 'The reCAPTCHA wasn\'t entered correctly.';
		print json_encode($result);
		exit;
	}
}
if (!$user->save()) { // if the user is NOT saved...
		$result['status'] = 'failed';
		$result['error'] = JText::_($user->getError());
		print json_encode($result);
		exit;
}else{
	$return = sendactivation($user->id,JRequest::getVar('register_pass',''));
	if ($return == 2){
		$result['message'] = JText::_('COM_USERS_REGISTRATION_COMPLETE_VERIFY');
	} elseif ($return == 1) {
		$result['message'] = JText::_('COM_USERS_REGISTRATION_COMPLETE_ACTIVATE');
	} else {
		$result['message'] = JText::_('COM_USERS_REGISTRATION_SAVE_SUCCESS');
	}
}
print json_encode($result);
exit;

function sendactivation($userid, $password){
	$user = JFactory::getUser($userid);
	$userParams = JComponentHelper::getParams('com_users');
	$config	= JFactory::getConfig();
	$db = JFactory::getDbo();
	$data = $user->getProperties();
	$data['fromname']	= $config->get('fromname');
	$data['mailfrom']	= $config->get('mailfrom');
	$data['sitename']	= $config->get('sitename');
	$data['siteurl']	= str_replace('/modules/mod_jmlogin','',JURI::base());
	$useractivation = $userParams->get('useractivation');
	$sendpassword = $userParams->get('sendpassword', 1);
	// Check if the user needs to activate their account.
	if ($userParams->get('useractivation') == 1 || $userParams->get('useractivation') == 2) {
		$data['activation'] = JApplication::getHash(JUserHelper::genRandomPassword());
		$data['block'] = 1;
		$user->set('activation', $data['activation']);
		$user->set('block', 1);
		$user->save();
	}
	if ($userParams->get('useractivation') == 2){
		// Set the link to confirm the user email.
		$uri = JURI::getInstance();
		$base = $uri->toString(array('scheme', 'user', 'pass', 'host', 'port'));
		$data['activate'] = $base.JRoute::_('index.php?option=com_users&task=registration.activate&token='.$data['activation'], false);

		$emailSubject	= JText::sprintf(
			'COM_USERS_EMAIL_ACCOUNT_DETAILS',
			$data['name'],
			$data['sitename']
		);

		if ($sendpassword)
		{
			$emailBody = JText::sprintf(
				'COM_USERS_EMAIL_REGISTERED_WITH_ADMIN_ACTIVATION_BODY',
				$data['name'],
				$data['sitename'],
				$data['siteurl'].'index.php?option=com_users&task=registration.activate&token='.$data['activation'],
				$data['siteurl'],
				$data['username'],
				$password
			);
		}
		else
		{
			$emailBody = JText::sprintf(
				'COM_USERS_EMAIL_REGISTERED_WITH_ADMIN_ACTIVATION_BODY_NOPW',
				$data['name'],
				$data['sitename'],
				$data['siteurl'].'index.php?option=com_users&task=registration.activate&token='.$data['activation'],
				$data['siteurl'],
				$data['username']
			);
		}
	}
	elseif ($userParams->get('useractivation') == 1)
	{
		// Set the link to activate the user account.
		$uri = JURI::getInstance();
		$base = $uri->toString(array('scheme', 'user', 'pass', 'host', 'port'));
		$data['activate'] = $base.JRoute::_('index.php?option=com_users&task=registration.activate&token='.$data['activation'], false);

		$emailSubject	= JText::sprintf(
			'COM_USERS_EMAIL_ACCOUNT_DETAILS',
			$data['name'],
			$data['sitename']
		);

		if ($sendpassword)
		{
			$emailBody = JText::sprintf(
				'COM_USERS_EMAIL_REGISTERED_WITH_ACTIVATION_BODY',
				$data['name'],
				$data['sitename'],
				$data['siteurl'].'index.php?option=com_users&task=registration.activate&token='.$data['activation'],
				$data['siteurl'],
				$data['username'],
				$password
			);
		}
		else
		{
			$emailBody = JText::sprintf(
				'COM_USERS_EMAIL_REGISTERED_WITH_ACTIVATION_BODY_NOPW',
				$data['name'],
				$data['sitename'],
				$data['siteurl'].'index.php?option=com_users&task=registration.activate&token='.$data['activation'],
				$data['siteurl'],
				$data['username']
			);
		}
	}
	else
	{
		$user->set('activation', '');
		$user->set('block', '0');
		$user->save();
		$emailSubject	= JText::sprintf(
			'COM_USERS_EMAIL_ACCOUNT_DETAILS',
			$data['name'],
			$data['sitename']
		);

		$emailBody = JText::sprintf(
			'COM_USERS_EMAIL_REGISTERED_BODY',
			$data['name'],
			$data['sitename'],
			$data['siteurl']
		);
	}
	// Send the registration email.
	JFactory::getMailer()->sendMail($data['mailfrom'], $data['fromname'], $data['email'], $emailSubject, $emailBody);
	return $userParams->get('useractivation');
}