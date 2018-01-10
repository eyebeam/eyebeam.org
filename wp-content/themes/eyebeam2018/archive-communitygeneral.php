<?php
/**
 * Template Name: Community General Archives
 * The template for displaying program archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eyebeam2018
 */

get_header(); ?>

<div id="primary" class="content-area">
	<!-- Community General Hero Image -->
	<div class="img-container">
	<?php $image = get_field('hero_image');
		if(!empty($image)) : ?>
			<img class="site-hero-image" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="100%" height="100%"/>
	<?php endif; ?>
	</div>

	<!-- Main Navigation Bar -->
	<?php include_once('inc/nav.inc.php'); ?>
	<!-- End Main Navigation Bar -->

	<!-- Main Content -->
	<main id="main" class="column column-7 site-main" role="main">
		<div class="page-title">Community</div>

		<div class="current toggle">
			<a <?php if (strpos($_SERVER['REQUEST_URI'], 'community-general') > 0) print 'class="current"'; ?> href="community-general">General</a> / <a <?php if (strpos($_SERVER['REQUEST_URI'], 'community-youth') > 0) print 'class="current"'; ?> href="community-youth">Youth</a>
		</div>

		<div class="content-stopwork-info content-about">
		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				*/
				get_template_part( 'template-parts/content', 'communitygeneral'); ?>
			<?php endwhile; ?>
		</div>

		<?php
			$archive_args = array(
			'post_type' => 'communitygeneral',
			'posts_per_page' => -1
			);

			$programs = new WP_Query($archive_args);
			if($programs->have_posts()){
				$i = 0;
				while($programs->have_posts()) : $programs->the_post();
				// create 3 columns
				// output an open <div>
				if($i % 2 == 0) { ?>
					<div class="row">
				<?php
					}
				?>

				<!-- web layout -->
				<div class="column column-4 content-event">
					<?php
						$image = get_field('image');

						if($programs) : ?>
							<div class="bold-title"> <a href="<?php the_permalink(); ?>"> <?php echo the_field('program_name'); ?> </a> </div>
						<?php endif;

						if(!empty($image)) : ?>
							<p>	<a href="<?php the_permalink(); ?>"> <img src= "<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="100%" height="100%"/> </a> </p>
						<?php endif; ?>
				</div>

				<!-- mobile layout -->
				<div id="mobile-program-image">
					<?php if(!empty($image)) : ?>
							<p>	<a href="<?php the_permalink(); ?>"> <img src= "<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="100%" height="100%"/> </a> </p>
					<?php endif; ?>
				</div>

				<div id="mobile-program-name">
					<?php if($programs) : ?>
						<h3><a href="<?php the_permalink(); ?>"><?php echo the_field('program_name'); ?></h3></a>
					<?php endif; ?>
				</div>

			<!-- for loop for grid -->
			<?php
				$i++;
				if($i != 0 && $i % 2 == 0){ ?>
				</div> <!--/.row-->
				<div class="clearfix"> </div>
				<?php
				} ?>

			<?php endwhile;
				}

			wp_reset_query(); ?>

			<?php wp_reset_postdata(); ?>

			<?php endif; ?>
	</main><!-- #main -->
</div><!-- #primary -->

<aside class="sidebar"> <?php get_sidebar(); ?> </aside>

<?php get_footer(); ?>
