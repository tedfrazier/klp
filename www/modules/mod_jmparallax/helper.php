<?php
/**
 * @copyright	Copyright (c) 2013 JM Socials. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die;
/**
 * JM Socials - jmsocials Helper Class.
 *
 * @package		Joomla.Site
 * @subpakage	JMSocials.jmsocials
 */
class modjmparallaxHelper {

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
	
	static function getItems($content){
		$matches = null;
		preg_match_all("'\[item\](.*?)\[\/item\]'si", $content , $matches);
		if(!empty($matches[1])){
			return $matches[1];
		}else{
			return array($content);
		}
	}
}