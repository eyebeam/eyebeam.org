<?php
/*
Template Name: Calendar
*/

get_header();

while (have_posts()) {

	the_post();

	echo "<div class=\"calendar\">\n";

	get_template_part('templates/calendar-main');

	echo "</div>\n";

}

get_footer();
