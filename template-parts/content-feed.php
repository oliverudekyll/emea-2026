<?php if ( have_posts() ) : ?>

<header class="page-header">
    <?php
    // Remove the prefix from archive title (e.g., "Archive: ", "Category: ", etc.)
    $archive_title = get_the_archive_title();
    $archive_title = preg_replace('/^[^:]+:\s*/', '', $archive_title);
    echo '<h1 class="button--dark">' . $archive_title . '</h1>';
    ?>

</header><!-- .page-header -->
<div class="feed" role="feed">

    <?php
/* Start the Loop */
while ( have_posts() ) :
    the_post();
    ?>
    <a href="<?php echo the_permalink() ?>">
        <article class="feed__article-card">
            <img class="article-card__thumbnail" src="<?php echo esc_url(the_post_thumbnail_url('large')); ?>" alt="">
            <header class="article-card__header"><?php echo the_title() ?></header>
        </article>
    </a>
<?php 
endwhile;
?> 
</div>
<?php 
else :

get_template_part( 'template-parts/content', 'none' );

endif;

get_template_part("template-parts/footer-icon", null, array(
    'variant' => 1,
    'color' => 'dark',
))
?>