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
jimport('joomla.application.component.controlleradmin');
/**
 * Categories list controller class.
 */
class Jm_video_galleriesControllerCategories extends JControllerAdmin
{
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function getModel($name = 'category', $prefix = 'Jm_video_galleriesModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
	/**
	 * Method to save the submitted ordering values for records via AJAX.
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public function saveOrderAjax()
	{
		// Get the input
		$input = JFactory::getApplication()->input;
		$pks = $input->post->get('cid', array(), 'array');
		$order = $input->post->get('order', array(), 'array');
		// Sanitize the input
		JArrayHelper::toInteger($pks);
		JArrayHelper::toInteger($order);
		// Get the model
		$model = $this->getModel();
		// Save the ordering
		$return = $model->saveorder($pks, $order);
		if ($return)
		{
			echo "1";
		}
		// Close the application
		JFactory::getApplication()->close();
	}
}
