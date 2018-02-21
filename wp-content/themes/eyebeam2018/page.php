<?php
/*

General purpose page.php, which includes an ACF items repeater.

*/

get_header();

while (have_posts()) {

	the_post();

	echo '<div class="item-container">';
	while (have_rows('items')) {
		get_template_part('page-item');
	}
	echo '<br class="clear"></div>';
}

get_footer();
