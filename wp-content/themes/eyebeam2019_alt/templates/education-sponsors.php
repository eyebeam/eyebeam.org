
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
			$image = eyebeam2018_get_image_html($image_id, $size);

			echo "<div class=\"module module-one_half\">\n";
			echo "$image\n";
			echo "</div>\n";

		}

		?>
		<br class="clear">
	</div>
	<br class="clear">
</div>
