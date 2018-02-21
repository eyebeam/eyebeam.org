<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<?php wp_head(); ?>
	</head>
	<body>
		<header>
			<nav>
				<img src="<?php eyebeam2018_img_src('img/eyebeam.svg'); ?>" alt="EYEBEAM" class="logo">
				<?php

				// Edit nav items from the WordPress dashboard:
				// https://www.eyebeam.org/wp-admin/nav-menus.php

				wp_nav_menu(array(
					'theme_location' => 'top'
				));

				?>
				<a href="#" class="support red">Support Eyebeam!</a>
			</nav>
		</header>
		<div id="page">
