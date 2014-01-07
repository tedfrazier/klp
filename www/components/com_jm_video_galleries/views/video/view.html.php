<?php
/**
 * @package     com_jm_video_galleries
 * @version     1.0.0
 * Author - JoomlaMan http://www.joomlaman.com
 * Copyright (C) 2012 - 2013 JoomlaMan.com. All Rights Reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 * Websites: http://www.JoomlaMan.com
 * Support: support@joomlaman.com
*/
// No direct access
defined('_JEXEC') or die;
jimport('joomla.application.component.view');
/**
 * View to edit
 */
class Jm_video_galleriesViewVideo extends JViewLegacy {
    protected $state;
    protected $item;
    protected $form;
    protected $params;
    /**
     * Display the view
     */
    public function display($tpl = null) {
		$app	= JFactory::getApplication();
        $user		= JFactory::getUser();
        $this->state = $this->get('State');
        $this->item = $this->get('Data');
        $this->params = $app->getParams('com_jm_video_galleries');
   		$this->cat_ids=$this->params->get('cat_ids',null);
		$this->autoplay_video=$this->params->get('autoplay_video',0);
		//////////get link& thumb pinterest
		$id = JRequest::getVar('id',0);
		if(empty($id)){
			$menu = &JSite::getMenu();
			$menuItem = $menu->getActive();
			$item = $menu->getItem($menuItem->id);
			$id = $item->params->get('item_id');
		}
		$this->model  = $this->getModel();
		$alias =  $this->model->getAlias($id);
		////////get global config
		$config =JFactory::getConfig();
		if($config->get('sef')){
			$url = '@@@'.JRoute::_('index.php?option=com_jm_video_galleries&view=video&id='.$alias.'-'. (int) $id);
		}else{
			$url = '@@@'.JRoute::_('index.php?option=com_jm_video_galleries&view=video&id='. (int) $id);
		}
		$this->link_replace = str_replace("@@@/","",$url);
		if($this->item->image!=''){ 
			$this->thumb = str_replace("../","",$this->item->image);
		}else{
			$this->thumb = JRoute::_('components/com_jm_video_galleries/assets/images/no-image.png');
		}
		$img =JURI::root().$this->thumb;
        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
        }
        if($this->_layout == 'edit') {
            $authorised = $user->authorise('core.create', 'com_jm_video_galleries');
            if ($authorised !== true) {
                throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
            }
        }
        $this->_prepareDocument();
        parent::display($tpl);
    }
	/**
	 * Prepares the document
	 */
	protected function _prepareDocument()
	{
		$app	= JFactory::getApplication();
		$menus	= $app->getMenu();
		$title	= null;
		// Because the application sets a default page title,
		// we need to get it from the menu item itself
		$menu = $menus->getActive();
		if($menu)
		{
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		} else {
			$this->params->def('page_heading', JText::_('com_jm_video_galleries_DEFAULT_PAGE_TITLE'));
		}
		$title = $this->params->get('page_title', '');
		if (empty($title)) {
			$title = $app->getCfg('sitename');
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 1) {
			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 2) {
			$title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}
		$this->document->setTitle($title);
		if ($this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}
		if ($this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}
		if ($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		}
	}        
}
