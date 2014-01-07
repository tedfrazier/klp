<?php
/* * --------------------------------------------------------------------
  # Package - JoomlaMan JM Twitter Roll
  # Version 1.0.0
  # --------------------------------------------------------------------
  # Author - JoomlaMan http://www.joomlaman.com
  # Copyright © 2012 - 2013 JoomlaMan.com. All Rights Reserved.
  # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
  # Websites: http://www.JoomlaMan.com
  ---------------------------------------------------------------------* */
// no direct access
defined('_JEXEC') || die('Restricted access');
jimport('joomla.html.html');
jimport('joomla.form.formfield');
class JFormFieldJEUpdate extends JFormField {
	protected $type = 'JEUpdate'; //the form field type
    var $options = array();
    
    protected function getInput() {
        $html ='
            <div class="update-tab">
                <h3>This is Update tab!</h3>
            </div>
        ';
        return $html;
	}
    function getLabel() {
        return '';
    }
    
}
