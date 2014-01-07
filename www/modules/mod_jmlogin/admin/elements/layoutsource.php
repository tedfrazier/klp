<?php
/* * --------------------------------------------------------------------
  # Package - JoomlaMan JM Login
  # Version 1.0.0
  # --------------------------------------------------------------------
  # Author - JoomlaMan http://www.joomlaman.com
  # Copyright © 2012 - 2013 JoomlaMan.com. All Rights Reserved.
  # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
  # Websites: http://www.JoomlaMan.com
  ---------------------------------------------------------------------* */
//-- No direct access
defined('_JEXEC') or die('Restricted access');
class JFormFieldLayoutSource extends JFormField {
    /**
     * The form field type.
     *
     * @var    string
     * @since  11.1
     */
    protected $type = 'LayoutSource';
    /**
     * Method to get the field input markup for a generic list.
     * Use the multiple attribute to enable multiselect.
     *
     * @return  string  The field input markup.
     *
     * @since   11.1
     */
    protected function getInput() {
        // Initialize variables.
        $html = array();
        $attr = '';
        // Initialize some field attributes.
        $attr .= $this->element['class'] ? ' class="' . (string) $this->element['class'] . '"' : '';
        // To avoid user's confusion, readonly="true" should imply disabled="true".
        if ((string) $this->element['readonly'] == 'true' || (string) $this->element['disabled'] == 'true') {
            $attr .= ' disabled="disabled"';
        }
        $attr .= $this->element['size'] ? ' size="' . (int) $this->element['size'] . '"' : '';
        $attr .= $this->multiple ? ' multiple="multiple"' : '';
        // Initialize JavaScript field attributes.
        $attr .= $this->element['onchange'] ? ' onchange="' . (string) $this->element['onchange'] . '"' : '';
        // Get the field options.
        $options = (array) $this->getOptions();
        // Create a read-only list (no name) with a hidden input to store the value.
        if ((string) $this->element['readonly'] == 'true') {
            $html[] = JHtml::_('select.genericlist', $options, '', trim($attr), 'value', 'text', $this->value, $this->id);
            $html[] = '<input type="hidden" name="' . $this->name . '" value="' . $this->value . '"/>';
        }
        // Create a regular list.
        else {
            $html[] = JHtml::_('select.genericlist', $options, $this->name, trim($attr), 'value', 'text', $this->value, $this->id);
        }
        return implode($html);
    }
    /**
     * Method to get the field options.
     *
     * @return  array  The field option objects.
     *
     * @since   11.1
     */
    protected function getOptions() {
        // Initialize variables.
		$db = &JFactory::getDbo();
		$query = "SELECT template FROM #__template_styles WHERE home=1 and client_id=0";
		$db->setQuery($query);
		$template = $db->loadResult();
		$templateDir = JPATH_SITE.DS.'templates'.DS.$template.DS.'html'.DS.'mod_jmlogin'.DS.'tmpl';
		$dir    = JPATH_SITE.DS.'modules'.DS.'mod_jmlogin'.DS.'tmpl';
        $options = array();
        $layout = array();
		if(is_dir($dir)){
			$files = scandir($dir);
			if ($files){
				foreach($files as $i=>$file){
					//preg_match('/^(<!)/i',$fget,$_layout);
					$file = explode('.',$file);
					$value = $file[0];
					$layout[] = $value;
					$ext = end($file);
					$tpl = array('default_register','default_regain_password','default_login');
					if($ext=='php'&&!in_array($value,$tpl)){
						$open = fopen($dir.DS.implode('.',$file),"r");
						$fget = trim(fgets($open));
						if (strlen(strstr($fget,'<!--Layout:')) > 0 ){
							$options[] = JHtml::_('select.option',$value,str_replace('-->','',str_replace('<!--Layout:','',$fget)));
						}else{
							$options[] = JHtml::_('select.option',$value ,$value);
						}
					}
				}
			}
		}
		if(is_dir($templateDir)){
			$files = scandir($templateDir);
			if ($files){
				foreach($files as $i=>$file){
					$file = explode('.',$file);
					$value = $file[0];
					$ext = end($file);
					$tpl = array('default_register','default_regain_password','default_login');
					if(!in_array($value,$layout)&&$ext=='php'&&!in_array($value,$tpl)){
						$open = fopen($dir.DS.implode('.',$file),"r");
						$fget = trim(fgets($open));
						if (strlen(strstr($fget,'<!--Layout:')) > 0 ){
							$options[] = JHtml::_('select.option',$value,str_replace('-->','',str_replace('<!--Layout:','',$fget)));
						}else{
							$options[] = JHtml::_('select.option',$value ,$value);
						}
					}
				}
			}
		}
        reset($options);
        return $options;
    }
}