<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<?php wp_head(); ?>
	</head>
	<body>
		<nav>
			<img src="<?php eyebeam2018_img_src('eyebeam.svg') ?>" alt="EYEBEAM" class="logo">
			<?php

			wp_nav_menu(array(
				'theme_location' => 'top'
			));

			?>
			<a href="#" class="support red">Support Eyebeam!</a>
		</nav>
