<?php
/*
Template Name: Press
*/

get_header();

while (have_posts()) {

	the_post();

	echo "<div class=\"press\">\n";

	get_template_part('templates/press-main');
	get_template_part('templates/press-sidebar');

	echo "<br class=\"clear\">\n";
	echo "</div>\n";

}

get_footer();
