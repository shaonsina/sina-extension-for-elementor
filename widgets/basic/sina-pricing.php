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
use \Elementor\Control_Media;
use \Elementor\Repeater;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Pricing_Widget extends Widget_Base{

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
		return esc_html__( 'Sina Pricing', 'sina-ext' );
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
			'icofont',
			'font-awesome',
			'elementor-icons',
			'sina-morphing-anim',
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
	protected function register_controls() {
		// Start Box Content
		// =====================
		$this->start_controls_section(
			'pricing_box_content',
			[
				'label' => esc_html__( 'Pricing', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Title', 'sina-ext' ),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext' ),
				'default' => 'Basic',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'price',
			[
				'label' => esc_html__( 'Price', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Price', 'sina-ext' ),
				'default' => '$20',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'price_prefix',
			[
				'label' => esc_html__( 'Price Prefix', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Prefix', 'sina-ext' ),
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
				'label' => esc_html__( 'Price Suffix', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Suffix', 'sina-ext' ),
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
				'label' => esc_html__( 'Ribbon Title', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'ribbon_position',
			[
				'label' => esc_html__( 'Ribbon Position', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'sina-ribbon-left' => [
						'title' => esc_html__( 'Left', 'sina-ext' ),
						'icon' => 'eicon-h-align-left',
					],
					'sina-ribbon-right' => [
						'title' => esc_html__( 'Right', 'sina-ext' ),
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
				'label' => esc_html__( 'Show Image', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'img_position',
			[
				'label' => esc_html__( 'Image Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top' => esc_html__( 'Top', 'sina-ext' ),
					'middle' => esc_html__( 'Middle', 'sina-ext' ),
					'bottom' => esc_html__( 'Bottom', 'sina-ext' ),
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
				'label' => esc_html__( 'Image', 'sina-ext' ),
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
				'label' => esc_html__( 'Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Content', 'sina-ext' ),
			]
		);
		$repeater->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
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
				'label' => esc_html__( 'Icon', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
			]
		);
		$repeater->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'item',
			[
				'label' => esc_html__( 'Add Content', 'sina-ext' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'prevent_empty' => false,
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
				'label' => esc_html__( 'Order Button', 'sina-ext' ),
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
				'label' => esc_html__( 'Box', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'effects',
			[
				'label' => esc_html__( 'Effects', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-pricing-move' => esc_html__( 'Move', 'sina-ext' ),
					'sina-pricing-zoom' => esc_html__( 'Zoom', 'sina-ext' ),
					'' => esc_html__( 'None', 'sina-ext' ),
				],
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'scale',
			[
				'label' => esc_html__( 'Scale', 'sina-ext' ),
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
				'label' => esc_html__( 'Move', 'sina-ext' ),
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
				'label' => esc_html__( 'Horizontal', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
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
				'label' => esc_html__( 'Vertical', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
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
				'label' => esc_html__( 'Normal', 'sina-ext' ),
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
				'label' => esc_html__( 'Hover', 'sina-ext' ),
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
				'label' => esc_html__( 'Border Color', 'sina-ext' ),
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
				'label' => esc_html__( 'Title Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'title!' => '',
				],
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
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
				'label' => esc_html__( 'Border Color', 'sina-ext' ),
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
				'label' => esc_html__( 'Price Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'price!' => '',
				],
			]
		);
		$this->add_control(
			'price_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
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
				'label' => esc_html__( 'Border Color', 'sina-ext' ),
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
				'label' => esc_html__( 'Price Prefix Styles', 'sina-ext' ),
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
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
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
				'label' => esc_html__( 'Content Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'content_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
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
				'label' => esc_html__( 'Button', 'sina-ext' ),
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
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pricing:hover .sina-order-btn' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_border_color',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext' ),
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
				'label' => esc_html__( 'Radius', 'sina-ext' ),
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
				'label' => esc_html__( 'Padding', 'sina-ext' ),
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
				'label' => esc_html__( 'Title', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
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
				'label' => esc_html__( 'Radius', 'sina-ext' ),
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
				'label' => esc_html__( 'Padding', 'sina-ext' ),
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
				'label' => esc_html__( 'Alignment', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'sina-ext' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sina-ext' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'sina-ext' ),
						'icon' => 'eicon-text-align-right',
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
				'label' => esc_html__( 'Price', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'price!' => '',
				],
			]
		);

		$this->add_control(
			'price_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
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
				'label' => esc_html__( 'Price Prefix / Suffix', 'sina-ext' ),
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
				'label' => esc_html__( 'Prefix Color', 'sina-ext' ),
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
				'label' => esc_html__( 'Suffix Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '12',
				],
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
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-price-tag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'price_padding',
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
					'{{WRAPPER}} .sina-price-tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'price_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
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
				'label' => esc_html__( 'Alignment', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'sina-ext' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sina-ext' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'sina-ext' ),
						'icon' => 'eicon-text-align-right',
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


		// Start Image Style
		// =====================
		$this->start_controls_section(
			'image_style',
			[
				'label' => esc_html__( 'Image', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'thumbs' => 'yes',
				]
			]
		);

		Sina_Common_Data::morphing_animation( $this );

		$this->add_responsive_control(
			'image_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
					'em' => [
						'max' => 30,
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-pricing-img img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_shadow',
				'selector' => '{{WRAPPER}} .sina-pricing-img img',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .sina-pricing-img img',
			]
		);
		$this->add_responsive_control(
			'image_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-pricing-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Image Style
		// =====================


		// Start Content Style
		// =====================
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
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
				'label' => esc_html__( 'Icon Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'left' => esc_html__( 'Left', 'sina-ext' ),
					'right' => esc_html__( 'Right', 'sina-ext' ),
				],
				'default' => 'left',
			]
		);
		$this->add_responsive_control(
			'icon_space',
			[
				'label' => esc_html__( 'Icon Spacing', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '5',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pricing-body li .sina-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sina-pricing-body li .sina-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .sina-pricing-body li .sina-icon-right' => 'margin-right: {{SIZE}}{{UNIT}}; margin-left: auto;',
					'.rtl {{WRAPPER}} .sina-pricing-body li .sina-icon-left' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: auto;',
				],
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
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
				'label' => esc_html__( 'Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'btn_text!' => '',
				],
			]
		);
		Sina_Common_Data::button_style( $this, '.sina-pricing .sina-order-btn' );
		$this->add_responsive_control(
			'btn_width',
			[
				'label' => esc_html__( 'Min Width', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'em' => [
						'min' => 0,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-order-btn' => 'min-width: {{SIZE}}{{UNIT}};;',
				],
			]
		);
		$this->add_responsive_control(
			'btn_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '4',
					'right' => '4',
					'bottom' => '4',
					'left' => '4',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-order-btn, {{WRAPPER}} .sina-order-btn:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
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
				'label' => esc_html__( 'Margin', 'sina-ext' ),
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
				'label' => esc_html__( 'Ribbon', 'sina-ext' ),
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
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
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
		$img_alt = $data['title'] ? $data['title'] : Control_Media::get_image_alt( $data['image'] );
		$morphing_anim_image = ('yes' == $data['is_morphing_anim_icon'] && $data['morphing_pattern']) ? $data['morphing_pattern'] : '';
		?>
		<div class="sina-pricing <?php echo esc_attr( $data['effects'].' '.$data['bg_layer_effects'] ); ?>">
			<?php if ( $data['ribbon_title'] && $data['ribbon_position'] ): ?>
				<div class="<?php echo esc_attr( $data['ribbon_position'] ); ?>">
					<?php printf( '%s', $data['ribbon_title'] ); ?>
				</div>
			<?php endif; ?>

			<?php if ( 'yes' == $data['thumbs'] && 'top' == $data['img_position'] ): ?>
				<div class="sina-pricing-img">
					<img class="<?php echo esc_attr( $morphing_anim_image ) ?>" src="<?php echo esc_url( $data['image']['url'] ); ?>" alt="<?php echo esc_attr( $img_alt ) ?>">
				</div>
			<?php endif; ?>

			<?php if ( $data['title'] ): ?>
				<?php printf( '<h3 class="sina-pricing-title">%1$s</h3>', $data['title'] ); ?>
			<?php endif; ?>

			<?php if ( 'yes' == $data['thumbs'] && 'middle' == $data['img_position'] ): ?>
				<div class="sina-pricing-img">
					<img class="<?php echo esc_attr( $morphing_anim_image ) ?>" src="<?php echo esc_url( $data['image']['url'] ); ?>" alt="<?php echo esc_attr( $img_alt ) ?>">
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
					<img class="<?php echo esc_attr( $morphing_anim_image ) ?>" src="<?php echo esc_url( $data['image']['url'] ); ?>" alt="<?php echo esc_attr( $img_alt ) ?>">
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


	protected function content_template() {
		?>
		<div class="sina-pricing {{{settings.effects + ' ' + settings.bg_layer_effects}}}">
			<#
				view.addRenderAttribute( 'title', 'class', 'sina-pricing-title' );
				view.addInlineEditingAttributes( 'title' );

				var morphingAnimImage = ('yes' == settings.is_morphing_anim_icon && settings.morphing_pattern) ? settings.morphing_pattern : '';
			#>
			<# if (settings.ribbon_title && settings.ribbon_position) { #>
				<div class="{{{settings.ribbon_position}}}">
					{{{settings.ribbon_title}}}
				</div>
			<# } #>

			<# if ('yes' == settings.thumbs && 'top' == settings.img_position) { #>
				<div class="sina-pricing-img">
					<img class="{{{morphingAnimImage}}}" src="{{{settings.image.url}}}" alt="{{{settings.title}}}">
				</div>
			<# } #>

			<# if (settings.title) { #>
				<h3 {{{ view.getRenderAttributeString( 'title' ) }}}>{{{settings.title}}}</h3>
			<# } #>

			<# if ('yes' == settings.thumbs && 'middle' == settings.img_position) { #>
				<div class="sina-pricing-img">
					<img class="{{{morphingAnimImage}}}" src="{{{settings.image.url}}}" alt="{{{settings.title}}}">
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
				<img class="{{{morphingAnimImage}}}" src="{{{settings.image.url}}}" alt="{{{settings.title}}}">
			</div>
			<# } #>

			<ul class="sina-pricing-body">
				<# _.each( settings.item, function( item, index ) { #>
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