<?php

$staff = $GLOBALS['eyebeam2018']['curr_collection_item'];

$name = apply_filters('the_title', $staff->post_title);
$bio = get_field('staff_bio', $staff->ID);
$title = get_field('staff_title', $staff->ID);
$image_id = get_field('staff_image', $staff->ID);

$image = '';
if (! empty($image_id)) {
	$size = 'thumbnail';
	$image = eyebeam2018_get_image_html($image_id, $size, 'staff-image toggle-bio');
}

echo "<li class=\"staff\">\n";
echo "<a href=\"#\">$image</a>\n";
echo "<h3 class=\"staff-name module-title toggle-bio\"><a href=\"#\">$name</a></h3>\n";
echo "<h4 class=\"staff-title person-title module-title\">$title</h4>\n";
echo "<div class=\"bio staff-bio\">$bio</div>\n";
echo "</li>\n";

?>
