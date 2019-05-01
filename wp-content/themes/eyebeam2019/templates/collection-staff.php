<?php

extract($GLOBALS['eyebeam2018']['curr_module']);
$id = "module-$hash";
$class = 'module module-collection module-full_width';

echo "<div id=\"$id\" class=\"$class\">\n";

echo "<h2 class=\"module-title\">$title</h2>\n";
echo "<ul class=\"$collection_columns\">\n";

$posts = get_posts(array(
	'post_type' => 'staff',
	'posts_per_page' => -1
));

foreach ($posts as $staff) {
	$GLOBALS['eyebeam2018']['curr_collection_item'] = $staff;
	get_template_part('templates/collection-staff-item');
}

echo "</ul>\n";
echo "<br class=\"clear\">\n";
echo "</div>\n";

echo "<div class=\"support-interns\">\n";
echo "<h2 class=\"module-title\">Interns</h2>\n";
echo "<ul class=\"$collection_columns\">\n";

$posts = get_posts(array(
	'post_type' => 'intern',
	'posts_per_page' => -1,
	'orderby' => 'menu_order',
	'order' => 'ASC'
));

foreach ($posts as $intern) {
	$GLOBALS['eyebeam2018']['curr_collection_item'] = $intern;
	get_template_part('templates/collection-support-intern');
}

echo "</ul>\n";
