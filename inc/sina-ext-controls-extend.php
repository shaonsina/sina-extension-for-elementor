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
	public function __construct() {
		$this->controls_files();

		add_action('elementor/controls/controls_registered', array( $this, 'icon' ), 15 );
	}

	private function controls_files(){
		require_once SINA_EXT_INC .'controls/icon.php';
	}

	public function icon( $manager ) {
		$manager->unregister_control( $manager::ICON );
		$manager->register_control( $manager::ICON, new \Sina_Extension\Sina_Ext_Icon());
	}
}