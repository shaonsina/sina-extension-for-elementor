<?php

/**
 * User Counter Widget.
 *
 * @since 3.7.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Text_Shadow;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Nav_Menu_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 3.7.0
	 */
	public function get_name() {
		return 'sina_nav_menu';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.7.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Nav Menu', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.7.0
	 */
	public function get_icon() {
		return 'eicon-nav-menu';
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
		return [ 'sina nav menu', 'sina navigation', 'sina menu' ];
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

	/**
	 * Get widget scripts.
	 *
	 * Retrieve the list of scripts the widget belongs to.
	 *
	 * @since 3.7.0
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
	 * @since 3.7.0
	 * @access protected
	 */
	protected function register_controls() {
		// Start Nav Menu
		// ===============
			$this->start_controls_section(
				'nav_menu_content',
				[
					'label' => esc_html__( 'Nav Menu', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
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
					'default' => 'center',
					'selectors' => [
						'{{WRAPPER}} ' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->end_controls_section();
		// End Nav Menu
		// =============


		// Start Nav Menu Style
		// =====================
			$this->start_controls_section(
				'nav_menu_style',
				[
					'label' => esc_html__( 'Nav Menu', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'text_color',
				[
					'label' => esc_html__( 'Text Color', 'sina-ext' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#1085e4',
					'selectors' => [
						'{{WRAPPER}} ' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'text_typography',
					'fields_options' => [
						'typography' => [ 
							'default' =>'custom', 
						],
						'font_weight' => [
							'default' => '600',
						],
						'font_size'   => [
							'default' => [
								'size' => '24',
							],
						],
						'line_height'   => [
							'default' => [
								'size' => '32',
							],
						],
					],
					'selector' => '{{WRAPPER}} ',
				]
			);
			$this->end_controls_section();
		// End Nav Menu Style
		// ===================
	}


	protected function render() {
		$data 			= $this->get_settings_for_display();
		$nav_classes	= !is_customize_preview() && is_admin_bar_showing() ? 'wp-topbar ' : '';
		$args 			= [
			// 'menu'                   => $settings['nav_menu'],
			'fallback_cb'            => 'wp_page_menu',
			'container_class'	=> 'sina-navbar-collapse',
			'items_wrap'		=> '<ul class="sina-menu sina-menu-right" data-in="sina-nav-fadeInLeft" data-out="sina-nav-fadeOutLeft">%3$s</ul>',
		];
		?>
		<nav class="sina-nav-menu sina-nav-mobile-sidebar sina-navbar-fixed <?php echo esc_attr($nav_classes); ?>" data-top="64">
			<div class="sina-nav-container">
				<div class="sina-nav-header">
					<button type="button" class="sina-nav-toggle">
						<i class="fa fa-bars"></i>
					</button>

					<a class="sina-nav-brand" href="https://sinaextra.com">
						<h1>Sina Extra</h1>
						<p>Quality Plugins House</p>
					</a>
				</div>
				<?php wp_nav_menu( $args ); ?>
			</div>
		</nav><!-- .sina-nav-menu -->
		<?php
	}


	protected function content_template() {

	}
}