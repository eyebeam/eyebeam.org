<?php

function auction_archive_title($title) {
	$page = get_page_by_path('auction');
	return $page->page_title;
}
add_filter('pre_get_document_title', 'auction_archive_title', 999);

get_header();

echo "<div class=\"auction-list\">\n";

get_template_part('templates/auction-main');

echo "</div>\n";

get_footer();
