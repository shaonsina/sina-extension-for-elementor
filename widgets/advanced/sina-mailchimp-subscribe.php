<?php

/**
 * Mailchim Widget.
 *
 * @since 1.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Mailchimp_Subscribe_Widget extends Widget_Base{

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
		return esc_html__( 'Sina MailChimp', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-call-to-action';
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
			'icofont',
			'font-awesome',
			'elementor-icons',
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
	protected function register_controls() {
		// Start Fields Content
		// =====================
		$this->start_controls_section(
			'fields_content',
			[
				'label' => esc_html__( 'Fields', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'api_url',
			[
				'label' => 'If you would like to change the API key <a target="_blank" href="admin.php?page=sina_ext_settings">click here</a>',
				'type' => Controls_Manager::RAW_HTML,
				'separator' => 'after',
			]
		);
		$this->add_control(
			'email_placeholder',
			[
				'label' => esc_html__( 'Email placeholder text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter placeholder text', 'sina-ext' ),
				'default' => 'Enter Email',
			]
		);
		$this->add_control(
			'successs_message',
			[
				'label' => esc_html__( 'Success Message', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Success Message', 'sina-ext' ),
				'default' => 'Thanks for subscribed!',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'process_text',
			[
				'label' => esc_html__( 'Processing Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Processing Text', 'sina-ext' ),
				'default' => 'Processing...',
			]
		);
		$this->add_control(
			'fname',
			[
				'label' => esc_html__( 'First Name', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before'
			]
		);
		$this->add_control(
			'fname_placeholder',
			[
				'label' => esc_html__( 'First name placeholder text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter placeholder text', 'sina-ext' ),
				'condition' => [
					'fname!' => '',
				],
				'default' => 'Enter First Name',
			]
		);
		$this->add_control(
			'lname',
			[
				'label' => esc_html__( 'Last Name', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before'
			]
		);
		$this->add_control(
			'lname_placeholder',
			[
				'label' => esc_html__( 'Last name placeholder text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter placeholder text', 'sina-ext' ),
				'condition' => [
					'lname!' => '',
				],
				'default' => 'Enter Last Name',
			]
		);
		$this->add_control(
			'phone',
			[
				'label' => esc_html__( 'Phone Number', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before'
			]
		);
		$this->add_control(
			'phone_placeholder',
			[
				'label' => esc_html__( 'Phone placeholder text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter placeholder text', 'sina-ext' ),
				'condition' => [
					'phone!' => '',
				],
				'default' => 'Enter Phone Number',
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
				'label' => esc_html__( 'Submit Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		Sina_Common_Data::button_content($this, '.sina-subs-btn', 'Subscribe', 'btn', false);
		$this->end_controls_section();
		// End Button Content
		// =====================


		// Start Fields Style
		// =====================
		$this->start_controls_section(
			'fields_style',
			[
				'label' => esc_html__( 'Fields', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'display',
			[
				'label' => esc_html__( 'Display', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'inline-block' => esc_html__( 'Inline', 'sina-ext' ),
					'block' => esc_html__( 'Block', 'sina-ext' ),
				],
				'default' => 'inline-block',
			]
		);
		Sina_Common_Data::input_fields_style( $this );
		$this->add_responsive_control(
			'fields_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => true,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-input-field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'fields_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '10',
					'right' => '12',
					'bottom' => '10',
					'left' => '12',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-input-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'fields_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
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
					'{{WRAPPER}} .sina-input-field' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'label' => esc_html__( 'First Name', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'fname!' => '',
				],
			]
		);
		Sina_Common_Data::input_style( $this, '.sina-input-fname', 'fname' );
		$this->end_controls_section();
		// End First Name Style
		// ========================


		// Start Last Name Style
		// =======================
		$this->start_controls_section(
			'lname_style',
			[
				'label' => esc_html__( 'Last Name', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'lname!' => '',
				],
			]
		);
		Sina_Common_Data::input_style( $this, '.sina-input-lname', 'lname' );
		$this->end_controls_section();
		// End Last Name Style
		// ========================


		// Start Email Style
		// ===================
		$this->start_controls_section(
			'email_style',
			[
				'label' => esc_html__( 'Email', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::input_style( $this, '.sina-input-email' );
		$this->end_controls_section();
		// End Email Style
		// =================


		// Start Phone Style
		// ===================
		$this->start_controls_section(
			'phone_style',
			[
				'label' => esc_html__( 'Phone', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'phone!' => '',
				],
			]
		);
		Sina_Common_Data::input_style( $this, '.sina-input-phone', 'phone' );
		$this->end_controls_section();
		// End Phone Style
		// =====================


		// Start Button Style
		// =====================
		$this->start_controls_section(
			'btn_style',
			[
				'label' => esc_html__( 'Submit Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::button_style( $this, '.sina-subs-btn' );
		$this->add_responsive_control(
			'btn_width',
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
					'{{WRAPPER}} .sina-subs-btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
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
					'{{WRAPPER}} .sina-subs-btn, {{WRAPPER}} .sina-subs-btn:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '13',
					'right' => '25',
					'bottom' => '13',
					'left' => '25',
					'isLinked' => false,
				],
				'mobile_default' => [
					'top' => '13',
					'right' => '15',
					'bottom' => '13',
					'left' => '15',
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
				'label' => esc_html__( 'Margin', 'sina-ext' ),
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
				'condition' => [
					'display!' => 'inline-block',
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .sina-subs-form' => 'text-align: {{VALUE}};',
				],
			]
		);
		Sina_Common_Data::BG_hover_effects($this, '.sina-button', 'btn_bg_layer');

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
			data-uid="<?php echo esc_attr( $this->get_id() ); ?>">
				<div class="sina-subs-input">
					<?php if ( $data['fname'] ): ?>
						<input class="sina-input-field sina-input-fname <?php echo esc_attr( $display_class ); ?>" type="text" placeholder="<?php echo esc_attr( $data['fname_placeholder'] ); ?>">
					<?php endif; ?>

					<?php if ( $data['lname'] ): ?>
						<input class="sina-input-field sina-input-lname <?php echo esc_attr( $display_class ); ?>" type="text" placeholder="<?php echo esc_attr( $data['lname_placeholder'] ); ?>">
					<?php endif; ?>

					<input class="sina-input-field sina-input-email <?php echo esc_attr( $display_class ); ?>" type="email" placeholder="<?php echo esc_attr( $data['email_placeholder'] ); ?> *">

					<?php if ( $data['phone'] ): ?>
						<input class="sina-input-field sina-input-phone <?php echo esc_attr( $display_class ); ?>" type="tel" placeholder="<?php echo esc_attr( $data['phone_placeholder'] ); ?>">
					<?php endif; ?>

					<button type="submit" class="sina-button sina-subs-btn <?php echo esc_attr( $data['btn_effect'].' '.$data['btn_bg_layer_effects'] ); ?>">
						<?php Sina_Common_Data::button_html($data); ?>
					</button>
				</div>

				<?php printf('<p class="sina-success-text">%s</p>', $data['successs_message']); ?>
				<p class="sina-error-text"></p>
				<p class="sina-process-text"><?php printf('%s', $data['process_text']); ?></p>

				<?php wp_nonce_field( 'sina_mc_subscribe', 'sina_mc_subscribe_nonce'.$this->get_id() ); ?>
			</form><!-- .sina-subs-form -->
		</div><!-- .sina-form -->
		<?php
	}


	protected function content_template() {

	}
}