<?php

/* * --------------------------------------------------------------------
  # Package - JoomlaMan JM Parallax
  # Version 1.0
  # --------------------------------------------------------------------
  # Author - JoomlaMan http://www.joomlaman.com
  # Copyright � 2012 - 2013 JoomlaMan.com. All Rights Reserved.
  # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
  # Websites: http://www.JoomlaMan.com
  ---------------------------------------------------------------------* */
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JFormFieldAsset extends JFormField {

    protected $type = 'Asset';

    protected function getInput() {
      $doc = JFactory::getDocument();
			jimport('joomla.version');
			$version = new JVersion();
			$joomla_version = JVERSION; 
			if (JVERSION <3) {
				$doc->addScript(JURI::root() . $this->element['path'] . 'js/jquery.min.js');
				$doc->addScript(JURI::root() . $this->element['path'] . 'js/script.js');
				$doc->addScript(JURI::root() . $this->element['path'] . 'js/jquery.jmfields.js');
				$doc->addStyleSheet(JURI::root() . $this->element['path'] . 'css/jm_fields.css');
				$doc->addScript(JURI::root() . $this->element['path'] . 'js/jquery.mousewheel.js');
				$doc->addScript(JURI::root() . $this->element['path'] . 'js/jScrollPane.js');
				$doc->addScript(JURI::root() . $this->element['path'] . 'js/jmbase64.min.js');
				$doc->addScript(JURI::root() . $this->element['path'] . 'js/jmadditem.js');
			}elseif(JVERSION >= 3){
				$doc->addScript(JURI::root() . $this->element['path'] . 'js/script3.js');
			}
			return null;
    }

}
?>