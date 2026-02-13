<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package EMEA_2026
 */

?>

<article id="post-<?php the_ID(); ?>" class="article">
	<header class="article__header">
		<?php
			$date = get_the_date('d.m.Y');
			?>
			<time class="article__date" datetime="<?php echo $date ?>"><?php echo $date ?></time>
			<?php 
			the_title( '<h1 class="article__title">', '</h1>' );
		 ?>
	</header>

	<div class="article__thumbnail">
		<?php the_post_thumbnail('large'); ?>
	</div>

	<div class="article__content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'emea-2026' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>
	<?php 
	get_template_part("template-parts/footer-icon", null, array(
		'variant' => 1,
		'color' => 'dark',
	))
	 ?>


</article><!-- #post-<?php the_ID(); ?> -->
