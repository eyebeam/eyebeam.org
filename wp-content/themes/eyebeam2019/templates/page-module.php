<?php

// get the current module
extract($GLOBALS['eyebeam2018']['curr_module']);

// add css class if there is a frame
if (! empty($module_frame)){
	$frame_class = ($module_frame == "true") ? 'module-frame' : '';
}

if (! empty ($image_id)){
	$has_image = 'has-image';
}
else {
	$has_image = '';
}

if (! empty($toc_title)) {
	$hash = sanitize_title($toc_title);
}

// if it's a separator display it
if ($type == 'separator'){
	echo "<hr />";
}
// if not separator run the rest of the logic
else {

	echo "<li id=\"module-$hash\" class=\"module module-$type $frame_class $has_image\">\n";
	echo "<div class=\"item-container\">\n";


	if ( !is_null($video_url) ) {

		echo "<div class=\"module-video\">\n";
		eyebeam2018_video_embed($video_url);
		echo "</div>\n";

	}



	$image = '';
	// if there's an image
	if (! empty($image_id)) {

		// set the image size
		$size = 'large';
		// get the image using our helper function
		$image = eyebeam2018_get_image_html($image_id, $size, true);

		// if it worked
		if (! empty($url)) {
			$image = "<a href=\"$url\">$image</a>";
		}

		if (! empty($image)){
			$image = "<figure class=\"module-image\">$image</figure>\n";
		}

	}


	if (!empty($section_header)){
		$title = $section_header;
		if (!empty($section_header_link)){
			$link = $section_header_link;
		}
		echo (!empty($link)) ? "<h2 class=\"module-title\"><a href=\"$link\">$title</a></h2>" : "<h2 class=\"module-title\">$title</h2>";
	}

	// if there's a title
	if (! empty($title)) {

		if ($type == 'two_thirds' && ! empty($url)) {
			$title .= ' &mdash;&gt;';
		}

		// if there's a link set
		if ( !empty($url) ){
			$title_text = ($show_button == 'show') ? $title : "<a aria-label=\"Read More about $title\" title=\"$title\" href=\"$url\">$title</a>";
		}
		else {
			$title_text = $title;
		}

		// set the description
		$text_description .= "<h2 class=\"module-title eyebeam-sans\" alt=\"$title\" title=\"$title\">$title_text</h2>\n";
	}


	// if there's a subtitle
	if (! empty($subtitle)){
		$text_description .= "<h3 class=\"module-subtitle eyebeam-sans\" alt=\"$subtitle\" title=\"$subtitle\">" . $subtitle . "</h3>";
	}

	if (! empty($description)) {
		$text_description .= "<div class=\"module-description\">$description\n";
	}

	// if there's a button set and the setting to show it is true
	if ( $show_button == 'show' && ! empty($url) ) {

		$text_description .= "<a class=\"btn\" href=\"$url\">\n";
		$text_description .= $button_text;
		$text_description .= "</a>\n";
	}


	// image always comes before description


	if (! empty($description)) {

		if ($layout == 'text_first'){
			echo "<div class=\"module-flex\">$text_description</div>";
			if (!empty($image)) {
				echo "$image";
			}
		}
		else {
			if (!empty($image)) {
				echo "$image";
			}
			echo "<div class=\"module-flex\">$text_description</div>";
		}


		echo "</div>\n";

	}

	echo "</li>\n";

}
