<?php
/**
 * Template Name: Stopwork Archives
 * The template for displaying stopwork archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eyebeam2016
 */
 
 
get_header(); ?>

<div id="primary" class="content-area">
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

		<!-- Main Content -->
	<main id="main" class="site-main" role="main">
		<?php 
			$archive_args = array(
			'post_type' => 'stopwork',
			'posts_per_page' => -1,
			'orderby'=> 'date',
			);
		$ideas = new WP_Query($archive_args);
		?>


		<div class="blogPosts">
			<?php while ($ideas->have_posts()) : $ideas->the_post(); ?>
				<?php $post_fields = get_fields();
			 	$image = get_field('image');
				$blog_author = $post_fields["author"]; ?>

				<a class="blogPost" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
					<?php if(!empty($image)) : ?>
						<!--<span class="blogPhoto" style="background-image:url('<?php echo $image['url']; ?>')"></span>-->
						<img class="blogPhotoImg" src= "<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
					<?php endif; ?>

					<div class="blogBits">
						<span><?php echo the_date('F j, Y'); ?></span>
						<h2><?php the_title(); ?></h2>
						<?php if($blog_author) : ?>
							<p class="author"><?= 'by '.$blog_author; ?></p>
				   	<?php endif;?>
						<?php the_excerpt(); ?>
					</div>
				</a>
				<div class="rowSpacerLine"></div>
			<?php endwhile; ?>
		</div>	
		
		<?php wp_reset_postdata(); ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();?>
