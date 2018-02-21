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
			<?php

			$form_class = '';
			if (! empty($_GET['subscribed'])) {
				$form_class = 'success';
			} else if (isset($_GET['subscribed'])) {
				$form_class = 'error';
			}

			?>
			<form action="/wp-admin/admin-ajax.php" method="post" id="subscribe" class="<?php echo $form_class; ?>">
				<div class="response-loading">
					Please wait...
				</div>
				<div class="response-success">
					Thanks for subscribing!
				</div>
				<div class="response-error">
					That didn’t work for some reason.
				</div>
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
