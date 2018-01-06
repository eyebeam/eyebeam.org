<?php
/**
 * Template Name: Facts Page
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

	<div id="primary" class="content-area">


		<!-- Facts Page Hero Image -->
		<?php 
		$image = get_field('hero_image');
		$headTitle = get_field('hero_title_text');
		$headDescription = get_field('hero_title_blurb');
		if(!empty($image)) : ?>
			<div class="heroImageWrapper">
				<img class="heroImage"  src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="100%" height="100%"/>
			</div>
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
		<?php endif; ?>

		<!-- Main Content -->
		<main id="main" class="column column-7 site-main" role="main">
			<div class="page-title"><?php the_title(); ?></div>
			<div class="content-about">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content', 'page' ); ?>
				<?php endwhile; // End of the loop. ?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<aside class="sidebar"><?php get_sidebar(); ?></aside>

<?php get_footer(); ?>
