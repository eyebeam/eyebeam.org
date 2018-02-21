<?php
/*

Hello, this is the eyebeam2018 functions file.
(20180220/dphiffer)

*/

function eyebeam2018_setup() {

	// Flip some WordPress switches to turn on features
	add_theme_support('automatic-feed-links');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');

	// Main navigation
	register_nav_menus(array(
		'top' => 'Top nav'
	));

	// Don't show the version of WordPress (security, yo)
	remove_action('wp_head', 'wp_generator');

}
add_action('init', 'eyebeam2018_setup');

// Add our CSS and JavaScript tags
function eyebeam2018_enqueue() {

	wp_enqueue_style('eyebeam2018-style', get_stylesheet_uri());

	$fonts = get_stylesheet_directory_uri() . '/fonts';
	wp_enqueue_style('eyebeam2018-arial', "$fonts/arial-monospaced.css");
	wp_enqueue_style('eyebeam2018-eyebeam', "$fonts/eyebeam-bold.css");

}
add_action('wp_enqueue_scripts', 'eyebeam2018_enqueue');

// Helper for theme images
function eyebeam2018_img_src($path) {
	echo get_stylesheet_directory_uri() . "/img/$path";
}
