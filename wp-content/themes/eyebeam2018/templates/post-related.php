<?php

$GLOBALS['eyebeam2018']['is_related_reading'] = true;

// check how we'll display related reading
if (get_field('show_related') == 'auto' || !get_field('show_related')){

	// get related readings by tagfrom functions
	$related_readings = eyebeam2018_get_related_readings($post->ID);
}
else {

	// get related readings by relationship field in ACF
	$related_readings = get_field('related_readings');
	// if no projects check for residents
}

// if we have related items to show then display the container
if ($related_readings){
	shuffle($related_readings);
	$related_readings = array_slice($related_readings, 0,3);
	echo "<div class=\"module module-collection related-readings\">";
	echo "<h2 class=\"module-title\">Related Reading</h2>";
	echo "<ul>";
	foreach($related_readings as $post){

		$GLOBALS['eyebeam2018']['curr_collection_item'] = $post;
		get_template_part('templates/collection', eyebeam2018_template_map($post->post_type));
	}


	echo "</ul>";
	echo "</div>";
	echo "<br class=\"clear\">\n";

}