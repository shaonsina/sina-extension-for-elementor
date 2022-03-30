<?php
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
	public static function morphing_animation( $obj ) {
		$obj->add_control(
			'is_morphing_anim_icon',
			[
				'label' => esc_html__( 'Morphing Animation', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$obj->add_control(
			'morphing_pattern',
			[
				'label' => esc_html__( 'Morphing Pattern', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-morphing-anim' => esc_html__( 'Pattern 1', 'sina-ext' ),
					'sina-morphing-pattern-2' => esc_html__( 'Pattern 2', 'sina-ext' ),
					'sina-morphing-pattern-3' => esc_html__( 'Pattern 3', 'sina-ext' ),
					'sina-morphing-pattern-4' => esc_html__( 'Pattern 4', 'sina-ext' ),
				],
				'default' => 'sina-morphing-anim',
				'condition' => [
					'is_morphing_anim_icon' => 'yes',
				],
			]
		);
	}

	public static function BG_hover_effects( $obj, $class, $prefix = 'bg_layer' ) {

		$obj->add_control(
			$prefix.'_styles',
			[
				'label' => esc_html__( 'Background Hover Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$obj->add_control(
			$prefix.'_effects',
			[
				'label' => esc_html__( 'Hover Effects', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-hv-door-v' => esc_html__( 'Door Vertical', 'sina-ext' ),
					'sina-hv-door-h' => esc_html__( 'Door Horizontal', 'sina-ext' ),
					'sina-hv-zoom' => esc_html__( 'Zoom In', 'sina-ext' ),
					'sina-hv-fade' => esc_html__( 'Fade In', 'sina-ext' ),
					'sina-hv-slide-l' => esc_html__( 'Slide Left', 'sina-ext' ),
					'sina-hv-slide-r' => esc_html__( 'Slide Right', 'sina-ext' ),
					'sina-hv-slide-b' => esc_html__( 'Slide Bottom', 'sina-ext' ),
					'sina-hv-slide-t' => esc_html__( 'Slide Top', 'sina-ext' ),
					'sina-hv-slide-lb' => esc_html__( 'Slide Left-Bottom', 'sina-ext' ),
					'sina-hv-slide-rb' => esc_html__( 'Slide Right-Bottom', 'sina-ext' ),
					'sina-hv-slide-lt' => esc_html__( 'Slide Left-Top', 'sina-ext' ),
					'sina-hv-slide-rt' => esc_html__( 'Slide Right-Top', 'sina-ext' ),
					'' => esc_html__( 'None', 'sina-ext' ),
				],
				'default' => '',
			]
		);
		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => $prefix.'_color',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#055394',
					],
				],
				'selector' => '{{WRAPPER}} '.$class.':before',
			]
		);
	}

	public static function BG_hover_effects_alt( $obj, $class, $prefix = 'bg_layer' ) {

		$obj->add_control(
			$prefix.'_styles',
			[
				'label' => esc_html__( 'Background Hover Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$obj->add_control(
			$prefix.'_effects',
			[
				'label' => esc_html__( 'Hover Effects', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-hv-door-v' => esc_html__( 'Door Vertical', 'sina-ext' ),
					'sina-hv-door-h' => esc_html__( 'Door Horizontal', 'sina-ext' ),
					'sina-hv-zoom' => esc_html__( 'Zoom In', 'sina-ext' ),
					'sina-hv-fade' => esc_html__( 'Fade In', 'sina-ext' ),
					'sina-hv-slide-l' => esc_html__( 'Slide Left', 'sina-ext' ),
					'sina-hv-slide-r' => esc_html__( 'Slide Right', 'sina-ext' ),
					'sina-hv-slide-b' => esc_html__( 'Slide Bottom', 'sina-ext' ),
					'sina-hv-slide-t' => esc_html__( 'Slide Top', 'sina-ext' ),
					'' => esc_html__( 'None', 'sina-ext' ),
				],
				'default' => '',
			]
		);
		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => $prefix.'_color',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#055394',
					],
				],
				'selector' => '{{WRAPPER}} '.$class.':before',
			]
		);
	}

	public static function animation() {
		return [
			'none' => esc_html__( 'None', 'sina-ext' ),
			'fadeIn' => esc_html__( 'Fade In', 'sina-ext' ),
			'fadeInUp' => esc_html__( 'Fade In Up', 'sina-ext' ),
			'fadeInDown' => esc_html__( 'Fade In Down', 'sina-ext' ),
			'fadeInLeft' => esc_html__( 'Fade In Left', 'sina-ext' ),
			'fadeInRight' => esc_html__( 'Fade In Right', 'sina-ext' ),
			'zoomIn' => esc_html__('Zoom In', 'sina-ext'),
			'zoomInLeft' => esc_html__('Zoom In Left', 'sina-ext'),
			'zoomInRight' => esc_html__('Zoom In Right', 'sina-ext'),
			'zoomInDown' => esc_html__('Zoom In Down', 'sina-ext'),
			'zoomInUp' => esc_html__('Zoom In Up', 'sina-ext'),
			'bounce' => esc_html__('Bounce', 'sina-ext'),
			'bounceIn' => esc_html__('Bounce In', 'sina-ext'),
			'bounceInDown' => esc_html__('Bounce In Down', 'sina-ext'),
			'bounceInLeft' => esc_html__('Bounce In Left', 'sina-ext'),
			'bounceInRight' => esc_html__('Bounce In Right', 'sina-ext'),
			'bounceInUp' => esc_html__('Bounce In Up', 'sina-ext'),
			'slideInDown' => esc_html__('Slide In Down', 'sina-ext'),
			'slideInLeft' => esc_html__('Slide In Left', 'sina-ext'),
			'slideInRight' => esc_html__('Slide In Right', 'sina-ext'),
			'slideInUp' => esc_html__('Slide In Up', 'sina-ext'),
			'rotateIn' => esc_html__('Rotate In', 'sina-ext'),
			'rotateInDownLeft' => esc_html__('Rotate In Down Left', 'sina-ext'),
			'rotateInDownRight' => esc_html__('Rotate In Down Right', 'sina-ext'),
			'rotateInUpLeft' => esc_html__('Rotate In Up Left', 'sina-ext'),
			'rotateInUpRight' => esc_html__('Rotate In Up Right', 'sina-ext'),
			'flipInX' => esc_html__( 'Flip In X', 'sina-ext' ),
			'flipInY' => esc_html__( 'Flip In Y', 'sina-ext' ),
			'lightSpeedIn' => esc_html__('Light Speed In', 'sina-ext'),
			'flash' => esc_html__('Flash', 'sina-ext'),
			'pulse' => esc_html__('Pulse', 'sina-ext'),
			'rubberBand' => esc_html__('Rubber Band', 'sina-ext'),
			'shake' => esc_html__('Shake', 'sina-ext'),
			'headShake' => esc_html__('Head Shake', 'sina-ext'),
			'swing' => esc_html__('Swing', 'sina-ext'),
			'tada' => esc_html__('Tada', 'sina-ext'),
			'wobble' => esc_html__('Wobble', 'sina-ext'),
			'jello' => esc_html__('Jello', 'sina-ext'),
			'rollIn' => esc_html__('Roll In', 'sina-ext'),
		];
	}

	public static function animation_out() {
		return [
			'none' => esc_html__( 'None', 'sina-ext' ),
			'fadeOut' => esc_html__( 'Fade Out', 'sina-ext' ),
			'fadeOutUp' => esc_html__( 'Fade Out Up', 'sina-ext' ),
			'fadeOutDown' => esc_html__( 'Fade Out Down', 'sina-ext' ),
			'fadeOutLeft' => esc_html__( 'Fade Out Left', 'sina-ext' ),
			'fadeOutRight' => esc_html__( 'Fade Out Right', 'sina-ext' ),
			'zoomOut' => esc_html__('Zoom Out', 'sina-ext'),
			'zoomOutLeft' => esc_html__('Zoom Out Left', 'sina-ext'),
			'zoomOutRight' => esc_html__('Zoom Out Right', 'sina-ext'),
			'zoomOutDown' => esc_html__('Zoom Out Down', 'sina-ext'),
			'zoomOutUp' => esc_html__('Zoom Out Up', 'sina-ext'),
			'bounceOut' => esc_html__('Bounce Out', 'sina-ext'),
			'bounceOutDown' => esc_html__('Bounce Out Down', 'sina-ext'),
			'bounceOutLeft' => esc_html__('Bounce Out Left', 'sina-ext'),
			'bounceOutRight' => esc_html__('Bounce Out Right', 'sina-ext'),
			'bounceOutUp' => esc_html__('Bounce Out Up', 'sina-ext'),
			'slideOutDown' => esc_html__('Slide Out Down', 'sina-ext'),
			'slideOutLeft' => esc_html__('Slide Out Left', 'sina-ext'),
			'slideOutRight' => esc_html__('Slide Out Right', 'sina-ext'),
			'slideOutUp' => esc_html__('Slide Out Up', 'sina-ext'),
			'rotateOut' => esc_html__('Rotate Out', 'sina-ext'),
			'rotateOutDownLeft' => esc_html__('Rotate Out Down Left', 'sina-ext'),
			'rotateOutDownRight' => esc_html__('Rotate Out Down Right', 'sina-ext'),
			'rotateOutUpLeft' => esc_html__('Rotate Out Up Left', 'sina-ext'),
			'rotateOutUpRight' => esc_html__('Rotate Out Up Right', 'sina-ext'),
			'flipOutX' => esc_html__( 'Flip Out X', 'sina-ext' ),
			'flipOutY' => esc_html__( 'Flip Out Y', 'sina-ext' ),
			'lightSpeedOut' => esc_html__('Light Speed Out', 'sina-ext'),
			'rollOut' => esc_html__('Roll Out', 'sina-ext'),
		];
	}

	public static function posts_content($obj) {
		$obj->add_control(
			'posts_num',
			[
				'label' => esc_html__( 'Number of Posts', 'sina-ext' ),
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
				'label' => esc_html__( 'Number of Offset', 'sina-ext' ),
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
				'label' => esc_html__( 'Order by', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'date' => esc_html__( 'Date', 'sina-ext' ),
					'title' => esc_html__( 'Title', 'sina-ext' ),
					'author' => esc_html__( 'Author', 'sina-ext' ),
					'modified' => esc_html__( 'Modified', 'sina-ext' ),
					'comment_count' => esc_html__( 'Comments', 'sina-ext' ),
				],
				'default' => 'date',
			]
		);
		$obj->add_control(
			'sort',
			[
				'label' => esc_html__( 'Sort', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ASC' => esc_html__( 'ASC', 'sina-ext' ),
					'DESC' => esc_html__( 'DESC', 'sina-ext' ),
				],
				'default' => 'DESC',
			]
		);
	}

	public static function carousel_content( $obj, $cond = true, $speed = true ) {
		$obj->add_control(
			'autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'sina-ext' ),
				'label_off' => esc_html__( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$obj->add_control(
			'pause',
			[
				'label' => esc_html__( 'Pause on Hover', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'sina-ext' ),
				'label_off' => esc_html__( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$obj->add_control(
			'mouse_drag',
			[
				'label' => esc_html__( 'Mouse Drag', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'sina-ext' ),
				'label_off' => esc_html__( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$obj->add_control(
			'touch_drag',
			[
				'label' => esc_html__( 'Touch Drag', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'sina-ext' ),
				'label_off' => esc_html__( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$obj->add_control(
			'loop',
			[
				'label' => esc_html__( 'Infinity Loop', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'sina-ext' ),
				'label_off' => esc_html__( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$obj->add_control(
			'center',
			[
				'label' => esc_html__( 'Center', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'sina-ext' ),
				'label_off' => esc_html__( 'Off', 'sina-ext' ),
				'condition' => [
					'show_item!' => '1'
				],
			]
		);

		if ($cond) {
			$obj->add_control(
				'dots',
				[
					'label' => esc_html__( 'Dots', 'sina-ext' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'sina-ext' ),
					'label_off' => esc_html__( 'Hide', 'sina-ext' ),
					'default' => 'yes',
				]
			);
			$obj->add_control(
				'nav',
				[
					'label' => esc_html__( 'Navigation', 'sina-ext' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'sina-ext' ),
					'label_off' => esc_html__( 'Hide', 'sina-ext' ),
					'default' => 'yes',
				]
			);
		}

		$obj->add_control(
			'delay',
			[
				'label' => esc_html__( 'Delay', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000,
				'step' => 100,
				'min' => 0,
				'max' => 15000,
			]
		);
		$obj->add_control(
			'slide_anim',
			[
				'label' => esc_html__( 'Slide Animation In', 'sina-ext' ),
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
				'label' => esc_html__( 'Slide Animation Out', 'sina-ext' ),
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
					'label' => esc_html__( 'Speed', 'sina-ext' ),
					'type' => Controls_Manager::NUMBER,
					'step' => 100,
					'min' => 0,
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
			$prefix.'_text',
			[
				'label' => esc_html__( 'Label', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Text', 'sina-ext' ),
				'default' => $btn_text,
			]
		);
		if ( $tooltip ) {
			$obj->add_control(
				$prefix.'_tooltip_text',
				[
					'label' => esc_html__( 'Tooltip text', 'sina-ext' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'Enter Tooltip Text', 'sina-ext' ),
				]
			);
		}
		$obj->add_control(
			$prefix.'_icon',
			[
				'label' => esc_html__( 'Icon', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
			]
		);
		$obj->add_control(
			$prefix.'_icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'left' => esc_html__( 'Left', 'sina-ext' ),
					'right' => esc_html__( 'Right', 'sina-ext' ),
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
				'label' => esc_html__( 'Icon Spacing', 'sina-ext' ),
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
					'.rtl {{WRAPPER}} '.$class.' .sina-icon-right' => 'margin-right: {{SIZE}}{{UNIT}}; margin-left: auto;',
					'.rtl {{WRAPPER}} '.$class.' .sina-icon-left' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: auto;',
				],
			]
		);
		$obj->add_control(
			$prefix.'_effect',
			[
				'label' => esc_html__( 'Icon Effects', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'None', 'sina-ext' ),
					'sina-anim-right-move' => esc_html__( 'Icon Right Move', 'sina-ext' ),
					'sina-anim-right-moving' => esc_html__( 'Icon Right Moving', 'sina-ext' ),
					'sina-anim-right-bouncing' => esc_html__( 'Icon Right Bouncing', 'sina-ext' ),
					'sina-anim-left-move' => esc_html__( 'Icon Left Move', 'sina-ext' ),
					'sina-anim-left-moving' => esc_html__( 'Icon Left Moving', 'sina-ext' ),
					'sina-anim-left-bouncing' => esc_html__( 'Icon Left Bouncing', 'sina-ext' ),
					'sina-anim-zooming' => esc_html__( 'Icon Zooming', 'sina-ext' ),
				],
				'default' => '',
			]
		);
		if ($cond) {
			$obj->add_control(
				$prefix.'_link',
				[
					'label' => esc_html__( 'Link', 'sina-ext' ),
					'type' => Controls_Manager::URL,
					'placeholder' => 'https://your-link.com',
					'default' => [
						'url' => '#',
					],
				]
			);
		}
	}

	public static function tooltip_style( $obj, $prefix, $class ) {
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
				'selector' => '{{WRAPPER}} '.$class.' .tooltip',
			]
		);
		$obj->add_control(
			$prefix.'_tooptip_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} '.$class.' .tooltip-inner' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_control(
			$prefix.'_tooptip_bg',
			[
				'label' => esc_html__( 'Background Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} '.$class.' .tooltip-inner' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} '.$class.' .tooltip.top .tooltip-arrow' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} '.$class.' .tooltip.bottom .tooltip-arrow' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} '.$class.' .tooltip.left .tooltip-arrow' => 'border-left-color: {{VALUE}};',
					'{{WRAPPER}} '.$class.' .tooltip.right .tooltip-arrow' => 'border-right-color: {{VALUE}};',
				],
			]
		);
		$obj->add_responsive_control(
			$prefix.'_tooptip_width',
			[
				'label' => esc_html__( 'Max Width', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%'],
				'range' => [
					'px' => [
						'max' => 300,
					],
					'em' => [
						'max' => 30,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 120,
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .tooltip-inner' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			$prefix.'_tooltip_radius',
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
					'{{WRAPPER}} '.$class.' .tooltip-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			$prefix.'_tooltip_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '5',
					'right' => '10',
					'bottom' => '5',
					'left' => '10',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .tooltip-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	}

	public static function nav_dots_style($obj, $class = '') {
		$obj->add_control(
			'dots_color',
			[
				'label' => esc_html__( 'Dots Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'dots!' => '',
				],
				'default' => '#1085e4',
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-dot' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} '.$class.' .owl-dot.active' => 'background-color: {{VALUE}}',
				]
			]
		);
		$obj->add_control(
			'nav_styles',
			[
				'label' => esc_html__( 'Navigation', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'nav!' => '',
				],
			]
		);

		$obj->start_controls_tabs( 'nav_tabs' );

		$obj->start_controls_tab(
			'nav_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext' ),
				'condition' => [
					'nav!' => '',
				],
			]
		);

		$obj->add_control(
			'nav_color',
			[
				'label' => esc_html__( 'Arrow Color', 'sina-ext' ),
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
		$obj->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'nav_shadow',
				'condition' => [
					'nav!' => '',
				],
				'selector' => '{{WRAPPER}} '.$class.' .owl-prev, {{WRAPPER}} '.$class.' .owl-next',
			]
		);
		$obj->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nav_border',
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
				'label' => esc_html__( 'Hover', 'sina-ext' ),
				'condition' => [
					'nav!' => '',
				],
			]
		);

		$obj->add_control(
			'nav_hover_color',
			[
				'label' => esc_html__( 'Arrow Color', 'sina-ext' ),
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
		$obj->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'nav_hover_shadow',
				'condition' => [
					'nav!' => '',
				],
				'selector' => '{{WRAPPER}} '.$class.' .owl-prev:hover, {{WRAPPER}} '.$class.' .owl-next:hover',
			]
		);
		$obj->add_control(
			'nav_hover_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'nav!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-prev:hover, {{WRAPPER}} '.$class.' .owl-next:hover' => 'border-color: {{VALUE}}'
				],
			]
		);

		$obj->end_controls_tab();

		$obj->end_controls_tabs();

		$obj->add_control(
			'nav_font',
			[
				'label' => esc_html__( 'Font Family', 'sina-ext' ),
				'type' => Controls_Manager::FONT,
				'default' => 'Arial',
				'separator' => 'before',
				'condition' => [
					'nav!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-prev, {{WRAPPER}} '.$class.' .owl-next' => 'font-family: {{VALUE}}',
				],
			]
		);
		$obj->add_responsive_control(
			'nav_font_size',
			[
				'label' => esc_html__( 'Font Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'nav!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-prev, {{WRAPPER}} '.$class.' .owl-next' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$obj->add_control(
			'nav_top',
			[
				'label' => esc_html__( 'Nav Top (%)', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
					'size' => '48',
				],
				'condition' => [
					'nav!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-prev, {{WRAPPER}} '.$class.' .owl-next' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'nav_next_radius',
			[
				'label' => esc_html__( 'Nav Next Radius', 'sina-ext' ),
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
				'label' => esc_html__( 'Nav Prev Radius', 'sina-ext' ),
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
		$obj->add_responsive_control(
			'nav_padding',
			[
				'label' => esc_html__( 'Nav Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '2',
					'right' => '14',
					'bottom' => '6',
					'left' => '14',
					'isLinked' => false,
				],
				'condition' => [
					'nav!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-prev, {{WRAPPER}} '.$class.' .owl-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	}

	public static function button_style( $obj, $class = '', $prefix = 'btn') {
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
				'label' => esc_html__( 'Normal', 'sina-ext' ),
			]
		);
		$obj->add_control(
			$prefix.'_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
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
				'label' => esc_html__( 'Hover', 'sina-ext' ),
			]
		);
		$obj->add_control(
			$prefix.'_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} '.$class.':hover' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => $prefix.'_hover_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} '.$class.':hover',
			]
		);
		$obj->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => $prefix.'_hover_tshadow',
				'selector' => '{{WRAPPER}} '.$class.':hover',
			]
		);
		$obj->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $prefix.'_hover_shadow',
				'selector' => '{{WRAPPER}} '.$class.':hover',
			]
		);
		$obj->add_control(
			$prefix.'_hover_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} '.$class.':hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$obj->end_controls_tab();

		$obj->end_controls_tabs();
	}

	public static function button_style_active( $obj, $class = '', $prefix = 'btn') {
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
				'label' => esc_html__( 'Normal', 'sina-ext' ),
			]
		);
		$obj->add_control(
			$prefix.'_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
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
		$obj->add_responsive_control(
			$prefix.'_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->end_controls_tab();

		$obj->start_controls_tab(
			$prefix.'_active',
			[
				'label' => esc_html__( 'Active', 'sina-ext' ),
			]
		);
		$obj->add_control(
			$prefix.'_active_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} '.$class.'.active' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => $prefix.'_active_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} '.$class.'.active',
			]
		);
		$obj->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => $prefix.'_active_tshadow',
				'selector' => '{{WRAPPER}} '.$class.'.active',
			]
		);
		$obj->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $prefix.'_active_shadow',
				'selector' => '{{WRAPPER}} '.$class.'.active',
			]
		);
		$obj->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => $prefix.'_active_border',
				'selector' => '{{WRAPPER}} '.$class.'.active',
			]
		);
		$obj->add_responsive_control(
			$prefix.'_active_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} '.$class.'.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selectors' => [
					'{{WRAPPER}} .sina-input-field'.$class => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			$prefix.'_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
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
				'label' => esc_html__( 'Margin', 'sina-ext' ),
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
				'label' => esc_html__( 'Placeholder Color', 'sina-ext' ),
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
				'label' => esc_html__( 'Normal', 'sina-ext' ),
			]
		);

		$obj->add_control(
			'color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
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
				'label' => esc_html__( 'Background', 'sina-ext' ),
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
				'label' => esc_html__( 'Focus', 'sina-ext' ),
			]
		);

		$obj->add_control(
			'focus_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-input-field:focus' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_control(
			'focus_background',
			[
				'label' => esc_html__( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-input-field:focus' => 'background: {{VALUE}};',
				],
			]
		);
		$obj->add_control(
			'focus_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext' ),
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
