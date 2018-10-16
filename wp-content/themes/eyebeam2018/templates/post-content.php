<?php
echo "<br class=\"clear\">\n";
echo "<div class=\"post-main\">\n";
echo "<div class=\"post-content\">\n";

echo $GLOBALS['eyebeam2018']['post_content'];

// find related projects


// show all media
$media = get_field('media');
if ($media){

	foreach($media as $row){
		if ($row['media_type'] == 'video_url'){
			eyebeam2018_video_embed($row['video_url']);
		}
		elseif ($row['media_type'] == 'image'){
			$image = eyebeam2018_get_image_html($row['image'], 'large', 'post-image');
			echo "$image\n";
		}
	}
}

echo "</div>\n";
echo "</div>\n";
echo "<br class=\"clear\">\n";
