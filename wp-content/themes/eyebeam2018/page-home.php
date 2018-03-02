<?php
/*
Template Name: Homepage

This is like the modular grid, but with some extra stuff thrown in.

*/
get_header();

while (have_posts()) {

	the_post();

	// TODO Don't hardcode this
	get_template_part('templates/home-video');

	echo "<div class=\"item-container\">\n";
	while (have_rows('items')) {
		get_template_part('templates/page-item');
	}
	echo "<br class=\"clear\">\n</div>\n";
}

get_footer();
