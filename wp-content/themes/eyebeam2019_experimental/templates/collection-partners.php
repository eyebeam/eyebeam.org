<?php

extract($GLOBALS['eyebeam2018']['curr_module']);

$id = "module-$hash";
$class = 'module module-collection module-full_width';

echo "<div id=\"$id\" class=\"$class\">\n";

echo "<h2 class=\"module-title\">$title</h2>\n";
echo "<ul>\n";

while (have_rows('partners')) {

	the_row();
	get_template_part('templates/collection-partner-item');
}

echo "</ul>\n";
echo "<br class=\"clear\">\n";
echo "</div>\n";
