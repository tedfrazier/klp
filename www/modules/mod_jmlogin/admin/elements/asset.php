<?php
/**
 * @package     mod jm login
 * @version		1.0
 * @created		Aug 2012
 * @author		Simon Vu
 * @email		admin@joomexp.com
 * @website		http://joomexp.com
 * @support		Site - http://joomexp.com
 * @copyright   Copyright (C) 2012 JoomExp. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *
 */
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.form.formfield');
class JFormFieldAsset extends JFormField {
    protected $type = 'Asset';
    protected function getInput() {
      $doc = JFactory::getDocument();
        jimport('joomla.version');
        $version = new JVersion();
        $joomla_version = (int) JVERSION;
        if ($joomla_version < 3) {
            $doc->addScript(JURI::root() . $this->element['path'] . 'js/jquery.min.js');
            $doc->addScript(JURI::root() . $this->element['path'] . 'js/script.js');
            $doc->addScript(JURI::root() . $this->element['path'] . 'js/jquery.mousewheel.js');
            $doc->addScript(JURI::root() . $this->element['path'] . 'js/jScrollPane.js');
            $doc->addScript(JURI::root() . $this->element['path'] . 'js/jquery.jmfields.js');
            $doc->addStyleSheet(JURI::root() . $this->element['path'] . 'css/jm_fields.css');
        } elseif ($joomla_version >= 3) {
            $doc->addScript(JURI::root() . $this->element['path'] . 'js/script3.js');
        }
        return null;
    }
}
?>