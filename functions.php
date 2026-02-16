<?php
/**
 * EMEA 2026 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package EMEA_2026
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function emea_2026_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on EMEA 2026, use a find and replace
		* to change 'emea-2026' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'emea-2026', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'emea-2026' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'emea_2026_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'emea_2026_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function emea_2026_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'emea_2026_content_width', 640 );
}
add_action( 'after_setup_theme', 'emea_2026_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function emea_2026_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'emea-2026' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'emea-2026' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'emea_2026_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function emea_2026_scripts() {
	// Base styles
	wp_enqueue_style( 'emea-2026-reset', get_template_directory_uri() . '/assets/css/base/_reset.css', array(), _S_VERSION );
	wp_enqueue_style( 'emea-2026-variables', get_template_directory_uri() . '/assets/css/base/variables.css', array(), _S_VERSION );
	wp_enqueue_style( 'emea-2026-fonts', get_template_directory_uri() . '/assets/css/base/fonts.css', array(), _S_VERSION );
	wp_enqueue_style( 'emea-2026-typography', get_template_directory_uri() . '/assets/css/base/typography.css', array(), _S_VERSION );
	wp_enqueue_style( 'emea-2026-base', get_template_directory_uri() . '/assets/css/base/base.css', array(), _S_VERSION );

	// Layout
	wp_enqueue_style( 'emea-2026-header', get_template_directory_uri() . '/assets/css/layout/header.css', array(), _S_VERSION );
	wp_enqueue_style( 'emea-2026-footer', get_template_directory_uri() . '/assets/css/layout/footer.css', array(), _S_VERSION );
	wp_enqueue_style( 'emea-2026-sections', get_template_directory_uri() . '/assets/css/layout/sections.css', array(), _S_VERSION );

	// Components
	wp_enqueue_style( 'emea-2026-buttons', get_template_directory_uri() . '/assets/css/components/buttons.css', array(), _S_VERSION );
	wp_enqueue_style( 'emea-2026-icons', get_template_directory_uri() . '/assets/css/components/icons.css', array(), _S_VERSION );
	wp_enqueue_style( 'emea-2026-news-grid', get_template_directory_uri() . '/assets/css/components/news-grid.css', array(), _S_VERSION );
	wp_enqueue_style( 'emea-2026-nominees', get_template_directory_uri() . '/assets/css/components/nominees.css', array(), _S_VERSION );
	wp_enqueue_style( 'emea-2026-categories', get_template_directory_uri() . '/assets/css/components/categories.css', array(), _S_VERSION );
	wp_enqueue_style( 'emea-2026-article', get_template_directory_uri() . '/assets/css/components/article.css', array(), _S_VERSION );
	wp_enqueue_style( 'emea-2026-feed', get_template_directory_uri() . '/assets/css/components/feed.css', array(), _S_VERSION );

	// Pages
	wp_enqueue_style( 'emea-2026-landing', get_template_directory_uri() . '/assets/css/pages/landing.css', array(), _S_VERSION );

	// Main stylesheet (required by WordPress)
	wp_enqueue_style( 'emea-2026-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'emea-2026-style', 'rtl', 'replace' );

	wp_enqueue_script( 'emea-2026-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	// Enqueue nominees year menu script
	wp_enqueue_script( 'emea-2026-nominees-year-menu', get_template_directory_uri() . '/js/nominees-year-menu.js', array(), _S_VERSION, true );
	
	// Localize script for AJAX
	wp_localize_script( 'emea-2026-nominees-year-menu', 'emeaAjax', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'emea_nominees_nonce' )
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'emea_2026_scripts' );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * AJAX handler for loading nominees by year
 */
function emea_load_nominees_by_year() {
	// Check nonce
	check_ajax_referer( 'emea_nominees_nonce', 'nonce' );
	
	$year_id = isset( $_POST['year_id'] ) ? intval( $_POST['year_id'] ) : 0;
	
	if ( ! $year_id ) {
		wp_send_json_error( 'Invalid year ID' );
	}
	
	// Query the specific year's nominees
	$nominees_query = new WP_Query( array(
		'post_type' => 'nominee_list',
		'p' => $year_id,
	) );
	
	if ( ! $nominees_query->have_posts() ) {
		wp_send_json_error( 'No nominees found for this year' );
	}
	
	ob_start();
	
	while ( $nominees_query->have_posts() ) : $nominees_query->the_post();
		$categories = get_field( 'categories' );
		
		if ( $categories ) :
			foreach ( $categories as $category ) :
				$row_category = isset( $category['category'] ) ? $category['category'] : '';
				$inner_nominees = isset( $category['nominees'] ) ? $category['nominees'] : array();

				if ( $row_category ) :
					?>
					<article class="nominees__category">
						<h4 class="category__title"><?php echo esc_html( $row_category ); ?></h4>
						<?php
						if ( $inner_nominees ) :
							?>
							<ul class="category__nominees-list">
								<?php
								foreach ( $inner_nominees as $nominee ) :
									$name = isset( $nominee['name'] ) ? $nominee['name'] : '';
									$is_winner = isset( $nominee['is_winner'] ) ? $nominee['is_winner'] : false;

									if ( $is_winner ) :
										$nominee_class = 'category__nominee category__nominee--winner';
									else :
										$nominee_class = 'category__nominee';
									endif;
									
									if ( $name ) :
										?>
										<li class="<?php echo $nominee_class; ?>">
											<p><?php echo esc_html( $name ); ?></p>
										</li>
										<?php
									endif;
								endforeach;
								?>
							</ul>
							<?php
						endif;
						?>
					</article>
					<?php
				endif;
			endforeach;
		endif;
	endwhile;
	
	wp_reset_postdata();
	
	$html = ob_get_clean();
	
	wp_send_json_success( array( 'html' => $html ) );
}
add_action( 'wp_ajax_load_nominees_by_year', 'emea_load_nominees_by_year' );
add_action( 'wp_ajax_nopriv_load_nominees_by_year', 'emea_load_nominees_by_year' );

/**
 * Modify menu links to add home URL to hash links when not on front page
 */
function emea_2026_modify_nav_menu_links( $atts, $item, $args ) {
	// Check if the link is a hash link (starts with #)
	if ( isset( $atts['href'] ) && strpos( $atts['href'], '#' ) === 0 ) {
		// If not on the front page, prepend the home URL
		if ( ! is_front_page() ) {
			$atts['href'] = home_url( '/' ) . $atts['href'];
		}
	}
	
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'emea_2026_modify_nav_menu_links', 10, 3 );

