<?php
/*

Hello, this is the eyebeam2018 functions file.
(20180220/dphiffer)

*/


// We need this filters so that ACF can handle symlinked folders.
// (20180222/dphiffer)
function eyebeam2018_acf_get_dir($dir) {
	if (preg_match('#/wp-content/themes/.+$#', $dir, $matches)) {
		return $matches[0];
	}
	return $dir;
}
add_filter('acf/helpers/get_dir', 'eyebeam2018_acf_get_dir');

// Advanced Custom Fields
$dir = __DIR__;
include_once("$dir/lib/advanced-custom-fields/acf.php");
include_once("$dir/lib/acf-repeater/acf-repeater.php");

// Enable WP_DEBUG in wp-config.php to edit fields
// WP_DEBUG = true / custom fields come from the database
// WP_DEBUG = false / custom fields are included via PHP
if (! defined('WP_DEBUG') || ! WP_DEBUG) {
	define('ACF_LITE', true); // hide the editing UI
	include_once("$dir/custom-fields/modular-grid.php");
}

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

	eyebeam2018_post_types();
}
add_action('init', 'eyebeam2018_setup');

function eyebeam2018_post_types() {

	$labels = array(
		'name' => 'Residents',
		'singular_name' => 'Resident',
		'add_new' => 'Add New Resident',
		'add_new_item' => 'Add New Resident',
		'edit_item' => 'Edit Resident',
		'new_item' => 'New Resident',
		'all_items' => 'All Residents',
		'view_item' => 'View Resident',
		'search_items' => 'Search Residents',
		'not_found' =>  'No Residents Found',
		'not_found_in_trash' => 'No Residents found in Trash',
		'parent_item_colon' => '',
		'menu_name' => 'Residents',
	);
	register_post_type('resident', array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'query_var' => true,
		'supports' => array('title', 'thumbnail', 'page-attributes'),
		'taxonomies' => array('post_tag', 'category'),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'residents' ),
	));

	$labels = array(
		'name' => 'Events',
		'singular_name' => 'Event',
		'add_new' => 'Add New Event',
		'add_new_item' => 'Add New Event',
		'edit_item' => 'Edit Event',
		'new_item' => 'New Event',
		'all_items' => 'All Events',
		'view_item' => 'View Event',
		'search_items' => 'Search Events',
		'not_found' =>  'No Events Found',
		'not_found_in_trash' => 'No Events found in Trash',
		'parent_item_colon' => '',
		'menu_name' => 'Events',
	);
	register_post_type('event', array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'query_var' => true,
		'supports' => array('title', 'thumbnail', 'page-attributes'),
		'taxonomies' => array('post_tag', 'category'),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array('slug' => 'events'),
	));

	$labels = array(
		'name' => 'Recent Press',
		'singular_name' => 'Recent Press',
		'add_new' => 'Add New Recent Press',
		'add_new_item' => 'Add Recent Press',
		'edit_item' => 'Edit Recent Press',
		'new_item' => 'New Recent Press',
		'all_items' => 'All Recent Press',
		'view_item' => 'View Recent Press',
		'search_items' => 'Search Recent Press',
		'not_found' =>  'No Recent Press Found',
		'not_found_in_trash' => 'No Recent Press found in Trash',
		'parent_item_colon' => '',
		'menu_name' => 'Recent Press',
	);
	register_post_type('recentpress', array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'query_var' => true,
		'supports' => array('title', 'thumbnail', 'page-attributes'),
		'taxonomies' => array('post_tag', 'category'),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array('slug' => 'recentpress'),
	));

	$labels = array(
		'name' => 'Media Release',
		'singular_name' => 'Media Release',
		'add_new' => 'Add New Media Release',
		'add_new_item' => 'Add Media Release',
		'edit_item' => 'Edit Media Release',
		'new_item' => 'New Media Release',
		'all_items' => 'All Media Release',
		'view_item' => 'View Media Release',
		'search_items' => 'Search Media Release',
		'not_found' =>  'No Media Release Found',
		'not_found_in_trash' => 'No Media Release found in Trash',
		'parent_item_colon' => '',
		'menu_name' => 'Media Release',
	);
	register_post_type('mediarelease', array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'query_var' => true,
		'supports' => array('title', 'thumbnail','page-attributes' ),
		'taxonomies' => array( 'post_tag', 'category' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'mediarelease' ),
	));

	$labels = array(
		'name' => 'Staff',
		'singular_name' => 'Staff',
		'add_new' => 'Add New Staff',
		'add_new_item' => 'Add Staff',
		'edit_item' => 'Edit Staff',
		'new_item' => 'New Staff',
		'all_items' => 'All Staff',
		'view_item' => 'View Staff',
		'search_items' => 'Search Staff',
		'not_found' =>  'No Staff Found',
		'not_found_in_trash' => 'No Staff found in Trash',
		'parent_item_colon' => '',
		'menu_name' => 'Staff',
	);
	register_post_type( 'staff', array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'query_var' => true,
		'supports' => array('title', 'thumbnail','page-attributes' ),
		'taxonomies' => array( 'post_tag', 'category' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'staff' ),
	));

	$labels = array(
		'name' => 'Board',
		'singular_name' => 'Board',
		'add_new' => 'Add New Board',
		'add_new_item' => 'Add Board',
		'edit_item' => 'Edit Board',
		'new_item' => 'New Board',
		'all_items' => 'All Board',
		'view_item' => 'View Board',
		'search_items' => 'Search Board',
		'not_found' =>  'No Board Found',
		'not_found_in_trash' => 'No Board found in Trash',
		'parent_item_colon' => '',
		'menu_name' => 'Board',
	);
	register_post_type( 'board', array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'query_var' => true,
		'supports' => array('title', 'thumbnail','page-attributes' ),
		'taxonomies' => array( 'post_tag', 'category' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'board' ),
	));

}

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

// This requires that DBUG_PATH is set in wp-config.php.
function dbug() {
	if (empty($GLOBALS['dbug_fh'])) {
		if (! defined('DBUG_PATH')) {
			return;
		}
		$fh = fopen(DBUG_PATH, "a");
		$GLOBALS['dbug_fh'] = $fh;
		$GLOBALS['dbug_start'] = microtime(true);
		fwrite($fh, "----------------------\n");
	}
	$fh = $GLOBALS['dbug_fh'];
	$sec = microtime(true) - $GLOBALS['dbug_start'];
	$sec = number_format($sec, 2);
	$sec = ($sec < 10) ? "0$sec" : $sec;
	$args = func_get_args();
	foreach ($args as $arg) {
		if (! is_scalar($arg)) {
			$arg = print_r($arg, true);
			$arg = trim($arg);
		}
		fwrite($fh, "[$sec] $arg\n");
	}
}
