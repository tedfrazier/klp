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
class Jm_video_galleriesModelvideos extends JModelList
{
    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                                'id', 'a.id',
                'title', 'a.title',
                'video_type', 'a.video_type',
                'url', 'a.url',
                'image', 'a.image',
                'description', 'a.description',
                'ordering', 'a.ordering',
                'state', 'a.state',
                'created_by', 'a.created_by',
                'cat_ids', 'a.cat_ids',
            );
        }
        parent::__construct($config);
    }
	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');
		// Load the filter state.
		$search = $app->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
		$published = $app->getUserStateFromRequest($this->context.'.filter.state', 'filter_published', '', 'string');
		$this->setState('filter.state', $published);
		//Filtering video_type
		$this->setState('filter.video_type', $app->getUserStateFromRequest($this->context.'.filter.video_type', 'filter_video_type', '', 'string'));
		//Filtering cat_ids
		$this->setState('filter.cat_ids', $app->getUserStateFromRequest($this->context.'.filter.cat_ids', 'filter_cat_ids', '', 'string'));
		// Load the parameters.
		$params = JComponentHelper::getParams('com_jm_video_galleries');
		$this->setState('params', $params);
		// List state information.
		parent::populateState('a.title', 'asc');
	}
	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param	string		$id	A prefix for the store id.
	 * @return	string		A store id.
	 * @since	1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id.= ':' . $this->getState('filter.search');
		$id.= ':' . $this->getState('filter.state');
		return parent::getStoreId($id);
	}
	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return	JDatabaseQuery
	 * @since	1.6
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.*'
			)
		);
		$query->from('`#__jmvg_videos` AS a');
    // Join over the users for the checked out user.
    $query->select('uc.name AS editor');
    $query->join('LEFT', '#__users AS uc ON uc.id=a.checked_out');
		// Join over the user field 'created_by'
		$query->select('created_by.name AS created_by');
		$query->join('LEFT', '#__users AS created_by ON created_by.id = a.created_by');
		// Join over the foreign key 'cat_ids'
		$query->select('#__jmvg_videos_588754.title AS videos_title_588754');
		$query->join('LEFT', '#__jmvg_categories AS #__jmvg_videos_588754 ON #__jmvg_videos_588754.id = a.cat_ids');
    // Filter by published state
    $published = $this->getState('filter.state');
    if (is_numeric($published)) {
        $query->where('a.state = '.(int) $published);
    } else if ($published === '') {
        $query->where('(a.state IN (0, 1))');
    }
		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->escape($search, true).'%');
                $query->where('( a.title LIKE '.$search.'  OR  a.video_type LIKE '.$search.' )');
			}
		}
		//Filtering video_type
		$filter_video_type = $this->state->get("filter.video_type");
		if ($filter_video_type) {
			$query->where("a.video_type = '".$db->escape($filter_video_type)."'");
		}
		//Filtering cat_ids
		$filter_cat_ids = $this->state->get("filter.cat_ids");
		if ($filter_cat_ids) {
			$query->where("a.cat_ids REGEXP ',?".$db->escape($filter_cat_ids).",?'");
		}        
		// Add the list ordering clause.
        $orderCol	= $this->state->get('list.ordering');
        $orderDirn	= $this->state->get('list.direction');
        if ($orderCol && $orderDirn) {
            $query->order($db->escape($orderCol.' '.$orderDirn));
        }
		return $query;
	}
}
