<?php
/**
 * Template Name: Internships Archives
 * The template for displaying eyebeam blog archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eyebeam2016
 */
get_header(); ?>

<div id="primary" class="content-area">
	<?php $image = get_field('hero_image'); 
		if(!empty($image)) : ?>
			<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="100%" height="100%"/>
		<?php endif; ?>

		<?php include_once('inc/nav.inc.php'); ?>
		
	<main id="main" class="column column-7 site-main" role="main">
		<div class="page-title">Internships</div>

			<?php if ( have_posts() ) : ?>
				<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
					<h3 id="post-<?php the_ID(); ?>">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<?php endwhile; ?>
			
				<div class="content-blog">	
					<?php
						$archive_args = array(
						'post_type' => 'internships',
						'posts_per_page' => -1 
						);

						$internships = new WP_Query($archive_args);
						if($internships->have_posts()){
							while($internships->have_posts()){
								$internships->the_post();

					    		if($internships) : ?>
					    			<?php the_field('internship'); ?> 
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