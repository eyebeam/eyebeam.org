<?php

echo "This part is still a work in progress...";
exit;

global $post, $current_bid;
session_start();

$minimum_bid = array(
    'bidder_id' => null,
    'name' => 'minimum bid',
    'email' => null,
    'min_amount' => 1000,
    'max_amount' => 1000,
    'ip_addr' => null,
    'user_agent' => null,
    'verified' => true,
    'created' => $post->post_date
);
$bid_increment = 10;

the_post();
$feedback = array();

$minimum_bid['min_amount'] = get_field('minimum_bid');
$minimum_bid['max_amount'] = get_field('minimum_bid');

$current_bid = $minimum_bid;

if (! empty($_GET['v'])) {
    if (auction_verify_id($_GET['v'])) {
        auction_mark_bids_as_verified($_GET['v']);
        $_SESSION['auction_bidder_id'] = strtolower($_GET['v']);
        $feedback[] = "Your email address has been verified and your bid on this artwork will now be counted.";
    } else {
        $feedback[] = "Sorry, we could not verify your email address.";
    }
}

$bids = get_post_meta($post->ID, 'auction_bids');

foreach ($bids as $bid) {
    if (auction_is_leading_bid($current_bid, $bid)) {
        $current_bid = $bid;
    }
}

$new_bid = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['name'])) {
        $feedback[] = 'Please write a name.';
    } else {
        $_SESSION['auction_name'] = $_POST['name'];
    }
    if (empty($_POST['email'])) {
        $feedback[] = 'Please write an email address.';
    } else {
        $_SESSION['auction_email'] = $_POST['email'];
    }
    if (empty($_POST['amount'])) {
        $feedback[] = 'Please include a bid amount.';
    }
    if (floatval($_POST['amount']) <= floatval($current_bid['amount'])) {
        $feedback[] = 'Please bid an amount greater than the current bid.';
    }
    if (empty($feedback)) {

        $name = $_POST['name'];
        $email = auction_normalize_email($_POST['email']);
        $verified = auction_is_verified($email);

        $new_bid = array(
            'bidder_id' => null,
            'name' => $name,
            'email' => $email,
            'amount' => floatval($_POST['amount']),
            'ip_addr' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'verified' => $verified,
            'created' => current_time('mysql')
        );

        if (auction_is_leading_bid($current_bid, $new_bid)) {
            $current_bid = $new_bid;
        }

        if (! empty($_SESSION['auction_bidder_id'])) {
            $new_bid['bidder_id'] = $_SESSION['auction_bidder_id'];
        } else {
            $bidder_id = auction_send_verification($email);
            $new_bid['bidder_id'] = $bidder_id;
            $option_key = "auction_$email";
            update_option($option_key, array(
                'id' => $bidder_id,
                'name' => $name,
                'email' => $email,
                'verified' => false
            ), false);
            $feedback[] = "We've received your bid, but must confirm your email address before it will be counted: $bidder_id";
        }
        update_post_meta($post->ID, 'auction_bids', $new_bid);
    }
}

get_header();

add_filter('pre-post_content', function($content) use ($feedback) {
    if (! empty($feedback)) {
        echo "<div class=\"auction-feedback\"><ul>\n";
        foreach ($feedback as $msg) {
            echo "<li>$msg</li>\n";
        }
        echo "</ul></div>\n";
    }
});

add_filter('post-post_content', function($content) {
    get_template_part("templates/auction-bids");
});

get_template_part("templates/post");

get_footer();

?>
