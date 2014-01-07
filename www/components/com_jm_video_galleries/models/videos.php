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
defined('_JEXEC') or die;
jimport('joomla.application.component.modellist');
/**
 * Methods supporting a list of Jm_video_galleries records.
 */
class Jm_video_galleriesModelVideos extends JModelList {
    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array()) {
        parent::__construct($config);
    }
    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since	1.6
     */
	var $_pagination = null;
    
    function getPagination(){
        if (empty($this->_pagination)) {
                jimport('joomla.html.pagination');
                $this->_pagination = new JPagination($this->getTotal(), $this->getState('list.start'), $this->getState('list.limit') );
        }
        return $this->_pagination;
    }
	
	function getTotal(){
		$app = JFactory::getApplication();
        $params = $app->getParams('com_jm_video_galleries');
		$cat_ids=$params->get('cat_ids',null);
		$ordering = $params->get('ordering','asc');
		require_once JPATH_SITE . '/components/com_jm_video_galleries/helpers/jm_video_galleries.php';
		$items = Jm_video_galleriesHelper::getVideos($cat_ids,$ordering);
		return count($items);
	}
	
    protected function populateState($ordering = null, $direction = null) {
        // Initialise variables.
        $app = JFactory::getApplication();
        // List state information
        $limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'));
        $this->setState('list.limit', $limit);
        $limitstart = JFactory::getApplication()->input->getInt('limitstart', 0);
        $this->setState('list.start', $limitstart);
		if(empty($ordering)) {
			$ordering = 'a.ordering';
		}
        // List state information.
        parent::populateState($ordering, $direction);
    }
    /**
     * Build an SQL query to load the list data.
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    protected function getListQuery() {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        // Select the required fields from the table.
        $query->select(
                $this->getState(
                        'list.select', 'a.*'
                )
        );
        $query->from('`#__jmvg_videos` AS a');
    // Join over the users for the checked out user.
    $query->select('uc.name AS editor');
    $query->join('LEFT', '#__users AS uc ON uc.id=a.checked_out');
		// Join over the created by field 'created_by'
		$query->select('created_by.name AS created_by');
		$query->join('LEFT', '#__users AS created_by ON created_by.id = a.created_by');
		// Join over the foreign key 'cat_ids'
		$query->select('#__jmvg_videos_588754.title AS videos_title_588754');
		$query->join('LEFT', '#__jmvg_videos AS #__jmvg_videos_588754 ON #__jmvg_videos_588754.id = a.cat_ids');
		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->escape($search, true).'%');
                $query->where('( a.title LIKE '.$search.' )');
			}
		}
		//Filtering video_type
		$filter_video_type = $this->state->get("filter.video_type");
		if ($filter_video_type) {
			$query->where("a.video_type = '".$filter_video_type."'");
		}
		//Filtering cat_ids
		$filter_cat_ids = $this->state->get("filter.cat_ids");
		if ($filter_cat_ids) {
			$query->where("a.cat_ids = '".$filter_cat_ids."'");
		}
        return $query;
    }
}
