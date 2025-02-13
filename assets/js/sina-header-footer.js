/* Sina Extension for Elementor v3.7.0 */

!(function ($) {
	'use strict';

	function sinaNavMenu($scope, $) {
		$scope.find('.sina-ext-nav').each(function () {
			var getWindow 	= $(window).outerWidth();
			var $body 		= $('body');
			var $getNav		= $(this);
			var $menu 		= $getNav.find('.sina-ext-menu');
			var $collapse 	= $getNav.find('.sina-ext-nav-collapse');
			var $navToggle 	= $getNav.find('.sina-ext-nav-toggle');
			var $open_icon  = $navToggle.data('open');
			var $close_icon = $navToggle.data('close');
			var getIn 		= $menu.data('in');
			var getOut 		= $menu.data('out');

			// Dropdown Menu
			// ----------------
			$('.sub-menu', $menu).addClass('animated');
			if ( getWindow > 1024 ) {
				$('.menu-item-has-children', $menu).on('mouseenter', function(){
					var dropdown = this;

					$('.sub-menu', dropdown).eq(0).removeClass(getOut).stop().fadeIn().addClass(getIn);
					$(dropdown).addClass('open');
				});
				$('.menu-item-has-children', $menu).on('mouseleave', function(){
					var dropdown = this;

					$('.sub-menu', dropdown).eq(0).removeClass(getIn).stop().fadeOut().addClass(getOut);
					$(dropdown).removeClass('open');
				});
			} else {
				$('.sina-ext-menu .menu-item-has-children > a').on('click', function(e){
					e.preventDefault();
				});
				$('a', '.sina-ext-menu .menu-item-has-children').on('click', function(){
					var dropdown = $(this).parent('.menu-item-has-children');

					$('.sub-menu', dropdown).eq(0).toggleClass(getIn).stop().fadeToggle().toggleClass(getOut);
					$(dropdown).toggleClass('open');
				});
			}


			// Mobile Sidebar
			// ---------------------------------
			// Add Class to body
			if ( $body.children('.sina-ext-nav-wrapper').length < 1 ) {
				$body.wrapInner('<div class="sina-ext-nav-wrapper"></div>');
			}

			// Toggle Button
			$navToggle.on('click', function(){
				$('.toggle-icon', this).toggleClass($open_icon).toggleClass($close_icon);
				$body.toggleClass('sina-ext-nav-mobile-left');
				$collapse.toggleClass('show');
			});
			$(window).on('resize', function(){
				$('.toggle-icon', $navToggle).removeClass($close_icon).addClass($open_icon);
				$body.removeClass('sina-ext-nav-mobile-left');
				$collapse.removeClass('show');
			});
		});
	}

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_nav_menu.default', sinaNavMenu);
	});

})(jQuery);
