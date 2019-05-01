<?php

echo "<div class=\"archive-featured\">\n";

while (have_rows('featured_items')) {

	the_row();

	get_template_part('templates/archive-featured-item');

}

echo "</div>\n";
