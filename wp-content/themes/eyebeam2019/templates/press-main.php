<div class="press-main">
	<h2>Media Releases</h2>
	<ul>
		<?php

		$releases = get_posts(array(
			'post_type' => 'mediarelease',
			'posts_per_page' => 4
		));

		foreach ($releases as $release) {
			$GLOBALS['eyebeam2018']['current_page_item'] = $release;
			get_template_part('templates/press-media-release');
		}

		?>
	</ul>
</div>

<div class="press-recent">
<hr />
<h2>Recent News</h2>
	<ul>
		<?php

		$recent = get_posts(array(
			'post_type' => 'recentpress',
			'posts_per_page' => 4
		));
		foreach ($recent as $post) {
			$GLOBALS['eyebeam2018']['current_page_item'] = $post;
			get_template_part('templates/press-recent');
		}

		?>
	</ul>
</div>
