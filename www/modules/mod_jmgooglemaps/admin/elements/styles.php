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

class JFormFieldStyles extends JFormField{
    protected $type = 'styles';
    protected function getLabel(){
    	return '';
    	
    } 
    protected function  getInput() {
    	
        $html  = ' <div id="jmg-style-message" class="clearfix" style="clear:both;"></div>'
                . '    <ul id="jmg-style-warning"></ul>'
                . '<ul id="jmg-style">'
                . '		<li id="jmg-style-main-button">'
                . '     	<label>&nbsp;</label>'
                . '     	<button id="btnAddStyle" class="jmg-green-btn" versionjl="'.JVERSION.'" baseurl=" '.JURI::root().'">' . JText::_('MOD_JMGOOGLEMAPS_ADD_STYLE_LABEL') . '</button>'
                . '     	<button id="btnDeleteAllStyle" class="jmg-red-btn">' . JText::_('MOD_JMGOOGLEMAPS_DELETE_ALL_STYLE_LABEL') . '</button>'
                . '		</li>'
                . '		<li id="style-form">&nbsp;</li>'
                . '		<li >'
                . '			<div class="jmg-style-head">' . JText::_('STYLE_LIST') . '</div>'
                . '			<input id="jmg-style-hidden" type="hidden" name="' . $this->name . '" value="' . $this->value . '" />'
                . '  		<ul id="jmg-styles-container" class="clearfix adminformlist">'
                . '			</ul>'
                . '		</li>'
                . '</ul>';
		 $moduleID = $this->form->getValue('id');
        if ($moduleID == '')
            $moduleID = 0;
                
 ?>
 <script type="text/javascript">
 // setup for manager Styles 
 	var dialogStyleHtml = '<form id="jmg-form-style"><div class= "jmg-messages" id="jmg-sylte-messages" class="clearfix"></div>'
    + '<ul class="jmg-style-dialog-container">'
    + '     <li >'
    + '         <label for="jmg-feature-type"  title="<?php echo JText::_('MOD_JMGOOGLEMAPS_FEATURE_TYPE_DESC') ?>"><?php echo JText::_('MOD_JMGOOGLEMAPS_FEATURE_TYPE_LABEL') ?></label>'
    + '         <select id="jmg-feature-type" name="jmg-feature-type" class="jm-field single stylejmsingle">'
    + '				<option value="all">All</option>'
    + '				<option value="administrative">Administrative</option>'
    + '				<option value="administrative.country">Country</option>'
    + '				<option value="administrative.province">Province</option>'
    + '				<option value="administrative.locality">Locality</option>'
    + '				<option value="administrative.neighborhood">Neighborhood</option>'
    + '				<option value="administrative.land_parcel">Land Parcel</option>'
    + '				<option value="landscape">Land Scape</option>'
    + '				<option value="landscape.man_made">Man Made</option>'
    + '				<option value="landscape.natural">Natural</option>'
    + '				<option value="poi">Point of interest(Poi)</option>'
    + '				<option value="poi.attraction">Poi.Attractioin</option>'
    + '				<option value="poi.business">Poi.Business</option>'
    + '				<option value="poi.government">Poi.Goverment</option>'
    + '				<option value="poi.medical">Poi.Medical</option>'
    + '				<option value="poi.park">Poi.Park</option>'
    + '				<option value="poi.place_of_worship">Poi.Place of Worship</option>'
    + '				<option value="poi.school">Poi.School</option>'
    + '				<option value="poi.sports_complex">Poi.Sports Complex</option>'
    + '				<option value="road">Road</option>'
    + '				<option value="road.arterial">Road.Arterial</option>'
    + '				<option value="road.highway">Road.Highway</option>'
    + '				<option value="road.highway.controlled_access">Road.Highway.Controlled Access</option>'
    + '				<option value="road.local">Road.Local</option>'
    + '				<option value="transit">Transit</option>'
    + '				<option value="transit.line">Transit.Line</option>'
    + '				<option value="transit.station">Transit.Station</option>'
    + '				<option value="transit.station.airport">Transit.Station.Airport</option>'
    + '				<option value="transit.station.bus">Transit.Station.Bus</option>'
    + '				<option value="transit.station.rail">Transit.Station.Rail</option>'
    + '				<option value="water">Water</option>'
    + '			</select>'
    + '     </li>'
    + '     <li>'
    + '         <label for="jmg-style-element-type"  title="<?php echo JText::_('MOD_JMGOOGLEMAPS_STYLE_ELEMENT_TYPE_DESC') ?>"><?php echo JText::_('MOD_JMGOOGLEMAPS_STYLE_ELEMENT_TYPE_LABEL') ?></label>'
    + '         <select  name="jmg-style-element-type" id="jmg-style-element-type"  class="jm-field single stylejmsingle">'
    + '             <option value="all">All</option>'
    + '             <option value="geometry">Geometry</option>'
    + '             <option value="geometry.fill">Geometry.Fill</option>'
    + '             <option value="geometry.stroke">Geometry.Stroke</option>'
    + '             <option value="labels">Labels</option>'
    + '             <option value="labels.icon">Labels.Icon</option>'
    + '             <option value="labels.text">Labels.Text</option>'
    + '             <option value="labels.text.fill">Labels.Text.Fill</option>'
    + '             <option value="labels.text.stroke">Labels.Text.Stroke</option>'
    + '         </select>'
    + '     </li>'
    + '     <li >'
    + '     	<label for="jmg-style-visibility"  title ="<?php echo JText::_('MOD_JMGOOGLEMAPS_STYLE_VISIBILITY_DESC') ?>"><?php echo JText::_('MOD_JMGOOGLEMAPS_STYLE_VISIBILITY_LABEL') ?></label>'
    + '         <select id="jmg-style-visibility" name="jmg-style-visibility"  class="jm-field single stylejmsingle">'
	+ '				<option value="">None</option>'
    + '				<option value="simply">Simply</option>'
    + '				<option value="on">On</option>'
    + '				<option value="off">Off</option>'
    + '			</select>'
    + '     </li>'
    + '     <li >'
    + '     	<label for="jmg-style-invert-lightness" title ="<?php echo JText::_('MOD_JMGOOGLEMAPS_STYLE_INVERT_LIGHTNESS_DESC') ?>"><?php echo JText::_('MOD_JMGOOGLEMAPS_STYLE_INVERT_LIGHTNESS_LABEL') ?></label>'
    + '     	<select id="jmg-style-invert-lightness" name="jmg-style-invert-lightness" class="jm_switch jm-field single stylejmsingle">'
    + '				<option value="false">No</option>'
    + '				<option value="true">Yes</option>'
    + '			</select>'
    + '     </li>'
    + '     <li >'
    + '			<label for="jmg-style-map-color"  title="<?php echo JText::_('MOD_JMGOOGLEMAPS_MAP_COLOR_DESC') ?>"><?php echo JText::_('MOD_JMGOOGLEMAPS_MAP_COLOR_LABEL') ?></label>'
    + '			<input class="jm_color jm-field" type="text" id="jmg-style-map-color" name="jmg-style-map-color"/>'
    + '     </li>'
    + '     <li >'
    + '			<label for="jmg-style-weight"  title="<?php echo JText::_('MOD_JMGOOGLEMAPS_STYLE_WEIGHT_DESC') ?>"><?php echo JText::_('MOD_JMGOOGLEMAPS_STYLE_WEIGHT_LABEL') ?></label>'
    + '			<input class="jm-field" type="text" id="jmg-style-weight" name="jmg-style-weight" />'
    + '     </li>'
    + '     <li >'
    + '			<label for="jmg-style-hue"  title="<?php echo JText::_('MOD_JMGOOGLEMAPS_STYLE_HUE_DESC') ?>"><?php echo JText::_('MOD_JMGOOGLEMAPS_STYLE_HUE_LABEL') ?></label>'
    + '			<input class="jm_color jm-field" type="text" id="jmg-style-hue" name="jmg-style-hue"/>'
    + '     </li>'
    + '     <li >'
    + '			<label for="jmg-style-saturation"  title="<?php echo JText::_('MOD_JMGOOGLEMAPS_STYLE_SATURATION_DESC') ?>"><?php echo JText::_('MOD_JMGOOGLEMAPS_STYLE_SATURATION_LABEL') ?></label>'
    + '			<input class="jm-field" type="text" id="jmg-style-saturation" name="jmg-style-saturation" />'
    + '     </li>'
    + '     <li >'
    + '			<label for="jmg-style-lightness"  title="<?php echo JText::_('MOD_JMGOOGLEMAPS_STYLE_LIGHTNESS_DESC') ?>"><?php echo JText::_('MOD_JMGOOGLEMAPS_STYLE_LIGHTNESS_LABEL') ?></label>'
    + '			<input class="jm-field" type="text"  name="jmg-style-lightness" id="jmg-style-lightness"/>'
    + '     </li>'
    + '     <li >'
    + '     	<label for="jmg-style-gamma" title ="<?php echo JText::_('MOD_JMGOOGLEMAPS_STYLE_GAMMA_DESC') ?>"><?php echo JText::_('MOD_JMGOOGLEMAPS_STYLE_GAMMA_LABEL') ?></label>'
    + '         <input class="jm-field" type="text" name="jmg-style-gamma" id="jmg-style-gamma"/>'
    + '     </li>'
    + '     <li id="jmg-submit-btn">'
    + '         <button id="btnCreateStyle" class="jmg-green-btn jmg-panel-btn"><?php echo JText::_('MOD_JMGOOGLEMAPS_BUTTON_CREATE_STYLE') ?></button>'
    + '         <button id="btnUpdateStyle" class="jmg-green-btn jmg-panel-btn"><?php echo JText::_('MOD_JMGOOGLEMAPS_BUTTON_UPDATE_STYLE') ?></button>'
    + '         <button id="btnCancel" class="jmg-red-btn jmg-panel-btn"><?php echo JText::_('MOD_JMGOOGLEMAPS_BUTTON_CANCEL') ?></button>'
    + '     </li>'
    + '</ul>'
    + '<div style="clear:both"></div>'
    + '</form>';
    
    var jQ = jQuery.noConflict();
    
    jQ(document).ready(function(){
    	  //init form preview
        var styleList = new JM.StyleList({
            liveURL : '<?php echo JURI::root() . 'modules/mod_jmgooglemaps' ?>',
            warningText: {
                addStyleSuccess: '<?php echo JText::_('ADD_STYLE_SUCCESS') ?>',
                updateStyleSuccess: '<?php echo JText::_('UPDATE_STYLE_SUCCESS') ?>',
                confirmDeleteAll: '<?php echo JText::_('CONFIRM_DELETE_ALL') ?>',
                confirmDelete: '<?php echo JText::_('CONFIRM_DELETE') ?>',
                deleteAllSuccess: '<?php echo JText::_('DELETE_ALL_SUCCESS') ?>'
            },
            dialogTemplate: dialogStyleHtml,
            encodedItems : '<?php echo $this->value ?>',
            moduleID: '<?php echo $moduleID ?>',
            container: 'jmg-styles-container',
            messageContainer: 'jmg-warning',
            btnCreateID: '#btnCreateStyle',
            btnUpdateID: '#btnUpdateStyle',
            btnCancelID: '#btnCancel'

        });
                        
        /**
         * Open style options when click add style
         * 
         */
        jQ("#btnAddStyle").click(function(){
        	styleList.openDialog();
			var versionjl = jQuery('#btnAddMarker').attr('versionjl');
			if(versionjl<3){
				jQ('.jm-fieldsingle').jmSelectSingle();
			}
            return false;
        });
        /**
         * Close all options when click cancel
         */

        //remove all
        jQ('#btnDeleteAllStyle').click(function(){
            if(jQ('#jmg-styles-container li').length > 0 )
                styleList.removeAll();
            return false;
        });
    });
 </script>
 
 <?php 
               
        return $html;
    }
}