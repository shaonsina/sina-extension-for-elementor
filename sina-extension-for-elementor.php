<?php
/**
 * Plugin Name: Sina Extension for Elementor
 * Plugin URI: https://github.com/shaonsina/sina-extension-for-elementor.git
 * Description: A collection of high-quality widgets for Elementor page builder.
 * Version: 2.3.1
 * Author: shaonsina
 * Author URI: https://github.com/shaonsina
 * Text Domain: sina-ext
 * License: GPLv3
 * License URI: https://opensource.org/licenses/GPL-3.0
 * Tags: elementor, addon, extension, elementor extension, elementor addon, page builder, builder, elementor builder, elementor contact form, elementor widget, best elementor addon, best elementor extension
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define('SINA_EXT_VERSION', '2.3.1');
define('SINA_EXT_PREVIOUS_VERSION', '2.2.2' );
define('SINA_EXT_FILE', __FILE__ );
define('SINA_EXT_SLUG', basename( SINA_EXT_FILE, '.php' ));
define('SINA_EXT_DIR', __DIR__);
define('SINA_EXT_URL', plugins_url('/', SINA_EXT_FILE));
define('SINA_EXT_BASENAME', plugin_basename( SINA_EXT_FILE ));
define('SINA_EXT_LAYOUT', SINA_EXT_DIR .'/widgets/layout');
define('SINA_EXT_INC', SINA_EXT_DIR .'/inc/');

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
]);

require_once( SINA_EXT_INC .'func-class.php' );

/**
 * Sina_Extension Class
 *
 * @since 1.0.0
 */
class Sina_Extension extends Sina_Functions {
	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @var Sina_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @return Sina_Extension An Instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor
	 *
	 * @since 1.0.3
	 */
	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
		add_action( 'init', [ $this, 'i18n' ] );

		register_activation_hook(SINA_EXT_FILE, [ $this, 'activation' ] );
		add_action('admin_init', [ $this, 'redirection' ] );
		add_action( 'admin_menu', [$this, 'add_submenu'], 550 );

		$this->files();
		$this->admin_page();
	}
}
Sina_Extension::instance();