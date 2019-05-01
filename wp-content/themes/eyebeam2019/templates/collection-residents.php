<?php

extract($GLOBALS['eyebeam2018']['curr_module']);

$id = "module-alumni";
$class = 'module module-collection module-full_width';

$years = '';
if ($residents_date != 'hide') {
	$years = array('All');
	for ($y = date('Y'); $y > 1999; $y--) {
		$years[] = $y;
	}

	$years = '<option>' . implode("</option>\n<option>", $years) . "</option>\n";
	$years = "<select id=\"years-select\">$years</select>";
	$years = "<div id=\"residents-year\"><label for=\"years-select\">$years Select Year</label></div>";
}

echo "<div id=\"$id\" class=\"$class\">\n";

echo "<h2 class=\"module-title\">$title</h2>\n";
echo "$years\n";
$columns = column_map($collection_columns);
echo "<ul class=\"$collection_columns masonry\" data-columns=\"$columns\">\n";
if ($title == 'Alumni'){
	$residents = eyebeam2018_get_residents(2017);
}
else {
	$residents = eyebeam2018_get_residents();
}

foreach ($residents as $resident) {
	$GLOBALS['eyebeam2018']['curr_collection_item'] = $resident;
	get_template_part('templates/collection-resident-item');
}

echo "</ul>\n";
echo "<br class=\"clear\">\n";
echo "</div>\n";
