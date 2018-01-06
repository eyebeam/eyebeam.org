<?php
/**
 * The template for displaying news posts.
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

		<div class="content-about paragraph-indent">
		<?php
				$news = get_fields();
				$image = get_field('image');
				$news= $news["news"];

				if($news) : ?>
				<p>
					<?= $news; ?>
				</p>

				<?php endif; 	
				
			
				if(!empty($image)) : ?>
				<p>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="30%" height="30%" />
				</p>
				<?php endif; ?>
			</div>
			
		<?php wp_reset_postdata(); ?>


	</main><!-- #main -->
	</div><!-- #primary -->

<aside class="sidebar">
<?php get_sidebar(); ?>
</aside>

<?php get_footer(); ?>
