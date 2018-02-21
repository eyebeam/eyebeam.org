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
				$.post(
			});
		}

	};

	$(document).ready(function() {
		self.init();
	});

	return self;

})(jQuery);
