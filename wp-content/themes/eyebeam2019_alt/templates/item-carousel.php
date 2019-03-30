<?php

$carousel = get_sub_field('carousel');
echo "<div class=\"carousel-container\">\n";
echo "<div class=\"swiper-wrapper\">\n";
// show and float all media
if ($carousel){

	foreach($carousel as $row){
			$target = get_permalink($row['slide_target'][0]);
			$image = eyebeam2018_get_image_html($row['image'], 'large', 'post-image');
			echo "<div class=\"swiper-slide\">\n";
			echo "<a href=\"$target\">\n";
			echo "$image\n";
			echo "</a>\n";
			echo "</div>\n";

	}
}
echo "</div>";
echo "<div class=\"swiper-pagination\"></div>\n";
echo "<div class=\"swiper-button-prev swiper-button-right\"></div>\n";
echo "<div class=\"swiper-button-next swiper-button-right\"></div>\n";
echo "</div>";
