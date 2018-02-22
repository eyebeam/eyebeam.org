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

	// Page stuff goes here
}

get_footer();
