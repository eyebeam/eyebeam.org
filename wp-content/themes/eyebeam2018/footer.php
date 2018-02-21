		</div>
		<footer>
			<nav>
				<?php

				// Edit nav items from the WordPress dashboard:
				// https://www.eyebeam.org/wp-admin/nav-menus.php

				wp_nav_menu(array(
					'theme_location' => 'bottom'
				));

				?>
			</nav>
			<form action="/wp-admin/admin-ajax.php" method="post" id="subscribe">
				<input type="hidden" name="action" value="eyebeam2018_subscribe">
				<input type="text" name="first_name" placeholder="First Name">
				<input type="text" name="last_name" placeholder="Last Name">
				<input type="email" name="email" placeholder="Email">
				<input type="submit" value="Subscribe">
			</form>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
