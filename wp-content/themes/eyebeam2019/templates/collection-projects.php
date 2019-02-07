<?php

extract($GLOBALS['eyebeam2018']['curr_module']);

$id = "module-$hash";
$class = 'module module-collection module-full_width';


echo "<div id=\"$id\" class=\"$class\">\n";

echo "<h2 class=\"module-title\">$title</h2>\n";
echo "$years\n";
echo "<ul>\n";

$projects = eyebeam2018_get_projects();
foreach ($projects as $project) {
	$GLOBALS['eyebeam2018']['curr_collection_item'] = $project;
	get_template_part('templates/collection-project-item');
}

echo "</ul>\n";
echo "<br class=\"clear\">\n";
echo "</div>\n";
