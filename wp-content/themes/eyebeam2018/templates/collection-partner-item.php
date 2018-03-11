<?php

$image_id = get_sub_field('logo');
$description = get_sub_field('description');

$image = '';
if (! empty($image_id)) {
	$size = 'fullsize';
	$image = eyebeam2018_get_image_html($image_id, $size, 'partner-logo');
}

echo "<li class=\"partner\">\n";
echo "$image\n";
echo "<div class=\"partner-description\">$description</div>\n";
echo "</li>\n";

?>
