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

class JFormFieldAdditem extends JFormField{
    protected $type = 'Additem';
    
    protected static $initialisedMedia = false;
    
    protected function getLabel(){
    	return '';
    	
    }
	
	protected function &getEditor()
	{
		// Only create the editor if it is not already created.
		if (empty($this->editor))
		{
			// Initialize variables.
			$editor = null;

			// Get the editor type attribute. Can be in the form of: editor="desired|alternative".
			$type = trim((string) $this->element['editor']);

			if ($type)
			{
				// Get the list of editor types.
				$types = explode('|', $type);

				// Get the database object.
				$db = JFactory::getDBO();

				// Iterate over teh types looking for an existing editor.
				foreach ($types as $element)
				{
					// Build the query.
					$query = $db->getQuery(true);
					$query->select('element');
					$query->from('#__extensions');
					$query->where('element = ' . $db->quote($element));
					$query->where('folder = ' . $db->quote('editors'));
					$query->where('enabled = 1');

					// Check of the editor exists.
					$db->setQuery($query, 0, 1);
					$editor = $db->loadResult();

					// If an editor was found stop looking.
					if ($editor)
					{
						break;
					}
				}
			}

			// Create the JEditor instance based on the given editor.
			$this->editor = JFactory::getEditor($editor ? $editor : null);
		}

		return $this->editor;
	}

	/**
	 * Method to get the JEditor output for an onSave event.
	 *
	 * @return  string  The JEditor object output.
	 *
	 * @since   11.1
	 */
	public function save()
	{
		return $this->getEditor()->save($this->id);
	}
	
	function getInputEditor()
	{
		// Initialize some field attributes.
		$rows = (int) $this->element['rows'];
		$cols = (int) $this->element['cols'];
		$height = ((string) $this->element['height']) ? (string) $this->element['height'] : '250';
		$width = ((string) $this->element['width']) ? (string) $this->element['width'] : '100%';
		$assetField = $this->element['asset_field'] ? (string) $this->element['asset_field'] : 'asset_id';
		$authorField = $this->element['created_by_field'] ? (string) $this->element['created_by_field'] : 'created_by';
		$asset = $this->form->getValue($assetField) ? $this->form->getValue($assetField) : (string) $this->element['asset_id'];

		// Build the buttons array.
		$buttons = (string) $this->element['buttons'];

		if ($buttons == 'true' || $buttons == 'yes' || $buttons == '1')
		{
			$buttons = true;
		}
		elseif ($buttons == 'false' || $buttons == 'no' || $buttons == '0')
		{
			$buttons = false;
		}
		else
		{
			$buttons = explode(',', $buttons);
		}

		$hide = ((string) $this->element['hide']) ? explode(',', (string) $this->element['hide']) : array();

		// Get an editor object.
		$editor = $this->getEditor();

		return $editor
			->display(
			$this->name, htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8'), $width, $height, $cols, $rows,
			$buttons ? (is_array($buttons) ? array_merge($buttons, $hide) : $hide) : false, $this->id, $asset,
			$this->form->getValue($authorField)
		);
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
	  
	  
	  $editors = $this->getInputEditor();
	  
      $moduleID = $this->form->getValue('id');
        if ($moduleID == '')
            $moduleID = 0;
      // for maker field
        $html =
				''
                .' <div id="btg-message" class="clearfix" style="clear:both;"></div>'
                . '    <ul id="btg-warning"></ul>'
                . '<ul id="bt-makers">'
                . '		<li id="btg-main-button">'
                . '     	<label></label>'
                . '     	<button id="btnAddItem" class="btt-green-btn">' . JText::_('Add Item') . '</button>'
                . '     	<button id="btnDeleteAll" class="btt-red-btn">' . JText::_('Delete all') . '</button>'
                . '		</li>'
                . '		<li id="item-form"></li>'
                . '		<li >'
                . '			<div class="btg-head">' . JText::_('List Item') . '</div>'
                . '			<input id="btg-hidden" type="hidden" name="' . $this->name . '" value="' . $this->value . '" />'
                . '  		<ul id="btg-items-container" class="clearfix adminformlist"></ul>'
                . '		</li>'
                . '</ul>'.'<div style="display:none" id="editors_wrap">'.$editors.'</div>';  
     
      ?>
       <script type="text/javascript">
                var jQ = jQuery.noConflict();
                jQ(document).ready(function(){
				var dialogHtml =  '<form id="btg-form-item"><div class= "btg-messages" id="btg-messages" class="clearfix"></div>'
                + '<ul class="btg-dialog-container">'
				+ '     <li class="item-editor">'
				+ '     </li>'
				+ '     <li id="btg-submit-btn">'
                + '         <button id="btnCreateItem" class="btg-green-btn btg-panel-btn"><?php echo JText::_('Create');?></button>'
                + '         <button id="btnUpdateItem" class="btg-green-btn btg-panel-btn"><?php echo JText::_('Update');?></button>'
                + '         <button id="btnCancel" class="btg-red-btn btg-panel-btn"><?php echo JText::_('Cancel');?></button>'
                + '     </li>'
                + '</ul>'
                + '<div style="clear:both;"></div>'
                + '</form>';  
                    //init form preview
                    var itemList = new JM.ItemList({
                        liveURL : '<?php echo JURI::root() . 'modules/mod_jmsocials' ?>',
                        warningText: {
                            tabTitleRequired: '<?php echo JText::_('MOD_JMSOCIALS_TABTITLEREQUIRED_LBL');?>',
                            addItemSuccess: '<?php echo JText::_('MOD_JMSOCIALS_ADDITEMSUCCESS_LBL');?>',
                            updateMarkerSuccess: '<?php echo JText::_('MOD_JMSOCIALS_UPDATEMARKERSUCCESS_LBL');?>',
                            confirmDeleteAll: '<?php echo JText::_('MOD_JMSOCIALS_CONFIRMDELETEALL_LBL');?>',
                            confirmDelete: '<?php echo JText::_('MOD_JMSOCIALS_CONFIRMDELETE_LBL');?>',
                            deleteAllSuccess: '<?php echo JText::_('MOD_JMSOCIALS_DELETEALLSUCCESS_LBL');?>'
                        },
                        dialogTemplate: dialogHtml,
                        encodedItems : '<?php echo $this->value ?>' ,
                        moduleID: '<?php echo $moduleID ?>',
                        container: 'btg-items-container',
                        messageContainer: 'btg-warning',
                        btnCreateID: '#btnCreateItem',
                        btnUpdateID: '#btnUpdateItem',
                        btnCancelID: '#btnCancel'

                    });
                                    
                    /**
                     * Open marker options when click add marker
                     * 
                     */
                    jQ("#btnAddItem").click(function(){
                        itemList.openDialog();
						//jQ('#editors_wrap').appendTo('.item-editor');
						jQ('#editors_wrap').show();
                        return false;
                    });
					
                    /**
                     * Close all options when click cancel
                     */
                    jQ('#btnDeleteAll').click(function(){
                        if(jQ('#btg-items-container li').length > 0 )
                            itemList.removeAll();
                        return false;
                    });
                });


      </script>          
      <?php   
	return $html;
    }
}