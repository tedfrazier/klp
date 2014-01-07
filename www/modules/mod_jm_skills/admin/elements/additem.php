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
                . '     	<button id="btnAddItem" class="btt-green-btn">' . JText::_('MOD_JM_SKILLS_BTN_ADD_ITEM_LBL') . '</button>'
                . '     	<button id="btnDeleteAll" class="btt-red-btn">' . JText::_('MOD_JM_SKILLS_BTN_DELETE_ALL_ITEM_LBL') . '</button>'
                . '		</li>'
                . '		<li id="item-form"></li>'
                . '		<li >'
                . '			<div class="btg-head">' . JText::_('MOD_JM_SKILLS_LIST_ITEM_ITEM_LBL') . '</div>'
                . '			<input id="btg-hidden" type="hidden" name="' . $this->name . '" value="' . $this->value . '" />'
                . '  		<ul id="btg-items-container" class="clearfix adminformlist"></ul>'
                . '		</li>'
                . '</ul>';
     
      ?>
       <script type="text/javascript">
        	var dialogHtml =  '<form id="btg-form-item"><div class= "btg-messages" id="btg-messages" class="clearfix"></div>'
                + '<ul class="btg-dialog-container">'
				+ '     <li class="item-title">'
                + '         <label for="btg-item-title"><?php echo JText::_('MOD_JM_SKILLS_TITLE_ITEM_LBL');?></label>'
                + '         <input class="jm-field" type="text" name="btg-item-title" id="btg-item-title"/>'
				+ '			<div style="clear:both;"></div>'
                + '     </li>'
				+ '     <li class="item-percent">'
                + '         <label for="btg-item-percent"><?php echo JText::_('MOD_JM_SKILLS_PERCENT_TITLE');?></label>'
                + '         <input class="jm-field" type="text" name="btg-item-percent" id="btg-item-percent"/>'
				+ '			<div style="clear:both;"></div>'
                + '     </li>'
				+ '     <li id="btg-submit-btn">'
                + '         <button id="btnCreateItem" class="btg-green-btn btg-panel-btn"><?php echo JText::_('MOD_JM_SKILLS_CREATE_ITEM_LBL');?></button>'
                + '         <button id="btnUpdateItem" class="btg-green-btn btg-panel-btn"><?php echo JText::_('MOD_JM_SKILLS_UPDATE_ITEM_ITEM_LBL');?></button>'
                + '         <button id="btnCancel" class="btg-red-btn btg-panel-btn"><?php echo JText::_('MOD_JM_SKILLS_CANCEL_LBL');?></button>'
                + '     </li>'
                + '</ul>'
                + '<div style="clear:both;"></div>'
                + '</form>';
                
                var jQ = jQuery.noConflict();
                
                jQ(document).ready(function(){
                      
                    //init form preview
                    var itemList = new JM.ItemList({
                        liveURL : '<?php echo JURI::root() . 'modules/jm_skill' ?>',
                        warningText: {
                            tabTitleRequired: '<?php echo JText::_('MOD_JM_SKILLS_TABTITLEREQUIRED_LBL');?>',
                            addItemSuccess: '<?php echo JText::_('MOD_JM_SKILLS_ADDITEMSUCCESS_LBL');?>',
                            updateItemSuccess: '<?php echo JText::_('MOD_JM_SKILLS_UPDATEMARKERSUCCESS_LBL');?>',
                            confirmDeleteAll: '<?php echo JText::_('MOD_JM_SKILLS_CONFIRMDELETEALL_LBL');?>',
                            confirmDelete: '<?php echo JText::_('MOD_JM_SKILLS_CONFIRMDELETE_LBL');?>',
                            deleteAllSuccess: '<?php echo JText::_('MOD_JM_SKILLS_DELETEALLSUCCESS_LBL');?>'
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