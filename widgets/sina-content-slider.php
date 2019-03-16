<?php

/**
 * Content Slider Widget.
 *
 * @since 1.3.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Content_Slider_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.3.0
	 */
	public function get_name() {
		return 'sina_content_slider';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.3.0
	 */
	public function get_title() {
		return __( 'Sina Content Slider', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.3.0
	 */
	public function get_icon() {
		return 'eicon-slider-push';
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
		return [ 'sina slider', 'sina content slider' ];
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
	 * Get widget scripts.
	 *
	 * Retrieve the list of scripts the widget belongs to.
	 *
	 * @since 1.3.0
	 */
	public function get_script_depends() {
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
		// Start Slider Content
		// =====================
		$this->start_controls_section(
			'slider_content',
			[
				'label' => __( ' Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->end_controls_section();
		// End Slider Content
		// ===================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-content-slider">
		</div><!-- .sina-content-slider -->
		<?php
	}


	protected function _content_template() {

	}
}