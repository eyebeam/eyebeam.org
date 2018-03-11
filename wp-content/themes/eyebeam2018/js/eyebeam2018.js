var eyebeam2018 = (function($) {

	// This should be kept in sync with the style.css mobile breakpoint.
	var mobile_width = 856;

	// For handling donations
	var stripe_card = null;

	var self = {

		init: function() {
			self.setup_nav();
			self.setup_subscribe();
			self.setup_modules();
			self.setup_color();
			self.setup_menu();
			self.setup_bio_toggle();
			self.setup_hash();
			self.setup_residents();
			self.setup_archive();
			self.setup_donate();
			self.setup_lazy_load();
		},

		setup_nav: function() {
			if ($('#wpadminbar').length > 0) {
				$('header').addClass('headroom');
				$('.subnav').addClass('headroom');
				$(window).scroll(function() {
					var scroll = document.documentElement.scrollTop;
					var height = $('#wpadminbar').height();
					if (height > 32) {
						// Only adjust the nav bar position on mobile, where the
						// the height is 48. (20180302/dphiffer)
						var top = Math.max(0, height - scroll);
						$('header').css('top', top + 'px');
					}
					var offset = $('header nav').height() + 10;
					offset += parseInt($('header').css('top'));
					offset += height;
					var toc_top = $('.module-toc').offset().top;
					var toc_bottom = toc_top + $('.module-toc').height();
					if (scroll + offset > toc_bottom) {
						$(document.body).addClass('show-subnav');
					} else {
						$(document.body).removeClass('show-subnav');
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

		setup_modules: function() {
			self.align_modules();
			$(window).resize(self.align_modules);
			setInterval(self.align_modules, 1000);
		},

		setup_color: function() {
			var colors = ['red', 'green', 'blue'];
			$('header, .subnav, footer, .module, .module-collection li').each(function(i, el) {
				var index = Math.floor(Math.random() * colors.length);
				var color = colors[index];
				$(el).addClass(color);
			});
		},

		setup_menu: function() {
			$('.menu-btn').click(function() {
				$(document.body).toggleClass('show-menu');
			});
		},

		setup_bio_toggle: function() {
			$('.toggle-bio').click(function(e) {
				e.preventDefault();
				$(e.target).closest('li').toggleClass('show-bio');
				self.align_modules();
			});
		},

		setup_hash: function() {
			self.check_hash();
			window.addEventListener('hashchange', function() {
				self.check_hash();
			}, false);
		},

		setup_residents: function() {
			if ($('#residents-year select').length < 1) {
				return;
			}
			var select = $('#residents-year select')[0];
			var first_year = select.options[0].value;
			$('#residents-year select').val(first_year);
			$('#residents-year select').change(function(e) {
				var year = $('#residents-year select').val();
				year = parseInt(year);
				var path = '/wp-admin/admin-ajax.php';
				var args = '?action=eyebeam2018_residents&year=' + year;
				$('#module-residents ul').html('Loading...');
				$('#module-residents ul').addClass('loading');
				$.get(path + args, function(rsp) {
					$('#module-residents ul').removeClass('loading');
					$('#module-residents ul').html(rsp);
					self.setup_bio_toggle();
				});
			});
		},

		setup_archive: function() {
			if ($('.archive').length == 0) {
				return;
			}
			if ($(document.body).width() <= mobile_width) {
				return;
			}
			self.archive_scroll();
			$(window).scroll(self.archive_scroll);
		},

		setup_donate: function() {
			if ($('#donate').length < 1) {
				return;
			}

			$('.donation-amount input').change(function(e) {
				if ($('#show-other')[0].checked) {
					$('#amount-other-container').removeClass('hidden');
				} else {
					$('#amount-other-container').addClass('hidden');
				}
			});
			$('#donate').submit(function(e) {
				e.preventDefault();
				self.donate_submit();
			});

			if (typeof stripe == 'undefined') {
				if (location.protocol == 'http:') {
					window.location = 'https://' + location.host + location.pathname;
					return;
				} else {
					console.error('Could not find Stripe.js, set the following in wp-config.php: STRIPE_TEST_KEY, STRIPE_TEST_SECRET, STRIPE_LIVE_KEY, STRIPE_LIVE_SECRET, STRIPE_USE_LIVE');
					$('#donate').html('Sorry, we cannot accept donations right now.');
					return;
				}
			}

			var elements = stripe.elements();
			var style = {
				base: {
					fontSize: '18px',
					fontFamily: '"ArialMonospacedMTStd", monospace'
				}
			};

			stripe_card = elements.create('card', {style: style});
			stripe_card.mount('#card-stripe');

			stripe_card.addEventListener('change', function(event) {
				var displayError = document.getElementById('card-errors');
				if (event.error) {
					displayError.textContent = event.error.message;
				} else {
					displayError.textContent = '';
				}
			});

			$('#amount-50')[0].checked = true;
		},

		setup_lazy_load: function() {
			$('.lazy-load').click(function(e) {
				e.preventDefault();
				var $btn = $(e.target);
				if ($btn.hasClass('loading')) {
					return;
				}
				$btn.html('Loading&hellip;');
				$btn.addClass('loading');
				var page = $btn.data('page');
				page = parseInt(page);
				page++;
				$btn.data('page', page);
				page = '&page=' + page;
				var base = '/wp-admin/admin-ajax.php';
				var action = 'action=eyebeam2018_lazy_load';
				var load = $btn.data('load');
				var load_arg = '&load=' + load;
				var args = action + load_arg + page;
				var url = base + '?' + args;
				$.ajax(url, {
					success: function(rsp) {
						$btn.html('Load more');
						var $ul = $('#' + load + '-list');
						$ul.append(rsp);
						$btn.removeClass('loading');
					},
					error: function() {
						$btn.html('Error loading more.');
					}
				});

			});
		},

		archive_scroll: function() {
			var scroll = document.documentElement.scrollTop;
			var nav = 99;
			if ($('#wpadminbar').length > 0) {
				nav += $('#wpadminbar').height();
			}
			var offset = Math.floor($(window).height() / 4);

			var curr = null;
			var curr_index = null;
			$('.featured').each(function(i, featured) {
				if (curr) {
					return;
				}
				var top = $(featured).offset().top;
				var bottom = top + $(featured).height();
				if (bottom > scroll + nav + offset) {
					curr = featured;
					curr_index = i;
				}
			});

			if ($('.featured.current').length > 0) {
				var curr_id = $('.featured.current').attr('id');
				if (curr_id != $(curr).attr('id')) {
					$('.featured.current').removeClass('current');
					$(curr).addClass('current');
				}
			} else {
				$(curr).addClass('current');
			}

			var top = $(curr).offset().top;
			var bottom = top + $(curr).height();

			var $media = $(curr).find('.featured-media');
			var fixed_threshold = top + $(curr).height() - $media.height() + 20;

			if (scroll + nav > fixed_threshold) {
				$('.archive').removeClass('fixed-media');
				$media.css('top', 'auto');
				$media.css('bottom', 0);
			} else if (scroll + nav > top) {
				var width = $media.width();
				$media.css('top', nav);
				$media.css('bottom', 'auto');
				$media.css('width', width);
				$('.archive').addClass('fixed-media');
			} else {
				$('.archive').removeClass('fixed-media');
				$media.css('top', 'auto');
			}

		},

		check_hash: function() {

			if (location.hash == '') {
				return;
			}

			var module = location.hash.substr(1);
			if ($('#module-' + module).length > 0) {

				$('#module-' + module)[0].scrollIntoView(true);

				// now account for fixed header
				var scroll_y = window.scrollY;
				if (scroll_y) {
					var offset = $('header nav').height() + 10;
					offset += parseInt($('header').css('top'));
					if ($(document.body).hasClass('show-subnav')) {
						offset += $('.subnav').height();
					}
					window.scroll(0, scroll_y - offset);
				}
			}
		},

		subscribe_submit: function() {
			var $form = $('#subscribe');
			var args = $form.serialize();
			var url = $form.attr('action');
			$form.addClass('loading');
			$form.removeClass('success');
			$form.removeClass('error');
			$.ajax(url, {
				method: 'POST',
				data: args,
				success: function(rsp) {
					$form.removeClass('loading');
					$form.removeClass('success');
					$form.removeClass('error');
					if (rsp.ok) {
						$form.addClass('success');
					} else {
						$form.addClass('error');
					}
				},
				error: function() {
					$form.removeClass('loading');
					$form.removeClass('success');
					$form.addClass('error');
				}
			});
		},

		donate_submit: function() {

			//console.log('donate_submit');

			var $form = $('#donate');
			$form.addClass('loading');
			$form.removeClass('success');
			$form.removeClass('error');

			stripe.createToken(stripe_card).then(function(result) {
				//console.log('createToken callback', result);

				if (result.error) {
					$('#card-errors').html(result.error.message);
				} else {
					self.donate_request(result.token);
				}
			});
		},

		donate_request: function(token) {

			//console.log('donate_request', token);

			var $form = $('#donate');
			var args = $form.serialize();
			args += '&token=' + token.id;
			var url = $form.attr('action');

			$.ajax(url, {
				method: 'POST',
				data: args,
				success: function(rsp) {
					//console.log('request success', rsp);
					$form.removeClass('loading');
					$form.removeClass('success');
					$form.removeClass('error');
					if (rsp.ok) {
						$form.addClass('success');
					} else {
						$form.addClass('error');
					}
				},
				error: function() {
					//console.log('request error');
					$form.removeClass('loading');
					$form.removeClass('success');
					$form.addClass('error');
				}
			});
		},

		align_modules: function() {

			var selector = '.module, .collection-item';

			if ($(document.body).width() <= mobile_width) {
				$(selector).css('height', 'auto');
				return;
			}

			var span;
			var row;

			$('ul').each(function(i, ul) {

				span = 0;
				row = [];

				$(ul).find(selector).each(function(i, module) {

					// We are working off of a 12-column grid

					if ($(module).hasClass('module-one_third')) {
						span += 4;
					} else if ($(module).hasClass('module-one_half') ||
					           $(module).hasClass('press-release')) {
						span += 6;
					} else if ($(module).hasClass('module-two_thirds')) {
						span += 8;
					} else if ($(module).hasClass('resident') ||
					           $(module).hasClass('event')) {
						span += 4;
					} else {
						return;
					}

					$(module).css('height', 'auto');

					if (span % 12 == 0) {

						row.push(module);

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
						row.push(module);
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
