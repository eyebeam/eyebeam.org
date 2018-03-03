<?php

echo "<ul>\n";

$posts = get_posts(array(
	'post_type' => 'post',
	'posts_per_page' => 6
));

foreach ($posts as $post) {
	$GLOBALS['eyebeam2018']['curr_collection_item'] = $post;
	get_template_part('templates/collection-ideas-item');
}

echo "</ul>\n";
echo "<br class=\"clear\">\n";
