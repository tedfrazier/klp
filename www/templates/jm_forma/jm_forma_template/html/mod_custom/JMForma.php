<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_custom
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<div class="JMForma ModCustom">
	<?php if ($params->get('backgroundimage')): ?> 
		<img src="<?php echo $params->get('backgroundimage');?>" style="width:100%;"/>
	<?php endif;?>
	<div class="CustomContent <?php if ($params->get('backgroundimage')) echo 'hasBG'?>">
		<?php
			$modsfx=$params->get('moduleclass_sfx');
			$tmp=preg_match('/{(.*)}/',$modsfx,$match);
			
			if ($module->showtitle != 0) {
			$badge = preg_match ('/badge/', $params->get('moduleclass_sfx'))?"<span class=\"badge\">&nbsp;</span>\n":"";
			$title = $module -> title;
			$pos = mb_strpos($title, '||');
			if ($pos !== false) {
				$title = '<h3 class="header sub-title"><span class="title">'.mb_substr($title, 0, $pos).'</span><span class="subtitle">'.mb_substr($title, $pos + 2).'</span><span class="title-border"></span>'.$badge.'</h3>';
			} else {
				$title = '<h3 class="header"><span class="title">'.$title.'</span><span class="title-border"></span>'.$badge.'</h3>';
			}
		?>
			<?php
				echo $title;
				echo (isset($match[1]))?'<span class="mod-header-text">'.$match[1].'</span>':'';
			?>
		<?php } ?>
		<div class="mod-content">
			<?php echo $module->content;?>
		</div>
	</div>
</div>
