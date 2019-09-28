<?php
namespace Sina_Extension\Manager;
use \Elementor\Plugin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sina_Ext_Manager Class for remote library.
 *
 * @since 3.1.0
 */
class Sina_Ext_Manager {

	private static $instance = null;

	/**
	 * Instance
	 *
	 * @since 3.1.0
	 * @var Sina_Ext_Manager The single instance of the class.
	 */
	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Constructor
	 *
	 * @since 3.1.0
	 */
	public function __construct() {
		if ( !empty( get_option( 'sina_templates_option' ) ) ) {
			add_action( 'elementor/init', [$this, 'library_source'], 15 );
		}

		// Template request
		if ( defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, '2.3.0', '>' ) ) {
			add_action( 'elementor/ajax/register_actions', [$this, 'register_ajax'], 25 );
		}
	}


	/**
	 * Register AJAX
	 *
	 * @since 3.1.0
	 */
	public function register_ajax( $ajax ) {
		if ( !isset( $_REQUEST['actions'] ) ) {
			return;
		}

		$axax_actions = json_decode( stripslashes( $_REQUEST['actions'] ), true );
		$template = false;

		foreach ( $axax_actions as $data => $action_data ) {
			if ( !isset( $action_data['get_template_data'] ) ) {
				$template = $action_data;
			}
		}

		if ( !isset( $template['data'] ) || empty( $template['data'] ) ) {
			return;
		}

		if ( empty( $template['data']['template_id'] ) ) {
			return;
		}

		if ( false === strpos( $template['data']['template_id'], 'sina_ext_' ) ) {
			return;
		}

		$ajax->register_ajax_action( 'get_template_data', [$this, 'get_template'] );
	}

	/**
	 * Get template.
	 *
	 * @since 3.1.0
	 */
	public function get_template( $args ) {
		$template_source = Plugin::instance()->templates_manager->get_source( 'sina_ext_templates' );
		$template 	= $template_source->get_data( $args );

		return $template;
	}

	/**
	 * Register template source.
	 *
	 * @since 3.1.0
	 */
	public function library_source() {
		require_once( SINA_EXT_INC .'sina-ext-library.php' );
		Plugin::instance()->templates_manager->register_source( 'Elementor\TemplateLibrary\Sina_Ext_Library' );
	}
}