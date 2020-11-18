<?php

extract($GLOBALS['eyebeam2018']['curr_module']);

$id = "module-$hash";
$class = 'module module-collection module-full_width';

$today = date('Ymd');

$upcoming_args = array(
	'post_type' => 'event',
	'posts_per_page' => $collection_post_limit,
	'orderby'=> 'meta_value',
	'meta_key' => 'end_date',
	'order' => 'DESC',
	);

echo "<div id=\"$id\" class=\"$class\">\n";

$posts = get_posts($upcoming_args);
if (! empty($posts)) {
	$columns = column_map($collection_columns);

	echo "<h2 class=\"module-title eyebeam-sans\">Events</h2>\n";
	echo "<ul id=\"events-list\" class=\"masonry $collection_columns\" data-columns=\"$columns\">\n";

	foreach ($posts as $event) {
		$GLOBALS['eyebeam2018']['curr_collection_item'] = $event;
		get_template_part('templates/collection-event-item');
	}

	echo "</ul>\n";
	echo "<br class=\"clear\">\n";
}

echo "<div class=\"load-more\"><a href=\"#more\" class=\"lazy-load\" data-load=\"events\" data-page=\"1\" data-limit=\"$collection_post_limit\">Load more</a></div>\n";


/*
THIS MIGHT NOT ACTUALLY WORK
*/
// if (!is_front_page()){
//
// 	$upcoming_args = array(
// 		'post_type' => 'event',
// 		'posts_per_page' => $collection_post_limit,
// 		'orderby'=> 'meta_value',
// 		'meta_key' => 'end_date',
// 		'order' => 'ASC',
// 	);
//
// 	$posts = eyebeam2018_get_events($upcoming_args);
// 	if (! empty($posts)) {
// 		echo "<ul id=\"events-list\" class=\"$collection_columns\">\n";
//
// 		foreach ($posts as $event) {
// 			$GLOBALS['eyebeam2018']['curr_collection_item'] = $event;
// 			get_template_part('templates/collection-event-item');
// 		}
//
// 		echo "</ul>\n";
// 		echo "<br class=\"clear\">\n";
// 	}
//
// }

echo "</div>\n";
