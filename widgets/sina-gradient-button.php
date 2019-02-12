<?php

/**
 * Gradient Button Widget.
 *
 * @since 1.3.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Gradient_Button_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.3.0
	 */
	public function get_name() {
		return 'sina_gradient_btn';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.3.0
	 */
	public function get_title() {
		return __( 'Sina Gradient Button', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.3.0
	 */
	public function get_icon() {
		return 'eicon-button';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.3.0
	 */
	public function get_categories() {
		return [ 'sina-extension' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.3.0
	 */
	public function get_keywords() {
		return [ 'sina button', 'sina gradient button' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.3.0
	 */
	public function get_style_depends() {
		return [
			'sina-widgets',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.3.0
	 */
	protected function _register_controls() {
		// Start 
		// ===================
		$this->start_controls_section(
			'button_content',
			[
				'label' => __( 'Button Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->end_controls_section();
		// End 
		// =================

		// Start 
		// ===================
		$this->start_controls_section(
			'button_style',
			[
				'label' => __( 'Button Style', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'sina-ext' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-gb',
			]
		);

		$this->end_controls_section();
		// End 
		// =================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-gradient-button">
			<a href="#" class="sina-gb">Gradient Button</a>
		</div><!-- .sina-gradient-button -->
		<?php
	}


	protected function _content_template() {

	}
}