<div class="press-main">
	<h2>Media Releases</h2>
	<ul>
		<?php

		$releases = get_posts(array(
			'post_type' => 'mediarelease',
			'posts_per_page' => 10
		));

		foreach ($releases as $release) {
			$GLOBALS['eyebeam2018']['current_page_item'] = $release;
			get_template_part('templates/press-media-release');
		}

		?>
	</ul>
	<br class="clear">
</div>
