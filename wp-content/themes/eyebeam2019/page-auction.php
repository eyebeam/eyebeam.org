<?php
/*
Template Name: Auction
*/

get_header();

while (have_posts()) {

	the_post();

	echo "<div class=\"auction-list\">\n";

	get_template_part('templates/auction-main');

	echo "</div>\n";

}

get_footer();
