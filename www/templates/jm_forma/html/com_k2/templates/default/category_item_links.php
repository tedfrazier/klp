<?php
/**
 * @version		$Id: category_item_links.php 1618 2012-09-21 11:23:08Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

// Define default image size (do not change)
K2HelperUtilities::setDefaultImage($this->item, 'itemlist', $this->params);

?>
<li>
<!-- Start K2 Item Layout (links) -->
	  <?php if($this->item->params->get('catItemTitle')): ?>
	  <!-- Item title -->
		<i class="fa fa-angle-<?php echo (Helix::direction()=='rtl')?'left':'right'; ?>"></i>
	  	<?php if ($this->item->params->get('catItemTitleLinked')): ?>
		<a href="<?php echo $this->item->link; ?>">
	  		<?php echo $this->item->title; ?>
	  	</a>
	  	<?php else: ?>
	  	<?php echo $this->item->title; ?>
	  	<?php endif; ?>
	  <?php endif; ?>
<!-- End K2 Item Layout (links) -->
</li>
