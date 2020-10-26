<?php

$staff = $GLOBALS['eyebeam2018']['curr_collection_item'];

$name = apply_filters('the_title', $staff->post_title);
$bio = get_field('staff_bio', $staff->ID);
$title = get_field('staff_title', $staff->ID);
$image_id = get_field('staff_image', $staff->ID);

$image = '';
if (! empty($image_id)) {
	$size = 'thumbnail';
	$image = eyebeam2018_get_image_html($image_id, $size, 'staff-image toggle-bio');
}

echo "<li class=\"staff\">\n";
echo "<a data-micromodal-open=\"modal-$image_id\" href=\"#\" class=\"toggle-bio img\">$image</a>\n";
echo "<h3 class=\"staff-name module-title toggle-bio\"><a aria-label=\"Click Here to Toggle Their Bio\" href=\"#\">$name</a></h3>\n";
echo "<h4 class=\"staff-title person-title module-title\">$title</h4>\n";
echo "<div class=\"bio staff-bio\">$bio</div>\n";
echo "</li>\n";

echo "<div class=\"modal micromodal-slide\" id=\"modal-$image_id\" aria-hidden=\"true\">

				<!-- [2] -->
				<div tabindex=\"-1\" data-micromodal-close>

					<!-- [3] -->
					<div role=\"dialog\" aria-modal=\"true\" aria-labelledby=\"modal-1-title\" >

						<header>
							<!-- [4] -->
							<a href=\"#\" aria-label=\"Close modal\" data-micromodal-close>[Close]</a>
						</header>

						<div id=\"modal-1-content\" class=\"modal-content\">
							$image
							<div style=\"flex: 1 0 100%;\">
								$name
							</div>
							<div style=\"flex: 1 0 100%;\">
								$title
							</div>
							<div>
								$bio
							</div>
						</div>

					</div>
				</div>
			</div>";

?>
