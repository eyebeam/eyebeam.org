<?php
/**
 * Template Name: Resident Information Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eyebeam2016
 */
get_header(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
	<div id="primary" class="content-area residencyContent">
		<main id="main" class="site-main" role="main">

			<div class="residencyContentSection">
				<?php $videoEmbed = get_field('youtube_embed_link'); if ( !empty( $videoEmbed ) ): ?>
					<div class="youtubeEmbed">
						<div class="youtubeWrapp">
							<?php echo $videoEmbed; ?>
						</div>
					</div>
				<?php $img = get_field('video_alternative'); elseif( !empty( $img ) ): ?>
					<img class="alternateImage"  src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" />
				<?php endif; ?>
				<div class="residencyBlurb">
					<?php if ( !empty( get_field('apply_link_url') ) ): ?>
							<a class="applyNowButton" href="<?php the_field('apply_link_url'); ?>">Apply Now</a>
					<?php endif; ?>
					<div class="applyInfoBlurb">
						<?php the_field('apply_info_blurb'); ?>
					</div>
				</div>
			</div>

			<?php $img = get_field('residency_image_1');
			$blurb = get_field('residency_blurb_1');
			if( !empty( $blurb ) ): ?>
				<div class="rowSpacerLine"></div>
				<div class="residencyContentSection">
					<?php if ( !empty( $img ) ): ?>
						<img class="residencyBlurbPhoto"  src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" width="100%" height="100%"/>
					<?php endif; ?>
					<div class="residencyBlurb">
						<?php echo $blurb; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php $img = get_field('residency_image_2');
			$blurb = get_field('residency_blurb_2');
			if( !empty( $blurb ) ): ?>
				<div class="rowSpacerLine"></div>
				<div class="residencyContentSection">
					<?php if ( !empty( $img ) ): ?>
						<img class="residencyBlurbPhoto"  src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" width="100%" height="100%"/>
					<?php endif; ?>
					<div class="residencyBlurb">
						<?php echo $blurb; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php $img = get_field('residency_image_3');
			$blurb = get_field('residency_blurb_3');
			if( !empty( $blurb ) ): ?>
				<div class="rowSpacerLine"></div>
				<div class="residencyContentSection">
					<?php if ( !empty( $img ) ): ?>
						<img class="residencyBlurbPhoto"  src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" width="100%" height="100%"/>
					<?php endif; ?>
					<div class="residencyBlurb">
						<?php echo $blurb; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php $img = get_field('residency_image_4');
			$blurb = get_field('residency_blurb_4');
			if( !empty( $blurb ) ): ?>
				<div class="rowSpacerLine"></div>
				<div class="residencyContentSection">
					<?php if ( !empty( $img ) ): ?>
						<img class="residencyBlurbPhoto"  src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" width="100%" height="100%"/>
					<?php endif; ?>
					<div class="residencyBlurb">
						<?php echo $blurb; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php $img = get_field('residency_image_5');
			$blurb = get_field('residency_blurb_5');
			if( !empty( $blurb ) ): ?>
				<div class="rowSpacerLine"></div>
				<div class="residencyContentSection">
					<?php if ( !empty( $img ) ): ?>
						<img class="residencyBlurbPhoto"  src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" width="100%" height="100%"/>
					<?php endif; ?>
					<div class="residencyBlurb">
						<?php echo $blurb; ?>
					</div>
				</div>
			<?php endif; ?>



		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>