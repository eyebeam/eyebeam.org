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
		$currentFilter = "All";
		if(!empty($_GET['resident_year'])){
			$currentFilter = $_GET['resident_year'];
		}
	?>
	<div class="residentFilter">
		<span class="filterLabel">Sort by: </span>
		<div class="residentSortDropdown" onclick="getElementById('filterOptions').classList.toggle('showMe'); event.stopPropagation();">
			<span><?php echo $currentFilter; ?>	</span>
			<span class="carety">&or;</span>
			<ul id="filterOptions" class="filterOptions">
				<li <?php if(empty($_GET['resident_year'])) echo 'class="currentFilter"'; ?> >
					<a href='<?php echo home_url( $wp->request ); ?>'>ALL</a>
				</li>
				<?php for( $yearIndex = $currentYear; $yearIndex >= 2000; $yearIndex-- ): ?>
					<li <?php if($yearIndex == (int)$_GET['resident_year']) echo 'class="currentFilter"'; ?> >
						<a href="<?php echo home_url( $wp->request ); ?>?resident_year=<?php echo $yearIndex; ?>"><?php echo $yearIndex; ?></a>
					</li>
				<?php endfor; ?>
			</ul>
		</div>
	</div>
	<!-- End Resident Dropdown Filter -->

	<?php if ( have_posts() ) : ?>

	<?php
		$numberOfPosts = 15;
		if(isset($_GET['showAll']) and ($_GET['showAll']))
			$numberOfPosts = -1;

		$archive_args = array(
		'post_type' => 'resident',
		'posts_per_page' => $numberOfPosts,
		'orderby'=> 'meta_value',
		'meta_key' => 'end_year',
		);

		 if(isset($_GET['resident_year']) and ($_GET['resident_year'])){
			// Cast the value that was in the URL to an int to avoid SQL injection
			$resident_year = (int)$_GET['resident_year'];

			$archive_args['meta_query'] =
		    array(
			    array(
			      'key'=> 'start_year',
			      'value'=> $resident_year,
			      'compare'=> '<='
					),
					// The value being queried (e.g. 2014) should be less than or equal to
					// the resident's end year (e.g. 2016)
					array(
						'key'=> 'end_year',
						'value'=> $resident_year,
						'compare'=> '>='
					),
				);

			} ?>


		<?php
		$residents = new WP_Query($archive_args);
		if($residents->have_posts()):
			$i = 0; ?>
			<div class="residents">
				<?php while($residents->have_posts()) : $residents->the_post(); ?>
					<?php
					$image = get_field('image');
					$specific_date = eyebeam2018_compare_resident_year(get_the_ID());
					$grossHackUrl = get_field('name');
					$lessGross = substr($grossHackUrl, strrpos($grossHackUrl, '<a href="' )+9) ;
					$cleanUrl = substr($lessGross, 0, strrpos($lessGross, '">' )); ?>

					<a href="<?php echo $cleanUrl; ?>" target="_blank" class="resident">
						<?php if(!empty($image)) : ?>
							<span class="residentMugShot" style="background-image:url('<?php echo $image['url']; ?>')"></span>
						<?php else: ?>
							<span class="residentMugShot" style="background-color:black;color:white;"></span>
							<span style="text-align: center;position: absolute;margin-top: -60px;color: white;width: 16%;">no photo</span>
						<?php endif; ?>

						<?php if($specific_date) : ?>
							<span class="residencyDateRange"><?php echo $specific_date ; ?></span>
			   		<?php endif; ?>

						<?php if($residents) : ?>
							<span class="residentName"> <?php echo the_title(); ?> </span>
						<?php endif; ?>

			   		<?php if($residents) : ?>
							<span class="residentType"><?php echo get_field('resident_type'); ?> </span>
						<?php endif; ?>
					</a>

					<?php if(++$i % 5 == 0):?>
						<div class="clearingSpacer"></div>
						<?php if($i == 10): ?>
							<a id="newResults" href="#">
						<?php endif; ?>
					<?php endif; ?>

				<?php endwhile; ?>
			</div>
			<?php if( $numberOfPosts == 15 ): ?>
				<a class="showAllResidents"
					href="<?php
						echo add_query_arg( $_SERVER['QUERY_STRING'], '', home_url( $wp->request ) );
						if(count($_GET))
							{ echo '&'; }
						else
							{ echo '?'; }
						echo 'showAll=true#newResults'; ?>">See more residents</a>
			<?php endif; ?>
		<?php endif;?>

		<?php wp_reset_query();?>

		<?php wp_reset_postdata(); ?>

	<?php endif; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
