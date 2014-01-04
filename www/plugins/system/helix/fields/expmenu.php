<?php
/*----------------------------------------------------------------------
# Package - JM Template
# ----------------------------------------------------------------------
# Author - JoomlaMan http://www.joomlaman.com
# Copyright Copyright under commercial licence (C) 2012 - 2013 JoomlaMan
#license http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3
-----------------------------------------------------------------------*/

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
class JFormFieldExpmenu extends JFormField
{
	protected $type = 'expmenu';

	protected function getInput() {
		$v_array=explode(',',$this->value);
		$script='
			<script type="text/javascript">
				jQuery(document).ready(function(){	
		';
		foreach($v_array as $value){
			if($value<>""){
				$each_value=explode(':',$value);
				$script.='
				  jQuery("#'.$each_value[0].'>option").each(function(){
				   if(jQuery(this).attr("value")=="'.$each_value[1].'"){
					jQuery(this).attr("selected","true").trigger("liszt:updated");
				   }
				  });
				';
			}
		}
		$script.='
					var text="";
					jQuery(".select-menu").each(function(){
						text+=jQuery(this).attr("id")+":"+jQuery(this).val()+",";
					});
					jQuery("#jparams_menu_menutype").val(text);
					jQuery("#jparams_menu_expmenu").val(text);
					jQuery(".select-menu").change(function(){
						text="";
						jQuery(".select-menu").each(function(){
							text+=jQuery(this).attr("id")+":"+jQuery(this).val()+",";
						});
						jQuery("#jparams_menu_menutype").val(text);
						jQuery("#jparams_menu_expmenu").val(text);
					});
			});
			</script>
		';
		$db =& JFactory::getDbo();
		$db->setQuery(
		    'SELECT sef, title_native' .
		    ' FROM #__languages' .
		    ' ORDER BY sef ASC'
		);
		$options = $db->loadObjectList();
		$html=array();
		$html[]='<style type="text/css">#jform_params_menutype-lbl{display:none;}</style>';
		$html[]=$script;
		$html[]='<div class="menu-language">';
		$html[]='<span class="menu-title">Choose menu & language</span>';
		foreach($options as $option){
			$html[]='<div class="lang-row"><label  for="lang-'.$option->sef.'">'.$option->title_native.'</label>';
			$menu_option=JHtml::_('menu.menus');
			$html[]='<select id="'.$option->sef.'" class="select-menu" name="menu-of-'.$option->sef.'">';
			$html[]=JHtml::_('select.options', $menu_option, 'value', 'text', '');
			$html[]='</select>';
			$html[]='</div>';
		}
		$html[]='</div>';
		$html[]='<input type="hidden" id="jparams_menu_menutype" value="" name="jform[params][menutype]" />';
		$html[]='<input type="hidden" id="jparams_menu_expmenu" value="" name="jform[params][menu]" />';
		return implode("\n",$html);
	}
}
