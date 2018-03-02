<?php

$type = get_sub_field('module_type');
$title = null;
$url = null;
$description = null;
$image_id = null;

$page = get_sub_field('module_page');
if (! empty($page)) {
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

if (! empty(get_sub_field('module_url'))) {
	$url = get_sub_field('module_url');
}

if (! empty(get_sub_field('module_description'))) {
	$description = get_sub_field('module_description');
}

if (! empty(get_sub_field('module_image'))) {
	$image = get_sub_field('module_image');
}

$hash = sanitize_title($title);

eyebeam2018_module(array(
	'type' => $type,
	'hash' => $hash,
	'title' => $title,
	'url' => $url,
	'description' => $description,
	'image_id' => $image_id
));
