var eyebeam2018 = (function($) {

	var self = {

		init: function() {
			self.setup_subscribe();
		},

		setup_subscribe: function() {
			var $form = $('#subscribe');
			$form.submit(function(e) {
				e.preventDefault();
				var args = $form.serialize();
				var url = $form.attr('action');
				$form.addClass('loading');
				$form.removeClass('success');
				$form.removeClass('error');
				$.post(url, args, function(rsp) {
					$form.removeClass('loading');
					$form.removeClass('success');
					$form.removeClass('error');
					if (rsp.ok) {
						$form.addClass('success');
					} else {
						$form.addClass('error');
					}
				});
			});
		}

	};

	$(document).ready(function() {
		self.init();
	});

	return self;

})(jQuery);
