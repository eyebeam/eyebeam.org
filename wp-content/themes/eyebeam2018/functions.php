<?php
/*

Hello, this is the eyebeam2018 functions file.
(20180220/dphiffer)

*/

// Advanced Custom Fields
$dir = __DIR__;
include_once("$dir/advanced-custom-fields/acf.php");
include_once("$dir/acf-repeater/acf-repeater.php");

// Enable WP_DEBUG in wp-config.php to edit fields
// WP_DEBUG = true / custom fields come from the database
// WP_DEBUG = false / custom fields are included via PHP
if (! defined('WP_DEBUG') || ! WP_DEBUG) {
	define('ACF_LITE', true); // hide the editing UI
	include_once("$dir/custom-fields/modular-grid.php");
}

// We need these filters so that ACF can handle symlinked folders. This assumes
// the symlink target folder path ends with "eyebeam.org" or
// "staging.eyebeam.org" or any "*.eyebeam.org" (20180222/dphiffer)
function eyebeam2018_acf_settings_path($path) {
	$path = get_stylesheet_directory() . '/advanced-custom-fields/';
	return $path;
}
add_filter('acf/settings/path', 'eyebeam2018_acf_settings_path');

function eyebeam2018_acf_settings_dir($dir) {
	$dir = get_stylesheet_directory_uri() . '/advanced-custom-fields/';
	return $dir;
}
add_filter('acf/settings/dir', 'eyebeam2018_acf_settings_dir');

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

	// Weird that this is even necessary...
	add_theme_support('html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	));
}
add_action('init', 'eyebeam2018_setup');

function eyebeam2018_enqueue_css($path, $deps = array()) {
	$name = 'eyebeam2018-' . str_replace('/[^a-z0-9-]/', '-', $path);
	$url = get_stylesheet_directory_uri() . "/$path";
	$version = filemtime(__DIR__ . "/$path");
	wp_enqueue_style($name, $url, $deps, $version);
}

function eyebeam2018_enqueue_js($path, $deps = array(), $bottom = true) {
	$name = 'eyebeam2018-' . str_replace('/[^a-z0-9-]/', '-', $path);
	$url = get_stylesheet_directory_uri() . "/$path";
	$version = filemtime(__DIR__ . "/$path");
	wp_enqueue_script($name, $url, $deps, $version, $bottom);
}

// Add our CSS and JavaScript tags
function eyebeam2018_enqueue() {
	eyebeam2018_enqueue_css('fonts/eyebeam-bold.css');
	eyebeam2018_enqueue_css('fonts/arial-monospaced.css');
	eyebeam2018_enqueue_css('style.css');
	eyebeam2018_enqueue_js('js/eyebeam2018.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'eyebeam2018_enqueue');

// Helper for theme images
function eyebeam2018_img_src($path) {
	$version = filemtime(__DIR__ . "/$path");
	echo get_stylesheet_directory_uri() . "/$path?ver=$version";
}

function eyebeam2018_subscribe() {

	if (! empty($_POST['first_name']) &&
	    ! empty($_POST['last_name']) &&
	    ! empty($_POST['email']) &&
	    preg_match('/\w+@\w+\.\w+/', $_POST['email'])) {
		$first_name = $_POST['first_hame'];
		$last_name = $_POST['last_hame'];
		$email = $_POST['email'];

		// Something something subscribe to email list

		$rsp = array(
			'ok' => 1
		);
	} else {
		$rsp = array(
			'ok' => 0
		);
	}

	$headers = apache_request_headers();
	if (! empty($headers['X-Requested-With']) &&
	    $headers['X-Requested-With'] == 'XMLHttpRequest') {
		header('Content-Type: application/json');
		echo json_encode($rsp);
		exit;
	} else if (! empty($headers['Referer'])) {
		$redirect = $headers['Referer'];
		$result = "subscribed={$rsp['ok']}";
		if (preg_match('/subscribed=[^&]+/', $redirect)) {
			$redirect = preg_replace('/subscribed=[^&]+/', $result, $redirect);
		} else if (strpos($redirect, '?') === false) {
			$redirect .= "?$result";
		} else {
			$redirect .= "&$result";
		}
		$redirect .= '#subscribe';
		header("Location: $redirect");
		exit;
	} else if ($rsp['ok'] == 1) {
		echo "Thanks for subscribing!";
	} else {
		echo "That didn’t work for some reason.";
	}
}
add_action('wp_ajax_eyebeam2018_subscribe', 'eyebeam2018_subscribe');
add_action('wp_ajax_nopriv_eyebeam2018_subscribe', 'eyebeam2018_subscribe');
