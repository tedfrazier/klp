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
$doc = & JFactory::getDocument();
$config = & JFactory::getConfig(); 
$sitename = $config->getValue( 'config.sitename' );

$Itemid = $_REQUEST['Itemid'];

if($Itemid !=''){
    $menu = $app->getMenu()->getActive();
    if (is_object($menu))
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

require JModuleHelper::getLayoutPath('mod_jm_pagetitle', $params->get('layout', 'default'));
