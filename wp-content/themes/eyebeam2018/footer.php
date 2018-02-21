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
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
