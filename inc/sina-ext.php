<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Sina_Extension\Sina_Ext_Functions;

/**
 * Sina_Extension Class
 *
 * @since 3.0.0
 */
class Sina_Extension extends Sina_Ext_Functions{
	/**
	 * Instance
	 *
	 * @since 3.0.0
	 * @var Sina_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 3.0.0
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
	 * @since 3.0.0
	 */
	public function __construct() {
		$this->files();
		$this->load_actions();
		$this->load_filters();
		$this->init();
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
		require_once( SINA_EXT_INC .'sina-ext-manager.php' );
		require_once( SINA_EXT_INC .'sina-ext-controls.php' );
		require_once( SINA_EXT_INC .'sina-ext-controls-extend.php' );
	}
}
