<?php
/**
 * The template for displaying work posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package eyebeam2016
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<!-- Hero Image for Work Page -->
		<?php $image = get_field('hero_image'); 
			if(!empty($image)) : ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="100%" height="100%"/>
		<?php endif; ?>

		<!-- Main Navigation Bar -->
		<?php include_once('inc/nav.inc.php'); ?>

		<!-- Main Content -->
		<main id="main" class="column column-7 site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('single'); ?>		
			<?php endwhile; // End of the loop. ?>
			
			<div class="content-jobs">
				<?php
					$work = get_fields();
					$job_description = $work['job_description'];

				if($job_description) : ?>
					<?= $job_description; ?>
				<?php endif; ?>
			
				<?php the_post_navigation(); ?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<aside class="sidebar"><?php get_sidebar(); ?></aside>

<?php get_footer(); ?>
