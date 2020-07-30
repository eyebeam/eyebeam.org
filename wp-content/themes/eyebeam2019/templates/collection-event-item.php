<?php

$event = $GLOBALS['eyebeam2018']['curr_collection_item'];
$is_related_reading = $GLOBALS['eyebeam2018']['is_related_reading'];

$title = apply_filters('the_title', $event->post_title);
$url = get_permalink($event->ID);
$start_date = get_field('start_date', $event->ID);
$end_date = get_field('end_date', $event->ID);
$image_id = get_field('image', $event->ID);
$permalink = get_permalink($event->ID);


$category = get_the_terms($event->ID, 'category');

$image = '';
if (! empty($image_id)) {
	$size = 'medium';
	$image = eyebeam2018_get_image_html($image_id, $size, 'event-image', false);
}

$image = "<a class=\"image\" href=\"$url\">$image</a>";

if ($category){
	$category = $category[0];
	$category_name = $category->name;
	$category_label = ($category) ? "<a class=\"label\">$category_name</a>\n" : "";
}


if (! empty($category_label)){
	$title = "$title";
} else {
	$title = "<a href=\"$url\">$title</a>";

}

$start_time = strtotime($start_date);
$day = day_of_week(date('N', $start_time));
$start_date = $day . '<br />' . date('F j', $start_time);
$dates = $start_date;
$label = ($is_related_reading) ? eyebeam2018_label_map($event->post_type) : false;
$label_slug = ($is_related_reading) ? 'label-' . strtolower(eyebeam2018_label_map($event->post_type)) : false;

// TODO: account for end dates
if (!$event){
	echo "<li class=\"event collection-item\">\n";
	echo "<div class=\"item-container\">\n";
		echo "<h2 class=\"event-dates module-title eyebeam-sans\">No events for this date were found</h2>\n";
	echo "</div>\n";
	echo "</li>\n";
}
else {

	echo "<li class=\"event collection-item\">\n";
	echo "<div class=\"item-container\">\n";
	/*if (!is_search()){
		echo "<h2 class=\"event-dates module-title eyebeam-sans\">$dates</h2>\n";
	}
*/
	echo "$image\n";
	echo "<h3 class=\"event-title module-title eyebeam-sans\"><a href=\"$permalink\">$title</a></h3>\n";

	echo ($label) ?  "<h5 class=\"post-label $label_slug\">$label</h5>" : '';
	echo ($category) ? "<h5>$category_label</h5>" : "";
	echo "</div>\n";
	echo "</li>\n";

}

?>
