<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package EMEA_2026
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="not-found">
			Lehekülge ei leitud
			<a href="<?php echo esc_url(home_url('/')); ?>" class="button--dark">Tagasi</a>
		</div>
		

	</main><!-- #main -->

<?php
get_footer();
