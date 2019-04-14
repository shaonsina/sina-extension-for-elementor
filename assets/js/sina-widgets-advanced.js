/* Sina Extension for Elementor v2.0.0 */

(function ($) {

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
					480: {
						items: 1
					},
					768: {
						items: 1
					},
					992: {
						items: 1
					},
					1200: {
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
						columnWidth: '.sina-bp-col',
					}
				});
			});

			var uid = $this.data('uid'),
				columns = $this.data('columns'),
				categories = $this.data('categories'),
				postsNum = $this.data('posts-num'),
				totalPosts = $this.data('total-posts'),
				columns = $this.data('columns'),
				excerpt = $this.data('excerpt'),
				postsMeta = $this.data('posts-meta'),
				contentLength = $this.data('content-length'),
				nonce = $this.find('#sina_load_more_posts'+uid),
				loadMore = $this.find('.sina-load-more'),
				btn = loadMore.children('.sina-load-more-btn'),
				btnText = btn.html();

			btn.on('click', function(e) {
				var offset = $this.data('offset');

				btn.html('Loading...');
				$.post(
					sinaAjax.ajaxURL,
					{
						action: "sina_load_more_posts",
						columns: columns,
						categories: categories,
						posts_num: postsNum,
						offset: offset,
						excerpt: excerpt,
						posts_meta: postsMeta,
						content_length: contentLength,
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

	function sinaBrandCarousel($scope, $) {
		$scope.find('.sina-brand-carousel').each(function () {

			var $this = $(this),
				play = $this.data('autoplay') ? true : false,
				pause = $this.data('pause') ? true : false,
				mouse = $this.data('mouse-drag') ? true : false,
				touch = $this.data('touch-drag') ? true : false,
				loop = $this.data('loop') ? true : false,
				speed = $this.data('speed'),
				speed = speed ? speed : 500,
				delay = $this.data('delay');

			//Initialize carousel
			$this.owlCarousel({
				autoplay: play,
				autoplayHoverPause: pause,
				nav: false,
				dots: false,
				mouseDrag: mouse,
				touchDrag: touch,
				loop: loop,
				smartSpeed: speed,
				autoplayTimeout: delay,
				responsive: {
					0: {
						items: 2
					},
					480: {
						items: 3
					},
					768: {
						items: 4
					},
					992: {
						items: 4
					},
					1200: {
						items: 4
					},
				}
			});

		});
	}

	function sinaContactForm($scope, $) {
		$scope.find('.sina-contact-form').each(function () {
			var $this = $(this),
				$uid = $this.data('uid'),
				$nonce = $this.children('#sina_contact_nonce'+$uid),
				$success = $this.children('.sina-contact-success'),
				$error = $this.children('.sina-contact-error'),
				$process = $this.children('.sina-contact-process'),
				$name = $this.find('.sina-input-name'),
				$email = $this.find('.sina-input-email'),
				$subject = $this.find('.sina-input-subject'),
				$message = $this.find('.sina-input-message');

			$this.on('submit', function(e) {
				e.preventDefault();

				$error.fadeOut(0);
				$success.fadeOut(0);
				$process.fadeIn(200);

				$.post(
					sinaAjax.ajaxURL,
					{
						action: "sina_contact",
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

								setTimeout( function() {
									$error.fadeOut(200);
								}, 10000 );
							} else{
								$process.fadeOut(0);
								$success.html( "Thanks to contacting us!" ).fadeIn(200);

								setTimeout( function() {
									$success.fadeOut(200);
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

				function addZero(val) {
					if ( val < 10 ) {
						return '0'+val;
					}
					return val;
				}

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

	function sinaMCSubscribe($scope, $) {
		$scope.find('.sina-subs-form').each(function () {
			var $this = $(this),
				$link = $this.data('link'),
				$success = $this.children('.sina-subs-success'),
				$error = $this.children('.sina-subs-error'),
				$process = $this.children('.sina-subs-process');

			$this.ajaxChimp({
				language: 'es',
				callback: mailchimpCallback,
				url: $link
			});
			$this.on('submit', function(e) {
				$error.fadeOut(0);
				$success.fadeOut(0);
				$process.fadeIn(200);

				setTimeout( function() {
					$error.fadeOut(200);
					$success.fadeOut(200);
				}, 10000 );

				return false;
			});
			function mailchimpCallback(resp) {
				if (resp.result === 'success') {
					$process.fadeOut(0);
					$success.html( resp.msg ).fadeIn(800);

				} else if (resp.result === 'error') {
					$process.fadeOut(0);
					$error.html( resp.msg.replace('0 - ', '') ).fadeIn(800);
				}
			}
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
		elementorFrontend.waypoint($scope.find('.sina-posts-tab'), function () {
			var $btn = $("[data-sina-pt]");

			$btn.on('click', function(e) {
				$( $(this).data('sina-pt') ).siblings('.sina-pt-item').removeClass('active');
				$( $(this).data('sina-pt') ).addClass('active');
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

	function sinaReviewCarousel($scope, $) {
		$scope.find('.sina-review-carousel').each(function () {
			var $this = $(this),
				play = $this.data('autoplay') ? true : false,
				pause = $this.data('pause') ? true : false,
				nav = $this.data('nav') ? true : false,
				dots = $this.data('dots') ? true : false,
				mouse = $this.data('mouse-drag') ? true : false,
				touch = $this.data('touch-drag') ? true : false,
				loop = $this.data('loop') ? true : false,
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
				smartSpeed: speed,
				autoplayTimeout: delay,
				responsive: {
					0: {
						items: 1
					},
					480: {
						items: 1
					},
					768: {
						items: 1
					},
					992: {
						items: 1
					},
					1200: {
						items: 1
					},
				}
			});

		});
	}


	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_banner_slider.default', sinaBannerSlider);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_blogpost.default', sinaBlogpost);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_brand_carousel.default', sinaBrandCarousel);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_contact_form.default', sinaContactForm);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_countdown.default', sinaCountdown);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_mc_subscribe.default', sinaMCSubscribe);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_news_ticker.default', sinaNewsTicker);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_portfolio.default', sinaPortfolio);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_posts_tab.default', sinaPostsTab);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_product_zoomer.default', sinaProductZoomer);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_particle_layer.default', sinaParticleLayer);
		elementorFrontend.hooks.addAction('frontend/element_ready/sina_review_carousel.default', sinaReviewCarousel);

	});

})(jQuery);