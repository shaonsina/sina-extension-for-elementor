<?php

/**
 * Mailchim Widget.
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

class Sina_Mailchimp_Subscribe_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_mc_subscribe';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return __( 'Sina MailChimp', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'fa fa-wpforms';
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
		return [ 'sina form', 'sina subscribe form', 'sina mailchimp', 'sina email' ];
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
	        'mailchimp',
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
		// Start Fields Content
		// =====================
		$this->start_controls_section(
			'fields_content',
			[
				'label' => __( 'Fields', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Mailchimp Form URL', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter URL', 'sina-ext' ),
			]
		);
		$this->add_control(
			'email_placeholder',
			[
				'label' => __( 'Email placeholder text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter placeholder text', 'sina-ext' ),
				'separator' => 'before',
				'default' => 'Enter Email',
			]
		);
		$this->add_control(
			'email_tag',
			[
				'label' => __( 'Field tag', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter field tag', 'sina-ext' ),
				'separator' => 'after',
				'default' => 'EMAIL',
			]
		);
		$this->add_control(
			'fname',
			[
				'label' => __( 'First Name', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'fname_placeholder',
			[
				'label' => __( 'First name placeholder text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter placeholder text', 'sina-ext' ),
				'condition' => [
					'fname!' => '',
				],
				'default' => 'Enter First Name',
			]
		);
		$this->add_control(
			'fname_tag',
			[
				'label' => __( 'Field tag', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter field tag', 'sina-ext' ),
				'condition' => [
					'fname!' => '',
				],
				'separator' => 'after',
				'default' => 'FNAME',
			]
		);
		$this->add_control(
			'lname',
			[
				'label' => __( 'Last Name', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'lname_placeholder',
			[
				'label' => __( 'Last name placeholder text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter placeholder text', 'sina-ext' ),
				'condition' => [
					'lname!' => '',
				],
				'default' => 'Enter Last Name',
			]
		);
		$this->add_control(
			'lname_tag',
			[
				'label' => __( 'Field tag', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter field tag', 'sina-ext' ),
				'condition' => [
					'lname!' => '',
				],
				'separator' => 'after',
				'default' => 'LNAME',
			]
		);
		$this->add_control(
			'phone',
			[
				'label' => __( 'Phone Number', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'phone_placeholder',
			[
				'label' => __( 'Phone placeholder text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter placeholder text', 'sina-ext' ),
				'condition' => [
					'phone!' => '',
				],
				'default' => 'Enter Phone Number',
			]
		);
		$this->add_control(
			'phone_tag',
			[
				'label' => __( 'Field tag', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter field tag', 'sina-ext' ),
				'condition' => [
					'phone!' => '',
				],
				'default' => 'PHONE',
			]
		);

		$this->end_controls_section();
		// End Fields Content
		// =====================


		// Start Button Content
		// =====================
		$this->start_controls_section(
			'btn_content',
			[
				'label' => __( 'Submit Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'label',
			[
				'label' => __( 'Button Label', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Label', 'sina-ext' ),
				'default' => 'Subscribe',
			]
		);
		$this->add_control(
			'icon',
			[
				'label' => __( 'Button Icon', 'sina-ext' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-paper-plane-o',
			]
		);
		$this->add_control(
			'icon_position',
			[
				'label' => __( 'Icon Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'left' => __( 'Left', 'sina-ext' ),
					'right' => __( 'Right', 'sina-ext' ),
				],
				'condition' => [
					'icon!' => '',
				],
				'default' => 'right',
			]
		);
		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Icon Space', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'condition' => [
					'icon!' => '',
					'label!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-btn-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sina-btn-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Button Content
		// =====================


		// Start Fields Style
		// =====================
		$this->start_controls_section(
			'fields_style',
			[
				'label' => __( 'Fields', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'display',
			[
				'label' => __( 'Display', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'inline-block' => __( 'Inline', 'sina-ext' ),
					'block' => __( 'Block', 'sina-ext' ),
				],
				'default' => 'inline-block',
			]
		);
		$this->add_group_control(
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
				'selector' => '{{WRAPPER}} .sina-subs-input .sina-input-field',
			]
		);
		$this->add_control(
			'placeholder_color',
			[
				'label' => __( 'Placeholder Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#aaa',
				'selectors' => [
					'{{WRAPPER}} .sina-subs-input .sina-input-field::-webkit-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .sina-subs-input .sina-input-field::-moz-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .sina-subs-input .sina-input-field::-ms-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .sina-subs-input .sina-input-field::placeholder' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'fields_text_shadow',
				'selector' => '{{WRAPPER}} .sina-subs-input .sina-input-field',
			]
		);

		$this->start_controls_tabs( 'field_tabs' );

		$this->start_controls_tab(
			'fields_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_control(
			'color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#111',
				'selectors' => [
					'{{WRAPPER}} .sina-subs-input .sina-input-field' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'background',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-subs-input .sina-input-field' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
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
				'selector' => '{{WRAPPER}} .sina-subs-input .sina-input-field',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'fields_focus',
			[
				'label' => __( 'Focus', 'sina-ext' ),
			]
		);

		$this->add_control(
			'focus_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-subs-input .sina-input-field:focus' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'focus_background',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-subs-input .sina-input-field:focus' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'focus_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-subs-input .sina-input-field:focus' => 'border-color: {{VALUE}}'
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'fields_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '10',
					'right' => '12',
					'bottom' => '10',
					'left' => '12',
					'isLinked' => false,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-subs-input .sina-input-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Fields Style
		// =====================


		// Start First Name Style
		// ========================
		$this->start_controls_section(
			'fname_style',
			[
				'label' => __( 'First Name', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'fname!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'fname_width',
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
					'{{WRAPPER}} .sina-subs-input .sina-input-fname' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'fname_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-subs-input .sina-input-fname' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'fname_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '20',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-subs-input .sina-input-fname' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End First Name Style
		// ========================


		// Start Last Name Style
		// =======================
		$this->start_controls_section(
			'lname_style',
			[
				'label' => __( 'Last Name', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'lname!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'lname_width',
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
					'{{WRAPPER}} .sina-subs-input .sina-input-lname' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'lname_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-subs-input .sina-input-lname' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'lname_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '20',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-subs-input .sina-input-lname' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Last Name Style
		// ========================


		// Start Email Style
		// ===================
		$this->start_controls_section(
			'email_style',
			[
				'label' => __( 'Email', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'email_width',
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
					'{{WRAPPER}} .sina-subs-input .sina-input-email' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'email_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-subs-input .sina-input-email' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'email_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '20',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-subs-input .sina-input-email' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Email Style
		// =================


		// Start Phone Style
		// ===================
		$this->start_controls_section(
			'phone_style',
			[
				'label' => __( 'Phone', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'phone!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'phone_width',
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
					'{{WRAPPER}} .sina-subs-input .sina-input-phone' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'phone_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-subs-input .sina-input-phone' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'phone_margin',
			[
				'label' => __( 'Phone Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '20',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-subs-input .sina-input-phone' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Phone Style
		// =====================


		// Start Button Style
		// =====================
		$this->start_controls_section(
			'btn_style',
			[
				'label' => __( 'Submit Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
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
				'selector' => '{{WRAPPER}} .sina-subs-btn',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'btn_text_shadow',
				'selector' => '{{WRAPPER}} .sina-subs-btn',
			]
		);

		$this->start_controls_tabs( 'btn_tabs' );

		$this->start_controls_tab(
			'btn_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_control(
			'btn_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-subs-btn' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btn_background',
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
				'selector' => '{{WRAPPER}} .sina-subs-btn',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_border',
				'selector' => '{{WRAPPER}} .sina-subs-btn',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_shadow',
				'selector' => '{{WRAPPER}} .sina-subs-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'btn_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-subs-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'hover_background',
				'label' => __( 'Background', 'sina-ext' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-subs-btn:hover',
			]
		);
		$this->add_control(
			'hover_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-subs-btn:hover' => 'border-color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-subs-btn:hover',
				'separator' => 'after',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'btn_width',
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
					'{{WRAPPER}} .sina-subs-btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-subs-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '11',
					'right' => '20',
					'bottom' => '11',
					'left' => '20',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-subs-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '-4',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-subs-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'condition' => [
					'display!' => 'inline-block',
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .sina-subs-form' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Button Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$display_class = ('block' == $data['display']) ? 'sina-input-block' : '';
		?>
		<div class="sina-form">
			<form class="sina-subs-form"
			data-link="<?php echo esc_attr( $data['link'] ); ?>">
				<div class="sina-subs-input">
					<?php if ( $data['fname'] ): ?>
						<input class="sina-input-field sina-input-fname <?php echo esc_attr( $display_class ); ?>" type="text" name="<?php echo esc_attr( $data['fname_tag'] ); ?>" placeholder="<?php echo esc_attr( $data['fname_placeholder'] ); ?>">
					<?php endif; ?>

					<?php if ( $data['lname'] ): ?>
						<input class="sina-input-field sina-input-lname <?php echo esc_attr( $display_class ); ?>" type="text" name="<?php echo esc_attr( $data['lname_tag'] ); ?>" placeholder="<?php echo esc_attr( $data['lname_placeholder'] ); ?>">
					<?php endif; ?>

					<input class="sina-input-field sina-input-email <?php echo esc_attr( $display_class ); ?>" type="email" name="<?php echo esc_attr( $data['email_tag'] ); ?>" placeholder="<?php echo esc_attr( $data['email_placeholder'] ); ?> *">

					<?php if ( $data['phone'] ): ?>
						<input class="sina-input-field sina-input-phone <?php echo esc_attr( $display_class ); ?>" type="text" name="<?php echo esc_attr( $data['phone_tag'] ); ?>" placeholder="<?php echo esc_attr( $data['phone_placeholder'] ); ?>">
					<?php endif; ?>

					<?php if ( $data['label'] || $data['icon'] ): ?>
						<button type="submit" class="sina-button sina-subs-btn">
							<?php if ( $data['icon'] && 'left' == $data['icon_position'] ): ?>
								<i class="<?php echo esc_attr( $data['icon'] ); ?> sina-btn-icon-left"></i>
							<?php endif ?>

							<?php echo esc_html( $data['label'] ); ?>

							<?php if ( $data['icon'] && 'right' == $data['icon_position'] ): ?>
								<i class="<?php echo esc_attr( $data['icon'] ); ?> sina-btn-icon-right"></i>
							<?php endif ?>
						</button>
					<?php endif; ?>
				</div>
				<p class="sina-subs-success"></p>
				<p class="sina-subs-error"></p>
				<p class="sina-subs-process"><?php _e( 'Processing...', 'sina-ext' ); ?></p>
			</form><!-- .sina-subs-form -->
		</div><!-- .sina-form -->
		<?php
	}


	protected function _content_template() {

	}
}