<?php
/**
 * The template for displaying staffboard posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package eyebeam2016
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part('single' ); ?>
		<?php endwhile; // End of the loop. ?>
				
			<?php
				$staffboard = get_fields();
				$name = $staffboardboard['staff_name'];
				$title = $staffboard['staff_title'];
				$image = get_field('staff_image');
				$bio = $staffboard['staff_bio'];

				if($name) : ?>
				<p>
					<?= $name; ?>
				</p>

				<?php endif; 	
				
				if($title) : ?>
				<p>
					<?= $title; ?>
				</p>
				<?php endif; 

				
				if(!empty($image)) : ?>
				<p>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				</p>
				<?php endif; 


				if($bio) : ?>
				<p>
					<?= $bio; ?>
				</p>
				<?php endif; 			
			?>

			<?php wp_reset_postdata(); ?>
	

	</main><!-- #main -->
	</div><!-- #primary -->

<aside>
<?php get_sidebar(); ?>
</aside>

<?php get_footer(); ?>
