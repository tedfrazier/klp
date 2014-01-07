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
jimport( 'joomla.application.module.helper' );
$module = &JModuleHelper::getModule('mod_jmlogin');
$moduleParams = json_decode($module->params);
$options = array();
$credentials = array();
$credentials['username'] = JRequest::getVar('username', '');
$credentials['password'] = JRequest::getVar('password', '');
//preform the login action
$login = $app->login($credentials, $options);
if($login){
	$result = array('status'=>'ok', 'error'=>'');
	if($moduleParams->login){
		$menu = $app->getMenu();
		$item = $menu->getItem($moduleParams->login);
		$result['redirect'] = str_replace('/modules/mod_jmlogin','',JRoute::_($item->link));
	}else{
		$result['redirect'] = '';
	}
}else{
	$result = array('status'=>'failed', 'error'=>$moduleParams->error_invalid_username_or_password);
}
print json_encode($result);
exit;