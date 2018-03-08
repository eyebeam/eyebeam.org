
<div class="module-container module-sponsors-container">
	<div class="module module-sponsors module-full_width">
		<div class="sponsors-intro">
			<?php the_field('sponsors_intro'); ?>
		</div>
		<?php

		while (have_rows('sponsors')) {

			the_row();

			$size = 'medium';
			$image_id = get_sub_field('logo');
			list($src) = wp_get_attachment_image_src($image_id, $size);

			echo "<div class=\"module module-one_half\">\n";
			echo "<img src=\"$src\">\n";
			echo "</div>\n";

		}

		?>
		<br class="clear">
	</div>
	<br class="clear">
</div>
