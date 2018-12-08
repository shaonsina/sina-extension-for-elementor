<?php

/**
 * Image Zoomer Widget.
 *
 * @since 1.1.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Plugin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Image_Zoomer_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.1.0
	 */
	public function get_name() {
		return 'sina_image_zoomer';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.1.0
	 */
	public function get_title() {
		return __( 'Sina Image Zoomer', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.1.0
	 */
	public function get_icon() {
		return 'fa fa-search-plus';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.1.0
	 */
	public function get_categories() {
		return [ 'sina-extension' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.1.0
	 */
	public function get_keywords() {
		return [ 'sina image zoomer', 'visitor', 'sina' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.1.0
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
	 * @since 1.1.0
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
	 * @since 1.1.0
	 * @access protected
	 */
	protected function _register_controls() {
		// Start Image Zoomer
		// ===================
		$this->start_controls_section(
			'zoomer_content',
			[
				'label' => __( 'Zoomer Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->end_controls_section();
		// End Image Zoomer
		// =================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-image-zoomer">
		</div><!-- .sina-image-zoomer -->
		<?php
	}


	protected function _content_template() {

	}
}