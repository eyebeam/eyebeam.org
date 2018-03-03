<?php

$image_id = get_sub_field('logo');
$description = get_sub_field('description');

$image = '';
if (! empty($image_id)) {
	$size = 'fullsize';
	list($src) = wp_get_attachment_image_src($image_id, $size);
	$image = "<img src=\"$src\" alt=\"\" class=\"partner-logo\">";
}

echo "<li class=\"partner\">\n";
echo "$image\n";
echo "<div class=\"partner-description\">$description</div>\n";
echo "</li>\n";

?>
