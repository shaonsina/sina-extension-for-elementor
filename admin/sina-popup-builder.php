<?php

/**
 * Popup Builder.
 *
 * @since 3.9.0
 */

use \Elementor\Controls_Manager;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Popup_Builder extends \Elementor\Core\Base\Document{
	public function get_name() {
		return 'sina_popup';
	}

	public static function get_type() {
		return 'sina_popup';
	}

	public static function get_title() {
		return esc_html__( 'Sina Popup', 'sina-ext' );
	}

	protected function register_controls() {
		// Start Settings
		// ===============
			$this->start_controls_section(
				'popup_settings',
				[
					'label' => esc_html__( 'Settings', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_SETTINGS,
				]
			);

				$this->add_control(
					'before_text',
					[
						'label' => esc_html__( 'Before Text', 'sina-ext' ),
						'type' => Controls_Manager::TEXT,
					]
				);

			$this->end_controls_section();
		// End Settings
		// =============

		// Start Style
		// ============
			$this->start_controls_section(
				'popup_style',
				[
					'label' => esc_html__( 'Style', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::site_info( $this, '{{WRAPPER}} .sina-popup', 'popup' );
			$this->end_controls_section();
		// End Style
		// ==========
	}
}