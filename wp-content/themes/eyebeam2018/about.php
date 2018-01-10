<?php
/**
 * Template Name: About Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eyebeam2018
 */

get_header(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php bloginfo('description'); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

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

	<div class="aboutContent">
		<main id="main" class="site-main" role="main">

			<div class="aboutContentSection">
				<?php if ( !empty( get_field('history_blurb') ) ): ?>
					<div class="aboutBlurb left">
						<?php echo the_field('history_blurb'); ?>
					</div>
				<?php endif; ?>
				<?php $img = get_field('history_photo'); if ( !empty( $img ) ): ?>
					<img class="aboutBlurbPhoto"  src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" width="100%" height="100%"/>
				<?php endif; ?>
			</div>


			<div class="rowSpacerLine"></div>


			<div class="aboutContentSection">
				<?php if ( !empty( get_field('contact_blurb') ) ): ?>
					<div class="aboutBlurb right">
						<?php the_field('contact_blurb'); ?>
					</div>
				<?php endif; ?>
				<?php $img = get_field('contact_photo'); if ( !empty( $img ) ): ?>
					<img class="aboutBlurbPhoto"  src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" width="100%" height="100%"/>
				<?php endif; ?>
			</div>


			<div class="rowSpacerLine"></div>


			<?php
				$archive_args = array(
				'post_type' => 'staff',
				'posts_per_page' => -1,
				'orderby'=> 'date',
				);
			$ideas = new WP_Query($archive_args);
			?>

			<h2>Staff Profiles</h2>
			<div class="eyebeamStaff">
				<?php echo '<!--' ?>
				<?php while ($ideas->have_posts()) : $ideas->the_post(); ?>
					<?php $post_fields = get_fields();
				 	$image = get_field('staff_image');?>

				 		<?php echo '-->' ?><div class="eyebeamStaffMember">
				 			<span class="staffName"><?= the_field('staff_name'); ?></span>
				 			<span class="staffPosition"><?= the_field('staff_title'); ?></span>
							<?php if(!empty($image)) : ?>
								<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
							<?php endif; ?>
				 			<span class="bio"><?= the_field('staff_bio'); ?></span>
				 		</div><div class="rowSpacerLine"></div><?php echo '<!--' ?>


				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
				<?php echo ' -->' ?>
			</div>
			<div class="rowSpacerLine"></div>


			<div class="aboutContentSection"><?php echo '<!--' ?>
				<?php if ( !empty( get_field('board_list') ) ): ?>
					<?php echo ' -->' ?><div class="associateList board">
						<?php the_field('board_list'); ?>
					</div><?php echo '<!--' ?>
				<?php endif; ?>
				<?php if ( !empty( get_field('advisory_board_list') ) ): ?>
					<?php echo ' -->' ?><div class="associateList advisoryBoard">
						<?php the_field('advisory_board_list'); ?>
					</div><?php echo '<!--' ?>
				<?php endif; ?>
				<?php if ( !empty( get_field('interns_list') ) ): ?>
					<?php echo ' -->' ?><div class="associateList interns">
						<?php the_field('interns_list'); ?>
					</div><?php echo '<!--' ?>
				<?php endif; ?>
			<?php echo ' -->' ?></div>



			<?php wp_reset_postdata(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
