<?php
/*
Template Name: Archive
*/

eyebeam2018_view_source_post('02-develop-intro');

get_header();

while (have_posts()) {

	the_post();

	echo "<div class=\"archive\">\n";

	get_template_part('templates/archive-intro');
	get_template_part('templates/archive-featured');

	echo "</div>\n";

}

get_footer();
