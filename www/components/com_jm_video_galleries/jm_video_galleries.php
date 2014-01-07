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
defined('_JEXEC') or die;
// Include dependancies
jimport('joomla.application.component.controller');
// Execute the task.
$controller	= JControllerLegacy::getInstance('Jm_video_galleries');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
