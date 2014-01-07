<?php

/* * --------------------------------------------------------------------
  # Package - JoomlaMan JM Login
  # Version 1.0
  # --------------------------------------------------------------------
  # Author - JoomlaMan http://www.joomlaman.com
  # Copyright © 2012 - 2013 JoomlaMan.com. All Rights Reserved.
  # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
  # Websites: http://www.JoomlaMan.com
  ---------------------------------------------------------------------* */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Example Module Helper
 *
 * @package		  Joomla!
 * @subpackage	Jm Login
 * @since 		  1.0.0
 * @class       ModJmloginHelper
 */
class modJmloginHelper {

    function getLogin($params) {
        $activation = JRequest::getVar('activation');
        if ($activation) {
            $this->confirmEmail($activation);
        }
    }

    function confirmEmail($activation) {
        $app = &JFactory::getApplication();
        //echo $activation;
        //$activation=JRequest::getVar('confirmEmail');
        $db = JFactory::getDbo();
        $query = "SELECT id FROM #__users WHERE activation='{$activation}'";
        $db->setQuery($query);
        $userid = $db->loadResult();
        if (!empty($userid)) {
            $account = JFactory::getUser($userid);
            $account->block = 0;
            $account->save();
            $app->redirect('index.php', 'Your account has been activated.');
        } else {
            $app->redirect('index.php', 'The activation code is not valid.', 'error');
        }
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

?>