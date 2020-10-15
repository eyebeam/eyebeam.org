<?php

echo "<div class=\"post-meta\">\n";

global $post;
$show_date = get_field('show_date');
$meta = get_field('meta');
$author = get_field('author');
$tags = get_the_tags();
$show_tags = (get_field('show_tags') == 'show' ? true : false);

// List all The Tags

if ($tags){
	foreach($tags as $tag){
		// gonna keep this here incase we need to use it later
		$link = get_tag_link($tag->term_id);
		$tagnames[] = "<a href=\"$link\">$tag->name</a>";
		// $tagnames[] = $tag->name;

	}

	if (count($tagnames) && $show_tags){
		echo "Tags: " . implode($tagnames, ',');
	}

}

echo "</div>\n";
