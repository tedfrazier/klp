<?php
/* * --------------------------------------------------------------------
  # Package - JoomlaMan JMNewsTicker
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
class JFormFieldAbout extends JFormField {
	protected $type = 'About';
	protected function getInput() {
		return '<div id="jm-about">
                <div class="jm-desc"><a href="http://joomexp.com" target="_blank"><img src="' . JURI::root() . $this->element['path'] . '/logo.png"></a>
                        ' . JText::_("JM_ABOUT_DESC") . '
                        <p>
                        <a class="social-f" href="https://www.facebook.com/" target="_blank">facebook</a><a class="social-t" href="http://twitter.com/" target="_blank">twitter</a> <a class="social-rss" href="#">rss</a><a class="social-g" href="http://joomexp.com" target="_blank">group</a></p>
                </div>
                <br clear="both">
                <div class="jm-license">' . JText::_("JM_ABOUT_LICENSE") . '</div>
        </div>';
    }
}