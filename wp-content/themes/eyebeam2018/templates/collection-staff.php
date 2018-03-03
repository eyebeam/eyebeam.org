<?php

extract($GLOBALS['eyebeam2018']['curr_module']);

echo "<h2 class=\"module-title\">$title</h2>\n";
echo "<ul>\n";

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
