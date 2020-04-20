!(function ($) {
	'use strict';

	$(document).on('click', '.sina-ext-toggle', function(e){

		var $this = $(this);

		if ( $this.hasClass('sina-ext-pro') ) {
			e.preventDefault();
			Swal.fire({
				title: 'Go Pro',
				html: 'Purchase our <a href="https://sinaextra.com/sina-addon-for-elementor/" target="_blank">pro version</a> to unlock pro features.',
				icon: 'info',
				showCloseButton: true
			});
		} else if ( $this.hasClass('sina-toggle-section') ) {
			e.preventDefault();
			var $input 	= $this.children('input');
			var cat 	= $this.data('cat');
			var $all 	= $('.sina-toggle-all-'+cat+' > .form-table .sina-ext-toggle input');
			var status 	= $input.attr('checked');

			if ( status ) {
				$input.removeAttr('checked');
				$all.removeAttr('checked');
			} else {
				$input.attr('checked', true);
				$all.attr('checked', true);
			}
		}
	});

	$(document).on('click', '.sina-ext-btns > a', function(e) {
		e.preventDefault();
		var hash = this.hash;

		$(this).siblings().removeClass('active');
		$('.sina-ext-tab-content').removeClass('show');
		$(this).addClass('active');
		$(hash).addClass('show');
	});
})(jQuery);
