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

	public static function carousel_content( $obj, $class = '', $cond = true ) {
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
	}

	public static function button_content( $obj, $class = '', $label = 'Learn More', $prefix = 'btn', $cond = true ) {
		$obj->add_control(
			$prefix.'_text',
			[
				'label' => __( 'Label', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Label', 'sina-ext' ),
				'default' => $label,
			]
		);
		if ($cond) {
			$obj->add_control(
				$prefix.'_link',
				[
					'label' => __( 'Link', 'sina-ext' ),
					'type' => Controls_Manager::URL,
					'default' => [
						'url' => '#',
					],
					'placeholder' => __( 'https://your-link.com', 'sina-ext' ),
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
				'default' => 'left',
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
					$prefix.'_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .sina-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} '.$class.' .sina-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
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
		$obj->add_control(
			'nav_color',
			[
				'label' => __( 'Arrow Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'nav!' => '',
				],
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-prev, {{WRAPPER}} '.$class.' .owl-next' => 'color: {{VALUE}}'
				],
			]
		);

		$obj->end_controls_tab();

		$obj->start_controls_tab(
			'nav_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
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

		$obj->end_controls_tab();

		$obj->end_controls_tabs();

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
				'separator' => 'before',
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
				'default' => '#eee',
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
