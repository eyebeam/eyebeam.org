<?php

extract($GLOBALS['eyebeam2018']['curr_module']);

echo "<div id=\"module-$hash\" class=\"module module-$type\">\n";

$image = '';
if (! empty($image_id)) {

	$size = 'large';

	list($src) = wp_get_attachment_image_src($image_id, $size);

	// TODO: do better with alts!
	$image = "<img src=\"$src\" alt=\"\">";

	if (! empty($url)) {
		$image = "<a href=\"$url\">$image</a>";
	}

	$image = "<figure class=\"module-image\">$image</figure>\n";

}

if (! empty($video_url) &&
    ! empty($video_layout) && $video_layout == 'full_width') {
	eyebeam2018_video_embed($video_url);
} else {
	echo "<div class=\"module-image\">\n";
	eyebeam2018_video_embed($video_url);
	echo "</div>\n";
}

$text = '';
if (! empty($title)) {

	if ($type == 'two_thirds' && ! empty($url)) {
		$title .= ' &mdash;&gt;';
	}

	if (! empty($url)) {
		$title = "<a href=\"$url\">$title</a>";
	}

	$text .= "<h2 class=\"module-title\">$title</h2>\n";

}

if (! empty($description)) {
	$text .= "<div class=\"module-description\">$description</div>\n";
}

if (! empty($layout) &&
    $layout == 'text_first') {
	echo "$text$image";
} else {
	echo "$image$text";
}

echo "</div>\n";
