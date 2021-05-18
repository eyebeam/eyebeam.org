<?php

$release = $GLOBALS['eyebeam2018']['current_page_item'];

$title = get_field('title', $release->ID);
$date = get_field('date', $release->ID);
$image_id = get_field('image', $release->ID);

$date = date('F j, Y', strtotime($date));
$image = eyebeam2018_get_image_html($image_id, 'medium', 'press-release-image');

$summary = get_field('summary', $release->ID); 

$page = get_field('media_release_page', $release->ID);

?>


<li class="media-release">

    <a class="media-release-image image" href="<?php echo get_permalink($page[0]); ?>">
        <?php echo $image; ?>
    </a>

    <h3 class="media-release-heading">
        <a href="<?php echo get_permalink($page[0]); ?>">
            <?php echo $release->post_title; ?>
        </a>
    </h3>
    <p>
        <?php echo $summary; ?>
    </p>

</li>