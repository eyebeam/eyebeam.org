jQuery(document).ready(function($) {
	$('.load-more').click(function(e) {
		e.preventDefault();
		if ($('#loading-more').length > 0) {
			return;
		}
		$(e.target).before('<div id="loading-more">Loading...</div>');

		var args = {
			action: 'load_more',
			type: $(e.target).data('type'),
			page: $(e.target).data('page')
		};

		if ($(e.target).data('filter')) {
			var url_filter = $(e.target).data('filter');
			var url_match = location.href.match(new RegExp(url_filter + '=([^&]*)'));
			if (url_match) {
				args[url_filter] = url_match[1];
			}
		}

		var params = $.param(args);
		$.get('/wp-admin/admin-ajax.php?' + params, function(rsp) {
			var page = $(e.target).data('page');
			page = parseInt(page);
			var href = $(e.target).attr('href').replace(/page=\d+/, 'page=' + (page + 1));
			$(e.target).data('page', (page + 1));
			$(e.target).attr('href', href);
			$('#loading-more').remove();
			$('.' + rsp.type + 's').append(rsp.html);
			if (! rsp.load_more) {
				$(e.target).remove();
			}
		});
	});
});
