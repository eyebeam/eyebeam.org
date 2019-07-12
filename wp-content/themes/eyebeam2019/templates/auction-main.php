<div class="module-container">
<ul>
<li id="module-auction" class="module module-one_third">
	<?php

	$view_all = is_single() ? '<a href="/auction/" class="auction-all">View all artworks</a>' : '';

	$auction_query = new WP_Query(array(
		'post_type' => 'page',
		'posts_per_page' => 1,
		'name' => 'auction'
	));

	$auction_query->the_post();

	?>
	<div class="item-container">
		<h2 class="module-title one_half eyebeam-sans auction-title">
			<a href="<?php the_permalink($post); ?>"><?php the_title(); ?></a>
		</h2>
		<?php

		echo $view_all;

		?>
		<div class="auction-description">
			<?php the_content(); ?>
		</div>
	</div>
	<?php wp_reset_query(); ?>
</li>
<li class="module module-two_thirds">
	<?php

	if (is_archive()) {
		query_posts(array(
			'post_type' => 'auction',
			'posts_per_page' => -1,
			'orderby' => 'menu_order',
			'order' => 'ASC'
		));
	}

	while (have_posts()) {
		the_post();
		get_template_part('templates/auction-artwork');
	}

	?>
</li>
</ul>
</div>
