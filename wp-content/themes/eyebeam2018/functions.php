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
		'top' => 'Top nav',
		'bottom' => 'Bottom nav'
	));

	// Don't show the version of WordPress (security, yo)
	remove_action('wp_head', 'wp_generator');

}
add_action('init', 'eyebeam2018_setup');

function eyebeam2018_css($path, $deps = array()) {
	$name = 'eyebeam2018-' . str_replace('/[^a-z0-9-]/', '-', $path);
	$url = get_stylesheet_directory_uri() . "/$path";
	$version = filemtime(__DIR__ . "/$path");
	wp_enqueue_style($name, $url, $deps, $version);
}

function eyebeam2018_js($path, $deps = array(), $bottom = true) {
	$name = 'eyebeam2018-' . str_replace('/[^a-z0-9-]/', '-', $path);
	$url = get_stylesheet_directory_uri() . "/$path";
	$version = filemtime(__DIR__ . "/$path");
	wp_enqueue_script($name, $url, $deps, $version, $bottom);
}

// Add our CSS and JavaScript tags
function eyebeam2018_enqueue() {
	eyebeam2018_css('fonts/eyebeam-bold.css');
	eyebeam2018_css('fonts/arial-monospaced.css');
	eyebeam2018_css('style.css');
	eyebeam2018_js('js/eyebeam2018.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'eyebeam2018_enqueue');

// Helper for theme images
function eyebeam2018_img_src($path) {
	echo get_stylesheet_directory_uri() . "/img/$path";
}
