<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eyebeam2018
 */



?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php bloginfo('description'); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!-- Fish Animation Currently Disabled
<link rel="image_src" href="/fish-animation/img/school-of-fish.png"/>
<link rel="stylesheet" href="/fish-animation/css/style.css">
-->
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1510995512258807');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1510995512258807&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->
<?php wp_head(); ?>

<?php
$isMobile = "";

if(eyebeam2018_isMobile()) {
	$isMobile = "mobile-device";
}
?>
</head>

<body <?php body_class($isMobile); ?>>
	<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content">Skip to content</a>
	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<div class="eyebeam-logo">
				 <a href="/">
					<img src="/img/logo.png"/>
				 </a>



			</div>

			 <!-- Mobile Tap Menu Function -->
			<div id="tap">
			 	<div></div>
				<div></div>
				<div></div>
			</div>
			<style>
				div.donate#movingButton:hover {
					background-color: rgba(234,32,37,1);
				}
			</style>
			<div id="movingButton" class="donate">
				<a href="https://www.kickstarter.com/projects/roddy/eyebeams-new-home-building-a-sustainable-space-for">We're Moving!</a>
			</div>
			<?php get_template_part( '/inc/nav.inc' ); ?>
		</div>

	</div>
	</header><!-- #masthead -->

<div id="content" class="site-content">
