<?php
namespace Sina_Extension;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Sina_Extension\Sina_Extension_Base;
use \Sina_Extension\Manager\Sina_Ext_Manager;
use \Sina_Extension\Admin\Sina_Ext_Settings;
use \Sina_Extension\Sina_Ext_Controls;

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
		wp_register_style( 'owl-carousel', SINA_EXT_URL .'assets/css/owl.carousel.min.css', [], '2.3.4' );
		wp_register_style( 'magnific-popup', SINA_EXT_URL .'assets/css/magnific-popup.min.css', [], '1.1.0' );
		wp_register_style( 'animate-merge', SINA_EXT_URL .'assets/css/animate-merge.min.css', [], SINA_EXT_VERSION );
		wp_register_style( 'twentytwenty', SINA_EXT_URL .'assets/css/twentytwenty.min.css', [], SINA_EXT_VERSION );
		wp_register_style( 'data-table', SINA_EXT_URL .'assets/css/datatables.min.css', [], '1.10.20' );
		wp_register_style( 'sina-tooltip', SINA_EXT_URL .'assets/css/sina-tooltip.min.css', [], SINA_EXT_VERSION );
		wp_register_style( 'sina-widgets', SINA_EXT_URL .'assets/css/sina-widgets.css', [], SINA_EXT_VERSION );
	}

	/**
	 * Enqueue JS files
	 *
	 * @since 3.0.0
	 */
	public function widget_scripts() {
		$apikey = get_option( 'sina_map_apikey' );
		$ajax_url = admin_url('admin-ajax.php');

		wp_register_script( 'imagesLoaded', SINA_EXT_URL .'assets/js/imagesloaded.pkgd.min.js', [], '4.1.4', true );
		wp_register_script( 'typed', SINA_EXT_URL .'assets/js/typed.min.js', ['jquery'], SINA_EXT_VERSION, true );
		wp_register_script( 'jquery-owl', SINA_EXT_URL .'assets/js/owl.carousel.min.js', ['jquery'], '2.3.4', true );
		wp_register_script( 'jquery-particle', SINA_EXT_URL .'assets/js/sina-particles.min.js', ['jquery'], '1.0', true );
		wp_register_script( 'magnific-popup', SINA_EXT_URL .'assets/js/jquery.magnific-popup.min.js', ['jquery'], '1.1.0', true );
		wp_register_script( 'countdown', SINA_EXT_URL .'assets/js/jquery.countdown.min.js', ['jquery'], '2.2.0', true );
		wp_register_script( 'easypiechart', SINA_EXT_URL .'assets/js/jquery.easypiechart.min.js', ['jquery'], '2.1.7', true );
		wp_register_script( 'isotope', SINA_EXT_URL .'assets/js/isotope.min.js', ['jquery', 'imagesLoaded', 'magnific-popup'], '3.0.6', true );
		wp_register_script( 'xzoom', SINA_EXT_URL .'assets/js/xzoom.min.js', ['jquery'], '1.0.14', true );
		wp_register_script( 'jquery-event-move', SINA_EXT_URL .'assets/js/jquery.event.move.min.js', ['jquery'], '2.0.0', true );
		wp_register_script( 'jquery-twentytwenty', SINA_EXT_URL .'assets/js/jquery.twentytwenty.min.js', ['jquery'], '2.0.0', true );
		wp_register_script( 'data-table', SINA_EXT_URL .'assets/js/datatables.min.js', ['jquery'], '1.10.20', true );
		wp_register_script( 'sina-tooltip', SINA_EXT_URL .'assets/js/sina-tooltip.js', [], SINA_EXT_VERSION, true );

		if ( $apikey ) {
			wp_register_script( 'sina-google-map', '//maps.google.com/maps/api/js?key='. $apikey, [], SINA_EXT_VERSION, true );
		}
		wp_register_script( 'sina-widgets', SINA_EXT_URL .'assets/js/sina-widgets.js', ['jquery'], SINA_EXT_VERSION, true );
		wp_localize_script( 'sina-widgets', 'sinaAjax', ['ajaxURL' => $ajax_url] );
	}

	/**
	 * Require Scripts
	 *
	 * @since 3.1.4
	 */
	public function require_scripts() {
		wp_enqueue_style( 'icofont', SINA_EXT_URL .'admin/assets/css/icofont.min.css', [], '1.0.1' );
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
				'title' => __( 'Sina Basic Widgets', 'sina-ext' ),
			]
		);
		$elements_manager->add_category(
			'sina-ext-advanced',
			[
				'title' => __( 'Sina Advanced Widgets', 'sina-ext' ),
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

		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'require_scripts' ] );
		add_action( 'wp_enqueue_scripts', [$this, 'require_scripts'] );

		// Register Widget Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'widget_category' ] );

		// Register Widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

		// Enqueue Widget Styles
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'widget_styles' ] );

		// Register Widget Scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		new Sina_Ext_Settings();
		new Sina_Ext_Controls();
		Sina_Ext_Manager::instance();
	}
}