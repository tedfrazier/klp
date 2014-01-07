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
// No direct access.
defined('_JEXEC') or die;
jimport('joomla.application.component.modelform');
jimport('joomla.event.dispatcher');
/**
 * Jm_video_galleries model.
 */
class Jm_video_galleriesModelVideo extends JModelForm
{
    var $_item = null;
	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	protected function populateState()
	{
		$app = JFactory::getApplication('com_jm_video_galleries');
		// Load state from the request userState on edit or from the passed variable on default
        if (JFactory::getApplication()->input->get('layout') == 'edit') {
            $id = JFactory::getApplication()->getUserState('com_jm_video_galleries.edit.video.id');
        } else {
            $id = JFactory::getApplication()->input->get('id');
            JFactory::getApplication()->setUserState('com_jm_video_galleries.edit.video.id', $id);
        }
		$this->setState('video.id', $id);
		$id = JRequest::getVar('id');
		if(empty($id)){
			$menu = &JSite::getMenu();
			$menuItem = $menu->getActive();
			$item = $menu->getItem($menuItem->id);
			$id = $item->params->get('item_id');
			$id = JRequest::setVar('id', $id);
		}
		// Load the parameters.
		/*
		$menu = &JSite::getMenu();
		$menuItem = $menu->getActive();
		$item = $menu->getItem($menuItem->id);
		if($item->params->get('item_id')){
            $this->setState('video.id', $item->params->get('item_id'));
        }
		*/
		$this->setState('params', $item->params);
	}
	/**
	 * Method to get an ojbect.
	 *
	 * @param	integer	The id of the object to get.
	 *
	 * @return	mixed	Object on success, false on failure.
	 */
	public function &getData($id = null)
	{
		if ($this->_item === null)
		{
			$this->_item = false;
			if (empty($id)) {
				$id = JRequest::getVar('id');//$this->getState('video.id');
			}
			// Get a level row instance.
			$table = $this->getTable();
			// Attempt to load the row.
			if ($table->load($id))
			{
				// Check published state.
				if ($published = $this->getState('filter.published'))
				{
					if ($table->state != $published) {
						return $this->_item;
					}
				}
				// Convert the JTable to a clean JObject.
				$properties = $table->getProperties(1);
				$this->_item = JArrayHelper::toObject($properties, 'JObject');
			} elseif ($error = $table->getError()) {
				$this->setError($error);
			}
		}
		return $this->_item;
	}
	public function getTable($type = 'Video', $prefix = 'Jm_video_galleriesTable', $config = array())
	{   
        $this->addTablePath(JPATH_COMPONENT_ADMINISTRATOR.'/tables');
        return JTable::getInstance($type, $prefix, $config);
	}     
	/**
	 * Method to check in an item.
	 *
	 * @param	integer		The id of the row to check out.
	 * @return	boolean		True on success, false on failure.
	 * @since	1.6
	 */
	public function checkin($id = null)
	{
		// Get the id.
		$id = (!empty($id)) ? $id : (int)$this->getState('video.id');
		if ($id) {
			// Initialise the table
			$table = $this->getTable();
			// Attempt to check the row in.
            if (method_exists($table, 'checkin')) {
                if (!$table->checkin($id)) {
                    $this->setError($table->getError());
                    return false;
                }
            }
		}
		return true;
	}
	/**
	 * Method to check out an item for editing.
	 *
	 * @param	integer		The id of the row to check out.
	 * @return	boolean		True on success, false on failure.
	 * @since	1.6
	 */
	public function checkout($id = null)
	{
		// Get the user id.
		$id = (!empty($id)) ? $id : (int)$this->getState('video.id');
		if ($id) {
			// Initialise the table
			$table = $this->getTable();
			// Get the current user object.
			$user = JFactory::getUser();
			// Attempt to check the row out.
            if (method_exists($table, 'checkout')) {
                if (!$table->checkout($user->get('id'), $id)) {
                    $this->setError($table->getError());
                    return false;
                }
            }
		}
		return true;
	}    
	/**
	 * Method to get the profile form.
	 *
	 * The base form is loaded from XML 
     * 
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_jm_video_galleries.video', 'video', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		$data = $this->getData(); 
        return $data;
	}
	/**
	 * Method to save the form data.
	 *
	 * @param	array		The form data.
	 * @return	mixed		The user id on success, false on failure.
	 * @since	1.6
	 */
	public function save($data)
	{
		$id = (!empty($data['id'])) ? $data['id'] : (int)$this->getState('video.id');
        $state = (!empty($data['state'])) ? 1 : 0;
        $user = JFactory::getUser();
        if($id) {
            //Check the user can edit this item
            $authorised = $user->authorise('core.edit', 'com_jm_video_galleries') || $authorised = $user->authorise('core.edit.own', 'com_jm_video_galleries');
            if($user->authorise('core.edit.state', 'com_jm_video_galleries') !== true && $state == 1){ //The user cannot edit the state of the item.
                $data['state'] = 0;
            }
        } else {
            //Check the user can create new items in this section
            $authorised = $user->authorise('core.create', 'com_jm_video_galleries');
            if($user->authorise('core.edit.state', 'com_jm_video_galleries') !== true && $state == 1){ //The user cannot edit the state of the item.
                $data['state'] = 0;
            }
        }
        if ($authorised !== true) {
            JError::raiseError(403, JText::_('JERROR_ALERTNOAUTHOR'));
            return false;
        }
        $table = $this->getTable();
        if ($table->save($data) === true) {
            return $id;
        } else {
            return false;
        }
	}
     function delete($data)
    {
        $id = (!empty($data['id'])) ? $data['id'] : (int)$this->getState('video.id');
        if(JFactory::getUser()->authorise('core.delete', 'com_jm_video_galleries') !== true){
            JError::raiseError(403, JText::_('JERROR_ALERTNOAUTHOR'));
            return false;
        }
        $table = $this->getTable();
        if ($table->delete($data['id']) === true) {
            return $id;
        } else {
            return false;
        }
        return true;
    }
    function getCategoryName($id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query 
            ->select('title')
            ->from('#__categories')
            ->where('id = ' . $id);
        $db->setQuery($query);
        return $db->loadObject();
    }
	function getAlias($id){
		$db = JFactory::getDBo();
		$query = "SELECT alias FROM #__jmvg_videos WHERE id={$id}";
		$db->setQuery($query);
		$result = $db->loadResult();
		return $result;
	}
	
	function getPrevItems($cat_ids,$odering){
		$db = $this->getDbo();
        $query = $db->getQuery(true);
		$where = null;
		$query->select('*');
		$query->from('#__jmvg_videos');
		if($cat_ids){
			foreach($cat_ids as $cat){
				if(empty($where)){
					$where.= "cat_ids LIKE '%,{$cat}' OR cat_ids LIKE '{$cat},%' OR cat_ids LIKE '%,{$cat},%' OR `cat_ids` LIKE '{$cat}' ";
				}else{
					$where.= "OR cat_ids LIKE '%,{$cat}' OR cat_ids LIKE '{$cat},%' OR cat_ids LIKE '%,{$cat},%' OR `cat_ids` LIKE '{$cat}' ";
				}
			}
		}
		if(empty($where)) $where = 1;
		$query->where('('.$where.')');
		$query->where('state = 1');
		$query->where('ordering <'.$odering);
		$query->order('ordering DESC');
		$db->setQuery($query,0,1);
		return $db->loadObject();
	}
	
	function getNextItems($cat_ids,$odering){
		$db = $this->getDbo();
        $query = $db->getQuery(true);
		$where = null;
		$query->select('*');
		$query->from('#__jmvg_videos');
		if($cat_ids){
			foreach($cat_ids as $cat){
				if(empty($where)){
					$where.= "cat_ids LIKE '%,{$cat}' OR cat_ids LIKE '{$cat},%' OR cat_ids LIKE '%,{$cat},%' OR `cat_ids` LIKE '{$cat}' ";
				}else{
					$where.= "OR cat_ids LIKE '%,{$cat}' OR cat_ids LIKE '{$cat},%' OR cat_ids LIKE '%,{$cat},%' OR `cat_ids` LIKE '{$cat}' ";
				}
			}
		}
		if(empty($where)) $where = 1;
		$query->where('('.$where.')');
		$query->where('state = 1');
		$query->where('ordering >'.$odering);
		$query->order('ordering ASC');
		$db->setQuery($query,0,1);
		return $db->loadObject();
	}
}
?>