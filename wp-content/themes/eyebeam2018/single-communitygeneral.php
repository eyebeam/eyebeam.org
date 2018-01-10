<?php
/**
 * The template for displaying communitygeneral posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package eyebeam2018
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<!-- Hero Image for Community General Single Posts -->
		<?php $image = get_field('hero_image'); 
			if(!empty($image)) : ?>
				<div class="heroImageWrapper">
					<img class="heroImage"  src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="100%" height="100%"/>
				</div>
			<?php endif; ?>

		<!-- Main Navigation Bar -->
		<?php include_once('inc/nav.inc.php'); ?>
		<!-- End Main Navigation Bar -->	

		<!-- Main Content -->
		<main id="main" class="column column-7 site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('single'); ?>
			<?php endwhile; // End of the loop. ?>
			
			<div class="content-about">
				<?php
					$programs = get_fields();
					$image = get_field('image');
					$name = $programs["program_name"];
					$info = $programs["info"];
					$related_names = $programs["related_name"];
				
					if($name) : ?>
						<div class="blog-post-title">
							<?= $name; ?>
						</div>
					<?php endif; ?>

					<div class="content-about">
						<?php 	
							if(!empty($image)) : ?>
								<p> <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="100%" height="100%" /> </p>
							<?php endif; 
					
							if($info) : ?>
								<?= $info; ?> 
							<?php endif; ?>	
					</div>	
			</div>

			<?php wp_reset_postdata(); ?>		
		</main><!-- #main -->
	</div><!-- #primary -->

<aside class="sidebar">
	<?php if( $related_names ): ?>
		<ul>
			<?php foreach( $related_names as $related_name ): ?>
				<li>
				 	<a href="<?php echo get_permalink( $related_name->ID ); ?>"> <?php echo get_the_title( $related_name->ID ); ?> </a>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	<?php get_sidebar(); ?>
</aside>

<?php get_footer(); ?>
