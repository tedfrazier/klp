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
require_once (JPATH_BASE.DS.'components'.DS.'com_users'.DS.'helpers'.DS.'route.php');
$lang = JFactory::getLanguage();
$lang->load('com_users');
$module = &JModuleHelper::getModule('mod_jmlogin');
$moduleParams = json_decode($module->params);

$result = array('status'=>'ok', 'error'=>'');
// Find the user
$db		= JFactory::getDbo();
$query	= $db->getQuery(true);
$query->select('*');
$query->from($db->quoteName('#__users'));
if(JRequest::getVar('email',0)){
	$email = JRequest::getVar('remail_repass');
	$query->where($db->quoteName('email').' = '.$db->Quote($email));
}else{
	$username = JRequest::getVar('re_uname');
	$query->where($db->quoteName('username').' = '.$db->Quote($username));
}

// Get the user id.
$db->setQuery((string) $query);
$user = $db->loadObject();

// Check for an error.
if ($db->getErrorNum()) {
	$error = JText::sprintf('COM_USERS_DATABASE_ERROR', $db->getErrorMsg());
	$result = array('status'=>'failed', 'error'=>$error);
	print json_encode($result);
	exit;
}

// Check for a user.
if (empty($user)) {
	$error = JText::_('COM_USERS_USER_NOT_FOUND');
	$result = array('status'=>'failed', 'error'=>$error);
	print json_encode($result);
	exit;
}

// Make sure the user isn't blocked.
if ($user->block) {
	$error = JText::_('COM_USERS_USER_BLOCKED');
	$result = array('status'=>'failed', 'error'=>$error);
	print json_encode($result);
	exit;
}
$userObject = JUser::getInstance($user->id);
// Make sure the user isn't a Super Admin.
if ($userObject->authorise('core.admin')) {
	$error = JText::_('COM_USERS_REMIND_SUPERADMIN_ERROR');
	$result = array('status'=>'failed', 'error'=>$error);
	print json_encode($result);
	exit;
}

// Set the confirmation token.
$token = JApplication::getHash(JUserHelper::genRandomPassword());
$salt = JUserHelper::getSalt('crypt-md5');
$hashedToken = md5($token.$salt).':'.$salt;
$userObject->activation = $hashedToken;

// Save the user to the database.
if (!$userObject->save(true)) {
	$error = JText::sprintf('COM_USERS_USER_SAVE_FAILED', $user->getError());
	$result = array('status'=>'failed', 'error'=>$error);
	print json_encode($result);
	exit;
}

// Assemble the password reset confirmation link.
$config	= JFactory::getConfig();
$mode = $config->get('force_ssl', 0) == 2 ? 1 : -1;
$itemid = UsersHelperRoute::getLoginRoute();
$itemid = $itemid !== null ? '&Itemid='.$itemid : '';
$link = 'index.php?option=com_users&view=reset&layout=confirm'.$itemid;

// Put together the email template data.
$data = $userObject->getProperties();
$data['fromname']	= $config->get('fromname');
$data['mailfrom']	= $config->get('mailfrom');
$data['sitename']	= $config->get('sitename');
$data['link_text']	= str_replace('/modules/mod_jmlogin','',JRoute::_($link, false, $mode));
$data['link_html']	= str_replace('/modules/mod_jmlogin','',JRoute::_($link, true, $mode));
$data['token']		= $token;

$subject = JText::sprintf(
	'COM_USERS_EMAIL_PASSWORD_RESET_SUBJECT',
	$data['sitename']
);

$body = JText::sprintf(
	'COM_USERS_EMAIL_PASSWORD_RESET_BODY',
	$data['sitename'],
	$data['token'],
	$data['link_text']
);

// Send the password reset request email.
$return = JFactory::getMailer()->sendMail($data['mailfrom'], $data['fromname'], $userObject->email, $subject, $body);
// Check for an error.
if ($return !== true) {
	$error = JText::sprintf('COM_USERS_MAIL_FAILED', $user->getError());
	$result = array('status'=>'failed', 'error'=>$error);
	print json_encode($result);
	exit;
}
/*
$config	= JFactory::getConfig();

// Assemble the login link.
$itemid = UsersHelperRoute::getLoginRoute();
$itemid = $itemid !== null ? '&Itemid='.$itemid : '';
$link	= 'index.php?option=com_users&view=login'.$itemid;
$mode	= $config->get('force_ssl', 0) == 2 ? 1 : -1;
// Put together the email template data.
$data = JArrayHelper::fromObject($user);
$data['fromname']	= $config->get('fromname');
$data['mailfrom']	= $config->get('mailfrom');
$data['sitename']	= $config->get('sitename');
$data['link_text']	= JRoute::_($link, false, $mode);
$data['link_html']	= JRoute::_($link, true, $mode);
$subject = JText::sprintf(
	'COM_USERS_EMAIL_USERNAME_REMINDER_SUBJECT',
	$data['sitename']
);
$body = JText::sprintf(
	'COM_USERS_EMAIL_USERNAME_REMINDER_BODY',
	$data['sitename'],
	$data['username'],
	$data['link_text']
);

// Send the password reset request email.
$return = JFactory::getMailer()->sendMail($data['mailfrom'], $data['fromname'], $user->email, $subject, $body);

// Check for an error.
if ($return !== true) {
	$error = JText::_('COM_USERS_MAIL_FAILED');
	$result = array('status'=>'failed', 'error'=>$error);
	print json_encode($result);
	exit;
}
*/
print json_encode($result);
exit;