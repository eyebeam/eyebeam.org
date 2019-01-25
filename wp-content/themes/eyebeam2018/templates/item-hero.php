<?php

$type = get_sub_field('hero_type');
$hero = array(
	'type' => $type
);

if ($type == 'image') {

	$id_desktop = get_sub_field('hero_image_desktop');
	$id_mobile = get_sub_field('hero_image_mobile');

	if (! empty($id_desktop)) {

		$class = 'hero-image hero-image-desktop';
		$size = 'hero';
		$image = eyebeam2018_get_image($id_desktop, $size);

		if (empty($id_mobile)) {
			// if we don't have a mobile-specific image, use this for both
			$class .= ' hero-image-mobile';
		}

		$image['class'] = $class;
		$hero['image_desktop'] = $image;
	}

	if (! empty($id_mobile)) {

		$class = 'hero-image hero-image-mobile';
		$size = 'large';
		$image = eyebeam2018_get_image($id_mobile, $size);

		$image['class'] = $class;
		$hero['image_mobile'] = $image;
	}

	$url = get_sub_field('hero_image_url');
	if (! empty($url)) {
		$hero['url'] = $url;
	}

} else if ($type == 'text') {

	$hero['text'] = get_sub_field('hero_text');
	$hero['show_page_title'] = get_sub_field('show_page_title');

} else if ($type == 'video') {

	// TODO: make this work

	$image_id = get_field('hero_video_poster');
	if (! empty($image_id)) {
		$size = 'large';
		list($src) = wp_get_attachment_image_src($image_id, $size);
		$hero['poster_src'] = $src;
	}
}

eyebeam2018_hero($hero);
