<?php

$video = get_field('hero_video');
$poster_image = get_field('hero_poster_image');

if (! empty($video)) {

	$video_src = $video['url'];
	$poster_src = $poster_image['url'];

	?>
	<div class="hero-video">
		<video src="<?php echo $video_src; ?>" autoplay loop muted></video>
	</div>
<?php } ?>
