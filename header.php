<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package EMEA_2026
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<meta property="og:image" content="<?php echo esc_url( get_template_directory_uri() . '/assets/images/og-image.png' ); ?>" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">


	<header id="masthead" class="header">
			<a aria-label="Mine esilehele" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<svg class="logo" xmlns="http://www.w3.org/2000/svg" width="18" height="28" viewBox="0 0 18 28" fill="none">
  <path d="M4.49995 8.9999C2.0147 8.9999 0 11.0146 0 13.4998C0 15.9851 2.0147 17.9998 4.49995 17.9998C6.9852 17.9998 8.9999 15.9851 8.9999 13.4998C8.9999 11.0146 11.0146 8.9999 13.4998 8.9999C15.9851 8.9999 17.9998 6.98521 17.9998 4.49995C17.9998 2.01469 15.9851 0 13.4998 0C11.0146 0 8.9999 2.01469 8.9999 4.49995C8.9999 6.98521 6.9852 8.9999 4.49995 8.9999Z" fill="#141414"/>
  <path d="M9.00007 22.6304C9.00007 25.1156 11.0148 27.1303 13.5 27.1303C15.9853 27.1303 18 25.1156 18 22.6304C18 20.1451 15.9853 18.1304 13.5 18.1304C11.0148 18.1304 9.00007 16.1157 9.00007 13.6305C9.00007 11.1452 6.98538 9.13054 4.50012 9.13054C2.01487 9.13054 0.000175414 11.1452 0.000175523 13.6305C0.000175631 16.1157 2.01487 18.1304 4.50013 18.1304C6.98538 18.1304 9.00007 20.1451 9.00007 22.6304Z" fill="#141414"/>
</svg>
	</a>

		<nav id="site-navigation" class="nav">
			<?php get_template_part("template-parts/nav-menu") ?>
		</nav>
	</header>
