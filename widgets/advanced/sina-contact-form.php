<?php

/**
 * Contact Form Widget.
 *
 * @since 1.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Plugin;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Contact_Form_Widget extends Widget_Base{

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
		return esc_html__( 'Sina Contact Form', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-mail';
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
		return [ 'sina contact form', 'sina form', 'sina email' ];
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
			'sina-google-recaptcha-api',
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
		// Start Name Content
		// ====================
		$this->start_controls_section(
			'form_content',
			[
				'label' => esc_html__( 'Form Settings', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'is_recaptcha',
			[
				'label' => esc_html__( 'Google Recaptcha', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'recaptcha_key',
			[
				'label' => 'For add/change the <strong>Site Key</strong> & <strong>Secret Key</strong><br><a target="_blank" href="admin.php?page=sina_ext_settings">click here</a>',
				'type' => Controls_Manager::RAW_HTML,
				'condition' => [
					'is_recaptcha' => 'yes',
				],
			]
		);
		$this->add_control(
			'custom_email',
			[
				'label' => esc_html__( 'Use Custom Email', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext' ),
				'label_off' => esc_html__( 'No', 'sina-ext' ),
			]
		);
		$this->add_control(
			'contact_email',
			[
				'label' => esc_html__( 'Mail To', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Custom Email', 'sina-ext' ),
				'description' => esc_html__( 'If the field is empty or enter an invalid email or try to send email from the editor, then the emails will send to the admin email. This email will work only in the front-end.', 'sina-ext' ),
				'condition' => [
					'custom_email' => 'yes',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'from_text',
			[
				'label' => esc_html__( 'From: ', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter From Address', 'sina-ext' ),
			]
		);
		$this->add_control(
			'successs_message',
			[
				'label' => esc_html__( 'Success Message', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Success Message', 'sina-ext' ),
				'default' => 'Thanks for sending Email!',
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
			'fields',
			[
				'label' => esc_html__( 'Fields', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'name_placeholder',
			[
				'label' => esc_html__( 'Name Placeholder Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Placeholder Text', 'sina-ext' ),
				'default' => 'Enter Your Name *',
			]
		);
		$this->add_control(
			'email_placeholder',
			[
				'label' => esc_html__( 'Email Placeholder Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Placeholder Text', 'sina-ext' ),
				'default' => 'Enter Your Email *',
			]
		);
		$this->add_control(
			'sub_placeholder',
			[
				'label' => esc_html__( 'Subject Placeholder Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Placeholder Text', 'sina-ext' ),
				'default' => 'Enter Your Subject *',
			]
		);
		$this->add_control(
			'msg_placeholder',
			[
				'label' => esc_html__( 'Message Placeholder Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Placeholder Text', 'sina-ext' ),
				'default' => 'Enter Your Message *',
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
				'label' => esc_html__( 'Submit Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		Sina_Common_Data::button_content($this, '.sina-contact-btn', 'Send', 'btn', false);
		$this->end_controls_section();
		// End Button Content
		// ====================


		// Start Fields Style
		// ====================
		$this->start_controls_section(
			'fields_style',
			[
				'label' => esc_html__( 'Fields', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'form_layout',
			[
				'label' => esc_html__( 'Layout', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'layout1' => esc_html__( 'Layout 1', 'sina-ext' ),
					'layout2' => esc_html__( 'Layout 2', 'sina-ext' ),
				],
				'default' => 'layout2',
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
		// ==================


		// Start Name Style
		// ==================
		$this->start_controls_section(
			'name_style',
			[
				'label' => esc_html__( 'Name', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::input_style( $this, '.sina-input-name', 'name' );
		$this->end_controls_section();
		// End Name Style
		// ================


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


		// Start Subject Style
		// =====================
		$this->start_controls_section(
			'subject_style',
			[
				'label' => esc_html__( 'Subject', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::input_style( $this, '.sina-input-subject', 'subject' );
		$this->end_controls_section();
		// End Subject Style
		// =====================


		// Start Message Style
		// =====================
		$this->start_controls_section(
			'message_style',
			[
				'label' => esc_html__( 'Message', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'message_height',
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
					'size' => '178',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-input-message' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'message_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-input-message' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'message_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-input-message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'label' => esc_html__( 'Submit Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::button_style( $this, '.sina-contact-btn' );
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
					'{{WRAPPER}} .sina-contact-btn' => 'width: {{SIZE}}{{UNIT}};',
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
					'top' => '4',
					'right' => '4',
					'bottom' => '4',
					'left' => '4',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-contact-btn, {{WRAPPER}} .sina-contact-btn:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selectors' => [
					'{{WRAPPER}} .sina-contact-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'top' => '20',
					'right' => '0',
					'bottom' => '20',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-contact-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selectors' => [
					'{{WRAPPER}} .sina-contact-form' => 'text-align: {{VALUE}};',
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
		$hash = '';
		if ( sanitize_email( $data['contact_email'] ) && !Plugin::instance()->editor->is_edit_mode() ) {
			$hash = md5( $data['contact_email'] );
			add_option( 'sina_contact_email'.$hash, $data['contact_email'] );
		}
		$recaptcha_key = get_option( 'sina_ext_pro_recaptcha_key' );
		?>
		<div class="sina-form">
			<form class="sina-contact-form"
			data-uid="<?php echo esc_attr( $this->get_id() ); ?>"
			data-from="<?php echo esc_attr( $data['from_text'] ); ?>"
			data-inbox="<?php echo esc_attr( $hash ); ?>"
			data-captcha="<?php echo esc_attr( $data['is_recaptcha'] ); ?>">
				<?php include SINA_EXT_LAYOUT.'/contact-form/'.$data['form_layout'].'.php'; ?>

				<?php printf('<p class="sina-success-text">%s</p>', $data['successs_message']); ?>
				<p class="sina-error-text"></p>
				<p class="sina-process-text"><?php printf('%s', $data['process_text']); ?></p>

				<?php wp_nonce_field( 'sina_contact', 'sina_contact_nonce'.$this->get_id() ); ?>
			</form><!-- .sina-contact-form -->
		</div><!-- .sina-form -->
		<?php
	}


	protected function content_template() {

	}
}