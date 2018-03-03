<?php

extract($GLOBALS['eyebeam2018']['curr_module']);

$id = "module-$hash";
$class = 'module module-collection module-full_width';

// Upcoming events are forward-chronological, as in the soonest first. Past
// events are reverse-chron, so that the most recent events come first. For now
// we are going to hard-code the limit at 6 instead of showing *all* the events
// that have ever been. We will need pagination here at some point, but we gotta
// start somewhere. (20180118/dphiffer)

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

$past_args = array(
	'post_type' => 'event',
	'posts_per_page' => 6,
	'orderby'=> 'meta_value',
	'meta_key' => 'end_date',
	'order' => 'DESC',
	'meta_query' => array(
		array(
			'key'=> 'end_date',
			'value'=> $today,
			'compare'=> '<'
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

$posts = get_posts($past_args);
if (! empty($posts)) {
	echo "<h2 class=\"module-title\">Past Events</h2>\n";
	echo "<ul>\n";

	foreach ($posts as $event) {
		$GLOBALS['eyebeam2018']['curr_collection_item'] = $event;
		get_template_part('templates/collection-event-item');
	}

	echo "</ul>\n";
	echo "<br class=\"clear\">\n";
}

echo "</div>\n";
