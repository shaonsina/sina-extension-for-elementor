<?php
/**
 * Plugin Name: Sina Extension for Elementor
 * Plugin URI: https://github.com/shaonsina/sina-extension-for-elementor.git
 * Description: A collection of high-quality widgets for Elementor page builder.
 * Version: 2.1.2
 * Author: shaonsina
 * Author URI: https://github.com/shaonsina
 * Text Domain: sina-ext
 * License: GPLv3
 * License URI: https://opensource.org/licenses/GPL-3.0
 * Tags: elementor, addon, extension, elementor extension, elementor addon, page builder, builder, elementor builder, elementor contact form, elementor widget
 */


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


define('SINA_EXT_VERSION', '2.1.2');
define('SINA_EXT_PREVIOUS_VERSION', '2.0.0' );
define('SINA_EXT_FILE', __FILE__ );
define('SINA_EXT_SLUG', basename( SINA_EXT_FILE, '.php' ));
define('SINA_EXT_DIR', __DIR__);
define('SINA_EXT_URL', plugins_url('/', SINA_EXT_FILE));
define('SINA_EXT_BASENAME', plugin_basename( SINA_EXT_FILE ));

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
		'fancytext' 			=> 1,
		'flip-box' 				=> 1,
		'google-map' 			=> 1,
		'piechart' 				=> 1,
		'pricing' 				=> 1,
		'progressbar' 			=> 1,
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


/**
 * Sina Extension Class
 *
 * @since 1.0.0
 */
final class Sina_Extension {
	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '5.6';

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

		$this->include_files();
		$this->create_admin_page();
	}

	/**
	 * For activation
	 *
	 * @since 1.0.3
	 */
	public function activation() {
		add_option('sina_extension_activation', true);
	}

	/**
	 * Redirect after activation
	 *
	 * @since 1.0.3
	 */
	public function redirection() {
		add_option( 'sina_widgets', SINA_WIDGETS);

		if ( get_option('sina_extension_activation', false ) ) {
			delete_option('sina_extension_activation');

			if ( ! is_network_admin() ) {
				wp_redirect("admin.php?page=sina_ext_settings");
			}
		}
	}

	/**
	 * Create sub-page under 'Elementor' parent page
	 *
	 * @since 1.0.0
	 */
	protected function create_admin_page() {
		add_filter( 'plugin_action_links_'. SINA_EXT_BASENAME, [ $this, 'settings_link' ] );
	}

	/**
	 * Create settings link
	 *
	 * @since 1.0.0
	 */
	public function settings_link( $links ) {
		$links[] = '<a href="admin.php?page=sina_ext_settings">Settings</a>';
		return $links;
	}

	/**
	 * Include helper & hooks files
	 *
	 * @since 1.0.0
	 */
	public function include_files() {
		require_once( SINA_EXT_DIR .'/admin/settings.php' );
		require_once( SINA_EXT_DIR .'/admin/rollback.php' );
		require_once( SINA_EXT_DIR .'/admin/scripts.php' );
		require_once( SINA_EXT_DIR .'/inc/helper.php' );
		require_once( SINA_EXT_DIR .'/inc/hooks.php' );
	}

	/**
	 * Load Textdomain
	 *
	 * @since 1.0.0
	 */
	public function i18n() {
		load_plugin_textdomain( 'sina-ext' );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'sina-ext' ),
			'<strong>' . esc_html__( 'Sina Extension for Elementor', 'sina-ext' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'sina-ext' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'sina-ext' ),
			'<strong>' . esc_html__( 'Sina Extension for Elementor', 'sina-ext' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'sina-ext' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'sina-ext' ),
			'<strong>' . esc_html__( 'Sina Extension for Elementor', 'sina-ext' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'sina-ext' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Initialize the plugin
	 *
	 * @since 1.0.0
	 */
	public function init() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Register Widget Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'widget_category' ] );

		// Register Widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

		// Enqueue Widget Styles
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'widget_styles' ] );

		// Register Widget Scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
	}

	/**
	 * Create widget category
	 *
	 * @since 1.0.0
	 */
	public function widget_category( $elements_manager ) {
		$elements_manager->add_category(
			'sina-extension',
			[
				'title' => __( 'Sina Basic Widgets', 'sina-ext' ),
				'icon' => 'fa fa-plug',
			]
		);
		$elements_manager->add_category(
			'sina-ext-advanced',
			[
				'title' => __( 'Sina Advaced Widgets', 'sina-ext' ),
				'icon' => 'fa fa-plug',
			]
		);
	}

	/**
	 * Enqueue CSS files
	 *
	 * @since 1.0.0
	 */
	public function widget_styles() {
		wp_enqueue_style( 'owl-carousel', SINA_EXT_URL .'assets/css/owl.carousel.min.css', [], '2.3.4' );
		wp_enqueue_style( 'magnific-popup', SINA_EXT_URL .'assets/css/magnific-popup.min.css', [], '1.1.0' );
		wp_enqueue_style( 'sina-widgets', SINA_EXT_URL .'assets/css/sina-widgets.css', [], SINA_EXT_VERSION );
	}

	/**
	 * Enqueue JS files
	 *
	 * @since 1.0.0
	 */
	public function widget_scripts() {
		$apikey = get_option( 'sina_map_apikey', true );
		$ajax_url = admin_url('admin-ajax.php');

		wp_register_script( 'imagesLoaded', SINA_EXT_URL .'assets/js/imagesloaded.pkgd.min.js', [], '4.1.4', true );
		wp_register_script( 'typed', SINA_EXT_URL .'assets/js/typed.min.js', ['jquery'], SINA_EXT_VERSION, true );
		wp_register_script( 'jquery-owl', SINA_EXT_URL .'assets/js/owl.carousel.min.js', ['jquery'], '2.3.4', true );
		wp_register_script( 'jquery-particle', SINA_EXT_URL .'assets/js/sina-particles.min.js', ['jquery'], '1.0', true );
		wp_register_script( 'magnific-popup', SINA_EXT_URL .'assets/js/jquery.magnific-popup.min.js', ['jquery'], '1.1.0', true );
		wp_register_script( 'countdown', SINA_EXT_URL .'assets/js/jquery.countdown.min.js', ['jquery'], '2.2.0', true );
		wp_register_script( 'easypiechart', SINA_EXT_URL .'assets/js/jquery.easypiechart.min.js', ['jquery'], '2.1.7', true );
		wp_register_script( 'mailchimp', SINA_EXT_URL .'assets/js/jquery.ajaxchimp.min.js', ['jquery'], SINA_EXT_VERSION, true );
		wp_register_script( 'isotope', SINA_EXT_URL .'assets/js/isotope.min.js', ['jquery', 'imagesLoaded', 'magnific-popup'], '3.0.6', true );
		wp_register_script( 'xzoom', SINA_EXT_URL .'assets/js/xzoom.min.js', ['jquery'], '1.0.14', true );

		if ( $apikey ) {
			wp_register_script( 'sina-google-map', '//maps.google.com/maps/api/js?key='. $apikey, [], SINA_EXT_VERSION, true );
		}
		wp_register_script( 'sina-widgets', SINA_EXT_URL .'assets/js/sina-widgets.js', ['jquery'], SINA_EXT_VERSION, true );
		wp_localize_script( 'sina-widgets', 'sinaAjax', ['ajaxURL' => $ajax_url] );
	}

	/**
	 * Register widgets
	 *
	 * @since 2.0.0
	 */
	public function register_widgets( $widgets_manager ) {
		$active_widgets = get_option( 'sina_widgets' );

		if ( is_array($active_widgets) ) {
			foreach ($active_widgets as $cat => $widgets) {
				foreach ($widgets as $widget => $status) {
					$file = SINA_EXT_DIR .'/widgets/'.$cat.'/sina-'.$widget.'.php';
					if (1 == $status && file_exists( $file )) {
						require_once( $file );
						$widget = str_replace(' ', '_', ucwords( str_replace('-', ' ', $widget) ) );
						$widget = 'Sina_'.$widget.'_Widget';
						$widgets_manager->register_widget_type( new $widget() );
					}
				}
			}
		}
	}

}

Sina_Extension::instance();