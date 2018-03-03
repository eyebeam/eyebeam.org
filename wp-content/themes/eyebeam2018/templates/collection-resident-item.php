<?php

$resident = $GLOBALS['eyebeam2018']['curr_collection_item'];

$name = apply_filters('the_title', $resident->post_title);
$type = get_field('resident_type', $resident->ID);
$start_year = get_field('start_year', $resident->ID);
$end_year = get_field('end_year', $resident->ID);
$image_id = get_field('image', $resident->ID);

$image = '';
if (! empty($image_id)) {
	$size = 'medium';
	list($src) = wp_get_attachment_image_src($image_id, $size);
	$image = "<img src=\"$src\" alt=\"$name\" class=\"resident-image\">";
}

$years = "$start_year&ndash;$end_year";

echo "<li class=\"resident collection-item\">\n";
echo "$image\n";
echo "<h3 class=\"resident-name module-title\">$name</h3>\n";
echo "<h4 class=\"resident-type person-title module-title\">$type</h4>\n";

// TODO Residents should have bios, yo

//echo "<a href=\"#bio\" class=\"toggle-bio\">Bio</a>\n";
//echo "<div class=\"bio staff-bio\">$bio</div>\n";

echo "<div class=\"resident-years\">$years</div>\n";

echo "</li>\n";

?>
