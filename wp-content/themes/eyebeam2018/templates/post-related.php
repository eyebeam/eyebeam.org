<?php

$GLOBALS['eyebeam2018']['is_related_reading'] = true;



echo "<div class=\"module module-collection related-readings\">";
echo "<h2 class=\"module-title\">Related Readings</h2>";
echo "<ul>";
$related_readings = eyebeam2018_get_related_readings();
foreach($related_readings as $post){

	$GLOBALS['eyebeam2018']['curr_collection_item'] = $post;
	get_template_part('templates/collection', eyebeam2018_template_map($post->post_type));
}
echo "</ul>";
echo "</div>";
echo "<br class=\"clear\">\n";
