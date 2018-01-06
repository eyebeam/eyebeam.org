<?php
/**
 * Template Name: Press Page
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

		<!-- Main Navigation Bar -->
		<?php include_once('inc/nav.inc.php'); ?>
		
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