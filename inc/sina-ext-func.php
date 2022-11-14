<?php
namespace Sina_Extension;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Sina_Extension\Sina_Extension_Base;
use \Sina_Extension\Admin\Sina_Ext_Settings;
use \Sina_Extension\Sina_Ext_Controls;
use \Sina_Extension\Sina_Ext_Templates;

/**
 * Sina_Ext_Functions Class For widgets functionality
 *
 * @since 3.0.0
 */
abstract class Sina_Ext_Functions extends Sina_Extension_Base{
	 /**
	 * Enqueue CSS files
	 *
	 * @since 3.0.0
	 */
	public function widget_styles() {
		wp_register_style( 'icofont', SINA_EXT_URL .'admin/assets/css/icofont.min.css', [], SINA_EXT_VERSION );
		wp_register_style( 'owl-carousel', SINA_EXT_URL .'assets/css/owl.carousel.min.css', [], SINA_EXT_VERSION );
		wp_register_style( 'venobox', SINA_EXT_URL .'assets/css/venobox.min.css', [], SINA_EXT_VERSION );
		wp_register_style( 'animate-merge', SINA_EXT_URL .'assets/css/animate-merge.min.css', [], SINA_EXT_VERSION );
		wp_register_style( 'twentytwenty', SINA_EXT_URL .'assets/css/twentytwenty.min.css', [], SINA_EXT_VERSION );
		wp_register_style( 'data-table', SINA_EXT_URL .'assets/css/datatables.min.css', [], SINA_EXT_VERSION );
		wp_register_style( 'sina-tooltip', SINA_EXT_URL .'assets/css/sina-tooltip.min.css', [], SINA_EXT_VERSION );
		wp_register_style( 'sina-morphing-anim', SINA_EXT_URL .'assets/css/sina-morphing.min.css', [], SINA_EXT_VERSION );
		wp_register_style( 'sina-widgets', SINA_EXT_URL .'assets/css/sina-widgets.min.css', [], SINA_EXT_VERSION );

		if ( is_rtl() ) {
			wp_enqueue_style( 'sina-widgets-rtl', SINA_EXT_URL .'assets/css/sina-widgets-rtl.min.css', [], SINA_EXT_VERSION );
		}
	}

	/**
	 * Enqueue JS files
	 *
	 * @since 3.0.0
	 */
	public function widget_scripts() {
		$map_apikey = get_option( 'sina_map_apikey' );
		$recaptcha_key = get_option( 'sina_ext_pro_recaptcha_key' );
		$ajax_url = admin_url('admin-ajax.php');

		wp_register_script( 'imagesLoaded', SINA_EXT_URL .'assets/js/imagesloaded.pkgd.min.js', ['jquery'], SINA_EXT_VERSION, true );
		wp_register_script( 'typed', SINA_EXT_URL .'assets/js/typed.min.js', ['jquery'], SINA_EXT_VERSION, true );
		wp_register_script( 'jquery-owl', SINA_EXT_URL .'assets/js/owl.carousel.min.js', ['jquery'], SINA_EXT_VERSION, true );
		wp_register_script( 'jquery-particle', SINA_EXT_URL .'assets/js/sina-particles.min.js', ['jquery'], SINA_EXT_VERSION, true );
		wp_register_script( 'venobox', SINA_EXT_URL .'assets/js/venobox.min.js', ['jquery'], SINA_EXT_VERSION, true );
		wp_register_script( 'countdown', SINA_EXT_URL .'assets/js/jquery.countdown.min.js', ['jquery'], SINA_EXT_VERSION, true );
		wp_register_script( 'easypiechart', SINA_EXT_URL .'assets/js/jquery.easypiechart.min.js', ['jquery'], SINA_EXT_VERSION, true );
		wp_register_script( 'isotope', SINA_EXT_URL .'assets/js/isotope.min.js', ['jquery', 'imagesLoaded'], SINA_EXT_VERSION, true );
		wp_register_script( 'xzoom', SINA_EXT_URL .'assets/js/xzoom.min.js', ['jquery'], SINA_EXT_VERSION, true );
		wp_register_script( 'jquery-event-move', SINA_EXT_URL .'assets/js/jquery.event.move.min.js', ['jquery'], SINA_EXT_VERSION, true );
		wp_register_script( 'jquery-twentytwenty', SINA_EXT_URL .'assets/js/jquery.twentytwenty.min.js', ['jquery'], SINA_EXT_VERSION, true );
		wp_register_script( 'data-table', SINA_EXT_URL .'assets/js/datatables.min.js', ['jquery'], SINA_EXT_VERSION, true );
		wp_register_script( 'sina-tooltip', SINA_EXT_URL .'assets/js/sina-tooltip.min.js', [], SINA_EXT_VERSION, true );
		wp_register_script( 'sina-google-map-styles', SINA_EXT_URL .'assets/js/map-styles.min.js', [], SINA_EXT_VERSION, true );

		if ( $map_apikey ) {
			wp_register_script( 'sina-google-map', '//maps.google.com/maps/api/js?key='. $map_apikey, [], SINA_EXT_VERSION, true );
		}
		if ( $recaptcha_key ) {
			wp_register_script( 'sina-google-recaptcha-api', '//www.google.com/recaptcha/api.js', [], SINA_EXT_VERSION, true );
		}
		wp_register_script( 'sina-widgets', SINA_EXT_URL .'assets/js/sina-widgets.min.js', ['jquery'], SINA_EXT_VERSION, true );
		wp_localize_script( 'sina-widgets', 'sinaAjax', ['ajaxURL' => $ajax_url] );
	}

	/**
	 * Create widget category
	 *
	 * @since 3.0.0
	 */
	public function widget_category( $elements_manager ) {
		$elements_manager->add_category(
			'sina-extension',
			[
				'title' => esc_html__( 'Sina Basic Widgets', 'sina-ext' ),
			]
		);
		$elements_manager->add_category(
			'sina-ext-advanced',
			[
				'title' => esc_html__( 'Sina Advanced Widgets', 'sina-ext' ),
			]
		);
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
				if ($cat != 'pro' || $cat != 'wooCommerce') {
					foreach ($widgets as $widget => $translate) {
						$file = SINA_EXT_DIR .'/widgets/'.$cat.'/sina-'.$widget.'.php';
						if (file_exists( $file )) {
							require_once( $file );
							$widget = str_replace(' ', '_', ucwords( str_replace('-', ' ', $widget) ) );
							$widget = 'Sina_'.$widget.'_Widget';
							$widgets_manager->register( new $widget() );
						}
					}
				}
			}
		}
	}

	/**
	 * Initialize the plugin
	 *
	 * @since 3.0.0
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
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Enqueue Widget Styles
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'widget_styles' ] );

		// Enqueue Widget Scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		$this->files();
		$this->load_actions();
		$this->load_filters();

		Sina_Ext_Settings::instance();
		Sina_Ext_Controls::instance();
	}

	/**
	 * Include helper & hooks files
	 *
	 * @since 3.0.0
	 */
	public function files() {
		require_once( SINA_EXT_ADMIN .'sina-ext-rollback.php' );
		require_once( SINA_EXT_ADMIN .'sina-ext-settings.php' );
		require_once( SINA_EXT_INC .'sina-ext-hooks.php' );
		require_once( SINA_EXT_INC .'sina-ext-helpers.php' );
		require_once( SINA_EXT_INC .'sina-ext-controls.php' );
		require_once( SINA_EXT_INC .'sina-ext-controls-extend.php' );
		require_once( SINA_EXT_ADMIN .'sina-ext-templates.php' );
	}
}