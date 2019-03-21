<?php
/*
Template Name: Accessibility
*/

get_header();

while (have_posts()) {

	the_post();

	echo "<div class=\"calendar\">\n";

	get_template_part('templates/accessibility-main');

	echo "</div>\n";

}

get_footer();
