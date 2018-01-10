<?php
/**
 * Template Name: Media Release Archives
 * The template for displaying program archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eyebeam2018
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<!-- Press Page Hero Image -->
		<div class="mobile-hero">
			<?php $image = get_field('hero_image');
				if(!empty($image)) : ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="100%" height="100%"/>
				<?php endif; ?>
		</div>

		<!-- Main Navigation Bar -->
		<?php include_once('inc/nav.inc.php'); ?>
		<!-- End Main Navigation Bar -->

		<!-- Main Content -->
		<main id="main" class="column column-7 site-main" role="main">
			<div class="page-title">Media Release</div>

		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part('mediarelease'); ?>
			<?php endwhile; ?>

			<?php
				$archive_args = array(
					'post_type' => 'mediarelease',
					'posts_per_page' => -1
					);

				$media_release = new WP_Query($archive_args);
				if($media_release->have_posts()){
					$i = 0;
					while($media_release->have_posts()) : $media_release->the_post();
						// create 3 columns
	 					// output an open <div>
						if($i % 2 == 0) { ?>
							<div class="row">
					<?php
					}
					?>

				<!-- Web Layout -->
				<div class="column column-4 content-media-release">
					<?php
						$media = get_fields();
						$image = get_field('image');
						$date = $media['date'];

						if($media_release) : ?>
							<h3><?php echo the_field('title'); ?></h3>
						<?php endif;

						// Create a PHP date object based on a specific "date" format
						$date_start = DateTime::createFromFormat('Ymd', $date);

						// Create a date string of the "{{Name of the month}} {{date of month}}, {{year}}"
						if($date_start) :
							$date_format = $date_start->format('F j, Y');

						if($date_format) : ?>
							<?= $date_format; ?></br>
						<?php endif;

						endif;

					if(!empty($image)) : ?>
						<p><img src= "<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="100%" height="100%"/></p>
					<?php endif; ?>
				</div>

				<!-- Mobile Layout -->
				<div id="mobile-media-image">
					<?php
						$media = get_fields();
						$image = get_field('image');
						$date = $media['date'];

						if(!empty($image)) : ?>
							<p><img src= "<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="100%" height="100%"/></p>
						<?php endif; ?>
				</div>

				<div id="mobile-media-release">
					<?php
						if($media_release) : ?>
							<h3><?php echo the_field('title'); ?></h3>
						<?php endif;

						// Create a PHP date object based on a specific "date" format
						$date_start = DateTime::createFromFormat('Ymd', $date);

						if($date_start) :
						// Create a date string of the "{{Name of the month}} {{date of month}}, {{year}}"
						$date_format = $date_start->format('F j, Y');

						if($date_format) : ?>
							<p><?= $date_format; ?></p>
						<?php endif;
						endif; ?>
				</div>

				<!-- Grid For Loop -->
				<?php $i++;
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

<aside class="sidebar"><?php get_sidebar(); ?></aside>

<?php get_footer(); ?>
