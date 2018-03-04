<div class="module module-donate module-full_width">
	<form action="/wp-admin/admin-ajax.php?action=eyebeam2018_donate" method="post" id="donate">
		<label for="first-name">
			First name
		</label>
		<input type="text" name="first_name" id="first-name">
		<label for="last-name">
			Last name
		</label>
		<input type="text" name="last_name" id="last-name">
		<label for="email">
			Email address
		</label>
		<input type="email" name="email" id="email">
		<label for="amount-50">
			I would like to give:
		</label>
		<div id="amount-holder">
			<div class="donation-amount">
				<input type="radio" id="amount-25" name="amount" value="25"><label for="amount-25">$25</label>
			</div>
			<div class="donation-amount">
				<input type="radio" id="amount-50" name="amount" value="50" checked="checked"><label for="amount-50">$50</label>
			</div>
			<div class="donation-amount">
				<input type="radio" id="amount-100" name="amount" value="100"><label for="amount-100">$100</label>
			</div>
			<div class="donation-amount">
				<input type="radio" id="amount-150" name="amount" value="150"><label for="amount-150">$150</label>
			</div>
			<div class="donation-amount">
				<input type="radio" id="amount-200" name="amount" value="200"><label for="amount-200">$200</label>
			</div>
			<div class="donation-amount">
				<input type="radio" id="show-other" name="amount" value="other"><label for="show-other">Other</label>
			</div>
			<div id="amount-other-container" class="hidden">
				<input type="text" name="amount_other" id="amount-other" placeholder="$500">
			</div>
		</div>
		<label for="card-name">
			Cardholder name
		</label>
		<input type="text" name="card_name" id="card-name">
		<label for="card-number">
			Card number
		</label>
		<input type="text" name="card_number" id="card-number">
		<label for="card-exp-month">
			Expiration date
		</label>
		<select name="card_exp_month" id="card-exp-month">
			<option value="">Month</option>
			<option>01</option>
			<option>02</option>
			<option>03</option>
			<option>04</option>
			<option>05</option>
			<option>06</option>
			<option>07</option>
			<option>08</option>
			<option>09</option>
			<option>10</option>
			<option>11</option>
			<option>12</option>
		</select>
		<select name="card_exp_year" id="card-exp-year">
			<option value="">Year</option>
			<?php

			$start = date('Y');
			$end = $start + 20;
			for ($y = $start; $y <= $end; $y++) {
				echo "<option>$y</option>\n";
			}

			?>
		</select>
		<label for="card-security-code">
			Security code
		</label>
		<input type="text" name="number" name="card_security_code" id="card-security-code" size="3">
		<input type="submit" value="Donate">
		<div class="response-loading">
			Please wait...
		</div>
		<div class="response-success">
			Thank you so much for your donation!
		</div>
		<div class="response-error">
			Sorry, that didn’t work for some reason.
		</div>
	</form>
</div>
