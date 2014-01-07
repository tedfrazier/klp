<?php

/* * --------------------------------------------------------------------
  # Package - JoomlaMan Module
  # Version 1.0
  # --------------------------------------------------------------------
  # Author - JoomlaMan http://www.joomlaman.com
  # Copyright (coffee) 2012 - 2013 JoomlaMan.com. All Rights Reserved.
  # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
  # Websites: http://www.JoomlaMan.com
  ---------------------------------------------------------------------* */
defined('_JEXEC') or die('Restricted access');
require_once 'helper.php';
$layout = $params->get('jmtwitterroll_layout', 'default');
$auto = $params->get('auto','true');
$timeout = $params->get('timeout', 3000);
$touch = $params->get('touch', 'false');
$load_bxslider = $params->get('load_bxslider', 'false'); 
$document = JFactory::getDocument();
$oauth_access_token = $params->get('oauth_access_token', '123293200-tJVbU1aNsxedwCOGTsu1aCn9M2K3WRnmLuhuY2gR');
$oauth_access_token_secret = $params->get('oauth_access_token_secret', 'xmVlqOUY0ilvbOFHqhbPBI7vgo2GRF855MyZwXXBY');
$consumer_key = $params->get('consumer_key', 'xsrZoe7IDkKYQKf3l3y4WQ');
$consumer_secret = $params->get('consumer_secret', '32prPwDeKEozpjycv448AESYX0fCaRKCkgaXZK5W8g');
$title = $params->get('title', '');
$titleLink = $params->get('titleLink', 'http://');
$tweetScroll = $params->get('tweetScroll', 4000);
$searchTerm = $params->get('searchTerm', '');
$count = $params->get('count', 5);
$colorExterior = $params->get('colorExterior', '#dddddd');
$colorInterior = $params->get('colorInterior', '#f6f6f6');
$borderEffect = $params->get('borderEffect', '');
$noborderEffect = $params->get('noborderEffect', '');
$height = $params->get('height', 300);
$width = $params->get('width', 'auto');
$avatar = $params->get('jmtwitter_avatar', '');
$pause = $params->get('pause', '');
$moduleclass_sfx = $params->get('moduleclass_sfx', '');
if ($pause == "0")
  $pause = "true";
if ($pause == "1")
  $pause = "false";
$time = $params->get('time', '');
if ($time == "0")
  $time = "true";
if ($time == "1")
  $time = "false";
$bird = $params->get('bird', '');
if ($bird == "0")
  $bird = "false";
if ($bird == "1")
  $bird = "true";
$menu = &JSite::getMenu();
$menuItem = $menu->getActive();
$jmitemid = 0;
if(isset($menuItem->id)){
	$jmitemid = $menuItem->id;
}
//Finding for custom CSS in template
$custom_css = JPATH_SITE . '/templates/' . modJmTwitterrollHelper::getTemplate() . '/css/' . $module->module . '_' . $layout . '.css';
if (file_exists($custom_css)) {
  $document->addStylesheet(JURI::root(true) . '/templates/' . modJmTwitterrollHelper::getTemplate() . '/css/' . $module->module . '_' . $layout . '.css');
} elseif(file_exists(JPATH_SITE . '/modules/'.$module->module.'/assets/css/'.$module->module.'_' . $layout . '.css')) {
  $document->addStylesheet(JURI::root(true) . DS . 'modules/'.$module->module.'/assets/css/'.$module->module.'_' . $layout . '.css');
}
if ($params->get('load_jquery') == 1) {
  $document->addScript('http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
}
if ($params->get('load_jquery') == 2):
  ?>
  <script type="text/javascript">
    var jQueryScriptOutputted = false;
    function JMSLInitJQuery() {    
      if (typeof(jQuery) == 'undefined') {   
        if (! jQueryScriptOutputted) {
          jQueryScriptOutputted = true;
          document.write("<scr" + "ipt type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js\"></scr" + "ipt>");
        }
        setTimeout("initJQuery()", 50);
      }         
    }
    JMSLInitJQuery();
  </script>
  <?php

endif;
$tweets = modJmTwitterrollHelper::getTweets($params);
require JModuleHelper::getLayoutPath('mod_jmtwitterroll', $layout);