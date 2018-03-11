<?php

$post = $GLOBALS['eyebeam2018']['curr_collection_item'];

$title = apply_filters('the_title', $post->post_title);
$excerpt = apply_filters('the_excerpt', $post->post_excerpt);
$author = get_field('author', $post->ID);
$image_id = get_field('image', $post->ID);

$image = '';
if (! empty($image_id)) {
	$size = 'medium';
	list($src) = wp_get_attachment_image_src($image_id, $size);
	$esc_title = htmlentities($title);
	$image = "<img src=\"$src\" alt=\"$esc_title\" class=\"ideas-image\">";
}

$url = get_permalink($post->ID);
$title = "<a href=\"$url\">$title</a>";
$image = "<a href=\"$url\">$image</a>";

echo "<li class=\"module module-ideas module-one_third\">\n";
echo "<h3 class=\"ideas-title module-title\">$title</h3>\n";
if (! empty($author)) {
	echo "<h4 class=\"ideas-author module-title\">$author</h4>\n";
}
echo "$image\n";
echo "<div class=\"ideas-excerpt\">$excerpt</div>\n";
echo "</li>\n";
