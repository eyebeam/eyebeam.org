<?php
echo "<div class=\"post-main\">\n";
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

echo "<div class=\"post-content\">\n";


do_action('pre-post_content');

echo $GLOBALS['eyebeam2018']['post_content'];

do_action('post-post_content');

// find related projects

echo "</div>\n";
echo "</div>\n";
echo "<br class=\"clear\">\n";
