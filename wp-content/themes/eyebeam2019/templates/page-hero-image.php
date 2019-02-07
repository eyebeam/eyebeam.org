<?php

extract($GLOBALS['eyebeam2018']['curr_hero']);

if (! empty($image_desktop)) {

	$esc_src = htmlentities($image_desktop['src']);
	$esc_alt = htmlentities($image_desktop['alt']);
	$esc_class = htmlentities($image_desktop['class']);
	$esc_width = htmlentities($image_desktop['width']);
	$esc_height = htmlentities($image_desktop['height']);

	$image = "<img src=\"$esc_src\" width=\"$esc_width\" height=\"$esc_height\" alt=\"$esc_alt\" class=\"$esc_class\">";

	if (! empty($url)) {
		$esc_url = htmlentities($url);
		$image = "<a href=\"$esc_url\">$image</a>";
	}

	echo "$image\n";
}

if (! empty($image_mobile)) {

	$esc_src = htmlentities($image_mobile['src']);
	$esc_alt = htmlentities($image_mobile['alt']);
	$esc_class = htmlentities($image_mobile['class']);
	$esc_width = htmlentities($image_mobile['width']);
	$esc_height = htmlentities($image_mobile['height']);

	$image = "<img src=\"$esc_src\" width=\"$esc_width\" height=\"$esc_height\" alt=\"$esc_alt\" class=\"$esc_class\">";

	if (! empty($url)) {
		$esc_url = htmlentities($url);
		$image = "<a href=\"$esc_url\">$image</a>";
	}

	echo "$image\n";
}
