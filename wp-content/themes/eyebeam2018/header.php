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
	</head>
	<body <?php body_class(); ?>>
		<header>
			<nav>
				<div class="menu-btn"></div>
				<h1><a href="/"><img src="<?php eyebeam2018_img_src('img/eyebeam.svg'); ?>" alt="EYEBEAM" class="logo"></a></h1>
				<?php

				// Edit nav items from the WordPress dashboard:
				// https://www.eyebeam.org/wp-admin/nav-menus.php

				wp_nav_menu(array(
					'theme_location' => 'top'
				));

				?>
				<a href="/donate/" class="support red">Support Eyebeam!</a>
			</nav>
		</header>
		<div id="page">
