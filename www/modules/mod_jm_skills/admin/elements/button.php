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

jimport('joomla.form.formfield');
   
class JFormFieldButton extends JFormField{

    protected $type = 'button';
 protected function getLabel() {
		return '';
	}
    protected function getInput() {
		
		$name = $this->element['name'];
		$text = $this->element['text'];
		$html = '<button id="jm-'.$name.'" class="jm-button">'.$text.'</button>';

		return $html;
        
      
    }    
}

?>
