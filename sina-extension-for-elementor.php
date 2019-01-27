<?php
/**
 * Plugin Name: Sina Extension for Elementor
 * Plugin URI: https://github.com/shaonsina/sina-extension-for-elementor.git
 * Description: A collection of high-quality widgets for Elementor page builder.
 * Version: 1.2.0
 * Author: shaonsina
 * Author URI: https://github.com/shaonsina
 * Text Domain: sina-ext
 * License: GPLv3
 * License URI: https://opensource.org/licenses/GPL-3.0
 * Tags: elementor, addon, extension, elementor extension, elementor addon, page builder, builder, elementor builder, elementor contact form, elementor widget
 */


use \Elementor\Plugin;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


define('SINA_EXT_VERSION', '1.2.0');
define('SINA_EXT_URL', plugins_url('/', __FILE__));
define('SINA_EXT_DIR', __DIR__);
define('SINA_EXT_BASENAME', plugin_basename( __FILE__ ));


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
	const MINIMUM_PHP_VERSION = '7.0';

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

		register_activation_hook(__FILE__, [ $this, 'activation' ] );
		add_action('admin_init', [ $this, 'redirection' ] );

		$this->create_admin_page();
		$this->include_files();
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
		require_once( SINA_EXT_DIR .'/admin/settings.php' );

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
				'title' => __( 'Sina Extension', 'sina-ext' ),
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
		wp_enqueue_style( 'magnific-popup', SINA_EXT_URL .'assets/css/magnific-popup.css', [], '1.1.0' );
		wp_enqueue_style( 'xzoom', SINA_EXT_URL .'assets/css/xzoom.min.css', [], '1.0.14' );
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
		wp_register_script( 'news-ticker', SINA_EXT_URL .'assets/js/jquery.tickerNews.min.js', ['jquery'], SINA_EXT_VERSION, true );

		if ( $apikey ) {
			wp_register_script( 'sina-google-map', '//maps.google.com/maps/api/js?key='. $apikey, [], SINA_EXT_VERSION, true );
		}
		wp_register_script( 'sina-widgets', SINA_EXT_URL .'assets/js/sina-widgets.js', ['jquery'], SINA_EXT_VERSION, true );
		wp_localize_script( 'sina-widgets', 'sinaAjax', ['ajaxURL' => $ajax_url] );
	}

	/**
	 * Register widgets
	 *
	 * @since 1.0.0
	 */
	public function register_widgets( $widgets_manager ) {
		// Include Widget files
		require_once( SINA_EXT_DIR .'/widgets/sina-accordion.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-banner-slider.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-blogpost.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-brand-carousel.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-contact-form.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-content-box.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-countdown.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-counter.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-fancytext.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-flip-box.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-google-map.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-mailchimp-subscribe.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-news-ticker.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-particle-layer.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-piechart.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-portfolio.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-posts-tab.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-pricing.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-product-zoomer.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-progressbar.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-review-carousel.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-search-form.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-team.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-user-counter.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-video.php' );
		require_once( SINA_EXT_DIR .'/widgets/sina-visit-counter.php' );

		// Register widgets
		$widgets_manager->register_widget_type( new Sina_Accordion_Widget() );
		$widgets_manager->register_widget_type( new Sina_Banner_Slider_Widget() );
		$widgets_manager->register_widget_type( new Sina_Blogpost_Widget() );
		$widgets_manager->register_widget_type( new Sina_Brand_Carousel_Widget() );
		$widgets_manager->register_widget_type( new Sina_Contact_Form_Widget() );
		$widgets_manager->register_widget_type( new Sina_Content_Box_Widget() );
		$widgets_manager->register_widget_type( new Sina_Countdown_Widget() );
		$widgets_manager->register_widget_type( new Sina_Counter_Widget() );
		$widgets_manager->register_widget_type( new Sina_Fancytext_Widget() );
		$widgets_manager->register_widget_type( new Sina_Flip_Box_Widget() );
		$widgets_manager->register_widget_type( new Sina_Google_Map_Widget() );
		$widgets_manager->register_widget_type( new Sina_MC_Subscribe_Widget() );
		$widgets_manager->register_widget_type( new Sina_News_Ticker_Widget() );
		$widgets_manager->register_widget_type( new Sina_Particle_Layer_Widget() );
		$widgets_manager->register_widget_type( new Sina_Piechart_Widget() );
		$widgets_manager->register_widget_type( new Sina_Portfolio_Widget() );
		$widgets_manager->register_widget_type( new Sina_Posts_Tab_Widget() );
		$widgets_manager->register_widget_type( new Sina_Pricing_Widget() );
		$widgets_manager->register_widget_type( new Sina_Product_Zoomer_Widget() );
		$widgets_manager->register_widget_type( new Sina_Progressbar_Widget() );
		$widgets_manager->register_widget_type( new Sina_Review_Carousel_Widget() );
		$widgets_manager->register_widget_type( new Sina_Search_Form_Widget() );
		$widgets_manager->register_widget_type( new Sina_Team_Widget() );
		$widgets_manager->register_widget_type( new Sina_User_Counter_Widget() );
		$widgets_manager->register_widget_type( new Sina_Video_Widget() );
		$widgets_manager->register_widget_type( new Sina_Visit_Counter_Widget() );
	}

}

Sina_Extension::instance();