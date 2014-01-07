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
defined('JPATH_PLATFORM') or die;
JHTML::_('behavior.tooltip');

jimport('joomla.form.formfield');

class JFormFieldMarkers extends JFormField{
    protected $type = 'markers';
    
    protected static $initialisedMedia = false;
    
    protected function getLabel(){
    	return '';
    	
    } 
    protected function  getInput() {
    	
      $checkJqueryLoaded = false;
      $document = JFactory::getDocument();
      $header = $document->getHeadData();
      foreach ($header['scripts'] as $scriptName => $scriptData) {
          if (substr_count($scriptName, '/jquery')) {
                $checkJqueryLoaded = true;
          }
      }
	  
	  if(version_compare(JVERSION, '3.0', 'ge')){
		$document->addStyleDeclaration(
			'.jmg-icon-marker .button2-left, .jmg-shadow-marker .button2-left{float: left; margin: 0 5px;} '.
			'#jmg-submit-btn{padding: 0px !important; margin-top: 10px;}'.
			'#jmg-markers-container{ margin-left: 0px !important; } '.
			'#jmg-markers-container li {padding: 7px 7px 8px !important; list-style: none;} '
		);
	  }
	  
      $moduleID = $this->form->getValue('id');
        if ($moduleID == '')
            $moduleID = 0;
      // for maker field
        $html =
                ' <div id="jmg-message" class="clearfix" style="clear:both;"></div>'
                . '    <ul id="jmg-warning"></ul>'
                . '<ul id="jm-makers">'
                . '		<li id="jmg-main-button">'
                . '     	<label>&nbsp;</label>'
                . '     	<button id="btnAddMarker" versionjl="'.(int)JVERSION.'" class="jmt-green-btn" versionjl="'.JVERSION.'" baseurl=" '.JURI::root().'">' . JText::_('MOD_JMGOOGLEMAPS_ADD_MARKER_LABEL') . '</button>'
                . '     	<button id="btnDeleteAll" class="jmt-red-btn">' . JText::_('MOD_JMGOOGLEMAPS_DELETE_ALL_MARKER_LABEL') . '</button>'
                . '		</li>'
                . '		<li id="marker-form">&nbsp;</li>'
                . '		<li >'
                . '			<div class="jmg-head">' . JText::_('MARKER_LIST') . '</div>'
                . '			<input id="jmg-hidden" type="hidden" name="' . $this->name . '" value="' . $this->value . '" />'
                . '  		<ul id="jmg-markers-container" class="clearfix adminformlist"></ul>'
                . '		</li>'
                . '</ul>';
                
      /**
       * for media field
       * 
       */
      # create script
   		$assetField = $this->element['asset_field'] ? (string) $this->element['asset_field'] : 'asset_id';
		$authorField = $this->element['created_by_field'] ? (string) $this->element['created_by_field'] : 'created_by';
		$asset = $this->form->getValue($assetField) ? $this->form->getValue($assetField) : (string) $this->element['asset_id'];
		if ($asset == '')
		{
			$asset = JRequest::getCmd('option');
		}

		if (!self::$initialisedMedia)
		{

			// Load the modal behavior script.
			JHtml::_('behavior.modal');

			// Build the script.
			$script = array();
			$script[] = '	function jInsertFieldValue(value, id) {';
			$script[] = '		var old_value = document.id(id).value;';
			$script[] = '		if (old_value != value) {';
			$script[] = '			var elem = document.id(id);';
			$script[] = '			elem.value = value;';
			$script[] = '			elem.fireEvent("change");';
			$script[] = '			if (typeof(elem.onchange) === "function") {';
			$script[] = '				elem.onchange();';
			$script[] = '			}';
			$script[] = '			jmMediaRefreshPreview(id);';
			$script[] = '		}';
			$script[] = '	}';

			$script[] = '	function jmMediaRefreshPreview(id) {';
			$script[] = '		var value = document.id(id).value;';
			$script[] = '		var img = document.id(id + "_preview");';
			$script[] = '		if (img) {';
			$script[] = '			if (value) {';
			$script[] = '				img.src = "' . JURI::root() . '" + value;';
			$script[] = '				document.id(id + "_preview_empty").setStyle("display", "none");';
			$script[] = '				document.id(id + "_preview_img").setStyle("display", "");';
			$script[] = '			} else { ';
			$script[] = '				img.src = ""';
			$script[] = '				document.id(id + "_preview_empty").setStyle("display", "");';
			$script[] = '				document.id(id + "_preview_img").setStyle("display", "none");';
			$script[] = '			} ';
			$script[] = '		} ';
			$script[] = '	}';

			$script[] = '	function jmMediaRefreshPreviewTip(tip)';
			$script[] = '	{';
			$script[] = '		tip.setStyle("display", "block");';
			$script[] = '		var img = tip.getElement("img.media-preview");';
			$script[] = '		var id = img.getProperty("id");';
			$script[] = '		id = id.substring(0, id.length - "_preview".length);';
			$script[] = '		jmMediaRefreshPreview(id);';
			$script[] = '	}';

			// Add the script to the document head.
			JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));

			self::$initialisedMedia = true;
		}
		$htmlMediaCode = array('icon'=>'','shadow-image'=>'');
		foreach ($htmlMediaCode as $key => $value){
			#create media html code
			// Initialize variables.
			$htmlMedia = array();
			$attr = '';
	
			// Initialize some field attributes.
			$attr .= 'class="media-marker jm-field jmmedia"';
			//$attr .= $this->element['size'] ? ' size="' . (int) $this->element['size'] . '"' : '';
	
			// Initialize JavaScript field attributes.
			$attr .= $this->element['onchange'] ? ' onchange="' . (string) $this->element['onchange'] . '"' : '';
	
			// The text field.
			if($key =='icon'){
				$htmlMedia[]= '<label class="hasTip" title="'.JText::_('MOD_JMGOOGLEMAPS_ICON_MARKER_DESC').'" for="jmg-'.$key.'" aria-invalid="false">'.JText::_('MOD_JMGOOGLEMAPS_ICON_MARKER_LABEL').'</label>';
			}else{
				$htmlMedia[]= '<label class="hasTip" title="'.JText::_('MOD_JMGOOGLEMAPS_SHADOW_IMAGE_MARKER_DESC').'" for="jmg-'.$key.'" aria-invalid="false">'.JText::_('MOD_JMGOOGLEMAPS_SHADOW_IMAGE_MARKER_LABEL').'</label>';
			}
			$htmlMedia[] = '<div class="fltlft">';
			$htmlMedia[] = '	<input type="text" name="media-google-map['.$key.']" id="jmg-'.$key.'" value="" readonly="readonly" ' . $attr . ' />';
			$htmlMedia[] = '</div>';
	
			// The button.
			$htmlMedia[] = '<div class="button2-left">';
			$htmlMedia[] = '	<div class="blank">';
			$htmlMedia[] = '		<a class="modal"'
									 .'title="' . JText::_('JLIB_FORM_BUTTON_SELECT') . '"' 
									 . ' href="index.php?option=com_media&amp;view=images&amp;tmpl=component&amp;asset=' . $asset . '&amp;fieldid=jmg-'.$key. '&amp;folder=' . '"'
									 . ' rel="{handler: &apos;iframe&apos;, size: {x: 800, y: 500}}">';
			$htmlMedia[] = JText::_('JLIB_FORM_BUTTON_SELECT') . '</a>';
			$htmlMedia[] = '	</div>';
			$htmlMedia[] = '</div>';
	
			$htmlMedia[] = '<div class="button2-left">';
			$htmlMedia[] = '	<div class="blank">';
			$htmlMedia[] = '		<a title="' . JText::_('JLIB_FORM_BUTTON_CLEAR') . '"' . ' href="#" onclick="';
			$htmlMedia[] = 'jInsertFieldValue(&apos;&apos;, &apos;jmg-' . $key . '&apos;);';
			$htmlMedia[] = 'return false;';
			$htmlMedia[] = '">';
			$htmlMedia[] = JText::_('JLIB_FORM_BUTTON_CLEAR') . '</a>';
			$htmlMedia[] = '	</div>';
			$htmlMedia[] = '</div>';
	
 			$preview = '';
			$showPreview = true;
			$showAsTooltip = false;
			switch ($preview)
			{
				case 'false':
				case 'none':
					$showPreview = false;
					break;
				case 'true':
				case 'show':
					break;
				case 'tooltip':
				default:
					$showAsTooltip = true;
					$options = array(
						'onShow' => 'jMediaRefreshPreviewTip',
					);
					JHtml::_('behavior.tooltip', '.hasTipPreview', $options);
					break;
			}
	
			if ($showPreview)
			{
				$src = '';
				$attr = array(
					'id' => 'jmg-'.$key . '_preview',
					'class' => 'media-preview',
					'style' => 'max-width:200px; max-height:30px;'
				);
				$img = JHtml::image($src, JText::_('JLIB_FORM_MEDIA_PREVIEW_ALT'), $attr);
				$previewImg = '<div id="jmg-' . $key . '_preview_img"' . ($src ? '' : ' style="display:none"') . '>' . $img . '</div>';
				$previewImgEmpty = '<div id="jmg-' .$key  . '_preview_empty"' . ($src ? ' style="display:none"' : '') . '>'
					. JText::_('JLIB_FORM_MEDIA_PREVIEW_EMPTY') . '</div>';
	
				$htmlMedia[] = '<div class="media-preview media-marker-preview fltlft">';
				
					//$htmlMedia[] = ' ' . $previewImgEmpty;
					//$htmlMedia[] = ' ' . $previewImg; 
					
					$tooltip = $previewImgEmpty . $previewImg;
					$options = array(
					'title' => JText::_('JLIB_FORM_MEDIA_PREVIEW_SELECTED_IMAGE'),
					'text' => JText::_('JLIB_FORM_MEDIA_PREVIEW_TIP_TITLE'),
					'class' => 'hasTipPreview'
					);
					$htmlMedia[] = JHtml::tooltip($tooltip, $options);
				$htmlMedia[] = '</div>';
			}
	
			$htmlMediaCode[$key] = implode("'\n+'", $htmlMedia);    
		}      
      #end setup to create media field
      ?>
       <script type="text/javascript">
        	var dialogHtml =  '<form id="jmg-form-marker"><div class= "jmg-messages" id="jmg-messages" class="clearfix"></div>'
                + '<ul class="jmg-dialog-container">'
                + '     <li class="marker-title">'
                + '         <label for="jmg-marker-title" title="<?php echo JText::_('MOD_JMGOOGLEMAPS_MARKER_TITLE_DESC') ?>"><?php echo JText::_('MOD_JMGOOGLEMAPS_MARKER_TITLE_LABEL') ?></label>'
                + '         <input class="jm-field" type="text" name="jmg-marker-title" id="jmg-marker-title"/>'
				+ '			<div style="clear:both;"></div>'
                + '     </li>'
                + '     <li>'
                + '         <label for="jmg-maker-type" class="hasTip" title="<?php echo JText::_('MOD_JMGOOGLEMAPS_TYPE_MARKER_DESC') ?>"><?php echo JText::_('MOD_JMGOOGLEMAPS_TYPE_MARKER_LABEL') ?></label>'
                + '         <select class="jm-field single jm-fieldsingle"  name="jmg-marker-type" id="jmg-marker-type">'
                + '             <option value="address">Address</option>'
                + '             <option value="coordinate">Coordinate</option>'
                + '         </select>'
				+ '			<div style="clear:both;"></div>'
                + '     </li>'
                + '     <li class="jmg-optional address">'
                + '     <label for="jmg-marker-address" title ="<?php echo JText::_('MOD_JMGOOGLEMAPS_ADDRESS_MARKER_DESC') ?>"><?php echo JText::_('MOD_JMGOOGLEMAPS_ADDRESS_MARKER_LABEL') ?></label>'
                + '         <input class="jm-field" type="text" name="jmg-marker-address" id="jmg-marker-address"/>'
				+ '			<div style="clear:both;"></div>'
                + '     </li>'
                + '     <li class="jmg-optional coordinate">'
                + '     <label for="jmg-marker-coordinate" title ="<?php echo JText::_('MOD_JMGOOGLEMAPS_COORDINATE_DESC') ?>"><?php echo JText::_('MOD_JMGOOGLEMAPS_COORDINATE_LABEL') ?></label>'
                + '         <input class="jm-field" type="text" name="jmg-marker-coordinate" id="jmg-marker-coordinate"/>'
				+ '			<div style="clear:both;"></div>'
                + '     </li>'
                + '     <li class="jmg-icon-marker">'
                + '		<?php echo $htmlMediaCode['icon'];?> '
				+ '			<div style="clear:both;"></div>'
                + '     </li>'
                + '     <li class="jmg-shadow-marker">'
                + '		<?php echo $htmlMediaCode['shadow-image'];?>'
				+ '			<div style="clear:both;"></div>'
                + '     </li>'
                + '     <li>'
                + '         <label for="jmg-maker-showInfoOnload"  title="<?php echo JText::_('MOD_JMGOOGLEMAPS_SHOWINFO_ONLOAD_DESC') ?>"><?php echo JText::_('MOD_JMGOOGLEMAPS_SHOWINFO_ONLOAD_LABEL') ?></label>'
                + '         <select name="jmg-marker-showInfoOnload" class="jm-field single jm-fieldsingle chzn-done" id="jmg-marker-showInfoOnload">'
                + '             <option value="1">Yes</option>'
                + '             <option value="0">No</option>'
                + '         </select>'
                + '     </li>'
                + '     <li class="jmg-infowindow">'
                + '     <label for="jmg-infowindow" title ="<?php echo JText::_('MOD_JMGOOGLEMAPS_INFO_WINDOW_DESC') ?>"><?php echo JText::_('MOD_JMGOOGLEMAPS_INFO_WINDOW_LABEL') ?></label>'
                + '         <textarea class="jm-field" type="text" name="jmg-infowindow" id="jmg-infowindow"></textarea>'
				+ '			<div style="clear:both;"></div>'
                + '     </li>'
                + '     <li id="jmg-submit-btn">'
                + '         <button id="btnCreateMarker" class="jmg-green-btn jmg-panel-btn"><?php echo JText::_('MOD_JMGOOGLEMAPS_BUTTON_CREATE_MARKER') ?></button>'
                + '         <button id="btnUpdateMarker" class="jmg-green-btn jmg-panel-btn"><?php echo JText::_('MOD_JMGOOGLEMAPS_BUTTON_UPDATE_MARKER') ?></button>'
                + '         <button id="btnCancel" class="jmg-red-btn jmg-panel-btn"><?php echo JText::_('MOD_JMGOOGLEMAPS_BUTTON_CANCEL') ?></button>'
                + '     </li>'
                + '</ul>'
                + '<div style="clear:both;"></div>'
                + '</form>'
                + '<script type="text/javascript">'
                + 'window.addEvent("domready", function() {'
		    	+ '		SqueezeBox.initialize({});'
    			+ '		SqueezeBox.assign($$("a.modal"), {'
    			+ '			parse: "rel"'
    			+ '		});'
    			+ '});'
    			+ '<\/script>';
                
                var jQ = jQuery.noConflict();
                
                jQ(document).ready(function(){
                      
                    //init form preview
                    var markerList = new JM.MarkerList({
                        liveURL : '<?php echo JURI::root() . 'modules/mod_jmgooglemaps' ?>',
                        warningText: {
                            tabTitleRequired: '<?php echo JText::_('MARKER_TITLE_REQUIRED') ?>',
                            tabValueRequired: '<?php echo JText::_('MARKER_POSITION_REQUIRED') ?>',
                            addMarkerSuccess: '<?php echo JText::_('ADD_MARKER_SUCCESS') ?>',
                            updateMarkerSuccess: '<?php echo JText::_('UPDATE_MARKER_SUCCESS') ?>',
                            confirmDeleteAll: '<?php echo JText::_('CONFIRM_DELETE_ALL') ?>',
                            confirmDelete: '<?php echo JText::_('CONFIRM_DELETE') ?>',
                            deleteAllSuccess: '<?php echo JText::_('DELETE_ALL_SUCCESS') ?>'
                        },
                        dialogTemplate: dialogHtml,
                        encodedItems : '<?php echo $this->value ?>',
                        moduleID: '<?php echo $moduleID ?>',
                        container: 'jmg-markers-container',
                        messageContainer: 'jmg-warning',
                        btnCreateID: '#btnCreateMarker',
                        btnUpdateID: '#btnUpdateMarker',
                        btnCancelID: '#btnCancel'

                    });
                                    
                    /**
                     * Open marker options when click add marker
                     * 
                     */
                    jQ("#btnAddMarker").click(function(){
                        markerList.openDialog();
						var versionjl = jQuery('#btnAddMarker').attr('versionjl');
						if(versionjl<3){
							jQ('#jmg-marker-type,#jmg-marker-showInfoOnload').jmSelectSingle();
							jQ('#jmg-icon,#jmg-shadow-image').jmMedia();
						}
						tips();
                        return false;
                    });
					
                    /**
                     * Close all options when click cancel
                     */

                    //remove all
                    jQ('#btnDeleteAll').click(function(){
                        if(jQ('#jmg-markers-container li').length > 0 )
                            markerList.removeAll();
                        return false;
                    });
                });
				function preview_image(){
					jQ(".media-marker-preview").hover(function(){
						jQ(this).find('img.media-preview').fadeIn(100);
                    },function(){
						jQ(this).find('img.media-preview').fadeOut(100);
					});
				}
				
				function tips(){
					$$('.hasTipPreview').each(function(el) {
					var title = el.get('title');
					if (title) {
						var parts = title.split('::', 2);
						el.store('tip:title', parts[0]);
						el.store('tip:text', parts[1]);
					}
					});
					var JTooltips = new Tips($$('.hasTipPreview'), { maxTitleChars: 50, fixed: false, onShow: jmMediaRefreshPreviewTip});
			
				}


      </script>          
      <?php   
        return $html;
    }
}