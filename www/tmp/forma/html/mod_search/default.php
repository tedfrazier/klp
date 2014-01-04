<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_search
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$buttonpos = (Helix::direction()=='rtl')?'left':'right'; 
?>

<div class="search <?php echo $moduleclass_sfx; ?> ">
    <form action="<?php echo JRoute::_('index.php');?>" method="post" class="form-inline">
    		<?php
				$output = '<div class="searchInputWrap"><input name="searchword" id="mod-search-searchword" type="text" value="' . $text . '"  onblur="if (this.value==\'\') this.value=\'' . $text . '\';" onfocus="if (this.value==\'' . $text . '\') this.value=\'\';" /></div>';

				$button_text = $params->get('button_text');
				
				if ($button) :
					if ($imagebutton) :
						$button = '<input type="image" value="' . $button_text . '" class="button pull-'.$buttonpos.' '. $moduleclass_sfx.'" src="' . $img . '" onclick="this.form.searchword.focus();"/>';
					else :
						$button = '<button class="pull-'.$buttonpos.' button btn btn-primary" onclick="this.form.searchword.focus();"><i class="fa fa-search"></i>' . $button_text . '</button>';
					endif;
				endif;

				echo $output;
			?>
    	<input type="hidden" name="task" value="search" />
    	<input type="hidden" name="option" value="com_search" />
    	<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
		<?php echo $button; ?>
    </form>
</div>
