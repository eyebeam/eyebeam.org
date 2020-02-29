<?php

session_start();

$feedback = array();

if (! empty($_GET['v'])) {
	$feedback = auction_check_id($_GET['v']);
}

//$_SESSION['auction_bidder_id'] = null;
//dbug("current session id: {$_SESSION['auction_bidder_id']}");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$feedback = auction_post_feedback();
	if (empty($feedback)) {
		$feedback = auction_create_bid();
	}
}

get_header();

add_filter('auction_feedback', function($content) use ($feedback) {
	if (! empty($feedback)) {
		echo "<div class=\"auction-feedback\"><ul>\n";
		foreach ($feedback as $msg) {
			echo "<li>$msg</li>\n";
		}
		echo "</ul></div>\n";
	}
});

get_template_part("templates/auction-main");

get_footer();

?>
