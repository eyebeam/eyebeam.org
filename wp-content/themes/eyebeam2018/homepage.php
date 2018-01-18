<?php
/**
 * Template Name: Home
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package eyebeam2018
 */


get_header();?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
	$mobileImage = get_field('mobile_hero_image');
	$heroImage = get_field('hero_image');
	$headTitle = get_field('hero_title_text');
	$headDescription = get_field('hero_title_blurb');
	if(!empty($mobileImage) && wp_is_mobile() ) : ?>
		<div id="homeHeroImage" class="heroImageWrapper">
			<div class="heroImage"  style='background-image: url("<?php echo $mobileImage['url']; ?>");' width="100%" height="100%"></div>
		</div>
	<?php else:
		if(!empty($heroImage) ) : ?>
			<div id="homeHeroImage" class="heroImageWrapper">
				<div class="heroImage"  style='background-image: url("<?php echo $heroImage['url']; ?>");' width="100%" height="100%"></div>
			</div>
		<?php else: ?>
		<div class="videoHolder">
			<video class="heroVideo" autoplay loop muted src="/img/eyebeamhome.mp4"></video>
		</div>
	<?php endif;endif; ?>
	<?php if(!empty($headTitle)) : ?>
		<div class="pushingDiv">
			<div class="heroText">
				<h2 class="heroTitle"><?php echo $headTitle; ?></h2>
				<?php if(!empty($headDescription)) : ?>
					<span class="heroTitle"><?php echo $headDescription; ?></span>
				<?php endif;?>
			</div>
		</div>
	<?php endif;?>

	<?php
		$featuredEventId = get_field("featured_event")->ID;
		$featuredEventImage = get_field('image',$featuredEventId);
		$featuredEventUrl = get_permalink($featuredEventId);
		$featuredEventLabel = get_field("featured_event_label");

		$residentsLinkImage = get_field("residents_link_image");
		$residentsLinkUrl = get_field("residents_link_url");
		$residentsLinkLabel = get_field("resident_link_label");

		$featuredIdeaId = get_field("featured_idea")->ID;
		$featuredIdeaImage = get_field('image', $featuredIdeaId);
		$featuredIdeaUrl = get_permalink($featuredIdeaId);
		$featuredIdeaLabel = get_field("featured_idea_label");
	?>

	<div class="homepageContent">
		<div class="homeNav">
			<div class="featuredEvent homeNavItem">
				<a href="<?= $featuredEventUrl; ?>">
					<?php if(!empty($featuredEventImage)) : ?>
						<span class="homepageNavPhoto" style="background-image:url('<?php echo $featuredEventImage['url']; ?>')"></span>
					<?php endif; ?>
					<?= $featuredEventLabel ?>
				</a>
			</div><!--
			--><div class="linkToResidents homeNavItem">
				<a href="<?php echo $residentsLinkUrl; ?>">
					<?php if(!empty($residentsLinkImage)) : ?>
						<span class="homepageNavPhoto" style="background-image:url('<?php echo $residentsLinkImage['url']; ?>')"></span>
					<?php endif; ?>
					<?= $residentsLinkLabel ?>
				</a>
			</div><!--
			--><div class="featured homeNavItem">
				<a href="<?= $featuredIdeaUrl; ?>">
					<?php if(!empty($featuredIdeaImage)) : ?>
						<span class="homepageNavPhoto" style="background-image:url('<?php echo $featuredIdeaImage['url']; ?>')"></span>
					<?php endif; ?>
					<?= $featuredIdeaLabel ?>
				</a>
			</div>
		</div>
		<div class="rowSpacerLine"></div>
		<h1 style="font-weight:100;line-height:1.7;">Values</h1>
		<ul class="values">
			<li class="value">
				<img src="<?php echo get_template_directory_uri().'/img/openness.png' ?>" />
				<div class="valueInfo">
					<h3>Openness</h3>
					<p>All the work here is driven by an open-source ethos.</p>
				</div>
			</li><!--
			--><li class="value">
				<img src="<?php echo get_template_directory_uri().'/img/invention.png' ?>" />
				<div class="valueInfo">
					<h3>Invention</h3>
					<p>Build on old ideas to generate new possibilities.</p>
				</div>
			</li><!--
			--><li class="value">
				<img src="<?php echo get_template_directory_uri().'/img/justice.png' ?>" />
				<div class="valueInfo">
					<h3>Justice</h3>
					<p>Technology by artists is a step towards equality and democracy.</p>
				</div>
			</li>
		</ul>
	</div>

<?php get_footer(); ?>
