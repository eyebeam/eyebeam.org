<?php

echo "<div class=\"post-meta\">\n";

the_time('F j, Y');

$author = get_field('author');
if (! empty($author)) {
	echo "<h3 class=\"post-author\">by $author</h3>\n";
}

echo "</div>\n";
