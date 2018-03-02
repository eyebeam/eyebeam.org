var eyebeam2018 = (function($) {

	// This should be kept in sync with the style.css mobile breakpoint.
	var mobile_width = 856;

	var self = {

		init: function() {
			self.setup_nav();
			self.setup_subscribe();
			self.setup_items();
			self.setup_color();
			self.setup_menu();
		},

		setup_nav: function() {
			if ($('#wpadminbar').length > 0) {
				$('header').addClass('headroom');
				$(window).scroll(function() {
					var scroll = document.documentElement.scrollTop;
					var height = $('#wpadminbar').height();
					if (height > 32) {
						// Only adjust the nav bar position on mobile, where the
						// the height is 48. (20180302/dphiffer)
						var top = Math.max(0, height - scroll);
						$('header').css('top', top + 'px');
					}
				});
			}
		},

		setup_subscribe: function() {
			var $form = $('#subscribe');
			$form.submit(function(e) {
				e.preventDefault();
				self.subscribe_submit();
			});
		},

		setup_items: function() {
			self.align_items();
			$(document.body).load(self.align_items);
			$(window).resize(self.align_items);
		},

		setup_color: function() {
			var colors = ['red', 'green', 'blue'];
			var index = Math.floor(Math.random() * colors.length);
			var color = colors[index];
			$(document.body).addClass(color);
		},

		setup_menu: function() {
			$('.menu-btn').click(function() {
				$(document.body).toggleClass('show-menu');
			});
		},

		subscribe_submit: function() {
			var $form = $('#subscribe');
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
		},

		align_items: function() {

			if ($(document.body).width() <= mobile_width) {
				$('.item-container .item').css('height', 'auto');
				return;
			}

			var span = 0;
			var row = [];
			$('.item-container .item').each(function(i, item) {
				if ($(item).hasClass('one-third')) {
					span += 1;
				} else if ($(item).hasClass('two-thirds')) {
					span += 2;
				} else {
					return;
				}
				$(item).css('height', 'auto');
				if (span % 3 == 0) {
					row.push(item);
					var max_height = 0;
					for (var i = 0; i < row.length; i++) {
						if (row[i].offsetHeight > max_height) {
							max_height = row[i].offsetHeight;
						}
					}
					for (var i = 0; i < row.length; i++) {
						$(row[i]).css('height', max_height + 'px');
					}
					row = [];
				} else {
					row.push(item);
				}
			});
		}

	};

	$(document).ready(function() {
		self.init();
	});

	return self;

})(jQuery);
