<?php
	/*---------------------------------------------------------------
	# Package - Joomla Template based on Helix Framework   
	# ---------------------------------------------------------------
	# Author - JoomShaper http://www.joomshaper.com
	# Copyright (C) 2010 - 2012 JoomShaper.com. All Rights Reserved.
	# license - PHP files are licensed under  GNU/GPL V2
	# license - CSS  - JS - IMAGE files  are Copyrighted material 
	# Websites: http://www.joomshaper.com
	-----------------------------------------------------------------*/
	//no direct accees
	defined ('_JEXEC') or die ('resticted aceess');

	$modChromes = array('jm_none','jm_xhtml_icontop','sp_xhtml', 'sp_flat', 'sp_raw', 'sp_menu', 'none'  );

	function modChrome_jm_none($module, $params, $attribs)
	{ ?>
	<div id="Mod<?php echo $module->id; ?>" class="module <?php echo $params->get('moduleclass_sfx'); ?>">
		<div class="mod-content">
			<?php echo $module->content; ?>
		</div>
	</div>
	
	<?php
	}
	function modChrome_jm_xhtml_icontop($module, $params, $attribs)
	{ ?>
		<div id="Mod<?php echo $module->id; ?>" class="jm-module jm-xhtml-icontop module <?php echo $params->get('moduleclass_sfx'); ?>">
			<div class="mod-wrapper clearfix">
				<?php if ($module->showtitle != 0) {
					$title = explode(' ', $module->title);
					$title_part1 = array_shift($title);
					$title_part2 = join(' ', $title);

					$modsfx=$params->get('moduleclass_sfx');
					$tmp=preg_match('/{(.*)}/',$modsfx,$match);
					$badge = preg_match ('/badge/', $params->get('moduleclass_sfx'))?"<span class=\"badge\">&nbsp;</span>\n":"";
					?>
					<?php
					echo (isset($match[1]))?'<i class="'.$match[1].'"></i>':'';
					?>
					<h3 class="header">
						<span class="title"><span class="color"><?php echo $title_part1.' '; ?></span><?php echo $title_part2.' '; ?></span>
						<span class="title-border"></span>
					</h3>
					<?php echo $badge; ?>
				<?php } ?>
				<div class="mod-content clearfix">
					<div class="mod-inner clearfix">
						<?php echo $module->content; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="gap"></div>
	<?php
	}
	function modChrome_sp_xhtml($module, $params, $attribs)
	{ ?>
	<div id="Mod<?php echo $module->id; ?>" class="module <?php echo $params->get('moduleclass_sfx'); ?>">	
		<div class="mod-wrapper clearfix">
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
			<div class="mod-content clearfix">
				<div class="mod-inner clearfix">
					<?php echo $module->content; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="gap"></div>
	<?php
	}

	function modChrome_sp_flat($module, $params, $attribs)
	{ ?>
	<div id="Mod<?php echo $module->id; ?>" class="module <?php echo $params->get('moduleclass_sfx'); ?>">
		<div class="mod-wrapper-flat clearfix">
			<?php if ($module->showtitle != 0) { ?>
				<h3 class="header">
					<?php 
						echo '<span class="title">'.$module->title.'</span>';
					?>
					<span class="title-border"></span>
				</h3>
			<?php } ?>
			<?php echo $module->content; ?>
		</div>
	</div>
	<div class="gap"></div>
	<?php
	}

	function modChrome_sp_raw($module, $params, $attribs)
	{ 
		echo $module->content; 
	}

	function modChrome_sp_menu($module, $params, $attribs)
	{ ?>
	<div id="Mod<?php echo $module->id; ?>"  class="module <?php echo $params->get('moduleclass_sfx'); ?>">	
		<div class="mod-wrapper-menu clearfix">
			<?php echo $module->content; ?>
		</div>
	</div>
	<?php
}