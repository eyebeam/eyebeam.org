<?php
$event = $GLOBALS['eyebeam2018']['curr_collection_item'];
$is_related_reading = $GLOBALS['eyebeam2018']['is_related_reading'];
$category = get_the_category($event->ID);
$category_label = "<a href=\"#\" class=\"category-label\" id=\"" . $category[0]->slug . "\">" . $category[0]->name . "</a>";


$title = apply_filters('the_title', $event->post_title);
$url = get_permalink($event->ID);
$post_date = get_the_time('F j, Y');
$label = ($is_related_reading) ? eyebeam2018_label_map($event->post_type) : false;
$label_slug = ($is_related_reading) ? 'label-'.strtolower(eyebeam2018_label_map($event->post_type)) : false;

// $start_date = get_field('start_date', $event->ID);
// $end_date = get_field('end_date', $event->ID);
$image_id = get_field('image', $event->ID);

$image = '';
if (! empty($image_id)) {
	$size = 'medium';
	$image = eyebeam2018_get_image_html($image_id, $size, 'event-image');
}

$image = "<a class=\"image\" href=\"$url\">$image</a>";

if (! empty($category_label)){
	$title = "$category_label $title";

} else {
	$title = "$category_label <a href=\"$url\">$title</a>";

}



// TODO: account for end dates

echo "<li class=\"post collection-item\">\n";

echo "<div class=\"item-container\">\n";
echo "$image\n";
echo ($label) ?  "<h5 class=\"post-label $label_slug\">$label</h5>" : '';
echo "<h3 class=\"post-title module-title\">$title</h3>\n";
// echo "<h4 class=\"event-dates\">$post_date</h4>\n";

echo "</div>\n";
echo "</li>\n";

?>
