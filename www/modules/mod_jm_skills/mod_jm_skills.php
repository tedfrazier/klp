<?php
/**
 * @package		JM Skills
 * @subpackage	mod_jm_skills
 * @copyright	Copyright (C) 2013 JoomlaMan, Ltd. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

//Finding for custom CSS in template
$doc = JFactory::getDocument();
$app =& JFactory::getApplication();
$tpl_name = $app->getTemplate();

$layout = $params->get('layout');
$pos = mb_strpos($layout, '_:');
$tpl_layout = mb_substr($layout, $pos + 2);

$custom_css = JPATH_SITE . '/templates/' . $tpl_name . '/css/' . $module->module . '_' .$tpl_layout . '.css';
if (file_exists($custom_css)) {
  $doc->addStylesheet(JURI::root(true) . '/templates/' . $tpl_name. '/css/' . $module->module . '_' . $tpl_layout . '.css');
} else {
  $doc->addStylesheet(JURI::root(true) . DS . 'modules/mod_jm_skills/assets/css/mod_jm_skills_' . $tpl_layout . '.css');
}


$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$headerText = $params->get('skill_header_text');
$items = json_decode(base64_decode($params->get('items','')));

require JModuleHelper::getLayoutPath('mod_jm_skills', $params->get('layout', 'default'));
