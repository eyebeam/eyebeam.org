<?php
/**
 * The template for displaying event posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package eyebeam2016
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="column column-7 site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'single' ); ?>

			<?php endwhile; // End of the loop. ?>


			<div class="content-event-post">	
			<?php
				$media_release = get_fields();
				$image = get_field('image');
				//var_dump($event);
				$title = $media_release['title'];
				$place = $media_release['place'];
				$date = $media_release['date'];
				
				if($title) : ?>			
					<?= $title; ?>
				<?php endif; 

				if($place) : ?>	
				<p>		
					<?= $place; ?>
				</p>
				<?php endif; 

				// Create a PHP date object based on a specific "date" format
				$date_start = DateTime::createFromFormat('Ymd', $date);

				// Create a date string of the "{{Name of the month}} {{date of month}}, {{year}}"
				$date_format = $date_start->format('F j, Y'); 

				if($date_format) : ?>
				<p>
					<?= $date_format; ?>
				</p>

				<?php endif; ?>


				<?php
				if(!empty($image)) : ?>
				<p>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="80%" height="80%"/>
				</p>
				<?php endif; ?>
				

		<?php wp_reset_postdata(); ?>
	</div>

	</main><!-- #main -->
	</div><!-- #primary -->

<aside class="sidebar">
<?php get_sidebar(); ?>
</aside>

<?php get_footer(); ?>
