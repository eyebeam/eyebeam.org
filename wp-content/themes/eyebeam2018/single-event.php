<?php
/**
 * The template for displaying event posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package eyebeam2018
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<!-- Main Content -->
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'single' ); ?>
			<?php endwhile; // End of the loop. ?>

			<div class="content-event-post">
				<?php
					$event = get_fields();
					$image = get_field('image');
					$date_text = eyebeam2018_get_event_date(get_the_ID());
					$title = $event['title'];
					$subtitle = $event['subtitle'];
					$location = $event['location'];
					$event_type = $event['event_type'];
					$info = $event['event_info'];
					$related_names = $event['related_name']; ?>

					<div class="eventLeftCol">

						<?php if(!empty($image)) : ?>
							<img class="mobile-event-image" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="100%" height="100%"/>
						<?php endif; ?>

						<?php if($title) : ?>
							<h2 class="event-post-title"> <?= $title; ?></h2>
						<?php endif; ?>
				    <?php if($date_text): ?>
				    	<span><?php echo $date_text; ?></span>
				    <?php endif; ?>
						<?php if($location) : ?>
							<span><?php echo 'At '.$location; ?></span>
						<?php endif; ?>
						 <div class="community-content">
							<div class="event-line-height">
								<?php if($info) : ?>
									<?php echo $info; ?>
								<?php endif; ?>
							</div>
						</div>
					</div><!--
					--><div class="eventRightCol">
						<?php if(!empty($image)) : ?>
							<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="100%" height="100%"/>
						<?php endif; ?>
					</div>
				<?php wp_reset_postdata(); ?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>
