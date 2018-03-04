<?php

echo "<div class=\"post-main post-main-top\">\n";

echo "<h2 class=\"post-title\">";
the_title();
echo "</h2>\n";

echo "<div class=\"post-intro\">\n";

$image_id = get_field('image', $post->ID);
if (! $image_id) {
	$image_id = get_post_thumbnail_id($page);
}

$image = '';
if (! empty($image_id)) {

	$size = 'large';

	list($src) = wp_get_attachment_image_src($image_id, $size);

	// TODO: do better with alts!
	$image = "<img src=\"$src\" alt=\"\">";

	echo "<figure class=\"post-image\">$image</figure>\n";

}

if (! empty($GLOBALS['eyebeam2018']['post_intro'])) {
	echo $GLOBALS['eyebeam2018']['post_intro'];
}

echo "</div>\n";
echo "</div>\n";
