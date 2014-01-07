<?php
/**
 * @package		JoomlaMan
 * @subpackage	mod_jm_pagetitle
 * @author      Chinh Duong Manh
 * @email       duongmanhchinh@gmail.com
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>


<div class="jm_pagetitle <?php echo $moduleclass_sfx ?>">
	<!-- <h2><?php echo $title;?></h2> -->
	<?php 
	$doc =& JFactory::getDocument();
	$mytitle = str_replace("xxxx", "", $doc->getTitle());
	//echo $mytitle; 		
	?>
	<h2>
	<?php
	list( $sitename, $title) = explode( '-' , $doc->getTitle() );
	echo $title;
	?>
	</h2>


</div>
