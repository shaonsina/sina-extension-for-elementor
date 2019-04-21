<?php

/**
 * Particle Layer Widget.
 *
 * @since 1.0.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Frontend;


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
		return 'fa fa-clone';
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
		// =====================
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
				'type' => Controls_Manager::WYSIWYG,
				'placeholder' => __( 'Enter Title', 'sina-ext' ),
				'default' => __( 'Welcome to get start your business', 'sina-ext' ),
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label' => __( 'Sub Title', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::WYSIWYG,
				'placeholder' => __( 'Enter Title', 'sina-ext' ),
				'separator' => 'before',
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit', 'sina-ext' ),
			]
		);
		$this->add_control(
			'desc',
			[
				'label' => __( 'Description', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::WYSIWYG,
				'placeholder' => __( 'Enter Description', 'sina-ext' ),
				'separator' => 'before',
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit', 'sina-ext' ),
			]
		);

		$this->end_controls_section();
		// End Content
		// =====================


		// Start Primary Button
		// =====================
		$this->start_controls_section(
			'primary_btn_content',
			[
				'label' => __( 'Primary Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'pbtn_text',
			[
				'label' => __( 'Label', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Label', 'sina-ext' ),
				'default' => __( 'Learn More', 'sina-ext' ),
			]
		);
		$this->add_control(
			'pbtn_link',
			[
				'label' => __( 'Link', 'sina-ext' ),
				'type' => Controls_Manager::URL,
				'default' => [
					'url' => '#',
				],
				'placeholder' => __( 'https://your-link.com', 'sina-ext' ),
			]
		);
		$this->add_control(
			'pbtn_icon',
			[
				'label' => __( 'Icon', 'sina-ext' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-user',
			]
		);
		$this->add_control(
			'pbtn_icon_align',
			[
				'label' => __( 'Icon Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'left' => __( 'Before', 'sina-ext' ),
					'right' => __( 'After', 'sina-ext' ),
				],
				'default' => 'left',
			]
		);
		$this->add_responsive_control(
			'pbtn_icon_space',
			[
				'label' => __( 'Icon Spacing', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '5',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-banner-pbtn .sina-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sina-banner-pbtn .sina-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
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

		$this->add_control(
			'sbtn_text',
			[
				'label' => __( 'Label', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Label', 'sina-ext' ),
				'default' => __( 'Learn More', 'sina-ext' ),
			]
		);
		$this->add_control(
			'sbtn_link',
			[
				'label' => __( 'Link', 'sina-ext' ),
				'type' => Controls_Manager::URL,
				'default' => [
					'url' => '#',
				],
				'placeholder' => __( 'https://your-link.com', 'sina-ext' ),
			]
		);
		$this->add_control(
			'sbtn_icon',
			[
				'label' => __( 'Icon', 'sina-ext' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-user',
			]
		);
		$this->add_control(
			'sbtn_icon_align',
			[
				'label' => __( 'Icon Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'left' => __( 'Before', 'sina-ext' ),
					'right' => __( 'After', 'sina-ext' ),
				],
				'default' => 'left',
			]
		);
		$this->add_responsive_control(
			'sbtn_icon_space',
			[
				'label' => __( 'Icon Spacing', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '5',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-banner-sbtn .sina-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sina-banner-sbtn .sina-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
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
				'default' => '#eee',
			]
		);
		$this->add_control(
			'ball_color',
			[
				'label' => __( 'Ball Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
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
				'options' => [
					'none' => __( 'none', 'sina-ext' ),
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
		$this->add_control(
			'subtitle_anim',
			[
				'label' => __( 'Sub Title Animation', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'fadeInRight',
				'options' => [
					'none' => __( 'none', 'sina-ext' ),
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
		$this->add_control(
			'desc_anim',
			[
				'label' => __( 'Description Animation', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'fadeInUp',
				'options' => [
					'none' => __( 'none', 'sina-ext' ),
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
		$this->add_control(
			'buttons_anim',
			[
				'label' => __( 'Buttons Animation', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'fadeInUp',
				'options' => [
					'none' => __( 'none', 'sina-ext' ),
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
					'justify' => [
						'title' => __( 'justify', 'sina-ext' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'center',
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'selectors' => [
					'{{WRAPPER}} .sina-banner-container' => 'text-align: {{VALUE}};',
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
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-title, {{WRAPPER}} .sina-banner-title > *' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .sina-banner-title, {{WRAPPER}} .sina-banner-title > *',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-banner-title > *',
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
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-subtitle, {{WRAPPER}} .sina-banner-subtitle > *' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .sina-banner-subtitle, {{WRAPPER}} .sina-banner-subtitle > *',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'subtitle_shadow',
				'selector' => '{{WRAPPER}} .sina-banner-subtitle > *',
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
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-desc, {{WRAPPER}} .sina-banner-desc > *' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .sina-banner-desc, {{WRAPPER}} .sina-banner-desc > *',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'desc_shadow',
				'selector' => '{{WRAPPER}} .sina-banner-desc > *',
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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pbtn_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '600',
					],
					'transform'   => [
						'default' => [
							'size' => 'uppercase',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-banner-pbtn',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'pbtn_tshadow',
				'selector' => '{{WRAPPER}} .sina-banner-pbtn',
			]
		);

		$this->start_controls_tabs( 'pbtn_tabs' );

		$this->start_controls_tab(
			'pbtn_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);
		$this->add_control(
			'pbtn_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-pbtn' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'pbtn_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-pbtn' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pbtn_shadow',
				'selector' => '{{WRAPPER}} .sina-banner-pbtn',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'pbtn_border',
				'selector' => '{{WRAPPER}} .sina-banner-pbtn',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'pbtn_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);
		$this->add_control(
			'pbtn_hover_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-pbtn:hover, {{WRAPPER}} .sina-banner-pbtn:focus' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'pbtn_hover_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-pbtn:hover, {{WRAPPER}} .sina-banner-pbtn:focus' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pbtn_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-banner-pbtn:hover, {{WRAPPER}} .sina-banner-pbtn:focus',
			]
		);
		$this->add_control(
			'pbtn_hover_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-banner-pbtn:hover, {{WRAPPER}} .sina-banner-pbtn:focus' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

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
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-pbtn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'top' => '15',
					'right' => '30',
					'bottom' => '15',
					'left' => '30',
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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sbtn_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '600',
					],
					'transform'   => [
						'default' => [
							'size' => 'uppercase',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-banner-sbtn',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'sbtn_tshadow',
				'selector' => '{{WRAPPER}} .sina-banner-sbtn',
			]
		);

		$this->start_controls_tabs( 'sbtn_tabs' );

		$this->start_controls_tab(
			'sbtn_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);
		$this->add_control(
			'sbtn_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-sbtn' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'sbtn_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-sbtn' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'sbtn_shadow',
				'selector' => '{{WRAPPER}} .sina-banner-sbtn',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'sbtn_border',
				'selector' => '{{WRAPPER}} .sina-banner-sbtn',
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab(
			'sbtn_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);
		$this->add_control(
			'sbtn_hover_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-sbtn:hover, {{WRAPPER}} .sina-banner-sbtn:focus' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'sbtn_hover_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-sbtn:hover, {{WRAPPER}} .sina-banner-sbtn:focus' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'sbtn_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-banner-sbtn:hover, {{WRAPPER}} .sina-banner-sbtn:focus',
			]
		);
		$this->add_control(
			'sbtn_hover_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-banner-sbtn:hover, {{WRAPPER}} .sina-banner-sbtn:focus' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'sbtn_hover_radius',
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
					'{{WRAPPER}} .sina-banner-sbtn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'top' => '15',
					'right' => '30',
					'bottom' => '15',
					'left' => '30',
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

		$this->end_controls_section();
		// End Secondary Button Style
		// ==========================
	}


	protected function render() {
		$data = $this->get_settings_for_display();

		$this->add_render_attribute( 'title', 'class', 'sina-banner-title animated '. $data['title_anim'] );
		$this->add_inline_editing_attributes( 'title' );

		$this->add_render_attribute( 'subtitle', 'class', 'sina-banner-subtitle animated '. $data['subtitle_anim'] );
		$this->add_inline_editing_attributes( 'subtitle' );

		$this->add_render_attribute( 'desc', 'class', 'sina-banner-desc animated '. $data['desc_anim'] );
		$this->add_inline_editing_attributes( 'desc' );

		$this->add_render_attribute( 'pbtn_text', 'class', 'sina-banner-pbtn-text' );
		$this->add_inline_editing_attributes( 'pbtn_text' );

		$this->add_render_attribute( 'sbtn_text', 'class', 'sina-banner-sbtn-text' );
		$this->add_inline_editing_attributes( 'sbtn_text' );
		?>
		<div class="sina-particle-layer">
			<div class="sina-banner-container">
				<?php
					if ( 'yes' == $data['save_templates'] && $data['template'] ) {
						$frontend = new Frontend;
						echo $frontend->get_builder_content( $data['template'], true );
					}
				?>
				<?php if ( $data['title'] ): ?>
					<div <?php echo $this->get_render_attribute_string( 'title' ); ?>>
						<?php echo wp_kses_post( $data['title'] ); ?>
					</div>
				<?php endif; ?>

				<?php if ( $data['subtitle'] ): ?>
					<div <?php echo $this->get_render_attribute_string( 'subtitle' ); ?>>
						<?php echo wp_kses_post( $data['subtitle'] ); ?>
					</div>
				<?php endif; ?>

				<?php if ( $data['desc'] ): ?>
					<div <?php echo $this->get_render_attribute_string( 'desc' ); ?>>
						<?php echo wp_kses_post( $data['desc'] ); ?>
					</div>
				<?php endif; ?>

				<?php if ( $data['pbtn_text'] || $data['sbtn_text'] ): ?>
					<div class="sina-banner-btns animated <?php echo esc_attr( $data['buttons_anim'] ); ?>">
						<?php if ( $data['pbtn_text'] ): ?>
							<a class="sina-banner-pbtn"
							href="<?php echo esc_url( $data['pbtn_link']['url'] ); ?>"
							<?php if ( 'on' == $data['pbtn_link']['is_external'] ): ?>
								target="_blank" 
							<?php endif; ?>
							<?php if ( 'on' == $data['pbtn_link']['nofollow'] ): ?>
								rel="nofollow" 
							<?php endif; ?>
							role="button">
								<?php if ( $data['pbtn_icon'] && $data['pbtn_icon_align'] == 'left' ): ?>
									<i class="<?php echo esc_attr($data['pbtn_icon']); ?> sina-icon-left"></i>
								<?php endif; ?>
								<span <?php echo $this->get_render_attribute_string( 'pbtn_text' ); ?>>
									<?php echo esc_html( $data['pbtn_text'] ); ?>
								</span>
								<?php if ( $data['pbtn_icon'] && $data['pbtn_icon_align'] == 'right' ): ?>
									<i class="<?php echo esc_attr($data['pbtn_icon']); ?> sina-icon-right"></i>
								<?php endif; ?>
							</a>
						<?php endif ?>

						<?php if ( $data['sbtn_text'] ): ?>
							<a class="sina-banner-sbtn"
							href="<?php echo esc_url( $data['sbtn_link']['url'] ); ?>"
							<?php if ( 'on' == $data['sbtn_link']['is_external'] ): ?>
								target="_blank" 
							<?php endif; ?>
							<?php if ( 'on' == $data['sbtn_link']['nofollow'] ): ?>
								rel="nofollow" 
							<?php endif; ?>
							role="button">
								<?php if ( $data['sbtn_icon'] && $data['sbtn_icon_align'] == 'left' ): ?>
									<i class="<?php echo esc_attr($data['sbtn_icon']); ?> sina-icon-left"></i>
								<?php endif; ?>
								<span <?php echo $this->get_render_attribute_string( 'sbtn_text' ); ?>>
									<?php echo esc_html( $data['sbtn_text'] ); ?>
								</span>
								<?php if ( $data['sbtn_icon'] && $data['sbtn_icon_align'] == 'right' ): ?>
									<i class="<?php echo esc_attr($data['sbtn_icon']); ?> sina-icon-right"></i>
								<?php endif; ?>
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