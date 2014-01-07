<?php
/**
 * @copyright	Copyright (c) 2013 Jm Quick Contact. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

/**
 * Jm Quick Contact - jmquickcontact Helper Class.
 *
 * @package		Joomla.Site
 * @subpakage	JmQuickContact.jmquickcontact
 */
jimport( 'joomla.utilities.utility' );
class modjmquickcontactHelper {
	public static function sendMail($params) {
		$config	= JFactory::getConfig();
		$fromname	= $config->get('fromname');
		$mailfrom	= $config->get('mailfrom');
		$mailbody = $params->get('template');
		$trans = array(
			'[name]' => JRequest::getVar('jm_quickcontact_name',''),
			'[email]' => JRequest::getVar('jm_quickcontact_email',''),
			'[phone]' => JRequest::getVar('jm_quickcontact_phone',''),
			'[message]' => JRequest::getVar('jm_quickcontact_message',''),
		);
		$mailbody = strtr($mailbody, $trans);
		$recipients = $params->get('recipients');
		$recipients = explode(',',$recipients);
		$subject = $params->get('subject');
		JFactory::getMailer()->sendMail($mailfrom, $fromname, $recipients, $subject, $mailbody);
  }
}