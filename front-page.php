<?php
/**
 * The template for displaying the front page
 *
 * @package EMEA_2026
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="section" id="landing">
    <?php
        $logo = get_field('header_logo');
        
        if ($logo): ?>
            <img src="<?php echo esc_url($logo['url']); ?>" 
                 alt="<?php echo esc_attr($logo['alt']); ?>" 
                 class="landing__header" />
    <?php endif; ?>
    
    <div class="landing__footer">
        <div class="landing__content">
            <?php the_content(); ?>
        </div>
        <?php 
        $links = get_field('links');
        if ($links): ?>
            <div class="landing__links">
                <?php while (have_rows('links')): the_row(); 
                    $label = get_sub_field('label');
                    $url = get_sub_field('url');
                    
                    if ($label && $url): ?>
                        <a rel="noreferrer noopener" target="_blank" href="<?php echo esc_url($url); ?>" 
                           class="button--light">
                            <?php echo esc_html($label); ?>
                        </a>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <?php
    ?>

    </section>
    
    <?php 
    get_template_part("template-parts/section", "news")
    ?>
    
    <?php 
    get_template_part("template-parts/section", "nominees")
    ?>

<?php 
    get_template_part("template-parts/section", "categories")
    ?>
    


</main>
<?php get_footer(); ?>


<?php
