<?php
/**
 * The template for displaying internships posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

		

		<main id="main" class="column column-7 site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
		<?php the_title( '<h3>', '</h3>' ); ?>
		<div class="content-jobs">
			<?php
				$internships = get_fields();
				$internship_description = $internships['internship'];

				if($internship_description) : ?>
				<p>
					<?= $internship_description; ?>
				</p>

				<?php endif; ?>
			<?php get_template_part(); ?>
				
		<?php endwhile; // End of the loop. ?>
			
			</div>


		</main><!-- #main -->
	</div><!-- #primary -->

<aside class="sidebar">
<?php get_sidebar(); ?>
</aside>

<?php get_footer(); ?>
