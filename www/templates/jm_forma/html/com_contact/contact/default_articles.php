<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_contact
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once JPATH_SITE . '/components/com_content/helpers/route.php';

?>
<?php if ($this->params->get('show_articles')) : ?>
<div class="contact-articles">
	
	<?php if  ($this->params->get('presentation_style')=='plain'):?>
	<?php echo '<h4>'. JText::_('JGLOBAL_ARTICLES').'</h4>'; ?>
	<?php endif; ?>
	<ol>
		<?php foreach ($this->item->articles as $article) :	?>
			<li>
				<?php echo JHtml::_('link', JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catslug)), htmlspecialchars($article->title, ENT_COMPAT, 'UTF-8')); ?>
			</li>
		<?php endforeach; ?>
	</ol>
</div>
<?php endif; ?>
