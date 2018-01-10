<?php
/**
 * Template Name: Staff and Board Archive
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eyebeam2018
 */

get_header(); ?>

<div id="primary" class="content-area">
	<!-- Staff Page Hero Image -->
	<div class="mobile-hero">
		<?php $image = get_field('hero_image');
			if(!empty($image)) : ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="100%" height="100%"/>
			<?php endif; ?>
	</div>

		<!-- Main Navigation Bar -->
		<?php include_once('inc/nav.inc.php'); ?>
		<!-- End Main Navigation Bar -->

		<!-- Main Staff Content -->
		<main id="main" class="column column-11 site-main" role="main">
			<div class="page-title">About</div>

			<div class="current toggle">
				<a <?php if (strpos($_SERVER['REQUEST_URI'], 'about') > 0) print 'class="current"'; ?> href="about">History and Mission</a> / <a <?php if (strpos($_SERVER['REQUEST_URI'], 'staff-and-board') > 0) print 'class="current"'; ?> href="staff-and-board">Staff and Board</a>
			</div>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('eyebeamstaff', 'eyebeamboard'); ?>
			<?php endwhile; // End of the loop. ?>

			<?php
				$archive_args = array(
				'post_type' => 'staff',
				'posts_per_page' => -1
				);

				$eyebeam_staff = new WP_Query($archive_args);
				if($eyebeam_staff->have_posts()){
					$i = 0;
					while($eyebeam_staff->have_posts()) : $eyebeam_staff ->the_post();
					// create 3 columns
 					// output an open <div>
					if($i % 2 == 0) { ?>
						<div class="row">
					<?php
						}
					?>

			   <!-- Web Layout -->
				<div class="column column-4 content-staff-board">
					<?php
						$image = get_field('staff_image');

						if($eyebeam_staff) : ?>
							<div class="staff-name">
								<?php the_field('staff_name'); ?> </br>
							</div>
			    		<?php endif;

			    		if($eyebeam_staff) : ?>
							<?php the_field('staff_title'); ?>
						<?php endif;

						if(!empty($image)) : ?>
							<p> <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="140px" height="128px"/> </p>
						<?php endif;

						if($eyebeam_staff) : ?>
							<div class="content-staff-bio paragraph-indent">
								<?php the_field('staff_bio'); ?>
			    			</div>
						<?php endif; ?>
				</div>

				<!-- Mobile Layout -->
				<div id="mobile-staff-image">
					<?php
						$image = get_field('staff_image');

						if(!empty($image)) : ?>
							<p> <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="140px" height="128px"/> </p>
					<?php endif;?>
				</div>

				<div id="mobile-staff-board">
					<?php
						if($eyebeam_staff) : ?>
							<h4> <?php the_field('staff_name'); ?> </h4>
			    		<?php endif;

			    		if($eyebeam_staff) : ?>
							<?php the_field('staff_title'); ?>
						<?php endif;


						if($eyebeam_staff) : ?>
							<?php the_field('staff_bio'); ?>
						<?php endif; ?>
				</div>

				<?php
					$i++;
					if($i != 0 && $i % 2 == 0){ ?>
						</div> <!--/.row-->
					<div class="clearfix"> </div>

				<?php
				} ?>

				<?php
					endwhile;
				}

			wp_reset_query();
			?>

			<!-- Board Members Content -->
		 	<!--<div class="column-1 page-staff-title">Board</div>-->

			<?php
				$archive_args = array(
				'post_type' => 'board',
				'posts_per_page' => -1
				);

				$eyebeam_board = new WP_Query($archive_args);
				if($eyebeam_board->have_posts()){
					$i = 0;
					while($eyebeam_board->have_posts()) : $eyebeam_board ->the_post();
					// create 3 columns
 					// output an open <div>
					if($i % 2 == 0) { ?>
						<div class="row">
					<?php
						}
					?>
				<!-- Web Layout -->
				<div class="column column-4 content-staff-board">
					<?php
						if($eyebeam_board) : ?>
							<?php the_field('board_members'); ?>
						<?php endif; ?>
				</div>

				<!-- Mobile Layout -->
				<div id="mobile-staff-board">
					<?php
						if($eyebeam_board) : ?>
							<?php the_field('board_members'); ?>
						<?php endif; ?>
				</div>

				<?php
					$i++;
					if($i != 0 && $i % 2 == 0){ ?>
						</div> <!--/.row-->
					<div class="clearfix"> </div>
				<?php
					} ?>
				<?php
					endwhile;
				}

			wp_reset_query();
			?>
			<?php wp_reset_postdata(); ?>
		</main>
	</div><!-- #primary -->

<aside class="sidebar"> <?php get_sidebar(); ?> </aside>

<?php get_footer(); ?>
