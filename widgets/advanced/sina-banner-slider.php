<?php

/**
 * Slider Banner Widget.
 *
 * @since 1.0.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Banner_Slider_Widget extends Widget_Base {

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
		return __( 'Sina Banner Slider', 'sina-ext' );
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
	        'owl-carousel',
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
		// Start Slider Content
		// =====================
		$this->start_controls_section(
			'slider_content',
			[
				'label' => __( 'Slides', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'slides',
			[
				'label' => __( 'Add Slide', 'sina-ext' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'image',
						'label' => __( 'Choose Image', 'sina-ext' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
						],
					],
					[
						'name' => 'title',
						'label' => __( 'Title', 'sina-ext' ),
						'type' => Controls_Manager::WYSIWYG,
						'default' => 'Welcome',
					],
					[
						'name' => 'title_anim',
						'label' => __( 'Title Animation', 'sina-ext' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'fadeInLeft',
						'options' => [
							'none' => __( 'None', 'sina-ext' ),
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
					],
					[
						'name' => 'subtitle',
						'label' => __( 'Sub Title', 'sina-ext' ),
						'type' => Controls_Manager::WYSIWYG,
						'default' => 'Lorem ipsum dolor sit amet',
					],
					[
						'name' => 'subtitle_anim',
						'label' => __( 'Sub Title Animation', 'sina-ext' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'fadeInRight',
						'options' => [
							'none' => __( 'None', 'sina-ext' ),
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
					],
					[
						'name' => 'desc',
						'label' => __( 'Description', 'sina-ext' ),
						'type' => Controls_Manager::WYSIWYG,
						'default' => 'Lorem ipsum dolor sit amet',
					],
					[
						'name' => 'desc_anim',
						'label' => __( 'Description Animation', 'sina-ext' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'fadeInUp',
						'options' => [
							'none' => __( 'None', 'sina-ext' ),
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
					],
					[
						'name' => 'align',
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
					],
					[
						'name' => 'buttons_anim',
						'label' => __( 'Buttons Animation', 'sina-ext' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'fadeInUp',
						'options' => [
							'none' => __( 'None', 'sina-ext' ),
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
					],
				],
				'default' => [
					[
						'title' => 'Welcome to get start your business',
						'subtitle' => 'Lorem ipsum dolor sit amet',
						'align' => 'center',
						'title_anim' => 'fadeInLeft',
						'subtitle_anim' => 'fadeInRight',
						'buttons_anim' => 'fadeInUp',
					],
					[
						'title' => 'Lorem ipsum dolor sit amet,',
						'subtitle' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit',
						'align' => 'center',
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


		// Start Slider Settings
		// ======================
		$this->start_controls_section(
			'slider_settings',
			[
				'label' => __( 'Slider Settings', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'overlay',
			[
				'label' => __( 'Overlay', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'sina-ext' ),
				'label_off' => __( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_bg',
				'label' => __( 'Background', 'sina-ext' ),
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
		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'sina-ext' ),
				'label_off' => __( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'pause',
			[
				'label' => __( 'Pause on Hover', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'sina-ext' ),
				'label_off' => __( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'mouse_drag',
			[
				'label' => __( 'Mouse Drag', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'sina-ext' ),
				'label_off' => __( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'touch_drag',
			[
				'label' => __( 'Touch Drag', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'sina-ext' ),
				'label_off' => __( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'loop',
			[
				'label' => __( 'Infinity Loop', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'sina-ext' ),
				'label_off' => __( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'dots',
			[
				'label' => __( 'Dots', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'sina-ext' ),
				'label_off' => __( 'Hide', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'dots_color',
			[
				'label' => __( 'Dots Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'dots!' => '',
				],
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-slider .owl-dot' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .sina-banner-slider .owl-dot.active' => 'background-color: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'nav',
			[
				'label' => __( 'Navigation', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'sina-ext' ),
				'label_off' => __( 'Hide', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nav_bg',
			[
				'label' => __( 'Navigation Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'nav!' => '',
				],
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-slider .owl-prev, {{WRAPPER}} .sina-banner-slider .owl-next' => 'background-color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'nav_color',
			[
				'label' => __( 'Navigation Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'nav!' => '',
				],
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-slider .owl-prev, {{WRAPPER}} .sina-banner-slider .owl-next' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'nav_top',
			[
				'label' => __( 'Navigation Top (%)', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
					'size' => '50',
				],
				'condition' => [
					'nav!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-banner-slider .owl-prev, {{WRAPPER}} .sina-banner-slider .owl-next' => 'top: calc({{SIZE}}{{UNIT}} - 18px);',
				],
			]
		);
		$this->add_control(
			'delay',
			[
				'label' => __( 'Delay', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000,
				'step' => 100,
				'min' => 1000,
				'max' => 15000,
			]
		);
		$this->add_control(
			'part_anim',
			[
				'label' => __( 'Particular Animation', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'sina-ext' ),
				'label_off' => __( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'speed',
			[
				'label' => __( 'Speed', 'sina-ext' ),
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
				'default' => 'Learn More',
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
				'condition' => [
					'pbtn_icon!' => '',
				],
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
				'condition' => [
					'pbtn_icon!' => '',
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
				'default' => 'Learn More',
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
				'condition' => [
					'sbtn_icon!' => '',
				],
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
				'condition' => [
					'sbtn_icon!' => '',
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
			'container_height',
			[
				'label' => __( 'Height', 'sina-ext' ),
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
				'desktop_default' => [
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
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'desktop_default' => [
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
				'label' => __( 'Title', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
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
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
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
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
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
				'condition' => [
					'pbtn_text!' => '',
				],
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
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-pbtn' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'pbtn_bg',
				'label' => __( 'Background', 'sina-ext' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#1085e4',
					],
				],
				'selector' => '{{WRAPPER}} .sina-banner-pbtn',
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
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-pbtn:hover, {{WRAPPER}} .sina-banner-pbtn:focus' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'pbtn_hover_bg',
				'label' => __( 'Background', 'sina-ext' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fff',
					],
				],
				'selector' => '{{WRAPPER}} .sina-banner-pbtn:hover, {{WRAPPER}} .sina-banner-pbtn:focus',
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
				'condition' => [
					'sbtn_text!' => '',
				],
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
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-sbtn' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'sbtn_bg',
				'label' => __( 'Background', 'sina-ext' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#1085e4',
					],
				],
				'selector' => '{{WRAPPER}} .sina-banner-sbtn',
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
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-banner-sbtn:hover, {{WRAPPER}} .sina-banner-sbtn:focus' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'sbtn_hover_bg',
				'label' => __( 'Background', 'sina-ext' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fff',
					],
				],
				'selector' => '{{WRAPPER}} .sina-banner-sbtn:hover, {{WRAPPER}} .sina-banner-sbtn:focus',
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

		$this->add_render_attribute( 'pbtn_text', 'class', 'sina-banner-pbtn-text' );
		$this->add_inline_editing_attributes( 'pbtn_text' );

		$this->add_render_attribute( 'sbtn_text', 'class', 'sina-banner-sbtn-text' );
		$this->add_inline_editing_attributes( 'sbtn_text' );
		?>
		<div class="sina-banner-slider owl-carousel"
		data-autoplay="<?php echo esc_attr( $data['autoplay'] ); ?>"
		data-pause="<?php echo esc_attr( $data['pause'] ); ?>"
		data-nav="<?php echo esc_attr( $data['nav'] ); ?>"
		data-dots="<?php echo esc_attr( $data['dots'] ); ?>"
		data-mouse-drag="<?php echo esc_attr( $data['mouse_drag'] ); ?>"
		data-touch-drag="<?php echo esc_attr( $data['touch_drag'] ); ?>"
		data-loop="<?php echo esc_attr( $data['loop'] ); ?>"
		data-speed="<?php echo esc_attr( $data['speed'] ); ?>"
		data-part-anim="<?php echo esc_attr( $data['part_anim'] ); ?>"
		data-delay="<?php echo esc_attr( $data['delay'] ); ?>">

			<?php foreach ($data['slides'] as $index => $slide) :
					$invisible = '';
					if ( $data['part_anim'] ) {
						$invisible = 'sina-anim-invisible';
					}

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

					<div class="sina-banner-container" style="text-align: <?php echo esc_attr( $slide['align'] ); ?>">
						<?php if ( $slide['title'] ): ?>
							<div <?php echo $this->get_render_attribute_string( $title_key ); ?> data-animation="animated <?php echo esc_attr( $slide['title_anim'] ); ?>">
								<?php echo wp_kses_post( $slide['title'] ); ?>
							</div>
						<?php endif; ?>

						<?php if ( $slide['subtitle'] ): ?>
							<div <?php echo $this->get_render_attribute_string( $subtitle_key ); ?> data-animation="animated <?php echo esc_attr( $slide['subtitle_anim'] ); ?>">
								<?php echo wp_kses_post( $slide['subtitle'] ); ?>
							</div>
						<?php endif; ?>

						<?php if ( $slide['desc'] ): ?>
							<div <?php echo $this->get_render_attribute_string( $desc_key ); ?> data-animation="animated <?php echo esc_attr( $slide['desc_anim'] ); ?>">
								<?php echo wp_kses_post( $slide['desc'] ); ?>
							</div>
						<?php endif; ?>

						<?php if ( $data['pbtn_text'] || $data['sbtn_text'] ): ?>
							<div class="sina-banner-btns <?php echo esc_attr($invisible); ?>" data-animation="animated <?php echo esc_attr( $slide['buttons_anim'] ); ?>">
								<?php if ( $data['pbtn_text'] ): ?>
									<a class="sina-banner-pbtn"
									href="<?php echo esc_url( $data['pbtn_link']['url'] ); ?>"
									<?php if ( 'on' == $data['pbtn_link']['is_external'] ): ?>
										target="_blank" 
									<?php endif; ?>
									<?php if ( 'on' == $data['pbtn_link']['nofollow'] ): ?>
										rel="nofollow" 
									<?php endif; ?>>
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
									<?php endif; ?>>
										<?php if ( $data['sbtn_icon'] && $data['sbtn_icon_align'] == 'left' ): ?>
											<i class="<?php echo esc_attr($data['sbtn_icon']); ?> sina-icon-left"></i>
										<?php endif; ?>
										<span <?php echo $this->get_render_attribute_string( 'pbtn_text' ); ?>>
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
				</div>
			<?php endforeach; ?>
		</div><!-- .sina-banner-slider -->
		<?php
	}


	protected function _content_template() {
		
	}
}