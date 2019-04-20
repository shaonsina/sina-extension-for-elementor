/* Sina Extension for Elementor v2.0.0 */

(function ($) {
	$('.sina-ext-rollback-btn').on('click', function(e) {
		e.preventDefault();

		$.post(
			sinaAdminAjax.adminAjaxURL,
			{
				action: "sina_ext_rollback",
			}
		);
	});
})(jQuery);