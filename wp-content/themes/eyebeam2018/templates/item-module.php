<?php

$type = get_sub_field('module_type');
$title = null;
$show_page_title = null;
$url = null;
$description = null;
$image_id = null;
$video_url = null;
$layout = null;
$collection = null;
$residents_date = null;
$video_layout = null;
$toc_status = null;
$toc_title = null;

$page = get_sub_field('module_page');
if (! empty($page)) {
	$page = $page[0];
	$title = apply_filters('the_title', $page->post_title);
	$url = get_permalink($page->ID);
	$description = apply_filters('the_excerpt', $page->post_excerpt);
	$image_id = get_field('image', $page->ID);
	if (! $image_id) {
		$image_id = get_post_thumbnail_id($page);
	}
}
if (! empty(get_sub_field('show_page_title'))) {
	$show_page_title = get_sub_field('show_page_title');
}

if (! empty(get_sub_field('module_title'))) {
	$title = get_sub_field('module_title');
}

if (! empty(get_sub_field('module_url'))) {
	$url = get_sub_field('module_url');
}

if (! empty(get_sub_field('module_description'))) {
	$description = get_sub_field('module_description');
}

if (! empty(get_sub_field('module_image'))) {
	$image_id = get_sub_field('module_image');
}

if (! empty(get_sub_field('module_video_url'))) {
	$video_url = get_sub_field('module_video_url');
}

if (! empty(get_sub_field('module_layout'))) {
	$layout = get_sub_field('module_layout');
}

if (! empty(get_sub_field('module_collection'))) {
	$collection = get_sub_field('module_collection');
}

if (! empty(get_sub_field('residents_date'))) {
	$residents_date = get_sub_field('residents_date');
}

if (! empty(get_sub_field('video_layout'))) {
	$video_layout = get_sub_field('video_layout');
}

if (! empty(get_sub_field('toc_status'))) {
	$toc_status = get_sub_field('toc_status');
}

if (! empty(get_sub_field('toc_title'))) {
	$toc_title = get_sub_field('toc_title');
}

$hash = sanitize_title($title);

if ($type == 'toc') {
	$GLOBALS['eyebeam2018']['has_toc'] = true;
} else if ($type == 'donate') {
	add_action('wp_footer', function() {

		if (defined('STRIPE_USE_LIVE') && STRIPE_USE_LIVE &&
		    defined('STRIPE_LIVE_KEY')) {
			$key = STRIPE_LIVE_KEY;
		} else if (defined('STRIPE_TEST_KEY')) {
			$key = STRIPE_TEST_KEY;
		} else {
			echo "<!-- NO STRIPE API KEY DEFINED -->\n";
			return;
		}

		echo "<script src=\"https://js.stripe.com/v3/\"></script>\n";
		echo "<script>\n";
		echo "var stripe = Stripe('$key');\n";
		echo "</script>\n";
	});
}
else if ($type == 'related_readings') {
	$GLOBALS['eyebeam2018']['has_related_readings'] = true;
}

eyebeam2018_module(array(
	'type' => $type,
	'hash' => $hash,
	'title' => $title,
	'show_page_title' => $show_page_title,
	'url' => $url,
	'description' => $description,
	'image_id' => $image_id,
	'video_url' => $video_url,
	'layout' => $layout,
	'collection' => $collection,
	'residents_date' => $residents_date,
	'video_layout' => $video_layout,
	'toc_status' => $toc_status,
	'toc_title' => $toc_title
));
