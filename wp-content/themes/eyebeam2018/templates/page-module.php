<?php

extract($GLOBALS['eyebeam2018']['curr_module']);

echo "<div id=\"module-$hash\" class=\"module module-$type\">\n";

if (! empty($image_id)) {

	$size = 'medium';
	if ($type == 'two_thirds') {
		$size = 'large';
	}

	list($src) = wp_get_attachment_image_src($image_id, $size);
	// TODO: do better with alts!
	$image = "<img src=\"$src\" alt=\"\">";

	if (! empty($url)) {
		$image = "<a href=\"$url\">$image</a>";
	}

	echo "<figure class=\"module-image\">$image</figure>\n";

}

if (! empty($title)) {

	if ($type == 'two_thirds' && ! empty($url)) {
		$title .= ' &mdash;&gt;';
	}

	if (! empty($url)) {
		$title = "<a href=\"$url\">$title</a>";
	}

	echo "<h2 class=\"module-title\">$title</h2>\n";

}

if (! empty($description)) {
	echo "<div class=\"module-description\">$description</div>\n";
}

echo "</div>\n";
