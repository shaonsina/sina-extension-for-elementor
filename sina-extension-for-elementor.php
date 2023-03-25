<?php
/**
 * Plugin Name: Sina Extension for Elementor
 * Plugin URI: https://sina-extension.sinaextra.com/
 * Description: A collection of high-quality widgets for Elementor page builder.
 * Version: 3.4.6
 * Author: SinaExtra
 * Author URI: https://sinaextra.com/
 * Text Domain: sina-ext
 * License: GPLv3
 * License URI: https://opensource.org/licenses/GPL-3.0
 * Tags: elementor, elementor addon, elementor addons, elementor extension, elementor widget, elementor templates
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define('SINA_EXT_VERSION', '3.4.6');
define('SINA_EXT_PREVIOUS_VERSION', '3.4.4' );
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
	'basic' => [
		'accordion' 			=> esc_html__( 'Sina Accordion', 'sina-ext' ),
		'content-box' 			=> esc_html__( 'Sina Content Box', 'sina-ext' ),
		'counter' 				=> esc_html__( 'Sina Counter', 'sina-ext' ),
		'dynamic-button'		=> esc_html__( 'Sina Dynamic Button', 'sina-ext' ),
		'fancytext' 			=> esc_html__( 'Sina Fancy Text', 'sina-ext' ),
		'flip-box' 				=> esc_html__( 'Sina Flip Box', 'sina-ext' ),
		'google-map' 			=> esc_html__( 'Sina Google Map', 'sina-ext' ),
		'image-differ'			=> esc_html__( 'Sina Image Differ', 'sina-ext' ),
		'piechart' 				=> esc_html__( 'Sina Piechart', 'sina-ext' ),
		'pricing' 				=> esc_html__( 'Sina Pricing', 'sina-ext' ),
		'progressbar' 			=> esc_html__( 'Sina Progressbar', 'sina-ext' ),
		'social-icons'			=> esc_html__( 'Sina Social Icons', 'sina-ext' ),
		'table'			 		=> esc_html__( 'Sina Table', 'sina-ext' ),
		'team' 					=> esc_html__( 'Sina Team', 'sina-ext' ),
		'title'					=> esc_html__( 'Sina Title', 'sina-ext' ),
		'transform'				=> esc_html__( 'Sina Transform', 'sina-ext' ),
		'user-counter' 			=> esc_html__( 'Sina User Counter', 'sina-ext' ),
		'video' 				=> esc_html__( 'Sina Video', 'sina-ext' ),
		'visit-counter' 		=> esc_html__( 'Sina Visit Counter', 'sina-ext' ),
	],
	'advanced' => [
		'banner-slider' 		=> esc_html__( 'Sina Banner Slider', 'sina-ext' ),
		'blogpost' 				=> esc_html__( 'Sina Blog Post', 'sina-ext' ),
		'brand-carousel' 		=> esc_html__( 'Sina Brand Carousel', 'sina-ext' ),
		'contact-form' 			=> esc_html__( 'Sina Contact Form', 'sina-ext' ),
		'content-slider'		=> esc_html__( 'Sina Content Slider', 'sina-ext' ),
		'countdown' 			=> esc_html__( 'Sina Countdown', 'sina-ext' ),
		'facebook-feed'			=> esc_html__( 'Sina Facebook Feed', 'sina-ext' ),
		'login-form' 			=> esc_html__( 'Sina Login Form', 'sina-ext' ),
		'mailchimp-subscribe' 	=> esc_html__( 'Sina MailChimp Subscribe', 'sina-ext' ),
		'modal-box'			 	=> esc_html__( 'Sina Modal Box', 'sina-ext' ),
		'news-ticker' 			=> esc_html__( 'Sina News Ticker', 'sina-ext' ),
		'particle-layer' 		=> esc_html__( 'Sina Particle Layer', 'sina-ext' ),
		'portfolio' 			=> esc_html__( 'Sina Portfolio', 'sina-ext' ),
		'posts-carousel'		=> esc_html__( 'Sina Posts Carousel', 'sina-ext' ),
		'posts-tab' 			=> esc_html__( 'Sina Posts Tab', 'sina-ext' ),
		'product-zoomer' 		=> esc_html__( 'Sina Product Zoomer', 'sina-ext' ),
		'review-carousel' 		=> esc_html__( 'Sina Review Carousel', 'sina-ext' ),
		'search-form' 			=> esc_html__( 'Sina Search Form', 'sina-ext' ),
		'twitter-feed'			=> esc_html__( 'Sina Twitter Feed', 'sina-ext' ),
	],
	'pro' => [
		'chart'					=> esc_html__( 'Sina Pro Chart', 'sina-ext' ),
		'facebook-feed-carousel'=> esc_html__( 'Sina Pro Facebook Feed Carousel',  'sina-ext' ),
		'hover-image'			=> esc_html__( 'Sina Pro Hover Image', 'sina-ext' ),
		'image-accordion'		=> esc_html__( 'Sina Pro Image Accordion', 'sina-ext' ),
		'image-marker'			=> esc_html__( 'Sina Pro Image Marker', 'sina-ext' ),
		'image-scroller'		=> esc_html__( 'Sina Pro Image Scroller', 'sina-ext' ),
		'instant-search'		=> esc_html__( 'Sina Pro Instant Search', 'sina-ext' ),
		'lost-password-form'	=> esc_html__( 'Sina Pro Lost Password Form', 'sina-ext' ),
		'lottie-animation'		=> esc_html__( 'Sina Pro Lottie Animation', 'sina-ext' ),
		'offcanvas-bar'			=> esc_html__( 'Sina Pro Offcanvas Bar', 'sina-ext' ),
		'posts-gallery'			=> esc_html__( 'Sina Pro Posts Gallery', 'sina-ext' ),
		'posts-on-scroll'		=> esc_html__( 'Sina Pro Posts on Scroll', 'sina-ext' ),
		'register-form'			=> esc_html__( 'Sina Pro Register Form', 'sina-ext' ),
		'section-navigation'	=> esc_html__( 'Sina Pro Section Navigation', 'sina-ext' ),
		'source-code'			=> esc_html__( 'Sina Pro Source Code', 'sina-ext' ),
		'tab' 					=> esc_html__( 'Sina Pro Tab', 'sina-ext' ),
		'team-carousel'			=> esc_html__( 'Sina Pro Team Carousel', 'sina-ext' ),
		'testimonial'			=> esc_html__( 'Sina Pro Testimonial', 'sina-ext' ),
		'thumb-carousel'		=> esc_html__( 'Sina Pro Thumb Carousel', 'sina-ext' ),
		'tilt-box'				=> esc_html__( 'Sina Pro Tilt Box', 'sina-ext' ),
		'toggle-content'		=> esc_html__( 'Sina Pro Toggle Content', 'sina-ext' ),
		'twitter-feed-carousel'	=> esc_html__( 'Sina Pro Twitter Feed Carousel',  'sina-ext' ),
		'video-gallery'			=> esc_html__( 'Sina Pro Video Gallery', 'sina-ext' ),
	],
	'wooCommerce' => [
		'shop-box-grid'			=> esc_html__( 'Sina Pro Shop Box Grid',  'sina-ext' ),
		'shop-list-grid'		=> esc_html__( 'Sina Pro Shop List Grid',  'sina-ext' ),
		'shop-thumb-grid'		=> esc_html__( 'Sina Pro Shop Thumb Grid',  'sina-ext' ),
		'shop-box-carousel'		=> esc_html__( 'Sina Pro Shop Box Carousel',  'sina-ext' ),
		'shop-list-carousel'	=> esc_html__( 'Sina Pro Shop List Carousel',  'sina-ext' ),
		'shop-thumb-carousel'	=> esc_html__( 'Sina Pro Shop Thumb Carousel',  'sina-ext' ),
		'product-filter-vertical'=> esc_html__( 'Sina Pro Product Filter Vertical',  'sina-ext' ),
		'product-filter-horizontal'=> esc_html__( 'Sina Pro Product Filter Horizontal',  'sina-ext' ),
	],
]);


/**
 * SINA_EXTENDERS Constant
 *
 * @since 3.1.6
 */
define('SINA_EXTENDERS', [
	'pro' => [
		'masker'				=> esc_html__( 'Sina Pro Masker', 'sina-ext' ),
		'parallax'				=> esc_html__( 'Sina Pro Parallax', 'sina-ext' ),
		'section-particles'		=> esc_html__( 'Sina Pro Section Particles', 'sina-ext' ),
		'water-ripples'			=> esc_html__( 'Sina Pro Water Ripples', 'sina-ext' ),
		'clips-animation'		=> esc_html__( 'Sina Pro Clips Animation', 'sina-ext' ),
		'colors-animation'		=> esc_html__( 'Sina Pro Colors Animation', 'sina-ext' ),
		'conditional-publish'	=> esc_html__( 'Sina Pro Conditional Publish', 'sina-ext' ),
		'content-protection'	=> esc_html__( 'Sina Pro Content Protection', 'sina-ext' ),
		'preloader'				=> esc_html__( 'Sina Pro Preloader', 'sina-ext' ),
		'reading-progressbar'	=> esc_html__( 'Sina Pro Reading Progressbar', 'sina-ext' ),
	],
]);

require SINA_EXT_INC . 'sina-ext-base.php';
require SINA_EXT_INC . 'sina-ext-func.php';
require SINA_EXT_INC . 'sina-ext.php';

add_action('plugins_loaded', function () {
	Sina_Extension::instance();
});

register_activation_hook( SINA_EXT_FILE, function() {
	Sina_Extension::activation();
	flush_rewrite_rules();
});

register_deactivation_hook( SINA_EXT_FILE, function() {
	flush_rewrite_rules();
});
