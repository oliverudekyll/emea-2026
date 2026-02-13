<section class="section" id="kategooriad">
    <div class="section__header">
        <h2 class="button--dark">Kategooriad ja kriteeriumid</h2>
    </div>
    <?php
    $categories_query = new WP_Query(array(
        'post_type' => 'category_criteria',       
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC'
    ));

    if ($categories_query->have_posts()) :
        ?>
         <ul class="categories__list">
            <?php 
            $post_count = 0;
            while ($categories_query->have_posts()) : 
                $categories_query->the_post(); 
                $post_count++;
                $icon = get_field('icon');
            ?>
               <li>
                <a class="categories__list-item" href="<?php the_permalink(); ?>">
                    <?php if ($icon): ?>
                        <img  src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
                    <?php endif; ?>
                    <?php the_title(); 
                    get_template_part("template-parts/icons/icon","arrow")
                    ?>
                </a>
               </li>
            <?php 
            endwhile; 
            ?>
        </ul>
        <?php
        wp_reset_postdata(); // Important: reset post data after custom query
    else :
        ?>
        <p><?php _e('Esines viga.', 'emea-2026'); ?></p>
    <?php endif; 
    get_template_part("template-parts/footer-icon", null, array(
        'variant' => 1,
        'color' => 'light',
    ))
    ?>
    

</section>