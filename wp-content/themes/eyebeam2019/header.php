<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<?php do_action('eyebeam2018_view_source'); ?>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-15850195-1"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-15850195-1');
		</script>
		<?php wp_head(); ?>

		<!-- This seems like the best way to add google fonts -->
		<link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500" rel="stylesheet">

		 <?php global $post;
	    if ($post->post_name == 'digital-day-camp-2020') {
				include("module/fbpixel.php");
			}
		?>
	</head>
	<body <?php body_class(); ?>>
		<header>
			<div class="mobile-logo">
				<a tabindex="0" href="/" alt="Eyebeam" title="Eyebeam">
					<img role="banner" src="<?php eyebeam2018_img_src('img/eyebeam_logo.svg'); ?>" alt="Eyebeam" title="Eyebeam" />
				</a>
			</div>
			<nav role="navigation">

				<div class="mobile-label">
					<a tabindex="1" class="btn-anchor" aria-label="Click this Button to Show the Menu" href="#">
					Click to Show the Menu
				</a>
				<div class="menu-btn">
					<a class="btn-anchor-icon" aria-label="Click this button to Show the Menu" href="#"></a>
				</div>
				</div>

				<!-- <h1><a href="/"><img src="<?php eyebeam2018_img_src('img/eyebeam.svg'); ?>" alt="EYEBEAM" class="logo"></a></h1> -->

				<?php

				// Edit nav items from the WordPress dashboard:
				// https://www.eyebeam.org/wp-admin/nav-menus.php

				wp_nav_menu(array(
					'theme_location' => 'top'
				));

				?>
				<!-- <a href="/donate/" class="support red">Support Eyebeam!</a> -->
			</nav>
			<form id="search" action="/" method="GET">
				<input type="text" name="s" placeholder="Search" />
				<button type="submit">
					<span class="search-icon"></span>
				</button>
			</form>
		</header>
		<div id="page">
