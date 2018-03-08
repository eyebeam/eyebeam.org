<?php

echo "<div class=\"post-meta\">\n";

global $post;

$show_date = get_field('show_date');
$meta = get_field('meta');
$author = get_field('author');

if ($show_date == 'show') {
	the_time('F j, Y');
	if (! empty($author)) {
		echo "<h3 class=\"post-author\">by $author</h3>\n";
	}
} else if (! empty($meta)) {
	echo "$meta\n";
	if (! empty($author)) {
		echo "<h3 class=\"post-author\">by $author</h3>\n";
	}
} else {

	// These fields come from Event posts

	$subtitle = get_field('subtitle');
	if (! empty($subtitle)) {
		echo "<h3 class=\"event-subtitle\">$subtitle</h3>\n";
	}

	$start_date = get_field('start_date');
	$end_date = get_field('end_date');
	if (! empty($start_date) &&
	    ! empty($end_date)) {
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
		echo "<h3 class=\"event-dates\">$dates</h3>\n";
	}
}


echo "</div>\n";
