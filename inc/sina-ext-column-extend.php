<?php
namespace Sina_Extension;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Elementor\Controls_Manager;

/**
 * Sina_Ext_Column_Extend Class for extends controls
 *
 * @since 3.2.0
 */
class Sina_Ext_Column_Extend{
	/**
	 * Instance
	 *
	 * @since 3.2.0
	 * @var Sina_Ext_Column_Extend The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 3.2.0
	 * @return Sina_Ext_Column_Extend An Instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		add_action('elementor/element/column/layout/before_section_end', [$this, 'register_controls'], 15 );
	}

	public static function register_controls($elems) {
		$elems->add_control(
			'sina_column_options',
			[
				'label' => __( 'Sina Column Options', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$elems->add_responsive_control(
			'sina_custom_column_width',
			[
				'label' => __( 'Custom Width', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'description' => __( 'You can use any CSS value that you want. Like: 100px, 100em, 100%, calc(100% - 100px) and so on...', 'sina-ext' ),
				'selectors' => [
					'{{WRAPPER}}.elementor-column' => 'width: {{VALUE}};',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_column_order',
			[
				'label' => __( 'Column Order', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}}.elementor-column' => '-ms-flex-order:{{VALUE}}; order: {{VALUE}};',
				],
				'description' => sprintf(
					__( 'The column will display according to that order number of this section.', 'sina-ext' ),
				),
			]
		);
	}

}