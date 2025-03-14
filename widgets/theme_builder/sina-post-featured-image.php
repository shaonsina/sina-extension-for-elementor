<?php

/**
 * Post Featured Image Widget.
 *
 * @since 3.7.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Post_Featured_Image_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 3.7.0
	 */
	public function get_name() {
		return 'sina_post_featured_image';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.7.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Post Featured Image', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.7.0
	 */
	public function get_icon() {
		return 'eicon-featured-image';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 3.7.0
	 */
	public function get_categories() {
		return [ 'sina-theme-builder' ];
	}

	public function show_in_panel() {
		return Sina_Common_Data::widget_show_in_panel();
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 3.7.0
	 */
	public function get_keywords() {
		return [ 'sina post featured image', 'sina theme builder' ];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.7.0
	 * @access protected
	 */
	protected function register_controls() {
		// Start Post Featured Image
		// ==========================
			$this->start_controls_section(
				'post_featured_img_content',
				[
					'label' => esc_html__( 'Post Featured Image', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

				$this->add_control(
					'overlay',
					[
						'label' => esc_html__( 'Show Overlay', 'sina-ext' ),
						'type' => Controls_Manager::SWITCHER,
					]
				);

			$this->end_controls_section();
		// End Post Featured Image
		// ========================


		// Start Featured Image Style
		// ===========================
			$selector = '{{WRAPPER}} .sina-post-featured-img';
			$this->start_controls_section(
				'post_featured_img_style',
				[
					'label' => esc_html__( 'Featured Image', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

				$this->add_responsive_control(
					'img_width',
					[
						'label' => esc_html__( 'Width', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em', '%' ],
						'range' => [
							'px' => [
								'max' => 1000,
							],
						],
						'default' => [
							'unit' => '%',
							'size' => 100,
						],
						'selectors' => [
							$selector => 'width: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'img_height',
					[
						'label' => esc_html__( 'Height', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em', '%' ],
						'range' => [
							'px' => [
								'max' => 1000,
							],
						],
						'default' => [
							'unit' => 'px',
							'size' => 500,
						],
						'selectors' => [
							$selector => 'height: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' => 'overlay_bg',
						'types' => [ 'classic', 'gradient' ],
						'fields_options' => [
							'background' => [
								'label' => esc_html__( 'Overlay Background', 'sina-ext' ),
							],
						],
						'condition' => [
							'overlay' => 'yes',
						],
						'selector' => $selector.' .sina-overlay',
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'overlay_shadow',
						'selector' => $selector,
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'border',
						'selector' => $selector,
					]
				);
				$this->add_responsive_control(
					'radius',
					[
						'label' => esc_html__( 'Radius', 'sina-ext' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors' => [
							$selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

			$this->end_controls_section();
		// End Featured Image Style
		// =========================
	}


	protected function render() {
		Sina_Common_Data::switch_to_last_post();
		if ( has_post_thumbnail() ):
			$data = $this->get_settings_for_display();
			?>
			<div class="sina-post-featured-img sina-bg-cover" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
				<?php if ('yes' == $data['overlay']): ?>
					<div class="sina-overlay"></div>
				<?php endif; ?>
			</div><!-- .sina-post-featured-img -->
			<?php
		endif;
	}


	protected function content_template() {

	}
}