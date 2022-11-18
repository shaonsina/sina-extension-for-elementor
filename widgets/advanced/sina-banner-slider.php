<?php

/**
 * Banner Slider Widget.
 *
 * @since 1.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Repeater;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Banner_Slider_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_banner_slider';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Banner Slider', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-slider-push';
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
		return [ 'sina slider', 'sina banner', 'sina carousel' ];
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
			'owl-carousel',
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
			'jquery-owl',
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
		// Start Slider Content
		// =====================
			$this->start_controls_section(
				'slider_content',
				[
					'label' => esc_html__( 'Slides', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

			$repeater = new Repeater();

			$repeater->add_control(
				'image',
				[
					'label' => esc_html__( 'Choose Image', 'sina-ext' ),
					'type' => Controls_Manager::MEDIA,
					'default' => [
						'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
					],
					'dynamic' => [
						'active' => true,
					],
				]
			);
			$repeater->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'sina-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::TEXT,
					'description' => esc_html__( 'You can use HTML.', 'sina-ext' ),
					'default' => 'Welcome',
					'dynamic' => [
						'active' => true,
					],
				]
			);
			$repeater->add_control(
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
			$repeater->add_control(
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
			$repeater->add_control(
				'title_anim',
				[
					'label' => esc_html__( 'Title Animation', 'sina-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'fadeInLeft',
					'options' => Sina_Common_Data::animation(),
				]
			);
			$repeater->add_control(
				'subtitle',
				[
					'label' => esc_html__( 'Sub Title', 'sina-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::TEXT,
					'description' => esc_html__( 'You can use HTML.', 'sina-ext' ),
					'default' => 'Lorem ipsum dolor sit amet',
					'separator' => 'before',
					'dynamic' => [
						'active' => true,
					],
				]
			);
			$repeater->add_control(
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
			$repeater->add_control(
				'subtitle_anim',
				[
					'label' => esc_html__( 'Sub Title Animation', 'sina-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'fadeInRight',
					'options' => Sina_Common_Data::animation(),
				]
			);
			$repeater->add_control(
				'desc',
				[
					'label' => esc_html__( 'Description', 'sina-ext' ),
					'type' => Controls_Manager::TEXTAREA,
					'description' => esc_html__( 'You can use HTML.', 'sina-ext' ),
					'default' => 'Lorem ipsum dolor sit amet',
					'separator' => 'before',
					'dynamic' => [
						'active' => true,
					],
				]
			);
			$repeater->add_control(
				'desc_anim',
				[
					'label' => esc_html__( 'Description Animation', 'sina-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'fadeInUp',
					'options' => Sina_Common_Data::animation(),
				]
			);
			$repeater->add_control(
				'primary_btn_text',
				[
					'label' => esc_html__( 'Primary Button Text', 'sina-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::TEXT,
					'options' => Sina_Common_Data::animation(),
					'separator' => 'before',
				]
			);
			$repeater->add_control(
				'primary_btn_link',
				[
					'label' => esc_html__( 'Link', 'sina-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::TEXT,
					'placeholder' => 'https://your-link.com',
				]
			);
			$repeater->add_control(
				'secondary_btn_text',
				[
					'label' => esc_html__( 'Secondary Button Text', 'sina-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::TEXT,
					'options' => Sina_Common_Data::animation(),
					'separator' => 'before',
				]
			);
			$repeater->add_control(
				'secondary_btn_link',
				[
					'label' => esc_html__( 'Link', 'sina-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::TEXT,
					'placeholder' => 'https://your-link.com',
				]
			);
			$repeater->add_control(
				'buttons_anim',
				[
					'label' => esc_html__( 'Buttons Animation', 'sina-ext' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'fadeInUp',
					'options' => Sina_Common_Data::animation(),
				]
			);
			$repeater->add_responsive_control(
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
						'{{WRAPPER}} {{CURRENT_ITEM}}' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'slides',
				[
					'label' => esc_html__( 'Add Slide', 'sina-ext' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'title' => 'Welcome to get start your business',
							'subtitle' => 'Lorem ipsum dolor sit amet',
							'title_anim' => 'fadeInLeft',
							'subtitle_anim' => 'fadeInRight',
							'buttons_anim' => 'fadeInUp',
						],
						[
							'title' => 'Lorem ipsum dolor sit amet,',
							'subtitle' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit',
							'title_anim' => 'zoomIn',
							'subtitle_anim' => 'zoomIn',
							'desc_anim' => 'fadeInUp',
							'buttons_anim' => 'lightSpeedIn',
						],
					],
					'title_field' => '{{{ title || subtitle }}}',
				]
			);

			$this->end_controls_section();
		// End Slider Content
		// =====================


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
			$this->end_controls_section();
		// End Secondary Button
		// =====================


		// Start Slider Settings
		// ======================
			$this->start_controls_section(
				'slider_settings',
				[
					'label' => esc_html__( 'Slider Settings', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);
			$this->add_control(
				'overlay',
				[
					'label' => esc_html__( 'Overlay', 'sina-ext' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'On', 'sina-ext' ),
					'label_off' => esc_html__( 'Off', 'sina-ext' ),
					'default' => 'yes',
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
					'condition' => [
						'overlay!' => '',
					],
					'selector' => '{{WRAPPER}} .sina-slider-content .sina-overlay',
				]
			);
			Sina_Common_Data::carousel_content( $this, true, false );
			$this->add_control(
				'part_anim',
				[
					'label' => esc_html__( 'Particular Animation', 'sina-ext' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'On', 'sina-ext' ),
					'label_off' => esc_html__( 'Off', 'sina-ext' ),
					'default' => 'yes',
				]
			);
			$this->add_control(
				'slide_speed',
				[
					'label' => esc_html__( 'Speed', 'sina-ext' ),
					'type' => Controls_Manager::NUMBER,
					'default' => 1000,
					'step' => 100,
					'min' => 100,
					'max' => 5000,
					'condition' => [
						'part_anim' => '',
					],
				]
			);
			$this->end_controls_section();
		// End Slider Settings
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
				'container_height',
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
						'size' => 600,
					],
					'tablet_default' => [
						'size' => 500,
					],
					'selectors' => [
						'{{WRAPPER}} .sina-slider-content' => 'height: {{SIZE}}{{UNIT}};',
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
						'top' => '200',
						'right' => '120',
						'bottom' => '220',
						'left' => '120',
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
						'{{WRAPPER}} .sina-slider-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'condition' => [
						'pbtn_text!' => '',
					],
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
					'condition' => [
						'sbtn_text!' => '',
					],
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


		// Start Nav & Dots Style
		// ===========================
			$this->start_controls_section(
				'nav_dots_style',
				[
					'label' => esc_html__( 'Nav & Dots', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'name' => 'nav',
								'operator' => '!=',
								'value' => ''
							],
							[
								'name' => 'dots',
								'operator' => '!=',
								'value' => ''
							]
						]
					],
				]
			);
			Sina_Common_Data::nav_dots_style($this, '.sina-banner-slider');
			$this->end_controls_section();
		// End Nav & Dots Style
		// ==========================
	}


	protected function render() {
		$data = $this->get_settings_for_display();

		$this->add_render_attribute( 'pbtn_text', 'class', 'sina-banner-pbtn-text' );
		$this->add_inline_editing_attributes( 'pbtn_text' );

		$this->add_render_attribute( 'sbtn_text', 'class', 'sina-banner-sbtn-text' );
		$this->add_inline_editing_attributes( 'sbtn_text' );

		$pbtn_tooltip = $data['pbtn_tooltip_text'] ? 'sina-tooltip' : '';
		$sbtn_tooltip = $data['sbtn_tooltip_text'] ? 'sina-tooltip' : '';
		?>
		<div class="sina-banner-slider owl-carousel"
		data-autoplay="<?php echo esc_attr( $data['autoplay'] ); ?>"
		data-pause="<?php echo esc_attr( $data['pause'] ); ?>"
		data-nav="<?php echo esc_attr( $data['nav'] ); ?>"
		data-dots="<?php echo esc_attr( $data['dots'] ); ?>"
		data-mouse-drag="<?php echo esc_attr( $data['mouse_drag'] ); ?>"
		data-touch-drag="<?php echo esc_attr( $data['touch_drag'] ); ?>"
		data-loop="<?php echo esc_attr( $data['loop'] ); ?>"
		data-speed="<?php echo esc_attr( $data['slide_speed'] ); ?>"
		data-part-anim="<?php echo esc_attr( $data['part_anim'] ); ?>"
		data-delay="<?php echo esc_attr( $data['delay'] ); ?>">

			<?php foreach ($data['slides'] as $index => $slide) :
					$invisible = '';
					if ( $data['part_anim'] ) {
						$invisible = 'sina-anim-invisible';
					}

					$data['pbtn_text'] = $slide['primary_btn_text'] ? $slide['primary_btn_text'] : $data['pbtn_text'];
					$data['pbtn_link']['url'] = $slide['primary_btn_link'] ? $slide['primary_btn_link'] : $data['pbtn_link']['url'];
					$data['sbtn_text'] = $slide['secondary_btn_text'] ? $slide['secondary_btn_text'] : $data['sbtn_text'];
					$data['sbtn_link']['url'] = $slide['secondary_btn_link'] ? $slide['secondary_btn_link'] : $data['sbtn_link']['url'];

					$title_key = $this->get_repeater_setting_key( 'title', 'slides', $index );
					$subtitle_key = $this->get_repeater_setting_key( 'subtitle', 'slides', $index );
					$desc_key = $this->get_repeater_setting_key( 'desc', 'slides', $index );

					$this->add_render_attribute( $title_key, 'class', 'sina-banner-title '. $invisible );
					$this->add_inline_editing_attributes( $title_key );

					$this->add_render_attribute( $subtitle_key, 'class', 'sina-banner-subtitle '. $invisible );
					$this->add_inline_editing_attributes( $subtitle_key );

					$this->add_render_attribute( $desc_key, 'class', 'sina-banner-desc '. $invisible );
					$this->add_inline_editing_attributes( $desc_key );
				?>
				<div class="sina-slider-content sina-bg-cover" style="background-image: url(<?php echo esc_url( $slide['image']['url'] ); ?>);">
					<?php if ( 'yes' == $data['overlay'] ): ?>
						<div class="sina-overlay"></div>
					<?php endif ?>

					<div class="sina-banner-container elementor-repeater-item-<?php echo esc_attr( $slide[ '_id' ] ); ?>">

						<?php if ( $slide['title'] ): ?>
							<?php $title_span = $slide['title_span'] ? '<span>'.$slide['title_span'].'</span>' : ''; ?>
							<?php printf('<%4$s %1$s data-animation="animated %2$s">%3$s%5$s</%4$s>', $this->get_render_attribute_string( $title_key ), $slide['title_anim'], $slide['title'], sina_ext_html_tags( $slide['title_tag'] ), $title_span); ?>
						<?php endif; ?>

						<?php if ( $slide['subtitle'] ): ?>
							<?php printf('<%4$s %1$s data-animation="animated %2$s">%3$s</%4$s>', $this->get_render_attribute_string( $subtitle_key ), $slide['subtitle_anim'], $slide['subtitle'], sina_ext_html_tags( $slide['subtitle_tag'] )); ?>
						<?php endif; ?>

						<?php if ( $slide['desc'] ): ?>
							<?php printf('<div %1$s data-animation="animated %2$s">%3$s</div>', $this->get_render_attribute_string( $desc_key ), $slide['desc_anim'], $slide['desc']); ?>
						<?php endif; ?>

						<?php if ( $data['pbtn_text'] || $data['sbtn_text'] ): ?>
							<div class="sina-banner-btns <?php echo esc_attr($invisible); ?>" data-animation="animated <?php echo esc_attr( $slide['buttons_anim'] ); ?>">
								<?php if ( $data['pbtn_text'] ): ?>
									<a class="sina-banner-pbtn <?php echo esc_attr( $pbtn_tooltip.' '.$data['pbtn_effect'].' '.$data['pbtn_bg_layer_effects'] ); ?>"
									<?php if ( $data['pbtn_tooltip_text'] ): ?>
										data-toggle="tooltip" 
										title="<?php echo esc_attr( $data['pbtn_tooltip_text'] ); ?>" 
									<?php endif; ?>
									href="<?php echo esc_url( $data['pbtn_link']['url'] ); ?>"
									<?php if ( 'on' == $data['pbtn_link']['is_external'] ): ?>
										target="_blank" 
									<?php endif; ?>
									<?php if ( 'on' == $data['pbtn_link']['nofollow'] ): ?>
										rel="nofollow" 
									<?php endif; ?>>
										<?php Sina_Common_Data::button_html($data, 'pbtn'); ?>
									</a>
								<?php endif ?>

								<?php if ( $data['sbtn_text'] ): ?>
									<a class="sina-banner-sbtn <?php echo esc_attr( $sbtn_tooltip.' '.$data['sbtn_effect'].' '.$data['sbtn_bg_layer_effects'] ); ?>"
									<?php if ( $data['sbtn_tooltip_text'] ): ?>
										data-toggle="tooltip" 
										title="<?php echo esc_attr( $data['sbtn_tooltip_text'] ); ?>" 
									<?php endif; ?>
									href="<?php echo esc_url( $data['sbtn_link']['url'] ); ?>"
									<?php if ( 'on' == $data['sbtn_link']['is_external'] ): ?>
										target="_blank" 
									<?php endif; ?>
									<?php if ( 'on' == $data['sbtn_link']['nofollow'] ): ?>
										rel="nofollow" 
									<?php endif; ?>>
										<?php Sina_Common_Data::button_html($data, 'sbtn'); ?>
									</a>
								<?php endif ?>
							</div>
						<?php endif ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div><!-- .sina-banner-slider -->
		<?php
	}


	protected function content_template() {
		
	}
}