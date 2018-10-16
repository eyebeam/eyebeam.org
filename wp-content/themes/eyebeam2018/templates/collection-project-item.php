<?php

$project = $GLOBALS['eyebeam2018']['curr_collection_item'];
$is_related_reading = $GLOBALS['eyebeam2018']['is_related_reading'];


$project_url = get_permalink($project->ID);
$name = apply_filters('the_title', $project->post_title);
$type = get_field('project_type', $project->ID);
$image_id = get_field('image', $project->ID);
$links = get_field('links', $project->ID);
$collaboration_member = get_field('collaboration_member', $project->ID);

if ($collaboration_member == 'hide') {
	return;
}

$image = '';
if (! empty($image_id)) {
	$size = 'medium';
	$image = eyebeam2018_get_image_html($image_id, $size, 'project-image');
}

$name = "<a href=\"$project_url\">$name</a>";

$label = ($is_related_reading) ? eyebeam2018_label_map($project->post_type) : false;

/*$bio_toggle = 'Bio';
$members = get_field('members', $project->ID);
if (! empty($members)) {
	$bio_toggle = 'Bios';
}*/

//$bio = eyebeam2018_project_bio($project, $members);

echo "<li class=\"project collection-item\">\n";
echo "<div class=\"item-container\">\n";
echo "<a href=\"$project_url\">$image\n</a>";
echo ($label) ? "<h5 class=\"post-label\">$label</h5>" : '';
echo "<h3 class=\"project-name module-title\">$name</h3>\n";
echo "<h4 class=\"project-type person-title module-title\">$type</h4>\n";
echo "<div class=\"project-years\">$years</div>\n";
//echo "<a href=\"#bio\" class=\"toggle-bio\">$bio_toggle</a>\n";
//echo "<div class=\"bio\">$bio</div>\n";
//echo "$bio\n";
echo "</div>\n";
echo "</li>\n";

?>
