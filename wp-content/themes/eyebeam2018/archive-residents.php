<?php
/**
 * Template Name: Residents Archives
 * The template for displaying resident archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eyebeam2018
 */

get_header(); ?>

<div id="primary" class="content-area" onclick="getElementById('filterOptions').classList.remove('showMe');">
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
		<div class="page-title">Residents</div>

	<?php $currentYear = date("Y");?>

	<!-- Resident Dropdown Filter -->
	<?php
		$currentFilter = $currentYear;
		if(!empty($_GET['resident_year'])){
			$currentFilter = strtolower($_GET['resident_year']);
		}
	?>
	<div id="residentFilter">
		<span class="filterLabel">Year: </span>
		<div class="residentSortDropdown" onclick="getElementById('residentFilter').classList.toggle('showOptions'); event.stopPropagation();">
			<span class="currentLabel"><?php echo strtoupper($currentFilter); ?></span>
			<span class="carety">&or;</span>
			<ul id="filterOptions" class="filterOptions">
				<li <?php if($currentFilter == 'all') echo 'class="currentFilter"'; ?> >
					<a href='<?php echo home_url( $wp->request ); ?>?resident_year=all'>ALL</a>
				</li>
				<?php for( $yearIndex = $currentYear; $yearIndex >= 2000; $yearIndex-- ): ?>
					<li <?php if($yearIndex == (int)$currentFilter) echo 'class="currentFilter"'; ?> >
						<a href="<?php echo home_url( $wp->request ); ?>?resident_year=<?php echo $yearIndex; ?>"><?php echo $yearIndex; ?></a>
					</li>
				<?php endfor; ?>
			</ul>
		</div>
	</div>
	<!-- End Resident Dropdown Filter -->

	<?php if ( have_posts() ) : ?>

		<?php

		$residents = eyebeam2018_resident_query();
		if($residents->have_posts()):
			?>
			<div class="residents">
				<?php while($residents->have_posts()) : $residents->the_post(); ?>
					<?php get_template_part('template-parts/resident', 'list'); ?>
				<?php endwhile; ?>
			</div>
			<?php if( $residents->found_posts > $residents->post_count ): ?>
				<a class="load-more" href="<?php
					echo add_query_arg( $_SERVER['QUERY_STRING'], '', home_url( $wp->request ) );
					if(count($_GET)) { echo '&'; }
					else { echo '?'; }
					echo 'page=2'; ?>" data-type="resident" data-filter="resident_year" data-page="2">See more residents</a>
			<?php endif; ?>
		<?php endif;?>

		<?php wp_reset_query();?>

		<?php wp_reset_postdata(); ?>

	<?php endif; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
