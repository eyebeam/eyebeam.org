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

	$item_count = 0;
	while (have_rows('items')) {

		the_row();
		$item_count++;

		$type = get_sub_field('type');
		get_template_part("templates/item", $type);

	}

	// Here is where we double check if we have items for the modular grid. If
	// not, we bail out and use the standard template.
	if ($item_count == 0) {
		get_template_part("templates/post");
	} else {
		get_template_part("templates/page"); // See that? Page, not post! Sigh.
	}
}

get_footer();
