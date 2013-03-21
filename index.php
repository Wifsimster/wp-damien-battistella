<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Wifsimster
 * @since Wifsimster 0.1
 */

	get_header();

	/* Run the loop to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-index.php and that will be used instead.
	 */
	 get_template_part( 'loop', 'index' );

get_footer(); ?>
