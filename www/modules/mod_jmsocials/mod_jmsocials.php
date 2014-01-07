<?php
/* * --------------------------------------------------------------------
  # Package - JoomlaMan JM Socials
  # Version 1.0.1
  # --------------------------------------------------------------------
  # Author - JoomlaMan http://www.joomlaman.com
  # Copyright © 2012 - 2013 JoomlaMan.com. All Rights Reserved.
  # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
  # Websites: http://www.JoomlaMan.com
  ---------------------------------------------------------------------* */
// no direct access
defined('_JEXEC') || die('Restricted access');
if (!defined('DS'))
  define('DS', '/');
jimport('joomla.user.user');
// include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';
$document = JFactory::getDocument();
$custom_css = JPATH_SITE . DS . 'templates' . DS . modjmsocialsHelper::getTemplate() . DS . 'css' . DS . $module->module . '_' . $params->get('jmsocials_layout', 'default') . '.css';
if (file_exists($custom_css)) {
  $document->addStylesheet(JURI::base(true) . '/templates/' . modjmsocialsHelper::getTemplate() . '/css/' . $module->module . '_' . $params->get('jmsocials_layout', 'default') . '.css');
} else {
  $document->addStylesheet(JURI::base(true) . '/modules/mod_jmsocials/assets/css/mod_jmsocials_' . $params->get('jmsocials_layout', 'default') . '.css');
}
$show_title = $params->get('jmsocials_showtitle', 0);
$moduleclass_sfx = $params->get('moduleclass_sfx');
$module_id = $module->id;
$items = json_decode(base64_decode($params->get('items')));
require(JModuleHelper::getLayoutPath('mod_jmsocials', $params->get('jmsocials_layout', 'default')));