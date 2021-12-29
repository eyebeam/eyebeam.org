<?php
/*

Hello, this is the eyebeam2018 functions file.
(20180220/dphiffer)

For your convenience, here is a list of all the functions in here:
* eyebeam2018_acf_get_dir: make ACF work with symlinks
* eyebeam2018_setup: init hook
* eyebeam2018_enqueue_css: add cache-busting URL arg
* eyebeam2018_enqueue_js: add cache-busting URL arg
* eyebeam2018_enqueue: include front-end assets
* eyebeam2018_img_src: add cache-busting URL arg
* eyebeam2018_get_image: helper for image uploads
* eyebeam2018_get_image_html: helper for outputting image uploads
* eyebeam2018_hero: register hero item
* eyebeam2018_module: register a module item
* eyebeam2018_render_heroes: calls get_template_part for each hero item
* eyebeam2018_render_modules: calls get_template_part for each hero item
* eyebeam2018_get_related
* eyebeam2018_get_residents: returns array of resident posts
* eyebeam2018_ajax_residents: AJAX handler for residents-by-year
* eyebeam2018_video_embed: show an embed, given a video permalink
* eyebeam2018_youtube_embed: show a ~YouTube~ embed
* eyebeam2018_subscribe: AJAX handler for Mailchimp subscription
* eyebeam2018_subscribe_request: makes Mailchimp API request
* eyebeam2018_donate: AJAX handler for donations
* eyebeam2018_donate_request: makes Stripe API request
* eyebeam2018_donate_normalize: massage the donate submission values
* eyebeam2018_donate_validate: ensure the donate submission is valid
* eyebeam2018_extract_intro: the_content filter, pulls out intro text
* eyebeam2018_content_fields: inserts the_content-like ACF content fields
* eyebeam2018_shortcode_filter: tweak shortcode outputs
* eyebeam2018_view_source: show any secret blog posts
* eyebeam2018_view_source_post: register secret blog post
* eyebeam2018_resident_bio: returns a resident bio
* eyebeam2018_get_events: returns an array of event posts
* eyebeam2018_get_ideas: returns an array of ideas posts
* eyebeam2018_lazy_load: AJAX handler for lazy loading content
* eyebeam2018_db_migration_1: update resident links

Auction-related functions:
* auction_verify_id
* auction_get_bidder_by_id
* auction_get_bidder_by_email
* auction_load_bidders
* auction_mark_bids_as_verified
* auction_next_amount
* auction_name
* auction_email
* auction_phone
* auction_normalize_email
* auction_is_verified
* auction_is_leading_bid
* auction_send_verification
* auction_bid

Dev functions:
* dbug: kinda like error_log, but more flexible

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

// disable gutenberg on all blog posts
add_filter('use_block_editor_for_post', '__return_false', 10);

// Libraries
$dir = __DIR__;
// include_once("$dir/lib/advanced-custom-fields-pro/acf.php");
// include_once("$dir/lib/acf-repeater/acf-repeater.php");
include_once("$dir/lib/custom-post-types.php");

// Enable WP_DEBUG in wp-config.php to edit fields
// WP_DEBUG = true / custom fields come from the database
// WP_DEBUG = false / custom fields are included via PHP
if (! defined('WP_DEBUG') || ! WP_DEBUG) {

	// define('ACF_LITE', true); // hide the editing UI

	// include_once("$dir/lib/custom-fields/archive-page.php");
	// include_once("$dir/lib/custom-fields/archive-post.php");
	// include_once("$dir/lib/custom-fields/auction-artwork.php");
	// include_once("$dir/lib/custom-fields/board.php");
	// include_once("$dir/lib/custom-fields/community.php");
	// include_once("$dir/lib/custom-fields/education.php");
	// include_once("$dir/lib/custom-fields/events.php");
	// include_once("$dir/lib/custom-fields/interns.php");
	// include_once("$dir/lib/custom-fields/media-release.php");
	// include_once("$dir/lib/custom-fields/modular-grid.php");
	// include_once("$dir/lib/custom-fields/post.php");
	// include_once("$dir/lib/custom-fields/page.php");
	// include_once("$dir/lib/custom-fields/recent-press.php");
	// include_once("$dir/lib/custom-fields/residency.php");
	// include_once("$dir/lib/custom-fields/residents.php");
	// include_once("$dir/lib/custom-fields/projects.php");
	// include_once("$dir/lib/custom-fields/staff.php");
}

function eyebeam2018_setup() {

	// Flip some WordPress switches to turn on features
	add_theme_support('automatic-feed-links');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');

	// Main navigation
	register_nav_menus(array(
		'top' => 'Top nav',
		'bottom' => 'Bottom nav',
		'bottom_middle' => 'Bottom nav middle',
		'bottom_right' => 'Bottom nav right'
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

	// Custom image sizes
	add_image_size('hero', 2560, 0, false);

	// Yeah, globals are bad, but at least we namespace ours
	$GLOBALS['eyebeam2018'] = array(
		'heroes' => array(),
		'modules' => array()
	);

	// Register taxonomies to custom posts
	register_taxonomy_for_object_type('post_tag', 'archive');
	register_taxonomy_for_object_type('post_tag', 'resident');
	register_taxonomy_for_object_type('post_tag', 'project');
	register_taxonomy_for_object_type('post_tag', 'event');
	register_taxonomy_for_object_type('category', 'archive');
	register_taxonomy_for_object_type('category', 'resident');
	register_taxonomy_for_object_type('category', 'project');
	register_taxonomy_for_object_type('category', 'event');

}
add_action('init', 'eyebeam2018_setup');

// Add a cache-buster to the URL
function eyebeam2018_enqueue_css($path, $deps = array()) {
	$name = 'eyebeam2018-' . str_replace('/[^a-z0-9-]/', '-', $path);
	$url = get_stylesheet_directory_uri() . "/$path";
	$version = filemtime(__DIR__ . "/$path");
	wp_enqueue_style($name, $url, $deps, $version);
}

// Add a cache-buster to the URL
function eyebeam2018_enqueue_js($path, $deps = array(), $bottom = true) {
	$name = 'eyebeam2018-' . str_replace('/[^a-z0-9-]/', '-', $path);
	$url = get_stylesheet_directory_uri() . "/$path";
	$version = filemtime(__DIR__ . "/$path");
	wp_enqueue_script($name, $url, $deps, $version, $bottom);
}

// Add our CSS and JavaScript tags
function eyebeam2018_enqueue() {

	eyebeam2018_enqueue_css('fonts/eyebeamsans.css');
	eyebeam2018_enqueue_css('lib/jquery-ui/jquery-ui.css');
	eyebeam2018_enqueue_css('lib/swiper/dist/css/swiper.min.css');
	eyebeam2018_enqueue_css('style.css');

	eyebeam2018_enqueue_js('lib/jquery-ui/jquery-ui.js', array('jquery'));
	eyebeam2018_enqueue_js('lib/swiper/dist/js/swiper.min.js');
	eyebeam2018_enqueue_js('lib/knot.js/knot.js');
	// eyebeam2018_enqueue_js('lib/bricks.js/bricks.js');
	eyebeam2018_enqueue_js('lib/macy/macy.js');
	eyebeam2018_enqueue_js('lib/micromodal/micromodal.min.js');
	eyebeam2018_enqueue_js('js/eyebeam2018.js', array('jquery'));

}
add_action('wp_enqueue_scripts', 'eyebeam2018_enqueue');

// Update CSS within in Admin
function admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/admin-style.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

// Enqueue dash icons
add_action( 'wp_enqueue_scripts', 'load_dashicons_front_end' );
function load_dashicons_front_end() {
	wp_enqueue_style( 'dashicons' );
}

// Helper for theme images
function eyebeam2018_img_src($path) {
	$version = filemtime(__DIR__ . "/$path");
	echo get_stylesheet_directory_uri() . "/$path?ver=$version";
}

// Helper for image uploads
function eyebeam2018_get_image($attachment_id, $size = 'fullsize') {
	$src = wp_get_attachment_image_src($attachment_id, $size);
	$alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
	$title = get_post_meta($attachment_id, '_wp_attachment_image_title', true);
	return array(
		'src' => $src[0],
		'width' => $src[1],
		'height' => $src[2],
		'alt' => $alt,
		'title' => $title,
	);
}

// Helper for outputting image uploads
function eyebeam2018_get_image_html($attachment_id, $size = 'large', $show_caption = false, $url = false) {

	$image = eyebeam2018_get_image($attachment_id, $size);

	$image = $image['src'];
	$caption = wp_get_attachment_caption($attachment_id);
	$alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
	$title_text = get_post($attachment_id);
	$title_text = $title_text->title;

	$html;
	$html .= ($url) ? "<a href=\"$url\">\n" : "";
	$html .= "<img alt=\"$alt_text\" title=\"$title_text\" src=\"$image\">\n";
	$html .= ($url) ? "</a>\n" : "";
	if ($show_caption && $caption){
		$html .= "<figcaption>\n";
		$html .= $caption."\n";
		$html .= "</figcaption>";
	}
	return $html;
}

// Register a hero item
function eyebeam2018_hero($hero) {
	$GLOBALS['eyebeam2018']['heroes'][] = $hero;
}

// Register a module item
function eyebeam2018_module($module) {
	$GLOBALS['eyebeam2018']['modules'][] = $module;
}

// Render each hero item's template
function eyebeam2018_render_heroes() {
	foreach ($GLOBALS['eyebeam2018']['heroes'] as $hero) {

		// See this curr_hero global? It's important! It's how the
		// page template knows what stuff to show.
		$GLOBALS['eyebeam2018']['curr_hero'] = $hero;

		get_template_part('templates/page-hero', $hero['type']);
	}
}

// Render each module item's template
function eyebeam2018_render_modules() {

	$class = 'module-container';

	// Okay this is weird, but it's necessary for getting the module order
	// right on mobile. Basically, we swap the TOC with the first module.
	if (count($GLOBALS['eyebeam2018']['modules']) > 1 &&
	    $GLOBALS['eyebeam2018']['modules'][0]['type'] == 'toc') {

		$toc = $GLOBALS['eyebeam2018']['modules'][0];
		$module = $GLOBALS['eyebeam2018']['modules'][1];

		$GLOBALS['eyebeam2018']['modules'][0] = $module;
		$GLOBALS['eyebeam2018']['modules'][1] = $toc;

		$class .= ' module-swap-toc';
	}

	echo "<div class=\"$class\">\n";
	echo "<ul>\n";

	foreach ($GLOBALS['eyebeam2018']['modules'] as $module) {

		// See this curr_module global? It's important! It's how the
		// page template knows what stuff to show.
		$GLOBALS['eyebeam2018']['curr_module'] = $module;
		get_template_part('templates/page-module', $module['type']);
	}

	echo "</ul>\n";
	echo "<br class=\"clear\">\n";
	echo "</div>\n";
}

function column_map($class = null){
	$map = array(
		"two-columns" => 2,
		"three-columns" => 3,
		"four-columns" => 4,
		"five-columns" => 5,
	);

	if (!empty($class)){
		return $map[$class];

	}
}

// map post type to template
function eyebeam2018_template_map($post_type = null) {

	if (empty($post_type)) {
		$posttype = get_post_type();
	}

	$post_type_map = array(
			'resident' => 'resident-item',
			'event' => 'event-item',
			'post' => 'post-item',
			'archive' => 'archive-featured-item',
			'project' => 'project-item',

		);

	return $post_type_map[$post_type];

}

function eyebeam2018_label_map($key = null){
	if (empty($key))
		return false;

	$label = array(
			'post' => 'Blog',
			'resident' => 'Resident',
			'event'	=> 'Event',
			'archive' => 'Archive',
			'project' => 'Project',
		);
	return $label[$key];
}

// Returns an array of related posts for a given post id
function eyebeam2018_get_related_readings($postid = null) {

	if (empty($postid)) {
		$postid = get_the_id();
	}

	// types of related posts
	$post_types = array(
			'event',
			'post',
			'archive',
			'resident',
			'project',
		);

	// get the tags
	$tags = wp_get_post_terms( get_queried_object_id(), 'post_tag', ['fields' => 'ids'] );

	if (!count($tags))
		return false;

	// build out a list of each post type
	$args = array(
		'post_type' => $post_types,
		'posts_per_page' => 3,
		'post__not_in' => array($postid),
		'orderby' => 'rand',
		'tag__in' => $tags,
	);

	$related_readings = get_posts($args);
	wp_reset_postdata();
	return $related_readings;


}

// Returns an array of resident posts for a given year
function eyebeam2018_get_residents($start_year = null, $end_year = null, $limit = null) {
	if (empty($start_year)) {
		$start_year = date('Y')-1;
	}
	if (empty($end_year)) {
		$end_year = date('Y');
	}


	$args = array(
		'post_type' => 'resident',
		'posts_per_page' => -1,
		'orderby'=> 'meta_value_num',
		'meta_key' => 'end_year',
	);

	if (!is_null($limit) || $limit > 0 ){
		$args['posts_per_page'] = $limit;
	}


	if (strtolower($year) != 'all') {
		$start_year = intval($start_year);
		$end_year = intval($end_year);
		$args['meta_query'] = array(
			'relation' => 'AND',
			'start_clause' => array(
				'key'=> 'start_year',
				'value'=> $start_year,
				'compare'=> '<='
			),
			'end_clause' => array(
				'key'=> 'end_year',
				'value' => $end_year,
				'compare'=> '>='
			),
		);
	}

	$posts = get_posts($args);
	return $posts;
}

// AJAX handler for resident requests (by year)
function eyebeam2018_ajax_residents() {
	if (empty($_GET['year'])) {
		die('No year specified');
	}
	$year = $_GET['year'];
	$residents = eyebeam2018_get_residents($year);


	foreach ($residents as $resident) {
		$GLOBALS['eyebeam2018']['curr_collection_item'] = $resident;
		get_template_part('templates/collection-resident-item');
	}
	exit;
}
add_action('wp_ajax_eyebeam2018_residents', 'eyebeam2018_ajax_residents');
add_action('wp_ajax_nopriv_eyebeam2018_residents', 'eyebeam2018_ajax_residents');

// Outputs a video embed from its permalink URL
function eyebeam2018_video_embed($video_url) {

	// TODO: make this work with more video hosts, currently we only support
	// YouTube. I mean, should we let oembed or shortcodes handle this? It's
	// not like this is the first video to get embedded onto WordPress. for
	// now we just do it the dumb/easy way. (20180303/dphiffer)

	// use regex to find  youtube video id
	preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $video_url, $matches);

	$video_id = $matches[0];

	$embed_url = "https://youtube.com/embed/$video_id";

	if (!empty($matches)){
		echo "<div class=\"featured-video\">";
		echo "<iframe src=\"$embed_url\"></iframe>";
		echo "</div>";
	}
	else {
		echo "<!-- could not render video embed for $embed_url -->\n";
	}
}

// no longer in use
// Handler for YouTube video embeds
function eyebeam2018_youtube_embed($matches) {
	$id = $matches[1];
	$src = "https://www.youtube.com/embed/$id";
	$args = 'frameborder="0" allow="autoplay; encrypted-media" allowfullscreen';
	$embed = "<iframe src=\"$src\" $args></iframe>";
	$embed = "<div class=\"featured-video\">$embed</div>\n";
	echo $embed;
}

// AJAX handler for email subscribers
function eyebeam2018_subscribe() {

	$rsp = eyebeam2018_subscribe_request();
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
	} else if ($rsp['error']) {
		echo $rsp['error'];
	} else {
		echo "That didn’t work for some reason.";
	}
}
add_action('wp_ajax_eyebeam2018_subscribe', 'eyebeam2018_subscribe');
add_action('wp_ajax_nopriv_eyebeam2018_subscribe', 'eyebeam2018_subscribe');

// Actually *do* the API request to Mailchimp
function eyebeam2018_subscribe_request($list_id = null) {

	// I mean, yes, I know there are plugins that do this sort of thing. But
	// ultimately it's an API, and we should be able to debug it when it
	// breaks. So we just use cURL and typing. (20180303/dphiffer)

	if (! defined('MAILCHIMP_API_KEY')) {
		return array(
			'ok' => 0,
			'error' => 'MAILCHIMP_API_KEY is undefined.'
		);
	} else if (! defined('MAILCHIMP_LIST_ID')) {
		return array(
			'ok' => 0,
			'error' => 'MAILCHIMP_LIST_ID is undefined.'
		);
	} else if (! empty($_POST['first_name']) &&
	           ! empty($_POST['last_name']) &&
	           ! empty($_POST['email']) &&
	           preg_match('/\w+@\w+\.\w+/', $_POST['email'])) {
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];

		if (! preg_match('/^[a-z0-9]+-(\w+)$/', MAILCHIMP_API_KEY, $matches)) {
			return array(
				'ok' => 0,
				'error' => 'Invalid MAILCHIMP_API_KEY.'
			);
		}
		$dc = $matches[1];

		$base_url = "https://$dc.api.mailchimp.com/3.0";

		if (empty($list_id)) {
			$list_id = MAILCHIMP_LIST_ID;
		}
		$subscriber = trim($email);
		$subscriber = strtolower($subscriber);
		$subscriber = md5($subscriber);
		$url = "$base_url/lists/$list_id/members/$subscriber";
		$data = json_encode(array(
			'email_address' => $email,
			'status' => 'subscribed',
			'merge_fields' => array(
				'FNAME' => $first_name,
				'LNAME' => $last_name
			)
		));
		$headers = array(
			'Content-Type: application/json'
		);
		$userpwd = ':' . MAILCHIMP_API_KEY;

		//dbug($url);
		//dbug($data);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_USERPWD, $userpwd);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);

		$json = curl_exec($ch);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		//dbug($status);
		//dbug($json);

		if ($status != 200) {
			return array(
				'ok' => 0,
				'error' => 'Bad response from MailChimp API.'
			);
		}

		$rsp = json_decode($json, 'as hash');
		if (empty($rsp['status'])) {
			return array(
				'ok' => 0,
				'error' => 'Uncertain response from MailChimp API.'
			);
		}

		return array(
			'ok' => 1,
			'status' => $rsp['status']
		);
	} else {
		return array(
			'ok' => 0,
			'error' => 'Sorry, all the fields are required.'
		);
	}
}

// AJAX handler for donations
function eyebeam2018_donate() {

	$rsp = eyebeam2018_donate_request();

	if ($rsp['ok'] == 1 &&
	    defined('MAILCHIMP_DONORS_LIST_ID')) {
		eyebeam2018_subscribe_request(MAILCHIMP_DONORS_LIST_ID);
	}

	$headers = array();
	if (function_exists('apache_request_headers')) {
		$headers = apache_request_headers();
	}

	if (! empty($headers['X-Requested-With']) &&
	    $headers['X-Requested-With'] == 'XMLHttpRequest') {
		header('Content-Type: application/json');
		echo json_encode($rsp);
		exit;
	} else if (! empty($headers['Referer'])) {
		$redirect = $headers['Referer'];
		$result = "donation={$rsp['ok']}";
		if (preg_match('/donation=[^&]+/', $redirect)) {
			$redirect = preg_replace('/donation=[^&]+/', $result, $redirect);
		} else if (strpos($redirect, '?') === false) {
			$redirect .= "?$result";
		} else {
			$redirect .= "&$result";
		}
		$redirect .= '#donate';
		header("Location: $redirect");
		exit;
	} else if ($rsp['ok'] == 1) {
		echo "Thank you so much for your donation!";
	} else if ($rsp['error']) {
		echo $rsp['error'];
	} else {
		echo "Sorry, that didn’t work for some reason.";
	}
	exit;
}
add_action('wp_ajax_eyebeam2018_donate', 'eyebeam2018_donate');
add_action('wp_ajax_nopriv_eyebeam2018_donate', 'eyebeam2018_donate');

// Actually *do* the Stripe API request
function eyebeam2018_donate_request() {

	//dbug('eyebeam2018_donate_request');

	$dir = __DIR__;
	require_once("$dir/lib/stripe-php/init.php");

	$values = eyebeam2018_donate_normalize($_POST);
	//dbug('eyebeam2018_donate_normalize:', $values);

	if (! defined('STRIPE_TEST_KEY') ||
	    ! defined('STRIPE_TEST_SECRET') ||
	    ! defined('STRIPE_LIVE_KEY') ||
	    ! defined('STRIPE_LIVE_SECRET')) {
		return array(
			'ok' => 0,
			'error' => 'Stripe API keys are not setup.'
		);
	} else if (eyebeam2018_donate_validate($values)) {

		if (defined('STRIPE_USE_LIVE') && STRIPE_USE_LIVE) {
			$key = STRIPE_LIVE_KEY; // This isn't actually used here
			$secret = STRIPE_LIVE_SECRET;
		} else {
			$key = STRIPE_TEST_KEY; // This isn't actually used here
			$secret = STRIPE_TEST_SECRET;
		}

		//dbug('setting API key...');

		\Stripe\Stripe::setApiKey($secret);

		//dbug('creating charge...');

		try {
			$charge_details = array(
				'amount' => $values['amount'],
				'currency' => 'usd',
				'description' => 'Donation to Eyebeam. Thank you!',
				'source' => $values['token']
			);
			$charge = \Stripe\Charge::create($charge_details);
		} catch (Exception $e) {
			//dbug($e);
			return array(
				'ok' => 0,
				'error' => 'Error from Stripe API: ' . $e->getMessage()
			);
		}

		//dbug($charge);

		return array(
			'ok' => 1
		);

	} else {
		return array(
			'ok' => 0,
			'error' => 'Sorry, all the fields are required.'
		);
	}
}

// Massage the donate submission values
function eyebeam2018_donate_normalize($raw) {
	$vars = array(
		'first_name',
		'last_name',
		'email',
		'amount',
		'token'
	);
	$normalized = array();
	foreach ($vars as $var) {
		$normalized[$var] = trim($raw[$var]);
		if ($var == 'email') {
			$normalized[$var] = strtolower($normalized[$var]);
		} else if ($var == 'amount' &&
		           $normalized['amount'] == 'other') {
			$normalized[$var] = trim($raw['amount_other']);
		}
	}
	$normalized['amount'] = str_replace('$', '', $normalized['amount']);
	$normalized['amount'] = floatval($normalized['amount']);

	// IMPORTANT: Stripe's API operates in cents, not dollars. So we need to
	// multiply by 100 in order to charge properly. (20180312/dphiffer)

	$normalized['amount'] = floor(100 * $normalized['amount']);
	return $normalized;
}

// Ensure the donate submission is valid
function eyebeam2018_donate_validate($values) {
	$required = array(
		'first_name',
		'last_name',
		'email',
		'amount',
		'token'
	);
	$numeric = array(
		'amount'
	);
	foreach ($required as $var) {
		if (empty($values[$var])) {
			return false;
		}
		if (in_array($var, $numeric) &&
		    ! is_numeric($values[$var])) {
			return false;
		}
	}
	if (! preg_match('/\w+@\w+\.\w+/', $values['email'])) {
		return false;
	}
	return true;
}

// A filter for the_content, that sets a 'post_intro' global var
function eyebeam2018_extract_intro($content) {

	// Override any of this above stuff with the Summary Column
	if ( !empty(get_field('summary'))){
		$GLOBALS['eyebeam2018']['post_intro'] = get_field('summary');
	}

	$sections = preg_split('/<hr\s*\/?>/', $content);
if (count($sections) < 2) { return $content; } // if (preg_match('/<i>(.+?)<\ /i>/ims', $sections[0], $matches)) {
        // $intro = array_shift($sections);

        // // TODO: get some htmlpurifier in the mix here
        // $intro = preg_replace('/<span[^>]*>/', '', $intro);
            // $intro = preg_replace('/<\ /span[^>]*>/', '', $intro);
                // $intro = preg_replace('/<i[^>]*>/', '', $intro);
                    // $intro = preg_replace('/<\ /i[^>]*>/', '', $intro);

                        // $GLOBALS['eyebeam2018']['post_intro'] = $intro;
                        // return implode('<br>', $sections);
                        // }




                        return $content;
                        }

                        // Inserts the_content-like content from ACF
                        function eyebeam2018_content_fields($content) {
                        if (get_field('event_info')) {
                        $content .= get_field('event_info');
                        }
                        if (get_field('project_description')){
                        $content .= get_field('project_description');
                        }
                        if (get_field('resident_type')){
                        $content .= get_field('resident_type');
                        $content .= "\n";
                        }
                        if (get_field('start_year') && get_field('end_year')){
                        $start_year = get_field('start_year');
                        $end_year = get_field('end_year');
                        $content .= "$start_year - $end_year\n";
                        }

                        if (get_field('resident_bio')){
                        $content .= get_field('resident_bio');
                        }

                        return $content;
                        }

                        // Tweak shortcode outputs
                        function eyebeam2018_shortcode_filter($output, $tag, $attrs) {
                        if ($tag == 'embed') {
                        return "<div class=\"video-container\">$output</div>";
                        }
                        return $output;
                        }
                        add_filter('do_shortcode_tag', 'eyebeam2018_shortcode_filter', 10, 3);

                        // Inserts a secret blog post as an HTML comment
                        function eyebeam2018_view_source() {
                        if (empty($GLOBALS['eyebeam2018']['view_source_post'])) {
                        return;
                        }

                        $slug = $GLOBALS['eyebeam2018']['view_source_post'];
                        $dir = __DIR__;
                        $header = "$dir/lib/.ignore/00-header.txt";
                        $path = "$dir/lib/.ignore/$slug.txt";

                        if (! file_exists($path)) {
                        return;
                        }

                        echo "
                        <!--\n";
	echo file_get_contents($header);
	echo "\n///// VIEW SOURCE BLOG: $slug /////\n\n";
	echo file_get_contents($path);
	echo "-->\n";
                        }
                        add_action('eyebeam2018_view_source', 'eyebeam2018_view_source');

                        // Register a secret blog post for a given page
                        function eyebeam2018_view_source_post($slug) {
                        $GLOBALS['eyebeam2018']['view_source_post'] = $slug;
                        }

                        // Returns a resident bio
                        function eyebeam2018_resident_bio($resident, $members = null) {
                        $bio = '';

                        //$bio = apply_filters('the_content', $resident->post_content);

                        $links = get_field('links', $resident->ID);
                        if (! empty($members)) {
                        foreach ($members as $member) {
                        $member_links = get_field('links', $member->ID);
                        if (! empty($member_links)) {
                        $links = array_merge($links, $member_links);
                        }
                        }
                        }

                        if (! empty($links)) {
                        $bio .= "\n<div class=\"resident-links\">\n";
                            $link_items = array();
                            foreach ($links as $link) {
                            $esc_title = htmlentities($link['link_title']);
                            $esc_url = htmlentities($link['link_url']);
                            $link_items[] = "<a href=\"$esc_url\">$esc_title</a>";
                            }
                            $bio .= implode("<br>\n", $link_items) . "\n";
                            $bio .= "</div>\n";
                        }

                        return $bio;
                        }

                        // Returns an array of project posts
                        function eyebeam2018_get_projects($page = 1) {
                        $args = array(
                        'post_type' => 'project',
                        'posts_per_page' => 9,
                        );
                        return get_posts($args);
                        }

                        // Returns an array of event posts

                        function eyebeam2018_get_events($page = 1, $posts_per_page = 6) {
                        $today = date('Ymd');
                        $args = array(
                        'post_type' => 'event',
                        'posts_per_page' => $posts_per_page,
                        'orderby'=> 'meta_value',
                        'meta_key' => 'end_date',
                        'order' => 'DESC',
                        'paged' => $page,
                        );
                        return get_posts($args);

                        }

                        // Returns an event post for a given day
                        function eyebeam2018_get_event($day = null) {
                        if ($day){
                        $day = date('Ymd', strtotime($day) );
                        $args = array(
                        'post_type' => 'event',
                        'posts_per_page' => 3,
                        'orderby'=> 'meta_value',
                        'meta_key' => 'end_date',
                        'order' => 'DESC',
                        'meta_query' => array(
                        array(
                        'key'=> 'start_date',
                        'value'=> $day,
                        'compare'=> '='
                        ),
                        )
                        );
                        return get_posts($args);
                        }
                        else {
                        return false;
                        }

                        }


                        // Returns an array of blog posts
                        function eyebeam2018_get_blog_posts($page = 1) {

                        if (!isset($collection_post_limit)){
                        $collection_post_limit = 9;
                        }

                        $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => $collection_post_limit,
                        'category_name' => 'from-eyebeam, artist-interview, artist-reflection',
                        'paged' => $page,
                        'orderby' => 'DESC',
                        );
                        return get_posts($args);
                        }

                        // Returns an array of ideas posts
                        function eyebeam2018_get_ideas($page = 1) {
                        $posts = get_posts(array(
                        'post_type' => 'post',
                        'posts_per_page' => 9,
                        'paged' => $page
                        ));
                        return $posts;
                        }

                        // AJAX handler for lazy loading content
                        function eyebeam2018_lazy_load() {
                        if (empty($_GET['load'])) {
                        die("Please specify a 'load' argument.");
                        }
                        $page = intval($_GET['page']);
                        if ($_GET['load'] == 'events') {
                        $posts = eyebeam2018_get_events($page, $_GET['limit']);
                        foreach ($posts as $post) {
                        $GLOBALS['eyebeam2018']['curr_collection_item'] = $post;
                        get_template_part('templates/collection-event-item');
                        }
                        } else if ($_GET['load'] == 'event'){
                        if (!$_GET['day'])
                        return false;
                        $posts = eyebeam2018_get_event($_GET['day']);
                        if (!$posts){
                        $GLOBALS['eyebeam2018']['curr_collection_item'] = false;
                        get_template_part('templates/collection-event-item');
                        }
                        else {
                        foreach ($posts as $post) {
                        $GLOBALS['eyebeam2018']['curr_collection_item'] = $post;
                        get_template_part('templates/collection-event-item');
                        }
                        }


                        } else if ($_GET['load'] == 'ideas') {
                        $posts = eyebeam2018_get_ideas($page);
                        foreach ($posts as $post) {
                        $GLOBALS['eyebeam2018']['curr_collection_item'] = $post;
                        get_template_part('templates/collection-ideas-item');
                        }
                        } else if ($_GET['load'] == 'posts') {
                        $posts = eyebeam2018_get_blog_posts($page);
                        foreach ($posts as $post) {
                        $GLOBALS['eyebeam2018']['curr_collection_item'] = $post;
                        get_template_part('templates/collection-post-item');
                        }
                        }
                        exit;
                        }
                        add_action('wp_ajax_eyebeam2018_lazy_load', 'eyebeam2018_lazy_load');
                        add_action('wp_ajax_nopriv_eyebeam2018_lazy_load', 'eyebeam2018_lazy_load');

                        // Update resident links
                        function eyebeam2018_db_migration_1() {
                        echo '
                        <pre>';
	$db_version = get_option('eyebeam2018_db_version', 0);
	if ($db_version >= 1) {
		die("db_version = $db_version (skipping migration)\n");
	}
	$posts = get_posts(array(
		'post_type' => 'resident',
		'posts_per_page' => -1
	));

	$links_field_key = 'field_5aa43f17ed630';
	$link_title_field_key = 'field_5aa43f23ed631';
	$link_url_field_key = 'field_5aa43f2eed632';

	foreach ($posts as $post) {
		echo "<a href=\"/wp-admin/post.php?post=$post->ID&action=edit\">$post->ID</a>: $post->post_title\n";
		$name = get_post_meta($post->ID, 'name', true);
		echo "\t$name\n";

		$num = 0;
		if (preg_match_all('/href="([^"]+?)"/', $name, $matches)) {
			foreach ($matches[1] as $match) {
				$url = trim($match);
				$title = preg_replace('/^https?:\/\//', '', $url);
				$title = preg_replace('/^www\./', '', $title);
				$title = preg_replace('/\/(index\.php)?$/', '', $title);
				if (substr($title, 0, strlen('eyebeam.org/stopwork/introducing-')) == 'eyebeam.org/stopwork/introducing-') {
					$url = str_replace('http://www.eyebeam.org/stopwork', 'https://www.eyebeam.org', $url);
					$title = 'Introducing: ' . strip_tags($name);
				} else if (substr($url, 0, strlen('http://linkedin.com')) == 'http://linkedin.com') {
					$title = 'LinkedIn';
				}
				echo "\t\tfound: <a href=\"$url\">$title</a>\n";

				// This would make more sense (or add_row()), but it's not
				// available until ACF 5.0 (note: $num is 1-indexed here)
				// (20180310/dphiffer)

				//update_sub_field(array('links', $num, 'link_title'), $title, $post->ID);
				//update_sub_field(array('links', $num, 'link_url'), $url, $post->ID);

				update_post_meta($post->ID, "links_{$num}_link_title", $title);
				update_post_meta($post->ID, "_links_{$num}_link_title", $link_title_field_key);
				update_post_meta($post->ID, "links_{$num}_link_url", $url);
				update_post_meta($post->ID, "_links_{$num}_link_url", $link_url_field_key);

				// $num is zero-indexed here
				$num++;
			}
		}
		update_post_meta($post->ID, "links", $num);
		update_post_meta($post->ID, "_links", $links_field_key);

	}
	update_option('eyebeam2018_db_version', 1, false);
	exit;
}
add_action('wp_ajax_eyebeam2018_db_migration_1', 'eyebeam2018_db_migration_1');

// add_action('wp_body', 'show_template');

function show_template() {
    global $template;
    echo basename($template);
}

/*
 * day_of_the_week($day)
 * $day = (int) representation of the day of the week
 */

function day_of_week($day = null) {
	$days = array( "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
	return $days[$day];
}

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();

}

function eyebeam2018_get_menu_by_location( $location ) {
	if( empty($location) ) return false;

	$locations = get_nav_menu_locations();
	if( ! isset( $locations[$location] ) ) return false;

	$menu_obj = get_term( $locations[$location], 'nav_menu' );

	return $menu_obj;
}

function auction_verify_id($id) {
	$bidder = auction_get_bidder_by_id($id);
	if (! empty($bidder)) {
		if (! empty($bidder['verified'])) {
			return 'already-verified';
		}
		$bidder['verified'] = true;
		$option_key = "auction_{$bidder['email']}";
		update_option($option_key, $bidder, false);
		return 'verified';
	}
	return 'invalid';
}

function auction_get_bidder_by_id($id) {
	$id = strtolower($id);
	if (empty($GLOBALS['auction_bidders'])) {
		$GLOBALS['auction_bidders'] = auction_load_bidders();
	}
	if (empty($GLOBALS['auction_bidders']['id'][$id])) {
		return null;
	}
	return $GLOBALS['auction_bidders']['id'][$id];
}

function auction_get_bidder_by_email($email) {
	$email = auction_normalize_email($email);
	if (empty($GLOBALS['auction_bidders'])) {
		$GLOBALS['auction_bidders'] = auction_load_bidders();
	}
	if (empty($GLOBALS['auction_bidders']['email'][$email])) {
		return null;
	}
	return $GLOBALS['auction_bidders']['email'][$email];
}

function auction_load_bidders() {
	global $wpdb;

	$bidders = array(
		'id' => array(),
		'email' => array()
	);

	$results = $wpdb->get_results("
		SELECT *
		FROM {$wpdb->prefix}options
		WHERE option_name LIKE 'auction_%'
	", OBJECT);

	foreach ($results as $row) {
		$bidder = unserialize($row->option_value);
		$id = $bidder['id'];
		$email = $bidder['email'];
		$bidders['id'][$id] = $bidder;
		$bidders['email'][$email] = $bidder;
	}
	return $bidders;
}

function auction_mark_bids_as_verified($id) {
	global $wpdb;

	$bidders = array(
		'id' => array(),
		'email' => array()
	);

	$results = $wpdb->get_results("
		SELECT *
		FROM {$wpdb->prefix}postmeta
		WHERE meta_key = 'auction_bids'
	", OBJECT);

	foreach ($results as $row) {
		$bid = unserialize($row->meta_value);
		if ($bid['bidder_id'] == $id &&
		    empty($bid['verified'])) {
			$bid['verified'] = true;
			$meta_value = serialize($bid);
			$wpdb->update("{$wpdb->prefix}postmeta", array(
				'meta_value' => $meta_value
			), array(
				'meta_id' => $row->meta_id
			));
		}
	}
}

function auction_next_amount() {
	$current_bid = auction_get_current_bid();
	$amount = $current_bid['amount'];
	$bid_increment = auction_bid_increment();
	$amount = floatval($amount);
	$amount = ceil(($amount + 1) / $bid_increment) * $bid_increment;
	echo $amount;
}

function auction_name() {
	$name = '';
	if (! empty($_POST['name'])) {
		$name = $_POST['name'];
	} else if (! empty($_SESSION['auction_bidder_id'])) {
		$bidder = auction_get_bidder_by_id($_SESSION['auction_bidder_id']);
		$name = $bidder['name'];
	} else if (! empty($_SESSION['auction_name'])) {
		$name = $_SESSION['auction_name'];
	}
	$name = htmlentities($name);
	echo $name;
}

function auction_email() {
	$email = '';
	if (! empty($_POST['email'])) {
		$email = $_POST['email'];
	} else if (! empty($_SESSION['auction_bidder_id'])) {
		$bidder = auction_get_bidder_by_id($_SESSION['auction_bidder_id']);
		if (! empty($bidder['email'])) {
			$email = $bidder['email'];
		}
	} else if (! empty($_SESSION['auction_email'])) {
		$email = $_SESSION['auction_email'];
	}
	$email = auction_normalize_email($email);
	$email = htmlentities($email);
	echo $email;
}

function auction_phone() {
	$phone = '';
	if (! empty($_POST['phone'])) {
		$phone = $_POST['phone'];
	} else if (! empty($_SESSION['auction_bidder_id'])) {
		$bidder = auction_get_bidder_by_id($_SESSION['auction_bidder_id']);
		if (! empty($bidder['phone'])) {
			$phone = $bidder['phone'];
		}
	} else if (! empty($_SESSION['auction_phone'])) {
		$phone = $_SESSION['auction_phone'];
	}
	$phone = htmlentities($phone);
	echo $phone;
}

function auction_normalize_email($email) {
	$email = strtolower($email);
	$email = trim($email);
	return $email;
}

function auction_is_verified($email) {
	$email = auction_normalize_email($email);
	$bidder = auction_get_bidder_by_email($email);
	if (! empty($bidder['verified']) &&
	    $_SESSION['auction_bidder_id'] == $bidder['id']) {
		return true;
	}
	return false;
}

function auction_is_leading_bid(&$curr, &$new) {
	if (floatval($new['max_amount']) > floatval($curr['max_amount'])) {
		$new['amount'] = $curr['max_amount'] + auction_bid_increment();
		return true;
	}
	if (floatval($new['max_amount']) < floatval($curr['max_amount'])) {
		return false;
	}
	if ($new['created'] < $curr['created']) {
		$new['amount'] = $curr['amount'];
		return true;
	}
	return false;
}

function auction_send_verification($email) {
	global $post;

	$permalink = get_permalink($post->ID);
	$id = wp_generate_uuid4();
	$id = str_replace('-', '', $id);

	$email = auction_normalize_email($email);
	$email_subject = "Confirm your Eyebeam art auction bid!";
	$email_body = "Hello,

Thank you so much for supporting Eyebeam. Before we can process your auction
bid, we just need you to confirm your email address. Please click on the link
below and you'll be all set.

$permalink?v=$id

You only need to verify your email address the first time you bid (per browser).

<3
Thank you!
";
	auction_send_mail($email, $email_subject, $email_body);

	return $id;
}

function auction_current_bid() {
	$bid = auction_get_current_bid();
	$amount = floatval($bid['amount']);
	$amount = number_format($amount, 2);
	if (substr($amount, -3, 3) == '.00') {
		$amount = substr($amount, 0, -3);
	}
	if (! empty($bid['bidder_id'])) {
		$bidder = auction_get_bidder_by_id($bid['bidder_id']);
		$name = $bidder['name'];
	}
	if (empty($name)) {
		$name = $bid['name'];
	}
	if (empty($bid['verified']) &&
	    (empty($_GET['v']) ||
	    $_GET['v'] != $bid['bidder_id'])) {
		//$name .= " (pending email verification)";
	}

	$amount = htmlentities($amount);
	$name = htmlentities($name);

	echo "\$$amount by $name";
}

function auction_post_feedback() {
	$feedback = array();
	$current_bid = auction_get_current_bid();
	if (empty($_POST['name'])) {
		$feedback[] = 'Please include a name.';
	} else {
		$_SESSION['auction_name'] = $_POST['name'];
	}
	if (empty($_POST['email'])) {
		$feedback[] = 'Please include an email address.';
	} else {
		$_SESSION['auction_email'] = $_POST['email'];
	}
	if (empty($_POST['phone'])) {
		$feedback[] = 'Please include a phone number.';
	} else {
		$_SESSION['auction_phone'] = $_POST['phone'];
	}
	if (empty($_POST['amount'])) {
		$feedback[] = 'Please include a bid amount.';
	}
	if (floatval($_POST['amount']) <= floatval($current_bid['amount'])) {
		$feedback[] = 'Please bid an amount greater than the current bid.';
	}
	return $feedback;
}

function auction_check_id($id) {
	$feedback = array();
	$id = strtolower($id);
	$is_verified = auction_verify_id($id);

	if ($is_verified == 'verified') {
		auction_mark_bids_as_verified($id);
		$_SESSION['auction_bidder_id'] = $id;
		$feedback[] = "Your email address has been verified, thank you!";
	} else if ($is_verified == 'invalid') {
		$feedback[] = "Sorry, we could not verify your email address.";
	}
	return $feedback;
}

function auction_bid_increment() {
	return 100;
}

function auction_get_current_bid() {
	global $post;
	$minimum_bid = array(
		'minimum_bid' => true,
		'amount' => get_field('minimum_bid') - auction_bid_increment(),
		'max_amount' => get_field('minimum_bid') - auction_bid_increment()
	);
	$current_bid = $minimum_bid;
	$bids = get_post_meta($post->ID, 'auction_bids');

	// most recent first
	usort($bids, function($a, $b) {
		if ($a['created'] > $b['created']) {
			return -1;
		} else if ($a['created'] < $b['created']) {
			return 1;
		}
		return 0;
	});

	// only take the most recent by a given bidder (dedupe)
	$bidders = array();
	$bids = array_filter($bids, function($item) use (&$bidders) {
		$email = auction_normalize_email($item['email']);
		if (empty($bidders[$email])) {
			$bidders[$email] = true;
			return true;
		}
		return false;
	});

	// oldest first
	usort($bids, function($a, $b) {
		if ($a['created'] > $b['created']) {
			return 1;
		} else if ($a['created'] < $b['created']) {
			return -1;
		}
		return 0;
	});

	foreach ($bids as $bid) {
		if (auction_is_leading_bid($current_bid, $bid)) {
			$current_bid = $bid;
		}
	}
	return $current_bid;
}

function auction_create_bid() {
	global $post;

	$feedback = array();

	$name = $_POST['name'];
	$email = auction_normalize_email($_POST['email']);
	$phone = $_POST['phone'];
	$verified = auction_is_verified($email);

	$new_bid = array(
		'bidder_id' => null,
		'name' => $name,
		'email' => $email,
		'phone' => $phone,
		'amount' => floatval($_POST['amount']),
		'max_amount' => floatval($_POST['amount']),
		'ip_addr' => $_SERVER['REMOTE_ADDR'],
		'user_agent' => $_SERVER['HTTP_USER_AGENT'],
		'verified' => $verified,
		'created' => current_time('mysql')
	);

	if (! empty($_SESSION['auction_bidder_id'])) {
		$bidder = auction_get_bidder_by_id($_SESSION['auction_bidder_id']);
		if (! empty($bidder)) {
			$new_bid['bidder_id'] = $_SESSION['auction_bidder_id'];
			$feedback[] = "We've received your bid, thank you!";
		} else {
			$_SESSION['auction_bidder_id'] = null;
		}
	}

	if (empty($new_bid['bidder_id'])) {
		$bidder_id = auction_send_verification($email);
		$new_bid['bidder_id'] = $bidder_id;
		$option_key = "auction_$email";
		update_option($option_key, array(
			'id' => $bidder_id,
			'name' => $name,
			'email' => $email,
			'phone' => $phone,
			'verified' => false
		), false);
		$feedback[] = "We've received your bid, but must confirm your email address before it will be counted.";
	}
	$url = get_permalink($post->ID);
	$amount = floatval($_POST['amount']);
	$amount = number_format($amount);
	$email_subject = "Thank you for your auction bid!";
	$email_body = "Hi $name,

We've received your bid on $post->post_title's artist experience, with
a maximum bid amount of $$amount.

Here is a link to the auction page:
$url

<3
Thank you for your support!";
	auction_send_mail($email, $email_subject, $email_body);

	$url = get_permalink($post->ID);
	$email = 'give@eyebeam.org';
	$email_subject = "Auction: {$new_bid['amount']} bid from $name";
	$email_body = "New bid on $post->post_title's artist experience:\n$url\n\n" . print_r($new_bid, true);
	auction_send_mail($email, $email_subject, $email_body);

	add_post_meta($post->ID, 'auction_bids', $new_bid);
	return $feedback;
}

function auction_send_mail($to, $subject, $body) {
	if (! defined('DO_NOT_SEND_EMAIL')) {
		$email_from = "Eyebeam <give@eyebeam.org>";
		$headers = "From: $email_from\r\n";
		wp_mail($to, $subject, $body, $headers);
	} else {
		dbug("Email to: $to
Subject: $subject
$body");
	}
}

if (! function_exists('dbug')) {

	// A simple debugging function, for logging variables regardless of type.
	// Usage: dbug($object, $array, $string);
	// (20190529/dphiffer)

	function dbug() {
		$args = func_get_args();
		$out = array();
		foreach ($args as $arg) {
			if (! is_scalar($arg)) {
				$arg = print_r($arg, true);
			}
			$out[] = $arg;
		}
		$out = implode("\n", $out);
		error_log("\n$out");
	}
}

function create_ACF_meta_in_REST() {
    $postypes_to_exclude = ['acf-field-group','acf-field'];
    $extra_postypes_to_include = ["page"];
    $post_types = array_diff(get_post_types(["_builtin" => false], 'names'),$postypes_to_exclude);

    array_push($post_types, $extra_postypes_to_include);

    foreach ($post_types as $post_type) {
        register_rest_field( $post_type, 'ACF', [
            'get_callback'    => 'expose_ACF_fields',
            'schema'          => null,
       ]
     );

	 register_rest_field('resident', 'image', [
		 'get_callback'		=> 'expose_image_field',
		 'schema'			=> null,
	 ]);

	 register_rest_field('resident', 'year', [
		 'get_callback'		=> 'expose_year_field',
		 'schema'			=> null,
	 ]);
    }

}

function expose_ACF_fields( $object ) {
    $ID = $object['id'];
    return get_fields($ID);
}

function expose_image_field( $object ){

	$ID = $object['id'];
	$image_ID = get_field('image', $ID);

	if ($image_ID){
		return wp_get_attachment_image_url( $image_ID );
	}

}

function expose_year_field( $object ){

	$ID = $object['id'];
	$start_year = get_field('start_year', $ID);

	return $start_year;

}



add_action( 'rest_api_init', 'create_ACF_meta_in_REST' );

// expose meta key meta value to api 
add_filter('rest_endpoints', function ($routes) {
    // I'm modifying multiple types here, you won't need the loop if you're just doing posts
    foreach (['resident'] as $type) {
        if (!($route =& $routes['/wp/v2/' . $type])) {
            continue;
        }

        // Allow ordering by my meta value
        $route[0]['args']['orderby']['enum'][] = 'meta_value_num';

        // Allow only the meta keys that I want
        $route[0]['args']['meta_key'] = array(
            'description'       => 'Resident Start Year',
            'type'              => 'int',
            'enum'              => ['start_year'],
            'validate_callback' => 'rest_validate_request_arg',
        );
    }

    return $routes;
});

function wpa84258_admin_posts_sort_last_name( $query ){
    global $pagenow;
    if( is_admin()
        && 'edit.php' == $pagenow
        && !isset( $_GET['orderby'] )
        && !isset( $_GET['post_type'] ) ){
            $query->set( 'meta_key', 'start_year' );
            $query->set( 'orderby', 'meta_value' );
            $query->set( 'order', 'DESC' );
    }
}
add_action( 'pre_get_posts', 'wpa84258_admin_posts_sort_last_name' );

add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point( $paths ) {

    // remove original path (optional)
    unset($paths[0]);

    // append path
    $paths[] = get_stylesheet_directory() . '/acf-json';

    // return
    return $paths;

}