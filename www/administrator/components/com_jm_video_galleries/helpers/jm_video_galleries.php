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
 * Jm_video_galleries helper.
 */
class Jm_video_galleriesHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($vName = '')
	{
		JSubMenuHelper::addEntry(
			JText::_('COM_JM_VIDEO_GALLERIES_TITLE_VIDEOS'),
			'index.php?option=com_jm_video_galleries&view=videos',
			$vName == 'videos'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_JM_VIDEO_GALLERIES_TITLE_CATEGORIES'),
			'index.php?option=com_jm_video_galleries&view=categories',
			$vName == 'categories'
		);
	}
	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;
		$assetName = 'com_jm_video_galleries';
		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);
		foreach ($actions as $action) {
			$result->set($action, $user->authorise($action, $assetName));
		}
		return $result;
	}
	
	public static function getVideoID($videourl) {
    if (Jm_video_galleriesHelper::videoType($videourl) == 'youtube') {
      preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $videourl, $matches);
      if ($matches) {
        return $matches[0];
      }
    } elseif (Jm_video_galleriesHelper::videoType($videourl) == 'vimeo') {
      //ask vimeo
      $api_url = 'http://vimeo.com/api/oembed.json?url=' . urlencode($videourl);
      $content = @file_get_contents($api_url);
      $video = json_decode($content);
      if (isset($video->video_id)) {
        return $video->video_id;
      }
    }
    return null;
  }

  public static function getVideo($videourl) {
    $video = new stdClass();
    $videotype = Jm_video_galleriesHelper::videoType($videourl);
    switch ($videotype) {
      case 'youtube':
        $videoid = Jm_video_galleriesHelper::getVideoID($videourl);
        $content = @file_get_contents("http://gdata.youtube.com/feeds/api/videos/{$videoid}?v=2&prettyprint=true&alt=json");
        $data = json_decode($content);
        $media = 'media$group';
        $mediathumbnail = 'media$thumbnail';
        $thumbnail = '';
        $size = 0;
        foreach ($data->entry->$media->$mediathumbnail as $thumb) {
          if ($size < $thumb->width) {
            $size = $thumb->width;
            $thumbnail = $thumb->url;
          }
        }
        $video->id = $videoid;
        $video->thumbnail = $thumbnail;
        break;
      case 'vimeo':
        $api_url = 'http://vimeo.com/api/oembed.json?url=' . urlencode($videourl);
        $content = @file_get_contents($api_url);
        $data = json_decode($content);
        if (isset($data->video_id)) {
          $video->id = $data->video_id;
          $video->thumbnail = $data->thumbnail_url;
        }
    }

    return $video;
  }

  public static function videoType($videourl) {
    if (str_replace(array('youtu.be', 'youtube.com'), '', $videourl) !== $videourl) {
      return 'youtube';
    } elseif (str_replace(array('vimeo.com'), '', $videourl) !== $videourl) {
      return 'vimeo';
    }
    return null;
  }
}
