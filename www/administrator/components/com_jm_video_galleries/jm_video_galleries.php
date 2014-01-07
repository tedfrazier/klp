<?php
/**
 * @package     com_jm_video_galleries
 * @version     1.0.0
 * Author - JoomlaMan http://www.joomlaman.com
 * Copyright (C) 2012 - 2013 JoomlaMan.com. All Rights Reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 * Websites: http://www.JoomlaMan.com
 * Support: support@joomlaman.com
*/
// no direct access
defined('_JEXEC') or die;
// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_jm_video_galleries')) 
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}
// Include dependancies
jimport('joomla.application.component.controller');
require_once 'helpers/jm_video_galleries.php';
$controller	= JControllerLegacy::getInstance('Jm_video_galleries');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
