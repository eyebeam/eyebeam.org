<?php

extract($GLOBALS['eyebeam2018']['curr_hero']);

if (! empty($image_desktop)) {
	$src = $image_desktop['src'];
	$class = $image_desktop['class'];
	// TODO: do better with alts!
	$image = "<img src=\"$src\" alt=\"\" class=\"$class\">";
}

if (! empty($image_mobile)) {
	$src = $image_mobile['src'];
	$class = $image_mobile['class'];
	// TODO: do better with alts!
	$image = "<img src=\"$src\" alt=\"\" class=\"$class\">";
}

if (! empty($url)) {
	$image = "<a href=\"$url\">$image</a>";
}

echo "$image\n";
