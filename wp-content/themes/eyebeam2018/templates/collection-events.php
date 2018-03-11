<?php

extract($GLOBALS['eyebeam2018']['curr_module']);

$id = "module-$hash";
$class = 'module module-collection module-full_width';

$today = date('Ymd');

$upcoming_args = array(
	'post_type' => 'event',
	'posts_per_page' => -1,
	'orderby'=> 'meta_value',
	'meta_key' => 'end_date',
	'order' => 'ASC',
	'meta_query' => array(
		array(
			'key'=> 'end_date',
			'value'=> $today,
			'compare'=> '>='
		),
	)
);

echo "<div id=\"$id\" class=\"$class\">\n";

$posts = get_posts($upcoming_args);
if (! empty($posts)) {
	echo "<h2 class=\"module-title\">Upcoming</h2>\n";
	echo "<ul>\n";

	foreach ($posts as $event) {
		$GLOBALS['eyebeam2018']['curr_collection_item'] = $event;
		get_template_part('templates/collection-event-item');
	}

	echo "</ul>\n";
	echo "<br class=\"clear\">\n";
}

$posts = eyebeam2018_get_events();
if (! empty($posts)) {
	echo "<h2 class=\"module-title\">Past Events</h2>\n";
	echo "<ul id=\"events-list\">\n";

	foreach ($posts as $event) {
		$GLOBALS['eyebeam2018']['curr_collection_item'] = $event;
		get_template_part('templates/collection-event-item');
	}

	echo "</ul>\n";
	echo "<br class=\"clear\">\n";
	echo "<div class=\"load-more\"><a href=\"#more\" class=\"lazy-load\" data-load=\"events\" data-page=\"1\">Load more</a></div>\n";
}

echo "</div>\n";
