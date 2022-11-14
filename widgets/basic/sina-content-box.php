<?php

/**
 * Content Box Widget.
 *
 * @since 1.0.2
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Group_Control_Border;
use \Elementor\Control_Media;
use \Elementor\Frontend;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Content_Box_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 1.0.2
	 */
	public function get_name() {
		return 'sina_content_box';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.2
	 */
	public function get_title() {
		return esc_html__( 'Sina Content Box', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.2
	 */
	public function get_icon() {
		return 'eicon-icon-box';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.0.2
	 */
	public function get_categories() {
		return [ 'sina-extension' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.2
	 */
	public function get_keywords() {
		return [ 'sina content box', 'sina icon box', 'sina image box', 'sina box' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.0.2
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
	 * @since 1.0.2
	 * @access protected
	 */
	protected function register_controls() {
		// Start Box Content
		// =====================
		$this->start_controls_section(
			'box_content',
			[
				'label' => esc_html__( 'Box', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'is_linkable_box',
			[
				'label' => esc_html__( 'Linkable Entire Box', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'save_templates',
			[
				'label' => esc_html__( 'Use Save Templates', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'template',
			[
				'label' => esc_html__( 'Choose Template', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => sina_get_page_templates(),
				'condition' => [
					'save_templates!' => '',
				],
				'description' => esc_html__('NOTE: Don\'t try to edit after insertion template. If you need to change the style or layout then you try to change the main template then save and then insert', 'sina-ext'),
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
			'icon_format',
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
				'condition' => [
					'save_templates' => '',
				],
			]
		);
		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-amazon',
				'condition' => [
					'save_templates' => '',
					'icon_format' => 'icon',
				],
			]
		);
		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'sina-ext' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'save_templates' => '',
					'icon_format' => 'image',
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
			'title',
			[
				'label' => esc_html__( 'Title', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Title', 'sina-ext' ),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext' ),
				'default' => 'Apps Development',
				'condition' => [
					'save_templates' => '',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'desc',
			[
				'label' => esc_html__( 'Description', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter Description', 'sina-ext' ),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext' ),
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, autem amet. Labore eos cum at, et illo ducimus.',
				'condition' => [
					'save_templates' => '',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'sina-ext' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'condition' => [
					'save_templates' => '',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->end_controls_section();
		// End Box Content
		// =====================


		// Start Button Content
		// =====================
		$this->start_controls_section(
			'button_content',
			[
				'label' => esc_html__( 'Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		Sina_Common_Data::button_content( $this, '.sina-read-more', '');
		$this->end_controls_section();
		// End Button Content
		// =====================


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
					'sina-content-box-move' => esc_html__( 'Move', 'sina-ext' ),
					'sina-content-box-zoom' => esc_html__( 'Zoom', 'sina-ext' ),
					'' => esc_html__( 'None', 'sina-ext' ),
				],
				'default' => 'sina-content-box-zoom',
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
					'effects' => 'sina-content-box-zoom',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box.sina-content-box-zoom:hover' => 'transform: scale({{SIZE}});',
				],
			]
		);
		$this->add_control(
			'move',
			[
				'label' => esc_html__( 'Move', 'sina-ext' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'effects' => 'sina-content-box-move',
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
					'effects' => 'sina-content-box-move',
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
					'effects' => 'sina-content-box-move',
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .sina-content-box:hover' => 'transform: translate({{translateX.SIZE || 0}}px, {{translateY.SIZE || 0}}px);',
					'(tablet){{WRAPPER}} .sina-content-box:hover' => 'transform: translate({{translateX_tablet.SIZE || 0}}px, {{translateY_tablet.SIZE || 0}}px);',
					'(mobile){{WRAPPER}} .sina-content-box:hover' => 'transform: translate({{translateX_mobile.SIZE || 0}}px, {{translateY_mobile.SIZE || 0}}px);',
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
				'name' => 'background',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fff',
					],
				],
				'selector' => '{{WRAPPER}} .sina-content-box',
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
						'default' => '#fafafa',
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
				'selector' => '{{WRAPPER}} .sina-content-box',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .sina-content-box',
			]
		);

		$this->add_control(
			'icon_heading',
			[
				'label' => esc_html__( 'Icon or Image', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'condition' => [
					'save_templates' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box-icon' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_background',
				'types' => [ 'classic', 'gradient' ],
				'condition' => [
					'save_templates' => '',
				],
				'selector' => '{{WRAPPER}} .sina-content-box-icon',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_image_shadow',
				'selector' => '{{WRAPPER}} .sina-content-box-icon',
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'icon_filters',
				'selector' => '{{WRAPPER}} .sina-content-box-icon',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'condition' => [
					'save_templates' => '',
				],
				'selector' => '{{WRAPPER}} .sina-content-box-icon',
			]
		);

		$this->add_control(
			'title_desc_heading',
			[
				'label' => esc_html__( 'Title & Description', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'condition' => [
					'save_templates' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box-title, {{WRAPPER}} .sina-content-box-title > a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Description Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'condition' => [
					'save_templates' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box-desc' => 'color: {{VALUE}};',
				],
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
				'name' => 'hover_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-content-box:hover',
			]
		);
		$this->add_control(
			'box_hover_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-content-box:hover' => 'border-color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_hover_shadow',
				'fields_options' => [
					'box_shadow_type' => [ 
						'default' =>'yes' 
					],
					'box_shadow' => [
						'default' => [
							'horizontal' => '0',
							'vertical' => '10',
							'blur' => '10',
							'color' => 'rgba(0,0,0,0.1)'
						]
					]
				],
				'selector' => '{{WRAPPER}} .sina-content-box:hover',
			]
		);

		$this->add_control(
			'icon_hover_heading',
			[
				'label' => esc_html__( 'Icon or Image', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'save_templates' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box:hover .sina-content-box-icon' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_hover_background',
				'types' => [ 'classic', 'gradient' ],
				'condition' => [
					'save_templates' => '',
				],
				'selector' => '{{WRAPPER}} .sina-content-box:hover .sina-content-box-icon',
			]
		);
		$this->add_control(
			'icon_hover_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'save_templates' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box:hover .sina-content-box-icon' => 'border-color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_image_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-content-box:hover .sina-content-box-icon',
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'icon_hover_filters',
				'selector' => '{{WRAPPER}} .sina-content-box:hover .sina-content-box-icon',
			]
		);

		$this->add_control(
			'title_desc_hover_heading',
			[
				'label' => esc_html__( 'Title & Description', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' => esc_html__( 'Title Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'save_templates' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box:hover .sina-content-box-title, {{WRAPPER}} .sina-content-box:hover .sina-content-box-title > a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'desc_hover_color',
			[
				'label' => esc_html__( 'Description Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'save_templates' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box:hover .sina-content-box-desc' => 'color: {{VALUE}};',
				],
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
				'selector' => '{{WRAPPER}} .sina-content-box:hover .sina-read-more',
			]
		);
		$this->add_control(
			'button_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-content-box:hover .sina-read-more' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_border_color',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-content-box:hover .sina-read-more' => 'border-color: {{VALUE}};',
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
				'default' => [
					'top' => '4',
					'right' => '4',
					'bottom' => '4',
					'left' => '4',
					'isLinked' => true,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-content-box, {{WRAPPER}} .sina-content-box:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '30',
					'right' => '30',
					'bottom' => '30',
					'left' => '30',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		Sina_Common_Data::BG_hover_effects($this, '.sina-content-box');

		$this->end_controls_section();
		// End Box Style
		// =====================


		// Start Icon Style
		// =====================
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Icon or Image', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'save_templates' => '',
					'icon_format' => ['icon', 'image'],
				],
			]
		);

		Sina_Common_Data::morphing_animation( $this );

		$this->add_control(
			'image_effects',
			[
				'label' => esc_html__( 'Effects', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-img-zoom' => esc_html__( 'Zoom', 'sina-ext' ),
					'' => esc_html__( 'None', 'sina-ext' ),
				],
				'condition' => [
					'icon_format' => 'image',
				],
				'separator' => 'before',
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'icon_float',
			[
				'label' => esc_html__( 'Float', 'sina-ext' ),
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
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-content-box-icon, {{WRAPPER}} .sina-content-box-content' => 'float: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'max' => 200,
					],
					'em' => [
						'max' => 20,
					],
				],
				'default'=> [
					'unit' => 'px',
					'size' => '38',
				],
				'condition' => [
					'icon_format' => 'icon',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_size',
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
					'icon_format' => 'image',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box-icon img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_box_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 500,
					],
					'em' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_box_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 500,
					],
					'em' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_padding',
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
					'{{WRAPPER}} .sina-content-box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Icon Style
		// =====================


		// Start Content Style
		// =====================
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'save_templates' => '',
				],
			]
		);

		$this->add_control(
			'title_style',
			[
				'label' => esc_html__( 'Title', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
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
					'transform'   => [
						'default' => [
							'size' => 'uppercase',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-content-box-title, {{WRAPPER}} .sina-content-box-title > a',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-content-box-title, {{WRAPPER}} .sina-content-box-title > a',
			]
		);
		$this->add_responsive_control(
			'title_margin',
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
					'{{WRAPPER}} .sina-content-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'desc_style',
			[
				'label' => esc_html__( 'Description', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .sina-content-box-desc',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'desc_shadow',
				'selector' => '{{WRAPPER}} .sina-content-box-desc',
			]
		);
		$this->add_responsive_control(
			'content_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 500,
					],
					'em' => [
						'max' => 100,
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-content-box-content' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'justify' => [
						'title' => esc_html__( 'Justify', 'sina-ext' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .sina-content-box' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Content Style
		// ===================


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
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'ribbon_shadow',
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


		// Start Button Style
		// =====================
		$this->start_controls_section(
			'button_style',
			[
				'label' => esc_html__( 'Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'btn_text!' => '',
				],
			]
		);
		Sina_Common_Data::button_style( $this, '.sina-content-box .sina-read-more' );
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
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-read-more, {{WRAPPER}} .sina-read-more:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .sina-read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'bottom' => '10',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		Sina_Common_Data::BG_hover_effects($this, '.sina-read-more', 'btn_bg_layer');

		$this->end_controls_section();
		// End Button Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$img_alt = $data['title'] ? $data['title'] : Control_Media::get_image_alt( $data['image'] );
		$morphing_anim_icon = ('yes' == $data['is_morphing_anim_icon'] && $data['morphing_pattern']) ? $data['morphing_pattern'] : '';
		?>
		<div class="sina-content-box clearfix <?php echo esc_attr( $data['effects'].' '.$data['bg_layer_effects'] ); ?>">

			<?php if ( 'yes' == $data['is_linkable_box'] && $data['link']['url'] ): ?>
				<a class="sina-content-box-linkable"
				href="<?php echo esc_url( $data['link']['url'] ); ?>"
				<?php if ( 'on' == $data['link']['is_external'] ): ?>
					target="_blank" 
				<?php endif; ?>
				<?php if ( 'on' == $data['link']['nofollow'] ): ?>
					rel="nofollow" 
				<?php endif; ?>></a>
			<?php endif; ?>

			<?php if ( $data['ribbon_title'] && $data['ribbon_position'] ): ?>
				<div class="<?php echo esc_attr( $data['ribbon_position'] ); ?>">
					<?php printf( '%s', $data['ribbon_title'] ); ?>
				</div>
			<?php endif; ?>

			<?php
				if ( 'yes' == $data['save_templates'] && $data['template'] ) :
					$frontend = new Frontend;
					echo $frontend->get_builder_content( $data['template'], true );
				else:
					?>
					<?php if ( 'icon' == $data['icon_format'] ): ?>
						<div class="sina-content-box-icon <?php echo esc_attr( $morphing_anim_icon ); ?>">
							<i class="<?php echo esc_attr( $data['icon'] ); ?>"></i>
						</div>
					<?php elseif( 'image' == $data['icon_format'] ): ?>
						<div class="sina-content-box-icon <?php echo esc_attr( $morphing_anim_icon.' '.$data['image_effects'] ); ?>">
							<img src="<?php echo esc_url( $data['image']['url'] ); ?>" alt="<?php echo esc_attr( $img_alt ) ?>">
						</div>
					<?php endif; ?>

					<div class="sina-content-box-content">
						<?php if ( $data['title'] ): ?>
							<h3 class="sina-content-box-title">
								<?php if ( $data['link']['url'] ): ?>
									<a href="<?php echo esc_url( $data['link']['url'] ); ?>"
										<?php if ( 'on' == $data['link']['is_external'] ): ?>
											target="_blank" 
										<?php endif; ?>
										<?php if ( 'on' == $data['link']['nofollow'] ): ?>
											rel="nofollow" 
										<?php endif; ?>>
										<?php printf( '%1$s', $data['title'] ); ?>
									</a>
								<?php else: ?>
									<?php printf( '%1$s', $data['title'] ); ?>
								<?php endif; ?>
							</h3>
						<?php endif; ?>

						<?php if ( $data['desc'] ): ?>
							<?php printf( '<div class="sina-content-box-desc">%1$s</div>', $data['desc'] ); ?>
						<?php endif; ?>

						<?php if ( $data['btn_text'] ): ?>
							<div class="sina-btn-wrapper">
								<a class="sina-read-more <?php echo esc_attr( $data['btn_effect'].' '.$data['btn_bg_layer_effects'] ); ?>"
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
					</div>
			<?php endif; ?>
		</div><!-- .sina-content-box -->
		<?php
	}


	protected function content_template() {

	}
}