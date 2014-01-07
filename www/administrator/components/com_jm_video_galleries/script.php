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
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
class com_jm_video_galleriesInstallerScript
{
        /**
         * method to install the component
         *
         * @return void
         */
        function install($parent) 
        {
                // $parent is the class calling this method
                jimport('joomla.filesystem.folder');
                if(JFolder::exists(JPATH_SITE.'/images/com_jm_video_galleries/thumbnails'))
									JFolder::delete(JPATH_SITE.'/images/com_jm_video_galleries/thumbnails');
                JFolder::copy(JPATH_SITE.'/components/com_jm_video_galleries/demo/thumbnails',JPATH_SITE.'/images/com_jm_video_galleries/thumbnails');
        }
        /**
         * method to uninstall the component
         *
         * @return void
         */
        function uninstall($parent) 
        {
                // $parent is the class calling this method
        }
        /**
         * method to update the component
         *
         * @return void
         */
        function update($parent) 
        {
                // $parent is the class calling this method
        }
        /**
         * method to run before an install/update/uninstall method
         *
         * @return void
         */
        function preflight($type, $parent) 
        {
                // $parent is the class calling this method
                // $type is the type of change (install, update or discover_install)
        }
        /**
         * method to run after an install/update/uninstall method
         *
         * @return void
         */
        function postflight($type, $parent) 
        {
                // $parent is the class calling this method
                // $type is the type of change (install, update or discover_install)
        }
}
