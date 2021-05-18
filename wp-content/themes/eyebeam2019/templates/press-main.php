<div class="media-releases">
	<h2>Media Releases</h2>
	<ul class="media-releases-list">
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

<hr />

<div class="press-releases">
	<h2>Recent News</h2>
	<ul class="press-releases-list">
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

<hr />

<div class="press-info">
		<div class="press-contact">
			<h3 class="press-contact-headding">Press Contact</h3>
			<p class="press-contact-name">
				Mad Pinney
			</p>
			<p class="press-contact-title">
				Digital Engagement, Community, and Marketing Lead
			</p>
			<p class="press-contact-email">
				maddie.pinney@eyebeam.org
			</p>
		</div>
		<div class="press-kit">
			<h3 class="press-kit-heading">
				Press Kit
			</h3>
			<figure class="press-kit-logo">
				<img src="<?php echo get_template_directory_uri() . '/img/eyebeam-logo-small.png'; ?>" />
			</figure>
			<div class="press-kit-download">
				<p>
					Download our logo 
				</p>
				<div class="buttons">
					<a href="<?php echo get_template_directory_uri() . '/img/eyebeam-logo-black.zip'; ?>">Logo in Black</a>
					<a href="<?php echo get_template_directory_uri() . '/img/eyebeam-logo-white.zip'; ?>">Logo in White</a>
				</div>
			</div>
		</div>
</div>
