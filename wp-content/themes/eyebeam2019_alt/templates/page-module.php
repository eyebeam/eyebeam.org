<?php
extract($GLOBALS['eyebeam2018']['curr_module']);
if (! empty($toc_title)) {
	$hash = sanitize_title($toc_title);
}

echo "<li id=\"module-$hash\" class=\"module module-$type\">\n";
echo "<div class=\"item-container\">\n";


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

	if (! empty($url) && empty($button_text)) {
		$title = "<a href=\"$url\">$title</a>";
	}

	$text .= "<h2 class=\"module-title eyebeam-sans $text_layout\" alt=\"$title\" title=\"$title\">$title</h2>\n";

}

$image = '';
if (! empty($image_id)) {

	$size = 'original';
	$image = eyebeam2018_get_image_html($image_id, $size);

	if (! empty($url)) {
		$image = "<a href=\"$url\">$image</a>";
	}

	$image = "<figure class=\"module-image\">$image</figure>\n";

}

if (! empty($description)) {
	$text_description .= "<div class=\"module-description $text_layout\">$description\n";
}

if ( (! empty($button_text)) && (! empty($url)) ) {

	$text_description .= "<a class=\"btn\" href=\"$url\">\n";
	$text_description .= $button_text;
	$text_description .= "</a>\n";
}

if ( !empty($button_text) || !empty ($description) || !empty($url) ){
	echo "</div>";
}


$layout = 'text_first';
if (! empty($layout) &&
		! empty($description) &&
    $layout == 'text_first') {
		echo "$text$image$text_description";
} else {
	echo "$image$text$text_description";
}



echo "</div>\n";
echo "</li>\n";
