<?php
/**
 * Plugin Name: Sina Extension for Elementor
 * Plugin URI: https://sina-extension.sinaextra.com/
 * Description: A collection of high-quality widgets for Elementor page builder.
 * Version: 3.7.1
 * Author: SinaExtra
 * Author URI: https://sinaextra.com/
 * Requires Plugins: elementor
 * Text Domain: sina-ext
 * License: GPLv3
 * License URI: https://opensource.org/licenses/GPL-3.0
 * Tags: elementor, elementor addon, elementor addons, elementor extension, elementor widget, elementor templates
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define('SINA_EXT_VERSION', '3.7.1');
define('SINA_EXT_PREVIOUS_VERSION', '3.7.0' );
define('SINA_EXT_FILE', __FILE__ );
define('SINA_EXT_SLUG', basename( SINA_EXT_FILE, '.php' ));
define('SINA_EXT_DIR', __DIR__);
define('SINA_EXT_URL', plugins_url('/', SINA_EXT_FILE));
define('SINA_EXT_BASENAME', plugin_basename( SINA_EXT_FILE ));
define('SINA_EXT_DIRNAME', dirname(SINA_EXT_BASENAME));
define('SINA_EXT_LAYOUT', SINA_EXT_DIR .'/widgets/layout');
define('SINA_EXT_INC', SINA_EXT_DIR .'/inc/');
define('SINA_EXT_ADMIN', SINA_EXT_DIR .'/admin/');

/**
 * SINA WIDGETS Constant
 *
 * @since 2.0.0
 */
define('SINA_WIDGETS', [
	'header_footer' => [
		'nav-menu'				=> 'Sina Nav Menu',
		'site-logo'				=> 'Sina Site Logo',
		'site-info'				=> 'Sina Site Info',
		'direct-contact'		=> 'Sina Direct Contact',
		'search'				=> 'Sina Search',
		'quick-links'			=> 'Sina Quick Links',
		'scroll-to-top'			=> 'Sina Scroll to Top',
		'woo-cart'				=> 'Sina Woo Cart',
	],
	'theme_builder' => [
		'post-title'				=> 'Sina Post Title',
		'post-content'				=> 'Sina Post Content',
		'post-featured-image'		=> 'Sina Post Featured Image',
		'post-excerpt'				=> 'Sina Post Excerpt',
		'post-meta'					=> 'Sina Post Meta',
		'post-navigation'			=> 'Sina Post Navigation',
		'post-comments'				=> 'Sina Post Comments',
		'archive-title'				=> 'Sina Archive Title',
		'author-profile'			=> 'Sina Author Profile',
		'posts'						=> 'Sina Posts',
	],
	'basic' => [
		'accordion' 			=> 'Sina Accordion',
		'breadcrumbs' 			=> 'Sina Breadcrumbs',
		'content-box' 			=> 'Sina Content Box',
		'counter' 				=> 'Sina Counter',
		'dynamic-button'		=> 'Sina Dynamic Button',
		'fancytext' 			=> 'Sina Fancy Text',
		'flip-box' 				=> 'Sina Flip Box',
		'google-map' 			=> 'Sina Google Map',
		'image-differ'			=> 'Sina Image Differ',
		'piechart' 				=> 'Sina Piechart',
		'pricing' 				=> 'Sina Pricing',
		'progressbar' 			=> 'Sina Progressbar',
		'social-icons'			=> 'Sina Social Icons',
		'table'			 		=> 'Sina Table',
		'team' 					=> 'Sina Team',
		'title'					=> 'Sina Title',
		'transform'				=> 'Sina Transform',
		'user-counter' 			=> 'Sina User Counter',
		'video' 				=> 'Sina Video',
		'visit-counter' 		=> 'Sina Visit Counter',
	],
	'advanced' => [
		'banner-slider' 		=> 'Sina Banner Slider',
		'blogpost' 				=> 'Sina Blog Post',
		'brand-carousel' 		=> 'Sina Brand Carousel',
		'contact-form' 			=> 'Sina Contact Form',
		'content-slider'		=> 'Sina Content Slider',
		'countdown' 			=> 'Sina Countdown',
		'facebook-feed'			=> 'Sina Facebook Feed',
		'login-form' 			=> 'Sina Login Form',
		'mailchimp-subscribe' 	=> 'Sina MailChimp Subscribe',
		'modal-box'			 	=> 'Sina Modal Box',
		'news-ticker' 			=> 'Sina News Ticker',
		'particle-layer' 		=> 'Sina Particle Layer',
		'portfolio' 			=> 'Sina Portfolio',
		'posts-carousel'		=> 'Sina Posts Carousel',
		'posts-tab' 			=> 'Sina Posts Tab',
		'product-zoomer' 		=> 'Sina Product Zoomer',
		'review-carousel' 		=> 'Sina Review Carousel',
		'search-form' 			=> 'Sina Search Form',
		'twitter-feed'			=> 'Sina Twitter Feed',
	],
	'pro' => [
		'chart'					=> 'Sina Pro Chart',
		'facebook-feed-carousel'=> 'Sina Pro Facebook Feed Carousel',
		'hover-image'			=> 'Sina Pro Hover Image',
		'image-accordion'		=> 'Sina Pro Image Accordion',
		'image-marker'			=> 'Sina Pro Image Marker',
		'image-scroller'		=> 'Sina Pro Image Scroller',
		'instant-search'		=> 'Sina Pro Instant Search',
		'lost-password-form'	=> 'Sina Pro Lost Password Form',
		'lottie-animation'		=> 'Sina Pro Lottie Animation',
		'offcanvas-bar'			=> 'Sina Pro Offcanvas Bar',
		'posts-gallery'			=> 'Sina Pro Posts Gallery',
		'posts-on-scroll'		=> 'Sina Pro Posts on Scroll',
		'register-form'			=> 'Sina Pro Register Form',
		'section-navigation'	=> 'Sina Pro Section Navigation',
		'source-code'			=> 'Sina Pro Source Code',
		'tab' 					=> 'Sina Pro Tab',
		'team-carousel'			=> 'Sina Pro Team Carousel',
		'testimonial'			=> 'Sina Pro Testimonial',
		'thumb-carousel'		=> 'Sina Pro Thumb Carousel',
		'tilt-box'				=> 'Sina Pro Tilt Box',
		'toggle-content'		=> 'Sina Pro Toggle Content',
		'twitter-feed-carousel'	=> 'Sina Pro Twitter Feed Carousel',
		'video-gallery'			=> 'Sina Pro Video Gallery',
	],
	'wooCommerce' => [
		'shop-box-grid'			=> 'Sina Pro Shop Box Grid',
		'shop-list-grid'		=> 'Sina Pro Shop List Grid',
		'shop-thumb-grid'		=> 'Sina Pro Shop Thumb Grid',
		'shop-box-carousel'		=> 'Sina Pro Shop Box Carousel',
		'shop-list-carousel'	=> 'Sina Pro Shop List Carousel',
		'shop-thumb-carousel'	=> 'Sina Pro Shop Thumb Carousel',
		'product-filter-vertical'=> 'Sina Pro Product Filter Vertical',
		'product-filter-horizontal'=> 'Sina Pro Product Filter Horizontal',
		'cart'					=> 'Sina Pro Cart',
		'checkout'				=> 'Sina Pro Checkout',
	],
]);


/**
 * SINA_EXTENDERS Constant
 *
 * @since 3.1.6
 */
define('SINA_EXTENDERS', [
	'pro' => [
		'sticky'				=> 'Sina Pro Sticky',
		'masker'				=> 'Sina Pro Masker',
		'parallax'				=> 'Sina Pro Parallax',
		'section-particles'		=> 'Sina Pro Section Particles',
		'clips-animation'		=> 'Sina Pro Clips Animation',
		'colors-animation'		=> 'Sina Pro Colors Animation',
		'grid-animation'		=> 'Sina Pro Grid Animation',
		'water-ripples'			=> 'Sina Pro Water Ripples',
		'conditional-publish'	=> 'Sina Pro Conditional Publish',
		'content-protection'	=> 'Sina Pro Content Protection',
		'preloader'				=> 'Sina Pro Preloader',
		'preloader'				=> 'Sina Pro Preloader',
		'reading-progressbar'	=> 'Sina Pro Reading Progressbar',
	],
]);

add_action('plugins_loaded', function () {
	require SINA_EXT_INC . 'sina-ext-base.php';
	require SINA_EXT_INC . 'sina-ext-func.php';
	require SINA_EXT_INC . 'sina-ext.php';
	Sina_Extension::modules();
});

add_action('init', function () {
	load_plugin_textdomain( 'sina-ext', false, SINA_EXT_DIRNAME.'/languages' );

	Sina_Extension::instance();
});

register_activation_hook( SINA_EXT_FILE, function() {
	require SINA_EXT_INC . 'sina-ext-activation.php';
	Sina_Extension_Activation::activation();
	flush_rewrite_rules();
});

register_deactivation_hook( SINA_EXT_FILE, function() {
	flush_rewrite_rules();
});