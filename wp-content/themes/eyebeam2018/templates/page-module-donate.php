<div id="module-donate" class="module module-donate module-full_width">
	<form action="/wp-admin/admin-ajax.php?action=eyebeam2018_donate" method="post" id="donate">
		<div class="fields">
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
			<label for="card-stripe">
				Card details
			</label>
			<div id="card-stripe"></div>
			<div id="card-errors" role="alert"></div>
			<div class="response-loading">
				Please wait...
			</div>
			<div class="response-error">
				Sorry, that didn’t work for some reason. Contact <a href="mailto:info@eyebeam.org">info@eyebeam.org</a> if you have any problems
			</div>
			<input type="submit" value="Donate">
		</div>
		<div class="response-success">
			Thanks for your donation—<a href="/events/">visit Eyebeam here</a>.
		</div>

	</form>
</div>
