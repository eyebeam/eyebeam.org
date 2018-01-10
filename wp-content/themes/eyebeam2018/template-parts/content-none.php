<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eyebeam2018
 */

?>

<section class="no-results not-found">
	<header class="page-header">
	</header><!-- .page-header -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'eyebeam2018' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<div class="error-header">
				<img src="http://eyebeam.org/wp-content/uploads/2016/04/404.gif" width="60%" height="60%"/>
			</div>

		<?php else : ?>

			<div class="error-header">
				<img src="http://eyebeam.org/wp-content/uploads/2016/04/404.gif" width="60%" height="60%"/>
			</div>

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
