<?php

extract($GLOBALS['eyebeam2018']['curr_module']);

$id = "module-$hash";
$class = 'module module-collection module-full_width';

$years = array();
for ($y = date('Y'); $y > 1999; $y--) {
	$years[] = $y;
}

$years = '<option>' . implode("</option>\n<option>", $years) . "</option>\n";
$years = "<select>$years</select>";
$years = "<div id=\"residents-year\">Year: $years</div>";

echo "<div id=\"$id\" class=\"$class\">\n";

echo "<h2 class=\"module-title\">$title</h2>\n";
echo "$years\n";
echo "<ul>\n";

$residents = eyebeam2018_get_residents();
foreach ($residents as $resident) {
	$GLOBALS['eyebeam2018']['curr_collection_item'] = $resident;
	get_template_part('templates/collection-resident-item');
}

echo "</ul>\n";
echo "<br class=\"clear\">\n";
echo "</div>\n";
