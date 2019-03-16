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

		<!-- This sseems like the best way to add google fonts -->
		<link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500" rel="stylesheet">

	</head>
	<body <?php body_class(); ?>>
		<header>
			<div class="mobile-logo">
				<a href="/">
					<img src="<?php eyebeam2018_img_src('img/eyebeam_logo.png'); ?>" alt="Eyebeam" />
				</a>
			</div>
			<div class="logo-container" id="left">
				<div class="matte"></div>
				<h1>
					<a href="/" id="eyebeam_3_left"><img src="<?php eyebeam2018_img_src('img/eyebeam_3_left.png'); ?>" alt="Eyebeam" /></a>
					<a href="/" id="eyebeam_2_left"><img src="<?php eyebeam2018_img_src('img/eyebeam_2_left.png'); ?>" alt="Eyebeam" /></a>
					<a href="/" id="eyebeam_1_left"><img src="<?php eyebeam2018_img_src('img/eyebeam_1_left.png'); ?>" alt="Eyebeam" /></a>
				</h1>
			</div>
			<nav>
				<div class="mobile-label">
				Menu
				</div>
				<div class="menu-btn"></div>
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
			<div class="logo-container" id="right">
				<div class="matte"></div>
				<h1>
					<a href="/" id="eyebeam_1_right"><img src="<?php eyebeam2018_img_src('img/eyebeam_1.png'); ?>" alt="Eyebeam" /></a>
					<a href="/" id="eyebeam_2_right"><img src="<?php eyebeam2018_img_src('img/eyebeam_2.png'); ?>" alt="Eyebeam" /></a>
					<a href="/" id="eyebeam_3_right"><img src="<?php eyebeam2018_img_src('img/eyebeam_3.png'); ?>" alt="Eyebeam" /></a>
				</h1>
			</div>
		</header>
		<div id="page">
