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
			<form action="https://eyebeam.us4.list-manage.com/subscribe?u=c72c271895f3f76b36105229c" method="get" id="subscribe" class="<?php echo $form_class; ?>">
				<h2 class="eyebeam-sans" alt="Subscribe to our Newsletter" title="Subscribe to our Newsletter">
					Stay Updated
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
				<input type="hidden" name="u" value="c72c271895f3f76b36105229c">
				<input type="hidden" name="id" value="bb4e74c232">
				<input type="text" name="MERGE1" placeholder="First Name">
				<input type="text" name="MERGE2" placeholder="Last Name">
				<input type="email" name="MERGE0" placeholder="Email">
				<input type="submit" value="Subscribe">
			</form>
			<nav>

				<?php

				// Edit nav items from the WordPress dashboard:
				// https://www.eyebeam.org/wp-admin/nav-menus.php
				$menu = eyebeam2018_get_menu_by_location('bottom');
				echo "<div class=\"container\">\n";
				echo "<h2 class=\"eyebeam-sans\">$menu->name</h2>";

				wp_nav_menu(
					array(
					'theme_location' => 'bottom',
				));
				echo "</div>\n";
				?>

				<?php

				// Edit nav items from the WordPress dashboard:
				// https://www.eyebeam.org/wp-admin/nav-menus.php
				$menu = eyebeam2018_get_menu_by_location('bottom_middle');
				echo "<div class=\"container\">\n";
				echo "<h2 class=\"eyebeam-sans\">$menu->name</h2>";

				wp_nav_menu(
					array(
					'theme_location' => 'bottom_middle',
				));
				echo "</div>\n";
				?>


				<?php

				// Edit nav items from the WordPress dashboard:
				// https://www.eyebeam.org/wp-admin/nav-menus.php
				$menu = eyebeam2018_get_menu_by_location('bottom_right');
				echo "<div class=\"container\">\n";
				echo "<h2 class=\"eyebeam-sans\">$menu->name</h2>";

				wp_nav_menu(
					array(
					'theme_location' => 'bottom_right',
				));
				echo "</div>\n";
				?>
			</nav>
			<div class="bottom">
				<div class="address">
					199 Cook St<br />
					Brooklyn,  NY 11206<br />
					<a href="https://www.google.com/maps/search/?api=1&query=199+Cook+St,+Brooklyn,+NY+11206">View on Map</a>
				</div>
				<div class="contact">
					<a href="tel:13473789163" class="phone">+1 347.378.9163</a>
					<a href="mailto:info@eyebeam.org" class="email">info@eyebeam.org</a>
					<a href="https://twitter.com/eyebeamnyc">@eyebeamnyc</a>
					<a href="https://www.eyebeam.org/">eyebeam.org</a>
				</div>
				<div class="social">
						<a class="iconify twitter" data-icon="dashicons:twitter" alt="Twitter" href="https://twitter.com/eyebeamnyc"></a>
						<a class="iconify facebook" data-icon="ant-design:facebook" alt="Facebook" href="https://www.facebook.com/eyebeamnyc/"></a>
						<a class="iconify instagram" data-inline="false" data-icon="dashicons-instagram" alt="Instagram" href="https://www.instagram.com/eyebeamnyc/"></a>
						<a class="iconify youtube" data-inline="false" data-icon="icomoon-free:youtube2" alt="YouTube" href="https://www.youtube.com/user/eyebeamdotorg"></a>
				</div>
			</div>

		</footer>
		<?php wp_footer(); ?>
		<!-- using an svg incase we want programatically change the color, is that excessive and over- programmed? maybe, yes -->
		<div class="logos">
			<h2 class="eyebeam-sans">
				Featured Sponsors
			</h2>
			<div id="partners">
				<img src="<?php eyebeam2018_img_src('img/partners/ab-bernstein.png'); ?>" alt="AB Bernstein" width="auto">
				<img src="<?php eyebeam2018_img_src('img/partners/nyc-cultural-affairs.png'); ?>" alt="NYCulture" width="auto">
				<img src="<?php eyebeam2018_img_src('img/partners/capital-one.png'); ?>" alt="Capital One" width="auto">

				<img src="<?php eyebeam2018_img_src('img/partners/andy-warhol.png'); ?>" alt="Andy Warhol Foundation" width="auto">
				<img src="<?php eyebeam2018_img_src('img/partners/hyde-watson.png'); ?>" alt="The Hyde and Watson Foundation" width="auto">
				<img src="<?php eyebeam2018_img_src('img/partners/jerome.png'); ?>" alt="Jerome Foundation" width="auto">
				<img src="<?php eyebeam2018_img_src('img/partners/macarthur-foundation.png'); ?>" alt="MacArthur Foundation" width="auto">
				<img src="<?php eyebeam2018_img_src('img/partners/nea-white.png'); ?>" alt="National Endowment for the Arts" width="auto">
				<img src="<?php eyebeam2018_img_src('img/partners/nysca.png'); ?>" alt="NYSCA" width="auto">
				<img src="<?php eyebeam2018_img_src('img/partners/open-society.png'); ?>" alt="Open Society Foundations" width="auto">
				<img src="<?php eyebeam2018_img_src('img/partners/atlantic-foundation.png'); ?>" class="wider" alt="Atlantic Foundation" width="auto">
				<img src="<?php eyebeam2018_img_src('img/partners/craig-newmark.png'); ?>" class="wider" alt="Capital One" width="auto">

				<img src="<?php eyebeam2018_img_src('img/partners/surdna.png'); ?>" class="wider" alt="Surdna Foundation" width="auto">
			</div>
			<a href="/">
				<!-- <img class="footer-logo" src="data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%201923.55%20256%22%3E%3Cdefs%3E%3Cstyle%3E.cls-1%7Bfill%3A%23FFFFFF%3B%7D%3C%2Fstyle%3E%3C%2Fdefs%3E%3Ctitle%3Eeyebeam_logo%3C%2Ftitle%3E%3Cg%20id%3D%22Layer_2%22%20data-name%3D%22Layer%202%22%3E%3Cg%20id%3D%22Layer_1-2%22%20data-name%3D%22Layer%201%22%3E%3Cpolygon%20class%3D%22cls-1%22%20points%3D%220%20256%200%200%20256%200%20256%2051.2%2051.2%2051.2%2051.2%20102.4%20256%20102.4%20256%20153.6%2051.2%20153.6%2051.2%20204.8%20256%20204.8%20256%20256%200%20256%22%2F%3E%3Cpolygon%20class%3D%22cls-1%22%20points%3D%22535.61%200%20472.45%200%20407.61%2097.27%20342.76%200%20279.61%200%20379.36%20149.63%20379.36%20256%20435.85%20256%20435.85%20149.63%20535.61%200%22%2F%3E%3Cpath%20class%3D%22cls-1%22%20d%3D%22M1595.53%2C256h55.19L1548.32%2C0h-51.2l-102.4%2C256h55.18l20.48-51.2h104.68ZM1490.86%2C153.6%2C1522.72%2C74l31.85%2C79.64Z%22%2F%3E%3Cpolygon%20class%3D%22cls-1%22%20points%3D%221667.55%200%201667.55%20256%201718.75%20256%201718.75%2051.2%201769.95%2051.2%201769.95%20256%201821.15%20256%201821.15%2051.2%201872.35%2051.2%201872.35%20256%201923.55%20256%201923.55%200%201667.55%200%22%2F%3E%3Cpolygon%20class%3D%22cls-1%22%20points%3D%221373.84%20256%201373.84%20204.8%201169.04%20204.8%201169.04%20153.6%201373.84%20153.6%201373.84%20102.4%201169.04%20102.4%201169.04%2051.2%201373.84%2051.2%201373.84%200%201117.84%200%201117.84%20256%201373.84%20256%22%2F%3E%3Cpath%20class%3D%22cls-1%22%20d%3D%22M839.52%2C256h179.2a76.78%2C76.78%2C0%2C0%2C0%2C50.73-134.43A76.76%2C76.76%2C0%2C0%2C0%2C1009.26.06V0H839.52ZM1007.07%2C51.2a25.6%2C25.6%2C0%2C1%2C1%2C0%2C51.2H890.72V51.2Zm11.65%2C102.4a25.6%2C25.6%2C0%2C0%2C1%2C0%2C51.2h-128V153.6Z%22%2F%3E%3Cpolygon%20class%3D%22cls-1%22%20points%3D%22811.23%200%20811.23%2051.2%20606.43%2051.2%20606.43%20102.4%20811.23%20102.4%20811.23%20153.6%20606.43%20153.6%20606.43%20204.8%20811.23%20204.8%20811.23%20256%20555.23%20256%20555.23%200%20811.23%200%22%2F%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" /> -->
			</a>
		</div>
	</body>
</html>
