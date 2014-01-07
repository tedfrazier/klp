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
defined('_JEXEC') or die('Restricted access');
class modjmgooglemapsHelper
{	
	public static function fetchHead($params, $module){
		$document	= JFactory::getDocument();
		$mainframe = JFactory::getApplication();
		$template = $mainframe->getTemplate();
		JHTML::_('behavior.framework');
		
		$language = JFactory::getLanguage();
		$mapApi= 'https://maps.googleapis.com/maps/api/js?sensor=true&language='.$language->getTag();
		if($params->get('weather')) $mapApi .= '&libraries=weather';
		if($params->get('apikey')) $mapApi .= '&key='.$params->get('apikey');
		$document->addScript($mapApi);
		//$document->addScript('https://maps.googleapis.com/maps/api/js?key=AIzaSyB7Sh8KJDTRSELkJQm5p-1pUitBJaVOeGQ&sensor=true');
		
		if(file_exists(JPATH_BASE.'/templates/'.$template.'/js/default.js'))
		{
			$document->addScript(JURI::root().'templates/'.$template.'/js/default.js');	
		}
		else{
			$document->addScript(JURI::root().'modules/'. $module->module . '/assets/js/jmbase64.min.js');
			if($params->get('enable-custom-infobox')){
				$document->addScript(JURI::root().'modules/'. $module->module . '/assets/js/infobox.js');		
			}
			$document->addScript(JURI::root().'modules/'. $module->module . '/assets/js/default.js');	
			
		}
	if(file_exists(JPATH_BASE.'/templates/'.$template.'/css/'. $module->module . '.css'))
		{
			$document->addStyleSheet(JURI::root().'/templates/'.$template.'/css/'. $module->module . '.css');	
		}
		else{
			$document->addStyleSheet(JURI::root().'modules/'. $module->module . '/assets/css/'. $module->module . '.css');
		}
		
		$script = 'window.addEvent(\'domready\', function(){';		
		$script .=  'var config = {';
		$script .=  'mapType				:\''.$params->get('mapType').'\',';
		$script .=  'width					:\''.$params->get('width').'\',';
		$script .=  'height					:\''.$params->get('height').'\',';
		$script .=  'cavas_id				:"cavas_id'.$module->id.'", ';
		$script .=  'zoom					:'.$params->get('zoom').',';
		$script .=  'zoomControl			:'.$params->get('zoomControl','true').',';
		$script .=  'scaleControl			:'.$params->get('scaleControl','true').',';
		$script .=  'panControl				:'.$params->get('panControl','true').',';
		$script .=  'mapTypeControl			:'.$params->get('mapTypeControl','true').',';
		$script .=  'streetViewControl		:'.$params->get('streetViewControl','true').',';
		$script .=  'overviewMapControl		:'.$params->get('overviewMapControl','true').',';
		$script .=  'weather				:'.$params->get('weather','true').',';
		$script .=  'temperatureUnit		:\''.$params->get('temperatureUnit','f').'\',';
		$script .=  'cloud					:'.$params->get('cloud','true').',';
		
		# for map address(map center)
		$script .=	'mapCenterType			:"'.$params->get('mapCenterType').'",';
		$script	.=	'mapCenterAddress		:"'.$params->get('mapCenterAddress').'",';
		$script	.=	'mapCenterCoordinate	:"'.$params->get('mapCenterCoordinate').'",';
		/*
		# for control custom style
		$script .=	'enableStyle			:"'.$params->get('enable-style').'",';
		$script .=	'styleTitle				:"'.$params->get('style-title').'",';
		$script .=	'createNewOrDefault		:"'.$params->get('createNewOrApplyDefaultStyle').'",';
		
		# for custom infobox
		$script .=	'enableCustomInfoBox	:"'.$params->get('enable-custom-infobox').'",';
		$script .=	'boxPosition			:"'.$params->get('pixelOffset').'",';
		$script .=	'closeBoxMargin			:"'.$params->get('closeBoxMargin').'",';
		$script .=	'closeBoxImage			:"'.$params->get('closeBoxURL').'",';
		*/
		$script .=	'url:"'.JURI::root().'"';
		$script .=  '};';
		
		# create box style object
		$boxcss = $params->get('boxcss');
		$boxcss = preg_replace("/[\n\r]/","",$boxcss);
		$boxcssArr = explode(',' ,$boxcss);
		$boxCssRender = array();
		$script .= 'var boxStyles = {';
		for ( $i=0; $i< count($boxcssArr); $i++){
			$boxcssArr[$i] = trim($boxcssArr[$i]);
			if($boxcssArr[$i]){
				$style = explode(':',$boxcssArr[$i]);
				$style[0] = str_replace(array(' ','-'),'',$style[0]);
				if($style[0]){
					$boxCssRender[]='"'.$style[0].'":"'.$style[1].'"';
				}
				
				
			}
		}
		$script .= implode($boxCssRender,',');
		$script .= '};';
		 
		$script .=  'var markersCode ="'.$params->get('markes').'"; ';
		$script .=  'var stylesCode ="'.$params->get('styles').'"; ';
		$script .=  'initializeMap(config, markersCode, stylesCode, boxStyles);';
		$script .=  '}) ';
		$document->addScriptDeclaration($script);
	}
	static function getTemplate(){
		$db=JFactory::getDBO();
		$query=$db->getQuery(true);
		$query->select('*');
		$query->from('#__template_styles');
		$query->where('home=1');
		$query->where('client_id=0');
		$db->setQuery($query);
		return $db->loadObject()->template;
	}
		
	
}