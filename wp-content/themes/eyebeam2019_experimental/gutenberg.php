<?php
/*
Template Name: Gutenberg
*/

get_header();

while (have_posts()) {

	the_post();

	echo "<div class=\"\">\n";


	get_template_part('templates/gutenberg-post');
	// get_template_part('templates/press-sidebar');

	echo "<br class=\"clear\">\n";
	echo "</div>\n";

}

get_footer();
