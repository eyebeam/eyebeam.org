<?php 

$name = apply_filters('the_title', $resident->post_title);
$type = get_field('resident_type', $resident->ID);
$start_year = get_field('start_year', $resident->ID);
$end_year = get_field('end_year', $resident->ID);
$image_id = get_field('image', $resident->ID);
$featured_video = get_field('featured_video', $resident->ID);
$links = get_field('links', $resident->ID);
$link_target = get_field('link_target', $resident->ID);
$permalink = get_permalink($resident->ID);
$collaboration_member = get_field('collaboration_member', $resident->ID);

// if the image id is set
if (! empty($image_id)) {
	$size = 'small';
	$image = eyebeam2018_get_image_html($image_id, $size, false);
}

?>

<!-- <div class="alumni-resident">
    <a href="<?php echo $permalink; ?>">
        <div class="alumni-resident-image">
            <?php echo $image ?>
        </div>
        <div class="alumni-resident-name">
            <?php echo $name ?>
        </div>
    </a>
</div> -->

<div class="alumni-resident clone">
    <a class="alumni-resident-link">
        <div class="alumni-resident-image">
        </div>
        <div class="alumni-resident-name">
        </div>
        <div class="alumni-resident-year">
        </div>
    </a>
</div>