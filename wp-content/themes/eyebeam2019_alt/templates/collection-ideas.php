<?php

echo "<ul id=\"ideas-list\">\n";

$posts = get_posts(array(
	'post_type' => 'post',
	'posts_per_page' => 9
));

foreach ($posts as $post) {
	$GLOBALS['eyebeam2018']['curr_collection_item'] = $post;
	get_template_part('templates/collection-ideas-item');
}

echo "</ul>\n";
echo "<br class=\"clear\">\n";
echo "<div class=\"load-more load-more-ideas\"><a href=\"#more\" class=\"lazy-load\" data-load=\"ideas\" data-page=\"1\">Load more</a></div>\n";
