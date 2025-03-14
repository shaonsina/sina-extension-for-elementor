<?php

/**
 * Woo Cart Widget.
 *
 * @since 3.7.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Plugin;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Woo_Cart_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 3.7.0
	 */
	public function get_name() {
		return 'sina_woo_cart';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.7.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Woo Cart', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.7.0
	 */
	public function get_icon() {
		return 'eicon-basket-medium';
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
		return [ 'sina woo cart', 'sina cart', 'sina header', 'sina footer' ];
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
		$get_extenders 	= get_option( 'sina_extenders' );
		// Start Woo Cart
		// ===============
			$this->start_controls_section(
				'cart_content',
				[
					'label' => esc_html__( 'Woo Cart', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

				$this->add_control(
					'cart_badge_empty',
					[
						'label' => esc_html__( 'Hide Empty Badge', 'sina-ext' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'yes',
					]
				);
				$this->add_control(
					'subtotal',
					[
						'label' => esc_html__( 'Show Total Price', 'sina-ext' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'yes',
					]
				);

			$this->end_controls_section();
		// End Woo Cart
		// =============


		// Start Cart Button Style
		// ========================
			$selector = '.elementor-element-{{ID}} .sina-woo-cart-icon[data-counter]';
			$this->start_controls_section(
				'cart_style',
				[
					'label' => esc_html__( 'Cart Button', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

				Sina_Common_Data::link_style( $this, '.elementor-element-{{ID}} .sina-woo-cart-link', 'cart_btn' );
				$this->add_control(
					'cart_badge',
					[
						'label' => esc_html__( 'Cart Badge', 'sina-ext' ),
						'type' => Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$this->add_responsive_control(
					'cart_badge_top',
					[
						'label' => esc_html__( 'Top', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px'],
						'range' => [
							'px' => [
								'min' => -100,
							],
						],
						'default' => [
							'unit' => 'px',
							'size' => -5,
						],
						'selectors' => [
							$selector.':before' => 'top: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'cart_badge_right',
					[
						'label' => esc_html__( 'Right', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px'],
						'range' => [
							'px' => [
								'min' => -100,
							],
						],
						'default' => [
							'unit' => 'px',
							'size' => -5,
						],
						'selectors' => [
							$selector.':before' => 'right: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_control(
					'cart_badge_color',
					[
						'label' => esc_html__( 'Color', 'sina-ext' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#fff',
						'selectors' => [
							$selector.':before' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'cart_badge_bg',
					[
						'label' => esc_html__( 'Background Color', 'sina-ext' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#1085e4',
						'selectors' => [
							$selector.':before' => 'background-color: {{VALUE}};',
						],
					]
				);

			$this->end_controls_section();
		// End Cart Button Style
		// ======================

		if (!empty($get_extenders) && isset($get_extenders['sticky'])) {
			$selector = '.sina-pro-sticked .elementor-element-{{ID}} .sina-woo-cart-icon[data-counter]';
			// Start Sticky Cart Button Style
			// ===============================
				$this->start_controls_section(
					'sticky_cart_style',
					[
						'label' => esc_html__( 'Sticky Cart Button', 'sina-ext' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

				 Sina_Common_Data::link_style( $this, '.sina-pro-sticked .elementor-element-{{ID}} .sina-woo-cart-link', 'sticky_cart_btn' );
				 $this->add_control(
				 	'sticky_cart_badge',
				 	[
				 		'label' => esc_html__( 'Cart Badge', 'sina-ext' ),
				 		'type' => Controls_Manager::HEADING,
				 		'separator' => 'before',
				 	]
				 );
				 $this->add_control(
				 	'sticky_cart_badge_color',
				 	[
				 		'label' => esc_html__( 'Color', 'sina-ext' ),
				 		'type' => Controls_Manager::COLOR,
				 		'selectors' => [
				 			$selector.':before' => 'color: {{VALUE}};',
				 		],
				 	]
				 );
				 $this->add_control(
				 	'sticky_cart_badge_bg',
				 	[
				 		'label' => esc_html__( 'Background Color', 'sina-ext' ),
				 		'type' => Controls_Manager::COLOR,
				 		'selectors' => [
				 			$selector.':before' => 'background-color: {{VALUE}};',
				 		],
				 	]
				 );

				$this->end_controls_section();
			// End Sticky Cart Button Style
			// =============================
		}
	}


	protected function render() {
		if ( class_exists( 'WooCommerce' ) ):
			$data 	  = $this->get_settings_for_display();
			$woo_cart = \WC()->cart;

			if ( null === $woo_cart ) {
				return;
			}
			$classes = ('yes' == $data['cart_badge_empty']) ? 'sina-woo-badge-hide' : '';
			?>
			<div class="sina-woo-cart">
				<a class="sina-woo-cart-link" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
					<span class="sina-woo-cart-icon <?php echo esc_attr( $classes ) ?>" data-counter="<?php echo ( null !== $woo_cart ) ? esc_attr( $woo_cart->get_cart_contents_count() ) : ''; ?>">
						<i class="eicon-basket-medium"></i>
					</span>

					<?php if ( 'yes' == $data['subtotal'] && null !== $woo_cart ): ?>
						<span class="sina-woo-cart-subtotal">
							<?php echo wp_kses_post( $woo_cart->get_cart_subtotal() ); ?>
						</span>
					<?php endif; ?>
				</a>
			</div><!-- .sina-woo-cart -->
			<?php
		elseif(Plugin::$instance->editor->is_edit_mode()):
			printf('<p>%s</p>', esc_html__('Please install and activate the WooCommerce plugin to use this feature!', 'sina-ext') );
		endif;
	}


	protected function content_template() {

	}
}