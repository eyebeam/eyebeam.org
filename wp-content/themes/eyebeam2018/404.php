<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package eyebeam2018
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<!-- Hero Image -->
		<img src="/wp-content/uploads/2016/01/Office-e1459985690476.jpg" width="1920px" height="1080px"/>

		<!-- Main Navigation Bar -->
		<?php include_once('inc/nav.inc.php'); ?>
		<!-- End Main Navigation Bar -->

		<main id="main" class="column column-7 site-main search-content" role="main">
			<section class="error-404 not-found">
				<header class="error-header">
					<img src="/wp-content/uploads/2016/04/404.gif" width="60%" height="60%"/>
				</header><!-- .page-header -->
			</section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
