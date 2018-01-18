<?php

global $resident_count;

if (empty($resident_count)) {
	$resident_count = 0;
}

$image = get_field('image');
$specific_date = eyebeam2018_compare_resident_year(get_the_ID());
$grossHackUrl = get_field('name');
$lessGross = substr($grossHackUrl, strrpos($grossHackUrl, '<a href="' )+9) ;
$cleanUrl = substr($lessGross, 0, strrpos($lessGross, '">' )); ?>

<a href="<?php echo $cleanUrl; ?>" target="_blank" class="resident">
	<?php if(!empty($image)) : ?>
		<span class="residentMugShot" style="background-image:url('<?php echo $image['url']; ?>')"></span>
	<?php else: ?>
		<span class="residentMugShot" style="background-color:black;color:white;"></span>
		<span style="text-align: center;position: absolute;margin-top: -60px;color: white;width: 16%;">no photo</span>
	<?php endif; ?>

	<?php if($specific_date) : ?>
		<span class="residencyDateRange"><?php echo $specific_date ; ?></span>
<?php endif; ?>

	<span class="residentName"> <?php echo the_title(); ?> </span>
	<span class="residentType"><?php echo get_field('resident_type'); ?> </span>
</a>

<?php
	$resident_count++;
	if ($resident_count % 5 == 0): ?>
	<div class="clearingSpacer"></div>
	<?php endif; ?>
