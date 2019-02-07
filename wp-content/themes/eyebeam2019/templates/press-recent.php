<?php

$post = $GLOBALS['eyebeam2018']['current_page_item'];

$link = get_field('link', $post->ID);
$publication = get_field('publication', $post->ID);
$quote = get_field('quote', $post->ID);

echo "<li>\n";
echo "<h3 class=\"press-recent-title\">$link</h3>\n";
echo "<div class=\"press-recent-publication\">$publication</div>\n";
echo "<blockquote>$quote</blockquote>\n";
echo "</li>\n";
