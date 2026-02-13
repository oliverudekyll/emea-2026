<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package EMEA_2026
 */

?>

<?php 
        $color = get_field("color");
        
        if ($color === "Must"):
            $color_class = "article--black";
            elseif ($color === "Lilla"):
            $color_class = "article--purple";
            elseif ($color === "Oranž"):
            $color_class = "article--orange";
            elseif ($color === "Hall"):
            $color_class = "article--grey";
            elseif ($color === "Roheline"):
            $color_class = "article--green";
        endif;
     ?>

<article id="post-<?php the_ID(); ?>" class="article-category <?php echo $color_class ?>">

<?php 
    if ($color === "Must"):
        $title_color_class = "button--light";
    else: 
        $title_color_class = "button--dark";
    endif;

    $icon = get_field("icon")
 ?>
    <div class="article-category__global-header">
        <div class="<?php echo $title_color_class ?>">
            Kategooriad ja kriteeriumid
        </div>
        <img class="global-header__icon" src="<?php echo $icon["url"] ?>" alt="">
    </div>
	<header class="article__header">
		<?php
			$field = get_field("field");

            if ($field):
			?>
			<h2> <?php echo $field ?></h2>
            <?php 
            endif;
             ?>
			<?php 
			the_title( '<h1 class="article__title">', '</h1>' );
		 ?>
	</header>


	<div class="article-category__content">
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
    if ($color === "Must"):
        $icon_color = "light";
    else: 
        $icon_color = "dark";
    endif;
	get_template_part("template-parts/footer-icon", null, array(
		'variant' => 1,
		'color' => $icon_color,
	))
	 ?>


</article><!-- #post-<?php the_ID(); ?> -->
