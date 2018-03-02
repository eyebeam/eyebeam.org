<?php

$hero_media = get_field('hero_media');

if ($hero_media == 'image') {
	$image_id = get_field('hero_image');
	$size = 'large';
	list($src, $width, $height) = wp_get_attachment_image_src($image_id, $size);
	echo "<img src=\"$src\" alt=\"\" class=\"hero-image\">\n";
}
