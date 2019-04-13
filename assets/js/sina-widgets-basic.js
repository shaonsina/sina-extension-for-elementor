/* Sina Extension for Elementor v2.0.0 */

(function ($) {

	function sinaAccordion($scope, $) {
		$scope.find('.sina-accordion').each(function () {
			var $this = $(this),
				openF = $this.data('open-first');

			$this.find('.sina-accordion-item').each(function(index, el) {
				var $item = $(this),
					$siblings = $item.siblings('.sina-accordion-item'),
					$header = $item.children('.sina-accordion-header'),
					$body = $item.children('.sina-accordion-body');

				if ( openF && 0 == index ) {
					$body.slideDown(200);
				}

				$header.on('click', function(e) {
					e.stopImmediatePropagation();

					$body.slideToggle(200);
					$siblings.children('.sina-accordion-body').slideUp(200);
					$item.toggleClass('open');
					$siblings.removeClass('open');
				});
			});
		});
	}

	function sinaCounter($scope, $) {
		elementorFrontend.waypoint($scope.find('.sina-counter-number'), function () {
			var $this 	= $(this),
				data 	= $this.data(),
				digit	= data.toValue.toString().match(/\.(.*)/);

			if (digit) {
				data.rounding = digit[1].length;
			}

			$this.numerator(data);
		});
	}

	function sinaFancytext($scope, $) {
		$scope.find('.sina-fancytext').each(function () {
			var $this = $(this),
				strings = $this.find('.sina-fancytext-strings'),
				anim = $this.data('anim'),
				speed = $this.data('speed'),
				delay = $this.data('delay'),
				cursor = $this.data('cursor') ? true : false,
				loop = $this.data('loop') ? true : false,
				fancyText = $this.data('fancy-text'),
				fancyText = fancyText.split('@@');

			if ( 'typing' == anim ) {
				strings.typed({
					strings: fancyText,
					typeSpeed: speed,
					startDelay: delay,
					showCursor: cursor,
					loop: loop,
				});
			} else{
				strings.Morphext({
					animation: anim,
					separator: '@@',
					speed: delay
				});
			}
		});
	}

	function sinaGoogleMap($scope, $) {
		$scope.find('.sina-google-map').each(function () {
			var $this = $(this),
				$id = $this.data('id'),
				$anim = $this.data('anim'),
				$zoom = $this.data('zoom'),
				$lat = $this.data('lat'),
				$long = $this.data('long'),
				$isMarker = $this.data('marker'),
				$marker = $this.data('marker-link');

			var map = new google.maps.Map(document.getElementById($id), {
				center: {
					lat: $lat,
					lng: $long
				},
				zoom: $zoom
			});

			if ( $isMarker && $marker ) {
				var marker = new google.maps.Marker({
					position: new google.maps.LatLng($lat, $long),
					map: map,
					icon: {
						url: $marker,
					},
					animation: google.maps.Animation[$anim]
				});
			}
		});
	}

	function sinaPiechart($scope, $) {
		elementorFrontend.waypoint($scope.find('.sina-piechart-wrap'), function () {
			var $this 		= $(this),
				trackColor	= $this.data('track'),
				trackWidth	= $this.data('track-width'),
				barColor	= $this.data('bar'),
				lineWidth	= $this.data('line'),
				lineCap		= $this.data('cap'),
				animSpeed	= $this.data('speed'),
				scale		= $this.data('scale'),
				size		= $this.data('size');

			$this.easyPieChart({
				trackColor: trackColor,
				barColor: barColor,
				lineWidth: lineWidth,
				lineCap: lineCap,
				animate: animSpeed,
				scaleColor: scale,
				size: size
			});
		});
	}

	function sinaProductZoomer($scope, $) {
		$scope.find('.sina-product-zoomer').each(function () {
			var $this = $(this),
				position = $this.data('position'),
				shape = $this.data('shape');

			$this.find('.xzoom, .xzoom-gallery').xzoom({
				position: position,
				lensShape: shape,
			});
		});
	}

	function sinaProgressbars($scope, $) {
		elementorFrontend.waypoint($scope.find('.sina-bar-content'), function () {
			var $this = $(this),
				$perc = $this.data('percentage');

			$this.animate({ width: $perc + '%' }, $perc * 20 );
		});
	}

	function sinaUserCounter($scope, $) {
		$scope.find('.sina-user-counter').each(function () {
			var $this = $(this),
				number = $this.children('.sina-uc-number'),
				roles = $this.data('roles'),
				nonce = $this.find('#sina_user_counter_nonce');

			setInterval( function() {
				$.post(
					sinaAjax.ajaxURL,
					{
						action: "sina_user_counter",
						roles: roles,
						nonce: nonce.val(),
					},
					function( data, status, code ) {
						if ( status == 'success' ) {
							number.html(data);
						}
					}
				);
			}, 5000);
		});
	}

	function sinaVideo($scope, $) {
		$scope.find('.sina-video').each(function () {
			$(this).children('.sina-video-play').magnificPopup({
				type: 'iframe'
			});
		});
	}

	function sinaVisitCounter($scope, $) {
		$scope.find('.sina-visit-counter').each(function () {
			var $this = $(this),
				page = $this.data('page'),
				today = $this.children('.sina-visit-today'),
				yesterday = $this.children('.sina-visit-yesterday'),
				nonce = $this.find('#sina_visit_counter_nonce');

			setInterval( function() {
				$.post(
					sinaAjax.ajaxURL,
					{
						action: "sina_visit_counter",
						page: page,
						nonce: nonce.val(),
					},
					function( data, status, code ) {
						if ( status == 'success' ) {
							data = data.split('|');
							today.html(data['0']);
							yesterday.html(data['1']);
						}
					}
				);
			}, 5000);
		});
	}


	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_accordion.default', sinaAccordion);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_counter.default', sinaCounter);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_fancytext.default', sinaFancytext);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_google_map.default', sinaGoogleMap);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_piechart.default', sinaPiechart);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_product_zoomer.default', sinaProductZoomer);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_progressbar.default', sinaProgressbars);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_user_counter.default', sinaUserCounter);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_video.default', sinaVideo);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_visit_counter.default', sinaVisitCounter);
	});

})(jQuery);