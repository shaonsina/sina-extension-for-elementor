/* Sina Extension for Elementor v3.1.11 */

!(function ($) {
	// Owl Carousel for some Slider or Carousel
	function sinaOwl(owl) {
		var itemLg = owl.data('item-lg'),
			itemLg = itemLg ? itemLg : 2,
			itemMd = owl.data('item-md'),
			itemMd = itemMd ? itemMd : 2,
			itemSm = owl.data('item-sm'),
			itemSm = itemSm ? itemSm : 1,
			slideIn = owl.data('slide-anim'),
			slideOut = owl.data('slide-anim-out'),
			slideOut = 'none' == slideOut ? false : slideOut;
			slideIn = 'none' == slideIn ? false : slideIn,
			play = owl.data('autoplay') ? true : false,
			pause = owl.data('pause') ? true : false,
			center = owl.data('center') ? true : false,
			nav = owl.data('nav') ? true : false,
			dots = owl.data('dots') ? true : false,
			mouse = owl.data('mouse-drag') ? true : false,
			touch = owl.data('touch-drag') ? true : false,
			loop = owl.data('loop') ? true : false,
			speed = owl.data('speed'),
			speed = speed ? speed : 500,
			delay = owl.data('delay');

		// Initialize carousel
		owl.owlCarousel({
			animateOut: slideOut,
			animateIn: slideIn,
			autoplay: play,
			autoplayHoverPause: pause,
			center: center,
			nav: nav,
			dots: dots,
			mouseDrag: mouse,
			touchDrag: touch,
			loop: loop,
			smartSpeed: speed,
			autoplayTimeout: delay,
			responsive: {
				0: {
					items: itemSm
				},
				600: {
					items: itemMd
				},
				900: {
					items: itemLg
				},
			}
		});
	}

	function addZero(val) {
		if ( val < 10 ) {
			return '0'+val;
		}
		return val;
	}

	function sinaBrandCarousel($scope, $) {
		$scope.find('.sina-brand-carousel').each(function () {
			sinaOwl( $(this) );
		});
	}

	function sinaContentSlider($scope, $) {
		$scope.find('.sina-content-slider').each(function () {
			sinaOwl( $(this) );
		});
	}

	function sinaPostsCarousel($scope, $) {
		$scope.find('.sina-posts-carousel').each(function () {
			sinaOwl( $(this) );
		});
	}

	function sinaReviewCarousel($scope, $) {
		$scope.find('.sina-review-carousel').each(function () {
			sinaOwl( $(this) );
		});
	}

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

	function sinaBannerSlider($scope, $) {
		$scope.find('.sina-banner-slider').each(function () {
			function doAnimations( elems ) {
				var animEndEv = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

				elems.each(function () {
					var $this = $(this),
						$animationType = $this.data('animation');
						$this.removeClass('sina-anim-invisible');

					$this.addClass($animationType).one(animEndEv, function () {
						$this.removeClass($animationType);
					});
				});
			}

			var $this = $(this),
				play = $this.data('autoplay') ? true : false,
				pause = $this.data('pause') ? true : false,
				nav = $this.data('nav') ? true : false,
				dots = $this.data('dots') ? true : false,
				mouse = $this.data('mouse-drag') ? true : false,
				touch = $this.data('touch-drag') ? true : false,
				loop = $this.data('loop') ? true : false,
				partAnim = $this.data('part-anim'),
				speed = $this.data('speed'),
				speed = speed ? speed : 500,
				delay = $this.data('delay');

			//Initialize carousel
			$this.owlCarousel({
				autoplay: play,
				autoplayHoverPause: pause,
				nav: nav,
				dots: dots,
				mouseDrag: mouse,
				touchDrag: touch,
				loop: loop,
				smartSpeed: partAnim ? 5 : speed,
				navSpeed: partAnim ? 5 : speed,
				autoplaySpeed: speed,
				autoplayTimeout: delay,
				responsive: {
					0: {
						items: 1
					},
				}
			});

			if ( partAnim ) {
				var firstItem = $this.find('.owl-item.active').find("[data-animation ^= 'animated']");
				doAnimations( firstItem );

				var oldActive = [ $this.find('.owl-item.active') ];

				$this.on('translated.owl.carousel', function(e) {
					var newActive = $this.find('.owl-item.active');
					var elems = newActive.find("[data-animation ^= 'animated']");
					doAnimations( elems );

					oldActive.push( newActive );
					oldActive[0].find("[data-animation ^= 'animated']").each(function (index, el) {
						var el = $(this);
						el.addClass( 'sina-anim-invisible' );
					});
					oldActive.shift();
				});
			}

			$this.find('.sina-tooltip').tooltip();
		});
	}

	function sinaBlogpost($scope, $) {
		$scope.find('.sina-blogpost').each(function () {
			var $this = $(this),
				$isoGrid = $this.children('.sina-bp-grid');

			$this.imagesLoaded( function() {
				$isoGrid.isotope({
					itemSelector: '.sina-bp-col',
					percentPosition: true,
					masonry: {
						columnWidth: '.sina-bp-grid-sizer',
					}
				});
			});

			var uid = $this.data('uid'),
				postsData = $this.data('posts-data'),
				totalPosts = postsData.total_posts,
				postsNum = postsData.posts_num,
				nonce = $this.find('#sina_load_more_posts'+uid),
				loadMore = $this.find('.sina-load-more'),
				btn = loadMore.children('.sina-load-more-btn'),
				btn = loadMore.children('.sina-load-more-btn'),
				btnText = btn.html();

			btn.on('click', function(e) {
				var offset = $this.data('offset');
				btn.html('Loading...');
				$.post(
					sinaAjax.ajaxURL,
					{
						action: "sina_load_more_posts",
						posts_data: JSON.stringify(postsData),
						offset: offset,
						nonce: nonce.val(),
					},
					function( data, status, code ) {
						if ( status == 'success' ) {
							var $items = $(data).find('.sina-bp-col');
							$isoGrid.append($items);
							imagesLoaded($isoGrid, function() {
							    $isoGrid.isotope('appended', $items);
							});

							if ( offset >= (totalPosts - postsNum) ) {
								loadMore.remove()
							}

							btn.html(btnText);
							$this.data('offset', offset + postsNum);
						}
					}
				);
			});

		});
	}

	function sinaContactForm($scope, $) {
		$scope.find('.sina-contact-form').each(function () {
			var $this = $(this),
				$uid = $this.data('uid'),
				$inbox = $this.data('inbox'),
				$nonce = $this.children('#sina_contact_nonce'+$uid),
				$success = $this.children('.sina-success-text'),
				$error = $this.children('.sina-error-text'),
				$process = $this.children('.sina-process-text'),
				$name = $this.find('.sina-input-name'),
				$email = $this.find('.sina-input-email'),
				$subject = $this.find('.sina-input-subject'),
				$message = $this.find('.sina-input-message'),
				timeout;

			$this.on('submit', function(e) {
				e.preventDefault();
				clearTimeout(timeout);

				$error.fadeOut(0);
				$success.fadeOut(0);
				$process.fadeIn(200);

				$.post(
					sinaAjax.ajaxURL,
					{
						action: "sina_contact",
						inbox: $inbox,
						name: $name.val(),
						email: $email.val(),
						subject: $subject.val(),
						message: $message.val(),
						nonce: $nonce.val(),
					},
					function( data, status, code ) {
						if ( status == 'success' ) {
							if ( data ) {
								$process.fadeOut(0);
								$error.html( data ).fadeIn(200);

								timeout = setTimeout( function() {
									$error.fadeOut(200);
								}, 10000 );
							} else{
								$process.fadeOut(0);
								$success.fadeIn(200);

								timeout = setTimeout( function() {
									$success.fadeOut(200);
								}, 10000 );
							}
						}
					}
				);

			});
		});
	}

	function sinaTable($scope, $) {
		$scope.find('.sina-table').each(function () {
			var $this = $(this),
				$table = $this.find('.sina-data-table');

			$table.DataTable();
		});
	}

	function sinaLoginForm($scope, $) {
		$scope.find('.sina-login-form').each(function () {
			var $this = $(this),
				$uid = $this.data('uid'),
				$url = $this.data('url'),
				$remLog = $this.data('rem-login'),
				$nonce = $this.children('#sina_login_nonce'+$uid),
				$error = $this.children('.sina-error-text'),
				$password = $this.children('.sina-input-password'),
				$email = $this.children('.sina-input-email'),
				$rememberText = $this.find('.sina-login-remember'),
				timeout,
				remeber = false;

				if ( 'yes' == $remLog ) {
					remeber = $rememberText.prop('checked');
				}

			$this.on('submit', function(e) {
				e.preventDefault();
				clearTimeout(timeout);

				$error.fadeOut(0);

				$.post(
					sinaAjax.ajaxURL,
					{
						action: "sina_login",
						password: $password.val(),
						email: $email.val(),
						remember: remeber,
						nonce: $nonce.val(),
					},
					function( data, status, code ) {
						if ( status == 'success' ) {
							if ( data ) {
								$error.html( data ).fadeIn(200);

								timeout = setTimeout( function() {
									$error.fadeOut(200);
								}, 10000 );
							} else{
								location.href = $url;
							}
						}
					}
				);
			});
		});
	}

	function sinaMCSubscribe($scope, $) {
		$scope.find('.sina-subs-form').each(function () {
			var $this = $(this),
				$uid = $this.data('uid'),
				$nonce = $this.find('#sina_mc_subscribe_nonce'+$uid),
				$fname = $this.find('.sina-input-fname'),
				$lname = $this.find('.sina-input-lname'),
				$email = $this.find('.sina-input-email'),
				$phone = $this.find('.sina-input-phone'),
				$success = $this.children('.sina-success-text'),
				$error = $this.children('.sina-error-text'),
				$process = $this.children('.sina-process-text'),
				timeout;

			$this.on('submit', function(e) {
				e.preventDefault();
				clearTimeout(timeout);

				$error.fadeOut(0);
				$success.fadeOut(0);
				$process.fadeIn(200);


				$.post(
					sinaAjax.ajaxURL,
					{
						action: "sina_mc_subscribe",
						fname: $fname.val() || ' ',
						lname: $lname.val() || ' ',
						phone: $phone.val() || ' ',
						email: $email.val(),
						nonce: $nonce.val(),
					},
					function( data, status, code ) {
						if ( status == 'success' ) {
							if ( 'success' == data ) {
								$process.fadeOut(0);
								$success.fadeIn(200);

								timeout = setTimeout( function() {
									$success.fadeOut(200);
								}, 10000 );
							} else{
								$process.fadeOut(0);
								$error.html( data ).fadeIn(200);

								timeout = setTimeout( function() {
									$error.fadeOut(200);
								}, 10000 );
							}
						}
					}
				);

			});
		});
	}

	function sinaCountdown($scope, $) {
		$scope.find('.sina-countdown').each(function (item , index) {
			var $this = $(this),
				year  = $this.find('.sina-cd-year'),
				month = $this.find('.sina-cd-month'),
				week  = $this.find('.sina-cd-week'),
				day   = $this.find('.sina-cd-day'),
				hour  = $this.find('.sina-cd-hour'),
				min   = $this.find('.sina-cd-minute'),
				sec   = $this.find('.sina-cd-second'),
				text  = $this.data('text'),
				mesg  = $this.data('message'),
				link   = $this.data('link'),
				time  = $this.data('time');

			$this.countdown( time ).on('update.countdown', function (e) {
				var m = e.strftime('%m'),
					w = e.strftime('%w'),
					Y = Math.floor(m / 12),
					m = m % 12,
					w = w % 4;


				year.html( addZero(Y) );
				month.html( addZero(m) );
				week.html( '0'+w );
				day.html( e.strftime('%d') );
				hour.html( e.strftime('%H') );
				min.html( e.strftime('%M') );
				sec.html( e.strftime('%S') );

				if ( text == 'yes' ) {
					year.next().html( Y < 2 ? 'Year' : 'Years' );
					month.next().html( m < 2 ? 'Month' : 'Months' );
					week.next().html( w < 2 ? 'Week' : 'Weeks' );
					day.next().html( e.strftime('%d') < 2 ? 'Day' : 'Days' );
					hour.next().html( e.strftime('%H') < 2 ? 'Hour' : 'Hours' );
					min.next().html( e.strftime('%M') < 2 ? 'Minute' : 'Minutes' );
					sec.next().html( e.strftime('%S') < 2 ? 'Second' : 'Seconds' );
				}

			}).on('finish.countdown', function (e) {
				$this.children().remove();
				if ( mesg ) {
					$this.append('<div class="sina-cd-message">'+ mesg +'</div>');
				} else if( link && elementorFrontend.isEditMode() ){
					$this.append('<h2>You can\'t redirect url from elementor edit mode!!</h2>');
				} else if (link) {
					window.location.href = link;
				} else{
					$this.append('<h2>May be you don\'t enter a valid redirect url</h2>');
				}
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

	function sinaImageDiffer($scope, $) {
		$scope.find('.sina-image-differ').each(function () {
			var $this = $(this),
				orientation = $this.data('orientation'),
				before = $this.data('before'),
				after = $this.data('after'),
				offset = $this.data('offset'),
				overlay = $this.data('overlay') ? true : false,
				click = $this.data('click') ? true : false,
				hover = $this.data('hover') ? true : false,
				$cont = $this.children('.twentytwenty-container');

			$cont.twentytwenty({
				default_offset_pct: offset,
				orientation: orientation,
				before_label: before,
				after_label: after,
				no_overlay: overlay,
				move_slider_on_hover: hover,
				click_to_move: click,
			});
		});
	}

	function sinaNewsTicker($scope, $) {
		$scope.find('.sina-news-ticker').each(function () {
			var ticker = $(this),
				speed = $(this).data('speed'),
				pause = 'yes' == $(this).data('pause') ? true : false,
				newsContainer = ticker.find( '.sina-news-container' ),
				newsContent = newsContainer.find('.sina-news-content'),
				news = newsContent.children('.sina-news'),
				toWid = 0;

			newsContent.clone().appendTo( newsContainer );
			newsContent.clone().appendTo( newsContainer );

			function newsTicker( sp, ps ) {
				newsContainer.css('marginLeft', 0);
				newsContent.clone().appendTo( newsContainer );

				news.each(function(index, el) {
					toWid += $(this).outerWidth();
				});
				var duration = toWid*sp;

				newsContainer.css('width', toWid*5+'px');
				newsContainer.animate({
					marginLeft:'-='+toWid+'px'
				}, duration, 'linear', function () {
					newsContainer.children('.sina-news-content').first().remove();
					newsTicker( sp, ps );
				});

				if ( ps ) {
					newsContainer.on('mouseenter', function(e) {
						newsContainer.stop();
					});
					newsContainer.on('mouseleave', function(e) {
						newsContainer.animate({
							marginLeft:'-='+toWid+'px'
						}, duration, 'linear', function () {
							newsContainer.children('.sina-news-content').first().remove();
							newsTicker( sp, ps );
						});
					});
				}
			}
			newsTicker( speed, pause );
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

	function sinaParticleLayer($scope, $) {
		$scope.find('.sina-particle').each(function () {
			var $this = $(this),
				linkColor = $this.data('link-color'),
				ballColor = $this.data('ball-color'),
				number = $this.data('number'),
				link = $this.data('link'),
				clink = $this.data('clink'),
				linkw = $this.data('linkw'),
				size = $this.data('size'),
				speed = $this.data('speed'),
				dlink = $this.data('dlink') ? true : false,
				dmouse = $this.data('dmouse') ? true : false;

			$this.sinaParticles({
				lineColor: linkColor,
				fillColor: ballColor,
				particlesNumber: number,
				linkDist: link,
				createLinkDist: clink,
				linksWidth: linkw,
				maxSize: size,
				speed: speed,
				disableLinks: dlink,
				disableMouse: dmouse
			});

		});

		$('.sina-particle-layer .sina-tooltip').tooltip();
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

	function sinaPortfolio($scope, $) {
		$scope.find('.sina-portfolio').each(function () {
			var $this = $(this),
				$isoGrid = $this.children('.sina-portfolio-grid'),
				$btns = $this.children('.sina-portfolio-btns'),
				layout = $this.data('layout');

			$this.imagesLoaded( function() {
				if ( 'masonry' == layout ) {
					var $grid = $isoGrid.isotope({
						itemSelector: '.sina-portfolio-item',
						percentPosition: true,
						masonry: {
							columnWidth: '.sina-portfolio-item',
						}
					});
				} else{
					var $grid = $isoGrid.isotope({
						itemSelector: '.sina-portfolio-item',
						layoutMode: 'fitRows'
					});

				}

				$btns.on('click', 'button', function () {
					var filterValue = $(this).attr('data-filter');
					$grid.isotope({filter: filterValue});
				});

				$btns.each(function (i, btns) {
					var btns = $(btns);

					btns.on('click', '.sina-portfolio-btn', function () {
						btns.find('.is-checked').removeClass('is-checked');
						$(this).addClass('is-checked');
					});
				});

			});

			$this.find('.sina-portfolio-zoom').magnificPopup({
				type: 'image',
				gallery: {
					enabled: true
				},
			});

		});
	}

	function sinaPostsTab($scope, $) {
		$scope.find('.sina-posts-tab').each(function () {
			var $btn = $("[data-sina-pt]");

			$btn.on('click', function(e) {
				$( $(this).data('sina-pt') ).siblings('.sina-pt-item').removeClass('active');
				$( $(this).data('sina-pt') ).addClass('active');
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

	function sinaModalBox($scope, $) {
		$scope.find('.sina-modal-box').each(function () {
			var $this = $(this),
				$click = $this.data('click') ? true : false,
				$esc = $this.data('esc') ? true : false,
				$aShow = $this.data('auto-show') ? true : false,
				$dShow = $this.data('delay-show') ? $this.data('delay-show') : 4000,
				$id = $this.data('modal-id'),
				$btn = $('.'+$id),
				$cBtn = $this.find('.close-'+$id),
				$modal = $('.sina-modal-'+$id);

			$btn.click( function(e) {
				e.preventDefault();
				$modal.fadeIn( 400 );
			});

			$cBtn.click( function() {
				$modal.fadeOut('400');
			});

			if ( $aShow ) {
				setTimeout( function() { $modal.fadeIn( 400 ); }, $dShow );
			}

			if ( $click ) {
				$(document).on('click', function(e) {
					if ( $(e.target).is('.sina-modal-area') ) {
						$modal.fadeOut('400');
					}
				});
			}

			if ( $esc ) {
				$(window).on('keydown', function(e) {
					var key = e.which || e.keyCode;
					if ( 192 == key ) {
						$modal.fadeOut('400');
					}
				});
			}
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
				today = $this.find('.sina-visit-today'),
				yesterday = $this.find('.sina-visit-yesterday'),
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
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_banner_slider.default', sinaBannerSlider);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_blogpost.default', sinaBlogpost);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_brand_carousel.default', sinaBrandCarousel);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_contact_form.default', sinaContactForm);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_table.default', sinaTable);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_login_form.default', sinaLoginForm);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_mc_subscribe.default', sinaMCSubscribe);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_content_slider.default', sinaContentSlider);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_posts_carousel.default', sinaPostsCarousel);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_countdown.default', sinaCountdown);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_counter.default', sinaCounter);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_fancytext.default', sinaFancytext);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_image_differ.default', sinaImageDiffer);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_google_map.default', sinaGoogleMap);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_news_ticker.default', sinaNewsTicker);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_product_zoomer.default', sinaProductZoomer);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_particle_layer.default', sinaParticleLayer);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_piechart.default', sinaPiechart);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_portfolio.default', sinaPortfolio);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_posts_tab.default', sinaPostsTab);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_progressbar.default', sinaProgressbars);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_review_carousel.default', sinaReviewCarousel);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_modal_box.default', sinaModalBox);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_user_counter.default', sinaUserCounter);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_video.default', sinaVideo);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_visit_counter.default', sinaVisitCounter);
	});

})(jQuery);
