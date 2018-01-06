<?php
/**
 * The template for displaying recentpress posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package eyebeam2016
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="column column-7 site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part('single' ); ?>
				
		<?php endwhile; // End of the loop. ?>
			
			<div class="content-program-post">
			<?php
				$recent_press = get_fields();
				$title = $recent_press['title'];
				$author = $recent_press['author'];
				$link = $recent_press['link'];
				$date = $recent_press['date'];
				// Create a PHP date object based on a specific "date" format
				$date_format = DateTime::createFromFormat('Ymd', $date);
				// Create a date string of the "{{Name of the month}} {{date of month}}, {{year}}"
				$pretty_date = $date_format->format('F j, Y'); 

				if($pretty_date) : ?>
				<p>
					<?= $pretty_date; ?>
				</p>

				<?php endif; 	


				if($title) : ?>
				<p>
					<?= $title; ?>
				</p>

				<?php endif; 	
					  if($author) : ?>
				<p>
					<?= $author; ?>
				</p>
				<?php endif; 
				

				if($link) : ?>
				<p>
					<?= $link; ?>
				</p>
				<?php endif; ?>
			</div>

			<?php the_post_navigation(); ?>



		</main><!-- #main -->
	</div><!-- #primary -->

<aside class="sidebar">
<?php get_sidebar(); ?>
</aside>

<?php get_footer(); ?>
