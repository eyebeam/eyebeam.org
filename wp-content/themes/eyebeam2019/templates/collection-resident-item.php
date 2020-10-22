<?php

$resident = $GLOBALS['eyebeam2018']['curr_collection_item'];
$is_related_reading = $GLOBALS['eyebeam2018']['is_related_reading'];
$show_resident_info = $GLOBALS['eyebeam2018']['curr_module']['show_resident_info'];
$show_resident_image = $GLOBALS['eyebeam2018']['curr_module']['show_resident_image'];


$name = apply_filters('the_title', $resident->post_title);
$type = get_field('resident_type', $resident->ID);
$start_year = get_field('start_year', $resident->ID);
$end_year = get_field('end_year', $resident->ID);
$image_id = get_field('image', $resident->ID);
$featured_video = get_field('featured_video', $resident->ID);
$links = get_field('links', $resident->ID);
$link_target = get_field('link_target', $resident->ID);
$permalink = get_permalink($resident->ID);
$collaboration_member = get_field('collaboration_member', $resident->ID);

if ($collaboration_member == 'hide') {
	return;
}

// reset image
$image = '';

// if the image id is set
if (! empty($image_id)) {
	$size = 'medium';
	$image = eyebeam2018_get_image_html($image_id, $size, false);
}

// if there's a link and it's internal
if (! empty($permalink) && ( $link_target == 'internal' ) ){

	if ($show_resident_image == "show"){
		$displayname = "$name &rarr;";
	}
	else {
		$displayname = "$name";
	}

	$name = (!empty($featured_video)) ? "<a data-micromodal-open=\"modal-$image_id\" href=\"$permalink\">$displayname</a>" : "<a href=\"$permalink\">$displayname</a>";
		if (! empty($image)) {
		$image = "<a class=\"image\" href=\"$permalink\">$image</a>";
	}
}
else if (! empty($links)) {
	$first_link = $links[0];
	$url = $first_link['link_url'];

	if (!empty($featured_video)){
		$name = "<a data-microodal-open=\"modal-$image_id\" href=\"$url\">$name</a>";
	}
	else {
		$name = "<a href=\"$url\">$name</a>";
	}

	if (! empty($image)) {
		$image = "<a class=\"image\" href=\"$url\">$image</a>";
	}
}
else if(empty($links)) {
	$name = "<a>$name</a>";
	$image = "<a>$image</a>";
}

$label = ($is_related_reading) ? eyebeam2018_label_map($resident->post_type) : false;
$label_slug = ($is_related_reading) ? 'label-'.strtolower(eyebeam2018_label_map($resident->post_type)) : false;

/*$bio_toggle = 'Bio';
$members = get_field('members', $resident->ID);
if (! empty($members)) {
	$bio_toggle = 'Bios';
}*/

//$bio = eyebeam2018_resident_bio($resident, $members);

if ($start_year == $end_year) {
	$years = $start_year;
} else {
	$years = "$start_year&ndash;$end_year";
}


if (is_search()){
	echo "<li>\n";
	echo "$image\n";
	echo "<h3 class=\"event-title module-title eyebeam-sans\">$name</h3>\n";
	echo "</li>\n";
}
else {

	echo "<li class=\"resident collection-item\">\n";
	echo "<div class=\"item-container\">\n";

	if (!empty($show_resident_image) && $show_resident_image == "show"){
		echo "$image\n";
	}

	echo ($label) ? "<h5 class=\"post-label $label_slug\">$label</h5>" : '';
	echo "<h3 class=\"resident-name\">$name</h3>\n";

	if (!empty($show_resident_info) && $show_resident_info == "show"){
		echo "<h4 class=\"resident-type person-title module-title\">$type</h4>\n";
		echo "<div class=\"resident-years\">$years</div>\n";
		//echo "<a href=\"#bio\" class=\"toggle-bio\">$bio_toggle</a>\n";
		echo "<div class=\"bio\">$bio</div>\n";
		//echo "$bio\n";
	}
	echo "</div>\n";
	echo "</li>\n";

	if (!empty($featured_video)){


		parse_str( parse_url( $featured_video, PHP_URL_QUERY ), $video_vars );
		$video_id =  $video_vars['v'];
		$embed_url = "https://youtube.com/embed/$video_id";


		echo "<div class=\"modal micromodal-slide\" id=\"modal-$image_id\" aria-hidden=\"true\">

						<!-- [2] -->
						<div tabindex=\"-1\" data-micromodal-close>

							<!-- [3] -->
							<div role=\"dialog\" aria-modal=\"true\" aria-labelledby=\"modal-1-title\" >

								<header>
									<h2 class=\"modal__title\" id=\"modal-$image_id-title\">
									$artist_title
									</h2>
									<!-- [4] -->
									<a href=\"#\" aria-label=\"Close modal\" data-micromodal-close>[Close]</a>
								</header>

								<div id=\"modal-1-content\" class=\"modal-content\">
								<div class=\"featured-video\" style=\"flex: 1 0 100%;justify-content: center;display: flex;flex-flow: column wrap;\">
								<iframe style=\"margin: 0 auto;\" src=\"$embed_url\"></iframe>
								<p style=\"text-align: center;\"><a href=\"$permalink\">Click Here to read more</a></p>
								</div>
								</div>

							</div>
						</div>
					</div>";
	}

}



?>
