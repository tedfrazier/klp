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
// No direct access
defined('_JEXEC') or die;
jimport('joomla.application.component.controllerform');
/**
 * Video controller class.
 */
class Jm_video_galleriesControllerVideo extends JControllerForm
{
    function __construct() {
        $this->view_list = 'videos';
        parent::__construct();
    }
}
