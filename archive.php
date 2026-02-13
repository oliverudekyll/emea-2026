<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package EMEA_2026
 */

get_header();
?>

	<main id="primary" class="site-main feed-page">
		<?php 
			get_template_part("template-parts/content", "feed")
		?>

	</main><!-- #main -->

<?php
get_footer();
