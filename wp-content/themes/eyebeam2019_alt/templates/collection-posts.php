<?php

extract($GLOBALS['eyebeam2018']['curr_module']);

$id = "module-$hash";
$class = 'module module-collection module-full_width';

$today = date('Ymd');

$upcoming_args = array(
	'post_type' => 'post',
	'posts_per_page' => $collection_post_limit,
	'category_name' => 'from-eyebeam', 'artist-interview', 'artist-reflection',
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

// $posts = get_posts($upcoming_args);
// if (! empty($posts)) {
// 	echo "<h2 class=\"module-title\">Upcoming</h2>\n";
// 	echo "<ul>\n";

// 	foreach ($posts as $event) {
// 		$GLOBALS['eyebeam2018']['curr_collection_item'] = $event;
// 		get_template_part('templates/collection-post-item');
// 	}

// 	echo "</ul>\n";
// 	echo "<br class=\"clear\">\n";
// }
$posts = eyebeam2018_get_blog_posts(1, $collection_post_limit);
if (! empty($posts)) {
	// echo "<h2 class=\"module-title\">Posts</h2>\n";
	echo "<ul id=\"posts-list\" class=\"masonry\" data-columns=\"2\">\n";

	foreach ($posts as $event) {
		$GLOBALS['eyebeam2018']['curr_collection_item'] = $event;
		get_template_part('templates/collection-post-item');
	}

	echo "</ul>\n";
	echo "<br class=\"clear\">\n";
	echo "<div class=\"load-more\"><a href=\"#more\" class=\"lazy-load\" data-load=\"posts\" data-page=\"1\">Load more</a></div>\n";
}

echo "</div>\n";
