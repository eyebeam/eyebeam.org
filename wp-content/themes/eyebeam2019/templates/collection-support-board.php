<?php

$board = $GLOBALS['eyebeam2018']['curr_collection_item'];

$name = apply_filters('the_title', $board->post_title);
$title = get_field('board_title', $board->ID);
$bio = get_field('board_bio', $board->ID);

echo "<li class=\"board\">\n";
echo "<h3 class=\"board-name module-title eyebeam-sans\">$name</h3>\n";
echo "<h3 class=\"board-title person-title module-title\">$title</h3>\n";
if (! empty($bio)) {
	echo "<a href=\"#bio\" class=\"toggle-bio\">Bio</a>\n";
	echo "<div class=\"bio board-bio\">$bio</div>\n";
}
echo "</li>\n";

?>
