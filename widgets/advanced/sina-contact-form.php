<?php

/**
 * Contact Form Widget.
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
use Elementor\Plugin;


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
				'label' => __( 'Form Settings', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'custom_email',
			[
				'label' => __( 'Use Custom Email', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'sina-ext' ),
				'label_off' => __( 'No', 'sina-ext' ),
			]
		);
		$this->add_control(
			'contact_email',
			[
				'label' => __( 'Mail To', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Custom Email', 'sina-ext' ),
				'description' => __( 'If the field is empty or enter an invalid email or try to send email from the editor, then the emails will send to the admin email. This email will work only in the front-end.', 'sina-ext' ),
				'condition' => [
					'custom_email' => 'yes',
				]
			]
		);
		$this->add_control(
			'fields',
			[
				'label' => __( 'Fields', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'name_placeholder',
			[
				'label' => __( 'Name Placeholder Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Placeholder Text', 'sina-ext' ),
				'default' => 'Enter Your Name *',
			]
		);
		$this->add_control(
			'email_placeholder',
			[
				'label' => __( 'Email Placeholder Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Placeholder Text', 'sina-ext' ),
				'default' => 'Enter Your Email *',
			]
		);
		$this->add_control(
			'sub_placeholder',
			[
				'label' => __( 'Subject Placeholder Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Placeholder Text', 'sina-ext' ),
				'default' => 'Enter Your Subject *',
			]
		);
		$this->add_control(
			'msg_placeholder',
			[
				'label' => __( 'Message Placeholder Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Placeholder Text', 'sina-ext' ),
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
				'label' => __( 'Submit Button', 'sina-ext' ),
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
		Sina_Common_Data::input_fields_style( $this );
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
		Sina_Common_Data::input_style( $this, '.sina-input-name', 'name' );
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
		Sina_Common_Data::input_style( $this, '.sina-input-email' );
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
		Sina_Common_Data::input_style( $this, '.sina-input-subject', 'subject' );
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
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => true,
				],
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
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '20',
					'left' => '0',
					'isLinked' => false,
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
		Sina_Common_Data::button_style( $this, '.sina-contact-btn' );
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
				'default' => [
					'top' => '4',
					'right' => '4',
					'bottom' => '4',
					'left' => '4',
					'isLinked' => true,
				],
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
				'desktop_default' => [
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
		$hash = '';
		if ( sanitize_email( $data['contact_email'] ) && !Plugin::instance()->editor->is_edit_mode() ) {
			$hash = md5( $data['contact_email'] );
			add_option( 'sina_contact_email'.$hash, $data['contact_email'] );
		}
		?>
		<div class="sina-form">
			<form class="sina-contact-form"
			data-inbox="<?php echo esc_attr( $hash ); ?>"
			data-uid="<?php echo esc_attr( $this->get_id() ); ?>">
				<?php include SINA_EXT_LAYOUT.'/contact-form/'.$data['form_layout'].'.php'; ?>

				<p class="sina-contact-success"></p>
				<p class="sina-contact-error"></p>
				<p class="sina-contact-process"><?php _e( 'Processing...', 'sina-ext' ); ?></p>

				<?php wp_nonce_field( 'sina_contact', 'sina_contact_nonce'.$this->get_id() ); ?>
			</form><!-- .sina-contact-form -->
		</div><!-- .sina-form -->
		<?php
	}


	protected function _content_template() {

	}
}