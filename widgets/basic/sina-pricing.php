<?php

/**
 * Pricing Widget.
 *
 * @since 1.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Pricing_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_pricing';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return __( 'Sina Pricing', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-price-table';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 */
	public function get_categories() {
		return [ 'sina-extension' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'sina price', 'sina pricing table', 'sina plan' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.0.0
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
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		// Start Box Content
		// =====================
		$this->start_controls_section(
			'pricing_box_content',
			[
				'label' => __( 'Pricing', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
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
				'default' => 'Basic',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'price',
			[
				'label' => __( 'Price', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Price', 'sina-ext' ),
				'default' => '$20',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'price_prefix',
			[
				'label' => __( 'Price Prefix', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Prefix', 'sina-ext' ),
				'condition' => [
					'price!' => '',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'price_suffix',
			[
				'label' => __( 'Price Suffix', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Suffix', 'sina-ext' ),
				'condition' => [
					'price!' => '',
				],
				'default' => 'M',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'ribbon_title',
			[
				'label' => __( 'Ribbon Title', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'ribbon_position',
			[
				'label' => __( 'Ribbon Position', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'sina-ribbon-left' => [
						'title' => __( 'Left', 'sina-ext' ),
						'icon' => 'eicon-h-align-left',
					],
					'sina-ribbon-right' => [
						'title' => __( 'Right', 'sina-ext' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'condition' => [
					'ribbon_title!' => '',
				],
				'default' => 'sina-ribbon-right',
			]
		);
		$this->add_control(
			'thumbs',
			[
				'label' => __( 'Show Image', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'img_position',
			[
				'label' => __( 'Image Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top' => __( 'Top', 'sina-ext' ),
					'middle' => __( 'Middle', 'sina-ext' ),
					'bottom' => __( 'Bottom', 'sina-ext' ),
				],
				'condition' => [
					'thumbs!' => '',
				],
				'default' => 'middle',
			]
		);
		$this->add_control(
			'image',
			[
				'label' => __( 'Image', 'sina-ext' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'thumbs!' => '',
				],
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label' => __( 'Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Content', 'sina-ext' ),
			]
		);
		$repeater->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pricing-body {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'icon',
			[
				'name' => 'icon',
				'label' => __( 'Icon', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
			]
		);
		$repeater->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'item',
			[
				'label' => __( 'Add Content', 'sina-ext' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => '1GB Storage',
					],
					[
						'title' => '1 Web Hosting',
					],
					[
						'title' => '20GB Bandwith',
					],
					[
						'title' => '5 Subdomain',
					],
					[
						'title' => 'SSD Server',
					],
					[
						'title' => 'Free SSL',
					],
					[
						'title' => '24/7 Support',
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();
		// End Box Content
		// =====================


		// Start Button Content
		// =====================
		$this->start_controls_section(
			'btn_content',
			[
				'label' => __( 'Order Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		Sina_Common_Data::button_content( $this, '.sina-order-btn', 'Order' );
		$this->end_controls_section();
		// End Button Content
		// ====================


		// Start Box Style
		// =====================
		$this->start_controls_section(
			'box_style',
			[
				'label' => __( 'Box', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'effects',
			[
				'label' => __( 'Effects', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-pricing-move' => __( 'Move', 'sina-ext' ),
					'sina-pricing-zoom' => __( 'Zoom', 'sina-ext' ),
					'' => __( 'None', 'sina-ext' ),
				],
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'scale',
			[
				'label' => __( 'Scale', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0.1,
						'max' => 5,
					],
				],
				'default' => [
					'size' => '1.1',
				],
				'condition' => [
					'effects' => 'sina-pricing-zoom',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pricing.sina-pricing-zoom:hover' => 'transform: scale({{SIZE}});',
				],
			]
		);
		$this->add_control(
			'move',
			[
				'label' => __( 'Move', 'sina-ext' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'effects' => 'sina-pricing-move',
				],
			]
		);

		$this->start_popover();
		$this->add_responsive_control(
			'translateX',
			[
				'label' => __( 'Horizontal', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -100,
						'max' => 100,
					],
				],
				'desktop_default' => [
					'size' => '0',
				],
				'tablet_default' => [
					'size' => '0',
				],
				'mobile_default' => [
					'size' => '0',
				],
				'condition' => [
					'effects' => 'sina-pricing-move',
				],
			]
		);
		$this->add_responsive_control(
			'translateY',
			[
				'label' => __( 'Vertical', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -100,
						'max' => 100,
					],
				],
				'desktop_default' => [
					'size' => '-10',
				],
				'tablet_default' => [
					'size' => '-10',
				],
				'mobile_default' => [
					'size' => '-10',
				],
				'condition' => [
					'effects' => 'sina-pricing-move',
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .sina-pricing:hover' => 'transform: translate({{translateX.SIZE || 0}}px, {{translateY.SIZE || 0}}px);',
					'(tablet){{WRAPPER}} .sina-pricing:hover' => 'transform: translate({{translateX_tablet.SIZE || 0}}px, {{translateY_tablet.SIZE || 0}}px);',
					'(mobile){{WRAPPER}} .sina-pricing:hover' => 'transform: translate({{translateX_mobile.SIZE || 0}}px, {{translateY_mobile.SIZE || 0}}px);',
				],
			]
		);
		$this->end_popover();

		$this->start_controls_tabs( 'box_tabs' );

		$this->start_controls_tab(
			'box_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_background',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fff',
					],
				],
				'selector' => '{{WRAPPER}} .sina-pricing',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
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
				'selector' => '{{WRAPPER}} .sina-pricing',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .sina-pricing',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_hover_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-pricing:hover',
			]
		);
		$this->add_control(
			'box_hover_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pricing:hover' => 'border-color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-pricing:hover',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_hover_heading',
			[
				'label' => __( 'Title Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'title!' => '',
				],
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'title!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pricing:hover .sina-pricing-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_hover_shadow',
				'condition' => [
					'title!' => '',
				],
				'selector' => '{{WRAPPER}} .sina-pricing:hover .sina-pricing-title',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_hover_bg',
				'types' => [ 'classic', 'gradient' ],
				'condition' => [
					'title!' => '',
				],
				'selector' => '{{WRAPPER}} .sina-pricing:hover .sina-pricing-title',
			]
		);
		$this->add_control(
			'title_hover_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'title!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pricing:hover .sina-pricing-title' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'price_hover_heading',
			[
				'label' => __( 'Price Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'price!' => '',
				],
			]
		);
		$this->add_control(
			'price_hover_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'price!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pricing:hover .sina-price-tag' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'price_hover_shadow',
				'condition' => [
					'price!' => '',
				],
				'selector' => '{{WRAPPER}} .sina-pricing:hover .sina-price-tag',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'price_hover_bg',
				'types' => [ 'classic', 'gradient' ],
				'condition' => [
					'price!' => '',
				],
				'selector' => '{{WRAPPER}} .sina-pricing:hover .sina-price-tag',
			]
		);
		$this->add_control(
			'price_hover_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'price!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pricing:hover .sina-price-tag' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'price_box_hover_shadow',
				'condition' => [
					'price!' => '',
				],
				'selector' => '{{WRAPPER}} .sina-pricing:hover .sina-price-tag',
			]
		);

		$this->add_control(
			'prefix_price_hover_heading',
			[
				'label' => __( 'Price Prefix Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'price!' => '',
					'price_prefix!' => '',
				],
			]
		);
		$this->add_control(
			'price_prefix_hover_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'price!' => '',
					'price_prefix!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pricing:hover .sina-price-prefix' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_hover_heading',
			[
				'label' => __( 'Content Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'content_hover_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pricing:hover .sina-pricing-body li' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'content_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-pricing:hover .sina-pricing-body li',
			]
		);

		$this->add_control(
			'button_heading',
			[
				'label' => __( 'Button', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-pricing:hover .sina-order-btn',
			]
		);
		$this->add_control(
			'button_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pricing:hover .sina-order-btn' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_border_color',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pricing:hover .sina-order-btn' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'box_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-pricing' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-pricing' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		Sina_Common_Data::BG_hover_effects($this, '.sina-pricing');

		$this->end_controls_section();
		// End Box Style
		// =====================


		// Start Title Style
		// =====================
		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'title!' => '',
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
					'{{WRAPPER}} .sina-pricing-title' => 'color: {{VALUE}};',
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
						'default' => '600',
					],
					'font_size'   => [
						'default' => [
							'size' => '24',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-pricing-title',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-pricing-title',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-pricing-title',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'selector' => '{{WRAPPER}} .sina-pricing-title',
			]
		);
		$this->add_responsive_control(
			'title_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-pricing-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '20',
					'right' => '15',
					'bottom' => '20',
					'left' => '15',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pricing-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .sina-pricing-title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Title Style
		// =====================


		// Start Price Style
		// =====================
		$this->start_controls_section(
			'price_style',
			[
				'label' => __( 'Price', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'price!' => '',
				],
			]
		);

		$this->add_control(
			'price_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-price-tag' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '600',
					],
					'font_size'   => [
						'default' => [
							'size' => '32',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-price-tag',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'price_shadow',
				'selector' => '{{WRAPPER}} .sina-price-tag',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'price_box_shadow',
				'selector' => '{{WRAPPER}} .sina-price-tag',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'price_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#1085e4',
					],
				],
				'selector' => '{{WRAPPER}} .sina-price-tag',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'price_border',
				'selector' => '{{WRAPPER}} .sina-price-tag',
			]
		);

		$this->add_control(
			'price_prefix_heading',
			[
				'label' => __( 'Price Prefix', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'price_prefix!' => '',
				],
			]
		);
		$this->add_control(
			'price_prefix_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'condition' => [
					'price_prefix!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-price-prefix' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_prefix_typography',
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
				],
				'condition' => [
					'price_prefix!' => '',
				],
				'selector' => '{{WRAPPER}} .sina-price-prefix',
			]
		);

		$this->add_control(
			'suffix_size',
			[
				'label' => __( 'Suffix Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '12',
				],
				'separator' => 'before',
				'condition' => [
					'price_suffix!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-price-tag .sina-price-suffix' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'price_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-price-tag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'price_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
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
					'{{WRAPPER}} .sina-price-tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'price_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-price-tag' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'price_alignment',
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .sina-price-tag' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Price Style
		// =====================


		// Start Content Style
		// =====================
		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-pricing-body li' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'line_height'   => [
						'default' => [
							'size' => '32',
						],
					],
					'transform'   => [
						'default' => [
							'size' => 'uppercase',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-pricing-body li',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'content_shadow',
				'selector' => '{{WRAPPER}} .sina-pricing-body li',
			]
		);

		$this->add_control(
			'content_icon',
			[
				'label' => __( 'Icon Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_align',
			[
				'label' => __( 'Icon Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'left' => __( 'Left', 'sina-ext' ),
					'right' => __( 'Right', 'sina-ext' ),
				],
				'default' => 'left',
			]
		);
		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Icon Spacing', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '5',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pricing-body li .sina-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sina-pricing-body li .sina-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-pricing-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Content Style
		// =====================


		// Start Button Style
		// =====================
		$this->start_controls_section(
			'btn_style',
			[
				'label' => __( 'Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'btn_text!' => '',
				],
			]
		);
		Sina_Common_Data::button_style( $this, '.sina-pricing .sina-order-btn' );
		$this->add_responsive_control(
			'btn_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '4',
					'right' => '4',
					'bottom' => '4',
					'left' => '4',
					'isLinked' => true,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-order-btn, {{WRAPPER}} .sina-order-btn:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '12',
					'right' => '25',
					'bottom' => '12',
					'left' => '25',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-order-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '30',
					'right' => '0',
					'bottom' => '40',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pricing-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		Sina_Common_Data::BG_hover_effects($this, '.sina-order-btn', 'btn_bg_layer');

		$this->end_controls_section();
		// End Button Style
		// =====================


		// Start Ribbon Style
		// =====================
		$this->start_controls_section(
			'ribbon_style',
			[
				'label' => __( 'Ribbon', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ribbon_title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ribbon_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_size'   => [
						'default' => [
							'size' => '16',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-ribbon-right, {{WRAPPER}} .sina-ribbon-left',
			]
		);
		$this->add_control(
			'ribbon_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f8f8f8',
				'selectors' => [
					'{{WRAPPER}} .sina-ribbon-right, {{WRAPPER}} .sina-ribbon-left' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'ribbon_shadow',
				'selector' => '{{WRAPPER}} .sina-ribbon-right, {{WRAPPER}} .sina-ribbon-left',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ribbon_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#61ce70',
					],
				],
				'selector' => '{{WRAPPER}} .sina-ribbon-right, {{WRAPPER}} .sina-ribbon-left',
			]
		);

		$this->end_controls_section();
		// End Ribbon Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-pricing <?php echo esc_attr( $data['effects'].' '.$data['bg_layer_effects'] ); ?>">
			<?php if ( $data['ribbon_title'] && $data['ribbon_position'] ): ?>
				<div class="<?php echo esc_attr( $data['ribbon_position'] ); ?>">
					<?php printf( '%s', $data['ribbon_title'] ); ?>
				</div>
			<?php endif; ?>

			<?php if ( 'yes' == $data['thumbs'] && 'top' == $data['img_position'] ): ?>
				<div class="sina-pricing-img">
					<img src="<?php echo esc_url( $data['image']['url'] ); ?>" alt="<?php echo esc_attr( $data['title'] ) ?>">
				</div>
			<?php endif; ?>

			<?php if ( $data['title'] ): ?>
				<?php printf( '<h3 class="sina-pricing-title">%1$s</h3>', $data['title'] ); ?>
			<?php endif; ?>

			<?php if ( 'yes' == $data['thumbs'] && 'middle' == $data['img_position'] ): ?>
				<div class="sina-pricing-img">
					<img src="<?php echo esc_url( $data['image']['url'] ); ?>" alt="<?php echo esc_attr( $data['title'] ) ?>">
				</div>
			<?php endif; ?>

			<?php if ( $data['price']): ?>
				<h4 class="sina-price-tag">
				    <span class="sina-price-prefix"><?php printf( '%s', $data['price_prefix'] ); ?></span>
					<span><?php printf( '%s', $data['price'] ); ?></span><span class="sina-price-suffix"><?php printf( '%s', $data['price_suffix'] ); ?></span>
				</h4>
			<?php endif; ?>

			<?php if ( 'yes' == $data['thumbs'] && 'bottom' == $data['img_position'] ): ?>
				<div class="sina-pricing-img">
					<img src="<?php echo esc_url( $data['image']['url'] ); ?>" alt="<?php echo esc_attr( $data['title'] ) ?>">
				</div>
			<?php endif; ?>

			<ul class="sina-pricing-body">
				<?php foreach ($data['item'] as $index => $item) : ?>
					<li class="elementor-repeater-item-<?php echo esc_attr( $item[ '_id' ] ); ?>">
						<?php if ( $item['icon'] && 'left' == $data['icon_align'] ): ?>
							<i class="<?php echo esc_attr($item['icon']); ?> sina-icon-left"></i>
						<?php endif; ?>
						<?php printf( '%s', $item['title'] ); ?>
						<?php if ( $item['icon'] && 'right' == $data['icon_align'] ): ?>
							<i class="<?php echo esc_attr($item['icon']); ?> sina-icon-right"></i>
						<?php endif; ?>
					</li>
				<?php endforeach ?>
			</ul>

			<?php if ( $data['btn_text'] || $data['btn_icon'] ) : ?>
				<div class="sina-pricing-btn">
					<a class="sina-order-btn <?php echo esc_attr( $data['btn_effect'].' '.$data['btn_bg_layer_effects'] ); ?>"
					href="<?php echo esc_url( $data['btn_link']['url'] ); ?>"
					<?php if ( 'on' == $data['btn_link']['is_external'] ): ?>
						target="_blank" 
					<?php endif; ?>
					<?php if ( 'on' == $data['btn_link']['nofollow'] ): ?>
						rel="nofollow" 
					<?php endif; ?>>
						<?php Sina_Common_Data::button_html($data); ?>
					</a>
				</div>
			<?php endif; ?>
		</div><!-- .sina-pricing -->
		<?php
	}


	protected function _content_template() {
		?>
		<div class="sina-pricing {{{settings.effects + ' ' + settings.bg_layer_effects}}}">
			<#
				view.addRenderAttribute( 'ribbon_title', 'class', settings.ribbon_position );
				view.addInlineEditingAttributes( 'ribbon_title' );

				view.addRenderAttribute( 'title', 'class', 'sina-pricing-title' );
				view.addInlineEditingAttributes( 'title' );
			#>
			<# if (settings.ribbon_title && settings.ribbon_position) { #>
				<div {{{ view.getRenderAttributeString( 'ribbon_title' ) }}}>
					{{{settings.ribbon_title}}}
				</div>
			<# } #>

			<# if ('yes' == settings.thumbs && 'top' == settings.ribbon_position) { #>
				<div class="sina-pricing-img">
					<img src="{{{settings.image.url}}}" alt="{{{settings.title}}}">
				</div>
			<# } #>

			<# if (settings.title) { #>
				<h3 {{{ view.getRenderAttributeString( 'title' ) }}}>{{{settings.title}}}</h3>
			<# } #>

			<# if ('yes' == settings.thumbs && 'middle' == settings.img_position) { #>
				<div class="sina-pricing-img">
					<img src="{{{settings.image.url}}}" alt="{{{settings.title}}}">
				</div>
			<# } #>

			<# if (settings.price) { #>
				<h4 class="sina-price-tag">
					<span class="sina-price-prefix">{{{settings.price_prefix}}}</span>
					<span>{{{settings.price}}}</span><span class="sina-price-suffix">{{{settings.price_suffix}}}</span>
				</h4>
			<# } #>

			<# if ('yes' == settings.thumbs && 'bottom' == settings.img_position) { #>
			<div class="sina-pricing-img">
				<img src="{{{settings.image.url}}}" alt="{{{settings.title}}}">
			</div>
			<# } #>

			<ul class="sina-pricing-body">
				<# _.each( settings.item, function( item, index )  { #>
					<li class="elementor-repeater-item-{{{item._id}}}">
						<# if (item.icon && 'left' == settings.icon_align) { #>
							<i class="{{{item.icon}}} sina-icon-left"></i>
						<# } #>

						{{{item.title}}}

						<# if (item.icon && 'right' == settings.icon_align) { #>
							<i class="{{{item.icon}}} sina-icon-right"></i>
						<# } #>
					</li>
				<# }); #>
			</ul>

			<# if (settings.btn_text || settings.btn_icon) { #>
			<div class="sina-pricing-btn">
				<a class="sina-order-btn {{{settings.btn_effect +' '+ settings.btn_bg_layer_effects}}}"
				href="{{{settings.btn_link.url}}}">
					<# if (settings.btn_icon && 'left' == settings.btn_icon_align) { #>
						<i class="{{{settings.btn_icon}}} sina-icon-left"></i>
					<# } #>

					{{{settings.btn_text}}}

					<# if (settings.btn_icon && 'right' == settings.btn_icon_align) { #>
						<i class="{{{settings.btn_icon}}} sina-icon-right"></i>
					<# } #>
				</a>
			</div>
			<# } #>
		</div><!-- .sina-pricing -->
		<?php
	}
}