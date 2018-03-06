<?php

echo "<div class=\"post-meta\">\n";

global $post;

if (has_category('community') ||
    has_category('youth') ||
    $post->post_type == 'event') {
	the_field('post_meta');
} else {
	the_time('F j, Y');

	$author = get_field('author');
	if (! empty($author)) {
		echo "<h3 class=\"post-author\">by $author</h3>\n";
	}
}

echo "</div>\n";
