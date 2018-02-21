<?php
/*

General purpose page.php, which includes an ACF items repeater.

*/

get_header();

while (have_posts()) {

	the_post();

	echo "<div class=\"item-container\">\n";
	while (have_rows('items')) {
		get_template_part('templates/page-item');
	}
	echo "<br class=\"clear\">\n</div>\n";
}

get_footer();
