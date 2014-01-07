<?php
/**
* Asset Element
* @package JE Image Slider
* @Copyright (C) 2009-2011 JoomExp.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: JEImageSlider 1.0 $
**/

// no direct access
defined('_JEXEC') or die('Restricted access');
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
