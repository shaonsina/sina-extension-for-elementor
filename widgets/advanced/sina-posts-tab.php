<?php

/**
 * Posts Tab Widget.
 *
 * @since 1.2.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Posts_Tab_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 1.2.0
	 */
	public function get_name() {
		return 'sina_posts_tab';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.2.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Posts Tab', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.2.0
	 */
	public function get_icon() {
		return 'eicon-tabs';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.2.0
	 */
	public function get_categories() {
		return [ 'sina-ext-advanced' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.2.0
	 */
	public function get_keywords() {
		return [ 'sina posts tab', 'sina tab', 'sina blog posts', 'sina blogpost' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.2.0
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
	 * Get widget scripts.
	 *
	 * Retrieve the list of scripts the widget belongs to.
	 *
	 * @since 1.2.0
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
	 * @since 1.2.0
	 */
	protected function register_controls() {
		// Start Tab Content
		// ===================
		$this->start_controls_section(
			'tab_content',
			[
				'label' => esc_html__( 'Tab Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'category',
			[
				'label' => esc_html__( 'Select Category', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => sina_get_categories(),
				'default' => 'Uncategorized',
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

		$this->add_control(
			'categories',
			[
				'label' => esc_html__('Add Categories', 'sina-ext'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => 'Uncategorized',
						'category' => 'Uncategorized',
					],
				],
				'title_field' => '{{{category}}}',
			]
		);
		Sina_Common_Data::posts_content($this);
		$this->add_control(
			'date',
			[
				'label' => esc_html__( 'Date', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'sina-ext' ),
				'label_off' => esc_html__( 'Hide', 'sina-ext' ),
			]
		);
		$this->add_control(
			'tag',
			[
				'label' => esc_html__( 'Tag', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'sina-ext' ),
				'label_off' => esc_html__( 'Hide', 'sina-ext' ),
			]
		);
		$this->add_control(
			'preview_right',
			[
				'label' => esc_html__( 'Preview Right', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext' ),
				'label_off' => esc_html__( 'No', 'sina-ext' ),
			]
		);

		$this->end_controls_section();
		// End Tab Content
		// =================


		// Start Menu Wrap Style
		// =======================
		$this->start_controls_section(
			'menu_wrap_style',
			[
				'label' => esc_html__( 'Categories Wrapper', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btns_wrap_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-pt-btns',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btns_wrap_border',
				'selector' => '{{WRAPPER}} .sina-pt-btns',
			]
		);
		$this->add_responsive_control(
			'btns_wrap_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-btns' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btns_wrap_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-btns' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btns_wrap_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '40',
					'left' => '0',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-btns' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Menu Wrap Style
		// =====================


		// Start Categories Style
		// =======================
		$this->start_controls_section(
			'cat_style',
			[
				'label' => esc_html__( 'Categories', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::button_style( $this, '.sina-pt-cat-btn', 'cat' );
		$this->add_control(
			'icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'left' => esc_html__( 'Left', 'sina-ext' ),
					'right' => esc_html__( 'Right', 'sina-ext' ),
				],
				'separator' => 'before',
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
					'{{WRAPPER}} .sina-pt-cat-btn .sina-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sina-pt-cat-btn .sina-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'cat_gap',
			[
				'label' => esc_html__( 'Gap From Content', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' =>[
					'size' => '40',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-btns' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'cat_width',
			[
				'label' => esc_html__( 'Min Width', 'sina-ext' ),
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
				'selectors' => [
					'{{WRAPPER}} .sina-pt-cat-btn' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'cat_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-cat-btn, {{WRAPPER}} .sina-pt-cat-btn:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'cat_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '10',
					'right' => '15',
					'bottom' => '10',
					'left' => '15',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-cat-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'cat_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
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
					'{{WRAPPER}} .sina-pt-cat-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'cat_alignment',
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
					'{{WRAPPER}} .sina-pt-btns' => 'text-align: {{VALUE}};',
				],
			]
		);
		Sina_Common_Data::BG_hover_effects($this, '.sina-button', 'cats_bg_layer');

		$this->end_controls_section();
		// End Categories style
		// =====================


		// Start Thumb Style
		// =======================
		$this->start_controls_section(
			'thumb_style',
			[
				'label' => esc_html__( 'Thumbnail', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'thumb_width',
			[
				'label' => esc_html__( 'Width (%)', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => '60',
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => '60',
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => '100',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-content-content' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'thumb_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 800,
					],
				],
				'default' => [
					'size' => '422',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-content-content .sina-pt-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'thumb_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-content-content .sina-pt-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'thumb_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'top' => '15',
					'right' => '0',
					'bottom' => '0',
					'left' => '25',
					'isLinked' => false,
				],
				'tablet_default' => [
					'top' => '15',
					'right' => '0',
					'bottom' => '0',
					'left' => '25',
					'isLinked' => false,
				],
				'mobile_default' => [
					'top' => '15',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => false,
				],

				'selectors' => [
					'{{WRAPPER}} .sina-pt-content-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'thumb_title_alignment',
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
					'{{WRAPPER}} .sina-pt-thumb-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'thumb_title',
			[
				'label' => esc_html__( 'Title Style', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'thumb_title_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_size'   => [
						'default' => [
							'size' => '24',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '32',
						],
					],
					'text_transform' => [
						'default' => 'uppercase',
					],
				],
				'selector' => '{{WRAPPER}} .sina-pt-thumb-content h2 a',
			]
		);
		$this->add_control(
			'thumb_title_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-pt-thumb-content h2 a,
					{{WRAPPER}} .sina-pt-thumb-content h2 a:hover,
					{{WRAPPER}} .sina-pt-thumb-content h2 a:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'thumb_meta',
			[
				'label' => esc_html__( 'Meta Style', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'thumb_meta_typography',
				'selector' => '{{WRAPPER}} .sina-pt-thumb-content p,
				{{WRAPPER}} .sina-pt-thumb-content p a',
			]
		);
		$this->add_control(
			'thumb_meta_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-pt-thumb-content p,
					{{WRAPPER}} .sina-pt-thumb-content p a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'thumb_meta_gap',
			[
				'label' => esc_html__( 'Gap From Title', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-thumb-content p' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Thumb style
		// =================


		// Start Preview Style
		// =======================
		$this->start_controls_section(
			'preview_style',
			[
				'label' => esc_html__( 'Preview List', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'preview_width',
			[
				'label' => esc_html__( 'List Width (%)', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => '40',
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => '40',
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => '100',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-content .sina-pt-posts' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_padding',
			[
				'label' => esc_html__( 'List Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'top' => '15',
					'right' => '0',
					'bottom' => '15',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_width',
			[
				'label' => esc_html__( 'Title Width (%)', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => '60',
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => '60',
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => '60',
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-pt-title-wraper' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'preview_thumb_width',
			[
				'label' => esc_html__( 'Preview Thumb Width (%)', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => '40',
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => '40',
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => '40',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-thumb' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'preview_thumb_height',
			[
				'label' => esc_html__( 'Preview Thumb Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 200,
					],
				],
				'default' => [
					'size' => '120',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-thumb, {{WRAPPER}} .sina-pt-title-wraper' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'preview_border',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'color' => [
						'default' => '#fafafa',
					],
					'width' => [
						'default' => [
							'top' => '0',
							'right' => '0',
							'bottom' => '1',
							'left' => '0',
							'isLinked' => false,
						]
					],
				],
				'selector' => '{{WRAPPER}} .sina-pt-content .sina-pt-post',
			]
		);
		$this->add_responsive_control(
			'preview_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-content .sina-pt-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Preview style
		// ===================


		// Start Title Style
		// =======================
		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Preview Title', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
				'selector' => '{{WRAPPER}} .sina-pt-title h3',
			]
		);

		$this->start_controls_tabs( 'title_tabs' );

		$this->start_controls_tab(
			'title_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-pt-title h3' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-pt-title h3',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pt-title h3:hover' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-pt-title h3:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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
				'default' => 'left',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-pt-title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Title style
		// ===================


		// Start Meta Style
		// =======================
		$this->start_controls_section(
			'meta_style',
			[
				'label' => esc_html__( 'Date', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'date' => 'yes',
				],
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pt-title p' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'selector' => '{{WRAPPER}} .sina-pt-title p',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'meta_shadow',
				'selector' => '{{WRAPPER}} .sina-pt-title p',
			]
		);
		$this->add_responsive_control(
			'meta_gap',
			[
				'label' => esc_html__( 'Gap From Title', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pt-title p' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Meta style
		// ===================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		if ( !empty($data['categories']) ) :
			$id = $this->get_id();
			?>
			<div class="sina-posts-tab">
				<div class="sina-pt-btns">
					<?php
						foreach ($data['categories'] as $cats):
							$bid = $id.'-'.str_replace(' ', '-', $cats['category']);
							?>
							<button class="sina-pt-cat-btn sina-button <?php echo esc_attr( $data['cats_bg_layer_effects'] ); ?>" data-sina-pt="#<?php echo esc_attr($bid); ?>">
								<?php if ( $cats['icon'] && $data['icon_align'] == 'left' ): ?>
									<i class="<?php echo esc_attr($cats['icon']); ?> sina-icon-left"></i>
								<?php endif; ?>
								<?php printf( '%s', $cats['category'] ); ?>
								<?php if ( $cats['icon'] && $data['icon_align'] == 'right' ): ?>
									<i class="<?php echo esc_attr($cats['icon']); ?> sina-icon-right"></i>
								<?php endif; ?>
							</button>
					<?php endforeach; ?>
				</div>

				<div class="sina-pt-content">
					<?php foreach ($data['categories'] as $key => $cats):
						$cid = $id.'-'.str_replace(' ', '-', $cats['category']);
						?>
						<div class="sina-pt-item <?php echo $key == 0 ? 'active' : ''; ?>" id="<?php echo esc_attr($cid); ?>">
							<div class="sina-pt-content<?php echo 'yes' == $data['preview_right'] ? '-right' : ''; ?>">
								<div class="sina-pt-content-content">
									<?php
										$tc = 0;
										if ( get_query_var('paged') ) {
											$paged = get_query_var('paged');
										} else if ( get_query_var('page') ) {
											$paged = get_query_var('page');
										} else {
											$paged = 1;
										}

										$new_offset = (int)$data['offset'] + ( ( $paged - 1 ) * (int)$data['posts_num'] );
										$default	= [
											'category_name'		=> $cats['category'],
											'orderby'			=> [ $data['order_by'] => $data['sort'] ],
											'posts_per_page'	=> $data['posts_num'],
											'paged'				=> $paged,
											'offset'			=> $new_offset,
											'has_password'		=> false,
											'post_status'		=> 'publish',
											'post__not_in'		=> get_option( 'sticky_posts' ),
										];

										// Post Query
										$post_query = new WP_Query( $default );

										while ( $post_query->have_posts() ) : $post_query->the_post();
											$tid = $id.'-'.str_replace(' ', '-', $cats['category']).'-'.$tc;
											?>
											<?php if ( get_the_post_thumbnail_url() ): ?>
												<div class="sina-pt-item sina-bg-cover <?php echo $tc == 0 ? 'active' : ''; ?>" id="<?php echo esc_attr($tid); ?>" style="background-image: url(<?php the_post_thumbnail_url(); ?>); ">
													<a class="sina-overlay" href="<?php the_permalink(); ?>"></a>
													<div class="sina-pt-thumb-content">
														<h2>
															<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
														</h2>
														<?php if ('yes' == $data['tag'] && get_the_tags()): ?>
															<p>
																<span class="fas fa fa-tag"></span>
																<?php the_tags( '' ); ?>
															</p>
														<?php endif; ?>
													</div>
												</div>
											<?php else: ?>
												<div class="sina-pt-item sina-bg-cover <?php echo $tc == 0 ? 'active' : ''; ?>" id="<?php echo esc_attr($tid); ?>" style="background-image: url(<?php echo esc_url( SINA_EXT_URL .'assets/img/featured-img.jpg' ); ?>); ">
													<a class="sina-overlay" href="<?php the_permalink(); ?>"></a>
													<div class="sina-pt-thumb-content">
														<h2>
															<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
														</h2>
														<?php if ('yes' == $data['tag'] && get_the_tags()): ?>
															<p>
																<span class="fas fa fa-tag"></span>
																<?php the_tags( '' ); ?>
															</p>
														<?php endif; ?>
													</div>
												</div>
											<?php endif; ?>
											<?php
											$tc++;
										endwhile;
										wp_reset_query();
									?>
								</div>
								<div class="sina-pt-posts">
									<?php
										$pc = 0;
										while ( $post_query->have_posts() ) : $post_query->the_post();
											$pid = $id.'-'.str_replace(' ', '-', $cats['category']).'-'.$pc;
											?>
											<div class="sina-pt-post">
												<?php if ( 'yes' == $data['preview_right'] ): ?>
													<?php if ( get_the_post_thumbnail_url() ): ?>
														<div class="sina-pt-thumb sina-bg-cover" data-sina-pt="#<?php echo esc_attr( $pid ); ?>" style="background-image: url(<?php the_post_thumbnail_url(); ?>)">
														</div>
													<?php else: ?>
														<div class="sina-pt-thumb sina-bg-cover" data-sina-pt="#<?php echo esc_attr( $pid ); ?>" style="background-image: url(<?php echo esc_url( SINA_EXT_URL .'assets/img/featured-img.jpg' ); ?>)">
														</div>
													<?php endif; ?>
													<div class="sina-pt-title-wraper sina-flex">
														<div class="sina-pt-title">
															<h3 data-sina-pt="#<?php echo esc_attr( $pid ); ?>"><?php the_title(); ?></h3>
															<?php if ('yes' == $data['date']): ?>
																<p><span class="fa fa-clock-o far fa-clock"></span> <?php printf( '%s', get_the_date() ); ?></p>
															<?php endif ?>
														</div>
													</div>
												<?php else: ?>
													<div class="sina-pt-title-wraper sina-flex">
														<div class="sina-pt-title">
															<h3 data-sina-pt="#<?php echo esc_attr( $pid ); ?>"><?php the_title(); ?></h3>
															<?php if ('yes' == $data['date']): ?>
																<p><span class="fa fa-clock-o far fa-clock"></span> <?php printf( '%s', get_the_date() ); ?></p>
															<?php endif ?>
														</div>
													</div>
													<?php if ( get_the_post_thumbnail_url() ): ?>
														<div class="sina-pt-thumb sina-bg-cover" data-sina-pt="#<?php echo esc_attr( $pid ); ?>" style="background-image: url(<?php the_post_thumbnail_url(); ?>)">
														</div>
													<?php else: ?>
														<div class="sina-pt-thumb sina-bg-cover" data-sina-pt="#<?php echo esc_attr( $pid ); ?>" style="background-image: url(<?php echo esc_url( SINA_EXT_URL .'assets/img/featured-img.jpg' ); ?>)">
														</div>
													<?php endif; ?>
												<?php endif ?>
											</div>
											<?php
											$pc++;
										endwhile;
										wp_reset_query();
									?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div><!-- .sina-posts-tab -->
			<?php
		endif;
	}


	protected function content_template() {

	}
}