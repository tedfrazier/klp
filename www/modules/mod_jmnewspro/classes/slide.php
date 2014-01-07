<?php
@ob_start();
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.categories');
if (!class_exists('JMImage')){
	require_once JPATH_SITE . DS . 'modules' . DS . 'mod_jmnewspro' . DS . 'classes' . DS . 'jmimage.class.php';
}

class JMNewsProSlide extends stdClass {
	var $db = null;
	var $id = null;
	var $category = null;
	var $category_name = null;
	var $image = null;
	var $title = null;
	var $description = null;
	var $link = null;
	var $params = null;
	var $created = null;
	var $content_type = 'text';
	public function JMNewsProSlide($params) {
		$this->params = $params;
	}
	public function loadArticle($id) {
		$article = JTable::getInstance("content");
		$article->load($id);
		$this->category = $article->get('catid');
		$this->db = JFactory::getDbo();
		$this->db->setQuery('SELECT cat.title FROM #__categories cat	WHERE cat.id='.$this->category);	 
		$this->category_name = $this->db->loadResult();
		if (!class_exists('ContentHelperRoute')) {
			require_once(JPATH_SITE . DS . 'components' . DS . 'com_content' . DS . 'helpers' . DS . 'route.php');
		}
		$this->created = strtotime($article->created);
		if ($article) {
			//$this->title = $article->get('title');
			$image_source = $this->params->get('jmnewspro_article_image_source', 1); 
			$imageobj = json_decode($article->images);
			if ($image_source == 1) {
				//Intro Image
				$this->image = $imageobj->image_intro;
			} elseif ($image_source == 2) {
				//Full Image
				$this->image = $imageobj->image_fulltext;
			} else {
				$this->image = $this->getFirstImage($article->introtext . $article->fulltext);
			}
			if(!empty($imageobj->image_intro) || !empty($imageobj->image_fulltext)){
				$this->content_type = 'image';
			}
			$allowable_tags = $this->params->get('jmnewspro_desc_html', '');
			$tags = "";
			if ($allowable_tags) {
				$allowable_tags = explode(',', $allowable_tags);
				foreach ($allowable_tags as $tag) {
					$tags .= "<$tag>";
				}
			}
			$maxleght = $this->params->get('jmnewspro_desc_length', 50);
			$this->description = substr(strip_tags($article->introtext . $article->fulltext, $tags), 0, $maxleght);
			if ($maxleght < strlen(strip_tags($article->introtext . $article->fulltext, $tags))) {
				$this->description = preg_replace('/ [^ ]*$/', ' ...', $this->description);
			}
			$titleleght = $this->params->get('jmnewspro_title_length', 20);
			$this->title = substr(strip_tags($article->get('title'), $tags), 0, $titleleght);
			if ($titleleght < strlen(strip_tags($article->get('title'), $tags))) {
				$this->title = preg_replace('/ [^ ]*$/', ' ...', $this->title);
			}
			$this->link = JRoute::_(ContentHelperRoute::getArticleRoute($article->id, $article->catid));
			$this->id = $id;
			if ($this->params->get('jmnewspro_title_link')) {
				$this->title = '<a href="' . $this->link . '">' . $this->title . '</a>';
			}
		} else {
			return null;
		}
	}
	public function loadProduct($id) {
		$this->db = JFactory::getDbo();
		$query = $this->db->getQuery(true)
						->select("p.*,pc.product_category_id")
						->select("f.file_path")
						->select("hc.category_name")
						->from("#__hikashop_product AS p")
						->leftjoin("#__hikashop_file AS f ON p.product_id = f.file_ref_id")
						->leftjoin("#__hikashop_product_category AS pc ON pc.product_id = p.product_id")
						->leftjoin("#__hikashop_category AS hc ON hc.category_id = pc.category_id")
						->where("p.product_id = {$id}")
						->where("f.file_type = 'product' ");
		$product = $this->db->setQuery($query)->loadObject();
		if ($product) {
			$this->title = $product->product_name;
			$titleleght = $this->params->get('jmnewspro_title_length', 20);
			$this->title = substr(strip_tags($product->product_name, $tags), 0, $titleleght);
			if ($titleleght < strlen(strip_tags($product->product_name, $tags))) {
				$this->title = preg_replace('/ [^ ]*$/', ' ...', $this->title);
			}
			$this->created = $product->product_created;
			$image_source = $this->params->get('jmnewspro_image_source', 0);
			if (empty($image_source)) {
				$this->image = JPATH_SITE . DS . 'media' . DS . 'com_hikashop' . DS . 'upload' . DS . $product->file_path;
			} else {
				$this->image = $this->getFirstImage($product->product_description);
			}
			$maxleght = $this->params->get('jmnewspro_desc_length', 50);
			$allowable_tags = $this->params->get('jmnewspro_desc_html', '');
			$tags = "";
			if ($allowable_tags) {
				$allowable_tags = explode(',', $allowable_tags);
				foreach ($allowable_tags as $tag) {
					$tags .= "<$tag>";
				}
			}
			$this->description = substr(strip_tags($product->product_description, $tags), 0, $maxleght);
			$this->id = $product->product_id;
			$this->category = $product->product_category_id;
			$this->category_name = $product->category_name;
			if ($maxleght < strlen(strip_tags($product->product_description, $tags))) {
				$this->description = preg_replace('/ [^ ]*$/', ' ...', $this->description);
			}
			$this->link = JRoute::_("index.php?option=com_hikashop&ctrl=product&task=show&cid={$product->product_id}&name={$product->product_name}");
			if ($this->params->get('jmnewspro_title_link')) {
				$this->title = '<a href="' . $this->link . '">' . $this->title . '</a>';
			}
		} else {
			return null;
		}
	}
	public function loadK2($id) {
		$this->db = JFactory::getDbo();
		$query = $this->db->getQuery(true)
						->select("k2.*")
						->from("#__k2_items AS k2")
						->where("k2.id = {$id}");
		$k2 = $this->db->setQuery($query)->loadObject(); 
		if ($k2) {
			$this->created = strtotime($k2->created);
			$this->title = $k2->title;
			$titleleght = $this->params->get('jmnewspro_title_length', 20);
			$this->title = substr(strip_tags($k2->title, $tags), 0, $titleleght);
			if ($titleleght < strlen(strip_tags($k2->title, $tags))) {
				$this->title = preg_replace('/ [^ ]*$/', ' ...', $this->title);
			}
			$image_source = $this->params->get('jmnewspro_image_source', 0);
			if (empty($image_source)) {
				//$size = XS, S, M, L, XL
				$size = 'XL';
				jimport('joomla.filesystem.file');
				if (JFile::exists(JPATH_SITE . DS . 'media' . DS . 'k2' . DS . 'items' . DS . 'cache' . DS . md5("Image" . $k2->id) . '_L.jpg')) {
					$this->image = JPATH_SITE . '/media/k2/items/cache/' . md5("Image" . $id) . '_' . $size . '.jpg';
					$this->content_type = 'image';
				}
			} else {
				$this->image = $this->getFirstImage($k2->introtext . $k2->fulltext);
			}
			if(!empty($k2->video)){
				$this->content_type = 'video';
			}
			$maxleght = $this->params->get('jmnewspro_desc_length', 50);
			$allowable_tags = $this->params->get('jmnewspro_desc_html', '');
			$tags = "";
			if ($allowable_tags) {
				$allowable_tags = explode(',', $allowable_tags);
				foreach ($allowable_tags as $tag) {
					$tags .= "<$tag>";
				}
			}
			$this->description = substr(strip_tags($k2->introtext . $k2->fulltext, $tags), 0, $maxleght);
			$this->id = $k2->id;
			$this->category = $k2->catid;
			$this->db = JFactory::getDbo();
			$this->db->setQuery('SELECT cat.name FROM #__k2_categories cat	WHERE cat.id='.$this->category);	 
			$this->category_name = $this->db->loadResult();
			if ($maxleght < strlen(strip_tags($k2->introtext . $k2->fulltext, $tags))) {
				$this->description = preg_replace('/ [^ ]*$/', ' ...', $this->description);
			}
			$link = 'index.php?option=com_k2&view=item&layout=item&id=' . $k2->id;
			$result = $this->getItemids($link);
			if ($result) {
				$this->link = JRoute::_('index.php?option=com_k2&view=item&id=' . $k2->id . ':' . $k2->alias . '&Itemid=' . $result);
			} else {
				$this->link = JRoute::_('index.php?option=com_k2&view=item&id=' . $k2->id . ':' . $k2->alias);
			}
			if ($this->params->get('jmnewspro_title_link')) {
				$this->title = '<a href="' . $this->link . '">' . $this->title . '</a>';
			}
		} else {
			return null;
		}
	}
	function getItemids($link) {
		$this->db = JFactory::getDbo();
		$query = $this->db->getQuery(true)
						->select("id")
						->from("#__menu")
						->where("link = '{$link}'");
		$result = $this->db->setQuery($query)->loadResult();
		return $result;
	}
	function getFirstImage($str) {
		$str = strip_tags($str, '<img>');
		$matches = null;
		preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $str, $matches);
		if (isset($matches[1][0])) {
			return $image = $matches[1][0];
		}
		return '';
	}
	function getMainImage() {
		if (empty($this->image)) {
			$this->image = JPATH_SITE . '/modules/mod_jmnewspro/images/no-image.jpg';
		} elseif (str_replace(array('http://', 'https://'), '', $this->image) != $this->image) {
			$imageArray = @getimagesize($this->image);
			if (!$imageArray[0]) {
				$this->image = JPATH_SITE . '/modules/mod_jmnewspro/images/no-image.jpg';
			}
		} elseif (!file_exists($this->image)) {
			$this->image = JPATH_SITE . '/modules/mod_jmnewspro/images/no-image.jpg';
		}
		$style = $this->params->get('jmnewspro_image_style', 'fill');
		$width = $this->params->get('jmnewspro_item_width');
		$height = $this->params->get('jmnewspro_item_height');
		$file = pathinfo($this->image);
		$basename = $width . 'x' . $height . '_' . $style . '_' . $file['basename'];
		$safe_name = str_replace(array(' ', '(', ')', '[', ']'), '_', $basename);
		$newfile = JM_NEWS_PRO_IMAGE_FOLDER . '/' . $safe_name;
		$flush = isset($_GET['flush']) ? true : false;
		if (!is_file($newfile) || filemtime($this->image) > filemtime($newfile)) {
			@unlink($newfile);
			$jmimage = new JMImage($this->image);
			switch ($style) {
				case 'fill':
					$jmimage->reFill($width, $height);
					break;
				case 'fit':
					$jmimage->scale($width, $height);
					$jmimage->enlargeCanvas($width, $height, array(0, 0, 0));
					break;
				case 'stretch':
					$jmimage->resample($width, $height, false);
					break;
			}
			$jmimage->save($newfile);
		}
			return JM_NEWS_PRO_IMAGE_PATH . '/' . $safe_name;
	}
	function getThumbnail() {
		$width = $this->params->get('jmnewspro_image_thumbnail_width', 200);
		$height = $this->params->get('jmnewspro_image_thumbnail_height', 100);
		$file = pathinfo($this->image);
		$basename = $width . 'x' . $height . '_' . $file['basename'];
		$safe_name = str_replace(array(' ', '(', ')', '[', ']'), '_', $basename);
		$newfile = JM_NEWS_PRO_IMAGE_FOLDER . '/' . $safe_name;
		if (!file_exists($newfile)) {
			$jmimage = new JMImage($this->image);
			$jmimage->resample($width, $height);
			$jmimage->enlargeCanvas($width, $height, array(255, 255, 255));
			$jmimage->save($newfile);
		}
		return JM_NEWS_PRO_IMAGE_PATH . '/' . $safe_name;
	}
}
@ob_end_clean();