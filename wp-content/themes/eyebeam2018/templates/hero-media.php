<?php

$hero_media = get_field('hero_media');

if ($hero_media == 'image') {
	$image_id = get_field('hero_image');
	$size = 'large';
	list($src, $width, $height) = wp_get_attachment_image_src($image_id, $size);
	echo "<img src=\"$src\" alt=\"\" class=\"hero-image\">\n";
} else if ($hero_media == 'video') {

	// TODO: make this work

	$image_id = get_field('hero_video_poster');
	if (! empty($image_id)) {
		$size = 'large';
		list($src, $width, $height) = wp_get_attachment_image_src($image_id, $size);
		$poster = " style=\"background-image: url('$src');\"";
	}
	echo "<div id=\"hero-video\"$poster></div>\n";
	//eyebeam2018_youtube('hero-video');
}
