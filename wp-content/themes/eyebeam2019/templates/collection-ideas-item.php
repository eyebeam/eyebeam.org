<?php

$post = $GLOBALS['eyebeam2018']['curr_collection_item'];

$title = apply_filters('the_title', $post->post_title);
$excerpt = apply_filters('the_excerpt', $post->post_excerpt);
$author = get_field('author', $post->ID);
$image_id = get_field('image', $post->ID);

$image = '';
if (! empty($image_id)) {
	$size = 'medium';
	$image = eyebeam2018_get_image_html($image_id, $size, 'ideas-image');
}

$url = get_permalink($post->ID);
$title = "<a href=\"$url\">$title</a>";
$image = "<a href=\"$url\">$image</a>";

echo "<li class=\"module module-ideas module-one_third\">\n";
echo "<div class=\"item-container\">\n";
echo "<h3 class=\"ideas-title module-title\">$title</h3>\n";
if (! empty($author)) {
	echo "<h4 class=\"ideas-author module-title\">$author</h4>\n";
}
echo "$image\n";
echo "<div class=\"ideas-excerpt\">$excerpt</div>\n";
echo "</div>\n";
echo "</li>\n";
