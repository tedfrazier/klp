<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_contact
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<article class="contact-links clearfix">
	<?php 
	if ('plain' == $this->params->get('presentation_style')) :
		echo '
		<header class="entry-header">
			<h2 class="contact-links-title entry-title">'.JText::_('COM_CONTACT_SOCIAL').'</h2>
		</header>';
	else :
	    echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('COM_CONTACT_SOCIAL'), 'display-links');
	endif;
	?>
	<ul class="unstyled contact-link">
		<?php
		    foreach(range('a', 'e') as $char) :// letters 'a' to 'e'
			    $link = $this->contact->params->get('link'.$char);
			    $label = $this->contact->params->get('link'.$char.'_name');

			    if( ! $link) :
			        continue;
			    endif;

			    // Add 'http://' if not present
			    $link = (0 === strpos($link, 'http')) ? $link : 'http://'.$link;

			    // If no label is present, take the link
			    $label = ($label) ? $label : $link;
			    ?>
			<li class="<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>" style="margin-<?php echo (Helix::direction()=='rtl')?'left':'right'; ?>:15px;">
				<a class="contac-links-item" title="<?php echo $label;?>" href="<?php echo $link; ?>">
				    <i class="fa fa-<?php echo $label;?>"></i><?php //echo $label;  ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</article>
