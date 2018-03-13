<?php

$resident = $GLOBALS['eyebeam2018']['curr_collection_item'];

$name = apply_filters('the_title', $resident->post_title);
$type = get_field('resident_type', $resident->ID);
$start_year = get_field('start_year', $resident->ID);
$end_year = get_field('end_year', $resident->ID);
$image_id = get_field('image', $resident->ID);
$links = get_field('links', $resident->ID);
$collaboration_member = get_field('collaboration_member', $resident->ID);

if ($collaboration_member == 'hide') {
	return;
}

$image = '';
if (! empty($image_id)) {
	$size = 'medium';
	$image = eyebeam2018_get_image_html($image_id, $size, 'resident-image');
}

if (! empty($links)) {
	$first_link = $links[0];
	$url = $first_link['link_url'];
	$name = "<a href=\"$url\">$name</a>";

	if (! empty($image)) {
		$image = "<a href=\"$url\">$image</a>";
	}
}

/*$bio_toggle = 'Bio';
$members = get_field('members', $resident->ID);
if (! empty($members)) {
	$bio_toggle = 'Bios';
}*/

//$bio = eyebeam2018_resident_bio($resident, $members);

$years = "$start_year&ndash;$end_year";

echo "<li class=\"resident collection-item\">\n";
echo "<div class=\"item-container\">\n";
echo "$image\n";
echo "<h3 class=\"resident-name module-title\">$name</h3>\n";
echo "<h4 class=\"resident-type person-title module-title\">$type</h4>\n";
echo "<div class=\"resident-years\">$years</div>\n";
//echo "<a href=\"#bio\" class=\"toggle-bio\">$bio_toggle</a>\n";
//echo "<div class=\"bio\">$bio</div>\n";
//echo "$bio\n";
echo "</div>\n";
echo "</li>\n";

?>
