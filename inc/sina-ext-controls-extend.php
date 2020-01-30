<?php
namespace Sina_Extension;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sina_Ext_Controls Class for extends controls
 *
 * @since 3.0.1
 */
class Sina_Ext_Controls{
	/**
	 * Instance
	 *
	 * @since 3.1.13
	 * @var Sina_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 3.1.13
	 * @return Sina_Extension An Instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		$this->controls_files();

		add_action('elementor/controls/controls_registered', [$this, 'controls'], 15 );
	}

	private function controls_files(){
		require_once SINA_EXT_INC .'controls/icon.php';
		require_once SINA_EXT_INC .'controls/gradient-text.php';
	}

	public function controls( $manager ) {
		$manager->unregister_control( $manager::ICON );
		$manager->register_control( $manager::ICON, new \Sina_Extension\Sina_Ext_Icon());
		$manager->add_group_control( Sina_Ext_Gradient_Text::get_type(), new \Sina_Extension\Sina_Ext_Gradient_Text());
	}
}