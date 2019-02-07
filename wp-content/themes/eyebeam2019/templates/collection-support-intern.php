<?php

$intern = $GLOBALS['eyebeam2018']['curr_collection_item'];

$name = apply_filters('the_title', $intern->post_title);
$title = get_field('intern_title', $intern->ID);

echo "<li class=\"intern\">\n";
echo "<h3 class=\"intern-name module-title\">$name</h3>\n";
echo "<h3 class=\"intern-title person-title module-title\">$title</h3>\n";
echo "</li>\n";

?>
