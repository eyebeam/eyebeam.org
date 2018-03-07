<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<?php do_action('eyebeam2018_view_source'); ?>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php wp_head(); ?>
	</head>
	<body>
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
