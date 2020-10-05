<?php
extract($GLOBALS['eyebeam2018']['curr_module']);

if (! empty($module_frame)){
	$frame_class = ($module_frame == "true") ? 'module-frame' : '';
}

if (! empty($toc_title)) {
	$hash = sanitize_title($toc_title);
}
if ($type == 'separator'){
	echo "<hr />";
}
else {

	echo "<li id=\"module-$hash\" class=\"module module-$type $frame_class\">\n";
	echo "<div class=\"item-container\">\n";


	if ( !is_null($video_url) ) {

		echo "<div class=\"module-video\">\n";
		eyebeam2018_video_embed($video_url);
		echo "</div>\n";

	}



	$image = '';
	if (! empty($image_id)) {

		$size = 'large';
		$image = eyebeam2018_get_image_html($image_id, $size, true);

		if (! empty($url)) {
			$image = "<a href=\"$url\">$image</a>";
		}

		$figure_class = ($layout == 'text_first') ? 'float-right' : 'float-left';

		if (! empty($image)){
			$image = "<figure class=\"module-image $figure_class\">$image</figure>\n";
		}

	}


	if (! empty($title)) {

		if ($type == 'two_thirds' && ! empty($url)) {
			$title .= ' &mdash;&gt;';
		}

	if ( !empty($url) ){
		$title_text = ($show_button == 'show') ? $title : "<a alt=\"$title\" title=\"$title\" href=\"$url\">$title</a>";
	}
	else {
		$title_text = $title;
	}

		$text_description .= "<h2 class=\"module-title eyebeam-sans\" alt=\"$title\" title=\"$title\">$title_text</h2>\n";

	}

	if (! empty($subtitle)){
		$text_description .= "<h3 class=\"module-subtitle eyebeam-sans\" alt=\"$subtitle\" title=\"$subtitle\">" . $subtitle . "</h3>";
	}

	if (! empty($description)) {
		$text_description .= "<div class=\"module-description\">$description\n";
	}

	if ( (! empty($show_button)) && ($show_button == 'show') && (! empty($url)) ) {

		$text_description .= "<a class=\"btn\" href=\"$url\">\n";
		$text_description .= $button_text;
		$text_description .= "</a>\n";
	}

	// if (!empty ($layout) && $layout == 'text_first'){
		// echo $text_description.$image;
	// }
	// else {
		echo "$image<div class=\"module-flex\">$text_description</div>";
	// }

	if ( !empty($button_text) || !empty ($description) || !empty($url) ){
	}

	//
	// $layout = 'text_first';
	// if (! empty($layout) &&
	// 		! empty($description) &&
	//     $layout == 'text_first') {
	// 		echo "$text$image$text_description";
	// } else {
	// 	echo "$image$text$text_description";
	// }




	echo "</div>\n";

}
echo "</li>\n";
