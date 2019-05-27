<?php

$bid_increment = 25;

$minimum_bid = array(
    'bidder_id' => null,
    'name' => 'minimum bid',
    'email' => null,
    'amount' => 975,
    'ip_addr' => null,
    'user_agent' => null,
    'verified' => true,
    'created' => $post->post_date
);

?>
<div class="auction-artwork">
	<div class="module-title">
		<h3 class="eyebeam-sans"><?php the_title(); ?></h3>
	</div>
	<?php if (is_page_template('Auction')) { ?>
		<a href="<?php the_permalink(); ?>">Read bio</a>
	<?php } else { ?>
	<div class="auction-artwork-artist-bio">
		<h4>Artist bio</h4>
		<?php the_field('artist_bio'); ?>
	</div>
	<?php } ?>
	<div class="auction-artwork-description">
		<h4>Artwork description</h4>
		<?php the_content(); ?>
	</div>
	<form action="<?php echo get_permalink($post); ?>" method="post" class="auction-bids">
		<?php $current_bid = $minimum_bid; ?>
		<h4>Bid on this artwork</h4>
		<fieldset>
			<strong>Current bid</strong><br>
			<em>Be the first to bid on this!</em>
		</fieldset>
		<fieldset>
			<strong>Place a bid</strong><br>
			<label for="amount">Maximum bid amount</label>
			<div class="bid-amount">
				<input type="number" name="amount" step="<?php echo $bid_increment; ?>" value="<?php auction_next_amount($current_bid['amount']); ?>" id="amount">
			</div>
			<div class="help">Your bid amount will increase in $<?php echo $bid_increment; ?> increments until the maximum is reached.</div>
			<label for="name">Your name</label>
			<input type="text" name="name" value="<?php auction_name(); ?>">
			<label for="email">Email</label>
			<input type="email" name="email" value="<?php auction_email(); ?>">
		</fieldset>
		<button type="submit">Place bid</button>
	</form>
</div>
