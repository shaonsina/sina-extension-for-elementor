<?php

/**
 * Login Form Widget.
 *
 * @since 3.1.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Plugin;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Login_Form_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 3.1.0
	 */
	public function get_name() {
		return 'sina_login_form';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.1.0
	 */
	public function get_title() {
		return __( 'Sina Login Form', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.1.0
	 */
	public function get_icon() {
		return 'eicon-editor-external-link';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 3.1.0
	 */
	public function get_categories() {
		return [ 'sina-ext-advanced' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 3.1.0
	 */
	public function get_keywords() {
		return [ 'sina login form', 'sina form', 'sina email' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 3.1.0
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
	 * @since 3.1.0
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
	 * @since 3.1.0
	 * @access protected
	 */
	protected function _register_controls() {
		// Start Form Content
		// ====================
		$this->start_controls_section(
			'form_content',
			[
				'label' => __( 'Form Settings', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'email_placeholder',
			[
				'label' => __( 'Email Placeholder Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Placeholder Text', 'sina-ext' ),
				'default' => 'Enter Email *',
			]
		);
		$this->add_control(
			'password_placeholder',
			[
				'label' => __( 'Password Placeholder Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Placeholder Text', 'sina-ext' ),
				'default' => 'Enter Password *',
			]
		);
		$this->add_control(
			'redirect_url',
			[
				'label' => __( 'Redirect URL after login', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Redirect URL', 'sina-ext' ),
				'default' => admin_url(),
			]
		);
		$this->add_control(
			'remember_login',
			[
				'label' => __( 'Remember text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Remember Text', 'sina-ext' ),
				'default' => 'Keep me logged in',
			]
		);

		$this->end_controls_section();
		// End Form Content
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
		Sina_Common_Data::button_content($this, '.sina-login-btn', 'Log In', 'btn', false);
		$this->end_controls_section();
		// End Button Content
		// ====================


		// Start Fields Style
		// ====================
		$this->start_controls_section(
			'fields_style',
			[
				'label' => __( 'Fields & Remember text', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		Sina_Common_Data::input_fields_style( $this );
		$this->add_responsive_control(
			'fields_radius',
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
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-input-field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
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
				'selectors' => [
					'{{WRAPPER}} .sina-input-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'fields_margin',
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
					'{{WRAPPER}} .sina-input-field' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'remember',
			[
				'label' => __( 'Remember styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'position',
			[
				'label' => __( 'Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'middle' => __( 'Middle', 'sina-ext' ),
					'bottom' => __( 'Bottom', 'sina-ext' ),
				],
				'default' => 'middle',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'remember_typography',
				'selector' => '{{WRAPPER}} .sina-login-remember-wrap',
			]
		);
		$this->add_control(
			'remember_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-login-remember-wrap' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'remember_alignment',
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
					'{{WRAPPER}} .sina-login-remember-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Fields Style
		// ==================


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


		// Start Password Style
		// ===================
		$this->start_controls_section(
			'password_style',
			[
				'label' => __( 'Password', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::input_style( $this, '.sina-input-password', 'password' );
		$this->end_controls_section();
		// End Password Style
		// ====================


		// Start Button Style
		// =====================
		$this->start_controls_section(
			'btn_style',
			[
				'label' => __( 'Submit Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::button_style( $this, '.sina-login-btn' );
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
					'{{WRAPPER}} .sina-login-btn' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .sina-login-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'top' => '13',
					'right' => '25',
					'bottom' => '13',
					'left' => '25',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-login-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'top' => '20',
					'right' => '0',
					'bottom' => '20',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-login-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .sina-login-form' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Button Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$id = $this->get_id();
		?>
		<div class="sina-form">
			<form class="sina-login-form"
			data-uid="<?php echo esc_attr( $this->get_id() ); ?>"
			data-url="<?php echo esc_url( $data['redirect_url'] ); ?>">

				<input class="sina-input-field sina-input-email" type="email" placeholder="<?php echo esc_attr( $data['email_placeholder'] ); ?>" >
				<input class="sina-input-field sina-input-password" type="password" placeholder="<?php echo esc_attr( $data['password_placeholder'] ); ?>" >

				<?php if ( 'middle' == $data['position'] ): ?>
					<div class="sina-login-remember-wrap">
						<input id="<?php echo esc_attr( $id ); ?>" type="checkbox" class="sina-login-remember">
						<label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $data['remember_login'] ); ?></label>
					</div>
				<?php endif ?>

				<button type="submit" class="sina-button sina-login-btn <?php echo esc_attr( $data['btn_effect']); ?>">
					<?php Sina_Common_Data::button_html($data); ?>
				</button>

				<?php if ( 'bottom' == $data['position'] ): ?>
					<div class="sina-login-remember-wrap">
						<input id="<?php echo esc_attr( $id ); ?>" type="checkbox" class="sina-login-remember">
						<label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $data['remember_login'] ); ?></label>
					</div>
				<?php endif ?>

				<p class="sina-login-error"></p>

				<?php wp_nonce_field( 'sina_login', 'sina_login_nonce'.$this->get_id() ); ?>
			</form><!-- .sina-login-form -->
		</div><!-- .sina-form -->
		<?php
	}


	protected function _content_template() {

	}
}