<?php
/**
 * @package		JoomlaMan
 * @subpackage	mod_jm_pagetitle
 * @author      Chinh Duong Manh
 * @email       duongmanhchinh@gmail.com
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;


$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$showsitename    = $params->get('showsitename');

$app = JFactory::getApplication();
$doc =  JFactory::getDocument();
$config =  JFactory::getConfig(); // getting the config object using the Joomla JFactory
$sitename = $config->get('sitename'); // getting the sitename from the joomla configuration file
$Itemid = $_REQUEST['Itemid'];
$menu = $app->getMenu()->getActive();
if($Itemid !='' && $menu != null){
    if (is_object($params))
    $pagetitle = $menu->params->get('page_title');
    $pageheading = $menu->params->get('page_heading');
    $pageclass = $menu->params->get('pageclass_sfx');
    if($pageheading !='')
    	$title = $pageheading;
    else 
    	//$title = $menu->title;
		$title = $doc->getTitle();

} else {
    $title = $doc->getTitle();
}
$ptitle = $doc->getTitle();
//if($showsitename)  $title = $title.' - '.$sitename; else $title = $title ;

require JModuleHelper::getLayoutPath('mod_jm_pagetitle', $params->get('layout', 'default'));
