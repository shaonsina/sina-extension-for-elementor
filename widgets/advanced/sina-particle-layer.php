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

class Sina_Particle_Layer_Widget extends Widget_Base{

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
		return esc_html__( 'Sina Particle Layer', 'sina-ext' );
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
			'icofont',
			'font-awesome',
			'elementor-icons',
			'animate-merge',
			'sina-tooltip',
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
			'sina-tooltip',
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
		// Start Content
		// ===============
			$this->start_controls_section(
				'particle_content',
				[
					'label' => esc_html__( 'Content', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
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
				'title',
				[
					'label' => esc_html__( 'Title', 'sina-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'Enter Title', 'sina-ext' ),
					'default' => 'Welcome to get start your business',
					'dynamic' => [
						'active' => true,
					],
				]
			);
			$this->add_control(
				'title_span',
				[
					'label' => esc_html__( 'Title Span', 'sina-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'Enter Title Span', 'sina-ext' ),
					'description' => esc_html__( 'You can use SPAN for multi-color title.', 'sina-ext' ),
					'dynamic' => [
						'active' => true,
					],
				]
			);
			$this->add_control(
				'title_tag',
				[
					'label' => esc_html__( 'Select Tag', 'sina-ext' ),
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
					'label' => esc_html__( 'Sub Title', 'sina-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'Enter Title', 'sina-ext' ),
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
					'label' => esc_html__( 'Select Tag', 'sina-ext' ),
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
					'label' => esc_html__( 'Description', 'sina-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::TEXTAREA,
					'placeholder' => esc_html__( 'Enter Description', 'sina-ext' ),
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
					'label' => esc_html__( 'Primary Button', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);
			Sina_Common_Data::button_content( $this, '.sina-banner-pbtn', 'Learn More', 'pbtn', true, true );
			$this->add_control(
				'pbtn_id',
				[
					'label' => esc_html__( 'CSS ID', 'sina-ext' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'Enter ID', 'sina-ext' ),
					'description' => esc_html__( 'Make sure this ID unique', 'sina-ext' ),
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
					'label' => esc_html__( 'Secondary Button', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);
			Sina_Common_Data::button_content( $this, '.sina-banner-sbtn', 'Read More', 'sbtn', true, true );
			$this->add_responsive_control(
				'button_space',
				[
					'label' => esc_html__( 'Button Spacing', 'sina-ext' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 20,
					],
					'mobile_default' => [
						'size' => 15,
					],
					'selectors' => [
						'{{WRAPPER}} .sina-banner-sbtn' => 'margin-left: {{SIZE}}{{UNIT}};',
						'.rtl {{WRAPPER}} .sina-banner-sbtn' => 'margin-right: {{SIZE}}{{UNIT}}; margin-left: auto;',
					],
				]
			);
			$this->add_control(
				'sbtn_id',
				[
					'label' => esc_html__( 'CSS ID', 'sina-ext' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'Enter ID', 'sina-ext' ),
					'description' => esc_html__( 'Make sure this ID unique', 'sina-ext' ),
				]
			);

			$this->end_controls_section();
		// End Secondary Button
		// =====================


		// Start Particle Settings
		// ========================
			$this->start_controls_section(
				'particle_settings',
				[
					'label' => esc_html__( 'Particle Settings', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

			$this->add_control(
				'link_color',
				[
					'label' => esc_html__( 'Link Color', 'sina-ext' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#fafafa',
				]
			);
			$this->add_control(
				'ball_color',
				[
					'label' => esc_html__( 'Ball Color', 'sina-ext' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#fafafa',
				]
			);
			$this->add_control(
				'particle_number',
				[
					'label' => esc_html__( 'Particles Number', 'sina-ext' ),
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
					'label' => esc_html__( 'Link Width', 'sina-ext' ),
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
					'label' => esc_html__( 'Link Distance', 'sina-ext' ),
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
					'label' => esc_html__( 'Create Link', 'sina-ext' ),
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
					'label' => esc_html__( 'Ball Max Size', 'sina-ext' ),
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
					'label' => esc_html__( 'Animation Speed', 'sina-ext' ),
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
					'label' => esc_html__( 'Disable Links', 'sina-ext' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Yes', 'sina-ext' ),
					'label_off' => esc_html__( 'No', 'sina-ext' ),
				]
			);
			$this->add_control(
				'mouse_state',
				[
					'label' => esc_html__( 'Disable Mouse', 'sina-ext' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Yes', 'sina-ext' ),
					'label_off' => esc_html__( 'No', 'sina-ext' ),
				]
			);

			$this->end_controls_section();
		// End Particle Settings
		// ======================


		// Start Animation
		// =====================
			$this->start_controls_section(
				'animation_settings',
				[
					'label' => esc_html__( 'Animation Settings', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

			$this->add_control(
				'title_anim',
				[
					'label' => esc_html__( 'Title Animation', 'sina-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::SELECT,
					'default' => 'fadeInLeft',
					'options' => Sina_Common_Data::animation(),
				]
			);
			$this->add_control(
				'subtitle_anim',
				[
					'label' => esc_html__( 'Sub Title Animation', 'sina-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::SELECT,
					'default' => 'fadeInRight',
					'options' => Sina_Common_Data::animation(),
				]
			);
			$this->add_control(
				'desc_anim',
				[
					'label' => esc_html__( 'Description Animation', 'sina-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::SELECT,
					'default' => 'fadeInUp',
					'options' => Sina_Common_Data::animation(),
				]
			);
			$this->add_control(
				'buttons_anim',
				[
					'label' => esc_html__( 'Buttons Animation', 'sina-ext' ),
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
					'label' => esc_html__( 'Container', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'container_width',
				[
					'label' => esc_html__( 'Width', 'sina-ext' ),
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
					'label' => esc_html__( 'Padding', 'sina-ext' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'default' => [
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
						'{{WRAPPER}} .sina-banner-container' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'template_style',
				[
					'label' => esc_html__( 'Template Style', 'sina-ext' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_responsive_control(
				'template_padding',
				[
					'label' => esc_html__( 'Padding', 'sina-ext' ),
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
					'label' => esc_html__( 'Margin Bottom', 'sina-ext' ),
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
					'label' => esc_html__( 'Title Span', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' => [
						'title_span!' => '',
					],
				]
			);

			$this->add_control(
				'title_span_color',
				[
					'label' => esc_html__( 'Text Color', 'sina-ext' ),
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
					'label' => esc_html__( 'Sub Title', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' => [
						'subtitle!' => '',
					],
				]
			);

			$this->add_control(
				'subtitle_color',
				[
					'label' => esc_html__( 'Text Color', 'sina-ext' ),
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
					'label' => esc_html__( 'Margin Bottom', 'sina-ext' ),
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
					'label' => esc_html__( 'Description', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' => [
						'desc!' => '',
					],
				]
			);

			$this->add_control(
				'desc_color',
				[
					'label' => esc_html__( 'Text Color', 'sina-ext' ),
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
					'label' => esc_html__( 'Margin Bottom', 'sina-ext' ),
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
					'label' => esc_html__( 'Primary Button', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::button_style( $this, '.sina-banner-pbtn', 'pbtn' );
			$this->add_responsive_control(
				'pbtn_width',
				[
					'label' => esc_html__( 'Width', 'sina-ext' ),
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
						'{{WRAPPER}} .sina-banner-pbtn, {{WRAPPER}} .sina-banner-pbtn:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'pbtn_padding',
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
			$this->add_responsive_control(
				'pbtn_margin',
				[
					'label' => esc_html__( 'Margin', 'sina-ext' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .sina-banner-pbtn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'label' => esc_html__( 'Secondary Button', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::button_style( $this, '.sina-banner-sbtn', 'sbtn' );
			$this->add_responsive_control(
				'sbtn_width',
				[
					'label' => esc_html__( 'Width', 'sina-ext' ),
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
						'{{WRAPPER}} .sina-banner-sbtn, {{WRAPPER}} .sina-banner-sbtn:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'sbtn_padding',
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
			$this->add_responsive_control(
				'sbtn_margin',
				[
					'label' => esc_html__( 'Margin', 'sina-ext' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .sina-banner-sbtn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'label' => esc_html__( 'Tooltips', 'sina-ext' ),
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
					<?php printf('<%3$s class="sina-banner-title animated %1$s">%2$s%4$s</%3$s>', $data['title_anim'], $data['title'], sina_ext_html_tags( $data['title_tag'] ), $title_span); ?>
				<?php endif; ?>

				<?php if ( $data['subtitle'] ): ?>
					<?php printf('<%3$s class="sina-banner-subtitle animated %1$s">%2$s</%3$s>', $data['subtitle_anim'], $data['subtitle'], sina_ext_html_tags( $data['subtitle_tag'] )); ?>
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


	protected function content_template() {
		
	}
}