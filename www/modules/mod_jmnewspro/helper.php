<?php
/*
#------------------------------------------------------------------------
# Package - JoomlaMan JMNewsPro
# Version 1.0
# -----------------------------------------------------------------------
# Author - JoomlaMan http://www.joomlaman.com
# Copyright © 2012 - 2013 JoomlaMan.com. All Rights Reserved.
# @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
# Websites: http://www.JoomlaMan.com
#------------------------------------------------------------------------
*/
// no direct access
defined('_JEXEC') or die('Restricted access');
class ModJmNewsProHelper {
  /**
   * Do something getItems method
   *
   * @param 	
   * @return
   */
  static function getSlides($params) {
    $slidesource = $params->get('slider_source', 1);
    switch ($slidesource) {
      case 1:
        return ModJmNewsProHelper::getSlidesFromCategories($params);
        break;
      case 2:
        return ModJmNewsProHelper::getSlidesFromArticleIDs($params);
        break;
      case 3:
        return ModJmNewsProHelper::getSlidesFromK2Categories($params);
        break;
      case 4:
        return ModJmNewsProHelper::getSlidesFromK2IDs($params);
        break;
      case 5:
        return ModJmNewsProHelper::getSlidesFromCategoriesProduct($params);
        break;
      case 6:
        return ModJmNewsProHelper::getSlidesFromProductIDs($params);
        break;
      case 7:
        return ModJmNewsProHelper::getSlidesFeatured($params);
        break;
      case 8:
        return ModJmNewsProHelper::getSlidesK2Featured($params);
        break;
    }
  }
  static function getSlidesFromCategories($params) {
    $limit = $params->get('jmnewspro_count', 0);
    $categories = $params->get('jmnewspro_categories', array());
    $categories = implode(',', $categories);
    $db = JFactory::getDbo();
    $ordering = $params->get('jmnewspro_ordering', 'ASC');
    $orderby = $params->get('jmnewspro_orderby', 1);
    if ($orderby == 1) {
      $field = 'c.title';
    } elseif ($orderby == 2) {
      $field = 'c.ordering';
    } else {
      $field = 'c.id';
    }
    $query = $db->getQuery(true)
            ->select("c.id")
            ->from("#__content AS c")
            ->where("c.catid IN({$categories})")
            ->where("c.state > 0")
            ->order($field . ' ' . $ordering);
    if ($limit > 0) {
      $db->setQuery($query, 0, $limit);
    } else {
      $db->setQuery($query);
    }
    $rows = $db->loadObjectList();
    $slides = array();
    if (empty($rows)) {
      return $slides;
    }
    foreach ($rows as $row) {
      $slide = new JMNewsProSlide($params);
      $slide->loadArticle($row->id);
      $slides[] = $slide;
    }
    return $slides;
  }
  static function getSlidesFromArticleIDs($params) {
    $ids = $params->get('jmnewspro_article_ids', '');
    $ids = str_replace(' ', '', $ids);
    $db = JFactory::getDbo();
    $ordering = $params->get('jmnewspro_ordering', 'ASC');
    $orderby = $params->get('jmnewspro_orderby', 1);
    if ($orderby == 1) {
      $field = 'c.title';
    } elseif ($orderby == 2) {
      $field = 'c.ordering';
    } else {
      $field = 'c.id';
    }
    $query = $db->getQuery(true)
            ->select("c.id")
            ->from("#__content AS c")
            ->where("c.state > 0")
            ->where("c.id IN ({$ids})")
            ->order($field . ' ' . $ordering);
    $db->setQuery($query);
    $rows = $db->loadObjectList();
    if (empty($rows)) {
      return $slides;
    }
    foreach ($rows as $row) {
      $slide = new JMNewsProSlide($params);
      $slide->loadArticle($row->id);
      $slides[] = $slide;
    }
    return $slides;
  }
  static function getSlidesFeatured($params) {
    $limit = $params->get('jmnewspro_count', 0);
    $db = JFactory::getDbo();
    $ordering = $params->get('jmnewspro_ordering', 'ASC');
    $orderby = $params->get('jmnewspro_orderby', 1);
    if ($orderby == 1) {
      $field = 'c.title';
    } elseif ($orderby == 2) {
      $field = 'c.ordering';
    } else {
      $field = 'c.id';
    }
    $query = $db->getQuery(true)
            ->select("c.id")
            ->from("#__content AS c")
            ->where("c.state > 0")
            ->where("c.featured = 1")
            ->order($field . ' ' . $ordering);
    if ($limit > 0) {
      $db->setQuery($query, 0, $limit);
    } else {
      $db->setQuery($query);
    }
    $rows = $db->loadObjectList();
    $slides = array();
    if (empty($rows)) {
      return $slides;
    }
    foreach ($rows as $row) {
      $slide = new JMNewsProSlide($params);
      $slide->loadArticle($row->id);
      $slides[] = $slide;
    }
    return $slides;
  }
  ///Hikashop
  static function getSlidesFromCategoriesProduct($params) {
    $limit = $params->get('jmnewspro_count', 0);
    $categories = $params->get('jmnewspro_hikashop_categories', array());
    $categories = implode(',', $categories);
    $db = JFactory::getDbo();
    $query = $db->getQuery(true)
            ->select("p.product_id")
            ->from("#__hikashop_product AS p")
            ->leftjoin("#__hikashop_product_category AS c ON p.product_id = c.product_id")
            ->where("c.category_id IN({$categories})")
            ->where("p.product_published > 0");
    if ($limit > 0) {
      $db->setQuery($query, 0, $limit);
    } else {
      $db->setQuery($query);
    }
    $rows = $db->loadObjectList();
    $slides = array();
    if (empty($rows)) {
      return $slides;
    }
    foreach ($rows as $row) {
      $slide = new JMNewsProSlide($params);
      $slide->loadProduct($row->product_id);
      $slides[] = $slide;
    }
    return $slides;
  }
  static function getSlidesFromProductIDs($params) {
    $ids = $params->get('jmnewspro_hikashop_ids', '');
    $ids = str_replace(' ', '', $ids);
    if (empty($ids))
      return $slides;
    $ids = explode(',', $ids);
    $slides = array();
    if (empty($ids))
      return $slides;
    foreach ($ids as $id) {
      $slide = new JMNewsProSlide($params);
      $slide->loadProduct($id);
      $slides[] = $slide;
    }
    return $slides;
  }
  static function getSlidesFromK2Categories($params) {
    $limit = $params->get('jmnewspro_count', 0);
    $categories = $params->get('jmnewspro_k2_categories', array());
    $categories = implode(',', $categories);
    $ordering = $params->get('jmnewspro_ordering', 'ASC');
    $orderby = $params->get('jmnewspro_orderby', 1);
    $orderfields = array('','k2.title','k2.ordering','k2.created');
    $db = JFactory::getDbo();
    $query = $db->getQuery(true)
            ->select("k2.id")
            ->from("#__k2_items AS k2")
            ->where("k2.catid IN({$categories})")
            ->where("k2.published = 1")
            ->where("k2.trash = 0")
            ->order($orderfields[$orderby] . ' ' . $ordering);
    if ($limit > 0) {
      $db->setQuery($query, 0, $limit);
    } else {
      $db->setQuery($query);
    }
    $rows = $db->loadObjectList();
    $slides = array();
    if (empty($rows)) {
      return $slides;
    }
    foreach ($rows as $row) {
      $slide = new JMNewsProSlide($params);
      $slide->loadK2($row->id);
      $slides[] = $slide;
    }
    return $slides;
  }
  static function getSlidesFromK2IDs($params) {
		$slides = array();
    $ids = $params->get('jmnewspro_k2_ids', '');
    $ids = str_replace(' ', '', $ids);
    $db = JFactory::getDbo();
    $ordering = $params->get('jmnewspro_ordering', 'ASC');
    $orderby = $params->get('jmnewspro_orderby', 1);
    $orderfields = array('','k2.title','k2.ordering','k2.created');
    $query = $db->getQuery(true)
            ->select("k2.id")
            ->from("#__k2_items AS k2")
            ->where("k2.id IN ({$ids})")
            ->where("k2.published = 1")
						->where("k2.trash = 0")
            ->order($orderfields[$orderby] . ' ' . $ordering);
    $db->setQuery($query);
    $rows = $db->loadObjectList();
    if (empty($rows)) {
      return $slides;
    }
    foreach ($rows as $row) {
      $slide = new JMNewsProSlide($params);
      $slide->loadK2($row->id);
      $slides[] = $slide;
    }
    return $slides;
  }
  static function getSlidesK2Featured($params) {
    $limit = $params->get('jmnewspro_count', 0);
    $ordering = $params->get('jmnewspro_ordering', 'ASC');
    $orderby = $params->get('jmnewspro_orderby', 1);
    $orderfields = array('','k2.title','k2.ordering','k2.created');
    $db = JFactory::getDbo();
    $query = $db->getQuery(true)
            ->select("k2.id")
            ->from("#__k2_items AS k2")
            ->where("k2.featured = 1")
            ->where("k2.published = 1")
						->where("k2.trash = 0")
            ->order($orderfields[$orderby] . ' ' . $ordering);
    if ($limit > 0) {
      $db->setQuery($query, 0, $limit);
    } else {
      $db->setQuery($query);
    }
    $rows = $db->loadObjectList();
    $slides = array();
    if (empty($rows)) {
      return $slides;
    }
    foreach ($rows as $row) {
      $slide = new JMNewsProSlide($params);
      $slide->loadK2($row->id);
      $slides[] = $slide;
    }
    return $slides;
  }
  static function getTemplate() {
    $db = JFactory::getDBO();
    $query = $db->getQuery(true);
    $query->select('*');
    $query->from('#__template_styles');
    $query->where('home=1');
    $query->where('client_id=0');
    $db->setQuery($query);
    return $db->loadObject()->template;
  }
}
// END ModjmnewsproHelper
?>