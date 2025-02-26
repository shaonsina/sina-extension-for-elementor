<?php

/**
 * Woo Cart Widget.
 *
 * @since 3.7.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;


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
		return 'eicon-cart-medium';
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
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 3.7.0
	 */
	public function get_style_depends() {
		return [
			'sina-widgets',
		];
	}

	public function get_icon_list() {
		return [
			'icofont icofont-ui-cart' => 'icofont-ui-cart',
			'icofont icofont-opencart' => 'icofont-opencart',
			'icofont icofont-cart-alt' => 'icofont-cart-alt',
			'icofont icofont-cart' => 'icofont-cart',
			'icofont icofont-shopping-cart' => 'icofont-shopping-cart',
			'fa fa-opencart' => 'opencart',
			'fa fa-shopping-cart' => 'shopping-cart',
			'eicon-cart' => 'eicon-cart',
			'eicon-cart-light' => 'eicon-cart-light',
			'eicon-cart-medium' => 'eicon-cart-medium',
			'eicon-cart-solid' => 'eicon-cart-solid',
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
		$get_extenders 	= get_option( 'sina_extenders' );
		// Start Woo Cart
		// ===============
			$this->start_controls_section(
				'woo_cart_content',
				[
					'label' => esc_html__( 'Woo Cart', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

				$this->add_control(
					'cart_icon',
					[
						'label' => esc_html__( 'Cart Icon', 'sina-ext' ),
						'label_block' => true,
						'type' => Controls_Manager::ICON,
						'include' => $this->get_icon_list(),
						'default' => 'icofont icofont-cart',
					]
				);
				if (!empty($get_extenders) && isset($get_extenders['sticky'])) {
				}

			$this->end_controls_section();
		// End Woo Cart
		// =============


		// Start Cart Style
		// =================
			$selector = '.elementor-element-{{ID}} .sina-woo-cart';
			$this->start_controls_section(
				'woo_cart_style',
				[
					'label' => esc_html__( 'Cart', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->end_controls_section();
		// End Cart Style
		// ===============
	}


	protected function render() {
		if ( null === \WC()->cart ) {
			return;
		}

		$data = $this->get_settings_for_display();
		?>
		<div class="sina-woo-cart">
			<button class="sina-button">
				<i class="<?php echo esc_attr( $data['cart_icon'] ); ?>"></i>
			</button>
		</div><!-- .sina-woo-cart -->
		<?php
	}


	protected function content_template() {

	}
}