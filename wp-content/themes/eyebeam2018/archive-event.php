<?php
/**
 * Template Name: Events Archives
 * The template for displaying calendar archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eyebeam2018
 */
get_header(); ?>

<div id="primary" class="content-area">
	<!-- Calendar Page Hero Image -->

		<?php
		$image = get_field('hero_image');
		$headTitle = get_field('hero_title_text');
		$headDescription = get_field('hero_title_blurb');
		if(!empty($image)) : ?>
			<div class="heroImageWrapper">
				<img class="heroImage"  src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="100%" height="100%"/>
			</div>
		<?php endif; ?>
	<?php if(!empty($headTitle)) : ?>
		<div class="pushingDiv">
			<div class="heroText">
				<h2 class="heroTitle"><?php echo $headTitle; ?></h2>
				<?php if(!empty($headDescription)) : ?>
					<span class="heroTitle"><?php echo $headDescription; ?></span>
				<?php endif;?>
			</div>
		</div>
	<?php endif;?>


	<!-- Main Content -->
	<main id="main" class="site-main" role="main">

		<?php

		// Modified this to have two different queries. Upcoming events are
		// forward-chronological, as in the soonest first. Past events are
		// reverse-chron, so that the most recent events come first.

		// For now we are going to hard-code the limit at 6 instead of showing
		// *all* the events that have ever been. We will need pagination here
		// at some point, but we gotta start somewhere. (20180118/dphiffer)

		$now = new DateTime;
		$todays_date_formatted = $now->format('Ymd');

		$upcoming_args = array(
			'post_type' => 'event',
			'posts_per_page' => 20, // arbitrary hard limit on upcoming events
			'orderby'=> 'meta_value',
			'meta_key' => 'end_date',
			'order' => 'ASC',
		);

		$past_args = array(
			'post_type' => 'event',
			'posts_per_page' => 6,
			'orderby'=> 'meta_value',
			'meta_key' => 'end_date',
			'order' => 'DESC',
		);

		$events = new WP_Query($upcoming_args);

		if($events->have_posts()):
			$i = 1;?>
			<div class="events">
				<h2>Upcoming</h2>
				<div class="upcomingEvents">
					<?php while($events->have_posts()) : $events->the_post();
						if( get_field('end_date') >= $todays_date_formatted ):
							$image = get_field('image');
							$thisDate = new DateTime( get_field('end_date')); ?>

								<a class="event" href="<?php echo get_permalink() ?>">
									<div class="eventImage" style= "background-image:url('<?php echo $image['url']; ?>')" alt="<?php echo $image['alt']; ?>"></div>
									<span class="title"><?php echo get_field('title'); ?></span>
									<span class="end_date"><?php echo $thisDate->format('F j, Y'); ?></span>
								</a>
								<?php if( $i % 3 == 0): ?>
									<div class="rowSpacerLine"></div>
								<?php endif; ?>

								<?php $i++; ?>
							<?php endif; ?>
						<?php endwhile; ?>
					</div>
					<?php

					$events = new WP_Query($past_args);

					if($i-1 % 3 != 0 && $i > 1): ?>
						<div class="rowSpacerLine"></div>
					<?php endif; $i = 1; ?>
					<h2>Past Events</h2>
					<div class="pastEvents">
						<?php while($events->have_posts()) : $events->the_post();
							if( get_field('end_date') < $todays_date_formatted ): ?>

								<?php $image = get_field('image');
								$thisDate = new DateTime(get_field('end_date')); ?>
								<a class="event" href="<?php echo get_permalink() ?>">
									<div class="eventImage" style= "background-image:url('<?php echo $image['url']; ?>')" alt="<?php echo $image['alt']; ?>"></div>
									<span class="title"><?php echo get_field('title'); ?></span>
									<span class="end_date"><?php echo $thisDate->format('F j, Y'); ?></span>
								</a>
								<?php if( $i % 3 == 0): ?>
									<div class="rowSpacerLine"></div>
								<?php endif; ?>

								<?php $i++; ?>
							<?php endif;
						endwhile; ?>
					</div>
				</div>
			<?php endif; ?>

		<?php wp_reset_query(); ?>

		<?php wp_reset_postdata(); ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
