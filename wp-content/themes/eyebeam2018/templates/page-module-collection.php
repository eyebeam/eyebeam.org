<?php

extract($GLOBALS['eyebeam2018']['curr_module']);

?>
<div class="module module-collection module-full_width">
	<?php

	echo "<h2 class=\"module-title\">$title</h2>\n";
	echo "<ul>\n";

	$posts = get_posts(array(
		'post_type' => $collection,
		'posts_per_page' => -1
	));

	foreach ($posts as $p) {
		$GLOBALS['eyebeam2018']['curr_collection_item'] = $p;
		get_template_part('templates/collection', $collection);
	}

	echo "</ul>\n";

	?>
</div>
