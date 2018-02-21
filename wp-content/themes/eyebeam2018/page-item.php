<?php

the_row();

$title = null;
$url = null;
$description = null;

$width = get_sub_field('width');

if (get_sub_field('page')) {
	$page = get_sub_field('page');
	$title = apply_filters('the_title', $page->post_title);
	$url = get_permalink($page->ID);
	$description = apply_filters('the_excerpt', $page->post_excerpt);
}

if (get_sub_field('title') != '') {
	$title = get_sub_field('title');
}

if (get_sub_field('url') != '') {
	$url = get_sub_field('url');
}

if (get_sub_field('description') != '') {
	$description = get_sub_field('description');
}

?>
<div class="item <?php echo $width; ?>">
	<?php

	if (! empty($title) && ! empty($url)) {
		echo "<h2><a href=\"$url\">$title</a></h2>\n";
	} else if (! empty($title)) {
		echo "<h2>$title</h2>\n";
	}

	if (! empty($description)) {
		echo "<div class=\"item-description\">$description</div>\n";
	}

	?>
</div>
