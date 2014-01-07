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

abstract class Jm_video_galleriesHelper {

  public static function getVideos($cat_ids = null,$ordering = null, $limitstart = 0, $limit = null) {
    $db = JFactory::getDbo();
    $where = '';
    if (count($cat_ids)) {
      foreach ($cat_ids AS $cat) {
        if (empty($where)) {
          $where.= "cat_ids LIKE '%,{$cat}' OR cat_ids LIKE '{$cat},%' OR cat_ids LIKE '%,{$cat},%' OR `cat_ids` LIKE '{$cat}' ";
        } else {
          $where.= "OR cat_ids LIKE '%,{$cat}' OR cat_ids LIKE '{$cat},%' OR cat_ids LIKE '%,{$cat},%' OR `cat_ids` LIKE '{$cat}' ";
        }
      }
    }
	$qlimit = null;
	if($limit){
		$qlimit = 'LIMIT '.$limitstart.', '.$limit ;
	}
    $query = "SELECT * FROM #__jmvg_videos WHERE ({$where}) AND state=1 ORDER BY ordering {$ordering} {$qlimit}";
    //echo $query;die;
	$db->setQuery($query);
    $result = $db->loadObjectList();
    return $result;
  }

  public static function getVideosNoLimit($cat_ids = null,$ordering) {
    $db = JFactory::getDbo();
    $where = '';
    if (count($cat_ids)) {
      foreach ($cat_ids AS $cat) {
        if (empty($where)) {
          $where.= "cat_ids LIKE '%,{$cat}' OR cat_ids LIKE '{$cat},%' OR cat_ids LIKE '%,{$cat},%' OR `cat_ids` LIKE '{$cat}' ";
        } else {
          $where.= "OR cat_ids LIKE '%,{$cat}' OR cat_ids LIKE '{$cat},%' OR cat_ids LIKE '%,{$cat},%' OR `cat_ids` LIKE '{$cat}' ";
        }
      }
    }
    $query = "SELECT id FROM #__jmvg_videos WHERE ({$where}) AND state=1 ORDER BY ordering ".$ordering;
    $db->setQuery($query);
    $result = $db->loadObjectList();
    return $result;
  }

  public static function getCategories($cat_ids = null) {
    $db = JFactory::getDbo();
    $where = '';
    $where = implode(",", $cat_ids);
    $query = "SELECT id,title FROM #__jmvg_categories WHERE id IN ({$where}) AND state=1";
    $db->setQuery($query);
    $result = $db->loadObjectList();
    return $result;
  }

  public static function getCategoriesVideo($cat_ids = null) {
    $db = JFactory::getDbo();
    $query = "SELECT GROUP_CONCAT(title) FROM #__jmvg_categories WHERE id IN ({$cat_ids}) AND state=1";
    $db->setQuery($query);
    $result = $db->loadResult();
    return $result;
  }

  public static function getTemplate() {
    $db = JFactory::getDBO();
    $query = $db->getQuery(true);
    $query->select('*');
    $query->from('#__template_styles');
    $query->where('home=1');
    $query->where('client_id=0');
    $db->setQuery($query);
    return $db->loadObject()->template;
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
