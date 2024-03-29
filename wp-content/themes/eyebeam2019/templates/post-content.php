<?php

global $post;
$show_date = get_field('show_date');
$meta = get_field('meta');
$author = get_field('author');
$tags = get_the_tags();
$show_tags = (get_field('show_tags') == 'show' ? true : false);

// start page
echo "<div class=\"post-main\">\n";

// open post content
echo "<div class=\"post-content\">\n";

echo "<h2 class=\"post-title eyebeam-sans\">";
the_title();
echo "</h2>";

echo "<div class=\"post-info\">\n";

// show date and author
if ($show_date == 'show') {

	echo "<h3 class=\"post-date\">\n";
	the_time('F j, Y');
	echo "</h3>";

	if (! empty($author)) {
		echo "<h3 class=\"post-author\">by $author</h3>\n";
	}

// if show date is false but $meta is not empty
} else if (! empty($meta)) {
	echo "$meta\n";

	if (! empty($author)) {
		echo "<p class=\"post-author\">by $author</p>\n";
	}

// if show date is false and $meta is empty
} else {

	// These fields come from Event posts

	/* TODO
	* Clean up this garbage!!!!
	*/


	// Echo Resident Information

	// subtitle
	$subtitle = get_field('subtitle');
	if (! empty($subtitle)) {
		echo "<h3 class=\"event-subtitle\">$subtitle</h3>\n";
	}

	// residency dates
	$start_date = get_field('start_date');
	$end_date = get_field('end_date');

	if (! empty($start_date) && ! empty($end_date)) {

		// some complex date logic
		if ($start_date == $end_date) {
			// January 12, 2019
			$dates = date('F j, Y', strtotime($start_date));
		} else if (substr($start_date, 0, 6) == substr($end_date, 0, 6)) {
			// January 12–13, 2019
			$start_date = date('F j', strtotime($start_date));
			$end_date = date('j, Y', strtotime($end_date));
			$dates = "$start_date&ndash;$end_date";
		} else if (substr($start_date, 0, 4) == substr($end_date, 0, 4)) {
			// January 12–February 2, 2019
			$start_date = date('F j', strtotime($start_date));
			$end_date = date('F j, Y', strtotime($end_date));
			$dates = "$start_date&ndash;$end_date";
		} else {
			// December 31, 2018–January 2, 2019
			$start_date = date('F j, Y', strtotime($start_date));
			$end_date = date('F j, Y', strtotime($end_date));
			$dates = "$start_date&ndash;$end_date";
		}

	}

	// end if $meta is empty or show date is false
}

// if there's a button
if (! empty(get_field('button_text'))){

	$button_text = get_field('button_text');
	$button_url = get_field('button_url');

	echo "<a class=\"btn\" href=\"$button_url\">\n";
	echo $button_text;
	echo "</a>\n";

}

// end post content
echo "</div>";

// post intro
if (! empty($GLOBALS['eyebeam2018']['post_intro'])) {

	echo "<div class=\"post-intro\">\n";
	echo $GLOBALS['eyebeam2018']['post_intro'];
	echo "</div>\n";
	
}

do_action('pre-post_content');

echo $GLOBALS['eyebeam2018']['post_content'];

do_action('post-post_content');

// find related projects

echo "</div>\n";

echo "</div>\n";

// echo "<br class=\"clear\">\n";
