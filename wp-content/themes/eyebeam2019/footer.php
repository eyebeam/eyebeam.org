		</div>
		<footer>
			<?php

			$form_class = '';
			if (! empty($_GET['subscribed'])) {
				$form_class = 'success';
			} else if (isset($_GET['subscribed'])) {
				$form_class = 'error';
			}

			?>
			<form action="/wp-admin/admin-ajax.php" method="post" id="subscribe" class="<?php echo $form_class; ?>">
				<h2>
					Subscribe to our Newsletter
				</h2>
				<p>
					Enter your e-mail to stay up to date on all of our programs
				</p>
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
			<div class="bottom">
				<div class="address">
					199 Cook St<br />
					Brooklyn,  NY 11206<br />
					<a href="https://www.google.com/maps/search/?api=1&query=199+Cook+St,+Brooklyn,+NY+11206">View on Map</a>
				</div>
				<div class="contact">
					+1 347.378.9163<br>
					<a href="https://twitter.com/eyebeamnyc">@eyebeamnyc</a><br>
					<a href="https://www.eyebeam.org/">eyebeam.org</a>
				</div>
				<div class="social">
					<div class="links">
						<a href="https://twitter.com/eyebeamnyc">Twitter</a><br />
						<a href="https://www.facebook.com/eyebeamnyc/">Facebook</a><br />
						<a href="https://www.instagram.com/eyebeamnyc/">Instagram</a><br />
						<a href="https://www.youtube.com/user/eyebeamdotorg">YouTube</a><br />
					</div>
				</div>
				<nav>
					<?php

					// Edit nav items from the WordPress dashboard:
					// https://www.eyebeam.org/wp-admin/nav-menus.php

					wp_nav_menu(array(
						'theme_location' => 'bottom'
					));

					?>
				</nav>
				<div class="partners">
					<img src="<?php eyebeam2018_img_src('img/jerome.png'); ?>" alt="Jerome Foundation" width="120">
					<img src="<?php eyebeam2018_img_src('img/nyculture.png'); ?>" alt="NYCulture" width="128">
					<img src="<?php eyebeam2018_img_src('img/artworks.png'); ?>" alt="Art Works" width="90">
					<img src="<?php eyebeam2018_img_src('img/nysca.png'); ?>" alt="NYSCA" width="202">
				</div>
				<br class="clear">
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
