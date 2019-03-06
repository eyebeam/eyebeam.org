var eyebeam2018 = (function($) {

	// This should be kept in sync with the style.css mobile breakpoint.
	var mobile_width = 856;

	// For handling donations
	var stripe_card = null;
	var enable_autocrop = true;

	var self = {

		init: function() {
			self.setup_nav();
			self.setup_subscribe();
			// self.setup_modules();
			self.setup_random_footer();
			self.setup_link();
			self.setup_menu();
			self.setup_bio_toggle();
			self.setup_hash();
			self.setup_residents();
			self.setup_archive();
			self.setup_donate();
			self.setup_lazy_load();
			self.setup_autocrop();
			self.setup_searchform();
			self.setup_logo();
			self.setup_alt_text();
			self.setup_blog_labels();
			self.setup_calendar();

		},
		setup_nav: function() {
			if ($('#wpadminbar').length > 0) {
				$('header').addClass('headroom');
				$('.subnav').addClass('headroom');
			}

			$(window).scroll(function() {

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

			$("li.menu-item-has-children > a").click(function(event){

				event.preventDefault();

				if ( $(window).width() >= mobile_width ){
					// set defaults
					var navHeight = 60;
					var subNavHeight = 0;

					// find how many children links there are
					var childCount = $(this).parent().find(".sub-menu").children().length;
					subNavHeight = 32 * (childCount+1);

					if ($(this).parent().hasClass("show-sub-menu")){

						$("nav").css("height", navHeight);
						$(this).parent().find(".sub-menu").css("height", 0 );
						$(this).parent().toggleClass("show-sub-menu");

					} else {

						$(".show-sub-menu").removeClass("show-sub-menu");

						$(".sub-menu").css("height", 0 ).delay(1000);
						$("nav").css("height", navHeight);

						console.log('subNavHeight');
						console.log(subNavHeight);
						console.log('navHeight');
						console.log(navHeight);
						$("nav").css("height", subNavHeight+navHeight);
						$(this).parent().find(".sub-menu").css("height", subNavHeight );

						$(this).parent().toggleClass("show-sub-menu");					
					}
				}
				else {
					// console.log($(this).hasClass("show-sub-menu"));
					if ( $(this).hasClass("show-sub-menu") ){
						$(this).removeClass("show-sub-menu").parent().find(".sub-menu").css("height", 0);
					} else {

						var childCount = $(this).parent().find(".sub-menu").children().length;
						$(this).addClass("show-sub-menu").parent().find(".sub-menu").css("height", (childCount * 32) );
					}

				}

			});
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

		 //the old code which randomizes link colors
		 setup_color: function() {
			var colors = ['red', 'green', 'blue'];
			$('header, .subnav, footer, .module, .module-collection li').each(function(i, el) {
				var index = Math.floor(Math.random() * colors.length);
				var color = colors[index];
				$(el).addClass(color);
			});
		},

		//new code that only randomizes the color of the footer background
		setup_random_footer: function() {
			var colors = ['red', 'green', 'blue'];
			$('footer').each(function(i, el) {
				var index = Math.floor(Math.random() * colors.length);
				var color = colors[index];
				$(el).addClass(color);
			});
		},
		
		
		//new code that makes all links one color except for the footer
		setup_link: function(){
			$('header, .subnav, .module, .moodule-colleciton li').each(function(i, el) {
				var color = 'red';
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

			// choose the second option (the current year)
			var first_year = select.options[1].value-2;
			$('#residents-year select').val(first_year);

			$('#residents-year select').change(function(e) {
				var year = $('#residents-year select').val();
				var path = '/wp-admin/admin-ajax.php';
				var args = '?action=eyebeam2018_residents&year=' + year;
				$('#module-alumni ul').html('Loading...');
				$('#module-alumni ul').addClass('loading');
				$.get(path + args, function(rsp) {
					$('#module-alumni ul').removeClass('loading');
					$('#module-alumni ul').html(rsp);
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

						// run autocrop to fix changed widths and heights
						if (enable_autocrop){
							self.setup_autocrop();						
						}
					},
					error: function() {
						$btn.html('Error loading more.');
					}
				});

			});
		},

		setup_autocrop: function(resize) {

			var has_module_residents = $('#module-residents').length;

			if (enable_autocrop && has_module_residents){

				$("#module-residents a.image").each(function(){

					if (!$(this).hasClass("cropped") || resize){
						// define terms
						var thisImg = $(this).find("img");
						var width = thisImg.attr("width");
						var height = thisImg.attr("height");

						var thisImgRatio = height / width;
						// console.log(thisImg);
						// console.log(height);
						// console.log(height/width);
						// console.log(height / thisImgRatio);
						// console.log('-------------');

						// find the image attributes and assign the container a height

						$(this).css("height", $(this).innerWidth());

						if (thisImgRatio < 1){

							// assign the background image to the anchor container
							$(this).css({
								"background-image": "url("+thisImg.attr("src")+")",
								"background-size": (width / thisImgRatio)+"px",
							});
							$(this).addClass("cropped");

						}
						else {
							// assign the background image to the anchor container
							$(this).css({
								"background-image": "url("+thisImg.attr("src")+")",
								"background-size": "100%",
							});					
						}


						// hide the link image element
						thisImg.hide();

						// $(this).parent(".item-container").css("background-image", thisImg.attr("src"));
					}
				});
			}
		},

		setup_searchform: function() {
			$(".search-btn").live('click', function(event){

				$("header").toggleClass("show-search");

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

			if ($('#donate').hasClass('loading')) {
				return;
			}

			var $form = $('#donate');
			$form.addClass('loading');
			$form.removeClass('success');
			$form.removeClass('error');

			stripe.createToken(stripe_card).then(function(result) {
				//console.log('createToken callback', result);
				if (result.error) {
					$('#donate').removeClass('loading');
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

			$('#donate input').attr('disabled', null);

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
				error: function() {
					//console.log('request error');
					$('#donate').removeClass('loading');
					$('#donate input').attr('disabled', null);
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
		setup_logo: function() {

			var logoContainer = $(".logo-container");
			var eyebeam1Ratio = 207/1067;
			var eyebeam2Ratio = 853/1067;
			var eyebeam3Ratio = 6947/1067;

			$(document).ready(function(){

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

				right2Height = ( (documentHeight - $(window).height()) - scroll ) + 130;
				left2Height = ( ( documentHeight - $(window).height()) - ( scroll ) ) + 100;
				var left3Height = 0;
					console.log('$(window).height()');
					console.log($(window).height());
					console.log('scroll');
					console.log(scroll);
					console.log('left2Height');
					console.log(left2Height);
					console.log('left3Height');
					console.log(left3Height);
					console.log('right2Height');
					console.log(right2Height);
				var reversePoint = documentHeight / 2;
				if (scroll == 0){

				}
				else if (scroll < reversePoint){
					$(".logo-container#right h1 #eyebeam_2_right").css("height", right2Height);
					$(".logo-container#right h1 #eyebeam_2_right img").css("height", right2Height);
					$(".logo-container#left h1 #eyebeam_2_left img").css("height", left2Height);
					$(".logo-container#left h1 #eyebeam_3_left img").css("top", 0);		
				} else {
					console.log('is this on load');
					right2Height = ( (documentHeight - $(window).height()) - scroll ) + 130;
					left2Height = ( ( documentHeight - $(window).height()) - ( scroll ) ) + 100;
					left3Height = scroll;
					// left3Height = ( documentHeight - ($(window).height() - 24 ));
					// left3Height = (documentHeight - $(window).height() +36);

					
					$(".logo-container#right h1 #eyebeam_2_right").css("height", right2Height);
					$(".logo-container#right h1 #eyebeam_2_right img").css("height", right2Height);							

					$(".logo-container#left h1 #eyebeam_2_left img").css("height", left3Height);					
					console.log('is this');
					$(".logo-container#left h1 #eyebeam_3_left img").css("top", left3Height);		
				}

			 });

			var lastScroll = 0
			$(window).scroll(function(){

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


				var right2Height = scroll +100;
				var left2Height = scroll +100;
				var left3Height = 0;

				var reversePoint = documentHeight / 2;


				if (scroll < reversePoint){
					$(".logo-container#right h1 #eyebeam_2_right").css("height", right2Height);
					$(".logo-container#right h1 #eyebeam_2_right img").css("height", right2Height);
					$(".logo-container#left h1 #eyebeam_2_left img").css("height", left2Height);
					$(".logo-container#left h1 #eyebeam_3_left img").css("top", 0);
				} else {

					right2Height = ( (documentHeight - $(window).height()) - scroll ) + 130;
					left2Height = ( ( documentHeight - $(window).height()) - ( scroll ) ) + 100;
					// left3Height = ( documentHeight - ($(window).height() - 24 ));
					// left3Height = (documentHeight - $(window).height() +36);

					
					$(".logo-container#right h1 #eyebeam_2_right").css("height", right2Height);
					$(".logo-container#right h1 #eyebeam_2_right img").css("height", right2Height);							

					// $(".logo-container#left h1 #eyebeam_2_left img").css("height", left2Height);					
					$(".logo-container#left h1 #eyebeam_3_left img").css("top", left3Height);					
				}




			});


			// $("header h1").clone().addClass("clone").appendTo("body");


			// logoContainer.clone().addClass("clone").insertAfter(".logo-container");
		},		
		setup_alt_text: function(){
			$(".module-title, .post-title, .menu-item a, input").each(function(){

					if ( $(this).is("input") ){
						var thisContent = $(this).attr("placeholder");
					} else {
						var thisContent = $(this).html();
					}

					$(this).attr("alt", thisContent);


			});	
		},
		setup_blog_labels: function(){
			$(".category-label").each(function(){
				console.log($(this).attr("id"));

			});
		},
		setup_calendar: function(){
			$( function() {
				$(".datepicker").datepicker({
					dateFormat: "yy-mm-dd",
					onSelect: function(date){
						console.log(date);
						$(".module-event").find("ul").fadeOut(150);
						var path = '/wp-admin/admin-ajax.php';
						$.get(path, {
							action: 'eyebeam2018_lazy_load',
							load: 'event',
							day: date
						}, function(data){
							console.log(data);
							
							$(".module-event").find("ul").html(data).fadeIn(150);

						});


					}
				});
			});
		},

	};

	$(document).ready(function() {
		self.init();
	});

$(window).resize(function(){
		if (enable_autocrop){
			self.setup_autocrop(true);
		}
	});

	return self;

})(jQuery);

	
