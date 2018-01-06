<?php
/**
 * The template for displaying resident posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package eyebeam2016
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="column column-7 site-main" role="main">
		<div class="page-title">Residency</div>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('single' ); ?>
			<?php endwhile; // End of the loop. ?>
			
			<?php
				$resident = get_fields();
				$image = get_field('image');
				//var_dump($resident);
				$name = $resident["name"];
				$resident_type = $resident['resident_type'];
				$start_year = $resident['start_year'];
				$end_year = $resident['end_year'];
				$bio = $resident['bio'];
				?>
			<!-- <div class="column column-7"> -->
			<div class="flex">
				<!-- <div class="column column-3 line-height"> -->
				<div class="resident-info">
					<?php
						if($name) : ?>
						<p><?= $name; ?></p>
					<?php endif; ?>

					<?php
						if($resident_type) : ?>
						<p><?= $resident_type; ?></p>
					<?php endif; ?>

				<div class="resident-image">
					<?php
					if(!empty($image)) : ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="280px" height="256px" />
					<?php endif; ?>
					</div>
				</div>


				<!-- <div class="column column-4 resident-year"> -->
				<div class="resident-year">
					<?php	
					if($start_year) : ?>
					<div class="year">
					<?= $start_year; ?>
					</div>
					<?php endif; 

					if($end_year) : ?>
					<div class="year">
					<?= $end_year; ?>
					</div>
					<?php endif; 

					?>
				</div>
			</div>

	 		 <div class="column-7"> 
			<div class="resident-bio paragraph-indent">
				<?php
				if($bio) : ?>
				<p>
					<?= $bio; ?>
				</p>
				<?php endif; ?>
			</div>
		</div>


	<?php wp_reset_postdata(); ?>


	</main><!-- #main -->
	</div><!-- #primary -->


<aside class="sidebar">
<div class = "related-names">
	<div class = "h2-related-names"> Related </div>
	<?php $related_events = get_posts(array(
							'post_type' => 'event',
							'meta_query' => array(
								array(
									'key' => 'related_name', // name of custom field
									'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
									'compare' => 'LIKE'
								)
							)
						));

						?>
						<?php if( $related_events ): ?>
							<ul>
							<?php foreach( $related_events as $related_name ): ?>
								<?php 

								$name = get_field('name', $related_name->ID);

								?>

								<li>
									<a href="<?php echo get_permalink( $related_name->ID ); ?>">
										<?php echo get_the_title( $related_name->ID ); ?>
									</a>
								</li>
							<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>

<?php get_sidebar(); ?>	
</aside>

<?php get_footer(); ?>
