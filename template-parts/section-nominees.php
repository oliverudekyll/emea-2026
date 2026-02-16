<?php
    // Query the nominees list posts to get the active one
    $nominees_query = new WP_Query(array(
        'post_type' => 'nominee_list',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'DESC',
        'meta_query' => array(
            array(
                'key' => 'is_active',
                'value' => '1',
                'compare' => '='
            )
        )
    ));
    
    // Store the active post ID and gallery link
    $active_post_id = null;
    $gallery_link = null;
    if ($nominees_query->have_posts()) {
        $nominees_query->the_post();
        $active_post_id = get_the_ID();
        $gallery_link = get_field('gallery_link');
        wp_reset_postdata();
    }
    ?>
<section class="section" id="nominendid">
    <div class="section__header">
        <h2 class="button--dark">Nominendid ja võitjad</h2>
        <a href="<?php echo esc_url($gallery_link); ?>" 
           id="nominees-gallery-link" 
           class="button--dark" 
           style="<?php echo $gallery_link ? '' : 'display: none;'; ?>">Galerii
        <svg xmlns="http://www.w3.org/2000/svg" width="31" height="23" viewBox="0 0 31 23" fill="none">
  <path d="M18.3936 0.43934C18.9793 -0.146447 19.9289 -0.146447 20.5146 0.43934L30.0605 9.98524C30.6463 10.571 30.6463 11.5205 30.0605 12.1063L20.5146 21.6522C19.9289 22.238 18.9793 22.238 18.3936 21.6522C17.8078 21.0664 17.8078 20.1169 18.3936 19.5311L25.3789 12.5458H0V9.54579H25.3789L18.3936 2.56043C17.8078 1.97465 17.8078 1.02513 18.3936 0.43934Z" fill="#DCDCDC"/>
        </svg>
        </a>
    </div>
    <?php
    
    // Re-query to display the content
    $nominees_query = new WP_Query(array(
        'post_type' => 'nominee_list',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'DESC',
        'meta_query' => array(
            array(
                'key' => 'is_active',
                'value' => '1',
                'compare' => '='
            )
        )
    ));
    
    if ($nominees_query->have_posts()) :
        ?>
        <div class="nominees-container">
        <?php
        while ($nominees_query->have_posts()) : $nominees_query->the_post();
            $categories = get_field(selector: 'categories');
            
            if ($categories) :
                foreach ($categories as $category) :
                    $row_category = isset($category['category']) ? $category['category'] : '';
                    $inner_nominees = isset($category['nominees']) ? $category['nominees'] : array();

                    if ($row_category):
                    ?>
                    <article class="nominees__category">

                    <h4 class="category__title"><?php echo esc_html($row_category); ?></h4>
                    <?php
                    
                    if ($inner_nominees) :
                        ?> 
                        <ul class="category__nominees-list">

                        <?php
                        foreach ($inner_nominees as $nominee) :
                            $name = isset($nominee['name']) ? $nominee['name'] : '';
                            $is_winner = isset($nominee['is_winner']) ? $nominee['is_winner'] : false;

                            if ($is_winner):
                                $nominee_class = "category__nominee category__nominee--winner";
                            else:
                                $nominee_class = "category__nominee";
                            endif;
                            
                            if ($name) :
                                ?>
                                <li class="<?php echo $nominee_class ?>">
                                    <p ><?php echo esc_html($name); ?></p>
                                </li>
                                <?php
                            endif;
                        endforeach;
                        ?>
                        </ul>

                         <?php
                    endif;
                    endif;?>
                    </article>
                    <?php
                endforeach;
            endif;
            
        endwhile;
        ?>
        </div>
        <nav class="nominees__year-menu">
            <ul class="year-menu__list">
                <?php
                // Query all nominee_list posts for the year menu
                $year_menu_query = new WP_Query(array(
                    'post_type' => 'nominee_list',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                
                if ($year_menu_query->have_posts()) :
                    while ($year_menu_query->have_posts()) : $year_menu_query->the_post();
                        $current_id = get_the_ID();
                        $is_active_year = ($current_id == $active_post_id);
                        $button_class = $is_active_year ? 'year-menu__list-item year-menu__list-item--active' : 'year-menu__list-item';
                        $year_gallery_link = get_field('gallery_link');
                ?>
                        <li>
                            <button class="<?php echo $button_class; ?>" 
                                    data-year-id="<?php echo $current_id; ?>"
                                    data-gallery-link="<?php echo esc_attr($year_gallery_link); ?>"
                                    <?php echo $is_active_year ? 'aria-current="true"' : ''; ?>>
                                <?php the_title(); ?>
                            </button>
                        </li>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </ul>
        </nav>
        <?php
        wp_reset_postdata();
    else :
        ?>
        <p><?php _e('Esines viga.', 'emea-2026'); ?></p>
       
    <?php endif; 
         get_template_part("template-parts/footer-icon", null, array(
            'variant' => 2,
            'color' => 'dark',
        ))

    ?>
    

</section>