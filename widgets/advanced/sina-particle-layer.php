<?php

/**
 * Particle Layer Widget.
 *
 * @since 1.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Frontend;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Particle_Layer_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_particle_layer';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return __( 'Sina Particle Layer', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-parallax';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 */
	public function get_categories() {
		return [ 'sina-ext-advanced' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'sina banner', 'sina layer', 'sina particle' ];
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
	 * Get widget scripts.
	 *
	 * Retrieve the list of scripts the widget belongs to.
	 *
	 * @since 1.0.0
	 */
	public function get_script_depends() {
		return [
			'jquery-particle',
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
		// Start Content
		// ===============
		$this->start_controls_section(
			'particle_content',
			[
				'label' => __( 'Content', 'sina-ext' ),
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
			'title',
			[
				'label' => __( 'Title', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Title', 'sina-ext' ),
				'default' => 'Welcome to get start your business',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'title_span',
			[
				'label' => __( 'Title Span', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Title Span', 'sina-ext' ),
				'description' => __( 'You can use SPAN for multi-color title.', 'sina-ext' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label' => __( 'Selct Tag', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
				],
				'default' => 'h1',
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label' => __( 'Sub Title', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Title', 'sina-ext' ),
				'separator' => 'before',
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'subtitle_tag',
			[
				'label' => __( 'Selct Tag', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				],
				'default' => 'h2',
			]
		);
		$this->add_control(
			'desc',
			[
				'label' => __( 'Description', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter Description', 'sina-ext' ),
				'separator' => 'before',
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit',
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->end_controls_section();
		// End Content
		// =============


		// Start Primary Button
		// =====================
		$this->start_controls_section(
			'primary_btn_content',
			[
				'label' => __( 'Primary Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		Sina_Common_Data::button_content( $this, '.sina-banner-pbtn', 'Learn More', 'pbtn', true, true );
		$this->add_control(
			'pbtn_id',
			[
				'label' => __( 'CSS ID', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter ID', 'sina-ext' ),
				'description' => __( 'Make sure this ID unique', 'sina-ext' ),
			]
		);

		$this->end_controls_section();
		// End Primary Button
		// =====================


		// Start Secondary Button
		// =====================
		$this->start_controls_section(
			'secondary_btn_content',
			[
				'label' => __( 'Secondary Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		Sina_Common_Data::button_content( $this, '.sina-banner-sbtn', 'Read More', 'sbtn', true, true );
		$this->add_responsive_control(
			'button_space',
			[
				'label' => __( 'Button Spacing', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'desktop_default' => [
					'size' => 20,
				],
				'mobile_default' => [
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-banner-sbtn' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'sbtn_id',
			[
				'label' => __( 'CSS ID', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter ID', 'sina-ext' ),
				'description' => __( 'Make sure this ID unique', 'sina-ext' ),
			]
		);

		$this->end_controls_section();
		// End Secondary Button
		// =====================


		// Start Particle Content
		// =====================
		$this->start_controls_section(
			'particle_settings',
			[
				'label' => __( 'Particle Settings', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'link_color',
			[
				'label' => __( 'Link Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
			]
		);
		$this->add_control(
			'ball_color',
			[
				'label' => __( 'Ball Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
			]
		);
		$this->add_control(
			'particle_number',
			[
				'label' => __( 'Number', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 150,
				'step' => 1,
				'min' => 50,
				'max' => 500,
			]
		);
		$this->add_control(
			'particle_link_width',
			[
				'label' => __( 'Link Width', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 1,
				'step' => 1,
				'min' => 1,
				'max' => 20,
			]
		);
		$this->add_control(
			'particle_link',
			[
				'label' => __( 'Link Distance', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 50,
				'step' => 1,
				'min' => 10,
				'max' => 200,
			]
		);
		$this->add_control(
			'particle_create_link',
			[
				'label' => __( 'Create Link', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 100,
				'step' => 1,
				'min' => 50,
				'max' => 200,
			]
		);
		$this->add_control(
			'particle_ball',
			[
				'label' => __( 'Ball Max Size', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 10,
				'step' => 1,
				'min' => 10,
				'max' => 100,
			]
		);
		$this->add_control(
			'anim_speed',
			[
				'label' => __( 'Animation Speed', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 20,
				'step' => 10,
				'min' => 10,
				'max' => 100,
			]
		);
		$this->add_control(
			'link_state',
			[
				'label' => __( 'Disable Links', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'sina-ext' ),
				'label_off' => __( 'No', 'sina-ext' ),
			]
		);
		$this->add_control(
			'mouse_state',
			[
				'label' => __( 'Disable Mouse', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'sina-ext' ),
				'label_off' => __( 'No', 'sina-ext' ),
			]
		);

		$this->end_controls_section();
		// End Particle Content
		// =====================


		// Start Animation
		// =====================
		$this->start_controls_section(
			'animation_settings',
			[
				'label' => __( 'Animation Settings', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title_anim',
			[
				'label' => __( 'Title Animation', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'fadeInLeft',
				'options' => Sina_Common_Data::animation(),
			]
		);
		$this->add_control(
			'subtitle_anim',
			[
				'label' => __( 'Sub Title Animation', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'fadeInRight',
				'options' => Sina_Common_Data::animation(),
			]
		);
		$this->add_control(
			'desc_anim',
			[
				'label' => __( 'Description Animation', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'fadeInUp',
				'options' => Sina_Common_Data::animation(),
			]
		);
		$this->add_control(
			'buttons_anim',
			[
				'label' => __( 'Buttons Animation', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'fadeInUp',
				'options' => Sina_Common_Data::animation(),
			]
		);

		$this->end_controls_section();
		// End Animation
		// =====================


		// Start Container Style
		// =====================
		$this->start_controls_section(
			'container_style',
			[
				'label' => __( 'Container', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'container_width',
			[
				'label' => __( 'Width', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 2000,
					],
					'em' => [
						'max' => 100,
					],
				],
				'default' =>[
					'unit' => '%',
					'size' => '100',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-banner-container' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'container_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'desktop_default' => [
					'top' => '180',
					'right' => '50',
					'bottom' => '180',
					'left' => '50',
					'isLinked' => false,
				],
				'tablet_default' => [
					'top' => '80',
					'right' => '100',
					'bottom' => '100',
					'left' => '100',
					'isLinked' => false,
				],
				'mobile_default' => [
					'top' => '60',
					'right' => '20',
					'bottom' => '60',
					'left' => '20',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-particle-layer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'alignment',
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
					'{{WRAPPER}} .sina-banner-container' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'template_style',
			[
				'label' => __( 'Template Style', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'template_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-particle-template' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Container Style
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
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-title' => 'color: {{VALUE}};',
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
							'size' => '40',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '50',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-banner-title',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-banner-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => __( 'Margin Bottom', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'size' => '15',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-banner-title' => 'margin-bottom: {{size}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Title Style
		// =====================


		// Start Title Span Style
		// =======================
		$this->start_controls_section(
			'title_span_style',
			[
				'label' => __( 'Title Span', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'title_span!' => '',
				],
			]
		);

		$this->add_control(
			'title_span_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-title > span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_span_typography',
				'selector' => '{{WRAPPER}} .sina-banner-title > span',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_span_shadow',
				'selector' => '{{WRAPPER}} .sina-banner-title > span',
			]
		);

		$this->end_controls_section();
		// End Title Span Style
		// =====================


		// Start Sub Title Style
		// =====================
		$this->start_controls_section(
			'subtitle_style',
			[
				'label' => __( 'Sub Title', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'subtitle!' => '',
				],
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-subtitle' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '600',
					],
					'font_size'   => [
						'default' => [
							'size' => '30',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '40',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-banner-subtitle',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'subtitle_shadow',
				'selector' => '{{WRAPPER}} .sina-banner-subtitle',
			]
		);
		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => __( 'Margin Bottom', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'size' => '10',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-banner-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Sub Title Style
		// =====================


		// Start Descripton Style
		// =====================
		$this->start_controls_section(
			'desc_style',
			[
				'label' => __( 'Description', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'desc!' => '',
				],
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-desc' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .sina-banner-desc',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'desc_shadow',
				'selector' => '{{WRAPPER}} .sina-banner-desc',
			]
		);
		$this->add_responsive_control(
			'desc_margin',
			[
				'label' => __( 'Margin Bottom', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'size' => '40',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-banner-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Description Style
		// =====================


		// Start Primary button Style
		// ===========================
		$this->start_controls_section(
			'pbtn_style',
			[
				'label' => __( 'Primary Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::button_style( $this, '.sina-banner-pbtn', 'pbtn' );
		$this->add_responsive_control(
			'pbtn_width',
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
					'{{WRAPPER}} .sina-banner-pbtn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'pbtn_radius',
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
				'selectors' => [
					'{{WRAPPER}} .sina-banner-pbtn, {{WRAPPER}} .sina-banner-pbtn:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'pbtn_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'desktop_default' => [
					'top' => '12',
					'right' => '25',
					'bottom' => '12',
					'left' => '25',
					'isLinked' => false,
				],
				'mobile_default' => [
					'top' => '10',
					'right' => '15',
					'bottom' => '10',
					'left' => '15',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-banner-pbtn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		Sina_Common_Data::BG_hover_effects_alt($this, '.sina-banner-pbtn', 'pbtn_bg_layer');

		$this->end_controls_section();
		// End Primary Button Style
		// ==========================


		// Start Secondary button Style
		// ===========================
		$this->start_controls_section(
			'sbtn_style',
			[
				'label' => __( 'Secondary Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::button_style( $this, '.sina-banner-sbtn', 'sbtn' );
		$this->add_responsive_control(
			'sbtn_width',
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
					'{{WRAPPER}} .sina-banner-sbtn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'sbtn_radius',
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
				'selectors' => [
					'{{WRAPPER}} .sina-banner-sbtn, {{WRAPPER}} .sina-banner-sbtn:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'sbtn_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'desktop_default' => [
					'top' => '12',
					'right' => '25',
					'bottom' => '12',
					'left' => '25',
					'isLinked' => false,
				],
				'mobile_default' => [
					'top' => '10',
					'right' => '15',
					'bottom' => '10',
					'left' => '15',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-banner-sbtn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		Sina_Common_Data::BG_hover_effects_alt($this, '.sina-banner-sbtn', 'sbtn_bg_layer');

		$this->end_controls_section();
		// End Secondary Button Style
		// ==========================


		// Start Tooltips Style
		// ======================
		$this->start_controls_section(
			'tooltips_style',
			[
				'label' => __( 'Tooltips', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::tooltip_style( $this, 'btn', '' );
		$this->end_controls_section();
		// End Tooltips Style
		// ====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();

		$pbtn_tooltip = $data['pbtn_tooltip_text'] ? 'sina-tooltip' : '';
		$sbtn_tooltip = $data['sbtn_tooltip_text'] ? 'sina-tooltip' : '';
		?>
		<div class="sina-particle-layer">
			<div class="sina-banner-container">
				<?php
					if ( 'yes' == $data['save_templates'] && $data['template'] ) {
						$frontend = new Frontend;
						echo '<div class="sina-particle-template">'. $frontend->get_builder_content( $data['template'], true ) .'</div>';
					}
				?>

				<?php if ( $data['title'] ): ?>
					<?php $title_span = $data['title_span'] ? '<span>'.$data['title_span'].'</span>' : ''; ?>
					<?php printf('<%3$s class="sina-banner-title animated %1$s">%2$s%4$s</%3$s>', $data['title_anim'], $data['title'], $data['title_tag'], $title_span); ?>
				<?php endif; ?>

				<?php if ( $data['subtitle'] ): ?>
					<?php printf('<%3$s class="sina-banner-subtitle animated %1$s">%2$s</%3$s>', $data['subtitle_anim'], $data['subtitle'], $data['title_tag']); ?>
				<?php endif; ?>

				<?php if ( $data['desc'] ): ?>
					<?php printf('<div class="sina-banner-desc animated %1$s">%2$s</div>', $data['desc_anim'], $data['desc']); ?>
				<?php endif; ?>

				<?php if ( $data['pbtn_text'] || $data['sbtn_text'] ): ?>
					<div class="sina-banner-btns animated <?php echo esc_attr( $data['buttons_anim'] ); ?>">
						<?php if ( $data['pbtn_text'] ): ?>
							<a class="sina-banner-pbtn <?php echo esc_attr( $pbtn_tooltip.' '.$data['pbtn_effect'].' '.$data['pbtn_bg_layer_effects'] ) ?>"
							<?php if ( $data['pbtn_id'] ): ?>
								id="<?php echo esc_attr( $data['pbtn_id'] ); ?>"
							<?php endif; ?>
							href="<?php echo esc_url( $data['pbtn_link']['url'] ); ?>"
							<?php if ( 'on' == $data['pbtn_link']['is_external'] ): ?>
								target="_blank" 
							<?php endif; ?>
							<?php if ( 'on' == $data['pbtn_link']['nofollow'] ): ?>
								rel="nofollow" 
							<?php endif; ?>
							<?php if ( $data['pbtn_tooltip_text'] ): ?>
								data-toggle="tooltip" 
								title="<?php echo esc_attr( $data['pbtn_tooltip_text'] ); ?>" 
							<?php endif; ?>
							role="button">
								<?php Sina_Common_Data::button_html($data, 'pbtn'); ?>
							</a>
						<?php endif ?>

						<?php if ( $data['sbtn_text'] ): ?>
							<a class="sina-banner-sbtn <?php echo esc_attr(  $sbtn_tooltip.' '.$data['sbtn_effect'].' '.$data['sbtn_bg_layer_effects'] ) ?>"
							<?php if ( $data['sbtn_id'] ): ?>
								id="<?php echo esc_attr( $data['sbtn_id'] ); ?>"
							<?php endif; ?>
							href="<?php echo esc_url( $data['sbtn_link']['url'] ); ?>"
							<?php if ( 'on' == $data['sbtn_link']['is_external'] ): ?>
								target="_blank" 
							<?php endif; ?>
							<?php if ( 'on' == $data['sbtn_link']['nofollow'] ): ?>
								rel="nofollow" 
							<?php endif; ?>
							<?php if ( $data['sbtn_tooltip_text'] ): ?>
								data-toggle="tooltip" 
								title="<?php echo esc_attr( $data['sbtn_tooltip_text'] ); ?>" 
							<?php endif; ?>
							role="button">
								<?php Sina_Common_Data::button_html($data, 'sbtn'); ?>
							</a>
						<?php endif ?>
					</div>
				<?php endif ?>
			</div>
			<div class="sina-particle"
			data-link-color="<?php echo esc_attr( $data['link_color']); ?>"
			data-ball-color="<?php echo esc_attr( $data['ball_color']); ?>"
			data-number="<?php echo esc_attr( $data['particle_number']); ?>"
			data-link="<?php echo esc_attr( $data['particle_link']); ?>"
			data-clink="<?php echo esc_attr( $data['particle_create_link']); ?>"
			data-linkw="<?php echo esc_attr( $data['particle_link_width']); ?>"
			data-size="<?php echo esc_attr( $data['particle_ball']); ?>"
			data-speed="<?php echo esc_attr( $data['anim_speed']); ?>"
			data-dlink="<?php echo esc_attr( $data['link_state']); ?>"
			data-dmouse="<?php echo esc_attr( $data['mouse_state']); ?>"></div>
		</div><!-- .sina-particle-layer -->
		<?php
	}


	protected function _content_template() {
		
	}
}