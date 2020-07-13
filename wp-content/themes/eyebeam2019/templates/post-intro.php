<?php


global $post;
$show_date = get_field('show_date');
$meta = get_field('meta');
$author = get_field('author');
$tags = get_the_tags();
$show_tags = (get_field('show_tags') == 'show' ? true : false);

echo "<div class=\"post-main post-main-top\">\n";

	echo "<div class=\"post-title eyebeam-sans\">";




echo "</div>\n";



$image_id = get_field('image', $post->ID);
if (! $image_id) {
	$image_id = get_post_thumbnail_id($page);
}

$image = '';
if (! empty($image_id)) {

	$size = 'large';
	$image = eyebeam2018_get_image_html($image_id, $size, true);

	echo "<figure class=\"post-image\">$image</figure>\n";

}
echo "<div class=\"post-media\">\n";

// show and float all media



$media = get_field('media');
if ($media){

	foreach($media as $row){
		if ($row['media_type'] == 'video_url'){
			eyebeam2018_video_embed($row['video_url']);
		}
		elseif ($row['media_type'] == 'image'){
			$image = eyebeam2018_get_image_html($row['image'], 'large', 'post-image');
			echo "<figure class=\"float-image\">\n";
			echo "$image\n";
			echo "</figure>\n";
		}
	}
}

echo "</div>";
echo "</div>\n";
