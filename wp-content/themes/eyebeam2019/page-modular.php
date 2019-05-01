<?php
/*
Template Name: Modular Grid
*/

if (is_front_page()) {
	eyebeam2018_view_source_post('01-hello-world');
}

get_header();

while (have_posts()) {

	the_post();

	while (have_rows('items')) {

		the_row();

		$type = get_sub_field('type');
		get_template_part("templates/item", $type);
	}

	get_template_part('templates/page-subnav');

	eyebeam2018_render_heroes();
	eyebeam2018_render_modules();

	if (is_front_page()) {
		get_template_part('templates/home-values');
	} else if ($post->post_name == 'education') {
		get_template_part('templates/education-sponsors');
	}

}

get_footer();
