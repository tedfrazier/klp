<?php
/* * --------------------------------------------------------------------
  # Package - JoomlaMan Module
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
    protected function  getInput() {
    	
      $checkJqueryLoaded = false;
      $document = JFactory::getDocument();
      $header = $document->getHeadData();
      foreach ($header['scripts'] as $scriptName => $scriptData) {
          if (substr_count($scriptName, '/jquery')) {
                $checkJqueryLoaded = true;
          }
      }
	  
      $moduleID = $this->form->getValue('id');
        if ($moduleID == '')
            $moduleID = 0;
      // for maker field
        $html =
                ' <div id="btg-message" class="clearfix" style="clear:both;"></div>'
                . '    <ul id="btg-warning"></ul>'
                . '<ul id="bt-makers">'
                . '		<li id="btg-main-button">'
                . '     	<label></label>'
                . '     	<button id="btnAddItem" class="btt-green-btn">' . JText::_('MOD_JMSOCIALS_BTN_ADD_ITEM_LBL') . '</button>'
                . '     	<button id="btnDeleteAll" class="btt-red-btn">' . JText::_('MOD_JMSOCIALS_BTN_DELETE_ALL_ITEM_LBL') . '</button>'
                . '		</li>'
                . '		<li id="item-form"></li>'
                . '		<li >'
                . '			<div class="btg-head">' . JText::_('MOD_JMSOCIALS_LIST_ITEM_ITEM_LBL') . '</div>'
                . '			<input id="btg-hidden" type="hidden" name="' . $this->name . '" value="' . $this->value . '" />'
                . '  		<ul id="btg-items-container" class="clearfix adminformlist"></ul>'
                . '		</li>'
                . '</ul>';
     
      ?>
       <script type="text/javascript">
        	var dialogHtml =  '<form id="btg-form-item"><div class= "btg-messages" id="btg-messages" class="clearfix"></div>'
                + '<ul class="btg-dialog-container">'
                + '     <li class="item-type">'
                + '         <label for="btg-item-type"><?php echo JText::_('Type');?></label>'
                + '         <select class="jm-field" type="text" name="btg-item-type" id="btg-item-type">'
                + '         	<option value="Facebook"><?php echo JText::_('Facebook');?></option>'
                + '         	<option value="Twitter"><?php echo JText::_('Twitter');?></option>'
                + '         	<option value="Youtube"><?php echo JText::_('Youtube');?></option>'
                + '         	<option value="Pinterest"><?php echo JText::_('Pinterest');?></option>'
                + '         	<option value="LinkedIn"><?php echo JText::_('LinkedIn');?></option>'
                + '         	<option value="Skype"><?php echo JText::_('Skype');?></option>'
                + '         	<option value="Vimeo"><?php echo JText::_('Vimeo');?></option>'
                + '         	<option value="Flickr"><?php echo JText::_('Flickr');?></option>'
                + '         	<option value="Instagram"><?php echo JText::_('Instagram');?></option>'
                + '         	<option value="Other"><?php echo JText::_('Other');?></option>'
                + '         </select>'
				+ '			<div style="clear:both;"></div>'
                + '     </li>'
				+ '     <li class="item-title">'
                + '         <label for="btg-item-title"><?php echo JText::_('MOD_JMSOCIALS_TITLE_ITEM_LBL');?></label>'
                + '         <input class="jm-field" type="text" name="btg-item-title" id="btg-item-title"/>'
				+ '			<div style="clear:both;"></div>'
                + '     </li>'
				+ '     <li class="item-link">'
                + '         <label for="btg-item-link"><?php echo JText::_('MOD_JMSOCIALS_LINK_ITEM_LBL');?></label>'
                + '         <input class="jm-field" type="text" name="btg-item-link" id="btg-item-link"/>'
				+ '			<div style="clear:both;"></div>'
                + '     </li>'
				+ '     <li class="class-title">'
                + '         <label for="btg-item-class"><?php echo JText::_('MOD_JMSOCIALS_CLASS_ITEM_LBL');?></label>'
                + '         <input class="jm-field" type="text" name="btg-item-class" id="btg-item-class"/>'
				+ '			<div style="clear:both;"></div>'
                + '     </li>'
				+ '     <li id="btg-submit-btn">'
                + '         <button id="btnCreateItem" class="btg-green-btn btg-panel-btn"><?php echo JText::_('MOD_JMSOCIALS_CREATE_ITEM_LBL');?></button>'
                + '         <button id="btnUpdateItem" class="btg-green-btn btg-panel-btn"><?php echo JText::_('MOD_JMSOCIALS_UPDATE_ITEM_ITEM_LBL');?></button>'
                + '         <button id="btnCancel" class="btg-red-btn btg-panel-btn"><?php echo JText::_('MOD_JMSOCIALS_CANCEL_LBL');?></button>'
                + '     </li>'
                + '</ul>'
                + '<div style="clear:both;"></div>'
                + '</form>';
                
                var jQ = jQuery.noConflict();
                
                jQ(document).ready(function(){
                      
                    //init form preview
                    var itemList = new JM.ItemList({
                        liveURL : '<?php echo JURI::root() . 'modules/mod_jmsocials' ?>',
                        warningText: {
                            tabTitleRequired: '<?php echo JText::_('MOD_JMSOCIALS_TABTITLEREQUIRED_LBL');?>',
                            addItemSuccess: '<?php echo JText::_('MOD_JMSOCIALS_ADDITEMSUCCESS_LBL');?>',
                            updateItemSuccess: '<?php echo JText::_('MOD_JMSOCIALS_UPDATEMARKERSUCCESS_LBL');?>',
                            confirmDeleteAll: '<?php echo JText::_('MOD_JMSOCIALS_CONFIRMDELETEALL_LBL');?>',
                            confirmDelete: '<?php echo JText::_('MOD_JMSOCIALS_CONFIRMDELETE_LBL');?>',
                            deleteAllSuccess: '<?php echo JText::_('MOD_JMSOCIALS_DELETEALLSUCCESS_LBL');?>'
                        },
                        dialogTemplate: dialogHtml,
                        encodedItems : '<?php echo $this->value ?>',
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
												<?php
													jimport('joomla.version');
													$version = new JVersion();
													$joomla_version = (int) JVERSION; 
													if($joomla_version < 3):
												?>
												jQ('#btg-dialog select.jm-field').jmSelectSingle();
												<?php endif;?>
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