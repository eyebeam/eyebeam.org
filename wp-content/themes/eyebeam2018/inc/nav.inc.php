<script>
document.addEventListener("DOMContentLoaded", function() {
 var ed = document.getElementById("education-dropdown").firstElementChild;
 var arrow = document.getElementById("education-arrow");

 ed.addEventListener("mouseover", function() {
	arrow.classList.add("dark");
 });

 ed.addEventListener("mouseleave", function() {
	arrow.classList.remove("dark");
 });
});
</script>

<!-- Main Navigation for Web -->
<nav id="site-navigation" class="main-navigation" role="navigation">
	<ul>
		<li>
			<a <?php if (strpos($_SERVER['REQUEST_URI'], 'residency') > 0 && !strpos($_SERVER['REQUEST_URI'], 'student-residency')) print 'class="current"'; ?> href='<?php echo site_url()."/residency/"; ?>'>Apply</a>
		</li>
		<li id="education-nav">
			<a <?php if (strpos($_SERVER['REQUEST_URI'], 'education') > 0 || strpos($_SERVER['REQUEST_URI'], 'communityyouth') > 0) print 'class="current"'; ?> href='<?php echo site_url()."/education/"; ?>'>Learn</a>
			<?php
				$archive_args = array(
				'post_type' => 'communityyouth',
				'posts_per_page' => -1 
				);
			
				$programs = new WP_Query($archive_args);
				if($programs->have_posts() && false): ?>
			<div id="education-dropdown">
				<?php while($programs->have_posts()) : $programs->the_post(); ?>
				<a class="dropdown-program" href="<?php the_permalink(); ?>"><?php echo the_field('program_name_youth'); ?></a>
				<?php endwhile; ?>
				<div class="up-arrow" id="education-arrow"></div>
				<div class="hover-buffer"></div>

			<div>
<?php endif;
wp_reset_query(); 
wp_reset_postdata(); ?>
		</li>
		<li>
			<a <?php if (strpos($_SERVER['REQUEST_URI'], 'ourevents') > 0 || strpos($_SERVER['REQUEST_URI'], 'ourevents') > 0 ) print 'class="current"'; ?> href='<?php echo site_url()."/ourevents/"; ?>'>Visit</a>
		</li>
		<li>
			<a <?php if (strpos($_SERVER['REQUEST_URI'], 'ourresidents') > 0) print 'class="current"'; ?> href='<?php echo site_url()."/ourresidents/"; ?>'>People</a>
		</li>
		<li>
			<a <?php if (strpos($_SERVER['REQUEST_URI'], 'ideas') > 0 || strpos($_SERVER['REQUEST_URI'], 'stopwork') > 0 ) print 'class="current"'; ?> href='<?php echo site_url()."/ideas/"; ?>'>Ideas</a>
		</li>
		<li>
			<a <?php if (strpos($_SERVER['REQUEST_URI'], 'about') > 0) print 'class="current"'; ?> href='<?php echo site_url()."/about/"; ?>'>About</a>	
		</li>
	</ul>
			<!-- 
<li id="search" class="search">
				<form role="search" method="get" class="search-form" action="https://eyebeam.org/">
					<input type="search" class="search-field" value="" name="s">
					<input type="submit" class="search-submit" name="submit" alt="search" value="">
				</form>
			</li>	
 -->
</nav><!-- #site-navigation -->

<!-- Mobile Menu Navigation -->
<nav id="site-navigation" class="mobile-navigation" role="navigation">
	<ul>
		<li>
			<a <?php if (strpos($_SERVER['REQUEST_URI'], 'residency') > 0) print 'class="current"'; ?> href="<?php echo site_url().'/residency/'; ?>">Apply</a>
		</li>
		<li>
			<a <?php if (strpos($_SERVER['REQUEST_URI'], 'education') > 0) print 'class="current"'; ?> href="<?php echo site_url().'/education/'; ?>">Learn</a>
		</li>
		<li>
			<a <?php if (strpos($_SERVER['REQUEST_URI'], 'ourevents') > 0) print 'class="current"'; ?> href="<?php echo site_url().'/ourevents/'; ?>">Visit</a>
		</li>
		<li>
			<a <?php if (strpos($_SERVER['REQUEST_URI'], 'ourresidents') > 0) print 'class="current"'; ?> href="<?php echo site_url().'/ourresidents/'; ?>">People</a>
		</li>
		<li>
			<a <?php if (strpos($_SERVER['REQUEST_URI'], 'ideas') > 0) print 'class="current"'; ?> href="<?php echo site_url().'/ideas/'; ?>">Ideas</a>
		</li>
		<li>
			<a <?php if (strpos($_SERVER['REQUEST_URI'], 'about') > 0) print 'class="current"'; ?> href="<?php echo site_url().'/about/'; ?>">About</a>	
		</li>
		<li>
			<div class="donate mobile">
				<a href="https://eyebeam.secure.force.com/donate/?dfId=a0n610000068vhRAAQ">Donate Now</a>
			</div>
		</li>
	</ul>
</nav>	
