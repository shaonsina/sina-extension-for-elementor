<?php

/**
 * Contact Form Widget.
 *
 * @since 1.0.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Contact_Form_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_contact_form';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return __( 'Sina Contact Form', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'fa fa-envelope-o';
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
		return [ 'sina contact form', 'sina form' ];
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
		// Start Name Content
		// ====================
		$this->start_controls_section(
			'form_content',
			[
				'label' => __( 'Fields', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'name_placeholder',
			[
				'label' => __( 'Name Placeholder Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Placeholder Text', 'sina-ext' ),
				'default' => __( 'Enter Your Name *', 'sina-ext' ),
			]
		);
		$this->add_control(
			'email_placeholder',
			[
				'label' => __( 'Email Placeholder Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Placeholder Text', 'sina-ext' ),
				'default' => __( 'Enter Your Email *', 'sina-ext' ),
			]
		);
		$this->add_control(
			'sub_placeholder',
			[
				'label' => __( 'Subject Placeholder Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Placeholder Text', 'sina-ext' ),
				'default' => __( 'Enter Your Subject *', 'sina-ext' ),
			]
		);
		$this->add_control(
			'msg_placeholder',
			[
				'label' => __( 'Message Placeholder Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Placeholder Text', 'sina-ext' ),
				'default' => __( 'Enter Your Message *', 'sina-ext' ),
			]
		);

		$this->end_controls_section();
		// End Message Content
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
				'default' => 'Send',
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
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-btn-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sina-btn-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Button Content
		// ====================


		// Start Fields Style
		// ====================
		$this->start_controls_section(
			'fields_style',
			[
				'label' => __( 'Fields', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'form_layout',
			[
				'label' => __( 'Layout', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'layout1' => __( 'Layout 1', 'sina-ext' ),
					'layout2' => __( 'Layout 2', 'sina-ext' ),
				],
				'default' => 'layout2',
			]
		);
		$this->add_control(
			'placeholder_color',
			[
				'label' => __( 'Placeholder Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#aaa',
				'selectors' => [
					'{{WRAPPER}} .sina-contact-input .sina-input-field::-webkit-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .sina-contact-input .sina-input-field::-moz-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .sina-contact-input .sina-input-field::-ms-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .sina-contact-input .sina-input-field::placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs( 'fields_tabs' );

		$this->start_controls_tab(
			'fields_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_control(
			'color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#111',
				'selectors' => [
					'{{WRAPPER}} .sina-contact-input .sina-input-field' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .sina-contact-input .sina-input-field' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .sina-contact-input .sina-input-field',
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
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-contact-input .sina-input-field:focus' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'focus_background',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-contact-input .sina-input-field:focus' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'focus_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-contact-input .sina-input-field:focus' => 'border-color: {{VALUE}}'
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
				'range' => [
					'px' => [
						'max' => 500,
						'step' => 1,
					],
					'em' => [
						'max' => 20,
						'step' => 1,
					],
					'%' => [
						'max' => 50,
						'step' => 1,
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-input-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Fields Style
		// ==================


		// Start Name Style
		// ==================
		$this->start_controls_section(
			'name_style',
			[
				'label' => __( 'Name', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'name_width',
			[
				'label' => __( 'Width', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 500,
						'step' => 1,
					],
					'em' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 5,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-contact-input .sina-input-name' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'name_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-contact-input .sina-input-name' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'name_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 500,
						'step' => 1,
					],
					'em' => [
						'max' => 20,
						'step' => 1,
					],
					'%' => [
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-contact-input .sina-input-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Name Style
		// ================


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
						'min' => 100,
						'max' => 500,
						'step' => 1,
					],
					'em' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 5,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-contact-input .sina-input-email' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'email_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-contact-input .sina-input-email' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'email_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 500,
						'step' => 1,
					],
					'em' => [
						'max' => 20,
						'step' => 1,
					],
					'%' => [
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-contact-input .sina-input-email' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Email Style
		// =================


		// Start Subject Style
		// =====================
		$this->start_controls_section(
			'subject_style',
			[
				'label' => __( 'Subject', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'subject_width',
			[
				'label' => __( 'Width', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 500,
						'step' => 1,
					],
					'em' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 5,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-contact-input .sina-input-subject' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'subject_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-contact-input .sina-input-subject' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'subject_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 500,
						'step' => 1,
					],
					'em' => [
						'max' => 20,
						'step' => 1,
					],
					'%' => [
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-contact-input .sina-input-subject' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Subject Style
		// =====================


		// Start Message Style
		// =====================
		$this->start_controls_section(
			'message_style',
			[
				'label' => __( 'Message', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'message_height',
			[
				'label' => __( 'Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 500,
						'step' => 1,
					],
					'em' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 5,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-contact-input .sina-input-message' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'message_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-contact-input .sina-input-message' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'message_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 500,
						'step' => 1,
					],
					'em' => [
						'max' => 20,
						'step' => 1,
					],
					'%' => [
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-contact-input .sina-input-message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Message Style
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
				'selector' => '{{WRAPPER}} .sina-contact-btn',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'btn_text_shadow',
				'selector' => '{{WRAPPER}} .sina-contact-btn',
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
			'btn_background',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-contact-btn' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'btn_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-contact-btn' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_border',
				'selector' => '{{WRAPPER}} .sina-contact-btn',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_shadow',
				'selector' => '{{WRAPPER}} .sina-contact-btn',
				'separator' => 'before',
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
			'hover_background',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-contact-btn:hover' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'hover_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-contact-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'hover_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-contact-btn:hover' => 'border-color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-contact-btn:hover',
				'separator' => 'before',
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
						'min' => 100,
						'max' => 1000,
						'step' => 1,
					],
					'em' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-contact-btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-contact-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'max' => 20,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-contact-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'selectors' => [
					'{{WRAPPER}} .sina-contact-form' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Button Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-form">
			<form class="sina-contact-form"
			data-uid="<?php echo esc_attr( $this->get_id() ); ?>">
				<?php if ( 'layout1' == $data['form_layout'] ) : ?>
					<div class="sina-contact-input">
						<input class="sina-input-field sina-input-name" type="text" name="text" placeholder="<?php echo esc_attr( $data['name_placeholder'] ); ?>" >
						<input class="sina-input-field sina-input-email" type="email" name="email" placeholder="<?php echo esc_attr( $data['email_placeholder'] ); ?>" >
						<input class="sina-input-field sina-input-subject" type="text" name="subject" placeholder="<?php echo esc_attr( $data['sub_placeholder'] ); ?>" >
						<textarea class="sina-input-field sina-input-block sina-input-message" placeholder="<?php echo esc_attr( $data['msg_placeholder'] ); ?>"></textarea>
						<button type="submit" class="sina-button sina-contact-btn">
							<?php if ( $data['icon'] && 'left' == $data['icon_position'] ): ?>
								<i class="<?php echo esc_attr( $data['icon'] ); ?> sina-btn-icon-left"></i>
							<?php endif ?>
							<span <?php echo $this->get_render_attribute_string( 'label' ); ?>>
								<?php echo esc_html( $data['label'] ); ?>
							</span>
							<?php if ( $data['icon'] && 'right' == $data['icon_position'] ): ?>
								<i class="<?php echo esc_attr( $data['icon'] ); ?> sina-btn-icon-right"></i>
							<?php endif ?>
						</button>
					</div>
					<p class="sina-contact-success"></p>
					<p class="sina-contact-error"></p>
					<p class="sina-contact-process"><?php _e( 'Processing...', 'sina-ext' ); ?></p>
				<?php else : ?>
					<div class="sina-contact-input">
						<div class="sina-contact-input-half">
							<input class="sina-input-field sina-input-block sina-input-name" type="text" name="name" placeholder="<?php echo esc_attr( $data['name_placeholder'] ); ?>" >
							<input class="sina-input-field sina-input-block sina-input-email" type="email" name="email" placeholder="<?php echo esc_attr( $data['email_placeholder'] ); ?>" >
							<input class="sina-input-field sina-input-block sina-input-subject" type="text" name="subject" placeholder="<?php echo esc_attr( $data['sub_placeholder'] ); ?>" >
						</div>
						<div class="sina-contact-input-half">
							<textarea class="sina-input-field sina-input-block sina-input-message" placeholder="<?php echo esc_attr( $data['msg_placeholder'] ); ?>"></textarea>
						</div>
					</div>
					<div class="sina-contact-input">
						<button type="submit" class="sina-button sina-contact-btn">
							<?php if ( $data['icon'] && 'left' == $data['icon_position'] ): ?>
								<i class="<?php echo esc_attr( $data['icon'] ); ?> sina-btn-icon-left"></i>
							<?php endif ?>
							<span <?php echo $this->get_render_attribute_string( 'label' ); ?>>
								<?php echo esc_html( $data['label'] ); ?>
							</span>
							<?php if ( $data['icon'] && 'right' == $data['icon_position'] ): ?>
								<i class="<?php echo esc_attr( $data['icon'] ); ?> sina-btn-icon-right"></i>
							<?php endif ?>
						</button>
					</div>
					<p class="sina-contact-success"></p>
					<p class="sina-contact-error"></p>
					<p class="sina-contact-process"><?php _e( 'Processing...', 'sina-ext' ); ?></p>
				<?php endif; ?>

				<?php wp_nonce_field( 'sina_contact', 'sina_contact_nonce'.$this->get_id() ); ?>
			</form><!-- .sina-contact-form -->
		</div><!-- .sina-form -->
		<?php
	}


	protected function _content_template() {

	}
}