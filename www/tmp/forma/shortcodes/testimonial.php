<?php
/**
 * @package Helix Framework
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2013 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/
//no direct accees
defined ('_JEXEC') or die('resticted aceess');

//[Testimonial]
if(!function_exists('testimonial_sc')) {
	function testimonial_sc( $atts, $content="" ){

		extract(shortcode_atts(array(
					'name' => 'John Doe',
					'designation' => '',
					'email' => 'email@email.com',
					'url' => '',
					'img'=> ''
					
				), $atts));

		ob_start();
	?>
	<div class="media testimonial">
		<div class="media-body">
			<div class="testimonial-content clearfix">
				<?php echo do_shortcode($content); ?>
			</div>
			<div class="clearfix arrowWrap"><span class="arrow"></span></div>
			<div class="media testimonial-author">
				<div class="AuthorAvatar">
					<img class="img-circle" alt="<?php echo $name; ?>" src="//1.gravatar.com/avatar/<?php echo md5($email); ?>?s=68&amp;r=pg&amp;d=mm" width="98">
				</div>
				<div class="media-body">
					<div class="AuthorName"><?php echo $name; ?></div>
					<div class="AuthorDesc"><?php echo $designation; ?></div>
					<div class="AuthorLink"><a href="<?php echo $url; ?>"><?php echo $url; ?></a></div>
				</div>
			</div>
		</div>
	</div>
	<?php 

		return ob_get_clean();
	}
	add_shortcode( 'testimonial', 'testimonial_sc' );
}