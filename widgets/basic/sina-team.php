<?php

/**
 * Team Widget.
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

class Sina_Team_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_team';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Team', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-person';
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
		return [ 'sina team', 'sina member' ];
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
		// Start Team Content
		// =====================
		$this->start_controls_section(
			'team_content',
			[
				'label' => esc_html__( 'Member', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => esc_html__( 'Layout', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'thumb' => esc_html__( 'Thumb', 'sina-ext' ),
					'grid' => esc_html__( 'Grid', 'sina-ext' ),
					'list' => esc_html__( 'List', 'sina-ext' ),
				],
				'default' => 'thumb',
			]
		);
		$this->add_control(
			'image_position',
			[
				'label' => esc_html__( 'Image Position', 'sina-ext' ),
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
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .sina-team .sina-team-image, {{WRAPPER}} .sina-team .sina-team-content' => 'float: {{VALUE}};',
				],
				'condition' => [
					'layout' => 'list',
				],
			]
		);
		$this->add_control(
			'name',
			[
				'label' => esc_html__( 'Name', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Name', 'sina-ext' ),
				'default' => 'Jhon Doe',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'position',
			[
				'label' => esc_html__( 'Position', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Position', 'sina-ext' ),
				'default' => 'CEO',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'desc',
			[
				'label' => esc_html__( 'Description', 'sina-ext' ),
				'lable_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter Description', 'sina-ext' ),
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, autem amet. Labore eos cum at, et illo ducimus.',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'sina-ext' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/team.jpg',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-facebook',
			]
		);
		$repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'sina-ext' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'social_name',
			[
				'label' => esc_html__( 'Name', 'sina-ext' ),
				'description' => esc_html__( 'This name will be show in the item header', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Facebook',
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->start_controls_tabs( 'icon_tabs' );

		$repeater->start_controls_tab(
			'icon_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext' ),
			]
		);

		$repeater->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-team-social {{CURRENT_ITEM}} a' => 'color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'icon_bg',
			[
				'label' => esc_html__( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-team-social {{CURRENT_ITEM}} a' => 'background: {{VALUE}};',
				],
			]
		);
		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'selector' => '{{WRAPPER}} .sina-team-social {{CURRENT_ITEM}} a',
			]
		);
		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_shadow',
				'selector' => '{{WRAPPER}} .sina-team-social {{CURRENT_ITEM}} a',
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'icon_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext' ),
			]
		);

		$repeater->add_control(
			'icon_hover_color',
			[
				'label' => esc_html__( 'Icon Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-team-social {{CURRENT_ITEM}} a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'icon_hover_bg',
			[
				'label' => esc_html__( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-team-social {{CURRENT_ITEM}} a:hover' => 'background: {{VALUE}}'
				],
			]
		);
		$repeater->add_control(
			'icon_hover_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-team-social {{CURRENT_ITEM}} a:hover' => 'border-color: {{VALUE}}'
				],
			]
		);
		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-team-social {{CURRENT_ITEM}} a:hover',
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'social_icons',
			[
				'label' => esc_html__( 'Add Social Icon', 'sina-ext' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'icon' => 'fa fa-facebook',
						'link' => [
							'url' => 'https://facebook.com',
						],
						'social_name' => 'Facebook',
					],
					[
						'icon' => 'fa fa-twitter',
						'link' => [
							'url' => 'https://twitter.com',
						],
						'social_name' => 'Twitter',
					],
					[
						'icon' => 'fa fa-linkedin',
						'link' => [
							'url' => 'https://linkedin.com',
						],
						'social_name' => 'Linkedin',
					],
				],
				'title_field' => '{{{ social_name }}}',
			]
		);

		$this->end_controls_section();
		// End Team Content
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
			'box_effects',
			[
				'label' => esc_html__( 'Effects', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-team-box-move' => esc_html__( 'Move', 'sina-ext' ),
					'sina-team-box-zoom' => esc_html__( 'Zoom', 'sina-ext' ),
					'' => esc_html__( 'None', 'sina-ext' ),
				],
				'condition' => [
					'layout!' => 'thumb',
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
					'layout!' => 'thumb',
					'box_effects' => 'sina-team-box-zoom',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team.sina-team-box-zoom:hover' => 'transform: scale({{SIZE}});',
				],
			]
		);
		$this->add_control(
			'move',
			[
				'label' => esc_html__( 'Move', 'sina-ext' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'layout!' => 'thumb',
					'box_effects' => 'sina-team-box-move',
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
					'layout!' => 'thumb',
					'box_effects' => 'sina-team-box-move',
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
					'layout!' => 'thumb',
					'box_effects' => 'sina-team-box-move',
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .sina-team-box-move:hover' => 'transform: translate({{translateX.SIZE || 0}}px, {{translateY.SIZE || 0}}px);',
					'(tablet){{WRAPPER}} .sina-team-box-move:hover' => 'transform: translate({{translateX_tablet.SIZE || 0}}px, {{translateY_tablet.SIZE || 0}}px);',
					'(mobile){{WRAPPER}} .sina-team-box-move:hover' => 'transform: translate({{translateX_mobile.SIZE || 0}}px, {{translateY_mobile.SIZE || 0}}px);',
				],
			]
		);
		$this->end_popover();

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fff',
					],
				],
				'condition' => [
					'layout!' => 'thumb',
				],
				'selector' => '{{WRAPPER}} .sina-team',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .sina-team',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .sina-team',
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-team, {{WRAPPER}} .sina-team-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'condition' => [
					'layout!' => 'thumb',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .sina-team' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Box Style
		// =====================


		// Start Overlay Style
		// =====================
		$this->start_controls_section(
			'overlay_style',
			[
				'label' => esc_html__( 'Overlay', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'thumb',
				],
			]
		);

		$this->add_control(
			'effects',
			[
				'label' => esc_html__( 'Effects', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-team-move' => esc_html__( 'Move', 'sina-ext' ),
					'sina-team-zoom' => esc_html__( 'Zoom', 'sina-ext' ),
					'sina-team-zoom sina-team-move' => esc_html__( 'Move & Zoom', 'sina-ext' ),
					'' => esc_html__( 'None', 'sina-ext' ),
				],
				'default' => 'sina-team-move',
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
						'default' => 'rgba(31,140,231,0.9)',
					],
				],
				'selector' => '{{WRAPPER}} .sina-team-overlay',
			]
		);
		$this->add_responsive_control(
			'overlay_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '60',
					'right' => '20',
					'bottom' => '20',
					'left' => '20',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Overlay Style
		// =====================


		// Start Image Style
		// ====================
		$this->start_controls_section(
			'image_style',
			[
				'label' => esc_html__( 'Image', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'thumb',
				],
			]
		);

		Sina_Common_Data::morphing_animation( $this );

		$this->add_responsive_control(
			'image_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'unit' => '%',
					'size' => '50',
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-team img, {{WRAPPER}} .sina-team-image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
					'em' => [
						'max' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '300',
				],
				'condition' => [
					'layout' => 'list',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team-image' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'image_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-team img, {{WRAPPER}} .sina-team-image',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .sina-team img, {{WRAPPER}} .sina-team-image',
			]
		);
		$this->add_responsive_control(
			'image_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-team img, {{WRAPPER}} .sina-team-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'condition' => [
					'layout' => 'grid',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'condition' => [
					'layout!' => 'thumb',
				],
			]
		);

		$this->add_responsive_control(
			'content_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'unit' => '%',
					'size' => '50',
				],
				'condition' => [
					'layout' => 'list',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team .sina-team-content' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-team-content',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'selector' => '{{WRAPPER}} .sina-team',
			]
		);
		$this->add_responsive_control(
			'content_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-team-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '30',
					'right' => '20',
					'bottom' => '20',
					'left' => '20',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Content Style
		// =====================


		// Start Name Style
		// =====================
		$this->start_controls_section(
			'name_style',
			[
				'label' => esc_html__( 'Name', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-team-name' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
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
				'selector' => '{{WRAPPER}} .sina-team-name',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'name_shadow',
				'selector' => '{{WRAPPER}} .sina-team-name',
			]
		);
		$this->add_responsive_control(
			'name_margin',
			[
				'label' => esc_html__( 'Margin Bottom', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'unit' => 'px',
					'size' => '15',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Name Style
		// =====================


		// Start Position Style
		// =====================
		$this->start_controls_section(
			'position_style',
			[
				'label' => esc_html__( 'Position', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'position_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-team-position' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'position_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '600',
					],
					'font_size'   => [
						'default' => [
							'size' => '14',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-team-position',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'position_shadow',
				'selector' => '{{WRAPPER}} .sina-team-position',
			]
		);
		$this->add_responsive_control(
			'position_margin',
			[
				'label' => esc_html__( 'Margin Bottom', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'unit' => 'px',
					'size' => '15',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team-position' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Position Style
		// =====================


		// Start Description Style
		// =========================
		$this->start_controls_section(
			'desc_style',
			[
				'label' => esc_html__( 'Description', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-team-desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .sina-team-desc',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'desc_shadow',
				'selector' => '{{WRAPPER}} .sina-team-desc',
			]
		);

		$this->end_controls_section();
		// End Description Style
		// =====================


		// Start Icon Style
		// =====================
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Social Icon', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'font_size',
			[
				'label' => esc_html__( 'Font Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'unit' => 'px',
					'size' => '14',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team-social a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'unit' => 'px',
					'size' => '40',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team-social a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'font_line_height',
			[
				'label' => esc_html__( 'Line Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'unit' => 'px',
					'size' => '40',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team-social a' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'team_icon_tabs' );

		$this->start_controls_tab(
			'team_icon_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_control(
			'team_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-team-social a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_icon_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#222',
					],
				],
				'selector' => '{{WRAPPER}} .sina-team-social a',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'team_icon_border',
				'selector' => '{{WRAPPER}} .sina-team-social a',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'team_icon_shadow',
				'selector' => '{{WRAPPER}} .sina-team-social a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'team_icon_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_control(
			'team_icon_hover_color',
			[
				'label' => esc_html__( 'Icon Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-team-social a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_icon_hover_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fafafa',
					],
				],
				'selector' => '{{WRAPPER}} .sina-team-social a:hover',
			]
		);
		$this->add_control(
			'team_icon_hover_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-team-social a:hover' => 'border-color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'team_icon_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-team-social a:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'unit' => '%',
					'top' => '50',
					'right' => '50',
					'bottom' => '50',
					'left' => '50',
					'isLinked' => true,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-team-social a, {{WRAPPER}} .sina-team-social a:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_margin',
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
					'{{WRAPPER}} .sina-team-social li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		Sina_Common_Data::BG_hover_effects($this, '.sina-team-social li a', 'icon_bg_layer');

		$this->end_controls_section();
		// End Icon Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$box_class = 'clearfix '. $data['box_effects'];
		$content_class = 'sina-team-content';
		$morphing_anim_image = ('yes' == $data['is_morphing_anim_icon'] && $data['morphing_pattern']) ? $data['morphing_pattern'] : '';

		if ( 'thumb' == $data['layout'] ) {
			$box_class = $data['effects'];
			$content_class = 'sina-team-overlay sina-overlay';
		}
		?>
		<div class="sina-team <?php echo esc_attr( $box_class ); ?>">
			<?php if ( $data['image']['url']): ?>
				<?php if ( 'list' == $data['layout'] ): ?>
					<div class="sina-team-image sina-bg-cover <?php echo esc_attr( $morphing_anim_image ); ?>" style="background-image: url(<?php echo esc_url( $data['image']['url'] ); ?>);"></div>
				<?php else: ?>
					<img class="<?php echo esc_attr( $morphing_anim_image ); ?>" src="<?php echo esc_url( $data['image']['url'] ); ?>" alt="<?php echo esc_attr( $data['name'] ); ?>">
				<?php endif; ?>
			<?php endif; ?>

			<div class="<?php echo esc_attr( $content_class ); ?>">
				<?php if ( $data['name'] ): ?>
					<h5 class="sina-team-name">
						<?php printf( '%s', $data['name'] ); ?>
					</h5>
				<?php endif; ?>

				<?php if ( $data['position'] ): ?>
					<h6 class="sina-team-position">
						<?php printf( '%s', $data['position'] ); ?>
					</h6>
				<?php endif; ?>

				<?php if ( $data['desc'] ): ?>
					<div class="sina-team-desc">
						<?php printf( '%s', $data['desc'] ); ?>
					</div>
				<?php endif; ?>

				<ul class="sina-team-social">
					<?php
						foreach ($data['social_icons'] as $index => $icon):
						?>
						<li class="elementor-repeater-item-<?php echo esc_attr( $icon[ '_id' ] ); ?>">
							<a class="<?php echo esc_attr( $data['icon_bg_layer_effects'] ); ?>"
								href="<?php echo esc_url( $icon['link']['url'] ); ?>"
							<?php if ( 'on' == $icon['link']['is_external'] ): ?>
								target="_blank" 
							<?php endif; ?>
							<?php if ( 'on' == $icon['link']['nofollow'] ): ?>
								rel="nofollow" 
							<?php endif; ?>>
								<i class="<?php echo esc_attr( $icon['icon'] ); ?>"></i>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div><!-- .sina-team -->
		<?php
	}


	protected function content_template() {
		?>
		<#
			var boxClass = 'clearfix '+ settings.box_effects;
			var contentClass = 'sina-team-content';
			var morphingAnimImage = ('yes' == settings.is_morphing_anim_icon && settings.morphing_pattern) ? settings.morphing_pattern : '';

			if ( 'thumb' == settings.layout ) {
				boxClass = settings.effects;
				contentClass = 'sina-team-overlay sina-overlay';
			}

			view.addRenderAttribute( 'name', 'class', 'sina-team-name' );
			view.addInlineEditingAttributes( 'name' );

			view.addRenderAttribute( 'position', 'class', 'sina-team-position' );
			view.addInlineEditingAttributes( 'position' );

			view.addRenderAttribute( 'desc', 'class', 'sina-team-desc' );
			view.addInlineEditingAttributes( 'desc' );
		#>
		<div class="sina-team {{{boxClass}}}">
			<# if (settings.image.url) {
				if ('list' == settings.layout) { #>
				<div class="sina-team-image sina-bg-cover {{{morphingAnimImage}}}" style="background-image: url({{{settings.image.url}}});"></div>
				<# } else { #>
				<img class="{{{morphingAnimImage}}}" src="{{{settings.image.url}}}" alt="{{{settings.name}}}">
			<# } } #>


			<div class="{{{contentClass}}}">
				<# if (settings.name) { #>
					<h5 {{{ view.getRenderAttributeString( 'name' ) }}}>
						{{{settings.name}}}
					</h5>
				<# } #>

				<# if (settings.position) { #>
					<h6 {{{ view.getRenderAttributeString( 'position' ) }}}>
						{{{settings.position}}}
					</h6>
				<# } #>

				<# if (settings.desc) { #>
					<div {{{ view.getRenderAttributeString( 'desc' ) }}}>
						{{{settings.desc}}}
					</div>
				<# } #>

				<ul class="sina-team-social">
					<# _.each( settings.social_icons, function( icon, index ) { #>
					<li class="elementor-repeater-item-{{{icon._id}}}">
						<a class="{{{settings.icon_bg_layer_effects}}}"
							href="{{{icon.link.url}}}">
							<i class="{{{icon.icon}}}"></i>
						</a>
					</li>
					<# }); #>
				</ul>
			</div>
		</div><!-- .sina-team -->
		<?php
	}
}