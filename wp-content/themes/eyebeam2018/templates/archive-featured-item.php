<?php

list($item) = get_sub_field('archive_item');

$title = apply_filters('the_title', $item->post_title);
$description = apply_filters('the_content', $item->post_content);
$image_id = get_post_thumbnail_id($page);

$residents = get_field('residents', $item->ID);
$names = array();
foreach ($residents as $resident) {
	$names[] = apply_filters('the_title', $resident->post_title);
}
if (count($names) == 1) {
	$name = $names[0];
} else if (count($names) == 2) {
	$name = implode(' and ', $names);
} else {
	$last = array_pop($names);
	$name = implode(', ', $names);
	$name .= ", $last";
}

$image_id = null;
$video_url = null;
$caption = null;

if (get_sub_field('description')) {
	$description = get_sub_field('description');
}

while (have_rows('media', $item->ID)) {

	the_row();

	$media_type = get_sub_field('media_type');
	if ($media_type == 'image') {
		$image_id = get_sub_field('image');
	} else if ($media_type == 'video_url') {
		$video_url = get_sub_field('video_url');
	}
	$caption = get_sub_field('caption');

	// Just use the first media item
	break;
}

if (get_field('title')) {
	$title = get_field('title');
}

if (get_field('name')) {
	$name = get_field('name');
}

if (get_field('description')) {
	$description = get_field('description');
}

if (get_field('image')) {
	$image_id = get_field('image');
}

if (get_field('video_url')) {
	$video_url = get_field('video_url');
}

if (get_field('caption')) {
	$caption = get_field('caption');
}

if ($title == $name) {
	$name = '';
}

echo "<div id=\"featured-$item->ID\" class=\"featured\">\n";

echo "<div class=\"featured-media\">\n";
if (! empty($video_url)) {

	eyebeam2018_video_embed($video_url);

	if (! empty($caption)) {
		echo "<div class=\"video-caption featured-caption\">$caption</div>\n";
	}

} else if (! empty($image_id)) {

	$size = 'large';
	$image = eyebeam2018_get_image_html($image_id, $size);

	echo "<figure class=\"featured-image\">\n";
	echo $image;
	if (! empty($caption)) {
		echo "<figcaption class=\"featured-caption\">$caption</figcaption>\n";
	}
	echo "</figure>\n";

}
echo "</div>\n";

echo "<div class=\"featured-info\">\n";
echo "<h3 class=\"featured-title\">$title</h3>\n";
if (! empty($name)) {
	echo "<h4 class=\"featured-name\">by $name</h4>\n";
}
echo "<div class=\"featured-description\">$description</div>\n";
echo "</div>\n";

echo "</div>\n";
