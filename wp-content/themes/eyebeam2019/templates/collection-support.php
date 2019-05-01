<?php

extract($GLOBALS['eyebeam2018']['curr_module']);

if (! empty($toc_title)) {
	$hash = sanitize_title($toc_title);
}

$id = "module-$hash";
$class = 'module module-collection module-full_width';

echo "<div id=\"$id\" class=\"$class\">\n";
echo "<h2 class=\"module-title\">Board</h2>\n";
echo "<ul class=\"$collection_columns\">\n";

$posts = get_posts(array(
	'post_type' => 'board',
	'posts_per_page' => -1,
	'orderby' => 'menu_order',
	'order' => 'ASC'
));

foreach ($posts as $board) {
	$GLOBALS['eyebeam2018']['curr_collection_item'] = $board;
	get_template_part('templates/collection-support-board');
}

echo "</ul>\n";
echo "<br class=\"clear\">\n";

echo "<div class=\"support-advisory\">\n";
echo "<h2 class=\"module-title\">Advisory Committee</h2>\n";
echo "<ul class=\"$collection_columns\">\n";

$posts = get_posts(array(
	'post_type' => 'advisory_board',
	'posts_per_page' => -1,
	'orderby' => 'menu_order',
	'order' => 'ASC'
));

foreach ($posts as $advisory) {
	$GLOBALS['eyebeam2018']['curr_collection_item'] = $advisory;
	get_template_part('templates/collection-support-advisory');
}

echo "</ul>\n";
echo "<br class=\"clear\">\n";
echo "</div>\n";


echo "<br class=\"clear\">\n";
echo "</div>\n";

echo "<br class=\"clear\">\n";
echo "</div>\n";
