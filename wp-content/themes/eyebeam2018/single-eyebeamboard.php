<?php
/**
 * The template for displaying eyebeamboard posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package eyebeam2018
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="column column-7 site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'single' ); ?>

		<?php endwhile; // End of the loop. ?>

		<div class="content-staff-board">
		<?php
				$eyebeam_board = get_fields();
				$board_members = $eyebeam_board['board_members'];

				if($board_members) : ?>
					<p> <?= $board_members; ?> </p>
			    <?php endif; ?>
			
		<?php wp_reset_postdata(); ?>
		</div>


	</main><!-- #main -->
	</div><!-- #primary -->

<aside class="sidebar">
<?php get_sidebar(); ?>
</aside>

<?php get_footer(); ?>
