<?php
/*

Okay so if you are unfamiliar with WordPress, this is kind of ridiculous. In
the dashboard you will notice there are both "posts" and "pages." This is the
file that handles "pages." The main difference is that pages can be structured
into a parent/child hierarchy, whereas posts are organized by when they were
published (like a blog). (20180221/dphiffer)

*/

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
	}
}

get_footer();
