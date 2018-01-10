<?php
/**
 * The template for displaying stopwork posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package eyebeam2018
 */

get_header(); ?>

<div id="primary" class="content-area">

	<!-- Main Content -->
	<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); 
		  $blog_post = get_fields();
		  $image = get_field('image');
		  $blog_author = $blog_post["author"]; ?>
		
			<div class="singleBlogPost">
				<span><?php echo the_date('F j, Y'); ?></span>
				<h2><?php the_title(); ?></h2>
				<?php if($blog_author) : ?>
					<p class="author"><?= 'by '.$blog_author; ?></p>
		   	<?php endif;?>

				<?php if(!empty($image)) : ?>
					<!--<span class="blogPhoto" style="background-image:url('<?php echo $image['url']; ?>')"></span>-->
					<img class="blogPhotoImg" src= "<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
				<?php endif; ?>
				<div class="blogContent">
		   		<?php the_content() ?>
	   		</div>
			</div>	

		<?php endwhile; // End of the loop. ?>

		<?php wp_reset_postdata(); ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
