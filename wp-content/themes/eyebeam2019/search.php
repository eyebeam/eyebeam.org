<?php
/*

Template Name: Search Page

*/
global $query_string;

wp_parse_str( $query_string, $search, $search_query );
$search = new WP_Query ($search_query);

$query = str_replace('s=', '', $query_string);
$query_decode = urldecode($query);
global $wp_query;


get_header();
if (count($wp_query->posts) > 0){
echo "<div class=\"module module-collection related-readings\">";
	echo "<h2 class=\"module-title eyebeam-sans\">Search Results: $query</h2>";
	echo "<ul id=\"search\">";
	foreach($wp_query->posts as $post){

		$GLOBALS['eyebeam2018']['curr_collection_item'] = $post;
		get_template_part('templates/collection', eyebeam2018_template_map($post->post_type));
	}


	echo "</ul>";
	echo "</div>";
	echo "<br class=\"clear\">\n";
}
else {
	echo "<div class=\"module module-collection related-readings\">";
	echo "<h2 class=\"module-title\">Search Results: $query_decode</h2>";
	echo "<ul>";
	get_template_part('templates/collection', 'none');
	echo "</ul>";
	echo "</div>";
	echo "<br class=\"clear\">\n";

}

get_footer();
