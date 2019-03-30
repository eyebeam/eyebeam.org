<?php

echo "<div class=\"carousel\">\n";
// show and float all media
$carousel = get_sub_field('carousel');
if ($carousel){

	foreach($carousel as $row){

			$image = eyebeam2018_get_image_html($row['image'], 'large', 'post-image');
			echo "<figure class=\"slide\">\n";
			echo "$image\n";
			echo "</figure>\n";

	}
}
echo "</div>";
