<?php
/**
 * Template Name: Work Archives
 * The template for displaying eyebeam blog archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eyebeam2018
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
		<div class="page-title">Work</div>

			<?php if ( have_posts() ) : ?>
				<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part('work'); ?>		
					<?php endwhile; ?>
			
				<div class="content-about">	
					<?php
						$archive_args = array(
						'post_type' => 'work',
						'posts_per_page' => -1 
						);

						$work = new WP_Query($archive_args);
						if($work->have_posts()){
							while($work->have_posts()){
								$work->the_post();

					    		if($work) : ?>
					    			<?php the_field('job_description'); ?> 
					    		<?php endif;
							}
						}
					?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</div>	
	</main><!-- #main -->
</div><!-- #primary -->

<aside class="sidebar"><?php get_sidebar(); ?></aside>

<?php get_footer(); ?>