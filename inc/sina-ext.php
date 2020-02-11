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
		$this->init();
	}
}
