var eyebeam2018 = (function ($) {

	// This should be kept in sync with the style.css mobile breakpoint.
	var mobile_width = 1025;

	// For handling donations
	var stripe_card = null;
	var enable_autocrop = true;

	let alumniArchive = {
		residentType: false,
	}

	var self = {

		// state for the alumni archive
		alumniArchive: {
			per_page: 8,
			page: 1,
			residentType: 'all',
			searchQuery: '',
			nameSort: 'asc',
			sortByName: false,
			dateSort: 'desc',
			sortByDate: true,
			view: 'image',
		},
		init: function () {
			self.setup_nav();
			// self.setup_subscribe();
			// self.setup_modules();
			self.setup_random_footer();
			self.setup_link();
			self.setup_menu();
			self.setup_bio_toggle();
			self.setup_hash();
			self.setup_residents();
			self.setup_archive();
			self.setup_donate();
			// self.setup_autocrop();
			self.setup_searchform();
			// self.setup_logo();
			// self.setup_alt_text();
			self.setup_blog_labels();
			self.setup_calendar();
			self.setup_carousel();
			self.setup_lazy_load();
			// self.setup_masonry();
			// self.setup_bricks();

			if ($(window).width() > mobile_width) {
				self.setup_micromodal();
			}

			if ($("body").hasClass("page-template-page-alumni-archive")){
				self.setup_alumni_archive();
			}

		},
		setup_nav: function () {
			if ($('#wpadminbar').length > 0) {
				$('header').addClass('headroom');
				$('.subnav').addClass('headroom');
			}

			$(window).scroll(function () {

				var height = 0;
				var scroll = document.documentElement.scrollTop;
				// if ($('#wpadminbar').length > 0) {
				// 	height = $('#wpadminbar').height();
				// 	if (height > 32) {
				// 		// Only adjust the nav bar position on mobile, where the
				// 		// the height is 48. (20180302/dphiffer)
				// 		var top = Math.max(0, height - scroll);
				// 		$('header').css('top', top + 'px');
				// 	}
				// }

				if ($('.module-toc').length == 0) {
					return;
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

			$("li.menu-item-has-children > a").click(function (event) {

				event.preventDefault();

				if ($(window).width() >= mobile_width) {
					// set defaults
					var navHeight = 60;
					var subNavHeight = 0;

					// find how many children links there are
					var childCount = $(this).parent().find(".sub-menu").children().length;
					subNavHeight = 32 * (childCount + 1);

					if ($(this).parent().hasClass("show-sub-menu")) {

						$("nav").css("height", navHeight);
						$(this).parent().find(".sub-menu").css("height", 0);
						$(this).parent().toggleClass("show-sub-menu");

					} else {

						$(".show-sub-menu").removeClass("show-sub-menu");

						$(".sub-menu").css("height", 0).delay(1000);
						$("nav").css("height", navHeight);

						console.log('subNavHeight');
						console.log(subNavHeight);
						console.log('navHeight');
						console.log(navHeight);
						$("nav").css("height", subNavHeight + navHeight);
						$(this).parent().find(".sub-menu").css("height", subNavHeight);

						$(this).parent().toggleClass("show-sub-menu");
					}
				}
				else {
					// console.log($(this).hasClass("show-sub-menu"));
					if ($(this).hasClass("show-sub-menu")) {
						$(this).removeClass("show-sub-menu").parent().find(".sub-menu").css("height", 0);
					} else {

						var childCount = $(this).parent().find(".sub-menu").children().length;
						$(this).addClass("show-sub-menu").parent().find(".sub-menu").css("height", (childCount * 32));
					}

				}

			});
		},

		setup_subscribe: function () {
			var $form = $('#subscribe');
			$form.submit(function (e) {
				e.preventDefault();
				self.subscribe_submit();
			});
		},

		setup_modules: function () {
			self.align_modules();
			$(window).resize(self.align_modules);
			setInterval(self.align_modules, 1000);
		},

		//the old code which randomizes link colors
		setup_color: function () {
			var colors = ['red', 'green', 'blue'];
			$('header, .subnav, footer, .module, .module-collection li').each(function (i, el) {
				var index = Math.floor(Math.random() * colors.length);
				var color = colors[index];
				$(el).addClass(color);
			});
		},

		//new code that only randomizes the color of the footer background
		setup_random_footer: function () {
			var colors = ['red', 'green', 'blue'];
			$('footer').each(function (i, el) {
				var index = Math.floor(Math.random() * colors.length);
				var color = colors[index];
				$(el).addClass(color);
			});
		},


		//new code that makes all links one color except for the footer
		setup_link: function () {
			$('header, .subnav, .module, .moodule-colleciton li').each(function (i, el) {
				var color = 'red';
				$(el).addClass(color);
			});
		},



		setup_menu: function () {
			$('.btn-anchor, .btn-anchor-icon').click(function (e) {
				$(document.body).toggleClass('show-menu');
				if ($(document.body).hasClass('show-menu')) {
					$(".btn-anchor:first-child").attr("aria-label", "Click this Button to Hide the Menu");
					$(".btn-anchor:first-child").html("Click to Hide the Menu");
				}
				else {
					$(".btn-anchor:first-child").attr("aria-label", "Click this Button to Show the Menu");
					$(".btn-anchor:first-child").html("Click to Show the Menu");
				}
				e.preventDefault();
			});
		},

		setup_bio_toggle: function () {
			if ($("body").hasClass("page-id-8700") && $(window).width() > mobile_width) {
				return;
			}
			else {
				$('.toggle-bio').click(function (e) {
					e.preventDefault();
					$(e.target).closest('li').toggleClass('show-bio');
					self.align_modules();
				});
			}

		},

		setup_hash: function () {
			self.check_hash();
			window.addEventListener('hashchange', function () {
				self.check_hash();
			}, false);
		},

		setup_residents: function () {
			// if ($('#residents-year select').length < 1) {
			// 	return;
			// }

			// var select = $('#residents-year select')[0];
			//
			// // choose the second option (the current year)
			// var first_year = select.options[1].value;
			// $('#residents-year select').val(first_year);
			//
			// $('#residents-year select').change(function(e) {
			// 	console.log('year changed');
			// 	var year = $('#residents-year select').val();
			// 	var path = '/wp-admin/admin-ajax.php';
			// 	var args = '?action=eyebeam2018_residents&year=' + year;
			// 	$('#module-alumni ul').html('Loading...');
			// 	$('#module-alumni ul').addClass('loading');
			// 	$.get(path + args, function(rsp) {
			// 		console.log(rsp);
			// 		$('#module-alumni ul').removeClass('loading');
			// 		$('#module-alumni ul').html(rsp);
			// 		window.macyInstance.runOnImageLoad(function(){
			// 			window.macyInstance.recalculate(true);
			// 		});
			// 		self.setup_bio_toggle();
			// 	});
			// });
		},

		setup_archive: function () {
			if ($('.archive').length == 0) {
				return;
			}
			if ($(document.body).width() <= mobile_width) {
				return;
			}
			self.archive_scroll();
			$(window).scroll(self.archive_scroll);
		},

		setup_donate: function () {

			if ($('#donate').length < 1) {
				return;
			}

			$('.donation-amount input').change(function (e) {
				if ($('#show-other')[0].checked) {
					$('#amount-other-container').removeClass('hidden');
				} else {
					$('#amount-other-container').addClass('hidden');
				}
			});

			$('#donate').submit(function (e) {
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

			stripe_card = elements.create('card', { style: style });
			stripe_card.mount('#card-stripe');

			stripe_card.addEventListener('change', function (event) {
				var displayError = document.getElementById('card-errors');
				if (event.error) {
					displayError.textContent = event.error.message;
				} else {
					displayError.textContent = '';
				}
			});

			$('#amount-50')[0].checked = true;
		},
		//
		// setup_autocrop: function(resize) {
		//
		// 	var has_module_residents = $('#module-residents').length;
		//
		// 	if (enable_autocrop && has_module_residents){
		//
		// 		$("#module-residents a.image").each(function(){
		//
		// 			if (!$(this).hasClass("cropped") || resize){
		// 				// define terms
		// 				var thisImg = $(this).find("img");
		// 				var width = thisImg.attr("width");
		// 				var height = thisImg.attr("height");
		//
		// 				var thisImgRatio = height / width;
		// 				// console.log(thisImg);
		// 				// console.log(height);
		// 				// console.log(height/width);
		// 				// console.log(height / thisImgRatio);
		// 				// console.log('-------------');
		//
		// 				// find the image attributes and assign the container a height
		//
		// 				$(this).css("height", $(this).innerWidth());
		//
		// 				if (thisImgRatio < 1){
		//
		// 					// assign the background image to the anchor container
		// 					$(this).css({
		// 						"background-image": "url("+thisImg.attr("src")+")",
		// 						"background-size": (width / thisImgRatio)+"px",
		// 					});
		// 					$(this).addClass("cropped");
		//
		// 				}
		// 				else {
		// 					// assign the background image to the anchor container
		// 					$(this).css({
		// 						"background-image": "url("+thisImg.attr("src")+")",
		// 						"background-size": "100%",
		// 					});
		// 				}
		//
		//
		// 				// hide the link image element
		// 				thisImg.hide();
		//
		// 				// $(this).parent(".item-container").css("background-image", thisImg.attr("src"));
		// 			}
		// 		});
		// 	}
		// },

		setup_searchform: function () {
			$(".search-btn").on('click', function (e) {
				console.log('search clicked');
				$("header").toggleClass("show-search");
				e.preventDefault();
			});
		},

		archive_scroll: function () {
			var scroll = document.documentElement.scrollTop;
			var nav = 99;
			if ($('#wpadminbar').length > 0) {
				nav += $('#wpadminbar').height();
			}
			var offset = Math.floor($(window).height() / 4);

			var curr = null;
			var curr_index = null;
			$('.featured').each(function (i, featured) {
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

		check_hash: function () {

			if (location.hash == '') {
				return;
			}

			var module = location.hash.substr(1);
			if ($('#module-' + module).length > 0) {

				if (self.last_hash == module) {
					return;
				}
				self.last_hash = module;

				$('#module-' + module)[0].scrollIntoView(true);

				// now account for fixed header
				var scroll_y = window.scrollY;
				if (scroll_y) {
					var offset = $('header nav').height() + 10;
					offset += parseInt($('header').css('top'));
					if ($('.subnav').length > 0) {
						offset += $('.subnav').height();
					}
					console.log('scroll: ' + scroll_y - offset);
					window.scroll(0, scroll_y - offset);
				}
			}
		},

		subscribe_submit: function () {
			var $form = $('#subscribe');
			var args = $form.serialize();
			var url = $form.attr('action');
			$form.addClass('loading');
			$form.removeClass('success');
			$form.removeClass('error');
			$.ajax(url, {
				method: 'POST',
				data: args,
				success: function (rsp) {
					$form.removeClass('loading');
					$form.removeClass('success');
					$form.removeClass('error');
					if (rsp.ok) {
						$form.addClass('success');
					} else {
						$form.addClass('error');
					}
				},
				error: function () {
					$form.removeClass('loading');
					$form.removeClass('success');
					$form.addClass('error');
				}
			});
		},

		donate_submit: function () {

			//console.log('donate_submit');

			if ($('#donate').hasClass('loading')) {
				return;
			}

			var $form = $('#donate');
			$form.addClass('loading');
			$form.removeClass('success');
			$form.removeClass('error');

			stripe.createToken(stripe_card).then(function (result) {
				//console.log('createToken callback', result);
				if (result.error) {
					$('#donate').removeClass('loading');
					$('#card-errors').html(result.error.message);
				} else {
					self.donate_request(result.token);
				}
			});
		},

		donate_request: function (token) {

			//console.log('donate_request', token);

			var $form = $('#donate');
			var args = $form.serialize();
			args += '&token=' + token.id;
			var url = $form.attr('action');

			$('#donate input').attr('disabled', null);

			$.ajax(url, {
				method: 'POST',
				data: args,
				success: function (rsp) {
					//console.log('request success', rsp);
					$form.removeClass('loading');
					$form.removeClass('success');
					$form.removeClass('error');
					if (rsp.ok) {
						$form.addClass('success');
						window.location = '#donate';
						self.last_hash = null;
						self.check_hash();
					} else {
						if (rsp.error) {
							$('#donate .response-error').html(rsp.error);
						} else {
							$('#donate .response-error').html('Sorry, that didn’t work for some reason.');
						}
						$form.addClass('error');
					}
					$('#donate').removeClass('loading');
					$('#donate input').attr('disabled', null);
				},
				error: function () {
					//console.log('request error');
					$('#donate').removeClass('loading');
					$('#donate input').attr('disabled', null);
					$form.removeClass('loading');
					$form.removeClass('success');
					$form.addClass('error');
				}
			});
		},

		align_modules: function () {

			var selector = '.module, .collection-item';

			if ($(document.body).width() <= mobile_width) {
				$(selector).css('height', 'auto');
				return;
			}

			var span;
			var row;

			$('ul').each(function (i, ul) {

				span = 0;
				row = [];

				$(ul).find(selector).each(function (i, module) {

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

					//var height = $(module).height();
					//$(module).css('height', height);

					if (span % 12 == 0) {

						row.push(module);

						var max_height = 0;
						var $container = null;
						for (var i = 0; i < row.length; i++) {
							$container = $(row[i]).find('.item-container');
							console.log($container);
							if ($container.length > 0 &&
								$container[0].offsetHeight > max_height) {
								max_height = $container[0].offsetHeight;
								// console.log("maxheight:");
								// console.log(max_height);
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
		},
		setup_logo: function () {

			var logoContainer = $(".logo-container");
			var eyebeam1Ratio = 207 / 1067;
			var eyebeam2Ratio = 853 / 1067;
			var eyebeam3Ratio = 6947 / 1067;

			$(document).ready(function () {

				// set some constants (once this has been established )
				var documentHeight = $('body').height();
				var documentWidth = $('body').width();

				// get initial scroll position
				var scroll = Math.max(window.pageYOffset, document.documentElement.scrollTop, document.body.scrollTop);


				// do the actual setting
				// var eyebeam1Height = ( (documentWidth/100) * 7) * eyebeam1Ratio;
				// var eyebeam2Height = ( (documentWidth/100) * 7) * eyebeam2Ratio;
				// var eyebeam3Height = ( (documentWidth/100) * 7) * eyebeam3Ratio;

				// var stretch = (documentHeight - eyebeam3Height);
				// var maxScroll = documentHeight - (eyebeam3Height ) ;

				right2Height = ((documentHeight - $(window).height()) - scroll) + 130;
				left2Height = ((documentHeight - $(window).height()) - (scroll)) + 85;
				var left3Height = 0;
				var reversePoint = documentHeight / 2;



				if (scroll == 0) {

				}
				else if (scroll < reversePoint) {
					$(".logo-container#right h1 #eyebeam_2_right").css({
						"background-image": "url(" + $(".logo-container#right h1 #eyebeam_2_right img").attr("src") + ")",
						"height": right2Height
					});
					$(".logo-container#left h1 #eyebeam_2_left img").css("height", left2Height);
					$(".logo-container#left h1 #eyebeam_3_left img").css("top", 0);
				} else {
					console.log('is this on load');
					right2Height = ((documentHeight - $(window).height()) - scroll) + 75;
					left2Height = ((documentHeight - $(window).height()) - (scroll)) + 85;
					left3Height = scroll;
					// left3Height = ( documentHeight - ($(window).height() - 24 ));
					// left3Height = (documentHeight - $(window).height() +36);


					$(".logo-container#right h1 #eyebeam_2_right").css({
						"background-image": "url(" + $(".logo-container#right h1 #eyebeam_2_right img").attr("src") + ")",
						"height": right2Height
					});
					// $(".logo-container#right h1 #eyebeam_2_right img").css("height", right2Height);

					$(".logo-container#left h1 #eyebeam_2_left img").css("height", left3Height);
					console.log('is this');
					$(".logo-container#left h1 #eyebeam_3_left img").css("top", left3Height);
				}

			});

			var lastScroll = 0
			$(window).scroll(function () {

				var documentHeight = $('body').height();
				var documentWidth = $('body').width();
				// var eyebeam1Height = ( (documentWidth/100) * 7) * eyebeam1Ratio;
				// var eyebeam2Height = ( (documentWidth/100) * 7) * eyebeam2Ratio;
				// var eyebeam3Height = ( (documentWidth/100) * 7) * eyebeam3Ratio;

				var documentHeight = $('body').height();
				var logoEl = $("header div h1");

				var scroll = Math.max(window.pageYOffset, document.documentElement.scrollTop, document.body.scrollTop);
				// var maxScroll = ( documentHeight - (eyebeam3Height) ) - ((documentHeight / 100) * 2 );


				// testing for the right side
				// console.log(maxScroll);


				var right2Height = scroll + 120;
				var left2Height = scroll + 100;
				var left3Height = 0;

				var reversePoint = documentHeight / 2;


				if (scroll < reversePoint) {
					$(".logo-container#right h1 #eyebeam_2_right").css({
						"background-image": "url(" + $(".logo-container#right h1 #eyebeam_2_right img").attr("src") + ")",
						"height": right2Height
					});					// $(".logo-container#right h1 #eyebeam_2_right img").css("height", right2Height);
					$(".logo-container#left h1 #eyebeam_2_left img").css("height", left2Height);
					$(".logo-container#left h1 #eyebeam_3_left img").css("top", 0);
				} else {

					right2Height = ((documentHeight - $(window).height()) - scroll) + 120;
					left2Height = ((documentHeight - $(window).height()) - (scroll)) + 80;
					// left3Height = ( documentHeight - ($(window).height() - 24 ));
					// left3Height = (documentHeight - $(window).height() +36);

					$(".logo-container#right h1 #eyebeam_2_right").css({
						"background-image": "url(" + $(".logo-container#right h1 #eyebeam_2_right img").attr("src") + ")",
						"height": right2Height
					});
					// $(".logo-container#left h1 #eyebeam_2_left img").css("height", left2Height);
					$(".logo-container#left h1 #eyebeam_3_left img").css("top", left3Height);
				}




			});


			// $("header h1").clone().addClass("clone").appendTo("body");


			// logoContainer.clone().addClass("clone").insertAfter(".logo-container");
		},
		setup_alt_text: function () {
			$(".module-title, .post-title, .menu-item a, input, h2").each(function () {
				var hasChildren = false;
				if ($(this).is("input")) {

					var thisContent = $(this).attr("placeholder");

				} else if ($(this).children("a").length > 0) {

					hasChildren = true;
					var thisContent = $(this).find(".category-label").html();
					$(this).find(".category-label").attr("alt", thisContent);
					$(this).find(".category-label").attr("title", thisContent);

					var thisContentClone = $(this).clone().find("a").remove();
					var thisContentHtml = thisContentClone.html();
					$(this).attr("alt", thisContentHtml);
					// $(this).attr("title", thisContentHtml);

				} else {

					var thisContent = $(this).html();

				}

				if (!hasChildren) {
					$(this).attr("alt", thisContent);
					// $(this).attr("title", thisContent);
				}


			});
		},
		setup_blog_labels: function () {
			$(".category-label").each(function () {
				console.log($(this).attr("id"));

			});
		},
		setup_calendar: function () {
			$(function () {
				$(".datepicker").datepicker({
					dateFormat: "yy-mm-dd",
					onSelect: function (date) {

						console.log(date);
						$(".module-event").find("ul").fadeOut(150);
						var path = '/wp-admin/admin-ajax.php';
						$.get(path, {
							action: 'eyebeam2018_lazy_load',
							load: 'event',
							day: date
						}, function (data) {
							console.log(data);

							$(".module-event").find("ul").html(data).fadeIn(150);

						});


					}
				});

				// hilight all the days where there are events this amount_other
				var path = '/wp-admin/admin-ajax.php';
				$.get(path, {
					action: 'eyebeam2018_lazy_load',
					load: 'event',
					// day: date
				}, function (data) {
					// console.log(data);

					//$(".module-event").find("ul").html(data).fadeIn(150);

				});



			});
		},
		setup_carousel: function () {

			var carousel = new Swiper('.carousel-container', {
				direction: 'horizontal',
				// pagination: {
				// 	 el: '.swiper-pagination',
				// 	 type: 'progressbar',
				//  },
				autoplay: {
					delay: 3500,
				},
				loop: true,
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
				observer: true,
				observeParents: true
			});

		},

		setup_lazy_load: function () {

			$('.lazy-load').click(function (e) {
				// console.log('lazy');
				e.preventDefault();
				var $btn = $(e.target);

				if ($btn.hasClass('loading')) {
					return;
				}

				$btn.html('Loading&hellip;');
				$btn.addClass('loading');
				var page = $btn.data('page');
				var posts_per_page = $btn.data('limit');

				page = parseInt(page);
				page++;
				$btn.data('page', page);
				page = '&page=' + page;
				posts_per_page = '&limit=' + posts_per_page;

				var base = '/wp-admin/admin-ajax.php';
				var action = 'action=eyebeam2018_lazy_load';
				var load = $btn.data('load');
				var load_arg = '&load=' + load;
				var args = action + load_arg + page + posts_per_page;
				var url = base + '?' + args;

				$.ajax(url, {
					success: function (rsp) {
						$btn.html('Load more');
						var $ul = $('#' + load + '-list');
						$ul.append(rsp);
						$btn.removeClass('loading');

						// window.macyInstance.runOnImageLoad(function () {
						// 	window.macyInstance.recalculate(true);
						// });
						// fourColumnInstance.update();
					},
					error: function () {
						$btn.html('Error loading more.');
					}
				});

			});
		},

		setup_masonry: function () {


			$(".masonry").each(function () {

				var columns = $(this).data('columns');
				console.log("columns");
				console.log(columns);
				var selector = $(this).attr("id");
				console.log(selector);

				window.macyInstance = Macy({
					container: '#' + selector,
					trueOrder: true,
					waitForImages: true,
					margin: 36,
					columns: columns,
					breakAt: {
						940: 2,
					}
				});
			});



		},
		setup_micromodal: function () {

			if ($("a[data-micromodal-open").length > 0) {
				MicroModal.init({
					// onShow: modal => console.info(`${modal.id} is shown`), // [1]
					onClose: modal => $(".is-open").find('iframe').attr('src', $(".is-open").find('iframe').attr('src')), // [2]
					openTrigger: 'data-micromodal-open', // [3]
					closeTrigger: 'data-micromodal-close', // [4]
					openClass: 'is-open', // [5]
					disableScroll: true, // [6]
					disableFocus: false, // [7]
					awaitOpenAnimation: false, // [8]
					awaitCloseAnimation: false, // [9]
					debugMode: true // [10]
				});

				$('a[data-micromodal-open').click(function (e) {
					e.preventDefault();
				});

				$('a[data-micromodal-close').click(function (e) {
					e.preventDefault();
				});
			}

		},
		handleAlumniCreate: function(name, url, image, view){

			if (!view || view == 'name'){

				alumniResidentContainer = $(".alumni-resident.clone").clone();

				alumniResidentLink = $("<a></a>").attr("href", url).html(name.rendered);
	
				alumniResidentContainer.find('.alumni-resident-name').html(alumniResidentLink);
	
				alumniResidentContainer.removeClass('clone').appendTo('.alumni-archive-results');
			}
			else if (view == 'image'){
				console.log('image view')
				alumniResidentContainer = $(".alumni-resident.clone").clone();

				alumniResidentLink = $("<a></a>").attr("href", url).html(name.rendered);
	
				alumniResidentImage = $('<img />').attr("src", image);

				alumniResidentContainer.find('.alumni-resident-name').html(alumniResidentLink);
				alumniResidentContainer.find('.alumni-resident-image').html(alumniResidentImage);
	
				alumniResidentContainer.removeClass('clone').appendTo('.alumni-archive-results');
			}
			
		},
		handleAlumniPagination: function(){

		},
		handleAlumniRequest: function(page = 1){
			$('.alumni-archive-results').css({opacity: .3})

			const settings = {
				posts_per_page: self.alumniArchive.per_page,
				page: page
			}

			const tags = {
				223: 'rapid-response',
				224: 'resident'
			}

			let archiveOrderBy = (self.alumniArchive.sortByDate) ? 'date' : 'title';
			let archiveSortDirection;

			// date sort here is weird but i just need it to work right now

			let data = {
				orderby: archiveOrderBy,
				order: self.alumniArchive.nameSort,
				per_page: settings.posts_per_page,
				page: page,
			};

			if (self.alumniArchive.sortByDate)
				data["order"] = self.alumniArchive.dateSort;

			if (self.alumniArchive.searchQuery)
				data["search"] = self.alumniArchive.searchQuery

			if (self.alumniArchive.residentType && self.alumniArchive.residentType != 'all')
				data["tags"] = self.getKeyByValue(tags, self.alumniArchive.residentType);


			// make initial request to the REST API
			$.get('/wp-json/wp/v2/resident', data, function(response, status, xhr) {

				console.log(response);

				let totalPages = xhr.getResponseHeader('x-wp-TotalPages');

				self.alumniArchive.totalPages = totalPages;

				$('.alumni-resident:not(.clone)').remove();

				// loop overa all the entries
				for(let i = 0; i < response.length; i++){
					// destructure the returned data
					
					const { title, tags, link, image } = response[i];

					// const acf = acf;
					self.handleAlumniCreate(title, link, image, self.alumniArchive.view);

					// self.handleAlumniPagination();
				}

				self.updateButtonStates();

				self.updateAlumniArchivePagination(self.alumniArchive.page, self.alumniArchive.totalPages);

				$('.alumni-archive-results').css("opacity", 1);

			});
		},
		handlePaginationLink: function(){
			
			$('body').on("click", ".pagination-link", function(){

				if (!$(this).hasClass("disabled")){
					let thisPage = $(this).data("page");

					self.alumniArchive.page = thisPage;
					self.handleAlumniRequest(thisPage);
				}

			})
		},
		getPageList: function (totalPages, page, maxLength) {
			if (maxLength < 5) throw "maxLength must be at least 5";
		
			function range(start, end) {
				return Array.from(Array(end - start + 1), (_, i) => i + start); 
			}
		
			var sideWidth = maxLength < 9 ? 1 : 2;
			var leftWidth = (maxLength - sideWidth*2 - 3) >> 1;
			var rightWidth = (maxLength - sideWidth*2 - 2) >> 1;
			if (totalPages <= maxLength) {
				// no breaks in list
				return range(1, totalPages);
			}
			if (page <= maxLength - sideWidth - 1 - rightWidth) {
				// no break on left of page
				return range(1, maxLength - sideWidth - 1)
					.concat(0, range(totalPages - sideWidth + 1, totalPages));
			}
			if (page >= totalPages - sideWidth - 1 - rightWidth) {
				// no break on right of page
				return range(1, sideWidth)
					.concat(0, range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
			}
			// Breaks on both sides
			return range(1, sideWidth)
				.concat(0, range(page - leftWidth, page + rightWidth),
						0, range(totalPages - sideWidth + 1, totalPages));
		},
		updateAlumniArchivePagination: function(page, pages, maxLength = 12){

			let paginationLinks = self.getPageList(pages, page, 12);

			if (maxLength < 5) throw "Max Length must be greater than 5"

			// clear the container
			let paginationPages = $('.pagination-pages');
			paginationPages.html("");

			let min = page - (maxLength / 2);
			let max = page + (maxLength / 2);

			paginationLinks.forEach(link => {
				let paginationLink = $('<a></a>').
					addClass("pagination-link").
					attr("alt", `View page ${link}`).
					data("page", link).
					html(link);

				if (link == 0) link = paginationLink.html("...").addClass("disabled");

				if (page === link){
					paginationLink.addClass('current');
				}

				paginationLink.appendTo(paginationPages);
			});	

			$('.previous').data("page", page-1);
			$('.next').data("page", page+1);
		},
		handleViewButton: function(){
			$('body').on("click", ".view-btn", function(){
				let thisView = $(this).data("view");

				$('.view-btn').removeClass('active');
				$(this).addClass("active");

				self.alumniArchive.view = thisView;

				self.handleViewChange(self.alumniArchive.view);
			} );
		},
		handleViewChange: function(view){
			
			self.alumniArchive.view = view;

			if (view == 'image'){
				self.alumniArchive.per_page = 8;
			}
			else if (view == 'name') {
				self.alumniArchive.per_page = 24;
			}

			self.handleAlumniRequest(self.alumniArchive.page);

			console.log(self.alumniArchive.view);
		},
		setup_alumni_archive: function() {
			
			self.handlePaginationLink();
			self.handleViewButton();

			// if enter is pressed on the search bar
			$('.alumni-archive-controls-form-search').submit(function(e){
				e.preventDefault();
			});
			
			// category buttons
			$('.alumni-archive-controls-form-search').find('button').click(function(e){

				$('.alumni-archive-controls-form-search').find('button').removeClass('active');

				e.preventDefault();

				self.alumniArchive.residentType = $(this).data("type");

				$(this).addClass("active");

				self.handleAlumniRequest(1);
			})

			// search keypress
			$('.alumni-archive-controls-form-search').find('input').keyup(function(e){

				let search = $(this).val();

				console.log(search);

				self.alumniArchive.searchQuery = search;

				self.handleAlumniRequest()
			})

			$('button[data-sort="name"]').click(function(e){
				e.preventDefault();

				// set sort by
				self.alumniArchive.sortByName = true;
				self.alumniArchive.sortByDate = false;

				// set sort direction

				if (!self.alumniArchive.nameSort)
					$(this).data('direction', 'asc');
						
				if (self.alumniArchive.nameSort == 'asc'){
					
					self.alumniArchive.nameSort = 'desc'
					$('button[data-sort="name"]').removeClass('asc');
					$('button[data-sort="name"]').addClass('desc');

				} else if (self.alumniArchive.nameSort == 'desc'){
					
					self.alumniArchive.nameSort = 'asc'
					$('button[data-sort="name"]').removeClass('desc');
					$('button[data-sort="name"]').addClass('asc');
				}
				
				console.log(self.alumniArchive);

				self.handleAlumniRequest();

			});

			$('button[data-sort="date"]').click(function(e){
				e.preventDefault();

				// set sort by
				self.alumniArchive.sortByName = false;
				self.alumniArchive.sortByDate = true;

				// set sort direction

				if (!self.alumniArchive.dateSort)
					$(this).data('direction', 'asc');
						
				if (self.alumniArchive.dateSort == 'asc'){
					
					self.alumniArchive.dateSort = 'desc'
					$('button[data-sort="date"]').removeClass('asc');
					$('button[data-sort="date"]').addClass('desc');

				} else if (self.alumniArchive.dateSort == 'desc'){
					
					self.alumniArchive.dateSort = 'asc'
					$('button[data-sort="date"]').removeClass('desc');
					$('button[data-sort="date"]').addClass('asc');
				}
				
				console.log(self.alumniArchive);

				self.handleAlumniRequest();

			});

			// init results
			self.handleAlumniRequest();
			
		},
		updateButtonStates: function(button){
			
			if (self.alumniArchive.dateSort == 'desc'){
				$('button[data-sort="date"]').data('direction', 'desc');
			}

			if (self.alumniArchive.dateSort == 'asc'){
				$('button[data-sort="date"]').data('direction', 'asc');
			}

			if (self.alumniArchive.nameSort == 'desc'){
				$('button[data-sort="name"]').data('direction', 'desc');
			}

			if (self.alumniArchive.nameSort == 'asc'){
				$('button[data-sort="name"]').data('direction', 'asc');
			}

			if (self.alumniArchive.sortByDate == true){
				$('button[data-sort="name"]').removeClass('active');
				$('button[data-sort="date"]').addClass('active');
			}

			if (self.alumniArchive.sortByName == true){
				$('button[data-sort="date"]').removeClass('active');
				$('button[data-sort="name"]').addClass('active');
			}

			if (self.alumniArchive.residentType == 'all'){
				$('button.form-search').removeClass('active');
				$('button[data-type="all"]').addClass('active');
			}
			
			if (self.alumniArchive.residentType == 'rapid-response'){
				$('button.form-search').removeClass('active');
				$('button[data-type="rapid-response"]').addClass('active');
			}

			if (self.alumniArchive.residentType == 'resident'){
				$('button.form-search').removeClass('active');
				$('button[data-type="resident"]').addClass('active');
			}

		},
		getKeyByValue: function(object, value) {
			return Object.keys(object).find(key => object[key] === value);
		},
	};

	$(document).ready(function () {
		self.init();
	});

	$(window).resize(function () {
		// if (enable_autocrop){
		// 	self.setup_autocrop(true);
		// }
	});

	return self;

})(jQuery);
