<?php

/**
 * Flip Box Widget.
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


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Flip_Box_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_flip_box';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Flip Box', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-flip-box';
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
		return [ 'sina flip box', 'sina rotate box' ];
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
		// Start Front Side Content
		// =========================
		$this->start_controls_section(
			'front_content',
			[
				'label' => esc_html__( 'Front Side', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'front_icon_format',
			[
				'label' => esc_html__( 'Icon Format', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'icon' => [
						'title' => esc_html__( 'Icon', 'sina-ext' ),
						'icon' => 'eicon-star',
					],
					'image' => [
						'title' => esc_html__( 'Image', 'sina-ext' ),
						'icon' => 'eicon-image-bold',
					],
				],
				'default' => 'icon',
			]
		);
		$this->add_control(
			'front_icon',
			[
				'label' => esc_html__( 'Icon', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-android',
				'condition' => [
					'front_icon_format' => 'icon',
				],
			]
		);
		$this->add_control(
			'front_image',
			[
				'label' => esc_html__( 'Image', 'sina-ext' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'front_icon_format' => 'image',
				],
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'front_title',
			[
				'label' => esc_html__( 'Title', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Title', 'sina-ext' ),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext' ),
				'default' => 'Apps Development',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'front_desc',
			[
				'label' => esc_html__( 'Description', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter Description', 'sina-ext' ),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext' ),
				'default' => 'This is flip box description.',
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->end_controls_section();
		// End Front Side Content
		// =======================


		// Start Back Side Content
		// =========================
		$this->start_controls_section(
			'back_content',
			[
				'label' => esc_html__( 'Back Side', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'back_icon_format',
			[
				'label' => esc_html__( 'Icon Format', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'icon' => [
						'title' => esc_html__( 'Icon', 'sina-ext' ),
						'icon' => 'eicon-star',
					],
					'image' => [
						'title' => esc_html__( 'Image', 'sina-ext' ),
						'icon' => 'eicon-image-bold',
					],
				],
				'default' => 'icon',
			]
		);
		$this->add_control(
			'back_icon',
			[
				'label' => esc_html__( 'Icon', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-tablet',
				'condition' => [
					'back_icon_format' => 'icon',
				],
			]
		);
		$this->add_control(
			'back_image',
			[
				'label' => esc_html__( 'Image', 'sina-ext' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'back_icon_format' => 'image',
				],
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'back_title',
			[
				'label' => esc_html__( 'Title', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Title', 'sina-ext' ),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext' ),
				'default' => 'Web Development',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'back_desc',
			[
				'label' => esc_html__( 'Description', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter Description', 'sina-ext' ),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext' ),
				'default' => 'This is flip box description.',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'back_link',
			[
				'label' => esc_html__( 'Link', 'sina-ext' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->end_controls_section();
		// End Back Side Content
		// =======================


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
					'sina-flipbox-effect-h-flip' => esc_html__( 'Horizontal Flip', 'sina-ext' ),
					'sina-flipbox-effect-v-flip' => esc_html__( 'Vertical Flip', 'sina-ext' ),
					'sina-flipbox-effect-zoom' => esc_html__( 'Zoom', 'sina-ext' ),
					'sina-flipbox-effect-s-top' => esc_html__( 'Slide Top', 'sina-ext' ),
					'sina-flipbox-effect-s-bottom' => esc_html__( 'Slide Bottom', 'sina-ext' ),
					'sina-flipbox-effect-s-left' => esc_html__( 'Slide Left', 'sina-ext' ),
					'sina-flipbox-effect-s-right' => esc_html__( 'Slide Right', 'sina-ext' ),
				],
				'default' => 'sina-flipbox-effect-zoom',
			]
		);

		$this->start_controls_tabs( 'box_tabs' );

		$this->start_controls_tab(
			'front_style',
			[
				'label' => esc_html__( 'Front', 'sina-ext' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'front_bg_color',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#1085e4',
					],
				],
				'selector' => '{{WRAPPER}} .sina-flipbox-front',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'front_border',
				'selector' => '{{WRAPPER}} .sina-flipbox-front',
			]
		);
		$this->add_responsive_control(
			'front_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '20',
					'right' => '20',
					'bottom' => '30',
					'left' => '20',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-front' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'front_content_padding',
			[
				'label' => esc_html__( 'Content Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'condition' => [
					'front_icon_format' => 'image',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-front .sina-flipbox-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'back_style',
			[
				'label' => esc_html__( 'Back', 'sina-ext' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'back_bg_color',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#d300d0',
					],
				],
				'selector' => '{{WRAPPER}} .sina-flipbox-back',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'back_border',
				'selector' => '{{WRAPPER}} .sina-flipbox-back',
			]
		);
		$this->add_responsive_control(
			'back_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '20',
					'right' => '20',
					'bottom' => '30',
					'left' => '20',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-back' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'back_content_padding',
			[
				'label' => esc_html__( 'Content Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'condition' => [
					'back_icon_format' => 'image',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-back .sina-flipbox-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'box_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
					'em' => [
						'max' => 50,
					],
				],
				'default' => [
					'size' => '230',
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox, {{WRAPPER}} .sina-flipbox-front, {{WRAPPER}} .sina-flipbox-back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'alignment',
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
					'{{WRAPPER}} .sina-flipbox' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Box Style
		// =================


		// Start Icons Style
		// =====================
		$this->start_controls_section(
			'icons_style',
			[
				'label' => esc_html__( 'Icon or Image', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'icons_tabs' );

		$this->start_controls_tab(
			'front_icon_style',
			[
				'label' => esc_html__( 'Front', 'sina-ext' ),
			]
		);

		$this->add_control(
			'front_icon_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-front .sina-flipbox-icon i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'front_icon_size',
			[
				'label' => esc_html__( 'Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 200,
					],
				],
				'default' => [
					'size' => '38',
				],
				'condition' => [
					'front_icon_format' => 'icon',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-front .sina-flipbox-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'front_image_size',
			[
				'label' => esc_html__( 'Size', 'sina-ext' ),
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
				'default'=> [
					'unit' => 'px',
					'size' => '100',
				],
				'condition' => [
					'front_icon_format' => 'image',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-front .sina-flipbox-icon img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'front_icon_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-flipbox-front .sina-flipbox-icon i, {{WRAPPER}} .sina-flipbox-front .sina-flipbox-icon img',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'front_icon_image_shadow',
				'selector' => '{{WRAPPER}} .sina-flipbox-front .sina-flipbox-icon i, {{WRAPPER}} .sina-flipbox-front .sina-flipbox-icon img',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'front_icon_border',
				'selector' => '{{WRAPPER}} .sina-flipbox-front .sina-flipbox-icon i, {{WRAPPER}} .sina-flipbox-front .sina-flipbox-icon img',
			]
		);
		$this->add_responsive_control(
			'front_icon_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-front .sina-flipbox-icon i, {{WRAPPER}} .sina-flipbox-front .sina-flipbox-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'front_icon_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '15',
					'right' => '15',
					'bottom' => '15',
					'left' => '15',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-front .sina-flipbox-icon i, {{WRAPPER}} .sina-flipbox-front .sina-flipbox-icon img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'back_icon_style',
			[
				'label' => esc_html__( 'Back', 'sina-ext' ),
			]
		);

		$this->add_control(
			'back_icon_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-back .sina-flipbox-icon i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'back_icon_size',
			[
				'label' => esc_html__( 'Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 200,
					],
				],
				'default' => [
					'size' => '38',
				],
				'condition' => [
					'back_icon_format' => 'icon',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-back .sina-flipbox-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'back_image_size',
			[
				'label' => esc_html__( 'Size', 'sina-ext' ),
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
				'default'=> [
					'unit' => 'px',
					'size' => '100',
				],
				'condition' => [
					'back_icon_format' => 'image',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-back .sina-flipbox-icon img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'back_icon_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-flipbox-back .sina-flipbox-icon i, {{WRAPPER}} .sina-flipbox-back .sina-flipbox-icon img',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'back_icon_image_shadow',
				'selector' => '{{WRAPPER}} .sina-flipbox-back .sina-flipbox-icon i, {{WRAPPER}} .sina-flipbox-back .sina-flipbox-icon img',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'back_icon_border',
				'selector' => '{{WRAPPER}} .sina-flipbox-back .sina-flipbox-icon i, {{WRAPPER}} .sina-flipbox-back .sina-flipbox-icon img',
			]
		);
		$this->add_responsive_control(
			'back_icon_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-back .sina-flipbox-icon i, {{WRAPPER}} .sina-flipbox-back .sina-flipbox-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'back_icon_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '15',
					'right' => '15',
					'bottom' => '15',
					'left' => '15',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-back .sina-flipbox-icon i, {{WRAPPER}} .sina-flipbox-back .sina-flipbox-icon img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		// End Icons Style
		// =================


		// Start Title Style
		// ===================
		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Title', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'title_tabs' );

		$this->start_controls_tab(
			'front_title_style',
			[
				'label' => esc_html__( 'Front', 'sina-ext' ),
			]
		);

		$this->add_control(
			'front_title_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-front .sina-flipbox-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'front_title_typography',
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
				'selector' => '{{WRAPPER}} .sina-flipbox-front .sina-flipbox-title',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'front_title_shadow',
				'selector' => '{{WRAPPER}} .sina-flipbox-front .sina-flipbox-title',
			]
		);
		$this->add_responsive_control(
			'front_title_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '15',
					'right' => '0',
					'bottom' => '10',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-front .sina-flipbox-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'back_title_style',
			[
				'label' => esc_html__( 'Back', 'sina-ext' ),
			]
		);

		$this->add_control(
			'back_title_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-back .sina-flipbox-title, {{WRAPPER}} .sina-flipbox-back .sina-flipbox-title > a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'back_title_typography',
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
				'selector' => '{{WRAPPER}} .sina-flipbox-back .sina-flipbox-title, {{WRAPPER}} .sina-flipbox-back .sina-flipbox-title > a',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'back_title_shadow',
				'selector' => '{{WRAPPER}} .sina-flipbox-back .sina-flipbox-title, {{WRAPPER}} .sina-flipbox-back .sina-flipbox-title > a',
			]
		);
		$this->add_responsive_control(
			'back_title_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '15',
					'right' => '0',
					'bottom' => '10',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-back .sina-flipbox-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		// End Title Style
		// =================


		// Start Descripton Style
		// ========================
		$this->start_controls_section(
			'desc_style',
			[
				'label' => esc_html__( 'Description', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'desc_tabs' );

		$this->start_controls_tab(
			'front_desc_style',
			[
				'label' => esc_html__( 'Front', 'sina-ext' ),
			]
		);

		$this->add_control(
			'front_desc_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-front .sina-flipbox-desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'front_desc_typography',
				'selector' => '{{WRAPPER}} .sina-flipbox-front .sina-flipbox-desc',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'front_desc_shadow',
				'selector' => '{{WRAPPER}} .sina-flipbox-front .sina-flipbox-desc',
			]
		);
		$this->add_responsive_control(
			'front_desc_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-front .sina-flipbox-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'back_desc_style',
			[
				'label' => esc_html__( 'Back', 'sina-ext' ),
			]
		);

		$this->add_control(
			'back_desc_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-back .sina-flipbox-desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'back_desc_typography',
				'selector' => '{{WRAPPER}} .sina-flipbox-back .sina-flipbox-desc',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'back_desc_shadow',
				'selector' => '{{WRAPPER}} .sina-flipbox-back .sina-flipbox-desc',
			]
		);
		$this->add_responsive_control(
			'back_desc_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-flipbox-back .sina-flipbox-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		// End Description Style
		// =======================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$flip_cls = in_array($data['effects'], ['sina-flipbox-effect-s-top', 'sina-flipbox-effect-s-bottom', 'sina-flipbox-effect-s-left', 'sina-flipbox-effect-s-right']) ? 'sina-flipbox-hidden' : '';

		$front_img_alt = $data['front_title'] ? $data['front_title'] : Control_Media::get_image_alt( $data['front_image'] );
		$back_img_alt = $data['back_title'] ? $data['back_title'] : Control_Media::get_image_alt( $data['back_image'] );
		?>
		<div class="sina-flipbox <?php echo esc_attr($flip_cls); ?>">
			<div class="sina-flipbox-front <?php echo esc_attr( $data['effects'] ); ?>">
				<?php if ( 'icon' == $data['front_icon_format'] && $data['front_icon'] ): ?>
					<div class="sina-flipbox-icon">
						<i class="<?php echo esc_attr( $data['front_icon'] ); ?>"></i>
					</div>
				<?php elseif( 'image' == $data['front_icon_format'] && $data['front_image']['url'] ): ?>
					<div class="sina-flipbox-icon">
						<img src="<?php echo esc_url( $data['front_image']['url'] ); ?>" alt="<?php echo esc_attr( $front_img_alt ) ?>">
					</div>
				<?php endif; ?>

				<div class="sina-flipbox-content">
					<?php if ( $data['front_title'] ): ?>
						<?php printf( '<h3 class="sina-flipbox-title">%1$s</h3>', $data['front_title'] ); ?>
					<?php endif; ?>

					<?php if ( $data['front_desc'] ): ?>
						<?php printf( '<div class="sina-flipbox-desc">%1$s</div>', $data['front_desc'] ); ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="sina-flipbox-back <?php echo esc_attr( $data['effects'] ); ?>">
				<?php if ( 'icon' == $data['back_icon_format'] && $data['back_icon'] ): ?>
					<div class="sina-flipbox-icon">
						<i class="<?php echo esc_attr( $data['back_icon'] ); ?>"></i>
					</div>
				<?php elseif( 'image' == $data['back_icon_format'] && $data['back_image']['url'] ): ?>
					<div class="sina-flipbox-icon">
						<img src="<?php echo esc_url( $data['back_image']['url'] ); ?>" alt="<?php echo esc_attr( $back_img_alt ) ?>">
					</div>
				<?php endif; ?>

				<div class="sina-flipbox-content">
					<?php if ( $data['back_title'] ): ?>
						<h3 class="sina-flipbox-title">
							<?php if ( $data['back_link']['url'] ): ?>
								<a href="<?php echo esc_url( $data['back_link']['url'] ); ?>"
									<?php if ( 'on' == $data['back_link']['is_external'] ): ?>
										target="_blank" 
									<?php endif; ?>
									<?php if ( 'on' == $data['back_link']['nofollow'] ): ?>
										rel="nofollow" 
									<?php endif; ?>>
									<?php printf( '%1$s', $data['back_title'] ); ?>
								</a>
							<?php else: ?>
								<?php printf( '%1$s', $data['back_title'] ); ?>
							<?php endif; ?>
						</h3>
					<?php endif; ?>

					<?php if ( $data['back_desc'] ): ?>
						<?php printf( '<div class="sina-flipbox-desc">%1$s</div>', $data['back_desc'] ); ?>
					<?php endif; ?>
				</div>
			</div>
		</div><!-- .sina-flipbox -->
		<?php
	}


	protected function content_template() {
		?>
		<#
			var flipClsArr = ['sina-flipbox-effect-s-top', 'sina-flipbox-effect-s-bottom', 'sina-flipbox-effect-s-left', 'sina-flipbox-effect-s-right'];
			var flipCls = flipClsArr.includes(settings.effects) ? 'sina-flipbox-hidden' : '';

			view.addRenderAttribute( 'front_title', 'class', 'sina-flipbox-title' );
			view.addInlineEditingAttributes( 'front_title' );

			view.addRenderAttribute( 'back_title', 'class', 'sina-flipbox-title' );
			view.addInlineEditingAttributes( 'back_title' );

			view.addRenderAttribute( 'front_desc', 'class', 'sina-flipbox-desc' );
			view.addInlineEditingAttributes( 'front_desc' );

			view.addRenderAttribute( 'back_desc', 'class', 'sina-flipbox-desc' );
			view.addInlineEditingAttributes( 'back_desc' );
		#>
		<div class="sina-flipbox {{{flipCls}}}">
			<div class="sina-flipbox-front {{{settings.effects}}}">
				<# if ( 'icon' == settings.front_icon_format && settings.front_icon ) { #>
					<div class="sina-flipbox-icon">
						<i class="{{{settings.front_icon}}}"></i>
					</div>
				<# } else if ( 'image' == settings.front_icon_format && settings.front_image.url) { #>
					<div class="sina-flipbox-icon">
						<img src="{{{settings.front_image.url}}}" alt="{{{settings.front_title}}}">
					</div>
				<# } #>

				<div class="sina-flipbox-content">
					<# if ( settings.front_title ) { #>
						<h3 {{{ view.getRenderAttributeString( 'front_title' ) }}}>{{{settings.front_title}}}</h3>
					<# } #>

					<# if ( settings.front_desc ) { #>
						<div {{{ view.getRenderAttributeString( 'front_desc' ) }}}>{{{settings.front_desc}}}</div>
					<# } #>
				</div>
			</div>
			<div class="sina-flipbox-back {{{settings.effects}}}">
				<# if ( 'icon' == settings.back_icon_format && settings.back_icon ) { #>
					<div class="sina-flipbox-icon">
						<i class="{{{settings.back_icon}}}"></i>
					</div>
				<# } else if ( 'image' == settings.back_icon_format && settings.back_image.url ) { #>
					<div class="sina-flipbox-icon">
						<img src="{{{settings.back_image.url}}}" alt="{{{settings.back_title}}}">
					</div>
				<# } #>

				<div class="sina-flipbox-content">
					<# if ( settings.back_title ) { #>
						<h3 {{{ view.getRenderAttributeString( 'back_title' ) }}}>{{{settings.back_title}}}</h3>
					<# } #>

					<# if ( settings.back_desc ) { #>
						<div {{{ view.getRenderAttributeString( 'front_desc' ) }}}>{{{settings.back_desc}}}</div>
					<# } #>
				</div>
			</div>
		</div><!-- .sina-flipbox -->
		<?php
	}
}