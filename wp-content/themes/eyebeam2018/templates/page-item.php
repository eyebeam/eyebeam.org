<?php

the_row();

$title = null;
$url = null;
$description = null;
$image_id = null;

$width = get_sub_field('width');

if (get_sub_field('page')) {
	$page = get_sub_field('page');
	$title = apply_filters('the_title', $page->post_title);
	$url = get_permalink($page->ID);
	$description = apply_filters('the_excerpt', $page->post_excerpt);
	$image_id = get_field('image', $page->ID);
	if (! $image_id) {
		$image_id = get_post_thumbnail_id($page);
	}
}

if (! empty(get_sub_field('title'))) {
	$title = get_sub_field('title');
}

if (! empty(get_sub_field('url'))) {
	$url = get_sub_field('url');
}

if (! empty(get_sub_field('description'))) {
	$description = get_sub_field('description');
}

if (! empty(get_sub_field('image'))) {
	$image = get_sub_field('image');
}

?>
<div class="item <?php echo $width; ?>">
	<?php

	if (! empty($image_id)) {
		if ($width == 'one-third') {
			$size = 'medium';
		} else if ($width == 'full-width') {
			$size = 'large';
		}
		list($src, $width, $height) = wp_get_attachment_image_src($image_id, $size);
		$html = "<img src=\"$src\">";
		if (! empty($url)) {
			$html = "<a href=\"$url\">$html</a>";
		}
		echo "<figure>$html</figure>\n";
	}

	if (! empty($title)) {
		$html = $title;
		if ($width == 'two-thirds' && ! empty($url)) {
			$html .= ' &mdash;&gt;';
		}
		if (! empty($url)) {
			$html = "<a href=\"$url\">$html</a>";
		}
		echo "<h2>$html</h2>\n";
	}

	if (! empty($description)) {
		echo "<div class=\"item-description\">$description</div>\n";
	}

	?>
</div>
