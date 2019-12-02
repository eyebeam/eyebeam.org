<?php


global $post;
$show_date = get_field('show_date');
$meta = get_field('meta');
$author = get_field('author');
$tags = get_the_tags();
$show_tags = (get_field('show_tags') == 'show' ? true : false);

echo "<div class=\"post-main post-main-top\">\n";
echo "<h2 class=\"post-title eyebeam-sans\">";
the_title();

echo "</h2>\n";

echo "<div class=\"post-info\">\n";
// show date and author
if ($show_date == 'show') {


	echo "<h3 class=\"post-date\">\n";
		the_time('F j, Y');
	echo "</h3>";

	if (! empty($author)) {
		echo "<h3 class=\"post-author\">by $author</h3>\n";
	}
} else if (! empty($meta)) {
	echo "$meta\n";
	if (! empty($author)) {
		echo "<p class=\"post-author\">by $author</p>\n";
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
		//echo "<h3 class=\"event-dates\">$dates</h3>\n";
	}
}

if (! empty(get_field('button_text'))){
	$button_text = get_field('button_text');
	$button_url = get_field('button_url');

echo "<a class=\"btn\" href=\"$button_url\">\n";
echo $button_text;
echo "</a>\n";
echo "</div>";
echo "<div class=\"post-content\">\n";
}

echo "</div>\n";


$image_id = get_field('image', $post->ID);
if (! $image_id) {
	$image_id = get_post_thumbnail_id($page);
}

$image = '';
if (! empty($image_id)) {

	$size = 'large';
	$image = eyebeam2018_get_image_html($image_id, $size);

	echo "<figure class=\"post-image\">$image</figure>\n";

}

if (! empty($GLOBALS['eyebeam2018']['post_intro'])) {
	echo "<div class=\"post-intro\">\n";
	echo $GLOBALS['eyebeam2018']['post_intro'];
	echo "</div>\n";
}


echo "</div>\n";
