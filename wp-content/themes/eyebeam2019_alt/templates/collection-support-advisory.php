<?php

$advisory = $GLOBALS['eyebeam2018']['curr_collection_item'];

$name = apply_filters('the_title', $advisory->post_title);
$bio = apply_filters('the_content', $advisory->post_content);

echo "<li class=\"advisory\">\n";
echo "<h3 class=\"advisory-name module-title\">$name</h3>\n";
if (! empty($bio)) {
	echo "<a href=\"#bio\" class=\"toggle-bio\">Bio</a>\n";
	echo "<div class=\"bio advisory-bio\">$bio</div>\n";
}
echo "</li>\n";

?>
