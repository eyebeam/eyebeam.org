<div class="press-sidebar">
	<?php the_content(); ?>
	<div class="press-recent">
		<h2>Recent Press</h2>
		<ul>
			<?php

			$recent = get_posts(array(
				'post_type' => 'recentpress',
				'posts_per_page' => 10
			));
			foreach ($recent as $post) {
				$GLOBALS['eyebeam2018']['current_page_item'] = $post;
				get_template_part('templates/press-recent');
			}

			?>
		</ul>
	</div>
</div>
