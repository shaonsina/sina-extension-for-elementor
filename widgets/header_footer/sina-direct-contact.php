<?php

/**
 * Direct Contact Widget.
 *
 * @since 3.7.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Direct_Contact_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 3.7.0
	 */
	public function get_name() {
		return 'sina_direct_contact';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.7.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Direct Contact', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.7.0
	 */
	public function get_icon() {
		return 'fa fa-phone';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 3.7.0
	 */
	public function get_categories() {
		return [ 'sina-header-footer' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 3.7.0
	 */
	public function get_keywords() {
		return [ 'sina direct contact', 'sina contact', 'sina phone', 'sina email', 'sina header', 'sina footer' ];
	}

	public function get_icon_list() {
		return [
			'fa fa-phone' => 'phone',
			'fa fa-phone-square' => 'phone-square',
			'fa fa-envelope' => 'envelope',
			'fa fa-envelope-o' => 'envelope-o',
			'eicon-envelope' => 'eicon-envelope',
			'eicon-mail' => 'eicon-mail',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.7.0
	 * @access protected
	 */
	protected function register_controls() {
		$icon_list = $this->get_icon_list();
		$get_extenders 	= get_option( 'sina_extenders' );
		$selector = '.elementor-element-{{ID}} .sina-direct-contact';
		// Start Direct Contact
		// =====================
			$this->start_controls_section(
				'direct_contact_content',
				[
					'label' => esc_html__( 'Direct Contact', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

			$this->add_control(
				'display',
				[
					'label' => esc_html__( 'Display', 'sina-ext' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'inline' => esc_html__( 'Inline', 'sina-ext' ),
						'block' => esc_html__( 'Block', 'sina-ext' ),
						'' => esc_html__( 'Fixed', 'sina-ext' ),
					],
					'default' => 'inline',
				]
			);
			$this->add_control(
				'phone_number',
				[
					'label' => esc_html__( 'Phone Number', 'sina-ext' ),
					'type' => Controls_Manager::TEXT,
					'default' => '0123456789',
				]
			);
			$this->add_control(
				'phone_text',
				[
					'label' => esc_html__( 'Phone Text', 'sina-ext' ),
					'type' => Controls_Manager::TEXT,
					'default' => 'Call Now',
					'condition' => [
						'phone_number!' => '',
					]
				]
			);
			$this->add_control(
				'phone_icon',
				[
					'label' => esc_html__( 'Phone Icon', 'sina-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::ICON,
					'include' => $icon_list,
					'default' => 'fa fa-phone',
					'condition' => [
						'phone_number!' => '',
					]
				]
			);
			$this->add_control(
				'email_address',
				[
					'label' => esc_html__( 'Email Address', 'sina-ext' ),
					'type' => Controls_Manager::TEXT,
					'default' => 'example@host.com',
				]
			);
			$this->add_control(
				'email_text',
				[
					'label' => esc_html__( 'Email Text', 'sina-ext' ),
					'type' => Controls_Manager::TEXT,
					'default' => 'Email Us',
					'condition' => [
						'email_address!' => '',
					]
				]
			);
			$this->add_control(
				'email_icon',
				[
					'label' => esc_html__( 'Email Icon', 'sina-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::ICON,
					'include' => $icon_list,
					'default' => 'fa fa-envelope-o',
					'condition' => [
						'email_address!' => '',
					]
				]
			);

			$this->end_controls_section();
		// End Direct Contact
		// ===================


		// Start Phone Style
		// ==================
			$this->start_controls_section(
				'phone_style',
				[
					'label' => esc_html__( 'Phone', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

				$this->add_control(
					'phone_icon_position',
					[
						'label' => esc_html__( 'Position', 'sina-ext' ),
						'type' => Controls_Manager::CHOOSE,
						'options' => [
							'left' => [
								'title' => esc_html__( 'Left', 'sina-ext' ),
								'icon' => 'eicon-h-align-left',
							],
							'right' => [
								'title' => esc_html__( 'Right', 'sina-ext' ),
								'icon' => 'eicon-h-align-right',
							],
						],
						'condition' => [
							'display' => '',
						],
						'default' => 'right',
					]
				);
				$this->add_control(
					'phone_icon_v_spacing',
					[
						'label' => esc_html__( 'Bottom Spacing', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em', '%' ],
						'range' => [
							'px' => [
								'max' => 500,
							],
							'em' => [
								'max' => 50,
							],
						],
						'default' => [
							'unit' => 'px',
							'size' => 25,
						],
						'condition' => [
							'display' => '',
						],
						'selectors' => [
							$selector.' .sina-dc-phone' => 'bottom: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_control(
					'phone_icon_h_spacing',
					[
						'label' => esc_html__( 'Left/Right Spacing', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em', '%' ],
						'range' => [
							'px' => [
								'max' => 500,
							],
							'em' => [
								'max' => 50,
							],
						],
						'default' => [
							'unit' => 'px',
							'size' => 25,
						],
						'condition' => [
							'display' => '',
						],
						'selectors' => [
							$selector.' .sina-dc-phone' => '{{phone_icon_position.VALUE || "right"}}: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_control(
					'phone_z_index',
					[
						'label' => esc_html__( 'Z-Index', 'sina-ext' ),
						'type' => Controls_Manager::NUMBER,
						'default' => 9999,
						'step' => -1,
						'min' => 1,
						'max' => 999999,
						'condition' => [
							'display' => '',
						],
						'selectors' => [
							$selector.' .sina-dc-phone' => 'z-index: {{SIZE}};',
						],
					]
				);
				Sina_Common_Data::link_style( $this, $selector.' .sina-dc-phone', 'phone_text' );
			$this->end_controls_section();
		// End Phone Style
		// ================

		// Start Phone Icon Style
		// =======================
			$this->start_controls_section(
				'phone_icon_style',
				[
					'label' => esc_html__( 'Phone Icon', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
				$this->add_responsive_control(
					'phone_icon_spacing',
					[
						'label' => esc_html__( 'Icon Spacing', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em', '%' ],
						'range' => [
							'px' => [
								'max' => 500,
							],
							'em' => [
								'max' => 50,
							],
						],
						'default' => [
							'unit' => 'px',
							'size' => 5,
						],
						'selectors' => [
							$selector.' .sina-dc-phone i' => 'margin-right: {{SIZE}}{{UNIT}};',
							'.rtl '.$selector.' .sina-dc-phone i' => 'margin-right: auto;',
							'.rtl '.$selector.' .sina-dc-phone i' => 'margin-left: {{SIZE}}{{UNIT}};',
						],
					]
				);
				Sina_Common_Data::icon_style( $this, $selector.' .sina-dc-phone i', 'phone_icon' );
			$this->end_controls_section();
		// End Phone Icon Style
		// =====================

		// Start Email Style
		// ==================
			$this->start_controls_section(
				'email_style',
				[
					'label' => esc_html__( 'Email', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
				$this->add_control(
					'email_icon_position',
					[
						'label' => esc_html__( 'Icon Position', 'sina-ext' ),
						'type' => Controls_Manager::CHOOSE,
						'options' => [
							'left' => [
								'title' => esc_html__( 'Left', 'sina-ext' ),
								'icon' => 'eicon-h-align-left',
							],
							'right' => [
								'title' => esc_html__( 'Right', 'sina-ext' ),
								'icon' => 'eicon-h-align-right',
							],
						],
						'condition' => [
							'display' => '',
						],
						'default' => 'left',
					]
				);
				$this->add_control(
					'email_icon_v_spacing',
					[
						'label' => esc_html__( 'Bottom Spacing', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em', '%' ],
						'range' => [
							'px' => [
								'max' => 500,
							],
							'em' => [
								'max' => 50,
							],
						],
						'default' => [
							'unit' => 'px',
							'size' => 25,
						],
						'condition' => [
							'display' => '',
						],
						'selectors' => [
							$selector.' .sina-dc-email' => 'bottom: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_control(
					'email_icon_h_spacing',
					[
						'label' => esc_html__( 'Left/Right Spacing', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em', '%' ],
						'range' => [
							'px' => [
								'max' => 500,
							],
							'em' => [
								'max' => 50,
							],
						],
						'default' => [
							'unit' => 'px',
							'size' => 25,
						],
						'condition' => [
							'display' => '',
						],
						'selectors' => [
							$selector.' .sina-dc-email' => '{{email_icon_position.VALUE || "right"}}: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_control(
					'email_z_index',
					[
						'label' => esc_html__( 'Z-Index', 'sina-ext' ),
						'type' => Controls_Manager::NUMBER,
						'default' => 9999,
						'step' => -1,
						'min' => 1,
						'max' => 999999,
						'condition' => [
							'display' => '',
						],
						'selectors' => [
							$selector.' .sina-dc-email' => 'z-index: {{SIZE}};',
						],
					]
				);
				Sina_Common_Data::link_style( $this, $selector.' .sina-dc-email', 'email_text' );
			$this->end_controls_section();
		// End Email Style
		// ================

		// Start Email Icon Style
		// =======================
			$this->start_controls_section(
				'email_icon_style',
				[
					'label' => esc_html__( 'Email Icon', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

				$this->add_responsive_control(
					'email_icon_spacing',
					[
						'label' => esc_html__( 'Icon Spacing', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em', '%' ],
						'range' => [
							'px' => [
								'max' => 500,
							],
							'em' => [
								'max' => 50,
							],
						],
						'default' => [
							'unit' => 'px',
							'size' => 5,
						],
						'selectors' => [
							$selector.' .sina-dc-email i' => 'margin-right: {{SIZE}}{{UNIT}};',
							'.rtl '.$selector.' .sina-dc-email i' => 'margin-right: auto;',
							'.rtl '.$selector.' .sina-dc-email i' => 'margin-left: {{SIZE}}{{UNIT}};',
						],
					]
				);
				Sina_Common_Data::icon_style( $this, $selector.' .sina-dc-email i', 'email_icon' );
			$this->end_controls_section();
		// End Email Icon Style
		// =====================


		if (!empty($get_extenders) && isset($get_extenders['sticky'])) {
			$selector = '.sina-pro-sticked '.$selector;
			// Start Phone Style
			// ==================
				$this->start_controls_section(
					'sticky_phone_style',
					[
						'label' => esc_html__( 'Sticky Phone', 'sina-ext' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);
				Sina_Common_Data::link_style( $this, $selector.' .sina-dc-phone', 'sticky_phone_text' );
				$this->end_controls_section();
			// End Phone Style
			// ================

			// Start Phone Icon Style
			// =======================
				$this->start_controls_section(
					'sticky_phone_icon_style',
					[
						'label' => esc_html__( 'Sticky Phone Icon', 'sina-ext' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);
					$this->add_responsive_control(
						'sticky_phone_icon_spacing',
						[
							'label' => esc_html__( 'Icon Spacing', 'sina-ext' ),
							'type' => Controls_Manager::SLIDER,
							'size_units' => [ 'px', 'em', '%' ],
							'range' => [
								'px' => [
									'max' => 500,
								],
								'em' => [
									'max' => 50,
								],
							],
							'default' => [
								'unit' => 'px',
								'size' => 5,
							],
							'selectors' => [
								$selector.' .sina-dc-phone i' => 'margin-right: {{SIZE}}{{UNIT}};',
								'.rtl '.$selector.' .sina-dc-phone i' => 'margin-right: auto;',
								'.rtl '.$selector.' .sina-dc-phone i' => 'margin-left: {{SIZE}}{{UNIT}};',
							],
						]
					);
					Sina_Common_Data::icon_style( $this, $selector.' .sina-dc-phone i', 'sticky_phone_icon' );
				$this->end_controls_section();
			// End Phone Icon Style
			// =====================

			// Start Email Style
			// ==================
				$this->start_controls_section(
					'sticky_email_style',
					[
						'label' => esc_html__( 'Sticky Email', 'sina-ext' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);
				Sina_Common_Data::link_style( $this, $selector.' .sina-dc-email', 'sticky_email_text' );
				$this->end_controls_section();
			// End Email Style
			// ================

			// Start Email Icon Style
			// =======================
				$this->start_controls_section(
					'sticky_email_icon_style',
					[
						'label' => esc_html__( 'Sticky Email Icon', 'sina-ext' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

					$this->add_responsive_control(
						'sticky_email_icon_spacing',
						[
							'label' => esc_html__( 'Icon Spacing', 'sina-ext' ),
							'type' => Controls_Manager::SLIDER,
							'size_units' => [ 'px', 'em', '%' ],
							'range' => [
								'px' => [
									'max' => 500,
								],
								'em' => [
									'max' => 50,
								],
							],
							'default' => [
								'unit' => 'px',
								'size' => 5,
							],
							'selectors' => [
								$selector.' .sina-dc-email i' => 'margin-right: {{SIZE}}{{UNIT}};',
								'.rtl '.$selector.' .sina-dc-email i' => 'margin-right: auto;',
								'.rtl '.$selector.' .sina-dc-email i' => 'margin-left: {{SIZE}}{{UNIT}};',
							],
						]
					);
					Sina_Common_Data::icon_style( $this, $selector.' .sina-dc-email i', 'sticky_email_icon' );
				$this->end_controls_section();
			// End Email Icon Style
			// =====================
		}
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$classes = 'sina-fixed';
		if ('inline' == $data['display']) {
			$classes = 'sina-inline';
		} elseif ('block' == $data['display']) {
			$classes = 'sina-block';
		}
		?>
		<div class="sina-direct-contact">
			<?php if ($data['phone_number']): ?>
				<a href="tel:<?php echo esc_url( $data['phone_number'] ); ?>" class="sina-dc-phone <?php echo esc_attr( $classes ); ?>">
					<?php if ($data['phone_icon']): ?>
						<i class="<?php echo esc_attr( $data['phone_icon'] ); ?>"></i>
					<?php endif ?>

					<?php if ($data['phone_text']): ?>
						<span><?php echo esc_html( $data['phone_text'] ); ?></span>
					<?php endif ?>
				</a>
			<?php endif ?>

			<?php if ($data['email_address']): ?>
				<a href="mailto:<?php echo esc_url( $data['email_address'] ); ?>" class="sina-dc-email <?php echo esc_attr( $classes ); ?>">
					<?php if ($data['email_icon']): ?>
						<i class="<?php echo esc_attr( $data['email_icon'] ); ?>"></i>
					<?php endif ?>

					<?php if ($data['email_text']): ?>
						<span><?php echo esc_html( $data['email_text'] ); ?></span>
					<?php endif ?>
				</a>
			<?php endif ?>
		</div><!-- .sina-direct-contact -->
		<?php
	}


	protected function content_template() {

	}
}