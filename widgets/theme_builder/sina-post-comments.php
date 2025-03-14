<?php

/**
 * Post Comments Widget.
 *
 * @since 3.7.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Plugin;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Post_Comments_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 3.7.0
	 */
	public function get_name() {
		return 'sina_post_comments';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.7.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Post Comments', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.7.0
	 */
	public function get_icon() {
		return 'eicon-comments';
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
		return [ 'sina post comments', 'sina theme builder' ];
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
		// Start Comments Title Style
		// ===========================
			$selector = '{{WRAPPER}} #comments .comments-title, {{WRAPPER}} .title-comments';
			$this->start_controls_section(
				'comments_title_style',
				[
					'label' => esc_html__( 'Comments Title', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::post_comments_title( $this, $selector, 'comments_title' );
			$this->end_controls_section();
		// End Comments Title Style
		// =========================

		// Start Reply Title Style
		// ========================
			$this->start_controls_section(
				'reply_title_style',
				[
					'label' => esc_html__( 'Reply Title', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::post_comments_title( $this, '{{WRAPPER}} .comment-reply-title', 'reply_title' );
			$this->end_controls_section();
		// End Reply Title Style
		// ======================

		// Start Comment List Style
		// =========================
			$selector = '{{WRAPPER}} #comments li';
			$this->start_controls_section(
				'list_style',
				[
					'label' => esc_html__( 'Comment List', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' => 'list_typography',
						'selector' => $selector,
					]
				);
				$this->add_control(
					'list_color',
					[
						'label' => esc_html__( 'Color', 'sina-ext' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							$selector => 'color: {{VALUE}};',
						],
					]
				);
				Sina_Common_Data::post_comments_list( $this, $selector, 'list' );

			$this->end_controls_section();
		// End Comment List Style
		// =======================

		// Start Link Style
		// =================
			$this->start_controls_section(
				'link_style',
				[
					'label' => esc_html__( 'Link', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::link_style( $this, '{{WRAPPER}} .sina-post-comments a', 'link');
			$this->end_controls_section();
		// End Link Style
		// ===============

		// Start Edit Link Style
		// ======================
			$this->start_controls_section(
				'edit_link_style',
				[
					'label' => esc_html__( 'Edit Link', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::link_style( $this, '{{WRAPPER}} .comment-edit-link', 'edit_link');
			$this->end_controls_section();
		// End Edit Link Style
		// ====================

		// Start Delete Link Style
		// ========================
			$this->start_controls_section(
				'delete_link_style',
				[
					'label' => esc_html__( 'Delete Link', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::link_style( $this, '{{WRAPPER}} .comment-delete-link', 'delete_link');
			$this->end_controls_section();
		// End Delete Link Style
		// ======================

		// Start Reply Link Style
		// =======================
			$this->start_controls_section(
				'reply_link_style',
				[
					'label' => esc_html__( 'Reply Link', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::link_style( $this, '{{WRAPPER}} #comments .comment-reply-link', 'reply_link');
			$this->end_controls_section();
		// End Reply Link Style
		// =====================

		// Start Time Style
		// =================
			$selector = '{{WRAPPER}} time';
			$this->start_controls_section(
				'time_style',
				[
					'label' => esc_html__( 'Time', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' => 'time_typography',
						'selector' => $selector,
					]
				);
				$this->add_control(
					'time_color',
					[
						'label' => esc_html__( 'Color', 'sina-ext' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							$selector => 'color: {{VALUE}};',
						],
					]
				);

			$this->end_controls_section();
		// End Time Style
		// ===============

		// Start Input Style
		// ==================
			$selector = '{{WRAPPER}} input';
			$this->start_controls_section(
				'fields_style',
				[
					'label' => esc_html__( 'Input Fields', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

				Sina_Common_Data::input_fields_style( $this, 'input' );
				$this->add_responsive_control(
					'input_radius',
					[
						'label' => esc_html__( 'Radius', 'sina-ext' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors' => [
							$selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'input_padding',
					[
						'label' => esc_html__( 'Padding', 'sina-ext' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors' => [
							$selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

			$this->end_controls_section();
		// End Input Style
		// ================

		// Start Textarea Style
		// =====================
			$selector = '{{WRAPPER}} textarea';
			$this->start_controls_section(
				'textarea_style',
				[
					'label' => esc_html__( 'Textarea', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

				$this->add_control(
					'textarea_placeholder_color',
					[
						'label' => esc_html__( 'Placeholder Color', 'sina-ext' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#aaa',
						'selectors' => [
							$selector.'::-webkit-input-placeholder' => 'color: {{VALUE}};',
							$selector.'::-moz-placeholder' => 'color: {{VALUE}};',
							$selector.'::-ms-placeholder' => 'color: {{VALUE}};',
							$selector.'::placeholder' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' => 'textarea_typography',
						'fields_options' => [
							'typography' => [ 
								'default' =>'custom', 
							],
							'font_weight' => [
								'default' => '400',
							],
							'font_size'   => [
								'default' => [
									'size' => '16',
								],
							],
							'line_height'   => [
								'default' => [
									'size' => '24',
								],
							],
						],
						'selector' => $selector,
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'textarea_shadow',
						'selector' => $selector,
					]
				);

				$this->start_controls_tabs( 'textarea_tabs' );
					$this->start_controls_tab(
						'textarea_normal',
						[
							'label' => esc_html__( 'Normal', 'sina-ext' ),
						]
					);
						$this->add_control(
							'textarea_color',
							[
								'label' => esc_html__( 'Text Color', 'sina-ext' ),
								'type' => Controls_Manager::COLOR,
								'default' => '#222',
								'selectors' => [
									$selector => 'color: {{VALUE}};',
								],
							]
						);
						$this->add_control(
							'textarea_background',
							[
								'label' => esc_html__( 'Background', 'sina-ext' ),
								'type' => Controls_Manager::COLOR,
								'default' => '#fff',
								'selectors' => [
									$selector => 'background: {{VALUE}};',
								],
							]
						);
						$this->add_group_control(
							Group_Control_Border::get_type(),
							[
								'name' => 'textarea_border',
								'fields_options' => [
									'border' => [
										'default' => 'solid',
									],
									'color' => [
										'default' => '#1085e4',
									],
									'width' => [
										'default' => [
											'top' => '1',
											'right' => '1',
											'bottom' => '1',
											'left' => '1',
											'isLinked' => true,
										]
									],
								],
								'selector' => $selector,
							]
						);
					$this->end_controls_tab();

					$this->start_controls_tab(
						'textarea_focus',
						[
							'label' => esc_html__( 'Focus', 'sina-ext' ),
						]
					);
						$this->add_control(
							'textarea_focus_color',
							[
								'label' => esc_html__( 'Text Color', 'sina-ext' ),
								'type' => Controls_Manager::COLOR,
								'selectors' => [
									$selector.':focus' => 'color: {{VALUE}};',
								],
							]
						);
						$this->add_control(
							'textarea_focus_background',
							[
								'label' => esc_html__( 'Background', 'sina-ext' ),
								'type' => Controls_Manager::COLOR,
								'selectors' => [
									$selector.':focus' => 'background: {{VALUE}};',
								],
							]
						);
						$this->add_control(
							'textarea_focus_border',
							[
								'label' => esc_html__( 'Border Color', 'sina-ext' ),
								'type' => Controls_Manager::COLOR,
								'selectors' => [
									$selector.':focus' => 'border-color: {{VALUE}}'
								],
							]
						);
					$this->end_controls_tab();
				$this->end_controls_tabs();

				$this->add_responsive_control(
					'textarea_height',
					[
						'label' => esc_html__( 'Height', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em' ],
						'range' => [
							'px' => [
								'max' => 1000,
							],
						],
						'separator' => 'before',
						'selectors' => [
							$selector => 'height: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'textarea_radius',
					[
						'label' => esc_html__( 'Radius', 'sina-ext' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors' => [
							$selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'textarea_padding',
					[
						'label' => esc_html__( 'Padding', 'sina-ext' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors' => [
							$selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'textarea_margin',
					[
						'label' => esc_html__( 'Margin', 'sina-ext' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors' => [
							$selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

			$this->end_controls_section();
		// End Textarea Style
		// ===================

		// Start Submit Style
		// ===================
			$this->start_controls_section(
				'submit_style',
				[
					'label' => esc_html__( 'Submit Button', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::input_button_style( $this, '{{WRAPPER}} [type="submit"]', 'submit', '{{WRAPPER}} [type="submit"]' );
			$this->end_controls_section();
		// End Submit Style
		// =================
	}


	protected function render() {
		Sina_Common_Data::switch_to_last_post();

		if ( !comments_open() && ( Plugin::$instance->preview->is_preview_mode() || Plugin::$instance->editor->is_edit_mode() ) ) :
			?>
			<div class="elementor-alert elementor-alert-danger" role="alert">
				<span class="elementor-alert-title">
					<?php esc_html_e( 'Comments are Closed!', 'elementor-pro' ); ?>
				</span>
				<span class="elementor-alert-description">
					<?php esc_html_e( 'Switch on comments from either the discussion box on the WordPress post edit screen or from the WordPress discussion settings.', 'elementor-pro' ); ?>
				</span>
			</div>
		<?php
		else :
			?>
			<div class="sina-post-comments">
				<?php comments_template(); ?>
			</div><!-- .sina-post-comments -->
			<?php
		endif;
	}


	protected function content_template() {

	}
}