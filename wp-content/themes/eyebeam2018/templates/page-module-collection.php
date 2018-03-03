<?php

extract($GLOBALS['eyebeam2018']['curr_module']);

$id = "module-$hash";
$class = 'module module-collection module-full_width';

echo "<div id=\"$id\" class=\"$class\">\n";

get_template_part('templates/collection', $collection);

echo "</div>\n";
