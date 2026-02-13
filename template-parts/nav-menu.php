<button class="nav__menu-btn" aria-expanded="false" aria-controls="nav__menu">
    Menüü
</button>
<div id="nav__menu">
    <?php
    $locations = get_nav_menu_locations();
    $menu_id = isset($locations['menu-1']) ? $locations['menu-1'] : 0;
    $menu_items = wp_get_nav_menu_items($menu_id);
    
    if ($menu_items) :
    ?>
        <ul id="primary-menu" class="menu">
        <?php foreach ($menu_items as $item) : 
            $url = $item->url;
            
            // Add home URL to hash links when not on front page
            if (strpos($url, '#') === 0 && !is_front_page()) {
                $url = home_url('/') . $url;
            }
        ?>
            <li class="menu-item">
                <a href="<?php echo esc_url($url); ?>"><?php echo esc_html($item->title); ?></a>
            </li>
        <?php endforeach; 
            $ticket_link = get_field("ticket_link","option");

            if ($ticket_link):
        ?>
            <li class="menu-item menu-item--tickets">
                <a target="_blank" rel="noreferrer noopener" href="<?php echo esc_url($ticket_link); ?>">Osta pilet</a>
            </li>
            <?php 
            endif;
             ?>
        </ul>
    <?php endif; ?>
</div>
