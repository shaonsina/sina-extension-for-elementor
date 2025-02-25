<?php

/**
 * Search Widget.
 *
 * @since 3.7.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Search_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 3.7.0
	 */
	public function get_name() {
		return 'sina_search';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.7.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Search', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.7.0
	 */
	public function get_icon() {
		return 'eicon-search-bold';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 3.7.0
	 */
	public function get_categories() {
		return [ 'sina-header-footer' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 3.7.0
	 */
	public function get_keywords() {
		return [ 'sina search', 'sina header', 'sina footer' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 3.7.0
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
	 * @since 3.7.0
	 */
	public function get_script_depends() {
		return [
			'sina-widgets',
		];
	}

	public function get_icon_list() {
		return [
			'icofont icofont-ui-search' => 'icofont-ui-search',
			'icofont icofont-search-1' => 'icofont-search-1',
			'icofont icofont-search-2' => 'icofont-search-2',
			'icofont icofont-search' => 'icofont-search',
			'fa fa-search' => 'search',
			'eicon-search' => 'eicon-search',
			'eicon-search-bold' => 'eicon-search-bold',
		];
	}

	public function get_close_icon_list() {
		return [
			'icofont icofont-ui-close' => 'icofont-ui-close',
			'icofont icofont-close-circled' => 'icofont-close-circled',
			'icofont icofont-close-line-circled' => 'icofont-close-line-circled',
			'icofont icofont-close-line-squared-alt' => 'icofont-close-line-squared-alt',
			'icofont icofont-close-line-squared' => 'icofont-close-line-squared',
			'icofont icofont-close-line' => 'icofont-close-line',
			'icofont icofont-close-squared-alt' => 'icofont-close-squared-alt',
			'icofont icofont-close-squared' => 'icofont-close-squared',
			'icofont icofont-close' => 'icofont-close',
			'fa fa-close' => 'close',
			'fa fa-window-close' => 'window-close',
			'fa fa-window-close-o' => 'window-close-o',
			'eicon-editor-close' => 'eicon-editor-close',
			'eicon-close' => 'eicon-close',
			'eicon-close-circle' => 'eicon-close-circle',
		];
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
		$search_icons = $this->get_icon_list();
		$get_extenders 	= get_option( 'sina_extenders' );
		$selector = '.elementor-element-{{ID}} .sina-search .sina-button';
		// Start Search Button
		// ====================
			$this->start_controls_section(
				'button_content',
				[
					'label' => esc_html__( 'Search Button', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

				$this->add_control(
					'btn_icon',
					[
						'label' => esc_html__( 'Search Icon', 'sina-ext' ),
						'label_block' => true,
						'type' => Controls_Manager::ICON,
						'include' => $search_icons,
						'default' => 'icofont icofont-ui-search',
					]
				);
				$this->add_control(
					'btn_text',
					[
						'label' => esc_html__( 'Button Label', 'sina-ext' ),
						'type' => Controls_Manager::TEXT,
						'placeholder' => esc_html__( 'Enter Text', 'sina-ext' ),
					]
				);
				$this->add_control(
					'btn_icon_align',
					[
						'label' => esc_html__( 'Icon Position', 'sina-ext' ),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'left' => esc_html__( 'Left', 'sina-ext' ),
							'right' => esc_html__( 'Right', 'sina-ext' ),
						],
						'default' => 'left',
						'condition' => [
							'btn_icon!' => '',
						],
					]
				);
				$this->add_responsive_control(
					'btn_icon_space',
					[
						'label' => esc_html__( 'Icon Spacing', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'default' => [
							'size' => '5',
						],
						'condition' => [
							'btn_text!' => '',
							'btn_icon!' => '',
						],
						'selectors' => [
							$selector.' .sina-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
							$selector.' .sina-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
							'.rtl '.$selector.' .sina-icon-right' => 'margin-right: {{SIZE}}{{UNIT}}; margin-left: auto;',
							'.rtl '.$selector.' .sina-icon-left' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: auto;',
						],
					]
				);

			$this->end_controls_section();
		// End Search Button
		// ==================

		// Start Search Form
		// ==================
			$this->start_controls_section(
				'form_content',
				[
					'label' => esc_html__( 'Search Form', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

				$this->add_control(
					'form_icon',
					[
						'label' => esc_html__( 'Search Icon', 'sina-ext' ),
						'label_block' => true,
						'type' => Controls_Manager::ICON,
						'include' => $search_icons,
						'default' => 'icofont icofont-ui-search',
					]
				);
				$this->add_control(
					'form_text',
					[
						'label' => esc_html__( 'Placeholder Text', 'sina-ext' ),
						'type' => Controls_Manager::TEXT,
						'placeholder' => esc_html__( 'Enter Text', 'sina-ext' ),
						'default' => 'Search...',
					]
				);
				$this->add_control(
					'form_anim',
					[
						'label' => esc_html__( 'Form Animation', 'sina-ext' ),
						'type' => Controls_Manager::SELECT,
						'label_block' => true,
						'default' => 'fadeInDown',
						'options' => Sina_Common_Data::animation(),
					]
				);
				$this->add_control(
					'overlay_anim',
					[
						'label' => esc_html__( 'Overlay Animation', 'sina-ext' ),
						'type' => Controls_Manager::SELECT,
						'label_block' => true,
						'default' => 'fadeIn',
						'options' => Sina_Common_Data::animation(),
					]
				);

				$this->add_control(
					'modal_close_settings',
					[
						'label' => esc_html__( 'Closing Settings', 'sina-ext' ),
						'type' => Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$this->add_control(
					'close_icon',
					[
						'label' => esc_html__( 'Close Icon', 'sina-ext' ),
						'label_block' => true,
						'type' => Controls_Manager::ICON,
						'include' => $this->get_close_icon_list(),
						'default' => 'icofont icofont-close',
					]
				);
				$this->add_control(
					'is_outside_click',
					[
						'label' => esc_html__( 'Close to click outside', 'sina-ext' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'yes',
					]
				);
				$this->add_control(
					'is_esc_press',
					[
						'label' => esc_html__( 'Close to press ESC', 'sina-ext' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'yes',
					]
				);

			$this->end_controls_section();
		// End Search Form
		// ================


		// Start Button Style
		// ===================
			$this->start_controls_section(
				'button_style',
				[
					'label' => esc_html__( 'Search Button', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::link_style( $this, '.sina-search .sina-button', 'btn' );
			$this->end_controls_section();
		// End Button Style
		// =================

		if (!empty($get_extenders) && isset($get_extenders['sticky'])) {
			// Start Sticky Button Style
			// ==========================
				$this->start_controls_section(
					'sticky_btn_style',
					[
						'label' => esc_html__( 'Sticky Search Button', 'sina-ext' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);
				Sina_Common_Data::link_style( $this, '.sina-search .sina-button', 'sticky_btn', '.sina-pro-sticked ' );
				$this->end_controls_section();
			// End Sticky Button Style
			// ========================
		}

		// Start Form Style
		// =================
			$this->start_controls_section(
				'form_style',
				[
					'label' => esc_html__( 'Search Form', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
				$selector = '{{WRAPPER}} .sina-search-form';
				$this->add_control(
					'placeholder_color',
					[
						'label' => esc_html__( 'Placeholder Color', 'sina-ext' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#eee',
						'selectors' => [
							'{{WRAPPER}} .sina-input-field::-webkit-input-placeholder' => 'color: {{VALUE}};',
							'{{WRAPPER}} .sina-input-field::-moz-placeholder' => 'color: {{VALUE}};',
							'{{WRAPPER}} .sina-input-field::-ms-placeholder' => 'color: {{VALUE}};',
							'{{WRAPPER}} .sina-input-field::placeholder' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' => 'fields_typography',
						'selector' => $selector,
					]
				);
				$this->add_control(
					'color',
					[
						'label' => esc_html__( 'Text Color', 'sina-ext' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#fff',
						'selectors' => [
							$selector.' .sina-input-field' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'background',
					[
						'label' => esc_html__( 'Background', 'sina-ext' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							$selector => 'background: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'fields_shadow',
						'selector' => $selector,
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'border',
						'fields_options' => [
							'border' => [
								'default' => 'solid',
							],
							'color' => [
								'default' => '#fff',
							],
							'width' => [
								'default' => [
									'top' => '2',
									'right' => '2',
									'bottom' => '2',
									'left' => '2',
									'isLinked' => true,
								]
							],
						],
						'selector' => $selector,
					]
				);
				$this->add_responsive_control(
					'form_width',
					[
						'label' => esc_html__( 'Width', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em', '%'],
						'range' => [
							'px' => [
								'max' => 1000,
							],
							'em' => [
								'max' => 100,
							],
						],
						'default' => [
							'unit' => 'px',
							'size' => 270,
						],
						'selectors' => [
							$selector.' .sina-input-field' => 'width: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'form_radius',
					[
						'label' => esc_html__( 'Radius', 'sina-ext' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'default' => [
							'top' => '50',
							'right' => '50',
							'bottom' => '50',
							'left' => '50',
							'isLinked' => true,
						],
						'selectors' => [
							$selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'form_padding',
					[
						'label' => esc_html__( 'Padding', 'sina-ext' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'default' => [
							'top' => '15',
							'right' => '20',
							'bottom' => '15',
							'left' => '20',
							'isLinked' => false,
						],
						'selectors' => [
							$selector.' .sina-input-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
					'search_btn',
					[
						'label' => esc_html__( 'Search Button', 'sina-ext' ),
						'type' => Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$this->add_control(
					'search_btn_color',
					[
						'label' => esc_html__( 'Color', 'sina-ext' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#fff',
						'selectors' => [
							$selector.' .sina-button' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_responsive_control(
					'search_btn_padding',
					[
						'label' => esc_html__( 'Padding', 'sina-ext' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'default' => [
							'top' => '0',
							'right' => '18',
							'bottom' => '0',
							'left' => '18',
							'isLinked' => false,
						],
						'selectors' => [
							$selector.' .sina-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
					'overlay',
					[
						'label' => esc_html__( 'Overlay Background', 'sina-ext' ),
						'type' => Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' => 'overlay_bg',
						'types' => [ 'classic', 'gradient' ],
						'fields_options' => [
							'background' => [ 
								'default' =>'classic', 
							],
							'color' => [
								'default' => 'rgba(0,0,0,0.5)',
							],
						],
						'selector' => '{{WRAPPER}} .sina-modal-overlay',
					]
				);
			$this->end_controls_section();
		// End Form Style
		// ===============

		// Start Close Button Style
		// =========================
			$selector = '.elementor-element-{{ID}} .sina-search .sina-modal-close';
			$this->start_controls_section(
				'close_button_style',
				[
					'label' => esc_html__( 'Close Button', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

				$this->add_control(
					'close_btn_position',
					[
						'label' => esc_html__( 'Position', 'sina-ext' ),
						'type' => Controls_Manager::CHOOSE,
						'options' => [
							'left' => [
								'title' => esc_html__( 'Left', 'sina-ext' ),
								'icon' => 'eicon-h-align-left',
							],
							'right' => [
								'title' => esc_html__( 'Right', 'sina-ext' ),
								'icon' => 'eicon-h-align-right',
							],
						],
						'default' => 'right',
					]
				);
				$this->add_control(
					'close_btn_v_spacing',
					[
						'label' => esc_html__( 'Top Spacing', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em', '%' ],
						'range' => [
							'px' => [
								'max' => 500,
							],
							'em' => [
								'max' => 50,
							],
							'%' => [
								'max' => 100,
							],
						],
						'default' => [
							'unit' => 'px',
							'size' => 30,
						],
						'selectors' => [
							$selector => 'top: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_control(
					'close_btn_h_spacing',
					[
						'label' => esc_html__( 'Left/Right Spacing', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em', '%' ],
						'range' => [
							'px' => [
								'max' => 500,
							],
							'em' => [
								'max' => 50,
							],
							'%' => [
								'max' => 100,
							],
						],
						'default' => [
							'unit' => 'px',
							'size' => 30,
						],
						'selectors' => [
							$selector => '{{close_btn_position.VALUE || "right"}}: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_control(
					'close_btn_icon_size',
					[
						'label' => esc_html__( 'Icon Size', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em', '%' ],
						'range' => [
							'px' => [
								'max' => 500,
							],
							'em' => [
								'max' => 50,
							],
							'%' => [
								'max' => 100,
							],
						],
						'default' => [
							'unit' => 'px',
							'size' => 24,
						],
						'selectors' => [
							$selector => 'font-size: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_control(
					'close_btn_color',
					[
						'label' => esc_html__( 'Color', 'sina-ext' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#fff',
						'selectors' => [
							$selector => 'color: {{VALUE}};',
						],
					]
				);

			$this->end_controls_section();
		// End Close Button Style
		// =======================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-search"
		data-click="<?php echo esc_attr( $data['is_outside_click'] ); ?>"
		data-esc="<?php echo esc_attr( $data['is_esc_press'] ); ?>">
			<div class="sina-modal-overlay animated <?php echo esc_attr( $data['overlay_anim'] ); ?>">
				<button class="sina-button sina-modal-close">
					<i class="<?php echo esc_attr( $data['close_icon'] ); ?>"></i>
				</button>
				<div class="sina-modal-area sina-flex animated <?php echo esc_attr( $data['form_anim'] ); ?>">
					<form class="sina-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<input class="sina-input-field" type="search" placeholder="<?php echo esc_attr( $data['form_text'] ); ?>" value="<?php get_search_query(); ?>" name="<?php echo esc_attr( 's' ) ?>" data-gtm-form-interact-field-id="0">
						<button class="sina-button" type="submit">
							<i class="<?php echo esc_attr( $data['form_icon'] ); ?>"></i>
						</button>
					</form>
				</div>
			</div>
			<button class="sina-button">
				<?php Sina_Common_Data::button_html($data); ?>
			</button>
		</div><!-- .sina-search -->
		<?php
	}


	protected function content_template() {

	}
}