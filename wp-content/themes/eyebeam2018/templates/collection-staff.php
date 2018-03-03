<?php

$staff = $GLOBALS['eyebeam2018']['curr_collection_item'];

$name = apply_filters('the_title', $staff->post_title);
$bio = get_field('staff_bio', $staff->ID);
$title = get_field('staff_title', $staff->ID);
$image_id = get_field('staff_image', $staff->ID);

$image = '';
if (! empty($image_id)) {
	$size = 'thumbnail';
	list($src) = wp_get_attachment_image_src($image_id, $size);
	$image = "<img src=\"$src\" alt=\"$name\" class=\"staff-image\">";
}

echo "<li class=\"staff\">\n";
echo "$image\n";
echo "<h3 class=\"staff-name module-title\">$name</h3>\n";
echo "<h4 class=\"staff-title module-title\">$title</h4>\n";
echo "<a href=\"#bio\" class=\"toggle-bio\">Bio</a>\n";
echo "<div class=\"bio staff-bio\">$bio</div>\n";
echo "</li>\n";

?>
