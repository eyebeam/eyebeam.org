<?php
echo "<div class=\"post-main post-main-top\">\n";
echo "<h2 class=\"post-title\">";
the_title();

echo "</h2>\n";

$image_id = get_field('image', $post->ID);
if (! $image_id) {
	$image_id = get_post_thumbnail_id($page);
}

$image = '';
if (! empty($image_id)) {

	$size = 'large';
	$image = eyebeam2018_get_image_html($image_id, $size);

	echo "<figure class=\"post-image\">$image</figure>\n";

}

if (! empty($GLOBALS['eyebeam2018']['post_intro'])) {
	echo "<div class=\"post-intro\">\n";
	echo $GLOBALS['eyebeam2018']['post_intro'];
	echo "</div>\n";
}

echo "</div>\n";
