<?php
/*

Template Name: Tag Page

*/
$queried_object = get_queried_object();
$args = array(
	'post_type' => 'any',
	'posts_per_page' => -1,
	'orderby' => 'rand',
	'tag__in' => $queried_object->term_id,
);


$tag_posts = get_posts($args);
wp_reset_postdata();

get_header();


if (count($tag_posts) > 0){
echo "<div class=\"module module-collection related-readings\">";
	echo "<h2 class=\"module-title\">Tagged: $queried_object->name</h2>";
	echo "<ul>";
	foreach($tag_posts as $post){

		$GLOBALS['eyebeam2018']['curr_collection_item'] = $post;
		get_template_part('templates/collection', eyebeam2018_template_map($post->post_type));
	}


	echo "</ul>";
	echo "</div>";
	echo "<br class=\"clear\">\n";
}
else {
	echo "<div class=\"module module-collection related-readings\">";
	echo "<h2 class=\"module-title\">Search Results</h2>";
	echo "<ul>";
	get_template_part('templates/collection', 'none');
	echo "</ul>";
	echo "</div>";
	echo "<br class=\"clear\">\n";

}


get_footer();
