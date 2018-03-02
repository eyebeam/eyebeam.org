<?php

extract($GLOBALS['eyebeam2018']['curr_hero']);

if (! empty($image_desktop)) {
	$src = $image_desktop['src'];
	$class = $image_desktop['class'];
	// TODO: do better with alts!
	echo "<img src=\"$src\" alt=\"\" class=\"$class\">\n";
}

if (! empty($image_mobile)) {
	$src = $image_mobile['src'];
	$class = $image_mobile['class'];
	// TODO: do better with alts!
	echo "<img src=\"$src\" alt=\"\" class=\"$class\">\n";
}
