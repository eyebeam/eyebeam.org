<?php
/*
Template Name: How to Get Here
*/

get_header();

while (have_posts()) {

	the_post();

	echo "<div class=\"how-to-get-here\">\n";

	get_template_part('templates/directions-main');


	echo "</div>\n";

}

get_footer();
