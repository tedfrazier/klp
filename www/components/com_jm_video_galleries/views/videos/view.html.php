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
 * View class for a list of Jm_video_galleries.
 */
class Jm_video_galleriesViewVideos extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;
    protected $params;
	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
        $app                = JFactory::getApplication();   
        $this->params       = $app->getParams('com_jm_video_galleries');
		$cat_ids=$this->params->get('cat_ids',null);
		$model = $this->getModel('Videos');
		$this->video_lightbox = $this->params->get('video_lightbox',0);
		$this->autoplay_video = $this->params->get('autoplay_video',0);
		$this->col = $this->params->get('columns',3);
		$this->ordering = $this->params->get('ordering','asc');
		$this->show_description = $this->params->get('show_description',0);
		$this->description_length = $this->params->get('description_length',0);
		if(count($cat_ids)){
			require_once JPATH_SITE . '/components/com_jm_video_galleries/helpers/jm_video_galleries.php';
			$this->items = Jm_video_galleriesHelper::getVideos($cat_ids,$this->ordering,$model->getState('list.start'),$model->getState('list.limit'));
			$this->pagination = $this->get('Pagination');
			$this->allVideo=Jm_video_galleriesHelper::getVideosNoLimit($cat_ids,$this->ordering);
			$this->cat_ids=Jm_video_galleriesHelper::getCategories($cat_ids);
			$catIds ='';
			foreach($cat_ids AS $cat){
				$catIds .=$cat.',';
			}$catIds .='@@@';
			$this->catIds = str_replace(",@@@","",$catIds);
		}
        // Check for errors.
        if (count($errors = $this->get('Errors'))) {;
            throw new Exception(implode("\n", $errors));
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
