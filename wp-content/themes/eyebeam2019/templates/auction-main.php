<div class="module-container">
<ul>
<li id="module-auction" class="module module-one_third">
	<div class="item-container">
		<h2 class="module-title one_half eyebeam-sans auction-title"><?php the_title(); ?></h2>
		<div class="auction-description">
			<?php the_content(); ?>
		</div>
	</div>
</li>
<li class="module module-two_thirds">
	<?php

	$artwork_query = new WP_Query(array(
		'post_type' => 'auction',
		'posts_per_page' => -1
	));

	while ($artwork_query->have_posts()) {
		$artwork_query->the_post();
		get_template_part('templates/auction-artwork');
	}

	wp_reset_postdata();

	?>
</li>
</ul>
</div>
