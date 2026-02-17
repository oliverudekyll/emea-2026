<section class="section" id="uudised">
    <div class="section__header">
        <h2 class="button--dark">Uudised</h2>
        <a href="<?php echo esc_url(site_url("/uudised")) ?>" class="button--dark">Kõik uudised 
            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="23" viewBox="0 0 31 23" fill="none">
  <path d="M18.3936 0.43934C18.9793 -0.146447 19.9289 -0.146447 20.5146 0.43934L30.0605 9.98524C30.6463 10.571 30.6463 11.5205 30.0605 12.1063L20.5146 21.6522C19.9289 22.238 18.9793 22.238 18.3936 21.6522C17.8078 21.0664 17.8078 20.1169 18.3936 19.5311L25.3789 12.5458H0V9.54579H25.3789L18.3936 2.56043C17.8078 1.97465 17.8078 1.02513 18.3936 0.43934Z" fill="#DCDCDC"/>
        </svg>
</a>
    </div>
    <?php
    // Query posts from the 'news' custom post type
    $news_query = new WP_Query(array(
        'post_type' => 'news',       // Custom post type slug
        'posts_per_page' => 3,       // Number of posts to display
        'orderby' => 'date',
        'order' => 'DESC'
    ));

    if ($news_query->have_posts()) :
        ?>
        <div class="news-grid">
            <?php 
            $post_count = 0;
            while ($news_query->have_posts()) : 
                $news_query->the_post(); 
                $post_count++;
                if (has_post_thumbnail()) : 
            ?>
                <article class="news-post">
                    <a href="<?php the_permalink(); ?>" class="news-post-link">
                        <?php the_post_thumbnail('large'); ?>
                        <div class="news-overlay">
                            <h3><?php the_title(); ?></h3>
                        </div>
                    </a>
                </article>
            <?php 
                endif;
            endwhile; 
            ?>
        </div>
        <?php
        wp_reset_postdata(); // Important: reset post data after custom query
    else :
        ?>
        <p><?php _e('Esines viga.', 'emea-2026'); ?></p>
    <?php endif; 
         get_template_part("template-parts/footer-icon", null, array(
            'variant' => 1,
            'color' => 'dark',
        ))

    ?>
    

</section>