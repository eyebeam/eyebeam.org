<?php

$release = $GLOBALS['eyebeam2018']['current_page_item'];

$title = get_field('title', $release->ID);
$date = get_field('date', $release->ID);
$image_id = get_field('image', $release->ID);

$date = date('F j, Y', strtotime($date));
$image = eyebeam2018_get_image_html($image_id, 'medium', 'press-release-image');

echo "<li class=\"collection-item press-release\">\n";
echo "<div class=\"item-container\">\n";
echo "<h3 class=\"press-release-title\">$title</h3>\n";
echo "<div class=\"press-release-date\">$date</div>\n";
echo "$image\n";
echo "</div>\n";
echo "</li>\n";
