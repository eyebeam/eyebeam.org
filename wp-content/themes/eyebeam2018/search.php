<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package eyebeam2018
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<!-- Hero Image -->
		<img src="http://eyebeam.org/wp-content/uploads/2016/01/Office-e1459985690476.jpg" width="1920px" height="1080px"/>

		<!-- Main Navigation Bar -->
		<?php include_once('inc/nav.inc.php'); ?>
		<!-- End Main Navigation Bar -->

			<header class="page-header">
				<h1 class="search-title"><?php printf( esc_html__( 'Search Results for: %s', 'eyebeam2018' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

		<!-- Main Content -->
		<main id="main" class="column column-7 site-main search-content" role="main">

		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
	
				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>
		
			<?php get_template_part( 'template-parts/content', 'none' ); ?>


		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<aside><?php get_sidebar(); ?></aside>

<?php get_footer(); ?>
