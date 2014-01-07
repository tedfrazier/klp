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

/**
 * JM Socials - jmsocials Helper Class.
 *
 * @package		Joomla.Site
 * @subpakage	JMSocials.jmsocials
 */
class modjmsocialsHelper {
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