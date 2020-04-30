<?php
/**
 * Plugin Name: Sina Extension for Elementor
 * Plugin URI: https://sinaextra.com/sina-addon-for-elementor/
 * Description: A collection of high-quality widgets for Elementor page builder.
 * Version: 3.2.12
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

define('SINA_EXT_VERSION', '3.2.12');
define('SINA_EXT_PREVIOUS_VERSION', '3.2.10' );
define('SINA_EXT_FILE', __FILE__ );
define('SINA_EXT_SLUG', basename( SINA_EXT_FILE, '.php' ));
define('SINA_EXT_DIR', __DIR__);
define('SINA_EXT_URL', plugins_url('/', SINA_EXT_FILE));
define('SINA_EXT_BASENAME', plugin_basename( SINA_EXT_FILE ));
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
		'accordion' 			=> 1,
		'content-box' 			=> 1,
		'counter' 				=> 1,
		'dynamic-button'		=> 1,
		'fancytext' 			=> 1,
		'flip-box' 				=> 1,
		'google-map' 			=> 1,
		'image-differ'			=> 1,
		'piechart' 				=> 1,
		'pricing' 				=> 1,
		'progressbar' 			=> 1,
		'social-icons'			=> 1,
		'table'			 		=> 1,
		'team' 					=> 1,
		'title'					=> 1,
		'transform'				=> 1,
		'user-counter' 			=> 1,
		'video' 				=> 1,
		'visit-counter' 		=> 1,
	],
	'advanced' => [
		'banner-slider' 		=> 1,
		'blogpost' 				=> 1,
		'brand-carousel' 		=> 1,
		'contact-form' 			=> 1,
		'content-slider'		=> 1,
		'countdown' 			=> 1,
		'login-form' 			=> 1,
		'mailchimp-subscribe' 	=> 1,
		'modal-box'			 	=> 1,
		'news-ticker' 			=> 1,
		'particle-layer' 		=> 1,
		'portfolio' 			=> 1,
		'posts-carousel'		=> 1,
		'posts-tab' 			=> 1,
		'product-zoomer' 		=> 1,
		'review-carousel' 		=> 1,
		'search-form' 			=> 1,
	],
	'pro' => [
		'chart'					=> 1,
		'hover-image'			=> 1,
		'image-accordion'		=> 1,
		'image-marker'			=> 1,
		'instant-search'		=> 1,
		'lost-password-form'	=> 1,
		'offcanvas-bar'			=> 1,
		'posts-gallery'			=> 1,
		'posts-on-scroll'		=> 1,
		'register-form'			=> 1,
		'section-navigation'	=> 1,
		'tab' 					=> 1,
		'team-carousel'			=> 1,
		'testimonial'			=> 1,
		'toggle-content'		=> 1,
	],
]);


/**
 * SINA_EXTENDERS Constant
 *
 * @since 3.1.6
 */
define('SINA_EXTENDERS', [
	'pro' => [
		'parallax'				=> 1,
		'clips-animation'		=> 1,
		'colors-animation'		=> 1,
		'content-protection'	=> 1,
		'reading-progressbar'	=> 1,
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
