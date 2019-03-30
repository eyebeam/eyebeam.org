<div class="module-container">
<ul>
<li id="module-calendar" class="module module-one_half">
	<div class="item-container">

	<h2 class="module-title one_half eyebeam-sans">Calendar</h2>
	<div class="datepicker">
	</div>
	</div>
</li>
<li class="module module-one_half">
	<div class="module-event">
	<?php
	$today = date('Ymd');

	$upcoming_args = array(
		'post_type' => 'event',
		'posts_per_page' => $collection_post_limit,
		'orderby'=> 'meta_value',
		'meta_key' => 'end_date',
		'order' => 'ASC',
		'meta_query' => array(
			array(
				'key'=> 'end_date',
				'value'=> $today,
				'compare'=> '>='
			),
		)
	);

	echo "<div id=\"$id\" class=\"$class\">\n";

	$posts = get_posts($upcoming_args);
	if (! empty($posts)) {
		echo "<ul>\n";

		foreach ($posts as $event) {
			$GLOBALS['eyebeam2018']['curr_collection_item'] = $event;
			get_template_part('templates/collection-event-item');
		}

		echo "</ul>\n";
		echo "<br class=\"clear\">\n";
	}
	?>
	</div>
</li>
</ul>
</div>
