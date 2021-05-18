<?php

$release = $GLOBALS['eyebeam2018']['current_page_item'];
$image_id = get_field('image', $release->ID);
$image = eyebeam2018_get_image_html($image_id, 'medium', 'press-release-image');

$link = get_field('link', $release->ID);
$link_url = get_field('link_url', $release->ID);

?>


<li class="press-release">

    <a class="press-release-image image" href="<?php echo $link_url; ?>">
        <?php echo $image; ?>
    </a>

    <h3 class="press-release-heading">
        <a href="<?php echo $link_url; ?>">
            <?php echo $release->post_title; ?>
        </a>
    </h3>
    <p>
        <?php echo $summary; ?>
    </p>

</li>