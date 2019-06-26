<?php
/**
 * Modal Box Widget.
 *
 * @since 2.2.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Frontend;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Modal_Box_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 2.2.0
	 */
	public function get_name() {
		return 'sina_modal_box';
	}

	/**
	 * Get widget title.
	 *
	 * @since 2.2.0
	 */
	public function get_title() {
		return __( 'Sina Modal Box', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 2.2.0
	 */
	public function get_icon() {
		return 'eicon-info-box';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 2.2.0
	 */
	public function get_categories() {
		return [ 'sina-ext-advanced' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.2.0
	 */
	public function get_keywords() {
		return [ 'sina modal box', 'sina content box', 'sina box' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 2.2.0
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
	 * @since 2.2.0
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
	 * @since 2.2.0
	 */
	protected function _register_controls() {
		// Start Modal Content
		// ====================
		$this->start_controls_section(
			'modal_content',
			[
				'label' => __( 'Modal Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'save_templates',
			[
				'label' => __( 'Use Save Templates', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'template',
			[
				'label' => __( 'Choose Template', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => sina_get_page_templates(),
				'condition' => [
					'save_templates!' => '',
				],
				'description' => __('NOTE: Don\'t try to edit after insertion template. If you need to change the style or layout then you try to change the main template then save and then insert', 'sina-ext'),
			]
		);
		$this->add_control(
			'modal_header',
			[
				'label' => __( 'Header Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Header Text', 'sina-ext' ),
				'description' => __( 'You can use HTML.', 'sina-ext' ),
				'default' => 'This is the modal box',
			]
		);
		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Title', 'sina-ext' ),
				'description' => __( 'You can use HTML.', 'sina-ext' ),
				'default' => 'This is the modal title',
				'condition' => [
					'save_templates' => '',
				],
			]
		);
		$this->add_control(
			'desc',
			[
				'label' => __( 'Description', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter Description', 'sina-ext' ),
				'description' => __( 'You can use HTML.', 'sina-ext' ),
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
				'condition' => [
					'save_templates' => '',
				],
			]
		);

		$this->end_controls_section();
		// End Modal Content
		// ==================


		// Start Trigger Button Content
		// =============================
		$this->start_controls_section(
			'trigger_button',
			[
				'label' => __( 'Trigger Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		Sina_Common_Data::button_content( $this, '.sina-modal-box', 'Clicke Here', 'trigger',  false );
		$this->add_control(
			'trigger_id',
			[
				'label' => __( 'CSS ID', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter ID', 'sina-ext' ),
				'description' => __( 'Make sure this ID unique', 'sina-ext' ),
			]
		);
		$this->end_controls_section();
		// End Trigger Button Content
		// ===========================


		// Start Modal Style
		// ====================
		$this->start_controls_section(
			'modal_style',
			[
				'label' => __( 'Modal', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'modal_effects',
			[
				'label' => __( 'Effects', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'slideInDown',
				'options' => [
					'fadeIn' => __( 'Fade', 'sina-ext' ),
					'fadeInUp' => __( 'Fade Up', 'sina-ext' ),
					'fadeInDown' => __( 'Fade Down', 'sina-ext' ),
					'fadeInLeft' => __( 'Fade Left', 'sina-ext' ),
					'fadeInRight' => __( 'Fade Right', 'sina-ext' ),
					'zoomIn' => __('Zoom In', 'sina-ext'),
					'zoomInLeft' => __('Zoom In Left', 'sina-ext'),
					'zoomInRight' => __('Zoom In Right', 'sina-ext'),
					'bounceIn' => __('Bounce In', 'sina-ext'),
					'slideInDown' => __('Slide In Down', 'sina-ext'),
					'slideInLeft' => __('Slide In Left', 'sina-ext'),
					'slideInRight' => __('Slide In Right', 'sina-ext'),
					'slideInUp' => __('Slide In Up', 'sina-ext'),
					'lightSpeedIn' => __('Light Speed In', 'sina-ext'),
					'swing' => __( 'Swing', 'sina-ext' ),
					'bounce' => __('Bounce', 'sina-ext'),
					'flash' => __('Flash', 'sina-ext'),
					'pulse' => __('Pulse', 'sina-ext'),
					'rubberBand' => __('Rubber Band', 'sina-ext'),
					'shake' => __('Shake', 'sina-ext'),
					'headShake' => __('Head Shake', 'sina-ext'),
					'swing' => __('Swing', 'sina-ext'),
					'tada' => __('Tada', 'sina-ext'),
					'wobble' => __('Wobble', 'sina-ext'),
					'jello' => __('Jello', 'sina-ext'),
				],
			]
		);
		$this->add_responsive_control(
			'modal_width',
			[
				'label' => __( 'Width', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'max' => 900,
					],
					'%' => [
						'max' => 95,
					],
				],
				'desktop_default' => [
					'size' => 600,
				],
				'mobile_default' => [
					'size' => 300,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-modal-content' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'modal_bg',
				'label' => __( 'Background', 'sina-ext' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#f8f8f8',
					],
				],
				'selector' => '{{WRAPPER}} .sina-modal-content',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'modal_border',
				'selector' => '{{WRAPPER}} .sina-modal-content',
			]
		);
		$this->add_responsive_control(
			'modal_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '8',
					'right' => '8',
					'bottom' => '8',
					'left' => '8',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-modal-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'modal_shadow',
				'fields_options' => [
					'box_shadow_type' => [ 
						'default' =>'yes' 
					],
					'box_shadow' => [
						'default' => [
							'horizontal' => '0',
							'vertical' => '0',
							'blur' => '15',
							'color' => 'rgba(0,0,0,0.5)'
						]
					]
				],
				'selector' => '{{WRAPPER}} .sina-modal-content',
			]
		);
		$this->add_control(
			'modal_overlay',
			[
				'label' => __( 'Overlay Background', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_bg',
				'label' => __( 'Background', 'sina-ext' ),
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
		// End Modal Style
		// =================


		// Start Header Style
		// ===================
		$this->start_controls_section(
			'header_style',
			[
				'label' => __( 'Header', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'modal_header!' => '',
				],
			]
		);

		$this->add_control(
			'header_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-modal-header' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'header_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '600',
					],
					'font_size'   => [
						'default' => [
							'size' => '20',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '28',
						],
					],
					'text_transform' => [
						'default' => 'capitalize',
					],
				],
				'selector' => '{{WRAPPER}} .sina-modal-header',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'header_tshadow',
				'selector' => '{{WRAPPER}} .sina-modal-header',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'header_bg',
				'label' => __( 'Background', 'sina-ext' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#1085e4',
					],
				],
				'selector' => '{{WRAPPER}} .sina-modal-header',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'header_border',
				'selector' => '{{WRAPPER}} .sina-modal-header',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'header_shadow',
				'fields_options' => [
					'box_shadow_type' => [ 
						'default' =>'yes' 
					],
					'box_shadow' => [
						'default' => [
							'horizontal' => '0',
							'vertical' => '0',
							'blur' => '10',
							'color' => 'rgba(0,0,0,0.5)'
						]
					]
				],
				'selector' => '{{WRAPPER}} .sina-modal-header',
			]
		);
		$this->add_responsive_control(
			'header_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '20',
					'right' => '25',
					'bottom' => '20',
					'left' => '25',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-modal-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'header_alignment',
			[
				'label' => __( 'Alignment', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'sina-ext' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'sina-ext' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'sina-ext' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .sina-modal-header' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Header Style
		// ==================


		// Start Footer Style
		// ====================
		$this->start_controls_section(
			'footer_style',
			[
				'label' => __( 'Footer', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'footer_bg',
				'label' => __( 'Background', 'sina-ext' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-modal-footer',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'footer_border',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'color' => [
						'default' => '#eee',
					],
					'width' => [
						'default' => [
							'top' => '1',
							'right' => '0',
							'bottom' => '0',
							'left' => '0',
							'isLinked' => false,
						]
					],
				],
				'selector' => '{{WRAPPER}} .sina-modal-footer',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'footer_shadow',
				'selector' => '{{WRAPPER}} .sina-modal-footer',
			]
		);
		$this->add_responsive_control(
			'footer_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '15',
					'right' => '25',
					'bottom' => '15',
					'left' => '25',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-modal-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'close_btn',
			[
				'label' => __( 'Close Button Style', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'close_btn_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_size'   => [
						'default' => [
							'size' => '14',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '18',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-modal-close',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'close_btn_text_shadow',
				'selector' => '{{WRAPPER}} .sina-modal-close',
			]
		);

		$this->start_controls_tabs( 'close_btn_tabs' );

		$this->start_controls_tab(
			'close_btn_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_control(
			'close_btn_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-modal-close' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'close_btn_background',
				'label' => __( 'Background', 'sina-ext' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => 'rgba(255,255,255,0)',
					],
				],
				'selector' => '{{WRAPPER}} .sina-modal-close',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'close_btn_border',
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
				'selector' => '{{WRAPPER}} .sina-modal-close',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'close_btn_shadow',
				'selector' => '{{WRAPPER}} .sina-modal-close',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'close_btn_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_control(
			'close_hover_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-modal-close:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'close_hover_background',
				'label' => __( 'Background', 'sina-ext' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-modal-close:hover',
			]
		);
		$this->add_control(
			'close_hover_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-modal-close:hover' => 'border-color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'close_btn_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-modal-close:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'close_btn_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '4',
					'right' => '4',
					'bottom' => '4',
					'left' => '4',
					'isLinked' => false,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-modal-close' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'close_btn_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '6',
					'right' => '15',
					'bottom' => '6',
					'left' => '15',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-modal-close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'footer_alignment',
			[
				'label' => __( 'Alignment', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'sina-ext' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'sina-ext' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'sina-ext' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'right',
				'selectors' => [
					'{{WRAPPER}} .sina-modal-footer' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Footer Style
		// ==================


		// Start Body Style
		// ==================
		$this->start_controls_section(
			'body_style',
			[
				'label' => __( 'Body', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'body_height',
			[
				'label' => __( 'Max Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'max' => 900,
					],
				],
				'desktop_default' => [
					'size' => 300,
				],
				'mobile_default' => [
					'size' => 150,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-modal-body' => 'max-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'body_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '15',
					'right' => '25',
					'bottom' => '30',
					'left' => '25',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-modal-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'body_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '25',
					'right' => '0',
					'bottom' => '25',
					'left' => '0',
					'isLinked' => false,
				],
				'condition' => [
					'save_templates!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-modal-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Body Style
		// ==================


		// Start Title Style
		// ====================
		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'title!' => '',
					'save_templates' => '',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-modal-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_size'   => [
						'default' => [
							'size' => '20',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '24',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-modal-title',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-modal-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => __( 'Margin Bottom', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '14',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-modal-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_alignment',
			[
				'label' => __( 'Alignment', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'sina-ext' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'sina-ext' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'sina-ext' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'justify', 'sina-ext' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .sina-modal-title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Title Style
		// ==================


		// Start Desc Style
		// ==================
		$this->start_controls_section(
			'desc_style',
			[
				'label' => __( 'Description', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'desc!' => '',
					'save_templates' => '',
				],
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-modal-desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
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
				'selector' => '{{WRAPPER}} .sina-modal-desc',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'desc_shadow',
				'selector' => '{{WRAPPER}} .sina-modal-desc',
			]
		);
		$this->add_responsive_control(
			'desc_alignment',
			[
				'label' => __( 'Alignment', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'sina-ext' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'sina-ext' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'sina-ext' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'justify', 'sina-ext' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .sina-modal-desc' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Desc Style
		// ================


		// Start Trigger Button Style
		// ===========================
		$this->start_controls_section(
			'trigger_btn_style',
			[
				'label' => __( 'Trigger Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::button_style( $this, '.sina-modal-trigger' );
		$this->add_responsive_control(
			'trigger_btn_width',
			[
				'label' => __( 'Width', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
					'em' => [
						'max' => 50,
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-modal-trigger' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'trigger_btn_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '4',
					'right' => '4',
					'bottom' => '4',
					'left' => '4',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-modal-trigger' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'trigger_btn_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '11',
					'right' => '20',
					'bottom' => '11',
					'left' => '20',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-modal-trigger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'trigger_alignment',
			[
				'label' => __( 'Alignment', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'sina-ext' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'sina-ext' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'sina-ext' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-btn-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Trigger Button Style
		// =========================

	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$trigger_id = $data['trigger_id'] ? $data['trigger_id'] : 'sina-modal-'.$this->get_id();
		?>
		<div class="sina-modal-box" data-modal-id="<?php echo esc_attr( $trigger_id ); ?>">
			<?php if ( $data['trigger_label'] ): ?>
				<div class="sina-btn-wrap">
					<button id="<?php echo esc_attr( $trigger_id ); ?>" class="sina-button sina-modal-trigger">
						<?php Sina_Common_Data::button_html($data, 'trigger'); ?>
					</button>
				</div>
			<?php endif; ?>
			<div class="sina-modal-overlay <?php echo esc_attr( $trigger_id ); ?>">
				<div class="sina-modal-area sina-flex animated <?php echo esc_attr( $data['modal_effects'] ); ?>">
					<div class="sina-modal-content">
						<?php if ( '' != $data['modal_header'] ): ?>
							<?php printf( '<h2 class="sina-modal-header">%1$s</h2>', $data['modal_header'] ); ?>
						<?php endif; ?>
						<div class="sina-modal-body">
							<?php
								if ( 'yes' == $data['save_templates'] && $data['template'] ) :
									$frontend = new Frontend;
									echo $frontend->get_builder_content( $data['template'], true );
								else:
							?>
								<?php if ( $data['title'] ): ?>
									<?php printf( '<h3 class="sina-modal-title">%1$s</h3>', $data['title'] ); ?>
								<?php endif; ?>

								<?php if ( $data['desc'] ): ?>
									<?php printf( '<div class="sina-modal-desc">%1$s</div>', $data['desc'] ); ?>
								<?php endif; ?>
							<?php endif; ?>
						</div>
						<div class="sina-modal-footer">
							<button class="sina-button sina-modal-close <?php echo esc_attr( $trigger_id ); ?>"><?php _e( 'Close', 'sina-ext' ); ?></button>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .sina-modal-box -->
		<?php
	}


	protected function _content_template() {

	}
}