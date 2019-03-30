<?php

$carousel = get_sub_field('carousel');

echo "<div class=\"carousel\">\n";
// show and float all media
if ($carousel){

	foreach($carousel as $row){
			$target = get_permalink($row['slide_target'][0]);
			$image = eyebeam2018_get_image_html($row['image'], 'large', 'post-image');
			echo "<figure class=\"slide\">\n";
			echo "<a href=\"$target\">\n";
			echo "$image\n";
			echo "</a>\n";
			echo "</figure>\n";

	}
}
echo "</div>";
