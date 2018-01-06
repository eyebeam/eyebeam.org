<?php
/**
 * Template Name: Landing Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eyebeam2016
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<link rel="image_src"
        href="/fish-animation/img/school-of-fish.png"/>
        
<link rel="stylesheet" href="/fish-animation/css/style.css">

<script src="/fish-animation/js/libs/modernizr-2.0.6.min.js"></script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'eyebeam2016' ); ?></a>

	<div id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<div class="eyebeam-logo">
				 <a href="http://eyebeam.org/wordpress/about/">
				<img src="/img/logo_eyebeam_beta.png" width="336" height="61" />
				 </a>	
				<p id="tap">Menu</p>
				<!--<p id="tap">Tap for Menu</p> -->
			</div>
			<div class="donate">
				<a href="https://eyebeam.secure.force.com/donate/?dfId=a0n610000068vhRAAQ">Donate to Eyebeam</a>
			</div>
		</div>
	</div><!-- #masthead -->

	<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'page' );?>	
			<?php endwhile; // End of the loop. ?>

			<?php
				$landingpage = get_fields();
				$image = get_field('hero_image');
				$information_chip = get_field('information_chip');

          		//--- Website --->
				if($information_chip) : ?>
				 <div class="information-chip-landing"> 
					<?= $information_chip; ?>	
				</div>
            
				<?php endif; 
				if(!empty($image)) : ?>
				<p> <div class="image-landing"> 		
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="100%" height="100%" />
				</p> </div>

				 <!-- Mobile -->
				 <div id="mobile-information-chip">
					<?php if($information_chip) : ?>
						<?php echo the_field('information_chip'); ?>
			   		<?php endif;?>
				</div> <!--End Mobile -->
					
				<?php endif; ?>

			<?php wp_reset_postdata(); ?>

		<?php include_once('inc/nav.inc.php'); ?>
			
	</main><!-- #main -->
	</div><!-- #primary -->

