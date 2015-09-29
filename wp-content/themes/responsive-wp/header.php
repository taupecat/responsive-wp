<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Responsive_WP
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'responsive-wp' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="block">

			<div class="header__image">

				<picture>
					<source srcset="http://placehold.it/1024x250, http://placehold.it/2048x500 2x" media="(min-width: 640px)">
					<source srcset="http://placehold.it/640x209, http://placehold.it/1280x418 2x" media="(min-width: 321px)">
					<source srcset="http://placehold.it/320x164, http://placehold.it/640x328 2x">
					<img src="http://placehold.it/320x164" srcset="http://placehold.it/320x164, http://placehold.it/640x328 2x">
				</picture>

			</div>

			<div class="site-branding">
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			</div><!-- .site-branding -->

		</a>

	</header><!-- #masthead -->

	<nav id="site-navigation" class="main-navigation" role="navigation">
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'responsive-wp' ); ?></button>
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
	</nav><!-- #site-navigation -->

	<div id="content" class="site-content">
