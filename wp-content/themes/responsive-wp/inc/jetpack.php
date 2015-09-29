<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Responsive_WP
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function responsive_wp_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'responsive_wp_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function responsive_wp_jetpack_setup
add_action( 'after_setup_theme', 'responsive_wp_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function responsive_wp_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function responsive_wp_infinite_scroll_render
