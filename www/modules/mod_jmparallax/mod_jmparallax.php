<?php
/**
 * @copyright	@copyright	Copyright (c) 2013 JM Parallax. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die;
if (!defined('DS'))
define('DS', '/');
jimport( 'joomla.user.user' );
// include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';
$document = JFactory::getDocument(); 
$background_image = $params->get('background_image', '');
$text_content = $params->get('text_content', '');
$text_content = JHtml::_('content.prepare', $text_content);
$slides = modjmparallaxHelper::getItems($text_content);
$background_position = $params->get('background_position', 'center center');
$parallax_background = $params->get('parallax_background', 0);
$repeat_background = $params->get('repeat_background', 'no-repeat');
$text_color = $params->get('text_color', '#FFF');
$top_padding = $params->get('top_padding', '20');
$bottom_padding = $params->get('bottom_padding', '20');
$parallax_carousel_controls_position = $params->get('parallax_carousel_controls_position','bottom-center');
$autoplay = $params->get('autoplay',true);
$module_id = $module->id;
$custom_css = JPATH_SITE . DS . 'templates' . DS . modjmparallaxHelper::getTemplate() . DS . 'css' . DS . $module->module . '_' . $params->get('jmparallax_layout', 'default') . '.css';
if (file_exists($custom_css)) {
  $document->addStylesheet(JURI::base(true) . '/templates/' . modjmparallaxHelper::getTemplate() . '/css/' . $module->module . '_' . $params->get('jmparallax_layout', 'default') . '.css');
} else {
  $document->addStylesheet(JURI::base(true) . '/modules/mod_jmparallax/assets/css/mod_jmparallax_' . $params->get('jmparallax_layout', 'default') . '.css');
}
$parallax_timeout = $params->get('parallax_timeout',5000);
$parallax_background_ratio = $params->get('parallax_background_ratio',0.5);
$parallax_carousel_controls = $params->get('parallax_carousel_controls',0);
global $jm_jquery_autoload;
if($params->get('jmparallax_include_jquery')==2 && empty($jm_jquery_autoload)):?>
<script type="text/javascript">
var jQueryScriptOutputted = false;
function JMInitJQuery() {    
  if (typeof(jQuery) == 'undefined') {   
    if (! jQueryScriptOutputted) {
      jQueryScriptOutputted = true;
      document.write("<scr" + "ipt type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js\"></scr" + "ipt>");
    }
    setTimeout("JMInitJQuery()", 50);
  }         
}
JMInitJQuery();
</script>
<?php
$jm_jquery_autoload = 1;
elseif($params->get('jmparallax_include_jquery')==1):?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>;
<?php
endif;
print '<script type="text/javascript" src="'.JURI::base(true) . '/modules/mod_jmparallax/assets/js/jquery.stellar.min.js"></script>';
require(JModuleHelper::getLayoutPath('mod_jmparallax', $params->get('jmparallax_layout', 'default')));