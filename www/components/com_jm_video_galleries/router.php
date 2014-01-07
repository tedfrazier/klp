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
/**
 * @param	array	A named array
 * @return	array
 */
function Jm_video_galleriesBuildRoute(&$query)
{
	$segments = array();
	if (isset($query['task'])) {
		$segments[] = implode('/',explode('.',$query['task']));
		unset($query['task']);
	}
	if (isset($query['view'])) {
		$segments[] = $query['view'];
		unset($query['view']);
	}
	if (isset($query['id'])) {
		$segments[] = $query['id'];
		unset($query['id']);
	}
	return $segments;
}
/**
 * @param	array	A named array
 * @param	array
 *
 * Formats:
 *
 * index.php?/jm_video_galleries/task/id/Itemid
 *
 * index.php?/jm_video_galleries/id/Itemid
 */
function Jm_video_galleriesParseRoute($segments)
{
	$vars = array();
	// view is always the first element of the array
	$count = count($segments);
    switch ($segments[0]) {
        case 'videos':
            $vars['view'] = 'videos';
            break;
        case 'video':
            $vars['view'] = 'video';
            break;
    }
    $count--;
    if ($count) {
        $count--;
        $segment = array_pop($segments);
        $arr = explode('-', $segment);
        if (count($arr) > 1) {
            $vars['id'] = $arr[count($arr) - 1];
        } else {
            if (is_numeric($segment)) {
                $vars['id'] = $segment;
            } else {
                $count--;
                $vars['task'] = array_pop($segments) . '.' . $segment;
            }
        }
    }
	if ($count)
	{   
        $vars['task'] = implode('.',$segments);
	}
	return $vars;
}
