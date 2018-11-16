<?php

$event = $GLOBALS['eyebeam2018']['curr_collection_item'];
$is_related_reading = $GLOBALS['eyebeam2018']['is_related_reading'];

$title = apply_filters('the_title', $event->post_title);
$url = get_permalink($event->ID);
$start_date = get_field('start_date', $event->ID);
$end_date = get_field('end_date', $event->ID);
$image_id = get_field('image', $event->ID);

$image = '';
if (! empty($image_id)) {
	$size = 'medium';
	$image = eyebeam2018_get_image_html($image_id, $size, 'event-image');
}

$image = "<a class=\"image\" href=\"$url\">$image</a>";
$title = "<a href=\"$url\">$title</a>";

$start_time = strtotime($start_date);
$start_date = date('F j, Y', $start_time);
$dates = $start_date;
$label = ($is_related_reading) ? eyebeam2018_label_map($event->post_type) : false;

// TODO: account for end dates

echo "<li class=\"event collection-item\">\n";
echo "<div class=\"item-container\">\n";
echo "$image\n";
echo ($label) ?  "<h5 class=\"post-label\">$label</h5>" : '';
echo "<h3 class=\"event-title module-title\">$title</h3>\n";
echo "<h4 class=\"event-dates module-title\">$dates</h4>\n";
echo "</div>\n";
echo "</li>\n";

?>
