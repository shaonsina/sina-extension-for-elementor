<?php
// namespace Sina_Extension;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Border;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sina_Common_Data Class for Common Controls.
 *
 * @since 2.3.0
 */

class Sina_Common_Data{
	public static function animation() {
		return [
			'none' => __( 'None', 'sina-ext' ),
			'fadeIn' => __( 'Fade In', 'sina-ext' ),
			'fadeInUp' => __( 'Fade In Up', 'sina-ext' ),
			'fadeInDown' => __( 'Fade In Down', 'sina-ext' ),
			'fadeInLeft' => __( 'Fade In Left', 'sina-ext' ),
			'fadeInRight' => __( 'Fade In Right', 'sina-ext' ),
			'zoomIn' => __('Zoom In', 'sina-ext'),
			'zoomInLeft' => __('Zoom In Left', 'sina-ext'),
			'zoomInRight' => __('Zoom In Right', 'sina-ext'),
			'zoomInDown' => __('Zoom In Down', 'sina-ext'),
			'zoomInUp' => __('Zoom In Up', 'sina-ext'),
			'bounceIn' => __('Bounce In', 'sina-ext'),
			'bounceInDown' => __('Bounce In Down', 'sina-ext'),
			'bounceInLeft' => __('Bounce In Left', 'sina-ext'),
			'bounceInRight' => __('Bounce In Right', 'sina-ext'),
			'bounceInUp' => __('Bounce In Up', 'sina-ext'),
			'slideInDown' => __('Slide In Down', 'sina-ext'),
			'slideInLeft' => __('Slide In Left', 'sina-ext'),
			'slideInRight' => __('Slide In Right', 'sina-ext'),
			'slideInUp' => __('Slide In Up', 'sina-ext'),
			'rotateIn' => __('Rotate In', 'sina-ext'),
			'rotateInDownLeft' => __('Rotate In Down Left', 'sina-ext'),
			'rotateInDownRight' => __('Rotate In Down Right', 'sina-ext'),
			'rotateInUpLeft' => __('Rotate In Up Left', 'sina-ext'),
			'rotateInUpRight' => __('Rotate In Up Right', 'sina-ext'),
			'flipInX' => __( 'Flip In X', 'sina-ext' ),
			'flipInY' => __( 'Flip In Y', 'sina-ext' ),
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
			'rollIn' => __('Roll In', 'sina-ext'),
		];
	}

	public static function animation_out() {
		return [
			'none' => __( 'None', 'sina-ext' ),
			'fadeOut' => __( 'Fade Out', 'sina-ext' ),
			'fadeOutUp' => __( 'Fade Out Up', 'sina-ext' ),
			'fadeOutDown' => __( 'Fade Out Down', 'sina-ext' ),
			'fadeOutLeft' => __( 'Fade Out Left', 'sina-ext' ),
			'fadeOutRight' => __( 'Fade Out Right', 'sina-ext' ),
			'zoomOut' => __('Zoom Out', 'sina-ext'),
			'zoomOutLeft' => __('Zoom Out Left', 'sina-ext'),
			'zoomOutRight' => __('Zoom Out Right', 'sina-ext'),
			'zoomOutDown' => __('Zoom Out Down', 'sina-ext'),
			'zoomOutUp' => __('Zoom Out Up', 'sina-ext'),
			'bounceOut' => __('Bounce Out', 'sina-ext'),
			'bounceOutDown' => __('Bounce Out Down', 'sina-ext'),
			'bounceOutLeft' => __('Bounce Out Left', 'sina-ext'),
			'bounceOutRight' => __('Bounce Out Right', 'sina-ext'),
			'bounceOutUp' => __('Bounce Out Up', 'sina-ext'),
			'slideOutDown' => __('Slide Out Down', 'sina-ext'),
			'slideOutLeft' => __('Slide Out Left', 'sina-ext'),
			'slideOutRight' => __('Slide Out Right', 'sina-ext'),
			'slideOutUp' => __('Slide Out Up', 'sina-ext'),
			'rotateOut' => __('Rotate Out', 'sina-ext'),
			'rotateOutDownLeft' => __('Rotate Out Down Left', 'sina-ext'),
			'rotateOutDownRight' => __('Rotate Out Down Right', 'sina-ext'),
			'rotateOutUpLeft' => __('Rotate Out Up Left', 'sina-ext'),
			'rotateOutUpRight' => __('Rotate Out Up Right', 'sina-ext'),
			'flipOutX' => __( 'Flip Out X', 'sina-ext' ),
			'flipOutY' => __( 'Flip Out Y', 'sina-ext' ),
			'lightSpeedOut' => __('Light Speed Out', 'sina-ext'),
			'rollOut' => __('Roll Out', 'sina-ext'),
		];
	}

	public static function posts_content($obj) {
		$obj->add_control(
			'posts_num',
			[
				'label' => __( 'Number of Posts', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 1,
				'min' => 1,
				'max' => 50,
				'default' => 3,
			]
		);
		$obj->add_control(
			'offset',
			[
				'label' => __( 'Number of Offset', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 1,
				'min' => 0,
				'max' => 50,
				'default' => 0,
			]
		);
		$obj->add_control(
			'order_by',
			[
				'label' => __( 'Order by', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'date' => __( 'Date', 'sina-ext' ),
					'title' => __( 'Title', 'sina-ext' ),
					'author' => __( 'Author', 'sina-ext' ),
					'modified' => __( 'Modified', 'sina-ext' ),
					'comment_count' => __( 'Comments', 'sina-ext' ),
				],
				'default' => 'date',
			]
		);
		$obj->add_control(
			'sort',
			[
				'label' => __( 'Sort', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ASC' => __( 'ASC', 'sina-ext' ),
					'DESC' => __( 'DESC', 'sina-ext' ),
				],
				'default' => 'DESC',
			]
		);
	}

	public static function carousel_content( $obj, $class = '', $cond = true, $speed = true ) {
		$obj->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'sina-ext' ),
				'label_off' => __( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$obj->add_control(
			'pause',
			[
				'label' => __( 'Pause on Hover', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'sina-ext' ),
				'label_off' => __( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$obj->add_control(
			'mouse_drag',
			[
				'label' => __( 'Mouse Drag', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'sina-ext' ),
				'label_off' => __( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$obj->add_control(
			'touch_drag',
			[
				'label' => __( 'Touch Drag', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'sina-ext' ),
				'label_off' => __( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$obj->add_control(
			'loop',
			[
				'label' => __( 'Infinity Loop', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'sina-ext' ),
				'label_off' => __( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$obj->add_control(
			'center',
			[
				'label' => __( 'Center', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'sina-ext' ),
				'label_off' => __( 'Off', 'sina-ext' ),
				'condition' => [
					'show_item!' => '1'
				],
			]
		);

		if ($cond) {
			$obj->add_control(
				'dots',
				[
					'label' => __( 'Dots', 'sina-ext' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'sina-ext' ),
					'label_off' => __( 'Hide', 'sina-ext' ),
					'default' => 'yes',
				]
			);
			$obj->add_control(
				'nav',
				[
					'label' => __( 'Navigation', 'sina-ext' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'sina-ext' ),
					'label_off' => __( 'Hide', 'sina-ext' ),
					'default' => 'yes',
				]
			);
		}

		$obj->add_control(
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
		$obj->add_control(
			'slide_anim',
			[
				'label' => __( 'Slide Animation In', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => self::animation(),
				'condition' => [
					'show_item' => '1',
				],
			]
		);
		$obj->add_control(
			'slide_anim_out',
			[
				'label' => __( 'Slide Animation Out', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => self::animation_out(),
				'condition' => [
					'show_item' => '1',
				],
			]
		);

		if ( $speed ) {
			$obj->add_control(
				'speed',
				[
					'label' => __( 'Speed', 'sina-ext' ),
					'type' => Controls_Manager::NUMBER,
					'step' => 100,
					'min' => 100,
					'max' => 5000,
					'default' => 500,
					'condition' => [
						'slide_anim' => 'none',
					],
				]
			);
		}
	}

	public static function button_content( $obj, $class = '', $btn_text = 'Learn More', $prefix = 'btn', $cond = true, $tooltip = false ) {
		$obj->add_control(
			$prefix.'_effect',
			[
				'label' => __( 'Hover Effects', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'None', 'sina-ext' ),
					'sina-anim-right-move' => __( 'Icon Right Move', 'sina-ext' ),
					'sina-anim-right-moving' => __( 'Icon Right Moving', 'sina-ext' ),
					'sina-anim-right-bouncing' => __( 'Icon Right Bouncing', 'sina-ext' ),
					'sina-anim-left-move' => __( 'Icon Left Move', 'sina-ext' ),
					'sina-anim-left-moving' => __( 'Icon Left Moving', 'sina-ext' ),
					'sina-anim-left-bouncing' => __( 'Icon Left Bouncing', 'sina-ext' ),
					'sina-anim-zooming' => __( 'Icon Zooming', 'sina-ext' ),
				],
				'default' => '',
			]
		);
		$obj->add_control(
			$prefix.'_text',
			[
				'label' => __( 'Label', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Text', 'sina-ext' ),
				'default' => $btn_text,
			]
		);
		if ( $tooltip ) {
			$obj->add_control(
				$prefix.'_tooltip_text',
				[
					'label' => __( 'Tooltip text', 'sina-ext' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( 'Enter Tooltip Text', 'sina-ext' ),
				]
			);
		}
		if ($cond) {
			$obj->add_control(
				$prefix.'_link',
				[
					'label' => __( 'Link', 'sina-ext' ),
					'type' => Controls_Manager::URL,
					'placeholder' => __( 'https://your-link.com', 'sina-ext' ),
					'default' => [
						'url' => '#',
					],
				]
			);
		}
		$obj->add_control(
			$prefix.'_icon',
			[
				'label' => __( 'Icon', 'sina-ext' ),
				'type' => Controls_Manager::ICON,
			]
		);
		$obj->add_control(
			$prefix.'_icon_align',
			[
				'label' => __( 'Icon Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'left' => __( 'Left', 'sina-ext' ),
					'right' => __( 'Right', 'sina-ext' ),
				],
				'default' => 'right',
				'condition' => [
					$prefix.'_icon!' => '',
				],
			]
		);
		$obj->add_responsive_control(
			$prefix.'_icon_space',
			[
				'label' => __( 'Icon Spacing', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '5',
				],
				'condition' => [
					$prefix.'_text!' => '',
					$prefix.'_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .sina-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} '.$class.' .sina-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
	}

	public static function tooltip_style( $obj, $prefix, $class ) {
		$obj->add_control(
			$prefix.'_tooptip',
			[
				'label' => __( 'Tooptip Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					$prefix.'_tooltip_text!' => '',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => $prefix.'_tooptip_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_size'   => [
						'default' => [
							'size' => '12',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '16',
						],
					],
				],
				'condition' => [
					$prefix.'_tooltip_text!' => '',
				],
				'selector' => '{{WRAPPER}} '.$class.' .sina-tooltip-text',
			]
		);
		$obj->add_control(
			$prefix.'_tooptip_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'condition' => [
					$prefix.'_tooltip_text!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .sina-tooltip-text' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_control(
			$prefix.'_tooptip_bg',
			[
				'label' => __( 'Background Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'condition' => [
					$prefix.'_tooltip_text!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .sina-tooltip-text' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} '.$class.' .sina-tooltip-text::after' => 'border-top-color: {{VALUE}};',
				],
			]
		);
		$obj->add_responsive_control(
			$prefix.'_tooptip_dist',
			[
				'label' => __( 'Distance', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 0,
					],
					'em' => [
						'min' => -5,
						'max' => 0,
					],
				],
				'default' => [
					'size' => -40,
				],
				'condition' => [
					$prefix.'_tooltip_text!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .sina-tooltip-text' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			$prefix.'_tooltip_radius',
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
				'condition' => [
					$prefix.'_tooltip_text!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .sina-tooltip-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			$prefix.'_tooltip_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '5',
					'right' => '10',
					'bottom' => '5',
					'left' => '10',
					'isLinked' => false,
				],
				'condition' => [
					$prefix.'_tooltip_text!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .sina-tooltip-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	}

	public static function nav_dots_style($obj, $class = '') {
		$obj->add_control(
			'dots_color',
			[
				'label' => __( 'Dots Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'dots!' => '',
				],
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-dot' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} '.$class.' .owl-dot.active' => 'background-color: {{VALUE}}',
				]
			]
		);
		$obj->add_control(
			'nav_styles',
			[
				'label' => __( 'Navigation', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'nav!' => '',
				],
			]
		);

		$obj->start_controls_tabs( 'nav_tabs' );

		$obj->start_controls_tab(
			'nav_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);

		$obj->add_control(
			'nav_color',
			[
				'label' => __( 'Arrow Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'nav!' => '',
				],
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-prev, {{WRAPPER}} '.$class.' .owl-next' => 'color: {{VALUE}}'
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'nav_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#1085e4',
					],
				],
				'condition' => [
					'nav!' => '',
				],
				'selector' => '{{WRAPPER}} '.$class.' .owl-prev, {{WRAPPER}} '.$class.' .owl-next',
			]
		);

		$obj->end_controls_tab();

		$obj->start_controls_tab(
			'nav_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);

		$obj->add_control(
			'nav_hover_color',
			[
				'label' => __( 'Arrow Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'nav!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-prev:hover, {{WRAPPER}} '.$class.' .owl-next:hover' => 'color: {{VALUE}}'
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'nav_hover_bg',
				'types' => [ 'classic', 'gradient' ],
				'condition' => [
					'nav!' => '',
				],
				'selector' => '{{WRAPPER}} '.$class.' .owl-prev:hover, {{WRAPPER}} '.$class.' .owl-next:hover',
			]
		);

		$obj->end_controls_tab();

		$obj->end_controls_tabs();

		$obj->add_control(
			'nav_font',
			[
				'label' => __( 'Font Family', 'sina-ext' ),
				'type' => Controls_Manager::FONT,
				'default' => 'Arial',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-prev, {{WRAPPER}} '.$class.' .owl-next' => 'font-family: {{VALUE}}',
				],
			]
		);
		$obj->add_control(
			'nav_top',
			[
				'label' => __( 'Nav Top (%)', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
					'size' => '50',
				],
				'condition' => [
					'nav!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-prev, {{WRAPPER}} '.$class.' .owl-next' => 'top: calc({{SIZE}}{{UNIT}} - 18px);',
				],
			]
		);
		$obj->add_responsive_control(
			'nav_next_radius',
			[
				'label' => __( 'Nav Next Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '4',
					'right' => '4',
					'bottom' => '4',
					'left' => '4',
					'isLinked' => true,
				],
				'condition' => [
					'nav!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'nav_prev_radius',
			[
				'label' => __( 'Nav Prev Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '4',
					'right' => '4',
					'bottom' => '4',
					'left' => '4',
					'isLinked' => true,
				],
				'condition' => [
					'nav!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	}

	public static function button_style( $obj, $class = '', $prefix = 'btn' ) {
		$obj->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => $prefix.'_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_size'   => [
						'default' => [
							'size' => '15',
						],
					],
					'line_height'   => [
						'default' => [
							'unit' => 'px',
							'size' => '20',
						],
					],
					'font_weight' => [
						'default' => '400',
					],
					'transform'   => [
						'default' => [
							'size' => 'uppercase',
						],
					],
				],
				'selector' => '{{WRAPPER}} '.$class,
			]
		);

		$obj->start_controls_tabs( $prefix.'_tabs' );

		$obj->start_controls_tab(
			$prefix.'_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);
		$obj->add_control(
			$prefix.'_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} '.$class => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => $prefix.'_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#1085e4',
					],
				],
				'selector' => '{{WRAPPER}} '.$class,
			]
		);
		$obj->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => $prefix.'_tshadow',
				'selector' => '{{WRAPPER}} '.$class,
			]
		);
		$obj->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $prefix.'_shadow',
				'selector' => '{{WRAPPER}} '.$class,
			]
		);
		$obj->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => $prefix.'_border',
				'selector' => '{{WRAPPER}} '.$class,
			]
		);
		$obj->end_controls_tab();

		$obj->start_controls_tab(
			$prefix.'_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);
		$obj->add_control(
			$prefix.'_hover_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} '.$class.':hover, {{WRAPPER}} '.$class.':focus' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => $prefix.'_hover_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} '.$class.':hover, {{WRAPPER}} '.$class.':focus',
			]
		);
		$obj->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => $prefix.'_hover_tshadow',
				'selector' => '{{WRAPPER}} '.$class.':hover, {{WRAPPER}} '.$class.':focus',
			]
		);
		$obj->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $prefix.'_hover_shadow',
				'selector' => '{{WRAPPER}} '.$class.':hover, {{WRAPPER}} '.$class.':focus',
			]
		);
		$obj->add_control(
			$prefix.'_hover_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} '.$class.':hover, {{WRAPPER}} '.$class.':focus' => 'border-color: {{VALUE}};',
				],
			]
		);
		$obj->end_controls_tab();

		$obj->end_controls_tabs();
	}

	public static function input_style( $obj, $class = '', $prefix = 'email' ) {
		$obj->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $prefix.'_shadow',
				'selector' => '{{WRAPPER}} '.$class,
			]
		);
		$obj->add_responsive_control(
			$prefix.'_width',
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
				'selectors' => [
					'{{WRAPPER}} .sina-input-field'.$class => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			$prefix.'_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			$prefix.'_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	}

	public static function input_fields_style( $obj ) {
		$obj->add_control(
			'placeholder_color',
			[
				'label' => __( 'Placeholder Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#aaa',
				'selectors' => [
					'{{WRAPPER}} .sina-input-field::-webkit-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .sina-input-field::-moz-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .sina-input-field::-ms-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .sina-input-field::placeholder' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'fields_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '400',
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
				'selector' => '{{WRAPPER}} .sina-input-field',
			]
		);
		$obj->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'fields_shadow',
				'selector' => '{{WRAPPER}} .sina-input-field',
			]
		);

		$obj->start_controls_tabs( 'field_tabs' );

		$obj->start_controls_tab(
			'fields_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);

		$obj->add_control(
			'color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-input-field' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_control(
			'background',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-input-field' => 'background: {{VALUE}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
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
				'selector' => '{{WRAPPER}} .sina-input-field',
			]
		);

		$obj->end_controls_tab();

		$obj->start_controls_tab(
			'fields_focus',
			[
				'label' => __( 'Focus', 'sina-ext' ),
			]
		);

		$obj->add_control(
			'focus_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-input-field:focus' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_control(
			'focus_background',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-input-field:focus' => 'background: {{VALUE}};',
				],
			]
		);
		$obj->add_control(
			'focus_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-input-field:focus' => 'border-color: {{VALUE}}'
				],
			]
		);

		$obj->end_controls_tab();

		$obj->end_controls_tabs();
	}

	public static function button_html( $data, $prefix = 'btn' ) {
		if ( isset($data[$prefix.'_tooltip_text']) && $data[$prefix.'_tooltip_text'] ) : ?>
			<?php printf( '<span class="sina-tooltip-text">%s</span>', $data[$prefix.'_tooltip_text'] ); ?>
		<?php
		endif;
		if ( $data[$prefix.'_icon'] && $data[$prefix.'_icon_align'] == 'left' ): ?>
			<i class="<?php echo esc_attr($data[$prefix.'_icon']); ?> sina-icon-left"></i>
		<?php endif; ?>
		<?php printf( '%s', $data[$prefix.'_text'] ); ?>
		<?php if ( $data[$prefix.'_icon'] && $data[$prefix.'_icon_align'] == 'right' ): ?>
			<i class="<?php echo esc_attr($data[$prefix.'_icon']); ?> sina-icon-right"></i>
			<?php
		endif;
	}
}
