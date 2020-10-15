<?php

extract($GLOBALS['eyebeam2018']['curr_module']);


$id = "module-alumni";
$class = 'module module-collection module-full_width';

$query_year = date('Y');
$years = '';
if ($residents_date != 'hide') {
	$years = array('All');
	for ($y = ($query_year); $y > 1999; $y--) {
		$years[] = $y;
	}

	// $years = '<option>' . implode("</option>\n<option>", $years) . "</option>\n";
	// $years = "<select id=\"years-select\">$years</select>";
	// $years = "<div id=\"residents-year\"><label for=\"years-select\">$years Select Year</label></div>";
}

echo "<div id=\"$id\" class=\"$class\">\n";

echo "<h2 class=\"module-title\">$title</h2>\n";
$columns = column_map($collection_columns);

$ul_class = ($show_resident_image == 'show') ? ' show-resident-image' : '';

echo "<ul class=\"$collection_columns$ul_class\" data-columns=\"$columns\">\n";

if (!empty($featured_residents)){
	$residents = $featured_residents;
}
else {

	if ( empty($collection_post_limit) || ($collection_post_limit == 0) ){
		$residents = eyebeam2018_get_residents($residents_start_year, $residents_end_year);
	}
	else {
		$residents = eyebeam2018_get_residents($residents_start_year, $residents_end_year, $collection_post_limit);
	}

}

foreach ($residents as $resident) {
	$GLOBALS['eyebeam2018']['curr_collection_item'] = $resident;
	get_template_part('templates/collection-resident-item');
}

echo "</ul>\n";
echo "<br class=\"clear\">\n";
echo "</div>\n";
