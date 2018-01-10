<?php
/**
 * Template Name: Community Youth Archives
 * The template for displaying program archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eyebeam2018
 */

get_header(); ?>

<div id="primary" class="content-area">
	<!-- Community Youth Hero Image -->

		<?php
		$image = get_field('hero_image');
		$headTitle = get_field('hero_title_text');
		$headDescription = get_field('hero_title_blurb');
		if(!empty($image)) : ?>
			<div class="heroImageWrapper">
				<img class="heroImage"  src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="100%" height="100%"/>
			</div>
		<?php endif; ?>
	<?php if(!empty($headTitle)) : ?>
		<div class="pushingDiv">
			<div class="heroText">
				<h2 class="heroTitle"><?php echo $headTitle; ?></h2>
				<?php if(!empty($headDescription)) : ?>
					<span class="heroTitle"><?php echo $headDescription; ?></span>
				<?php endif;?>
			</div>
		</div>
	<?php endif;?>

	<!-- Main Content -->
	<main id="main" class=" site-main" role="main">

		<div class="content-stopwork-info content-about">
			<?php if ( have_posts() ) : ?>
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					*/
					get_template_part('template-parts/content', 'communityyouth'); ?>
				<?php endwhile; ?>
		</div>

			<?php
				$archive_args = array(
				'post_type' => 'communityyouth',
				'posts_per_page' => -1
				);

				$programs = new WP_Query($archive_args);
				if($programs->have_posts()): ?>
					<div id="comYouthPrograms">

						<?php while($programs->have_posts()) : $programs->the_post(); ?>

							<!-- web layout -->
							<div class="comYouthProgram">
								<?php $image = get_field('image_youth');?>
									<img src= "<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="100%" height="100%"/><!--
								--><div class="info">
										<!-- div class="expandableRead overflowHidden" -->
											<h2> <?php echo the_field('program_name_youth'); ?> </h2>

											<?php echo eyebeam2018_get_first_youth_paragraph(); ?>
					</div>
										<!-- <button onclick="(function(e){ e.target.parentNode.getElementsByClassName('expandableRead')[0].classList.remove('overflowHidden'); e.target.style.display = 'none'; })(event);"> Read More </button> -->
									</div>
							</div>

						<?php endwhile; ?>
					</div>
				<?php endif;
				wp_reset_query();
				wp_reset_postdata(); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
