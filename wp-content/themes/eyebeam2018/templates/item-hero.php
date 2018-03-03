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
		$size = 'large';
		list($src) = wp_get_attachment_image_src($id_desktop, $size);

		if (empty($id_mobile)) {
			// if we don't have a mobile-specific image, use this for both
			$class .= ' hero-image-mobile';
		}

		$hero['image_desktop'] = array(
			'src' => $src,
			'class' => $class
		);
	}

	if (! empty($id_mobile)) {

		$class = 'hero-image hero-image-mobile';
		$size = 'large';
		list($src) = wp_get_attachment_image_src($id_mobile, $size);

		$hero['image_mobile'] = array(
			'src' => $src,
			'class' => $class
		);
	}

	$url = get_sub_field('hero_image_url');
	if (! empty($url)) {
		$hero['url'] = $url;
	}

} else if ($type == 'text') {

	$hero['text'] = get_sub_field('hero_text');

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
