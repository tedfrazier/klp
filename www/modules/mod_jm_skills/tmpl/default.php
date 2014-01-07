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


<div class="JMSkills <?php echo $params->get('modulelayout', 'default').' '.$moduleclass_sfx ?>"> 
	<?php foreach($items as $item):?>
	<div class="JMSkillsTitleWrap clearfix">
		<span class="JMSkillsTitle left"><?php echo $item->itemTitle; ?></span>
		<span class="JMSkillsPercent right"><?php echo $item->itemPercent.'%'; ?></span>
	</div>
	<div class="JMSkillsProgressBarWrap clearfix">
		<div class="JMSkillsProgressBar"><div class="JMSkillsProgressPercent" style="width:<?php echo $item->itemPercent; ?>%"></div></div>
	</div>
	<?php endforeach; ?>
</div>
