<?php
/**
 * The template for displaying eyebeamstaff posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package eyebeam2018
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="column column-7 site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'single' ); ?>

		<?php endwhile; // End of the loop. ?>

		<div class="content-staff-board">
		<?php
				$eyebeam_staff = get_fields();
				$image = get_field('staff_image');
				$staff_name = $eyebeam_staff['staff_name'];
				$staff_title = $eyebeam_staff['staff_title'];
				$staff_bio = $eyebeam_staff['staff_bio'];
			
	
				if($staff_name) : ?>
					<?= $staff_name; ?>
				<?php endif; 


				if($staff_title) : ?>
				<p>
					<?= $staff_title; ?>
				</p>

				<?php endif; 	
				
			
				if(!empty($image)) : ?>
				<p>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="280px" height="256px" />
				</p>
				<?php endif; 


				if($staff_bio) : ?>
				<div class="paragraph-indent">
					<?= $staff_bio; ?>
				</div>
				<?php endif; ?>
			
		<?php wp_reset_postdata(); ?>
		</div>


	</main><!-- #main -->
	</div><!-- #primary -->

<aside class="sidebar">
<?php get_sidebar(); ?>
</aside>

<?php get_footer(); ?>
