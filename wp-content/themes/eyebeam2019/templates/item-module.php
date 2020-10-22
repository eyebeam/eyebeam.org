<?php

$type = get_sub_field('module_type');
$section_header = get_sub_field('section_header');
$title = null;
$subtitle = null;
$module_frame = null;
$button_text = null;
$url = null;
$description = null;
$image_id = null;
$video_url = null;
$layout = null;
$event_timing = null;
$collection = null;
$collection_post_limit = null;
$collection_columns = null;
$show_resident_image = null;
$show_resident_info = null;
$residents_start_year = null;
$residents_end_year = null;
$featured_residents = null;
$text_layout = null;
$video_layout = null;
$toc_status = null;
$toc_title = null;
$show_button = null;

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

if (! empty(get_sub_field('module_title'))) {
	$title = get_sub_field('module_title');
}

if (! empty(get_sub_field('module_subtitle'))) {
	$subtitle = get_sub_field('module_subtitle');
}

if (! empty(get_sub_field('module_frame'))) {
	$module_frame = get_sub_field('module_frame');
}

if (! empty(get_sub_field('module_url'))) {
	$url = get_sub_field('module_url');
}

if (! empty(get_sub_field('show_button'))) {
	$show_button = get_sub_field('show_button');
}

if (! empty(get_sub_field('button_text'))) {
	$button_text = get_sub_field('button_text');
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

if (! empty(get_sub_field('collection_post_limit'))) {
	$collection_post_limit = get_sub_field('collection_post_limit');
}

if (! empty(get_sub_field('collection_columns'))) {
	$collection_columns = get_sub_field('collection_columns');
}

if (! empty(get_sub_field('show_resident_image'))) {
	$show_resident_image = get_sub_field('show_resident_image');
}
if (! empty(get_sub_field('show_resident_info'))) {
	$show_resident_info = get_sub_field('show_resident_info');
}

if (! empty(get_sub_field('residents_start_year'))) {
	$residents_start_year = get_sub_field('residents_start_year');
}
if (! empty(get_sub_field('residents_end_year'))) {
	$residents_end_year = get_sub_field('residents_end_year');
}

if (! empty(get_sub_field('featured_residents'))) {
	$featured_residents = get_sub_field('featured_residents');
}

if (! empty(get_sub_field('video_layout'))) {
	$video_layout = get_sub_field('video_layout');
}

if (! empty(get_sub_field('text_layout'))) {
	$text_layout = get_sub_field('text_layout');
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
	'section_header' => $section_header,
	'title' => $title,
	'subtitle' => $subtitle,
	'module_frame' => $module_frame,
	'button_text' => $button_text,
	'show_button' => $show_button,
	'url' => $url,
	'description' => $description,
	'image_id' => $image_id,
	'video_url' => $video_url,
	'layout' => $layout,
	'text_layout' => $text_layout,
	'collection' => $collection,
	'collection_post_limit' => $collection_post_limit,
	'collection_columns' => $collection_columns,
	'show_resident_image' => $show_resident_image,
	'show_resident_info' => $show_resident_info,
	'residents_start_year' => $residents_start_year,
	'residents_end_year' => $residents_end_year,
	'featured_residents' => $featured_residents,
	'video_layout' => $video_layout,
	'text_layout' => $text_layout,
	'toc_status' => $toc_status,
	'toc_title' => $toc_title
));
