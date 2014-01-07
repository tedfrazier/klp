<?php
/* * --------------------------------------------------------------------
  # Package - JoomlaMan JM Googlemaps
  # Version 1.0
  # --------------------------------------------------------------------
  # Author - JoomlaMan http://www.joomlaman.com
  # Copyright © 2012 - 2013 JoomlaMan.com. All Rights Reserved.
  # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
  # Websites: http://www.JoomlaMan.com
  ---------------------------------------------------------------------* */
// no direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
// Include the syndicate functions only once
require_once (dirname ( __FILE__ ) . '/helper.php');
$doc = JFactory::getDocument();
$moduleclass_sfx = $params->get('moduleclass_sfx');
//Finding for custom CSS in template
$custom_css = JPATH_SITE . DS . 'templates' . DS . modjmgooglemapsHelper::getTemplate() . DS . 'css' . DS . $module->module . '_' . $params->get('module_layout', 'default') . '.css';
if (file_exists($custom_css)) {
  $doc->addStylesheet(JURI::base(true) . '/templates/' . modjmgooglemapsHelper::getTemplate() . '/css/' . $module->module . '_' . $params->get('module_layout', 'default') . '.css');
} else {
  $doc->addStylesheet(JURI::base(true) . '/modules/' . $module->module . '/assets/css/' . $module->module . '_' . $params->get('module_layout', 'default') . '.css');
}
modjmgooglemapsHelper::fetchHead ( $params, $module );
require (JModuleHelper::getLayoutPath ( 'mod_jmgooglemaps' ));
?>
